<?php
require_once APPPATH."/controllers/_Authorized.php";

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends _Authorized {

	public function notfound()
	{
		$this->load->view('v_notfound');
	}

	public function index()
	{
		$user = $this->session->get_userdata();
		if(!empty($user['id'])){
			$level = $user['hrm_level'];
			if($level == "Superadmin"){
				redirect(base_url().'user');
			}else if($level == "Admin") {
				redirect(base_url().'pegawai?is_active=TRUE');
			}else if($level=="Pegawai") {
				redirect(base_url().'user/profil');
			}	
		}			

		// $this->load->view('v_login');
		redirect('auth?alert=logout');
	}
}
