<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Organisasi extends CI_Controller {

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

    public function index()
	{
        $data['kepala_badan'] = $this->db->select('t1.*, t2.*, t3.*, t4.*, t5.*, t6.*, t7.*, t8.pegawai_nama as atasan_langsung, t9.pegawai_nama as atasan_atasan')
                         ->from('pegawai_karir as t1')
                         ->where('t6.jabatan_nama', 'Kepala Badan')
                         ->where('t2.is_active', '1')
                         ->join('pegawai as t2', 't1.pegawai_id = t2.pegawai_id', 'LEFT')
                         ->join('master_pegawai_status as t3', 't1.status_pegawai_id = t3.status_pegawai_id', 'LEFT')
                         ->join('divisi as t4', 't1.divisi_id = t4.divisi_id', 'LEFT')
                         ->join('divisi_bagian as t5', 't1.divisi_bagian_id = t5.divisi_bagian_id', 'LEFT')
                         ->join('master_jabatan as t6', 't1.jabatan_id = t6.jabatan_id', 'LEFT')
                         ->join('master_pegawai_level as t7', 't1.level_id = t7.level_id', 'LEFT')
                         ->join('pegawai as t8', 't1.pegawai_atasan_langsung = t8.pegawai_id', 'LEFT')
                         ->join('pegawai as t9', 't1.pegawai_atasan_atasan = t9.pegawai_id', 'LEFT')
                         ->get()
                         ->row();
        
        $data['pegawais'] = $this->db->select('t1.*, t2.*, t3.*, t4.*, t5.*, t6.*, t7.*, t8.pegawai_nama as atasan_langsung, t9.pegawai_nama as atasan_atasan')
                         ->from('pegawai_karir as t1')
                         ->join('pegawai as t2', 't1.pegawai_id = t2.pegawai_id', 'LEFT')
                         ->join('master_pegawai_status as t3', 't1.status_pegawai_id = t3.status_pegawai_id', 'LEFT')
                         ->join('divisi as t4', 't1.divisi_id = t4.divisi_id', 'LEFT')
                         ->join('divisi_bagian as t5', 't1.divisi_bagian_id = t5.divisi_bagian_id', 'LEFT')
                         ->join('master_jabatan as t6', 't1.jabatan_id = t6.jabatan_id', 'LEFT')
                         ->join('master_pegawai_level as t7', 't1.level_id = t7.level_id', 'LEFT')
                         ->join('pegawai as t8', 't1.pegawai_atasan_langsung = t8.pegawai_id', 'LEFT')
                         ->join('pegawai as t9', 't1.pegawai_atasan_atasan = t9.pegawai_id', 'LEFT')
                         //->order_by("tgl_awal", "DESC")
                         ->order_by("t6.jabatan_level", "ASC")
                         ->order_by("t7.level", "ASC")
                         ->get()
                         ->result();
        
        $data['pegawai_deputi'] = $this->db->select('t1.*, t2.*, t3.*, t4.*, t5.*, t6.*, t7.*, t8.pegawai_nama as atasan_langsung, t9.pegawai_nama as atasan_atasan')
                         ->from('pegawai_karir as t1')
                         ->where('t6.jabatan_nama', 'Deputi')
                         ->join('pegawai as t2', 't1.pegawai_id = t2.pegawai_id', 'LEFT')
                         ->join('master_pegawai_status as t3', 't1.status_pegawai_id = t3.status_pegawai_id', 'LEFT')
                         ->join('divisi as t4', 't1.divisi_id = t4.divisi_id', 'LEFT')
                         ->join('divisi_bagian as t5', 't1.divisi_bagian_id = t5.divisi_bagian_id', 'LEFT')
                         ->join('master_jabatan as t6', 't1.jabatan_id = t6.jabatan_id', 'LEFT')
                         ->join('master_pegawai_level as t7', 't1.level_id = t7.level_id', 'LEFT')
                         ->join('pegawai as t8', 't1.pegawai_atasan_langsung = t8.pegawai_id', 'LEFT')
                         ->join('pegawai as t9', 't1.pegawai_atasan_atasan = t9.pegawai_id', 'LEFT')
                         ->order_by("tgl_awal", "DESC")
                         ->get()
                         ->result();

        $data['levels'] = $this->db->select('*')     
                          ->from('master_pegawai_level') 
                          ->get()
                          ->result(); 
        
        $data['deputis'] = $this->db->select('*')     
                        ->from('deputi') 
                        ->order_by("deputi_nama", "ASC")
                        ->get()
                        ->result();
                        
        $data['divisis'] = $this->db->select('*')     
                        ->from('divisi') 
                        ->get()
                        ->result();
        
        $data['bagians'] = $this->db->select('*')     
                        ->from('divisi_bagian') 
                        ->order_by("divisi_bagian_nama", "ASC")
                        ->get()
                        ->result();

		$this->load->view('template/v_header');
		$this->load->view('pegawai/v_struktur', $data);
		$this->load->view('template/v_footer');
	}
}
?>