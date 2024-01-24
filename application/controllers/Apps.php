<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Apps extends CI_Controller {

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

    // CRUD APLIKASI
	public function index()
	{
		$data['apps'] = $this->db->query('SELECT * FROM apps ORDER BY apps_nama')->result();
		$this->load->view('template/v_header');
		$this->load->view('master/v_apps',$data);
		$this->load->view('template/v_footer');
	}
	public function apps_act()
	{				
		$nama = $this->input->post('nama_apps');
		$url = $this->input->post('url_apps');
		$deskripsi = $this->input->post('desc_apps');
		$data = array(			
			'apps_nama' => $nama,
			'apps_url' => $url,
			'apps_desc' => $deskripsi
		);

		//cek nama
		$is_exist = $this->db->query("SELECT * FROM apps WHERE apps_nama = '$nama'")->num_rows(); 
		if ($is_exist != 0) {
			redirect(base_url().'apps');
		}

		$this->m_data->insert_data($data,'apps');
		$this->session->set_flashdata('success', 'Aplikasi berhasil ditambahkan.');
		redirect(base_url().'apps');
	}
	public function apps_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_apps');
		$url = $this->input->post('url_apps');
		$deskripsi = $this->input->post('desc_apps');

		$where = array(
			'apps_id' => $id
		);

		$data = array(			
			'apps_nama' => $nama,
			'apps_url' => $url,
			'apps_desc' => $deskripsi
		);

		$this->m_data->update_data($where, $data,'apps');
		$this->session->set_flashdata('success', 'Data aplikasi berhasil diedit.');
		redirect(base_url().'apps');
	}
	public function apps_hapus($id)
	{
		$where = array(
			'apps_id' => $id
		);


		$this->m_data->delete_data($where,'apps');		
		$this->session->set_flashdata('success', 'Aplikasi berhasil dihapus.');
		redirect(base_url().'apps');
	}
}
?>