<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_accounts extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->table = 'accounts';
	}

	public function get_all_account()
	{
		//ambil semua account berdasarkan offset untuk paging

		$this->db->select('*');
		$this->db->from($this->table);

		$user = $this->db->get();

		return $user->result();
	}

	public function update_account($post,$id)
	{
		//update where id 
		$this->db->where('id',$id);
		$this->db->update($this->table,$post);
	
	}

	public function delete_account($id)
	{
		$this->db->where('id',$id);
		$this->db->delete($this->table);
	}

}

/* End of file M_account.php */
/* Location: ./application/models/M_account.php */