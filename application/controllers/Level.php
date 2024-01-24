<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Level extends CI_Controller {

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
		$data['levels'] = $this->db->query('SELECT * FROM master_pegawai_level ORDER BY level')->result();
		$this->load->view('template/v_header');
		$this->load->view('master/v_level_pegawai',$data);
		$this->load->view('template/v_footer');
	}	
	public function level_pegawai_act()
	{				
		$nama = $this->input->post('level_nama');
		$deskripsi = $this->input->post('level_desc');
        $urutan = $this->input->post('level_urutan');
		$data = array(			
			'level_nama' => $nama,
            'level' => $urutan,
			'level_desc' => $deskripsi
		);

		$this->m_data->insert_data($data,'master_pegawai_level');
		$this->session->set_flashdata('success', 'Level berhasil ditambahkan.');
		redirect(base_url().'level');
	}
	public function level_pegawai_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('level_nama');
		$deskripsi = $this->input->post('level_desc');
        $urutan = $this->input->post('level_urutan');
		$where = array(
			'level_id' => $id
		);

		$data = array(
			'level_nama' => $nama,
            'level' => $urutan,
			'level_desc' => $deskripsi
		);

		$this->m_data->update_data($where, $data,'master_pegawai_level');
		$this->session->set_flashdata('success', 'Berhasil mengubah data level pegawai.');
		redirect(base_url().'level');
	}
	public function level_pegawai_hapus($id)
	{
		$where = array(
			'level_id' => $id
		);

		$this->m_data->delete_data($where,'master_pegawai_level');		
		$this->session->set_flashdata('success', 'Berhasil menghapus level pegawai.');
		redirect(base_url().'level');
	}
}
?>