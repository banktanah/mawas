<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Karier extends CI_Controller {

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

    public function karier($id)
	{

        $data['karier'] = $this->db->select('*')
						  ->from('pegawai_karir as t1')
                          ->where('t1.pegawai_id','$id')
						  ->join('pegawai as t2', 't1.pegawai_id = t2.pegawai_id', 'LEFT')
                          ->join('master_pegawai_status as t3', 't1.status_pegawai_id = t3.status_pegawai_id', 'LEFT')
                          ->join('divisi as t4', 't1.divisi_id = t4.divisi_id', 'LEFT')
                          ->join('divisi_bagian as t5', 't1.divisi_bagian_id = t5.divisi_bagian_id', 'LEFT')
                          ->join('master_jabatan as t6', 't1.jabatan_id = t6.jabatan_id', 'LEFT')
                          ->join('master_pegawai_level as t7', 't1.level_id = t7.level_id', 'LEFT')
                          ->order_by("tgl_awal", "DESC")
						  ->get()
						  ->result();

        return $data;
	}
    public function karier_act(){
        $pegawai_id = $this->input->post('pegawai_id');
        $data['pegawai_id'] = $pegawai_id;
        $pegawai = $this->db->query("SELECT * FROM pegawai WHERE pegawai_id = '$pegawai_id'")->row();
        $riwayat['pegawai_id'] = $pegawai_id;
        $riwayat['pegawai_nama'] = $pegawai->pegawai_nama;

		$status_id = $this->input->post('status_pegawai_id');
        $data['status_pegawai_id'] = $status_id;
        $status = $this->db->query("SELECT * FROM master_pegawai_status WHERE status_pegawai_id = '$status_id'")->row();
        $riwayat['pegawai_status'] = $status->status_nama;

		$posisi = $this->input->post('posisi_pegawai');
        $data['posisi_pegawai'] = $posisi;
        $riwayat['pegawai_posisi'] = $posisi;

        $atasan_langsung_id = $this->input->post('pegawai_atasan_langsung');
        if (!empty($atasan_langsung_id)){
            $data['pegawai_atasan_langsung'] = $atasan_langsung_id;
            $atasan_langsung = $this->db->query("SELECT * FROM pegawai WHERE pegawai_id = '$atasan_langsung_id'")->row();
            $riwayat['pegawai_atasan_langsung'] = $atasan_langsung->pegawai_nama;
        }

		$atasan_atasan_id = $this->input->post('pegawai_atasan_atasan');
        if (!empty($atasan_atasan_id)){
            $data['pegawai_atasan_atasan'] = $atasan_atasan_id;
            $atasan_atasan = $this->db->query("SELECT * FROM pegawai WHERE pegawai_id = '$atasan_atasan_id'")->row();
            $riwayat['pegawai_atasan_atasan'] = $atasan_atasan->pegawai_nama;
        }

		$divisi_id = $this->input->post('divisi_id');
        //echo "divisi id : ".$divisi_id;
        if (!empty($divisi_id)){
            //echo "asup divisi"; die();
            $data['divisi_id'] = $divisi_id;
            $divisi = $this->db->query("SELECT * FROM divisi WHERE divisi_id = '$divisi_id'")->row();
            $riwayat['pegawai_divisi'] = $divisi->divisi_nama;

            //echo "divisi id : ".$data['divisi_id'];

            //Cari Deputi
            $data['deputi_id'] = $divisi->deputi_id;
            $deputi = $this->db->query("SELECT * FROM deputi WHERE deputi_id = '$divisi->deputi_id'")->row();
            $riwayat['pegawai_deputi'] = $deputi->deputi_nama;
        }

        $divisi_bagian_id = $this->input->post('divisi_bagian_id');
        //echo "divisi bagian id : ".$divisi_bagian_id; 
        if (!empty($divisi_bagian_id)){
            //echo "asup divisi bagian"; die();
            $data['divisi_bagian_id'] = $divisi_bagian_id;
            $divisi_bagian = $this->db->query("SELECT * FROM divisi_bagian WHERE divisi_bagian_id = '$divisi_bagian_id'")->row();
            $riwayat['pegawai_divisi_bagian'] = $divisi_bagian->divisi_bagian_nama;
        }
        // print_r($data); die();

        //Jika Jabatan Deputi
        $deputi_id = $this->input->post('deputi_id');
        if (!empty($deputi_id)){
            $data['deputi_id'] = $deputi_id;
            $deputi = $this->db->query("SELECT * FROM deputi WHERE deputi_id = '$deputi_id'")->row();
            $riwayat['pegawai_deputi'] = $deputi->deputi_nama;
        }

		$jabatan_id = $this->input->post('jabatan_id');
        $data['jabatan_id'] = $jabatan_id;
        $jabatan = $this->db->query("SELECT * FROM master_jabatan WHERE jabatan_id = '$jabatan_id'")->row();
        $riwayat['pegawai_jabatan'] = $jabatan->jabatan_nama;

		$level_id = $this->input->post('level_id');
        if (!empty($level_id)){
            $data['level_id'] = $level_id;
            $level = $this->db->query("SELECT * FROM master_pegawai_level WHERE level_id = '$level_id'")->row();
            $riwayat['pegawai_level'] = $level->level_nama;
        }

        $awal = $this->input->post('tgl_awal');
        $data['tgl_awal'] = $awal;
        $riwayat['tgl_awal'] = $awal;

        $akhir = $this->input->post('tgl_akhir');
        if (!empty($akhir)) {
            $data['tgl_akhir'] = $akhir;
            $riwayat['tgl_akhir'] = $akhir;
        }

        $data['created_by'] = $this->session->userdata('nama');
        $riwayat['created_by'] = $this->session->userdata('nama');

        $perolehan = $this->input->post('lokasi');
        if ($perolehan == "9999") {
            $data['perolehan_id'] = $this->input->post('lokasi');
            $data['penempatan'] = "Kantor Pusat - JAKARTA";
            $riwayat['perolehan_id'] = $this->input->post('lokasi');
            $riwayat['penempatan'] = "Kantor Pusat - JAKARTA";
        }else {
            //GET PEROLEHAN VIA API
            //URL
            $api_url = 'http://localhost/instapro/services/get_perolehan?perolehan_id='.$perolehan;

            // Read JSON file
            $json_data = file_get_contents($api_url);

            // Decode JSON data into PHP array
            $perolehan_result = json_decode($json_data);

            $perolehan_lokasi = "";

            foreach ($perolehan_result as $p) {
                $perolehan_lokasi = $p->kelurahan." - ".$p->kota_nama;
                break;
            }
            
            $data['perolehan_id'] = $this->input->post('lokasi');
            $data['penempatan'] = $perolehan_lokasi;
            $riwayat['perolehan_id'] = $this->input->post('lokasi');
            $riwayat['penempatan'] = $perolehan_lokasi;
        }

        //print_r($data); die();

        $this->m_data->insert_data($data,'pegawai_karir');

        $karir_id = $this->m_data->edit_data($data,'pegawai_karir')->row()->karir_id;
        $riwayat['karir_id'] = $karir_id;
        $this->m_data->insert_data($riwayat,'pegawai_karir_riwayat');

		$this->session->set_flashdata('success', 'Berhasil menambahkan karier pegawai.');
		redirect(base_url().'pegawai');
    }
    public function karier_edit($id){
        // $pegawai_id = $this->input->post('pegawai_id');
        // $data['pegawai_id'] = $pegawai_id;

		$status_id = $this->input->post('status_pegawai_id');
        $data['status_pegawai_id'] = $status_id;
        $status = $this->db->query("SELECT * FROM master_pegawai_status WHERE status_pegawai_id = '$status_id'")->row();
        $riwayat['pegawai_status'] = $status->status_nama;

		$posisi = $this->input->post('posisi_pegawai');
        $data['posisi_pegawai'] = $posisi;
        $riwayat['pegawai_posisi'] = $posisi;

        $atasan_langsung_id = $this->input->post('pegawai_atasan_langsung');
        if (!empty($atasan_langsung_id)){
            $data['pegawai_atasan_langsung'] = $atasan_langsung_id;
            $atasan_langsung = $this->db->query("SELECT * FROM pegawai WHERE pegawai_id = '$atasan_langsung_id'")->row();
            $riwayat['pegawai_atasan_langsung'] = $atasan_langsung->pegawai_nama;
        }

		$atasan_atasan_id = $this->input->post('pegawai_atasan_atasan');
        if (!empty($atasan_atasan_id)){
            $data['pegawai_atasan_atasan'] = $atasan_atasan_id;
            $atasan_atasan = $this->db->query("SELECT * FROM pegawai WHERE pegawai_id = '$atasan_atasan_id'")->row();
            $riwayat['pegawai_atasan_atasan'] = $atasan_atasan->pegawai_nama;
        }

		$divisi_id = $this->input->post('divisi_id');
        if (!empty($divisi_id)){
            $data['divisi_id'] = $divisi_id;
            $divisi = $this->db->query("SELECT * FROM divisi WHERE divisi_id = '$divisi_id'")->row();
            $riwayat['pegawai_divisi'] = $divisi->divisi_nama;

            //Cari Deputi
            $data['deputi_id'] = $divisi->deputi_id;
            $deputi = $this->db->query("SELECT * FROM deputi WHERE deputi_id = '$divisi->deputi_id'")->row();
            $riwayat['pegawai_deputi'] = $deputi->deputi_nama;
        }

        $divisi_bagian_id = $this->input->post('divisi_bagian_id');
        if (!empty($divisi_bagian_id)){
            $data['divisi_bagian_id'] = $divisi_bagian_id;
            $divisi_bagian = $this->db->query("SELECT * FROM divisi_bagian WHERE divisi_bagian_id = '$divisi_bagian_id'")->row();
            $riwayat['pegawai_divisi_bagian'] = $divisi_bagian->divisi_bagian_nama;
        }

        //Jika Jabatan Deputi
        $deputi_id = $this->input->post('deputi_id');
        if (!empty($deputi_id)){
            $data['deputi_id'] = $deputi_id;
            $deputi = $this->db->query("SELECT * FROM deputi WHERE deputi_id = '$deputi_id'")->row();
            $riwayat['pegawai_deputi'] = $deputi->deputi_nama;
        }

		$jabatan_id = $this->input->post('jabatan_id');
        $data['jabatan_id'] = $jabatan_id;
        $jabatan = $this->db->query("SELECT * FROM master_jabatan WHERE jabatan_id = '$jabatan_id'")->row();
        $riwayat['pegawai_jabatan'] = $jabatan->jabatan_nama;

		$level_id = $this->input->post('level_id');
        if (!empty($level_id)){
            $data['level_id'] = $level_id;
            $level = $this->db->query("SELECT * FROM master_pegawai_level WHERE level_id = '$level_id'")->row();
            $riwayat['pegawai_level'] = $level->level_nama;
        }

        $awal = $this->input->post('tgl_awal');
        $data['tgl_awal'] = $awal;
        $riwayat['tgl_awal'] = $awal;

        $akhir = $this->input->post('tgl_akhir');
        if (!empty($akhir)) {
            $data['tgl_akhir'] = $akhir;
            $riwayat['tgl_akhir'] = $akhir;
        }

        $data['edited_by'] = $this->session->userdata('nama');
        $riwayat['edited_by'] = $this->session->userdata('nama');
        $riwayat['edited_at'] = date('Y-m-d H:i:s');

        $perolehan = $this->input->post('lokasi');
        if ($perolehan == "9999") {
            $data['perolehan_id'] = $this->input->post('lokasi');
            $data['penempatan'] = "Kantor Pusat - JAKARTA";
            $riwayat['perolehan_id'] = $this->input->post('lokasi');
            $riwayat['penempatan'] = "Kantor Pusat - JAKARTA";
        }else {
            //GET PEROLEHAN VIA API
            //URL
            $api_url = 'http://localhost/instapro/services/get_perolehan?perolehan_id='.$perolehan;

            // Read JSON file
            $json_data = file_get_contents($api_url);

            // Decode JSON data into PHP array
            $perolehan_result = json_decode($json_data);

            $perolehan_lokasi = "";

            foreach ($perolehan_result as $p) {
                $perolehan_lokasi = $p->kelurahan." - ".$p->kota_nama;
                break;
            }
            
            $data['perolehan_id'] = $this->input->post('lokasi');
            $data['penempatan'] = $perolehan_lokasi;
            $riwayat['perolehan_id'] = $this->input->post('lokasi');
            $riwayat['penempatan'] = $perolehan_lokasi;
        }

        $where['karir_id'] = $id;
        $this->m_data->update_data($where,$data,'pegawai_karir');
        $this->m_data->update_data($where,$riwayat,'pegawai_karir_riwayat');
		
        $this->session->set_flashdata('success', 'Berhasil mengubah karier pegawai.');
		redirect(base_url().'pegawai');
    }
    public function karier_nonaktif($id){
        $where = array(
			'karir_id' => $id
		);

		$this->m_data->delete_data($where,'pegawai_karir');

        $riwayat['tgl_akhir'] = date('Y-m-d H:i:s');
        $riwayat['deleted_at'] = date('Y-m-d H:i:s');
        $this->m_data->update_data($where,$riwayat,'pegawai_karir_riwayat');

		$this->session->set_flashdata('success', 'Berhasil menonaktifkan karier.');
		redirect(base_url().'pegawai');
    }
    public function karier_hapus($id){
        $where = array(
			'karir_id' => $id
		);

		$this->m_data->delete_data($where,'pegawai_karir');
        $this->m_data->delete_data($where,'pegawai_karir_riwayat');
		$this->session->set_flashdata('success', 'Berhasil menonaktifkan karier.');
		redirect(base_url().'pegawai');
    }
    public function karier_riwayat($id){
        $data['pegawai'] = $this->db->query("SELECT * FROM pegawai WHERE pegawai_id = '$id'")->row();
        $data['riwayats'] = $this->db->query("SELECT * FROM pegawai_karir_riwayat WHERE pegawai_id = '$id' ORDER BY tgl_awal DESC")->result();

        $this->load->view('template/v_header');
		$this->load->view('pegawai/v_riwayat',$data);
		$this->load->view('template/v_footer');
    }

}
?>