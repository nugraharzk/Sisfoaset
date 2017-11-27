<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Penghapusan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//check login
		is_logged_in();
		//Load Dependencies
		$this->load->library('pagination');
		//$this->load->library('app_lib');
        $this->load->model('m_pengadaan');
		$this->load->model('m_kelompok');
		$this->load->model('m_user');
		$this->load->model('m_asset');
		$this->load->model('m_notifikasi');
		
		
		// $this->output->enable_profiler(true);

	}

	// List all your items
	public function page()
	{
		$this->index();
	}

	public function index()
	{
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('pengadaan/page');
		$config['total_rows'] = $this->m_pengadaan->get_jumlah_records();
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

		//ambil data
		$dat['asset'] = $this->m_asset->get_all_asset($offset,$config['per_page']);

		$data['page_title'] = 'Penghapusan';
		$data['page_desc'] = 'daftar asset yang akan dihapus';
		$data['page']       = $this->load->view('asset/v_hapus', $dat, true);
		$this->load->view('v_base',$data);
	}

	public function delete( $id = NULL )
	{
		$id=$this->uri->segment(3);
		$cari = $this->m_asset->get_asset($id);
		// $this->m_asset->delete_asset($id);

		$data_notif = array(
				'sender_id' => $this->session->userdata('user_id'),
				'recipient_id' => 2,	// laporan masuk ke Dirut
				'title' => 'Penghapusan asset',
				'message' => 'Aset telah diajukan untuk dihapus!',
				'date' => date('Y-m-d H:i:s')
			);

		$this->m_notifikasi->insert_notifikasi($data_notif);
		$post = array('status'=>1);
		$this->m_asset->update_asset($post,$id);

		$msg = "Delete Asset Telah Diajukan!";
        $this->session->set_flashdata("k", $msg);

        redirect('penghapusan');
	}
}
?>