<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome_del extends CI_Controller {

	public function notfound()
	{
		$this->load->view('v_notfound');
	}

	public function index()
	{
		$this->load->view('v_login');
	}

	public function aksi()
	{

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');		

		if($this->form_validation->run() != false){			
			$username = $this->input->post('username');
			$password = $this->input->post('password');			


			$where = array(
				'user_username' => $username,
				'user_password' => md5($password)
			);

			$this->load->model('m_data');
			$cek = $this->m_data->cek_login('user',$where)->num_rows();
			if($cek > 0){				
				$data = $this->m_data->cek_login('user',$where)->row();
				$data_session = array(
					'id' => $data->user_id,
					'nama' => $data->user_nama,		
					'hrm_level' => $data->hrm_level,			
					'status' => 'telah_login'
				);
				$this->session->set_userdata($data_session);	
				$level = $data->hrm_level;
				if($level=="Admin"){
					redirect(base_url().'pegawai?is_active=TRUE');
				}elseif ($level=="Superadmin") {
					redirect(base_url().'pegawai?is_active=TRUE');
				}elseif ($level=="Pegawai") {
					redirect(base_url().'user/profil');
				}					
				
			}else{
				redirect(base_url().'?alert=gagal');
			}

		}else{
			$this->load->view('v_login');
			
		}
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('welcome/?alert=logout');
	}
}
