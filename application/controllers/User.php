<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends CI_Controller {

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

    // CRUD user
	public function index()
	{
		$data['user'] = $this->db->query("SELECT * FROM user WHERE is_dummy is FALSE ORDER BY user_nama")->result();
		$this->load->view('template/v_header');
		$this->load->view('user/v_user',$data);
		$this->load->view('template/v_footer');
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
			$this->session->set_flashdata('success', 'User berhasil ditambahkan.');
			redirect(base_url().'dashboard/user');
		}else{
			if($this->upload->do_upload('foto')) {
				$data_upload = $this->upload->data();
				$data_file = $data_upload['file_name'];
				$foto_path = 'http://'.$_SERVER['HTTP_HOST'].'/mawas/gambar/user/'.$data_file;

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
				$this->session->set_flashdata('success', 'User berhasil ditambahkan.');
				redirect(base_url().'user');

			}else{		
				$this->session->set_flashdata('error', 'Format foto tidak sesuai!');
				redirect(base_url().'user');
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
			$this->session->set_flashdata('success', 'Berhasil mengubah data User.');
			redirect(base_url().'user');
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
			$this->session->set_flashdata('success', 'Berhasil mengubah data User.');
			redirect(base_url().'user');
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
		//unlink($path.$foto);
		$this->m_data->delete_data($where,'user');

		//Hapus Akses
		$akses = $this->db->query("SELECT * FROM akses WHERE user_id = '$id'")->result();
		if (!empty($akses)) {
			foreach ($akses as $ak) {
				$this->db->query("DELETE FROM akses WHERE akses_id = '$ak->akses_id'");
			}
		}

		$this->session->set_flashdata('success', 'User berhasil dihapus.');
		redirect(base_url().'user');
	}

	// CRUD User Dummy
	public function user_dummy()
	{
		$data['user'] = $this->db->query("SELECT * FROM user WHERE is_dummy is TRUE ORDER BY user_nama")->result();
		$this->load->view('template/v_header');
		$this->load->view('user/v_user_dummy',$data);
		$this->load->view('template/v_footer');
	}
	public function user_dummy_act()
	{
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$level = $this->input->post('level');			
		$password = md5($this->input->post('password'));
		$is_dummy = TRUE;

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
				'is_dummy' => $is_dummy	
			);
			$this->m_data->insert_data($data,'user');
			$this->session->set_flashdata('success', 'User berhasil ditambahkan.');
			redirect(base_url().'dashboard/user');
		}else{
			if($this->upload->do_upload('foto')) {
				$data_upload = $this->upload->data();
				$data_file = $data_upload['file_name'];
				$foto_path = 'http://'.$_SERVER['HTTP_HOST'].'/mawas/gambar/user/'.$data_file;

				$data = array(
					'user_nama' => $nama,
					'user_username' => $username,
					'user_password' => $password,
					'hrm_level' => $level,
					'is_dummy' => $is_dummy,
					'user_foto'=>$data_file,
					'foto_path'=> $foto_path
				);

				$this->m_data->insert_data($data,'user');
				$this->session->set_flashdata('success', 'User berhasil ditambahkan.');
				redirect(base_url().'user/user_dummy');

			}else{		
				$this->session->set_flashdata('error', 'Format foto tidak sesuai!');
				redirect(base_url().'user/user_dummy');
			}
		}
	}
	public function user_dummy_update()
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
			$this->session->set_flashdata('success', 'Berhasil mengubah data User.');
			redirect(base_url().'user/user_dummy');
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
			$this->session->set_flashdata('success', 'Berhasil mengubah data User.');
			redirect(base_url().'user/user_dummy');
		}
	}
	public function user_dummy_hapus($id)
	{
		$where = array(
			'user_id' => $id
		);
		$cek = $this->db->query("SELECT * from user where user_id='$id'")->row();
		$foto = $cek->user_foto;
		$path = './gambar/user/';
		//unlink($path.$foto);
		$this->m_data->delete_data($where,'user');

		//Hapus Akses
		$akses = $this->db->query("SELECT * FROM akses WHERE user_id = '$id'")->result();
		if (!empty($akses)) {
			foreach ($akses as $ak) {
				$this->db->query("DELETE FROM akses WHERE akses_id = '$ak->akses_id'");
			}
		}
		
		$this->session->set_flashdata('success', 'User berhasil dihapus.');
		redirect(base_url().'user/user_dummy');
	}

	public function ganti_password()
	{
		$this->load->view('template/v_header');
		$this->load->view('user/v_ganti_password');
		$this->load->view('template/v_footer');
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
				$this->session->set_flashdata('success', 'Berhasil mengubah password.');
				redirect('user/ganti_password');
			}else{
				// alihkan halaman kembali ke halaman ganti password
				$this->session->set_flashdata('error', 'Gagal mengubah password!');
				redirect('user/ganti_password');
			}

		}else{
			// alihkan halaman kembali ke halaman ganti password
			$this->session->set_flashdata('error', 'Gagal mengubah password!');
			redirect('user/ganti_password');
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

		$this->load->view('template/v_header');
		$this->load->view('user/v_profil',$data);
		$this->load->view('template/v_footer');
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
				redirect(base_url().'user/profil');
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
					$foto_path = 'http://'.$_SERVER['HTTP_HOST'].'/mawas/gambar/user/'.$data_file;

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
					$this->session->set_flashdata('success', 'Berhasil mengganti foto.');
					redirect(base_url().'user/profil');
				}else{					
					$this->session->set_flashdata('error', 'Format foto tidak sesuai!');
					redirect(base_url().'user/profil');
				}

			}

			
			
		}else{
			// id superadmin yang sedang login
			$id_superadmin = $this->session->userdata('id');

			$where = array(
				'superadmin_id' => $id_superadmin
			);

			$data['profil'] = $this->m_data->edit_data($where,'superadmin')->result();

			$this->load->view('template/v_header');
			$this->load->view('user/v_profil',$data);
			$this->load->view('template/v_footer');
		}
	}
}
?>