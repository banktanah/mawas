<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Akses extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('m_data');
		$this->load->library('pdf');

		// cek session yang login, 
		// jika session status tidak sama dengan session telah_login, berarti pengguna belum login
		// maka halaman akan di alihkan kembali ke halaman login.
		if($this->session->userdata('status')!="telah_login"){
			redirect(base_url().'welcome?alert=belum_login');
		}
	}

    // CRUD AKSES APLIKASI
	public function akses($id)
	{
		$where = array(
			'apps_id' => $id
		);

		$data['akses'] = $this->m_data->edit_data($where, 'akses')->result();
		$data['nama_apps'] = $this->m_data->edit_data($where, 'apps')->row()->apps_nama;
		$data['apps_id'] = $id;
		$this->load->view('template/v_header');
		$this->load->view('master/v_akses',$data);
		$this->load->view('template/v_footer');
	}
	public function akses_act()
	{				
		$user_id = $this->input->post('user_id');
		$role_nama = $this->input->post('role_nama');
		$apps_id = $this->input->post('apps_id');
		
		$data = array(			
			'akses_role' => $role_nama,
			'user_id' => $user_id,
			'apps_id' => $apps_id
		);

		//cek nama
		$is_exist = $this->db->query("SELECT * FROM akses WHERE user_id = '$user_id' AND apps_id = '$apps_id'")->num_rows(); 
		if ($is_exist != 0) {
			$this->session->set_flashdata('error', 'Pegawai sudah memiliki akses sebelumnya!');
			redirect(base_url().'akses/akses/'.$apps_id);
		}else{
			$this->m_data->insert_data($data,'akses');
			$this->session->set_flashdata('success', 'Akses berhasil ditambahkan.');
			redirect(base_url().'akses/akses/'.$apps_id);
		}
	}
	public function akses_hapus()
	{
		$akses_id = $_GET['akses_id'];
		$apps_id = $_GET['apps_id'];

		$where = array(
			'akses_id' => $akses_id
		);


		$this->m_data->delete_data($where,'akses');	
		$this->session->set_flashdata('success', 'Berhasil menghapus akses.');	
		redirect(base_url().'akses/akses/'.$apps_id);
	}
}
?>