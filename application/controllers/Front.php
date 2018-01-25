<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

		//$this->load->model('m_balai');
		$this->load->model('m_accounts');

	}

	// index dashboard
	public function index( )
	{	
		//load frontend
		$this->load->view('v_front');
	}

	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
