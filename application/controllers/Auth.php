<?php
require_once APPPATH."/libraries/bbt-sso-client-compat/BbtSsoClient.php";
use Bbt\Sso\BbtSsoClient;

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	private $sso;

	public function __construct()
	{
		parent::__construct();

		$this->sso = new BbtSsoClient($_ENV['SSO_CLIENT_URL'], $_ENV['SSO_CLIENT_ID'], $_ENV['SSO_CLIENT_SECRET'], $_ENV['SSO_CLIENT_URL_LOCAL']);
		$this->load->model('user_model');
	}

	public function index()
	{
		$user = $this->session->get_userdata();
		if(!empty($user['id'])){
			redirect(base_url().'home');	
		}		

		$this->load->view('v_login');
	}

	public function sso_callback(){
		$emp = $this->sso->SsoCallbackHandler();

		// $data = $this->db->query("
		// 	select
		// 		u.user_id,
		// 		p.pegawai_nama as user_nama,
		// 		u.hrm_level
		// 	from
		// 		pegawai_karir pk
		// 		left join user u on pk.pegawai_id = u.pegawai_id 
		// 		left join pegawai p on pk.pegawai_id = p.pegawai_id
		// 	where
		// 		pk.pegawai_nip = '$emp->nip'
		// ")
		// ->row();

		// $data_session = array(
		// 	'id' => $data->user_id,
		// 	'nama' => $data->user_nama,		
		// 	'hrm_level' => $data->hrm_level,			
		// 	'status' => 'telah_login'
		// );

		$data_session = $this->user_model->generate_session_data($emp->nip);

		$this->session->set_userdata($data_session);

		redirect(base_url());
	}

	public function keluar()
	{
		$this->session->sess_destroy();
        $this->sso->Logout();
		// redirect('auth?alert=logout');
	}
}
