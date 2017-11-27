<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//check login
		is_logged_in();
		//Load Dependencies
		$this->load->library('pagination');
        $this->load->model('m_user');
        $this->load->model('m_notifikasi');
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
		
		$config['base_url'] = site_url('notifikasi/page');
		$config['total_rows'] = $this->m_notifikasi->get_jumlah_records();
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
		$dat['user'] = $this->m_notifikasi->get_all_notifikasi($offset,$config['per_page']);

		$data['page_title'] = 'Riwayat';
		$data['page_desc'] = 'daftar riwayat';
		$data['page']       = $this->load->view('notifikasi/v_index', $dat, true);
		$this->load->view('v_base',$data);
	}

	

	//Delete one item
	public function delete( $id = NULL )
	{
		$id=$this->uri->segment(3);
		$this->m_user->delete_notifikasi($id);

		$msg = "Delete Notifikasi Berhasil!";
        $this->session->set_flashdata("k", $msg);

        redirect('notifikasi');
	}
}

/* End of file notifikasi.php */
/* Location: ./application/controllers/notifikasi.php */
