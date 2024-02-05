<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require __DIR__ . '\..\..\vendor\autoload.php';

use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Sso extends CI_Controller {
	private $login_method;
	private $access_age;
	private $refresh_age;

	function __construct(){
		parent::__construct();
		$sso_config = $this->config->item('sso');
		$this->login_method = $sso_config['method'];
		$this->access_age = (int)$sso_config['access_token_age'];
		$this->refresh_age = (int)$sso_config['refresh_token_age'];
	}

	public function index()
	{
		$get = $this->input->get(NULL, TRUE);
		$data = [];

		if(!empty($get['alert'])){
			$data['alert'] = $get['alert'];
		}

		if(empty($get['client_id'])){
			$data['alert'] = 'Unauthorized Access';
		}else{
			$appdata = $this->db
			->select('apps_nama, apps_desc')
			->from('apps')
			->where('client_id', $get['client_id'])
			->get()
			->row();

			if(empty($appdata)){
				$data['alert'] = 'Unauthorized Access';
			}else{
				$data['client_id'] = $get['client_id'];
				$data['app_name'] = $appdata->apps_nama;
				$data['app_desc'] = $appdata->apps_desc;
			}
		}

		$this->load->view('v_login_sso', $data);
	}
	
	public function login()
	{
		$postdatas = $this->input->post(NULL, TRUE);
		$redirect_back = 'sso';

		if(empty($postdatas['client_id'])){
			$alert = urlencode("Unauthorized access !");
			redirect("$redirect_back/?alert=$alert");
		}
		$client_id = $postdatas['client_id'];

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');		

		if($this->form_validation->run() == false){
			$alert = urlencode("Username/Password harus diisi !");
			redirect("$redirect_back/?client_id=$client_id&alert=$alert");
		}

		$username = $postdatas['username'];
		$password = $postdatas['password'];

		$userdata = null;

		if($this->login_method == SSO_METHOD_DB){ //login using mawas-db
			$userdata = $this->db
			->select('user_id')
			->from('user')
			->group_start() //this will start grouping
			->where('user_username', $username)
			->or_where('nip', $username)
			->group_end() //this will end grouping
			->where('user_password', md5($password))
			->where('is_disabled', 0)
			->get()
			->row();
		}else if($this->login_method == SSO_METHOD_SMTP){ //login using mailservice
			$smtp_config = $this->config->item('sso')['smtp'];
			try{
				$mail = new PHPMailer(true);
				$mail->SMTPAuth = true;
				$mail->Username = $username;
				$mail->Password = $password;
				$mail->Host = $smtp_config['smtp_host'];
				$mail->Port = $smtp_config['smtp_port'];
				$mail->SMTPSecure = $smtp_config['smtp_crypto'];
				$mail->Timeout = $smtp_config['smtp_timeout'];
		
				// This function returns TRUE if authentication
				// was successful, or throws an exception otherwise
				$validCredentials = $mail->SmtpConnect();
				if($validCredentials){
					$userdata = $this->db
					->select('user_id')
					->from('user')
					->where('user_username', $username)
					->where('is_disabled', 0)
					->get()
					->row();
				}
			}catch(PHPMailerException $e){
				if($e->getMessage() == 'SMTP Error: Could not authenticate.'){
					//wrong username or password
				}else{
					throw $e;
				}
			}
		}

		if(empty($userdata)){
			$alert = urlencode("Username/Password salah !");
			redirect("$redirect_back/?client_id=$client_id&alert=$alert");
		}

		$appdata = $this->db
		->select('apps_id, client_secret, domain, callback_uri, redirect_uri')
		->from('apps')
		->where('client_id', $client_id)
		->get()
		->row();

		if(empty($appdata)){
			$alert = urlencode("Unauthorized access !");
			redirect("$redirect_back/?client_id=$client_id&alert=$alert");
		}
		if(empty($appdata->client_secret) || empty($appdata->domain) || empty($appdata->callback_uri)){
			$alert = urlencode("Invalid Configuration !");
			redirect("$redirect_back/?client_id=$client_id&alert=$alert");
		}

		//check user access to the app
		$permissions = [];
		$accessdatas = $this->db
		->from('akses')
		->where([
			'user_id' => $userdata->user_id,
			'apps_id' => $appdata->apps_id
		])
		->get()
		->result();

		foreach($accessdatas as $loop){
			$permissions []= $loop->akses_role;
		}

		// if(empty($permissions)){
		// 	$alert = urlencode("You do not have access to this application !");
		// 	redirect("$redirect_back/?client_id=$client_id&alert=$alert");
		// }

		$code_length = 64;
		$code = bin2hex(random_bytes(($code_length-($code_length%2))/2));

		$this->db->insert('sso_otp', [
			'code' => $code,
			'client_id' => $client_id,
			'user_id' => $userdata->user_id,
			'timestamp' => (time() + (60 * 5))
		]);
		
		$callback_url = $appdata->domain.$appdata->callback_uri;
		redirect("$callback_url?code=$code");
	}

	public function get_token(){
		$post = $this->input->post();

		if(empty($post['code'])){
			http_response_code(401);exit;
		}

		$otp = $this->db
		->from('sso_otp')
		->where('code', $post['code'])
		->get()
		->row();

		if(empty($otp)){
			http_response_code(401);exit;
		}

		$res = $this->db
		->from('sso_otp')
		->where('code', $post['code'])
    	->delete();

		if(time() > $otp->timestamp){
			http_response_code(401);exit;
		}

		$userdata = $this->db
		->select('nip, user_nama')
		->from('user')
		->where('user_id', $otp->user_id)
		->get()
		->row();

		$appdata = $this->db
		->select('client_secret')
		->from('apps')
		->where('client_id', $otp->client_id)
		->get()
		->row();

		$iat = time();
		$payload = array(
			'iss' => base_url(),
			'aud' => $otp->client_id,
			'iat' => $iat,
			'nbf' => $iat,
			'exp' => $iat + $this->access_age,
			'nip' => $userdata->nip
		);

		$payload_refresh = $payload;
		$payload_refresh['exp'] = $iat + $this->refresh_age;

		$access_token = JWT::encode($payload, $appdata->client_secret, 'HS256');
		$refresh_token = JWT::encode($payload_refresh, $appdata->client_secret, 'HS256');

		http_response_code(200);
		echo json_encode([
			'employee' => [
				'nip' => $userdata->nip,
				'name' => $userdata->user_nama
			],
			'access_token' => $access_token,
			'refresh_token' => $refresh_token
		]);
	}

	public function authorize(){
		$post = $this->input->post();

		if(empty($post['client_id'])){
			http_response_code(401);exit;
			
		}
		if(empty($post['access_token']) && empty($post['refresh_token'])){
			http_response_code(401);exit;
		}

		$appdata = $this->db
		->select('client_secret')
		->from('apps')
		->where('client_id', $post['client_id'])
		->get()
		->row();

		$jwt = '';
		$is_refresh_token = false;
		if(!empty($post['refresh_token'])){
			$is_refresh_token = true;
			$jwt = $post['refresh_token'];
		}else{
			$jwt = $post['access_token'];
		}

		$now = time();
		$decoded = null;
		try {
			$decoded = JWT::decode($jwt, new Key($appdata->client_secret, 'HS256'));

			$response = ['status' => 'ok'];
			if($is_refresh_token){
				$iat = time();
				$payload = array(
					'iss' => base_url(),
					'aud' => $post['client_id'],
					'iat' => $iat,
					'nbf' => $iat,
					'exp' => $iat + $this->access_age,
					'nip' => $decoded->nip
				);
		
				$access_token = JWT::encode($payload, $appdata->client_secret, 'HS256');
				$response['access_token'] = $access_token;
			}
	
			echo json_encode($response);
		} catch (InvalidArgumentException $e) {
			// provided key/key-array is empty or malformed.
			http_response_code(500);exit;
		} catch (DomainException $e) {
			// provided algorithm is unsupported OR
			// provided key is invalid OR
			// unknown error thrown in openSSL or libsodium OR
			// libsodium is required but not available.
			http_response_code(500);exit;
		} catch (SignatureInvalidException $e) {
			// provided JWT signature verification failed.
			http_response_code(401);exit;
		} catch (BeforeValidException $e) {
			// provided JWT is trying to be used before "nbf" claim OR
			// provided JWT is trying to be used before "iat" claim.
			http_response_code(401);exit;
		} catch (ExpiredException $e) {
			// provided JWT is trying to be used after "exp" claim.
			header("HTTP/1.1 401 Expired");exit;
		} catch (UnexpectedValueException $e) {
			// provided JWT is malformed OR
			// provided JWT is missing an algorithm / using an unsupported algorithm OR
			// provided JWT algorithm does not match provided key OR
			// provided key ID in key/key-array is empty or invalid.
			http_response_code(500);exit;
		}
	}
}
