<?php 

class Sharedsession_model extends CI_Model{
	private const SESSION_AGE_HOURS = 2;

    function __construct(){
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('user_model');
	}

	public function create_session($new_session_id, $user_id){
		$user = $this->user_model->get_by_id($user_id);

		if($user->allow_multiple_device == 0){
			$other_sessions = $this->check_session_by_userid($user_id);
			foreach($other_sessions as $loop_sess){
				// $success = $this->invalidate($loop_sess->session_id);
				
				$forced_status = AUTH_ERROR_MULTIDEVICE_LOGIN;
				$status = $this->db->query("
					update sso_shared_session
					set forced_logout_status = '$forced_status'
					where session_id = '$loop_sess->session_id'
				");
			}
		}
		
		return $this->db->insert('sso_shared_session', [
			'session_id' => $new_session_id,
			'user_id' => $user_id,
			'last_activity' => date('Y-m-d H:i:s')
		]);
	}

	public function create_session_multi($session_id, $multi_session_id, $apps_id){
		return $this->db->insert('sso_shared_session_multi', [
			'shared_session_id' => $session_id,
			'multi_session_id' => $multi_session_id,
			'apps_id' => $apps_id
		]);
	}

	public function check_session_by_userid($user_id): array{
		$session_age_hours = self::SESSION_AGE_HOURS;
		$rs = $this->db
			->from('sso_shared_session')
			->where('user_id', $user_id)
			->where("last_activity >= now() - INTERVAL $session_age_hours HOUR")
			->order_by("last_activity", "DESC")
			->get()
			->result();

		if(!empty($rs)){
			foreach($rs as $loop_sess){
				$this->check_session($loop_sess->session_id);
			}

			return $rs;
		}

		return [];
	}

	public function check_session_by_multisessionid($multi_session_id){
		$session_age_hours = self::SESSION_AGE_HOURS;
		$rs = $this->db
			->from('sso_shared_session ss')
			->join('sso_shared_session_multi as ssm', 'ss.session_id = ssm.shared_session_id')
			->where('ssm.multi_session_id', $multi_session_id)
			->where("ss.last_activity >= now() - INTERVAL $session_age_hours HOUR")
			->order_by("ss.last_activity", "DESC")
			->get()
			->result();

		if(!empty($rs)){
			return $this->check_session($rs[0]->session_id);
		}

		return null;
	}

	public function check_session($session_id){
		$session_age_hours = self::SESSION_AGE_HOURS;
		$rs = $this->db
			->from('sso_shared_session')
			->where('session_id', $session_id)
			->where("last_activity >= now() - INTERVAL $session_age_hours HOUR")
			->get()
			->row();

		if(!empty($rs)){
			$status = $this->db
				->where('session_id', $session_id)
				->update('sso_shared_session', ['last_activity' => date('Y-m-d H:i:s')])
				;
		}

		$status = $this->removes_expired_sessions();

		return $rs;
	}

	private function removes_expired_sessions(){
		$session_age_hours = self::SESSION_AGE_HOURS;

		$expired_sessions = $this->db
			->from('sso_shared_session')
			->where("last_activity < now() - INTERVAL $session_age_hours HOUR")
			->get()
			->result();
		
		$this->db->trans_begin();
		
		foreach($expired_sessions as $loop_session){
			$this->db
				->from('sso_shared_session_multi')
				->where('shared_session_id', $loop_session->session_id)
				->delete();
			$this->db
				->from('sso_shared_session')
				->where('session_id', $loop_session->session_id)
				->delete();
		}

		$success = $this->db->trans_status();
		if($success === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_commit();
		}

		return $success;
	}

	public function invalidate_by_userid($user_id): int{
		$invalidated_count = 0;
		$sess_arr = $this->check_session_by_userid($user_id);

		if(!empty($sess)){
			foreach($sess_arr as $loop_sess){
				$sucess = $this->invalidate($loop_sess->session_id);
				if($sucess){
					$invalidated_count++;
				}
			}
		}

		return $invalidated_count;
	}

	public function invalidate_by_multisessionid($multi_session_id): bool{
		$sess = $this->check_session_by_multisessionid($multi_session_id);

		if(!empty($sess)){
			return $this->invalidate($sess->session_id);
		}

		return false;
	}

	public function invalidate($session_id){
		$invalidated_hours = self::SESSION_AGE_HOURS + 1;
		$status = $this->db
			->query("
				update sso_shared_session
				set last_activity = DATE_SUB(NOW(), INTERVAL '$invalidated_hours' HOUR)
				where session_id = '$session_id'
			")
			;

		return $status;
	}
}

?>