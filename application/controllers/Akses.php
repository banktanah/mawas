<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require FCPATH . '/vendor/autoload.php';
use Dompdf\Dompdf;

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Akses extends CI_Controller {

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

    // CRUD AKSES APLIKASI
	public function akses($id)
	{
		$where = array(
			'apps_id' => $id
		);

		$data['akses'] = $this->m_data->edit_data($where, 'akses')->result();
		$data['nama_apps'] = $this->m_data->edit_data($where, 'apps')->row()->apps_nama;
		$data['apps_id'] = $id;
		$this->load->view('template/v_header');
		$this->load->view('master/v_akses',$data);
		$this->load->view('template/v_footer');
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
			$this->session->set_flashdata('error', 'Pegawai sudah memiliki akses sebelumnya!');
			redirect(base_url().'akses/akses/'.$apps_id);
		}else{
			$this->m_data->insert_data($data,'akses');
			$this->session->set_flashdata('success', 'Akses berhasil ditambahkan.');
			redirect(base_url().'akses/akses/'.$apps_id);
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
		$this->session->set_flashdata('success', 'Berhasil menghapus akses.');	
		redirect(base_url().'akses/akses/'.$apps_id);
	}
	
	public function group()
	{
		$groups = $this->db
		->select('*')
		->from('user_group')
		->get()
		->result_array();

		$mod_groups = [];
		foreach($groups as $group){
			$access = $this->db
			->select('a.apps_id, a.apps_nama, agg.role')
			->from('access_grant_group agg')
			->join('apps as a', 'agg.apps_id = a.apps_id')
			->where('agg.user_group_id', $group['user_group_id'])
			->get()
			->result_array();
			;

			$group['access'] = $access;
			$mod_groups []= json_decode(json_encode($group));
		}

		// $existing_group_ids = [];
		// foreach($mod_groups as $group){
		// 	$existing_group_ids []= $group->apps_id;
		// }

		$data['apps'] = $this->db
		->select('apps_id, apps_nama')
		->from('apps')
		// ->where_not_in('apps_id', $existing_group_ids)
		->get()
		->result();

		$data['users'] = $this->db
		->select('user_id, user_nama, nip')
		->from('user')
		->get()
		->result();

		$data['matrix_user_group'] = $this->db
		->select('user_id, user_group_id')
		->from('mx_user_usergroup')
		->get()
		->result();

		$data['roles'] = $this->db->query('SELECT `role` FROM access_grant_group UNION SELECT `role` FROM access_grant')->result();

		$data['groups'] = json_decode(json_encode($mod_groups));
		$this->load->view('template/v_header');
		$this->load->view('master/v_akses_group',$data);
		$this->load->view('template/v_footer');
	}

	public function user_group_add(){
		$post = $this->input->post(null, true);

		$existing = $this->db
		->select('*')
		->from('user_group')
		->where('name', $post['group_name'])
		->get()
		->num_rows();
		;
		if($existing != 0){
			$this->session->set_flashdata('error', 'The specified role already exists');
			redirect('akses/group');
			exit;
		}

		$status = $this->db->insert('user_group', ['name' => $post['group_name']]);

		$this->session->set_flashdata('success', "Add user-group \"".$post['group_name']."\" berhasil");
		redirect('akses/group');
	}

	public function user_group_delete(){
		$get = $this->input->get(null, true);

		$status = $this->db->delete('user_group', [
			'user_group_id' => $get['user_group_id']
		]);

		$this->session->set_flashdata('success', "Hapus user-group \"".$get['user_group_id']."\" berhasil");
		redirect('akses/group');
	}
 
	public function group_add(){
		$post = $this->input->post(null, true);

		$role = isset($post['is_custom_role'])? $post['role_custom']: $post['role'];
		$existing = $this->db
		->select('*')
		->from('access_grant_group')
		->where('user_group_id', $post['user_group_id'])
		->where('apps_id', $post['apps_id'])
		->where('role', $role)
		->get()
		->num_rows();
		;
		if($existing != 0){
			$this->session->set_flashdata('error', 'The specified role already exists');
			redirect('akses/group');
			exit;
		}

		$status = $this->db->insert('access_grant_group', [
			'user_group_id' => $post['user_group_id'],
			'apps_id' => $post['apps_id'],
			'role' => $role
		]);

		$this->session->set_flashdata('success', "Add role \"".$role."\" berhasil");
		redirect('akses/group');
	}

	public function group_delete(){
		$post = $this->input->post(null, true);

		$status = $this->db->delete('access_grant_group', [
			'apps_id' => $post['apps_id'],
			'role' => $post['role']
		]);

		$this->session->set_flashdata('success', "Hapus role \"".$post['role']."\" berhasil");
		redirect('akses/group');
	}
 
	public function group_add_user(){
		$post = $this->input->post(null, true);

		$existing = $this->db
		->select('*')
		->from('mx_user_usergroup')
		->where('user_group_id', $post['user_group_id'])
		->where('user_id', $post['user_id'])
		->get()
		->num_rows();
		;
		if($existing != 0){
			$this->session->set_flashdata('error', 'The user already exists in group');
			redirect('akses/group');
			exit;
		}

		$status = $this->db->insert('mx_user_usergroup', [
			'user_group_id' => $post['user_group_id'],
			'user_id' => $post['user_id']
		]);

		$this->session->set_flashdata('success', "Add User kedalam Group berhasil");
		redirect('akses/group');
	}

	public function group_delete_user(){
		$post = $this->input->post(null, true);

		$status = $this->db->delete('mx_user_usergroup', [
			'user_group_id' => $post['user_group_id'],
			'user_id' => $post['user_id']
		]);

		$this->session->set_flashdata('success', "Remove User dari Group berhasil");
		redirect('akses/group');
	}
	
	public function personal()
	{
		$user_raws = $this->db
		->select('user_id, user_nama, user_username, nip')
		->from('user')
		->get()
		->result_array();

		$users = [];
		foreach($user_raws as $row_user){
			$access = $this->db
			->select('
				ag.user_id, 
				ag.apps_id, 
				app.apps_nama, 
				ag.role,
				ag.grant_type
			')
			->from('access_grant ag')
			->join('apps app', 'ag.apps_id = app.apps_id')
			->where('ag.user_id', $row_user['user_id'])
			->get()
			->result_array();
			;

			$row_user['access'] = $access;
			$users []= $row_user;
		}

		$data['apps'] = $this->db
		->select('apps_id, apps_nama')
		->from('apps')
		->get()
		->result();

		$data['users'] = $users;

		$this->load->view('template/v_header');
		$this->load->view('master/v_akses_personal',$data);
		$this->load->view('template/v_footer');
	}
}
?>