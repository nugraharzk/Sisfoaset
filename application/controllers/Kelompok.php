<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//check login
		is_logged_in();
		//Load Dependencies
		$this->load->library('pagination');
		$this->load->model('m_kelompok');
		//$this->load->model('m_balai');
		// $this->output->enable_profiler(true);

	}

	// List all your items
	public function page()
	{
		$this->index();
	}
	public function index( $offset = 0 )
	{
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('kelompok/page');
		$config['total_rows'] = $this->m_kelompok->get_jumlah_records();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$offset = $this->uri->segment(3);
		
		$this->pagination->initialize($config);

		
		
		$dat['paging'] = $this->pagination->create_links();

		//ambil data kelompok
		$dat['kelompok'] = $this->m_kelompok->get_all_kelompok($offset,$config['per_page']);

		$data['page_title'] = 'Kelompok';
		$data['page_desc'] = 'daftar kelompok';
		$data['page']       = $this->load->view('kelompok/v_index', $dat, true);
		$this->load->view('v_base',$data);
	}

	// Add a new item
	public function add()
	{

		if($this->input->post())
		{
			$post = array(
                    'kelompok' => $this->input->post('kelompok'),
                    'masa_manfaat' => $this->input->post('masa_manfaat'),
					'tarif_penyusutan' => $this->input->post('tarif_penyusutan')
					
					);
			//print_r($post);

			$q = $this->m_kelompok->insert_kelompok($post);
			$msg = "Input Kelompok Berhasil!";
        	$this->session->set_flashdata("k", $msg);

        	redirect('kelompok');

		}else{
			$data['page_title'] = 'Kelompok';
			$data['page_desc'] = 'tambah kelompok';
			$data['page']       = $this->load->view('kelompok/v_form','', true);
			$this->load->view('v_base',$data);
		}
		
	}

	//Update one item
	public function update( $id = NULL )
	{
		if($this->input->post())
		{
			$post = array(
                'kelompok' => $this->input->post('kelompok'),
                'masa_manfaat' => $this->input->post('masa_manfaat'),
                'tarif_penyusutan' => $this->input->post('tarif_penyusutan')
					);
			//print_r($post);

			$q = $this->m_kelompok->update_kelompok($post,$id);
			$msg = "Update kelompok Berhasil!";
        	$this->session->set_flashdata("k", $msg);

        	redirect('kelompok');

		}else{
			$id = $this->uri->segment(3);
			$data['page_title'] = 'Kelompok';
			$data['page_desc'] = 'Edit kelompok';
			$dat['kelompok'] = $this->m_kelompok->get_kelompok($id);
			$data['page']       = $this->load->view('kelompok/v_edit',$dat, true);
			$this->load->view('v_base',$data);
		}
	}

	//Delete one item
	public function delete( $id = NULL )
	{
		$id=$this->uri->segment(3);
		$this->m_user->delete_kelompok($id);

		$msg = "Delete Kelompok Berhasil!";
        $this->session->set_flashdata("k", $msg);

        redirect('kelompok');
	}
}

/* End of file kelompok.php */
/* Location: ./application/controllers/kelompok.php */
