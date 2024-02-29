<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Forgotpasswordmodel extends CI_Model
{
	private $validityPeriod = 3600; //in seconds

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}

	function get_resetcode($nip): string{
		$reset_code = $this->get_active_resetcode($nip);

		if(!empty($reset_code))return $reset_code;

		$code_length = 64;
		$reset_code = bin2hex(random_bytes(($code_length-($code_length%2))/2));
		$data = [
			'reset_code' => $reset_code,
			'nip' => $nip,
			'created_date' => date('Y-m-d H:i:s'),
			'is_used' => 0
		];
		$res = $this->db->insert('forgot_password', $data);

		return $reset_code;
	}

	function get_active_resetcode($nip)
	{
		$reset_code = null;

		$rs = $this->db
			->where([
				'nip' => $nip,
				'is_used' => 0
			])
			->order_by('created_date', 'DESC')
			->limit(1)
			->get('forgot_password')
			->row();

		if(!empty($rs)){
			$reset_date = strtotime($rs->created_date);
			$now = time();
			$diff = $now - $reset_date;
			if($diff <= $this->validityPeriod){
				$reset_code = $rs->reset_code;
			}
		}

		return $reset_code;
	}

	function get_nip_from_resetcode($reset_code){
		$nip = null;

		$rs = $this->db
			->where([
				'reset_code' => $reset_code,
				'is_used' => 0
			])
			->order_by('created_date', 'DESC')
			->limit(1)
			->get('forgot_password')
			->row();

		if(!empty($rs)){
			$reset_date = strtotime($rs->created_date);
			$now = time();
			$diff = $now - $reset_date;
			if($diff <= $this->validityPeriod){
				$nip = $rs->nip;
			}
		}

		return $nip;
	}

	function invalidate_resetcode($reset_code)
	{
		$res = $this->db
			->where('reset_code', $reset_code)
			->update('forgot_password', ['is_used' => 1]);

		return $res;
	}
}
