<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perawatan extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->table = 'perawatan';
	}

	public function update_perawatan($post,$id)
	{
		//update where id 
		$this->db->where('id',$id);
		$this->db->update($this->table,$post);
	}

	public function updating($post,$id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->table,$post);
	}

	public function get_all_perawatan($offset,$perpage)
	{
		//ambil semua perawatan berdasarkan offset untuk paging

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->offset($offset);
		$this->db->limit($perpage);

		$user = $this->db->get();

		return $user->result();
	}

	public function get_all_jenis()
	{
		//ambil semua perawatan berdasarkan offset untuk paging

		$this->db->distinct();
		$this->db->select('jenis');
		$this->db->from($this->table);

		$user = $this->db->get();

		return $user->result();
	}
	
	public function get_jumlah_records()
	{
		//hitung jumlah semua records
		return $this->db->count_all($this->table);
	}

	public function insert_perawatan($post)
	{
		//input data perawatan
		$q = $this->db->insert($this->table, $post);
		return $q;

	}

	public function get_perawatan($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id',$id);

		$res = $this->db->get();
		//ambil satu row
		return $res->row();

	}

	public function get_perawatan_asset($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_asset',$id);

		$res = $this->db->get();
		//ambil satu row
		return $res->row();

	}

	public function delete_perawatan($id)
	{
		$this->db->where('id',$id);
		$this->db->delete($this->table);
	}

	public function get_banyak($id)
	{
		return $this->db->where('jenis',$id)->get('perawatan')->num_rows();
	}
	
	public function getSum()
	{
		return $this->db->select_sum('nilai')->get('perawatan')->row();
	}
	
	public function getSums($id)
	{
		return $this->db->select_sum('nilai')->where('jenis',$id)->get('perawatan')->row();
	}

}

/* End of file M_perawatan.php */
/* Location: ./application/models/M_perawatan.php */