<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//check login
		is_logged_in();
		//Load Dependencies
		$this->load->library('pagination');
		$this->load->model('m_user');
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
		
		$config['base_url'] = site_url('user/page');
		$config['total_rows'] = $this->m_user->get_jumlah_records();
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

		//ambil data koleksi
		$dat['user'] = $this->m_user->get_all_user($offset,$config['per_page']);

		$data['page_title'] = 'User';
		$data['page_desc'] = 'daftar user';
		$data['page']       = $this->load->view('user/v_index', $dat, true);
		$this->load->view('v_base',$data);
	}

	// Add a new item
	public function add()
	{

		if($this->input->post())
		{
			$post = array(
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					
					'password' => md5($this->input->post('password')),
					
					'level' => $this->input->post('level')
					
					);
			//print_r($post);

			$q = $this->m_user->insert_user($post);
			$msg = "Input User Berhasil!";
        	$this->session->set_flashdata("k", $msg);

        	redirect('user');

		}else{
			$data['page_title'] = 'User';
			$data['page_desc'] = 'tambah user';
			$data['page']       = $this->load->view('user/v_form','', true);
			$this->load->view('v_base',$data);
		}
		
	}

	//Update one item
	public function update( $id = NULL )
	{
		if($this->input->post())
		{
			$post = array(
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					
					
					
					'level' => $this->input->post('level')
					);
			//print_r($post);

			$q = $this->m_user->update_user($post,$id);
			$msg = "Update User Berhasil!";
        	$this->session->set_flashdata("k", $msg);

        	if($this->session->userdata('id') != 1){
        		redirect('dashboard');
        	}
        	else{
        		redirect('user');
        	}

		}else{
			$id = $this->uri->segment(3);
			$data['page_title'] = 'User';
			$data['page_desc'] = 'Edit user';
			$dat['user'] = $this->m_user->get_user($id);
			$data['page']       = $this->load->view('user/v_edit',$dat, true);
			$this->load->view('v_base',$data);
		}
	}

	//Delete one item
	public function delete( $id = NULL )
	{
		$id=$this->uri->segment(3);
		$this->m_user->delete_user($id);

		$msg = "Delete User Berhasil!";
        $this->session->set_flashdata("k", $msg);

        redirect('user');
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
