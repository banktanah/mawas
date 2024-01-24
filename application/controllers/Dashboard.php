<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends CI_Controller {

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
		$this->load->view('template/v_header');
		$this->load->view('dashboard/v_index');
		$this->load->view('template/v_footer');
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('welcome/?alert=logout');
	}

	public function ganti_password()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_ganti_password');
		$this->load->view('dashboard/v_footer');
	}

	public function ganti_password_aksi()
	{

		// form validasi
		$this->form_validation->set_rules('password_lama','Password Lama','required');
		$this->form_validation->set_rules('password_baru','Password Baru','required|min_length[8]');
		$this->form_validation->set_rules('konfirmasi_password','Konfirmasi Password Baru','required|matches[password_baru]');

		// cek validasi
		if($this->form_validation->run() != false){

			// menangkap data dari form
			$password_lama = $this->input->post('password_lama');
			$password_baru = $this->input->post('password_baru');
			$konfirmasi_password = $this->input->post('konfirmasi_password');

			// cek kesesuaian password lama dengan id pengguna yang sedang login dan password lama
			$where = array(
				'user_id' => $this->session->userdata('id'),
				'user_password' => md5($password_lama)
			);
			$cek = $this->m_data->cek_login('user', $where)->num_rows();

			// cek kesesuaikan password lama
			if($cek > 0){

				// update data password superadmin
				$w = array(
					'user_id' => $this->session->userdata('id')
				);
				$data = array(
					'user_password' => md5($password_baru)
				);
				$this->m_data->update_data($where, $data, 'user');

				// alihkan halaman kembali ke halaman ganti password
				redirect('dashboard/ganti_password?alert=sukses');
			}else{
				// alihkan halaman kembali ke halaman ganti password
				redirect('dashboard/ganti_password?alert=gagal');
			}

		}else{
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_ganti_password');
			$this->load->view('dashboard/v_footer');
		}

	}

	//STRUKTUR ORGANISASI
	public function struktur()
	{
		//$data['struktur'] = $this->m_data->get_data('struktur')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_struktur');
		$this->load->view('dashboard/v_footer');
	}

	// CRUD DIVISI BAGIAN
	public function divisi_bagian()
	{
		$data['divisi_bagian'] = $this->m_data->get_data('divisi_bagian')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_divisi_bagian',$data);
		$this->load->view('dashboard/v_footer');
	}
	public function divisi_bagian_act()
	{				
		$nama = $this->input->post('nama_divisi_bagian');
		$deskripsi = $this->input->post('desc_divisi_bagian');
		$divisi = $this->input->post('divisi_id');

		$data = array(			
			'divisi_bagian_nama' => $nama,
			'divisi_bagian_deskripsi' => $deskripsi,
			'divisi_id' => $divisi
		);

		$this->m_data->insert_data($data,'divisi_bagian');
		redirect(base_url().'dashboard/divisi_bagian');
	}
	public function divisi_bagian_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_divisi_bagian');
		$deskripsi = $this->input->post('desc_divisi_bagian');
		$divisi = $this->input->post('divisi_id');

		$where = array(
			'divisi_bagian_id' => $id
		);

		$data = array(
			'divisi_bagian_nama' => $nama,
			'divisi_bagian_deskripsi' => $deskripsi,
			'divisi_id' => $divisi
		);

		$this->m_data->update_data($where, $data,'divisi_bagian');
		redirect(base_url().'dashboard/divisi_bagian');
	}
	public function divisi_bagian_hapus($id)
	{
		$where = array(
			'divisi_bagian_id' => $id
		);

		$this->m_data->delete_data($where,'divisi_bagian');		
		redirect(base_url().'dashboard/divisi_bagian');
	}

	// CRUD APLIKASI
	public function apps()
	{
		$data['apps'] = $this->m_data->get_data('apps')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_apps',$data);
		$this->load->view('dashboard/v_footer');
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
			redirect(base_url().'dashboard/apps?alert=gagal_tambah');
		}

		$this->m_data->insert_data($data,'apps');
		redirect(base_url().'dashboard/apps?alert=sukses_tambah');
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
		redirect(base_url().'dashboard/apps?alert=sukses_edit');
	}
	public function apps_hapus($id)
	{
		$where = array(
			'apps_id' => $id
		);


		$this->m_data->delete_data($where,'apps');		
		redirect(base_url().'dashboard/apps');
	}
	/////

	// CRUD AKSES APLIKASI
	public function akses($id)
	{
		$where = array(
			'apps_id' => $id
		);

		$data['akses'] = $this->m_data->edit_data($where, 'akses')->result();
		$data['nama_apps'] = $this->m_data->edit_data($where, 'apps')->row()->apps_nama;
		$data['apps_id'] = $id;
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_akses',$data);
		$this->load->view('dashboard/v_footer');
	}
	public function akses_act()
	{				
		$user_id = $this->input->post('user_id');
		$role_nama = $this->input->post('role_nama');
		$apps_id = $this->input->post('apps_id');
		
		$data = array(			
			'akses_role' => $role_nama,
			'user_id' => $user_id,
			'apps_id' => $apps_id
		);

		//cek nama
		$is_exist = $this->db->query("SELECT * FROM akses WHERE user_id = '$user_id' AND apps_id = '$apps_id'")->num_rows(); 
		if ($is_exist != 0) {
			redirect(base_url().'dashboard/akses/'.$apps_id.'?alert=gagal_tambah');
		}else{
			$this->m_data->insert_data($data,'akses');
			redirect(base_url().'dashboard/akses/'.$apps_id.'?alert=sukses_tambah');
		}
	}
	public function akses_hapus()
	{
		$akses_id = $_GET['akses_id'];
		$apps_id = $_GET['apps_id'];

		$where = array(
			'akses_id' => $akses_id
		);


		$this->m_data->delete_data($where,'akses');		
		redirect(base_url().'dashboard/akses/'.$apps_id);
	}


	// CRUD DIVISI
	public function divisi()
	{
		$data['divisi'] = $this->m_data->get_data('divisi')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_divisi',$data);
		$this->load->view('dashboard/v_footer');
	}
	public function divisi_act()
	{				
		$nama = $this->input->post('nama_divisi');
		$deskripsi = $this->input->post('desc_divisi');
		$data = array(			
			'divisi_nama' => $nama,
			'divisi_deskripsi' => $deskripsi
		);

		//cek nama
		$is_exist = $this->db->query("SELECT * FROM divisi WHERE divisi_nama = '$nama'")->num_rows(); 
		if ($is_exist != 0) {
			redirect(base_url().'dashboard/divisi?alert=gagal_tambah');
		}

		$this->m_data->insert_data($data,'divisi');
		redirect(base_url().'dashboard/divisi?alert=sukses_tambah');
	}
	public function divisi_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_divisi');
		$deskripsi = $this->input->post('desc_divisi');
		$date = date('Y-m-d H:i:s');

		$where = array(
			'divisi_id' => $id
		);

		$data = array(
			'divisi_nama' => $nama,
			'divisi_deskripsi' => $deskripsi,
			'edited_at' => $date
		);

		//cek nama
		$old_nama = $this->db->query("SELECT * FROM divisi WHERE divisi_id = '$id'")->row()->divisi_nama;
		if ($old_nama == $nama) {
			$this->m_data->update_data($where, $data,'divisi');
			redirect(base_url().'dashboard/divisi?alert=sukses_edit');
		}else {
			$is_exist = $this->db->query("SELECT * FROM divisi WHERE divisi_nama = '$nama'")->num_rows(); 
			if ($is_exist != 0) {
				redirect(base_url().'dashboard/divisi?alert=gagal_edit');
			}
		}

		$this->m_data->update_data($where, $data,'divisi');
		redirect(base_url().'dashboard/divisi?alert=sukses_edit');
	}
	public function divisi_hapus($id)
	{
		$where = array(
			'divisi_id' => $id
		);

		//cek divisi bagian
		$is_exist = $this->db->query("SELECT * FROM divisi_bagian WHERE divisi_id = '$id'")->num_rows();
		if ($is_exist != 0) {
			redirect(base_url().'dashboard/divisi?alert=gagal_hapus');
		}

		$this->m_data->delete_data($where,'divisi');		
		redirect(base_url().'dashboard/divisi');
	}

	// CRUD PENDIDIKAN
	public function pendidikan()
	{
		$data['pendidikan'] = $this->m_data->get_data('master_pendidikan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pendidikan',$data);
		$this->load->view('dashboard/v_footer');
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
		redirect(base_url().'dashboard/pendidikan');
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
		redirect(base_url().'dashboard/pendidikan');
	}
	public function pendidikan_hapus($id)
	{
		$where = array(
			'pendidikan_id' => $id
		);

		$this->m_data->delete_data($where,'master_pendidikan');		
		redirect(base_url().'dashboard/pendidikan');
	}

	// CRUD JABATAN
	public function jabatan()
	{
		$data['jabatan'] = $this->m_data->get_data('jabatan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_jabatan',$data);
		$this->load->view('dashboard/v_footer');
	}
	public function jabatan_act()
	{				
		$nama = $this->input->post('nama_jabatan');
		$deskripsi = $this->input->post('desc_jabatan');
		$under = $this->input->post('under_jabatan');
		
		if ($under != 0) {
			$jab = $this->db->query("select * from jabatan where jabatan_id = '$under'")->row();
			$level = $jab->jabatan_level + 1;
		}else {
			$level = 1;
		}

		if (!empty($this->input->post('pegawai_jabatan'))) {
			$pegawai_id = $this->input->post('pegawai_jabatan');
			$peg = $this->db->query("select * from pegawai where pegawai_id = '$pegawai_id'")->row();
			$pegawai_nama = $peg->pegawai_nama;

			$data = array(			
				'jabatan_nama' => $nama,
				'jabatan_deskripsi' => $deskripsi,
				'jabatan_under' => $under,
				'jabatan_level' => $level,
				'pegawai_id' => $pegawai_id,
				'pegawai_nama' => $pegawai_nama
			);
		}else {
			$data = array(			
				'jabatan_nama' => $nama,
				'jabatan_deskripsi' => $deskripsi,
				'jabatan_under' => $under,
				'jabatan_level' => $level
			);
		}

		$this->m_data->insert_data($data,'jabatan');
		redirect(base_url().'dashboard/jabatan');
	}
	public function jabatan_update()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_jabatan');
		$under = $this->input->post('under_jabatan');
		$deskripsi = $this->input->post('desc_jabatan');
		//$level = $this->input->post('level_jabatan');
		
		if ($under != 0) {
			$jab = $this->db->query("select * from jabatan where jabatan_id = '$under'")->row();
			$level = $jab->jabatan_level + 1;
		}else {
			$level = 1;
		}

		$where = array(
			'jabatan_id' => $id
		);

		if (!empty($this->input->post('pegawai_jabatan'))) {
			$pegawai_id = $this->input->post('pegawai_jabatan');
			$peg = $this->db->query("select * from pegawai where pegawai_id = '$pegawai_id'")->row();
			$pegawai_nama = $peg->pegawai_nama;

			$data = array(			
				'jabatan_nama' => $nama,
				'jabatan_deskripsi' => $deskripsi,
				'jabatan_under' => $under,
				'jabatan_level' => $level,
				'pegawai_id' => $pegawai_id,
				'pegawai_nama' => $pegawai_nama
			);
		}else {
			$data = array(			
				'jabatan_nama' => $nama,
				'jabatan_deskripsi' => $deskripsi,
				'jabatan_under' => $under,
				'jabatan_level' => $level
			);
		}

		$this->m_data->update_data($where, $data,'jabatan');
		redirect(base_url().'dashboard/jabatan');
	}
	public function jabatan_hapus($id)
	{
		$where = array(
			'jabatan_id' => $id
		);

		$this->m_data->delete_data($where,'jabatan');		
		redirect(base_url().'dashboard/jabatan');
	}

	// CRUD STATUS PEGAWAI
	public function status_pegawai()
	{
		$data['status_pegawai'] = $this->m_data->get_data('master_pegawai_status')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_status_pegawai',$data);
		$this->load->view('dashboard/v_footer');
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
		redirect(base_url().'dashboard/status_pegawai');
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
		redirect(base_url().'dashboard/status_pegawai');
	}
	public function status_pegawai_hapus($id)
	{
		$where = array(
			'status_pegawai_id' => $id
		);

		$this->m_data->delete_data($where,'master_pegawai_status');		
		redirect(base_url().'dashboard/status_pegawai');
	}

	//AJAX SUB KATEGORI PADA PROSES ADD TRANSAKSI PROJECT
	function get_divisi_bagian(){
		$id = $this->input->post('id',TRUE);
		$data = $this->db->query("SELECT * from divisi_bagian WHERE divisi_id='$id'")->result();
		foreach ($data as $d) {
			?> 
			<option value="<?php echo $d->divisi_bagian_id; ?>"><?php echo $d->divisi_bagian_nama ?></option>
			<?php
		}
	}

	public function profil()
	{
		// id pengguna yang sedang login
		$id_user = $this->session->userdata('id');
		$where = array(
			'user_id' => $id_user
		);

		$data['profil'] = $this->m_data->edit_data($where,'user')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_profil',$data);
		$this->load->view('dashboard/v_footer');
	}

	public function profil_update()
	{
		// Wajib isi nama dan email
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('username','Username','required');

		
		
		if($this->form_validation->run() != false){

			$id = $this->session->userdata('id');
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');			

			//cek foto sebelumnya
			$cek = $this->db->query("SELECT * from user where user_id='$id'")->row();
			$foto = $cek->user_foto;
			$path = './gambar/user/';		
			$nama_foto = $_FILES['foto']['name'];

			if($nama_foto==""){
				$where = array(
					'user_id' => $id
				);
				$data = array(
					'user_nama' => $nama,
					'user_username' => $username
				);
				$this->m_data->update_data($where,$data,'user');
				redirect(base_url().'dashboard/profil/?alert=sukses');
			}else{
				//unlink($path.$foto);
					// foto
				$config['upload_path']   = './gambar/user/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '100000';
				$config['remove_spaces'] = TRUE;
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);

				if($this->upload->do_upload('foto')) {
					$data_upload = $this->upload->data();
					$data_file = $data_upload['file_name'];
					$foto_path = 'http://'.$_SERVER['HTTP_HOST'].'/hr-dashboard/gambar/user/'.$data_file;

					$where = array(
						'user_id' => $id
					);
					$data = array(
						'user_nama' => $nama,
						'user_username' => $username,
						'user_foto' => $data_file,
						'foto_path'=> $foto_path
					);

					$this->m_data->update_data($where,$data,'user');

					redirect(base_url().'dashboard/profil/?alert=sukses');
				}else{					
					redirect(base_url().'dashboard/profil/?alert=gagal');
				}

			}

			
			
		}else{
			// id superadmin yang sedang login
			$id_superadmin = $this->session->userdata('id');

			$where = array(
				'superadmin_id' => $id_superadmin
			);

			$data['profil'] = $this->m_data->edit_data($where,'superadmin')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_profil',$data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function pengaturan()
	{
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengaturan',$data);
		$this->load->view('dashboard/v_footer');
	}


	public function pengaturan_update()
	{
		// Wajib isi nama dan deskripsi website
		$this->form_validation->set_rules('nama','Nama Website','required');
		$this->form_validation->set_rules('deskripsi','Deskripsi Website','required');
		
		if($this->form_validation->run() != false){

			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$link_facebook = $this->input->post('link_facebook');
			$link_twitter = $this->input->post('link_twitter');
			$link_instagram = $this->input->post('link_instagram');
			$link_github = $this->input->post('link_github');

			$where = array(

			);

			$data = array(
				'nama' => $nama,
				'deskripsi' => $deskripsi,
				'link_facebook' => $link_facebook,
				'link_twitter' => $link_twitter,
				'link_instagram' => $link_instagram,
				'link_github' => $link_github
			);

			// update pengaturan
			$this->m_data->update_data($where,$data,'pengaturan');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['logo']['name'])){
				
				$config['upload_path']   = './gambar/website/';
				$config['allowed_types'] = 'jpg|png';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('logo')) {
					// mengambil data tentang gambar logo yang diupload
					$gambar = $this->upload->data();

					$logo = $gambar['file_name'];
					
					$this->db->query("UPDATE pengaturan SET logo='$logo'");
				}
			}

			redirect(base_url().'dashboard/pengaturan/?alert=sukses');

		}else{
			$data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pengaturan',$data);
			$this->load->view('dashboard/v_footer');
		}
	}

	// CRUD user
	public function user()
	{
		$data['user'] = $this->db->query("SELECT * FROM user")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_user',$data);
		$this->load->view('dashboard/v_footer');
	}
	public function user_tambah()
	{		
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_user_tambah');
		$this->load->view('dashboard/v_footer');
	}
	public function user_act()
	{
		$peg_id = $this->input->post('nama');
		$get_nama = $this->db->query("SELECT * FROM pegawai WHERE pegawai_id = '$peg_id'")->row();
		$nama = $get_nama->pegawai_nama;
		$username = $this->input->post('username');
		$level = $this->input->post('level');			
		$password = md5($this->input->post('password'));

		$config['upload_path']   = './gambar/user/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '100000';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		$nama_foto = $_FILES['foto']['name'];

		if($nama_foto==""){
			$data = array(
				'user_nama' => $nama,
				'user_username' => $username,
				'user_password' => $password,
				'hrm_level' => $level,
				'pegawai_id' => $peg_id				
			);
			$this->m_data->insert_data($data,'user');
			redirect(base_url().'dashboard/user');
		}else{
			if($this->upload->do_upload('foto')) {
				$data_upload = $this->upload->data();
				$data_file = $data_upload['file_name'];
				$foto_path = 'http://'.$_SERVER['HTTP_HOST'].'/hr-dashboard/gambar/user/'.$data_file;

				$data = array(
					'user_nama' => $nama,
					'user_username' => $username,
					'user_password' => $password,
					'hrm_level' => $level,
					'pegawai_id' => $peg_id,
					'user_foto'=>$data_file,
					'foto_path'=> $foto_path
				);

				$this->m_data->insert_data($data,'user');
				redirect(base_url().'dashboard/user');

			}else{		
				redirect(base_url().'dashboard/user?alert=gagal');
			}
		}
	}
	public function user_update()
	{		
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$level = $this->input->post('level');		
		$password = md5($this->input->post('password'));

		if($this->input->post('password') == ""){
			$data = array(
				'user_nama' => $nama,
				'user_username' => $username,
				'hrm_level' => $level
			);

			$where = array(
				'user_id' => $id
			);
			$this->m_data->update_data($where,$data,'user');
			redirect(base_url().'dashboard/user');
		}else{
			$data = array(
				'user_nama' => $nama,
				'user_username' => $username,
				'user_password' => $password,
				'hrm_level' => $level
			);

			$where = array(
				'user_id' => $id
			);
			$this->m_data->update_data($where,$data,'user');
			redirect(base_url().'dashboard/user');
		}
	}
	public function user_hapus($id)
	{
		$where = array(
			'user_id' => $id
		);
		$cek = $this->db->query("SELECT * from user where user_id='$id'")->row();
		$foto = $cek->user_foto;
		$path = './gambar/user/';
		unlink($path.$foto);
		$this->m_data->delete_data($where,'user');
		redirect(base_url().'dashboard/user');
	}

	// public function user_akses($id){
	// 	$data['user'] = $this->db->query("SELECT * FROM user where user_id='$id'")->row();
	// 	$data['apps'] = $this->db->query("SELECT * FROM apps")->row();
	// 	$this->load->view('dashboard/v_header');
	// 	$this->load->view('dashboard/v_akses',$data);
	// 	$this->load->view('dashboard/v_footer');
	// }
	// END CRUD user


	// CRUD Role
	public function role()
	{
		$data['roles'] = $this->db->query("SELECT * FROM user_role")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_role',$data);
		$this->load->view('dashboard/v_footer');
	}
	public function role_act()
	{
		$nama = $this->input->post('nama_role');
		$desc = $this->input->post('desc_role');		

		$data = array(			
			'role_nama' => $nama,
			'role_desc' => $desc		
		);

		$this->m_data->insert_data($data,'user_role');
		redirect(base_url().'dashboard/role');
	}
	public function role_hapus($id)
	{
		$where = array(
			'id' => $id
		);
		$this->m_data->delete_data($where,'user_role');
		// $this->db->query("delete from transaksi where transaksi_project='$id'");
		// $this->db->query("delete from realisasi where realisasi_project='$id'");
		redirect(base_url().'dashboard/role');
	}
}
