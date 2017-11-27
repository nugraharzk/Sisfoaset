<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_asset extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->table = 'asset_tetap';
	}

	public function get_all_asset($offset,$perpage)
	{
		//ambil semua asset berdasarkan offset untuk paging

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->offset($offset);
		$this->db->limit($perpage);

		$user = $this->db->get();

		return $user->result();
	}

	public function get_all_jenis()
	{
		//ambil semua asset berdasarkan offset untuk paging

		$this->db->distinct();
		$this->db->select('jenis');
		$this->db->from($this->table);

		$user = $this->db->get();

		return $user->result();
	}

	public function get_asset_by_jenis($jenis)
	{
		//ambil semua asset berdasarkan status

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('jenis',$jenis);

		$user = $this->db->get();

		return $user->result();
	}

	public function get_asset_by_status()
	{
		//ambil semua asset berdasarkan status

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('status !=',0);

		$user = $this->db->get();

		return $user->result();
	}

	public function get_jumlah_records()
	{
		//hitung jumlah semua records
		return $this->db->count_all($this->table);
	}

	public function insert_asset($post)
	{
		//input data asset
		$q = $this->db->insert($this->table, $post);
		return $q;

	}

	public function get_asset($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id',$id);

		$res = $this->db->get();
		//ambil satu row
		return $res->row();

	}

	public function update_asset($post,$id)
	{
		//update where id 
		$this->db->where('id',$id);
		$this->db->update($this->table,$post);
	
	}

	public function delete_asset($id)
	{
		$this->db->where('id',$id);
		$this->db->delete($this->table);
	}

	public function get_banyak($id)
	{
		return $this->db->where('jenis',$id)->get('asset_tetap')->num_rows();
	}
	
	public function getSum()
	{
		return $this->db->select_sum('nilai_buku')->get('asset_tetap')->row();
	}
	
	public function getSums($id)
	{
		return $this->db->select_sum('nilai_buku')->where('jenis',$id)->get('asset_tetap')->row();
	}

}

/* End of file M_asset.php */
/* Location: ./application/models/M_asset.php */