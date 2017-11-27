<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//check login
		is_logged_in();
		//load model
		$this->load->library('pagination');
        $this->load->model('m_asset');
        $this->load->model('m_kelompok');
        $this->load->model('m_perawatan');
		//$this->load->model('m_balai');
		//$this->output->enable_profiler(true);

	}

	// List all your items
	public function page()
	{
		$this->index();
	}
	public function index( $offset = 0 )
	{
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('asset/page');
		$config['total_rows'] = $this->m_asset->get_jumlah_records();
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
		$dat['asset'] = $this->m_asset->get_all_jenis($offset,$config['per_page']);
		$dat['jumlah'] = $this->m_asset->getSum();

		$dat['nKendaraan'] = $this->m_asset->getSums('Kendaraan');
		$dat['nMektan'] = $this->m_asset->getSums('AlatLabMekTan');
		$dat['nSurvey'] = $this->m_asset->getSums('AlatSurvey');
		$dat['nKantor'] = $this->m_asset->getSums('AlatKantor');

		$dat['kendaraan'] = $this->m_asset->get_banyak('Kendaraan');
		$dat['mektan'] = $this->m_asset->get_banyak('AlatLabMekTan');
		$dat['survey'] = $this->m_asset->get_banyak('AlatSurvey');
		$dat['kantor'] = $this->m_asset->get_banyak('AlatKantor');
		$dat['sum'] = $this->m_asset->get_jumlah_records();
		// foreach ($dat['asset'] as $row) {
			// $dat['col'] = $this->getBanyak($row->jenis);
		// }

		$data['page_title'] = 'Asset';
		$data['page_desc'] = 'daftar jenis asset';
		$data['page']       = $this->load->view('asset/v_index', $dat, true);
		$this->load->view('v_base',$data);
	}

	public function open($id)
	{
		$this->load->library('pagination');
		
		// $config['base_url'] = site_url('asset/open');
		$config['total_rows'] = $this->m_asset->get_jumlah_records();
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
		$dat['asset'] = $this->m_asset->get_asset_by_jenis($id);

		$data['page_title'] = 'Asset';
		$data['page_desc'] = 'daftar asset';
		$data['page']       = $this->load->view('asset/v_hasil', $dat, true);
		$this->load->view('v_base',$data);
	}

	public function buka($id,$idkel)
	{
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('asset/open');
		$config['total_rows'] = $this->m_asset->get_jumlah_records();
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
		$dat['asset'] = $this->m_asset->get_asset($id);
		$dat['kelompok'] = $this->m_kelompok->get_kelompok($idkel);
		$dat['perawatan'] = $this->m_perawatan->get_perawatan_asset($id);

		$total_nilai = $dat['asset']->nilai * $dat['asset']->quantity;
		$penyusutan = $dat['kelompok']->tarif_penyusutan * $dat['asset']->nilai;
		$penyusutan_bulanan = $penyusutan / 12;

		$date1 = new DateTime();
		$date2 = new DateTime($dat['asset']->tanggal_pengadaan);

		$diff = $date2->diff($date1);
		$month = ($diff->format('%y') * 12) + $diff->format('%m');

		$pertambahan = $dat['asset']->quantity * $dat['kelompok']->waktu_perawatan;

		$umur = $month - $pertambahan;

		$umur_susut = $umur * $penyusutan_bulanan;

		$dat['nilai_buku'] = $total_nilai - $umur_susut;

		$post = array('nilai_buku'=>$dat['nilai_buku']);

		$this->m_asset->update_asset($post,$id);

		$data['page_title'] = 'Asset';
		$data['page_desc'] = 'daftar asset';
		$data['page']       = $this->load->view('asset/v_detail', $dat, true);
		$this->load->view('v_base',$data);
	}

	public function idSearch($id)
	{
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('asset/idSearch');
		$config['total_rows'] = $this->m_asset->get_jumlah_records();
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
		$dat['asset'] = $this->m_asset->get_asset_by_jenis($id);
		// $dat['kelompok'] = $this->m_kelompok->get_kelompok($dat['asset']->id_kelompok);

		$data['page_title'] = 'Asset';
		$data['page_desc'] = 'daftar asset';
		$data['page']       = $this->load->view('asset/v_hasil', $dat, true);
		$this->load->view('v_base',$data);
	}

	// Add a new item
	public function add()
	{

		if($this->input->post())
		{
			$post = array(
                    'id_kelompok' => $this->input->post('id_kelompok'),
                    'nik' => $this->input->post('nik'),
                    'jenis' => $this->input->post('jenis'),
                    'tanggal_pengadaan' => $this->input->post('tanggal_pengadaan'),
                    'nilai_akuisisi' => $this->input->post('nilai_akuisisi'),
                    'merek' => $this->input->post('merek'),
                    'type' => $this->input->post('type'),
                    'spesifikasi' => $this->input->post('spesifikasi'),
                    'serial_number' => $this->input->post('serial_number'),
                    'waranty_expired' => $this->input->post('waranty_expired'),
                    'c_date' => date('Y-m-d H:i:s')
					);
			//print_r($post);

			$q = $this->m_asset->insert_asset($post);
			$msg = "Input Asset Berhasil!";
        	$this->session->set_flashdata("k", $msg);

        	redirect('asset');

		}else{
			$data['page_title'] = 'Asset';
			$data['page_desc'] = 'tambah asset';
			$dat['kelompok'] = $this->m_kelompok->get_all_kelompok(0,1000);
			$data['page']       = $this->load->view('asset/v_form',$dat, true);
			$this->load->view('v_base',$data);
		}
		
	}

	//Update one item
	public function update( $id = NULL )
	{
		if($this->input->post())
		{
			$post = array(
                'id_kelompok' => $this->input->post('id_kelompok'),
                'nik' => $this->input->post('nik'),
                'jenis' => $this->input->post('jenis'),
                'tanggal_pengadaan' => $this->input->post('tanggal_pengadaan'),
                'nilai_akuisisi' => $this->input->post('nilai_akuisisi'),
                'merek' => $this->input->post('merek'),
                'type' => $this->input->post('type'),
                'spesifikasi' => $this->input->post('spesifikasi'),
                'serial_number' => $this->input->post('serial_number'),
                'waranty_expired' => $this->input->post('waranty_expired'),
                'c_date' => date('Y-m-d H:i:s')
					);
			//print_r($post);

			$q = $this->m_asset->update_asset($post,$id);
			$msg = "Update Asset Berhasil!";
        	$this->session->set_flashdata("k", $msg);

        	redirect('asset');

		}else{
			$id = $this->uri->segment(3);
			$data['page_title'] = 'Asset';
			$data['page_desc'] = 'Edit asset';
			$dat['kelompok'] = $this->m_kelompok->get_all_kelompok(0,1000);
			$dat['asset'] = $this->m_asset->get_asset($id);
			$data['page']       = $this->load->view('asset/v_edit',$dat, true);
			$this->load->view('v_base',$data);
		}
	}

	//Delete one item
	public function delete( $id = NULL )
	{
		$id=$this->uri->segment(3);
		$this->m_asset->delete_asset($id);

		$msg = "Delete Asset Berhasil!";
        $this->session->set_flashdata("k", $msg);

        redirect('asset');
	}

	public function getBanyak($id)
	{
		$data = $this->m_asset->get_banyak($id);
		return $data;
	}
}

/* End of file asset.php */
/* Location: ./application/controllers/asset.php */
