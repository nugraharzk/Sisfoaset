<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_approve extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->table = 'approval';
	}

	public function get_all_approval($offset,$perpage)
	{
		//ambil semua koleksi berdasarkan offset untuk paging

		$this->db->select('*');
		$this->db->from('approval');
		$this->db->offset($offset);
		$this->db->limit($perpage);

		$koleksi = $this->db->get();

		return $koleksi->result();
	}

	public function get_jumlah_records()
	{
		//hitung jumlah semua records
		return $this->db->count_all('approval');
	}
	

}

/* End of file M_koleksi.php */
/* Location: ./application/models/M_koleksi.php */