<?php 

class Sharedsession_model extends CI_Model{
	private $session_age_hours = 2;

    function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
	}

	public function create_session($session_id, $user_id){
		return $this->db->insert('sso_shared_session', [
			'session_id' => $session_id,
			'user_id' => $user_id,
			'last_activity' => time()
		]);
	}

	public function check_session_valid($session_id){
		$rs = $this->db
			->from('sso_shared_session')
			->where('session_id', $session_id)
			->where("last_activity >= now() - INTERVAL $this->session_age_hours HOUR")
			->get()
			->row();

		if(!empty($rs)){
			$status = $this->db
				->where('session_id', $session_id)
				->update('sso_shared_session', ['last_activity' => time()])
				;
		}

		$status = $this->removes_expired_sessions();

		return $rs;
	}

	private function removes_expired_sessions(){
		return $this->db
			->from('sso_shared_session')
			->where("last_activity < now() - INTERVAL $this->session_age_hours HOUR")
			->delete();
	}
	
}

?>