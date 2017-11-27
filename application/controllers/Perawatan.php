<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Perawatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//check login
		is_logged_in();
		//Load Dependencies
		$this->load->library('pagination');
		//$this->load->library('app_lib');
		$this->load->model('m_kelompok');
		$this->load->model('m_user');
		$this->load->model('m_asset');
		$this->load->model('m_notifikasi');
		$this->load->model('m_perawatan');
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
		// $config['total_rows'] = $this->m_perawatan>get_jumlah_records();
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
		$dat['asset_rawat'] = $this->m_perawatan->get_all_perawatan($offset,$config['per_page']);

		$data['page_title'] = 'Perawatan';
		$data['page_desc'] = 'daftar asset yang akan dirawat';
		
		date_default_timezone_set('Asia/Jakarta');
		$date1 = new DateTime();
		$date2 = new DateTime('2009-08-12');

		$diff = $date1->diff($date2);

		$data['page']       = $this->load->view('perawatan/v_rawat', $dat, true);
		$this->load->view('v_base',$data);
	}

	public function add( $id = NULL )
	{
		$data = array(
			'status_rawat' => 1
		);
		$this->m_asset->update_asset($data,$id);

		redirect('perawatan');
	}

	public function addDetail($id = NULL)
	{
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('perawatan/addDetail');
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
		$dat['kelompok'] = $this->m_kelompok->get_kelompok($dat['asset']->id_kelompok);

		$data['page_title'] = 'Asset';
		$data['page_desc'] = 'daftar asset';
		$data['page']       = $this->load->view('perawatan/v_edit', $dat, true);
		$this->load->view('v_base',$data);
	}

	public function addedDetail($id)
	{
		$asset = $this->m_asset->get_asset($id);
		$kel = $this->m_kelompok->get_kelompok($asset->id_kelompok);
		$post = array(
                'id_kelompok' => $asset->id_kelompok,
                'id_asset' => $id,
                'nama' => $asset->nama,
                'jenis' => $asset->jenis,
                'kelompok' => $kel->kelompok,
                'tanggal_pengadaan' => $asset->tanggal_pengadaan,
                'quantity' => $asset->quantity,
                'nilai' => $asset->nilai,
                'merek' => $asset->merek,
                'type' => $asset->type,
                'spesifikasi' => $asset->spesifikasi,
                'serial_number' => $asset->serial_number,
                'waranty_expired' => $asset->waranty_expired,
                'jenis_rawat' => $this->input->post('jenis_rawat'),
                'biaya_rawat' => $this->input->post('biaya_rawat')
				);
		// print_r($post);

		$dara = array(
				'status_rawat' => 2
				);
		$this->m_asset->update_asset($dara,$id);

		$q = $this->m_perawatan->insert_perawatan($post);
		$n_title = 'Perawatan asset';
		$n_mesasge = 'Pengajuan perawatan oleh logistik';
		//get user by level

		$user = $this->m_user->get_user_by_level('bendahara');

		// print_r($user);
		$notif = array(
			'sender_id'=>$this->session->userdata('user_id'),
			'recipient_id' =>$user->id,
			'title'=>$n_title,
			'message'=>$n_mesasge
		);

		$this->m_notifikasi->insert_notifikasi($notif);
		
		$msg = "Pengajuan Perawatan Berhasil!";
    	$this->session->set_flashdata("k", $msg);

    	redirect('perawatan');
	}

	public function delete( $id = NULL )
	{
		$data = array(
			'status_rawat' => 0
		);
		$this->m_asset->update_asset($data,$id);
		$this->m_perawatan->delete_perawatan($id);

		redirect('perawatan');
	}

	public function acc_bendahara($id = null)
	{
		//check level user
		if($this->session->userdata('level')=='bendahara')
		{
			//update status 
			$id = $this->uri->segment(3);
			$post = array(
				'status'=>1
			);

			$q = $this->m_perawatan->update_perawatan($post,$id);
			// $q = $this->m_perawatan->get_perawatan($id);
			// print_r($q);

			redirect('perawatan');

		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('perawatan');
		}
	}

	public function acc_dirut($id = null)
	{
		//check level user
		if($this->session->userdata('level')=='dirut')
		{
			//update status 
			$id = $this->uri->segment(3);
			$post = array(
				'status'=>2
			);
			$this->m_perawatan->update_perawatan($post,$id);

			redirect('perawatan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('perawatan');
		}
	}

	public function pencairan_dana($id = null)
	{
		//pencairan dana pengadaan dengan $id
		//check level user
		if($this->session->userdata('level')=='bendahara')
		{
			//update status 
			$id = $this->uri->segment(3);
			$post = array(
				'status'=>3
			);
			$this->m_perawatan->update_perawatan($post,$id);

			redirect('perawatan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('perawatan');
		}
	}

	public function terima_dana($id = null)
	{
		//logistik akses terima dana
		//check level user
		if($this->session->userdata('level')=='logistik')
		{
			//update status 
			$id = $this->uri->segment(3);
			$post = array(
				'status'=>4
			);
			$this->m_perawatan->update_perawatan($post,$id);

			redirect('perawatan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('perawatan');
		}
	}

	public function rawat_aset($id = null)
	{
		//logistik beli aset
		//check level user
		if($this->session->userdata('level')=='logistik')
		{
			//update status 
			$id = $this->uri->segment(3);
			$post = array(
				'status'=>5
			);
			$this->m_perawatan->update_perawatan($post,$id);

			redirect('perawatan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('perawatan');
		}
	}

	public function input_nota($id = null)
	{
		//logistik input nota pengadaan id
		//check level user
		if($this->session->userdata('level')=='logistik')
		{
			//update status 
			$id = $this->uri->segment(3);
			$post = array(
				'status'=>6
			);
			$this->m_perawatan->update_perawatan($post,$id);

			redirect('perawatan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('perawatan');
		}
	}

	
	public function acc_laporan_rawat_bendahara($id = null)
	{
		//check level user
		if($this->session->userdata('level')=='bendahara')
		{
			//update status 
			$id = $this->uri->segment(3);
			$rawat = $this->m_perawatan->get_perawatan($id);

			$asset = $this->m_perawatan->get_perawatan($id);

			$data_asset = array(
				'status_rawat' => 0,
			);

			$data_notif = array(
				'sender_id' => $this->session->userdata('user_id'),
				'recipient_id' => 2,	// laporan masuk ke Dirut
				'title' => 'Perawatan Berhasil',
				'message' => 'Aset telah terawat!',
				'date' => date('Y-m-d H:i:s')
			);

			$this->m_asset->update_asset($data_asset,$rawat->id_asset);
			$this->m_notifikasi->insert_notifikasi($data_notif);
			
			$this->m_perawatan->delete_perawatan($id);

			$msg = "Aset telah terawat dan kembali berfungsi!";
			$this->session->set_flashdata("k", $msg);

			redirect('perawatan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('perawatan');
		}
	}

	public function acc_hapus_dirut($id)
	{
		$this->m_asset->delete_asset($id);
		
		$data = array(
			'sender_id' => $this->session->userdata('user_id'),
			'recipient_id' => 2,
			'title' => 'Persetujuan Penghapusan',
			'message' => 'Pengajuan penghapusan asset disetujui Dirut',
			'date' => date('Y-m-d H:i:s')
		);

		$this->m_notifikasi->insert_notifikasi($data);

		$msg = "Pengajuan penghapusan telah disetujui!";
		$this->session->set_flashdata("k", $msg);

		redirect('perawatan');
	}

	public function tolak_hapus_dirut($id)
	{
		$post = array('status'=>0);
		$this->m_asset->update_asset($post,$id);

		$data = array(
			'sender_id' => $this->session->userdata('user_id'),
			'recipient_id' => 2,
			'title' => 'Penolakan Penghapusan',
			'message' => 'Pengajuan penghapusan asset ditolak Dirut',
			'date' => date('Y-m-d H:i:s')
		);

		$this->m_notifikasi->insert_notifikasi($data);

		$msg = "Pengajuan penghapusan telah ditolak!";
		$this->session->set_flashdata("k", $msg);

		redirect('perawatan');
	}
}
?>