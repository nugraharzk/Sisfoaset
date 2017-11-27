<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies

		//$this->load->model('m_balai');
		$this->load->model('m_koleksi');

	}

	// index dashboard
	public function index( )
	{	
		//handling search
		if($this->input->post())
		{
			//lakukan search
			$data['search'] = $this->m_koleksi->cari($this->input->post('keyword'));
			$this->load->view('v_front',$data);
		}else{
			//load frontend
			$this->load->view('v_front');
		}
	}

	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
