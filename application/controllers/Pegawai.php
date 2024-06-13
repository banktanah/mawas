<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pegawai extends CI_Controller {
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

    // CRUD pegawai
	public function index()
	{
		if (!empty($_GET['is_active'])) {

			$is_active = $_GET['is_active'];
			$data['active'] = $is_active;

			if ($is_active == "ALL") {

				$data['pegawais'] = $this->db->select('*')
							  	  ->from('pegawai as t1')
							  	  ->join('master_pendidikan as t2', 't1.pendidikan_id = t2.pendidikan_id', 'LEFT')
							   	  ->order_by("pegawai_nama", "ASC")
							  	  ->get()
							      ->result();
								  
			}else {

				if ($is_active == "TRUE") {
					$active = 1;
				}else {
					$active = 0;
				}

				$data['pegawais'] = $this->db->select('*')
							  		->from('pegawai as t1')
							  		->where('t1.is_active', $active)
							  		->join('master_pendidikan as t2', 't1.pendidikan_id = t2.pendidikan_id', 'LEFT')
							  		->order_by("pegawai_nama", "ASC")
							  		->get()
									->result();
			}
			
		}else {
			$data['active'] = "TRUE";
			$data['pegawais'] = $this->db->select('*')
							  ->from('pegawai as t1')
							  ->where('t1.is_active', 1)
							  ->join('master_pendidikan as t2', 't1.pendidikan_id = t2.pendidikan_id', 'LEFT')
							  ->order_by("pegawai_nama", "ASC")
							  ->get()
							  ->result();
		}

		//GET PEROLEHAN VIA API
		//URL
		$api_url = $_ENV['API_INSTAPRO'];
		// Read JSON file
		// $json_data = file_get_contents($api_url);
		// Decode JSON data into PHP array
		// $perolehans = json_decode($json_data);

		// $data['perolehans'] = $perolehans;

		$this->load->view('template/v_header');
		$this->load->view('pegawai/v_pegawai',$data);
		$this->load->view('template/v_footer');
	}
	public function pegawai_act()
	{
		$nama = $this->input->post('pegawai_nama');
		$data['pegawai_nama'] = $nama;

		$nik = $this->input->post('pegawai_nik');
		$data['pegawai_nik'] = $nik;

		$tempat_lahir = $this->input->post('pegawai_tempat_lahir');
		$data['pegawai_tempat_lahir'] = $tempat_lahir;

		$tgl_lahir = $this->input->post('pegawai_tgl_lahir');
		if (!empty($tgl_lahir)) {
			$data['pegawai_tgl_lahir'] = $tgl_lahir;
		}

		$gender = $this->input->post('pegawai_gender');
		$data['pegawai_gender'] = $gender;

		$pendidikan = $this->input->post('pegawai_pendidikan');
		$data['pendidikan_id'] = $pendidikan;

		$agama = $this->input->post('pegawai_agama');
		$data['pegawai_agama'] = $agama;

		$kewarganegaraan = $this->input->post('pegawai_kewarganegaraan');
		$data['pegawai_kewarganegaraan'] = $kewarganegaraan;

		$pernikahan = $this->input->post('pegawai_pernikahan');
		$data['pegawai_pernikahan'] = $pernikahan;

		$alamat = $this->input->post('pegawai_alamat');
		$data['pegawai_alamat'] = $alamat;

		$kota = $this->input->post('pegawai_kota');
		$data['pegawai_kota'] = $kota;

		$provinsi = $this->input->post('pegawai_provinsi');
		$data['pegawai_provinsi'] = $provinsi;

		$pos = $this->input->post('pegawai_pos');
		$data['pegawai_pos'] = $pos;

		$telepon = $this->input->post('pegawai_telepon');
		$data['pegawai_telepon'] = $telepon;

		$email_pribadi = $this->input->post('pegawai_email_pribadi');
		$data['pegawai_email_pribadi'] = $email_pribadi;

		$nip = $this->input->post('pegawai_nip');
		$data['pegawai_nip'] = $nip;

		$tgl_gabung = $this->input->post('pegawai_tgl_gabung');
		if (!empty($tgl_gabung)) {
			$data['pegawai_tgl_gabung'] = $tgl_gabung;
		}

		$tgl_keluar = $this->input->post('pegawai_tgl_keluar');
		if (!empty($tgl_keluar)) {
			$data['pegawai_tgl_keluar'] = $tgl_keluar;
		}

		$email_kantor = $this->input->post('pegawai_email_kantor');
		$data['pegawai_email_kantor'] = $email_kantor ;

		$npwp = $this->input->post('pegawai_npwp');
		$data['pegawai_npwp'] = $npwp;

		$data['created_by'] = $this->session->userdata('nama');

		//Image Upload
		$config['upload_path']   = './gambar/pegawai/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '100000';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		$nama_foto = $_FILES['foto']['name'];

		if($nama_foto==""){
			// $data = array(
			// 	'pegawai_nama' => $nama,
			// 	'pegawai_nip' => $nip,
			// 	'pegawai_tgl_lahir' => $tgl_lahir,
			// 	'pegawai_gender' => $gender,
			// 	'pegawai_domisili' => $domisili,
			// 	'pegawai_pendidikan' => $pendidikan,
			// 	'pegawai_divisi' => $divisi,
			// 	'pegawai_divisi_bagian' => $divisi_bagian,
			// 	'pegawai_email' => $email,
			// 	'pegawai_status' => $status,
			// 	'pegawai_tgl_gabung' => $tgl_gabung,
			// 	'pegawai_level' => $jabatan			
			// );
			$this->m_data->insert_data($data,'pegawai');
			$this->session->set_flashdata('success', 'Pegawai berhasil ditambahkan.');
			redirect(base_url().'pegawai');
		}else{
			if($this->upload->do_upload('foto')) {
				$data_upload = $this->upload->data();
				$data_file = $data_upload['file_name'];
				$foto_path = 'http://'.$_SERVER['HTTP_HOST'].'/mawas/gambar/pegawai/'.$data_file;
				$data['pegawai_foto'] = $foto_path;

				// $data = array(
				// 	'pegawai_nama' => $nama,
				// 	'pegawai_nip' => $nip,
				// 	'pegawai_tgl_lahir' => $tgl_lahir,
				// 	'pegawai_gender' => $gender,
				// 	'pegawai_domisili' => $domisili,
				// 	'pegawai_pendidikan' => $pendidikan,
				// 	'pegawai_divisi' => $divisi,
				// 	'pegawai_divisi_bagian' => $divisi_bagian,
				// 	'pegawai_email' => $email,
				// 	'pegawai_status' => $status,
				// 	'pegawai_tgl_gabung' => $tgl_gabung,
				// 	'pegawai_level' => $jabatan,
				// 	'pegawai_foto'=>$foto_path
				// );
				$this->m_data->insert_data($data,'pegawai');
				$this->session->set_flashdata('success', 'Pegawai berhasil ditambahkan.');
				redirect(base_url().'pegawai');

			}else{			
				$this->session->set_flashdata('error', 'Gagal menambahkan pegawai!');
				redirect(base_url().'pegawai');
			}
		}
	}
	public function pegawai_update()
	{		
		$id = $this->input->post('id');
		
		$nama = $this->input->post('pegawai_nama');
		$data['pegawai_nama'] = $nama;

		$nik = $this->input->post('pegawai_nik');
		$data['pegawai_nik'] = $nik;

		$tempat_lahir = $this->input->post('pegawai_tempat_lahir');
		$data['pegawai_tempat_lahir'] = $tempat_lahir;

		$tgl_lahir = $this->input->post('pegawai_tgl_lahir');
		if (!empty($tgl_lahir)) {
			$data['pegawai_tgl_lahir'] = $tgl_lahir;
		}

		$gender = $this->input->post('pegawai_gender');
		$data['pegawai_gender'] = $gender;

		$pendidikan = $this->input->post('pegawai_pendidikan');
		$data['pendidikan_id'] = $pendidikan;

		$agama = $this->input->post('pegawai_agama');
		$data['pegawai_agama'] = $agama;

		$kewarganegaraan = $this->input->post('pegawai_kewarganegaraan');
		$data['pegawai_kewarganegaraan'] = $kewarganegaraan;

		$pernikahan = $this->input->post('pegawai_pernikahan');
		$data['pegawai_pernikahan'] = $pernikahan;

		$alamat = $this->input->post('pegawai_alamat');
		$data['pegawai_alamat'] = $alamat;

		$kota = $this->input->post('pegawai_kota');
		$data['pegawai_kota'] = $kota;

		$provinsi = $this->input->post('pegawai_provinsi');
		$data['pegawai_provinsi'] = $provinsi;

		$pos = $this->input->post('pegawai_pos');
		$data['pegawai_pos'] = $pos;

		$telepon = $this->input->post('pegawai_telepon');
		$data['pegawai_telepon'] = $telepon;

		$email_pribadi = $this->input->post('pegawai_email_pribadi');
		$data['pegawai_email_pribadi'] = $email_pribadi;

		$nip = $this->input->post('pegawai_nip');
		$data['pegawai_nip'] = $nip;

		$tgl_gabung = $this->input->post('pegawai_tgl_gabung');
		if (!empty($tgl_gabung)) {
			$data['pegawai_tgl_gabung'] = $tgl_gabung;
		}

		$tgl_keluar = $this->input->post('pegawai_tgl_keluar');
		if (!empty($tgl_keluar)) {
			$data['pegawai_tgl_keluar'] = $tgl_keluar;
		}

		$email_kantor = $this->input->post('pegawai_email_kantor');
		$data['pegawai_email_kantor'] = $email_kantor ;

		$npwp = $this->input->post('pegawai_npwp');
		$data['pegawai_npwp'] = $npwp;

		$data['edited_by'] = $this->session->userdata('nama');
        $data['edited_at'] = date('Y-m-d H:i:s');
		//

		$config['upload_path']   = './gambar/pegawai/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '100000';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		$nama_foto = $_FILES['foto']['name'];

		if ($nama_foto == "") {
			// $data = array(
			// 	'pegawai_nama' => $nama,
			// 	'pegawai_nip' => $nip,
			// 	'pegawai_tgl_lahir' => $tgl_lahir,
			// 	'pegawai_gender' => $gender,
			// 	'pegawai_domisili' => $domisili,
			// 	'pegawai_pendidikan' => $pendidikan,
			// 	'pegawai_divisi' => $divisi,
			// 	'pegawai_divisi_bagian' => $divisi_bagian,
			// 	'pegawai_email' => $email,
			// 	'pegawai_status' => $status,
			// 	'pegawai_tgl_gabung' => $tgl_gabung,
			// 	'pegawai_level' => $jabatan
			// );
	
			$where = array(
				'pegawai_id' => $id
			);
			$this->m_data->update_data($where,$data,'pegawai');
			$this->session->set_flashdata('success', 'Data pegawai berhasil diubah.');
			redirect(base_url().'pegawai');
		}else {
			if($this->upload->do_upload('foto')) {

				$data_upload = $this->upload->data();
				$data_file = $data_upload['file_name'];
				$foto_path = 'http://'.$_SERVER['HTTP_HOST'].'/mawas/gambar/pegawai/'.$data_file;
				$data['pegawai_foto'] = $foto_path;

				// $data = array(
				// 	'pegawai_nama' => $nama,
				// 	'pegawai_nip' => $nip,
				// 	'pegawai_tgl_lahir' => $tgl_lahir,
				// 	'pegawai_gender' => $gender,
				// 	'pegawai_domisili' => $domisili,
				// 	'pegawai_pendidikan' => $pendidikan,
				// 	'pegawai_divisi' => $divisi,
				// 	'pegawai_divisi_bagian' => $divisi_bagian,
				// 	'pegawai_email' => $email,
				// 	'pegawai_status' => $status,
				// 	'pegawai_tgl_gabung' => $tgl_gabung,
				// 	'pegawai_level' => $jabatan,
				// 	'pegawai_foto'=>$foto_path
				// );
				
				$where = array(
					'pegawai_id' => $id
				);
				$this->m_data->update_data($where,$data,'pegawai');
				$this->session->set_flashdata('success', 'Data pegawai berhasil diubah.');
				redirect(base_url().'pegawai');

			}else{			
				// $this->load->view('dashboard/v_header');
				// $this->load->view('dashboard/v_pegawai');
				// $this->load->view('dashboard/v_footer');

				redirect(base_url().'pegawai');
			}
		}
		
	}
	public function pegawai_activate($id)
	{
		$where = array(
			'pegawai_id' => $id
		);

		$data['is_active'] = 1;
        $data['edited_by'] = $this->session->userdata('nama');
        $data['edited_at'] = date('Y-m-d H:i:s');

		$this->m_data->update_data($where,$data,'pegawai');

		$this->session->set_flashdata('success', 'Pegawai berhasil diaktifkan kembali.');
		redirect(base_url().'pegawai');
	}
	public function pegawai_deactivate($id)
	{
		$where = array(
			'pegawai_id' => $id
		);
		$cek = $this->db->query("SELECT * from pegawai where pegawai_id ='$id'")->row();
		$foto = $cek->pegawai_foto;
		$path = './gambar/pegawai/';

		$data['is_active'] = 0;
        $data['deleted_by'] = $this->session->userdata('nama');
        $data['deleted_at'] = date('Y-m-d H:i:s');
		//unlink($path.$foto);

		//True Delete
		//$this->m_data->delete_data($where,'pegawai');

		//Soft Delete
		$this->m_data->update_data($where,$data,'pegawai');

		//Hapus Akun
		$akun = $this->db->query("SELECT * FROM user WHERE pegawai_id = '$id'")->row();
		if (!empty($akun)) {
			$user['user_id'] = $akun->user_id;

			//Hapus Akses
			$akses = $this->db->query("SELECT * FROM akses WHERE user_id = '$akun->user_id'")->result();
			if (!empty($akses)) {
				foreach ($akses as $ak) {
					$this->db->query("DELETE FROM akses WHERE akses_id = '$ak->akses_id'");
				}
			}

			$this->m_data->delete_data($user,'user');
		}

		//Nonaktifkan Karir
		$kariers = $this->db->query("SELECT * FROM pegawai_karir WHERE pegawai_id = '$id'")->result();
		if (!empty($kariers)) {
			foreach ($kariers as $k) {

				$where = array(
					'karir_id' => $k->karir_id
				);
		
				$this->m_data->delete_data($where,'pegawai_karir');
			}
		}

		//Hapus Relasi Jabatan (Atasan Langsung)
		$atasan_langsung = $this->db->query("SELECT * FROM pegawai_karir WHERE pegawai_atasan_langsung = '$id'")->result();
		if (!empty($atasan_langsung)) {
			foreach ($atasan_langsung as $al) {
				$where1 = array(
					'karir_id' => $al->karir_id
				);

				$data1['pegawai_atasan_langsung'] = NULL;

				$this->m_data->update_data($where1,$data1,'pegawai_karir');
			}
		}

		//Hapus Relasi Jabatan (Atasan Atasan)
		$atasan_atasan = $this->db->query("SELECT * FROM pegawai_karir WHERE pegawai_atasan_atasan = '$id'")->result();
		if (!empty($atasan_atasan)) {
			foreach ($atasan_atasan as $aa) {
				$where2 = array(
					'karir_id' => $aa->karir_id
				);

				$data2['pegawai_atasan_atasan'] = NULL;

				$this->m_data->update_data($where2,$data2,'pegawai_karir');
			}
		}

		$riwayat['tgl_akhir'] = date('Y-m-d H:i:s');
		$riwayat['deleted_at'] = date('Y-m-d H:i:s');
		$this->m_data->update_data($where,$riwayat,'pegawai_karir_riwayat');

		$this->session->set_flashdata('success', 'Pegawai berhasil dinonaktifkan.');
		redirect(base_url().'pegawai');
	}
	public function pegawai_hapus($id)
	{
		$where = array(
			'pegawai_id' => $id
		);

		//True Delete
		$this->m_data->delete_data($where,'pegawai');

		//Bersihkan Riwayat
		$this->db->query("DELETE FROM pegawai_karir_riwayat WHERE pegawai_id = '$id'");

		$this->session->set_flashdata('success', 'Pegawai berhasil dihapus.');
		redirect(base_url().'pegawai?is_active=FALSE');
	}

	function get_email(){
		$id = $this->input->post('id',TRUE);
		$data = $this->db->query("SELECT * from pegawai WHERE pegawai_id='$id'")->row();
		if (!empty($data)) { 
			echo $data->pegawai_email_kantor;
		}
	}
}
?>