<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function login($username,$password)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username',$username);
		$this->db->where('password',md5($password));

		$usr = $this->db->get();

		if($usr->num_rows() > 0)
		{
			return $usr;
		}else
		{
			return false;
		}
	}

	public function get_id_row($id)
	{
		return $this->db->where('id',$id)->get('users')->row();
	}

}

/* End of file m_auth.php */
/* Location: ./application/models/m_auth.php */