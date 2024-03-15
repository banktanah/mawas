<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH."/libraries/bbt-sso-client-compat/Encrypter.php";

// use Bbt\Sso\Encrypter;
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
	private $server_secret;

	private const COOKIE_SESSION_NAME = 'mwsshsess';
	private const COOKIE_REMEMBER_NAME = 'mwsrmbt';

	function __construct(){
		parent::__construct();
		$sso_config = $this->config->item('sso');
		$this->login_method = $sso_config['method'];
		$this->access_age = (int)$sso_config['access_token_age'];
		$this->refresh_age = (int)$sso_config['refresh_token_age'];
		$this->server_secret = $sso_config['server_secret'];

		$this->load->model('Forgotpasswordmodel', 'forgot');
		$this->load->model('user_model');
		$this->load->model('app_model');
		$this->load->model('sharedsession_model');
	}

	public function index(){
		$this->login_with_shared_session_if_exists();
		$this->login_with_remember_token_if_exists();

		$get = $this->input->get(NULL, TRUE);
		$data = [];

		if(!empty($get['alert'])){
			$this->session->set_flashdata('alert', $get['alert']);
		}
		if(!empty($get['error'])){
			$this->session->set_flashdata('error', $get['error']);
		}

		if(empty($get['client_id'])){
			$this->session->set_flashdata('error', 'Unauthorized Access');
		}else{
			$appdata = $this->app_model->get_by_client_id($get['client_id']);

			if(empty($appdata)){
				$this->session->set_flashdata('error', 'Unauthorized Access');
			}else{
				$data['client_id'] = $get['client_id'];
				$data['challenge'] = $get['challenge'];
				$data['challenge_method'] = $get['challenge_method'];
				$data['app_name'] = $appdata->apps_nama;
				$data['app_desc'] = $appdata->apps_desc;
				$data['client_home'] = urlencode("$appdata->domain/");
				$data['recaptcha_site_key'] = $this->config->item('recaptcha')['site_key'];
				$data['redirect'] = !empty($get['redirect'])? $get['redirect']: '';

				setcookie(self::COOKIE_SESSION_NAME, self::generate_random_string(64), time() + (60*60*24*7), $_ENV['BASE_URI'].'/sso', self::get_domain(), false, true);
				setcookie(self::COOKIE_REMEMBER_NAME, self::generate_random_string(64), time() + (60*60*24*30), $_ENV['BASE_URI'].'/sso', self::get_domain(), false, true);
			}
		}

		header("Access-Control-Allow-Headers: *"); //allows header thrown by some libraries(eg: x-xsrf-token)

		$this->load->view('sso/v_login', $data);
	}
	
	public function login(){
		$postdatas = $this->input->post(NULL, TRUE);
		$redirect_back = 'sso';

		if(empty($postdatas['client_id']) || empty($postdatas['challenge'])){
			$this->session->set_flashdata('error', "Unauthorized access !");
			redirect($redirect_back);
		}
		$challenge_method = 'plain';
		if(!empty($postdatas['challenge_method'])){
			$challenge_method = strtolower($postdatas['challenge_method']);
			if($challenge_method!='s256'){
				$this->session->set_flashdata('error', "Invalid Challenge Method !");
				redirect($redirect_back);
			}
		}

		$loginpage_params = [
			"client_id=".$postdatas["client_id"],
			"challenge=".$postdatas["challenge"],
			"challenge_method=".$postdatas["challenge_method"],
		];

		if(!empty($postdatas["redirect"])){
			$loginpage_params []= "redirect=".$postdatas["redirect"];
		}

		/**
		 * Recaptcha tutorial: 
		 * https://wesleybaxterhuber.medium.com/i-finally-figured-out-googles-recaptcha-v3-8f668860f82d
		 */
		if(empty($postdatas['g-recaptcha-response'])){
			$this->session->set_flashdata('error', "No recaptcha-response !");
			redirect($redirect_back.'?'.implode('&', $loginpage_params));
		}

		$client = new \GuzzleHttp\Client(); 
		$res = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
			'form_params' => [
				'secret' => $this->config->item('recaptcha')['secret_key'],
				'response' => $postdatas['g-recaptcha-response']
			]
		]);
		$status = $res->getStatusCode();
		if($status != 200){
			log_message('error', "Hitting recaptcha siteverify-api error, status-code: $status");
			$this->session->set_flashdata('error', "Failed to verify recaptcha !");
			redirect($redirect_back.'?'.implode('&', $loginpage_params));
		}
		$resJson = json_decode($res->getBody()->getContents());
		if($resJson->success == true && $resJson->action == 'submit' && $resJson->score >= 0.5) {
			// valid submission
		} else {
			$this->session->set_flashdata('error', "You spamming too much, are you a bot?");
			redirect($redirect_back.'?'.implode('&', $loginpage_params));
		}

		$client_id = $postdatas['client_id'];
		$challenge = $postdatas['challenge'];

		$this->form_validation->set_rules('username', '', 'required');
		$this->form_validation->set_rules('password', '', 'required');

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('error', "Username/Password harus diisi !");
			redirect($redirect_back.'?'.implode('&', $loginpage_params));
		}
		
		$this->session->set_flashdata('username_cache', $postdatas['username']);

		$username = $postdatas['username'];
		$password = $this->input->post('password');

		$userdata = null;
		if($this->login_method == SSO_METHOD_DB){ //login using mawas-db
			$userdata = $this->user_model->do_login($username, $password);
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
					$userdata = $this->user_model->get_by_email_or_nip($username);
					$userdata = !empty($userdata)&&$userdata->is_disabled==0? $userdata: null;
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
			$this->session->set_flashdata('error', "Username/Password salah !");
			redirect($redirect_back.'?'.implode('&', $loginpage_params));
		}

		$remember_me = !empty($postdatas['remember_me'])? 1: 0;

		$redirect = $this->input->post('redirect');
		$this->return_auth_code_to_client(
			$client_id,
			$userdata->user_id,
			$challenge,
			$challenge_method,
			!empty($redirect)? $redirect: '',
			$loginpage_params,
			$remember_me
		);
	}
	
	private function login_with_shared_session_if_exists(){
		$shsess_id = !empty($_COOKIE[self::COOKIE_SESSION_NAME])? $_COOKIE[self::COOKIE_SESSION_NAME]: null;

		if(empty($shsess_id))return;

		$shsess = $this->sharedsession_model->check_session($shsess_id);

		if(empty($shsess))return;

		$get = $this->input->get(NULL, TRUE);
		$redirect = $this->input->get('redirect');
		$this->return_auth_code_to_client(
			$get['client_id'],
			$shsess->user_id,
			$get['challenge'],
			$get['challenge_method'],
			!empty($redirect)? $redirect: ''
		);
	}
	
	private function login_with_remember_token_if_exists(){
		$remember_token = !empty($_COOKIE[self::COOKIE_REMEMBER_NAME])? $_COOKIE[self::COOKIE_REMEMBER_NAME]: null;

		if(empty($remember_token))return;

		$user = $this->user_model->get_by_remember_token($remember_token);

		if(empty($user))return;

		setcookie(self::COOKIE_SESSION_NAME, self::generate_random_string(64), time() + (60*60*24*7), $_ENV['BASE_URI'].'/sso', self::get_domain(), false, true);
		setcookie(self::COOKIE_REMEMBER_NAME, self::generate_random_string(64), time() + (60*60*24*30), $_ENV['BASE_URI'].'/sso', self::get_domain(), false, true);

		$get = $this->input->get(null, true);
		$data = [
			'user_id' => $user->user_id,
			'client_id' => $get['client_id'],
			'challenge' => $get['challenge'],
			'challenge_method' => $get['challenge_method'],
			'redirect' => !empty($get['redirect'])? $get['redirect']: ''
		];

		$this->load->view('sso/_login_with_remember_token', $data);
	}

	public function login_via_remember(){
		$post = $this->input->post(NULL, TRUE);
		$redirect = $this->input->post('redirect');
		$this->return_auth_code_to_client(
			$post['client_id'],
			$post['user_id'],
			$post['challenge'],
			$post['challenge_method'],
			!empty($redirect)? $redirect: '',
			[],
			1
		);
	}

	private function return_auth_code_to_client(
		$client_id, 
		$user_id,
		$challenge,
		$challenge_method,
		$redirect = '',
		$loginpage_params = [],
		$remember_me = 0
	){
		$redirect_back = 'sso';

		$appdata = $this->app_model->get_by_client_id($client_id);

		if(empty($appdata)){
			$this->session->set_flashdata('error', "Unauthorized access !");
			redirect($redirect_back.'?'.implode('&', $loginpage_params));
		}
		if(empty($appdata->client_secret) || empty($appdata->domain) || empty($appdata->callback_uri)){
			$this->session->set_flashdata('error', "Invalid Configuration, contact administrator !");
			redirect($redirect_back.'?'.implode('&', $loginpage_params));
		}

		//check user access to the app
		// $permissions = [];
		// $accessdatas = $this->db
		// ->from('akses')
		// ->where([
		// 	'user_id' => $userdata->user_id,
		// 	'apps_id' => $appdata->apps_id
		// ])
		// ->get()
		// ->result();

		// foreach($accessdatas as $loop){
		// 	$permissions []= $loop->akses_role;
		// }

		$roles = $this->user_model->get_roles($user_id, $client_id);

		if(empty($roles)){
			$this->session->set_flashdata('error', "You do not have access to this application !");
			redirect($redirect_back.'?'.implode('&', $loginpage_params));
		}

		$code = self::generate_random_string(64);

		$this->db->insert('sso_otc', [
			'code' => $code,
			'client_id' => $client_id,
			'user_id' => $user_id,
			'shared_session_id' => $_COOKIE[self::COOKIE_SESSION_NAME],
			'challenge' => $challenge,
			'challenge_method' => $challenge_method,
			'timestamp' => (time() + (60 * 5)),
			'remember_me' => $remember_me,
			'remember_token' => $_COOKIE[self::COOKIE_REMEMBER_NAME]
		]);
		
		$callback_url = $appdata->domain.$appdata->callback_uri;

		$params = ["code=$code"];
		if(!empty($redirect)){
			$params []= 'redirect='.urlencode($redirect);
		}
		$url_params = implode('&', $params);

		redirect("$callback_url?$url_params");
	}

	public function get_token(){
		$post = $this->input->post(NULL, TRUE);

		if(empty($post['code']) || empty($post['verifier'])){
			http_response_code(401);exit;
		}

		$otc = $this->db
		->from('sso_otc')
		->where('code', $post['code'])
		->get()
		->row();

		if(empty($otc)){
			http_response_code(401);exit;
		}

		$res = $this->db
		->from('sso_otc')
		->where('code', $post['code'])
    	->delete();

		//check PKCE
		$verifier = $post['verifier'];
		if($otc->challenge_method == 's256'){
			$verifier = base64_encode(hash('sha256', $verifier));
		}

		if($verifier != $otc->challenge){
			http_response_code(401);
			echo 'PKCE challenge failed';
			exit;
		}

		if(time() > $otc->timestamp){
			http_response_code(401);
			echo 'PKCE key expired';
			exit;
		}

		if($otc->remember_me == 1){
			$this->db
				->where('user_id', $otc->user_id)
				->update('user', ['remember_token' => $otc->remember_token])
				;
		}
		$existing_session = $this->sharedsession_model->check_session($otc->shared_session_id);
		if(empty($existing_session)){ //first time login
			$status = $this->sharedsession_model->create_session($otc->shared_session_id, $otc->user_id);
		}
		$multi_session_id = self::generate_random_string(64);
		$appdata = $this->app_model->get_by_client_id($otc->client_id);
		$status = $this->sharedsession_model->create_session_multi($otc->shared_session_id, $multi_session_id, $appdata->apps_id);

		$userdata = $this->user_model->get_by_id($otc->user_id);
		$tokens = $this->generate_access_tokens($userdata->nip, $multi_session_id);

		http_response_code(200);
		echo json_encode([
			'access_token' => $tokens->access_token,
			'refresh_token' => $tokens->refresh_token,
			'user' => $this->get_user_info($otc->client_id, $otc->user_id)
		]);
	}

	public function auth(){
		$post = $this->input->post(NULL, TRUE);
		
		if(empty($post['type'])){
			log_message('error', "Missing required parameter \"type\"");
			http_response_code(401);
			echo 'Missing required parameter';
			exit;
		}
		$payload = $this->verify_bearer();

		$user = $this->user_model->get_by_email_or_nip($payload->nip);

		$sess = $this->sharedsession_model->check_session_by_multisessionid($payload->msi);

		if(empty($sess)){
			http_response_code(401);
			echo 'Expired session';
			exit;
		}else if($sess->forced_logout_status != null){
			$this->sharedsession_model->invalidate($sess->session_id);
			http_response_code(401);
			echo $sess->forced_logout_status;
			exit;
		}

		$response = ['status' => 'success'];
		if($post['type'] == 'refresh'){
			$tokens = $this->generate_access_tokens($payload->nip, $payload->msi);
			$response['access_token'] = $tokens->access_token;
			$response['refresh_token'] = $tokens->refresh_token;
		}

		echo json_encode($response);
	}

	private function generate_access_tokens($nip, $multi_session_id){
		$iat = time();
		$payload = array(
			'iss' => base_url(),
			// 'aud' => $otc->client_id,
			'aud' => '*',
			'iat' => $iat,
			'nbf' => $iat,
			'exp' => $iat + $this->access_age,
			'nip' => $nip,
			'msi' => $multi_session_id
		);

		$payload_refresh = $payload;
		$payload_refresh['exp'] = $iat + $this->refresh_age;

		$result = [];
		$result['access_token'] = JWT::encode($payload, $this->server_secret, 'HS256');
		$result['refresh_token'] = JWT::encode($payload_refresh, $this->server_secret, 'HS256');

		return json_decode(json_encode($result));
	}
	
	public function logout(){
		$payload = $this->verify_bearer();

		$status = $this->sharedsession_model->invalidate_by_multisessionid($payload->msi);
		
		$user = $this->user_model->get_by_email_or_nip($payload->nip);
		$status = $this->db
			->where('user_id', $user->user_id)
			->update('user', ['remember_token' => null])
			;

		echo json_encode(['status' => 'success']);
	}

	public function userinfo(){
		$post = $this->input->post(NULL, TRUE);

		if(empty($post['client_id'])){
			log_message('error', "Missing client_id");
			http_response_code(401);
			echo 'Missing client_id';
			exit;
		}
		$payload = $this->verify_bearer();

		$userdata = $this->user_model->get_by_email_or_nip($payload->nip);
		$response = [
			'status' => 'success',
			'user' => $this->get_user_info($post['client_id'], $userdata->user_id)
		];

		echo json_encode($response);
	}

	public function forgot_password(){
		$get = $this->input->get(NULL, TRUE);

		$client_home = $this->get_client_home($get['client_id']);
		if(empty($client_home)){
			$this->session->set_flashdata('error', "Unauthorized access !");
			$this->load->view('sso/v_forgot_pass');
		}

		$this->session->set_flashdata('client_home', $client_home);
		$this->load->view('sso/v_forgot_pass');
	}

	public function do_forgot_password(){
		$post = $this->input->post(NULL, TRUE);

		$client_id = $post['client_id'];
		$redirect_back_uri = "sso/forgot_password?client_id=$client_id";

		if(empty($post['username'])){
			$this->session->set_flashdata('error', 'Username harus diisi !');
			redirect($redirect_back_uri);
		}

		$username = $post['username'];
		$user = $this->db
		->from('user')
		->group_start()
			->where('user_username', $username)
			->or_where('nip', $username)
		->group_end()
		// ->where('user_password', md5($password))
		// ->where('is_disabled', 0)
		->get()
		->row();

		if(empty($user)){
			$this->session->set_flashdata('error', 'NIP/Email tidak ditemukan !');
			redirect($redirect_back_uri);
		}

		if($user->is_disabled == 1){
			$this->session->set_flashdata('error', "User $username di-nonaktifkan !");
			redirect($redirect_back_uri);
		}

		// $reset_code = $this->forgot->get_active_resetcode($user->nip);
		// if(!empty($reset_code)){
		// 	$this->session->set_flashdata('alert', "An active Reset Password link is already sent to $user->user_username in the last one hour !");
		// 	redirect($redirect_back_uri);
		// }

		$reset_code = $this->forgot->get_resetcode($user->nip);
		$reset_url = base_url()."sso/reset_password?reset_code=$reset_code&client_id=$client_id";

		$smtp_config = $this->config->item('smtp');
		$this->load->library('email', $smtp_config);

		$this->email->from($smtp_config['smtp_user'], 'Banktanah IT (No-Reply)');
		$this->email->to($user->user_username);
		$this->email->subject('Mawas-SSO Reset Password');
		$email_body = "
			<div>Here's your reset password link (valid for 1 hour):</div>
			<div><a href='$reset_url'>Click Here</a></div>
			<div>If you do not issue this, please contact administrator.</div>
			";
		$this->email->message($email_body);

		if (!$this->email->send()) {
			show_error($this->email->print_debugger());
		}

		$this->session->set_flashdata('alert', "Reset Password link has been sent to $user->user_username, this link will only valid for 1 hour !");

		redirect($redirect_back_uri);
	}

	public function reset_password(){
		$get = $this->input->get(NULL, TRUE);

		$client_home = $this->get_client_home($get['client_id']);
		if(empty($client_home)){
			$this->session->set_flashdata('error', "Unauthorized access !");
			$this->load->view('sso/v_reset_pass');
		}

		$this->session->set_flashdata('client_home', $client_home);
		$this->load->view('sso/v_reset_pass');
	}

	public function do_reset_password(){
		// $post = $this->input->post(NULL, TRUE);
		$post = $this->input->post(); //causing missing special characters

		$redirect_back_uri = 'sso/reset_password?reset_code='.$post['reset_code'].'&client_id='.$post['client_id'];

		$nip = $this->forgot->get_nip_from_resetcode($post['reset_code']);
		if(empty($nip)){
			$this->session->set_flashdata('error', 'Invalid/Expired reset-password-link !');
			redirect($redirect_back_uri);
		}

		$this->form_validation->set_rules('password', '', 'required');
		$this->form_validation->set_rules('confirm_password', '', 'required');

		if($this->form_validation->run() == false){
			$this->session->set_flashdata('error', '"Password", dan "Konfirmasi Password" harus diisi !');
			redirect($redirect_back_uri);
		}

		$this->session->set_flashdata('pass_cache', $post['password']);
		$this->session->set_flashdata('cpass_cache', $post['confirm_password']);

		$pass = $post['password'];
		if (strlen($pass) < 8 || strlen($pass) > 16) {
			$this->session->set_flashdata('error', 'Password should be min 8 characters and max 16 characters');
			redirect($redirect_back_uri);
		}
		if (!preg_match("/\d/", $pass)) {
			$this->session->set_flashdata('error', 'Password should contain at least one digit');
			redirect($redirect_back_uri);
		}
		if (!preg_match("/[A-Z]/", $pass)) {
			$this->session->set_flashdata('error', 'Password should contain at least one Capital Letter');
			redirect($redirect_back_uri);
		}
		if (!preg_match("/[a-z]/", $pass)) {
			$this->session->set_flashdata('error', 'Password should contain at least one small Letter');
			redirect($redirect_back_uri);
		}
		if (!preg_match("/\W/", $pass)) {
			$this->session->set_flashdata('error', 'Password should contain at least one special character');
			redirect($redirect_back_uri);
		}
		if (preg_match("/\s/", $pass)) {
			$this->session->set_flashdata('error', 'Password should not contain any white space');
			redirect($redirect_back_uri);
		}

		if($post['password'] != $post['confirm_password']){
			$this->session->set_flashdata('error', '"Password" and "Confirm Password" should be same !');
			redirect($redirect_back_uri);
		}

		$res = $this->db
		->where('nip', $nip)
		->update('user', [
			'user_password' => hash('sha256', $post['password'])
		]);

		$this->session->set_flashdata('pass_cache', '');
		$this->session->set_flashdata('cpass_cache', '');

		$this->session->set_flashdata('alert', 'Password berhasil dirubah !');
		redirect($redirect_back_uri);
	}

	private function get_client_home($client_id){
		$app = $this->db
		->select('domain, redirect_uri')
		->from('apps')
		->where('client_id', $client_id)
		->get()
		->row();

		if(empty($app)){
			return null;
		}

		return "$app->domain/$app->redirect_uri";
	}

	private function get_user_info($client_id, $user_id){
		$userdata = $this->user_model->get_by_id($user_id);
		$roles = $this->user_model->get_roles($user_id, $client_id);

		return [
			'nip' => $userdata->nip,
			'name' => $userdata->user_nama,
			'email' => $userdata->user_username,
			'roles' => $roles
		];
	}

	private function verify_bearer(){
		$exception = null;

		try {
			$bearer = self::GetBearerToken();
			// JWT::$leeway = 60; //1 min-leeway, should not be mattered since the signature is both signed and verified here
			$payload = JWT::decode($bearer, new Key($this->server_secret, 'HS256'));

			return $payload;
		} catch (InvalidArgumentException $e) {
			// provided key/key-array is empty or malformed.
			http_response_code(500);
			$exception = $e;
		} catch (DomainException $e) {
			// provided algorithm is unsupported OR
			// provided key is invalid OR
			// unknown error thrown in openSSL or libsodium OR
			// libsodium is required but not available.
			http_response_code(500);
			$exception = $e;
		} catch (SignatureInvalidException $e) {
			// provided JWT signature verification failed.
			log_message('error', $e->getMessage());
			http_response_code(401);
			$exception = $e;
		} catch (BeforeValidException $e) {
			// provided JWT is trying to be used before "nbf" claim OR
			// provided JWT is trying to be used before "iat" claim.
			log_message('error', $e->getMessage().' => '.$e->getPayload());
			http_response_code(401);
			$exception = $e;
		} catch (ExpiredException $e) {
			// provided JWT is trying to be used after "exp" claim.
			http_response_code(401);
			$exception = $e;
		} catch (UnexpectedValueException $e) {
			// provided JWT is malformed OR
			// provided JWT is missing an algorithm / using an unsupported algorithm OR
			// provided JWT algorithm does not match provided key OR
			// provided key ID in key/key-array is empty or invalid.
			http_response_code(500);
			$exception = $e;
		}

		if(!empty($exception)){
			echo $exception->getMessage();
			exit;
		}
	}

	/**
	 * get Bearer Token from header
	 * */
	private static function GetBearerToken() {
		$headers = null;
		if (isset($_SERVER['Authorization'])) {
			$headers = trim($_SERVER["Authorization"]);
		} else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
			$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
		} elseif (function_exists('apache_request_headers')) {
			$requestHeaders = apache_request_headers();
			// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
			$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
			//print_r($requestHeaders);
			if (isset($requestHeaders['Authorization'])) {
				$headers = trim($requestHeaders['Authorization']);
			}
		}

		// HEADER: Get the access token from the header
		if (!empty($headers)) {
			if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
				return $matches[1];
			}
		}

		return null;
	}

	private static function generate_random_string($length){
		return bin2hex(random_bytes(($length-($length%2))/2));
	}

	private static function get_domain(){
		$url = '';
		if(isset($_SERVER['HTTP_HOST'])){
			$url = $_SERVER['HTTP_HOST'];
		}else if(isset($_SERVER['SERVER_NAME'])){
			$url = $_SERVER['SERVER_NAME'];
		}else if(isset($_SERVER['SERVER_ADDR'])){
		  $url = $_SERVER['SERVER_ADDR'];
		}
	
		$url = in_array($url, ['127.0.0.1', '0.0.0.0', '::1'])? 'localhost': $url;
	
		$pieces = parse_url($url);
		$domain = isset($pieces['host'])? $pieces['host']: (isset($pieces['path'])? $pieces['path']: '');
			
		if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
			return '.'.$regs['domain'];
		}
		
		return $domain;
	}
}
