<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Status extends CI_Controller {

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

    // CRUD STATUS PEGAWAI
	public function index()
	{
		$data['status_pegawai'] = $this->m_data->get_data('master_pegawai_status')->result();
		$this->load->view('template/v_header');
		$this->load->view('master/v_status_pegawai',$data);
		$this->load->view('template/v_footer');
	}	
	public function status_pegawai_act()
	{				
		$nama = $this->input->post('nama_status_peg');
		$deskripsi = $this->input->post('desc_status_peg');
		$data = array(			
			'status_nama' => $nama,
			'status_deskripsi' => $deskripsi
		);

		$this->m_data->insert_data($data,'master_pegawai_status');
		$this->session->set_flashdata('success', 'Status Pegawai berhasil ditambahkan.');
		redirect(base_url().'status');
	}
	public function status_pegawai_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_status_peg');
		$deskripsi = $this->input->post('desc_status_peg');
		$where = array(
			'status_pegawai_id' => $id
		);

		$data = array(
			'status_nama' => $nama,
			'status_deskripsi' => $deskripsi
		);

		$this->m_data->update_data($where, $data,'master_pegawai_status');
		$this->session->set_flashdata('success', 'Berhasil mengubah data Status Pegawai.');
		redirect(base_url().'status');
	}
	public function status_pegawai_hapus($id)
	{
		$where = array(
			'status_pegawai_id' => $id
		);

		$this->m_data->delete_data($where,'master_pegawai_status');		
		$this->session->set_flashdata('success', 'Berhasil menghapus Status Pegawai.');
		redirect(base_url().'status');
	}
}
?>