<?php 

class Sharedsession_model extends CI_Model{
	private const SESSION_AGE_HOURS = 2;

    function __construct(){
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('user_model');
	}

	public function create_session($session_id, $user_id){
		return $this->db->insert('sso_shared_session', [
			'session_id' => $session_id,
			'user_id' => $user_id,
			'last_activity' => date('Y-m-d H:i:s')
		]);
	}

	public function check_session_valid_by_userid($user_id){
		$session_age_hours = self::SESSION_AGE_HOURS;
		$rs = $this->db
			->from('sso_shared_session')
			->where('user_id', $user_id)
			->where("last_activity >= now() - INTERVAL $session_age_hours HOUR")
			->get()
			->row();

		if(!empty($rs)){
			return $this->check_session_valid($rs->session_id);
		}

		return null;
	}

	public function check_session_valid($session_id){
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
		return $this->db
			->from('sso_shared_session')
			->where("last_activity < now() - INTERVAL $session_age_hours HOUR")
			->delete();
	}

	public function invalidate($user_id){
		$sess = $this->check_session_valid_by_userid($user_id);

		if(!empty($sess)){
			$invalidated_hours = self::SESSION_AGE_HOURS + 1;
			$status = $this->db
				->query("
					update sso_shared_session
					set last_activity = DATE_SUB(NOW(), INTERVAL '$invalidated_hours' HOUR)
					where session_id = '$sess->session_id'
				")
				;

			return $status;
		}

		return false;
	}
}

?>