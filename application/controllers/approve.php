<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approve extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Load Dependencies
    $this->load->library('pagination');
    $this->load->model('m_approve');

  }

  // List all your items
  public function page()
  {
    $this->index();
  }
  public function index( $offset = 0 )
  {
    $this->load->library('pagination');
    
    $config['base_url'] = site_url('approve/page');
    $config['total_rows'] = $this->m_approve->get_jumlah_records();
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
    $dat['approval'] = $this->m_approve->get_all_approval($offset,$config['per_page']);

    $data['page_title'] = 'Approval List';
    $data['page_desc'] = 'daftar approval dari logistik';
    $data['page']       = $this->load->view('approve/v_index', $dat, true);
    $this->load->view('v_base',$data);
  }

  // Add a new item
  /*public function add()
  {

    if($this->input->post())
    {
      $post = array(
          'user_id' => $this->session->userdata('user_id'),
          'judul' => $this->input->post('judul'),
          'penulis' => $this->input->post('penulis'),
          'subjek' => $this->input->post('subjek'),
          'kategori' => $this->input->post('kategori'),
          'lampiran' => $this->input->post('lampiran'),
          'c_date' => date('Y-m-d h:i:s')
          );
      //print_r($post);

      $q = $this->m_koleksi->insert_koleksi($post);
      $msg = "Input Koleksi Berhasil!";
          $this->session->set_flashdata("k", $msg);

          redirect('koleksi');

    }else{
      $data['page_title'] = 'Koleksi';
      $data['page_desc'] = 'tambah koleksi';
      $data['page']       = $this->load->view('koleksi/v_form','', true);
      $this->load->view('v_base',$data);
    }
    
  }

  //Update one item
  public function update( $id = NULL )
  {
    if($this->input->post())
    {
      $post = array(
          'user_id' => $this->session->userdata('user_id'),
          'judul' => $this->input->post('judul'),
          'penulis' => $this->input->post('penulis'),
          'subjek' => $this->input->post('subjek'),
          'kategori' => $this->input->post('kategori'),
          'lampiran' => $this->input->post('lampiran'),
          'm_date' => date('Y-m-d h:i:s')
          );
      //print_r($post);

      $q = $this->m_koleksi->update_koleksi($post,$id);
      $msg = "Update Koleksi Berhasil!";
          $this->session->set_flashdata("k", $msg);

          redirect('koleksi');

    }else{
      $id = $this->uri->segment(3);
      $data['page_title'] = 'Koleksi';
      $data['page_desc'] = 'Edit koleksi';
      $dat['koleksi'] = $this->m_koleksi->get_koleksi($id);
      $data['page']       = $this->load->view('koleksi/v_edit',$dat, true);
      $this->load->view('v_base',$data);
    }
  }

  //Delete one item
  public function delete( $id = NULL )
  {
    $id=$this->uri->segment(3);
    $this->m_koleksi->delete_koleksi($id);

    $msg = "Delete Koleksi Berhasil!";
        $this->session->set_flashdata("k", $msg);

        redirect('koleksi');
  }*/
}

/* End of file koleksi.php */
/* Location: ./application/controllers/koleksi.php */
