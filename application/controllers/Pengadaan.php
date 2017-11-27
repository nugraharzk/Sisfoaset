<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan extends CI_Controller {

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
	public function index( $offset = 0 )
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
		$dat['pengadaan'] = $this->m_pengadaan->get_all_pengadaan($offset,$config['per_page']);
		$dat['asset'] = $this->m_asset->get_asset_by_status();


		if ($this->session->userdata('level') == 'dirut') {
			$data['page_title'] = 'Pengajuan dan Penghapusan';
			$data['page_desc'] = 'Daftar pengajuan pengadaan dan penghapusan asset';
		}else{
			$data['page_title'] = 'Pengajuan';
			$data['page_desc'] = 'Daftar pengajuan pengadaan';
		}

		$data['page']       = $this->load->view('pengadaan/v_index', $dat, true);
		$this->load->view('v_base',$data);
	}

	// Add a new item
	public function add()
	{

		if($this->input->post())
		{
            $date = new DateTime($this->input->post('tanggal_pengadaan'));
            $date->add(new DateInterval('P5Y'));
			$post = array(
                    'id_kelompok' => $this->input->post('id_kelompok'),
                    'nama' => $this->input->post('nama'),
                    'jenis' => $this->input->post('jenis'),
                    'tanggal_pengadaan' => $this->input->post('tanggal_pengadaan'),
                    'quantity' => $this->input->post('quantity'),
                    'nilai' => $this->input->post('nilai_akuisisi'),
                    'merek' => $this->input->post('merek'),
                    'type' => $this->input->post('type'),
                    'spesifikasi' => $this->input->post('spesifikasi'),
                    'serial_number' => $this->input->post('serial_number'),
                    'waranty_expired' => $date->format('Y-m-d'),
                    'c_date' => date('Y-m-d H:i:s')
					);
			// print_r($post);

			$q = $this->m_pengadaan->insert_pengadaan($post);
			$n_title = 'Pengadaan baru';
			$n_mesasge = 'Pengajuan pengadaan baru oleh logistik';
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
			
			$msg = "Input Pengadaan Berhasil!";
        	$this->session->set_flashdata("k", $msg);

        	redirect('pengadaan');

		}else{
			$data['page_title'] = 'Pengadaan';
			$data['page_desc'] = 'tambah pengadaan';
			$dat['kelompok'] = $this->m_kelompok->get_all_kelompok(0,1000);
			$data['page']       = $this->load->view('pengadaan/v_form',$dat, true);
			$this->load->view('v_base',$data);
		}
		
	}

	//Update one item
	public function update( $id = NULL )
	{
		if($this->input->post())
		{
			$date = new DateTime($this->input->post('tanggal_pengadaan'));
            $date->add(new DateInterval('P5Y'));
			$post = array(
                'id_kelompok' => $this->input->post('id_kelompok'),
                //'nik' => $this->input->post('nik'),
                'nama' => $this->input->post('nama'),
                'jenis' => $this->input->post('jenis'),
                'tanggal_pengadaan' => $this->input->post('tanggal_pengadaan'),
                'quantity' => $this->input->post('quantity'),
                'nilai' => $this->input->post('nilai_akuisisi'),
                'merek' => $this->input->post('merek'),
                'type' => $this->input->post('type'),
                'spesifikasi' => $this->input->post('spesifikasi'),
                'serial_number' => $this->input->post('serial_number'),
                'waranty_expired' => $date,
                'm_date' => date('Y-m-d H:i:s')
				);
			//print_r($post);

			$q = $this->m_pengadaan->update_pengadaan($post,$id);
			$msg = "Update Pengadaan Berhasil!";
        	$this->session->set_flashdata("k", $msg);

        	redirect('asset');

		}else{
			$id = $this->uri->segment(3);
			$data['page_title'] = 'Pengadaan';
			$data['page_desc'] = 'Edit pengadaan';
			$dat['asset'] = $this->m_asset->get_asset($id);
			$data['page']       = $this->load->view('pengadaan/v_edit',$dat, true);
			$this->load->view('v_base',$data);
		}
	}

	//Delete one item
	public function delete( $id = NULL )
	{
		$id=$this->uri->segment(3);
		$this->m_pengadaan->delete_pengadaan($id);

		$msg = "Delete Pengadaan Berhasil!";
        $this->session->set_flashdata("k", $msg);

        redirect('pengadaan');
	}

	//Delete one item
	public function deleteAcc( $id = NULL )
	{
		$id=$this->uri->segment(3);
		$this->m_pengadaan->delete_pengadaan($id);
	}

	public function hapus($offset = 0)
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
		$data['page']       = $this->load->view('pengadaan/v_hapus', $dat, true);
		$this->load->view('v_base',$data);
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
			$this->m_pengadaan->update_pengadaan($post,$id);

			redirect('pengadaan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('pengadaan');
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
			$this->m_pengadaan->update_pengadaan($post,$id);

			redirect('pengadaan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('pengadaan');
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
			$this->m_pengadaan->update_pengadaan($post,$id);

			redirect('pengadaan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('pengadaan');
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
			$this->m_pengadaan->update_pengadaan($post,$id);

			redirect('pengadaan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('pengadaan');
		}
	}

	public function beli_aset($id = null)
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
			$this->m_pengadaan->update_pengadaan($post,$id);

			redirect('pengadaan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('pengadaan');
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
			$this->m_pengadaan->update_pengadaan($post,$id);

			redirect('pengadaan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('pengadaan');
		}
	}

	
	public function acc_laporan_beli_bendahara($id = null)
	{
		//check level user
		if($this->session->userdata('level')=='bendahara')
		{
			//update status 
			$id = $this->uri->segment(3);
			$post = array(
				'status'=>7
			);
			$this->m_pengadaan->update_pengadaan($post,$id);

			$asset = $this->m_pengadaan->get_pengadaan($id);

			$data_asset = array(
				'id_kelompok' => $asset->id_kelompok,
				'id_pengadaan' => $id,
				'nama' => $asset->nama,
				'jenis' => $asset->jenis,
				'tanggal_pengadaan' => $asset->tanggal_pengadaan,
				'nilai' => $asset->nilai,
				'merek' => $asset->merek,
				'spesifikasi' => $asset->spesifikasi,
				'serial_number' => $asset->serial_number,
				'waranty_expired' => $asset->waranty_expired,
				'quantity' => $asset->quantity,
				'c_date' => date('Y-m-d H:i:s'),
				'm_date' => date('Y-m-d H:i:s')
			);

			$tgl = new DateTime();
			$data_notif = array(
				'sender_id' => $this->session->userdata('user_id'),
				'recipient_id' => 2,	// laporan masuk ke Dirut
				'title' => 'Pengadaan Berhasil',
				'message' => 'Aset telah tersimpan!',
				'date' => $tgl->format('Y-m-d H:i:s')
			);

			$this->m_asset->insert_asset($data_asset);
			$this->m_notifikasi->insert_notifikasi($data_notif);
			
			$this->deleteAcc($id);

			$msg = "Data pengadaan sudah masuk ke aset!";
			$this->session->set_flashdata("k", $msg);

			redirect('pengadaan');
		}else{
			$msg = "Anda tidak berhak mengakses halaman ini!";
			$this->session->set_flashdata("k", $msg);

			redirect('pengadaan');
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

		redirect('pengadaan');
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

		redirect('pengadaan');
	}
}

/* End of file Pengadaan.php */
/* Location: ./application/controllers/Pengadaan.php */
