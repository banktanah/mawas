<?php
require_once APPPATH."/libraries/bbt-sso-client-compat/BbtSsoClient.php";
use Bbt\Sso\BbtSsoClient;

defined('BASEPATH') OR exit('No direct script access allowed');

class _Authorized extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$ssoClient = new BbtSsoClient($_ENV['SSO_CLIENT_URL'], $_ENV['SSO_CLIENT_ID'], $_ENV['SSO_CLIENT_SECRET'], $_ENV['SSO_CLIENT_URL_LOCAL']);
		$this->load->model('user_model');
		
		$ssoClient->AuthCheck();

		$userid = $this->session->userdata('id');
		if(empty($userid)){
			$user = $ssoClient->GetUserInfo();

			$data_session = $this->user_model->generate_session_data($user->nip, $user->roles);

			$this->session->set_userdata($data_session);
		}
	}
}
