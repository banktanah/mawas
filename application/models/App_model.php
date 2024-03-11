<?php 

class App_model extends CI_Model{

	public function get_by_client_id($client_id){
		return $this->db
			->select('*')
			->from('apps')
			->where('client_id', $client_id)
			->get()
			->row();
	}
}

?>