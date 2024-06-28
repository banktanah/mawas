<?php 

class User_model extends CI_Model{
	
	function do_login($username, $password){
		$pegawai_id = -1;
		$peg_id = $this->get_pegawai_id_by_nip($username);
		if(!empty($peg_id)){
			$pegawai_id = intval($peg_id);
		}

		$res_arr = $this->db
		->select("*")
		->from('user')
		->group_start()
			->where('user_username', $username)
			// ->or_where('nip', $username)
			->or_where('pegawai_id', $pegawai_id)
		->group_end()
		->group_start()
			->where('user_password', md5($password))
			->or_where('user_password', hash('sha256', $password))
		->group_end()
		->where('is_disabled', 0)
		->get()
		->row_array();

		if(!empty($res_arr)){
			$res_arr['nip'] = $this->get_nip_by_pegawai_id($res_arr['pegawai_id']);
		}

		return json_decode(json_encode($res_arr));
	}
	
	function has_access($user_id, $client_id){
		$roles = $this->get_roles($user_id, $client_id);

		return !empty($roles);
	}

	function get_roles($user_id, $client_id){
		$roles = [];

		$group_roles = $this->get_group_roles($user_id, $client_id);
		$custom_roles = $this->get_custom_roles($user_id, $client_id);

		foreach($group_roles as $role){
			$is_excluded = false;
			foreach($custom_roles as $loop){
				if($loop['role'] == $role && $loop['type'] == '-'){
					$is_excluded = true;
				}
			}

			if(!$is_excluded && !in_array($role, $roles)){
				$roles []= $role;
			}
		}

		foreach($custom_roles as $loop){
			if($loop['type'] == '+' && !in_array($loop['role'], $roles)){
				$roles []= $loop['role'];
			}
		}

		return $roles;
	}

	private function get_group_roles($user_id, $client_id){
		$roles = [];

		$rs = $this->db->query("
			SELECT 
				u.user_id ,
				GROUP_CONCAT(agg.`role`) as roles
			FROM 
				`user` u 
				join mx_user_usergroup muu on u.user_id = muu.user_id 
				join access_grant_group agg on muu.user_group_id = agg.user_group_id
				join apps a on agg.apps_id = a.apps_id
			WHERE 
				u.user_id = $user_id
				and a.client_id = '$client_id'
			GROUP BY u.user_id
		")->row();

		if(!empty($rs)){
			$roles = explode(',', $rs->roles);
		}

		return $roles;
	}

	private function get_custom_roles($user_id, $client_id){
		$roles = [];

		$rs = $this->db->query("
			SELECT 
				u.user_id ,
				GROUP_CONCAT(ag.`role`, ':', ag.grant_type) as roles
			FROM 
				`user` u 
				join access_grant ag on u.user_id = ag.user_id
				join apps a on ag.apps_id = a.apps_id
			WHERE 
				u.user_id = $user_id
				and a.client_id = '$client_id'
			GROUP BY u.user_id
		")->row();

		if(!empty($rs)){
			$rolesarr = explode(',', $rs->roles);
			foreach($rolesarr as $roletype){
				$roletype_arr = explode(':', $roletype);
				$roles []= [
					'role' => $roletype_arr[0],
					'type' => $roletype_arr[1]
				];
			}
		}

		return $roles;
	}

	public function get_by_id($user_id){
		$res_arr = $this->db
		->select('*')
		->from('user')
		->where('user_id', $user_id)
		->get()
		->row_array();

		if(!empty($res_arr)){
			$res_arr['nip'] = $this->get_nip_by_pegawai_id($res_arr['pegawai_id']);
		}

		return json_decode(json_encode($res_arr));
	}

	public function get_by_email_or_nip($email_or_nip){
		$pegawai_id = -1;
		$peg_id = $this->get_pegawai_id_by_nip($email_or_nip);
		if(!empty($peg_id)){
			$pegawai_id = intval($peg_id);
		}

		// $res_arr = $this->db
		// ->select('*')
		// ->from('user')
		// ->group_start()
		// 	->where('user_username', $email_or_nip)
		// 	// ->or_where('nip', $email_or_nip)
		// 	->or_where('pegawai_id', $pegawai_id)
		// ->group_end()
		// ->get()
		// ->row_array();

		$res_arr = $this->db->query("
			select
				u.*
			from
				user u
				join pegawai p on u.pegawai_id = p.pegawai_id
				join pegawai_karir pk on p.pegawai_id = pk.pegawai_id
			where
				(
					pk.pegawai_nip = '$email_or_nip'
					or (
						p.pegawai_email_pribadi = '$email_or_nip'
						or p.pegawai_email_kantor = '$email_or_nip'
					)
				)
				and pk.tgl_akhir is null
				and u.is_disabled = 0
			order by
				pk.tgl_awal desc
			limit 1
		")->row_array();

		if(!empty($res_arr)){
			$res_arr['nip'] = $this->get_nip_by_pegawai_id($res_arr['pegawai_id']);
		}

		return json_decode(json_encode($res_arr));
	}

	public function get_by_remember_token($remember_token){
		$res_arr = $this->db
			->select('*')
			->from('user')
			->where('remember_token', $remember_token)
			->get()
			->row_array();

		if(!empty($res_arr)){
			$res_arr['nip'] = $this->get_nip_by_pegawai_id($res_arr['pegawai_id']);
		}

		return json_decode(json_encode($res_arr));
	}
	
	public function get_pegawai_id_by_nip($nip){
		$peg = $this->db->query("
			select pegawai_id
			from pegawai_karir
			where pegawai_nip = '$nip'
		")
		->row();

		if(empty($peg))return null;

		return $peg->pegawai_id;
	}

	public function get_nip_by_pegawai_id($pegawai_id){
		$res = $this->db->select("pegawai_nip")
		->from('pegawai_karir')
		->where('pegawai_id', intval($pegawai_id))
		->where('tgl_akhir is null')
		->order_by("tgl_awal", "desc")
		->limit(1)
		->get()
		->row();
		
		if(empty($res)){
			return null;
		}

		return $res->pegawai_nip;
	}

	public function generate_session_data($nip, $roles = []){
		$data = $this->db->query("
			select
				u.user_id,
				p.pegawai_nama as user_nama,
				u.hrm_level
			from
				pegawai_karir pk
				left join user u on pk.pegawai_id = u.pegawai_id 
				left join pegawai p on pk.pegawai_id = p.pegawai_id
			where
				pk.pegawai_nip = '$nip'
		")
		->row();

		return array(
			'id' => $data->user_id,
			'nama' => $data->user_nama,		
			'hrm_level' => $data->hrm_level,			
			'status' => 'telah_login',
			'roles' => $roles
		);
	}
}

?>