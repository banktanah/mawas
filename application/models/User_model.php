<?php 

// WWW.MALASNGODING.COM === Author : Diki Alfarabi Hadi
// Model yang terstruktur. agar bisa digunakan berulang kali untuk membuat CRUD. 
// Sehingga proses pembuatan CRUD menjadi lebih cepat dan efisien.

class User_model extends CI_Model{
	
	function do_login($username, $password){
		return $this->db
			->select('*')
			->from('user')
			->group_start()
				->where('user_username', $username)
				->or_where('nip', $username)
			->group_end()
			->group_start()
				->where('user_password', md5($password))
				->or_where('user_password', hash('sha256', $password))
			->group_end()
			->where('is_disabled', 0)
			->get()
			->row();
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
	
}

?>