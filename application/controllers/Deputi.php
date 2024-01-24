<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Deputi extends CI_Controller {

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
		$data['deputi'] = $this->db->query("SELECT * FROM deputi ORDER BY deputi_nama")->result();


		$this->load->view('template/v_header');
		$this->load->view('master/v_deputi',$data);
		$this->load->view('template/v_footer');
	}
	public function deputi_act()
	{				
		$nama = $this->input->post('nama_deputi');
		$deskripsi = $this->input->post('desc_deputi');
		$data = array(			
			'deputi_nama' => $nama,
			'deputi_deskripsi' => $deskripsi
		);

		//cek nama
		$is_exist = $this->db->query("SELECT * FROM deputi WHERE deputi_nama = '$nama'")->num_rows(); 
		if ($is_exist != 0) {
			redirect(base_url().'deputi');
		}

		$this->m_data->insert_data($data,'deputi');
		$this->session->set_flashdata('success', 'Deputi berhasil ditambahkan.');
		redirect(base_url().'deputi');
	}
	public function deputi_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_deputi');
		$deskripsi = $this->input->post('desc_deputi');
		$date = date('Y-m-d H:i:s');

		$where = array(
			'deputi_id' => $id
		);

		$data = array(
			'deputi_nama' => $nama,
			'deputi_deskripsi' => $deskripsi,
			'edited_at' => $date
		);

		//cek nama
		$old_nama = $this->db->query("SELECT * FROM deputi WHERE deputi_id = '$id'")->row()->deputi_nama;
		if ($old_nama == $nama) {
			$this->m_data->update_data($where, $data,'deputi');
			$this->session->set_flashdata('success', 'Data Deputi berhasil diubah.');
			redirect(base_url().'deputi');
		}else {
			$is_exist = $this->db->query("SELECT * FROM deputi WHERE deputi_nama = '$nama'")->num_rows(); 
			if ($is_exist != 0) {
				$this->session->set_flashdata('error', 'Nama Deputi sudah digunakan!');
				redirect(base_url().'deputi');
			}
		}

		$this->m_data->update_data($where, $data,'deputi');
		$this->session->set_flashdata('success', 'Data Deputi berhasil diubah.');
		redirect(base_url().'deputi');
	}
	public function deputi_hapus($id)
	{
		$where = array(
			'deputi_id' => $id
		);

		//cek divisi bagian
		$is_exist = $this->db->query("SELECT * FROM divisi WHERE deputi_id = '$id'")->num_rows();
		if ($is_exist != 0) {
			redirect(base_url().'deputi');
		}

		$this->m_data->delete_data($where,'deputi');	
		$this->session->set_flashdata('success', 'Berhasil menghapus deputi.');	
		redirect(base_url().'deputi');
	}

}
?>