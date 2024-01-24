<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pendidikan extends CI_Controller {

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

    // CRUD PENDIDIKAN
	public function index()
	{
		$data['pendidikan'] = $this->db->query('SELECT * FROM master_pendidikan ORDER BY urutan')->result();
		$this->load->view('template/v_header');
		$this->load->view('master/v_pendidikan',$data);
		$this->load->view('template/v_footer');
	}
	public function pendidikan_act()
	{				
		$nama = $this->input->post('nama_pendidikan');
		$deskripsi = $this->input->post('desc_pendidikan');
		$data = array(			
			'pendidikan_nama' => $nama,
			'pendidikan_deskripsi' => $deskripsi
		);

		$this->m_data->insert_data($data,'master_pendidikan');
		$this->session->set_flashdata('success', 'Pendidikan berhasil ditambahkan.');
		redirect(base_url().'pendidikan');
	}
	public function pendidikan_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_pendidikan');
		$deskripsi = $this->input->post('desc_pendidikan');
		$where = array(
			'pendidikan_id' => $id
		);

		$data = array(
			'pendidikan_nama' => $nama,
			'pendidikan_deskripsi' => $deskripsi
		);

		$this->m_data->update_data($where, $data,'master_pendidikan');
		$this->session->set_flashdata('success', 'Data Pendidikan berhasil diubah.');
		redirect(base_url().'pendidikan');
	}
	public function pendidikan_hapus($id)
	{
		$where = array(
			'pendidikan_id' => $id
		);

		$this->m_data->delete_data($where,'master_pendidikan');	
		$this->session->set_flashdata('success', 'Berhasil menghapus pendidikan.');	
		redirect(base_url().'pendidikan');
	}

}
?>