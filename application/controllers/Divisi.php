<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Divisi extends CI_Controller {

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

    // CRUD DIVISI
	public function index()
	{
		//$data['divisi'] = $this->db->query("SELECT * FROM divisi ORDER BY divisi_nama")->result();

		$data['divisi'] = $this->db->select('*')
						  ->from('divisi as t1')
						  ->join('deputi as t2', 't1.deputi_id = t2.deputi_id', 'LEFT')
                          ->order_by("deputi_nama", "ASC")
						  ->get()
						  ->result();

		$this->load->view('template/v_header');
		$this->load->view('master/v_divisi',$data);
		$this->load->view('template/v_footer');
	}
	public function divisi_act()
	{				
		$nama = $this->input->post('nama_divisi');
		$deskripsi = $this->input->post('desc_divisi');
		$deputi = $this->input->post('deputi_id');
		
		if (!empty($deputi)) {
			$data = array(
				'divisi_nama' => $nama,
				'divisi_deskripsi' => $deskripsi,
				'deputi_id' => $deputi
			);
		}else {
			$data = array(
				'divisi_nama' => $nama,
				'divisi_deskripsi' => $deskripsi
			);
		}

		//cek nama
		$is_exist = $this->db->query("SELECT * FROM divisi WHERE divisi_nama = '$nama'")->num_rows(); 
		if ($is_exist != 0) {
			redirect(base_url().'divisi');
		}

		$this->m_data->insert_data($data,'divisi');
		$this->session->set_flashdata('success', 'Divisi berhasil ditambahkan.');
		redirect(base_url().'divisi');
	}
	public function divisi_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_divisi');
		$deskripsi = $this->input->post('desc_divisi');
		if (empty($this->input->post('deputi_id'))) {
			$deputi = NULL;
		}else {
			$deputi = $this->input->post('deputi_id');
		}
		
		$date = date('Y-m-d H:i:s');

		$where = array(
			'divisi_id' => $id
		);

		$data = array(
			'divisi_nama' => $nama,
			'divisi_deskripsi' => $deskripsi,
			'deputi_id' => $deputi,
			'edited_at' => $date
		);
		
		//cek nama
		$old_nama = $this->db->query("SELECT * FROM divisi WHERE divisi_id = '$id'")->row()->divisi_nama;
		if ($old_nama == $nama) {
			$this->m_data->update_data($where, $data,'divisi');
			$this->session->set_flashdata('success', 'Data Divisi berhasil diubah.');
			redirect(base_url().'divisi');
		}else {
			$is_exist = $this->db->query("SELECT * FROM divisi WHERE divisi_nama = '$nama'")->num_rows(); 
			if ($is_exist != 0) {
				$this->session->set_flashdata('error', 'Nama Divisi sudah digunakan!');
				redirect(base_url().'divisi');
			}
		}

		$this->m_data->update_data($where, $data,'divisi');
		$this->session->set_flashdata('success', 'Data Divisi berhasil diubah.');
		redirect(base_url().'divisi');
	}
	public function divisi_hapus($id)
	{
		$where = array(
			'divisi_id' => $id
		);

		//cek divisi bagian
		$is_exist = $this->db->query("SELECT * FROM divisi_bagian WHERE divisi_id = '$id'")->num_rows();
		if ($is_exist != 0) {
			redirect(base_url().'divisi');
		}

		$this->m_data->delete_data($where,'divisi');	
		$this->session->set_flashdata('success', 'Berhasil menghapus Divisi.');	
		redirect(base_url().'divisi');
	}

}
?>