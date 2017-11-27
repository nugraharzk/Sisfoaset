<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelompok extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->table = 'kelompok';
	}

	public function get_all_kelompok($offset,$perpage)
	{
		//ambil semua  berdasarkan offset untuk paging

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->offset($offset);
		$this->db->limit($perpage);

		$user = $this->db->get();

		return $user->result();
	}

	public function get_jumlah_records()
	{
		//hitung jumlah semua records
		return $this->db->count_all($this->table);
	}

	public function insert_kelompok($post)
	{
		//input data asset
		$q = $this->db->insert($this->table, $post);
		return $q;

	}

	public function get_kelompok($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id',$id);

		$res = $this->db->get();
		//ambil satu row
		return $res->row();

	}

	public function update_kelompok($post,$id)
	{
		//update where id 
		$this->db->where('id',$id);
		$this->db->update($this->table,$post);
	
	}

	public function delete_kelompok($id)
	{
		$this->db->where('id',$id);
		$this->db->delete($this->table);
	}
	

}

/* End of file M_kelompok.php */
/* Location: ./application/models/M_kelompok.php */