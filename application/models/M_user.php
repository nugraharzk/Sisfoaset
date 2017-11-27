<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->table = 'users';
	}

	public function get_all_user($offset,$perpage)
	{
		//ambil semua koleksi berdasarkan offset untuk paging

		$this->db->select('*');
		$this->db->from('users');
		$this->db->offset($offset);
		$this->db->limit($perpage);

		$user = $this->db->get();

		return $user->result();
	}

	public function get_user_by_level($level)
	{
		if(is_array($level))
		{
			$this->db->where_in('level',$level);
		}else{
			$this->db->where('level',$level);
		}

		$this->db->select('*');
		$this->db->from($this->table);
		
		$users = $this->db->get();

		return $users->row();
	}

	public function get_jumlah_records()
	{
		//hitung jumlah semua records
		return $this->db->count_all('users');
	}

	public function insert_user($post)
	{
		//input data koleksi
		$q = $this->db->insert($this->table, $post);
		return $q;

	}

	public function get_user($id = null)
	{
		return $this->db->where('id',$id)->get('users')->row();
	}

	public function update_user($post,$id)
	{
		//update where id 
		$this->db->where('id',$id);
		$this->db->update('users',$post);
	
	}

	public function delete_user($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('users');
	}
	

}

/* End of file M_koleksi.php */
/* Location: ./application/models/M_koleksi.php */