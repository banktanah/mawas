<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Role extends CI_Controller {

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

    // CRUD Role
	public function index()
	{
		$data['roles'] = $this->db->query("SELECT * FROM user_role")->result();
		$this->load->view('template/v_header');
		$this->load->view('master/v_role',$data);
		$this->load->view('template/v_footer');
	}
	public function role_act()
	{
		$nama = $this->input->post('nama_role');
		$desc = $this->input->post('desc_role');		

		$data = array(			
			'role_nama' => $nama,
			'role_desc' => $desc		
		);

		$this->m_data->insert_data($data,'user_role');
		$this->session->set_flashdata('success', 'Role berhasil ditambahkan.');
		redirect(base_url().'role');
	}
	public function role_hapus($id)
	{
		$where = array(
			'id' => $id
		);
		$this->m_data->delete_data($where,'user_role');
		$this->session->set_flashdata('success', 'Berhasil menghapus role.');
		// $this->db->query("delete from transaksi where transaksi_project='$id'");
		// $this->db->query("delete from realisasi where realisasi_project='$id'");
		redirect(base_url().'role');
	}
}
?>