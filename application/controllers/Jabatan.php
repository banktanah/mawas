<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Jabatan extends CI_Controller {

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
		$data['jabatans'] = $this->db->query('SELECT * FROM master_jabatan ORDER BY jabatan_level')->result();
		$this->load->view('template/v_header');
		$this->load->view('master/v_jabatan',$data);
		$this->load->view('template/v_footer');
	}	
	public function jabatan_act()
	{				
		$nama = $this->input->post('jabatan_nama');
		$deskripsi = $this->input->post('jabatan_desc');
        $urutan = $this->input->post('jabatan_level');
		$data = array(			
			'jabatan_nama' => $nama,
            'jabatan_level' => $urutan,
			'jabatan_desc' => $deskripsi
		);

		$this->m_data->insert_data($data,'master_jabatan');
		$this->session->set_flashdata('success', 'Jabatan berhasil ditambahkan.');
		redirect(base_url().'jabatan');
	}
	public function jabatan_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('jabatan_nama');
		$deskripsi = $this->input->post('jabatan_desc');
        $urutan = $this->input->post('jabatan_level');
		$where = array(
			'jabatan_id' => $id
		);

		$data = array(
			'jabatan_nama' => $nama,
            'jabatan_level' => $urutan,
			'jabatan_desc' => $deskripsi
		);

		$this->m_data->update_data($where, $data,'master_jabatan');
		$this->session->set_flashdata('success', 'Berhasil mengubah data jabatan pegawai.');
		redirect(base_url().'jabatan');
	}
	public function jabatan_hapus($id)
	{
		$where = array(
			'jabatan_id' => $id
		);

		$this->m_data->delete_data($where,'master_jabatan');		
		$this->session->set_flashdata('success', 'Berhasil menghapus jabatan pegawai.');
		redirect(base_url().'jabatan');
	}
}
?>