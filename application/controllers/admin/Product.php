<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
  /**
   * Development By Edi Prasetyo
   * edikomputer@gmail.com
   * 0812 3333 5523
   * https://edikomputer.com
   * https://grahastudio.com
   */
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->model('product_model');
    $this->load->model('voucher_model');
    $this->load->library('pagination');
  }

  public function index()
  {
    $config['base_url']         = base_url('admin/product/index/');
    $config['total_rows']       = count($this->product_model->total_row());
    $config['per_page']         = 5;
    $config['uri_segment']      = 4;

    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';

    $limit                      = $config['per_page'];
    $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;

    $this->pagination->initialize($config);
    $product = $this->product_model->get_product($limit, $start);
    $data = [
      'title'                   => 'Data Product',
      'product'                  => $product,
      'pagination'              => $this->pagination->create_links(),
      'content'                 => 'admin/product/index'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function create()
  {

    $this->form_validation->set_rules(
      'product_name',
      'Nama Product',
      'required',
      [
        'required'              => 'Nama Product harus di isi',
      ]
    );
    $this->form_validation->set_rules(
      'product_desc',
      'Deskripsi Product',
      'required',
      [
        'required'              => 'Deskripsi Product harus di isi',
      ]
    );
    if ($this->form_validation->run()) {

      $config['upload_path']      = './assets/img/product/';
      $config['allowed_types']    = 'gif|jpg|png|jpeg';
      $config['max_size']         = 5000000;
      $config['max_width']        = 5000000;
      $config['max_height']       = 5000000;
      $config['remove_spaces']    = TRUE;
      $config['encrypt_name']     = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('product_image')) {

        $data = [
          'title'                 => 'Tambah Product',
          'error_upload'          => $this->upload->display_errors(),
          'content'               => 'admin/product/create'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
      } else {
        $upload_data                = array('uploads'  => $this->upload->data());
        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/product/' . $upload_data['uploads']['file_name'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 500;
        $config['height']           = 500;
        $config['thumb_marker']     = '';
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $slugcode = random_string('numeric', 5);
        $product_slug  = url_title($this->input->post('product_name'), 'dash', TRUE);
        $data  = [

          'product_slug'              => $slugcode . '-' . $product_slug,
          'product_name'              => $this->input->post('product_name'),
          'product_desc'              => $this->input->post('product_desc'),
          'topup_rules'               => $this->input->post('topup_rules'),
          'product_image'             => $upload_data['uploads']['file_name'],
          'product_status'            => $this->input->post('product_status'),
          'product_keywords'          => $this->input->post('product_keywords'),
          'field1'                    => $this->input->post('field1'),
          'field2'                    => $this->input->post('field2'),
          'field3'                    => $this->input->post('field3'),
          'field4'                    => $this->input->post('field4'),
          'created_at'                => date('Y-m-d H:i:s')
        ];
        $this->product_model->create($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data Product telah ditambahkan</div>');
        redirect(base_url('admin/product'), 'refresh');
      }
    }

    $data = [
      'title'                       => 'Tambah Product',
      'content'                     => 'admin/product/create'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function Update($id)
  {
    $product = $this->product_model->product_detail($id);

    $valid = $this->form_validation;
    $valid->set_rules(
      'product_name',
      'Judul Product',
      'required',
      ['required'                   => '%s harus diisi']
    );

    if ($valid->run()) {

      if (!empty($_FILES['product_image']['name'])) {

        $config['upload_path']        = './assets/img/product/';
        $config['allowed_types']      = 'gif|jpg|png|jpeg';
        $config['max_size']           = 5000000;
        $config['max_width']          = 5000000;
        $config['max_height']         = 5000000;
        $config['remove_spaces']      = TRUE;
        $config['encrypt_name']       = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('product_image')) {

          $data = [
            'title'                   => 'Edit Product',
            'product'                  => $product,
            'error_upload'            => $this->upload->display_errors(),
            'content'                 => 'admin/product/update'
          ];
          $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

          $upload_data                = array('uploads'  => $this->upload->data());
          $config['image_library']    = 'gd2';
          $config['source_image']     = './assets/img/product/' . $upload_data['uploads']['file_name'];
          $config['create_thumb']     = TRUE;
          $config['maintain_ratio']   = TRUE;
          $config['width']            = 500;
          $config['height']           = 500;
          $config['thumb_marker']     = '';
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();

          if ($product->product_image != "") {
            unlink('./assets/img/product/' . $product->product_image);
          }

          $data  = [
            'id'                        => $id,
            'product_name'              => $this->input->post('product_name'),
            'product_desc'              => $this->input->post('product_desc'),
            'topup_rules'               => $this->input->post('topup_rules'),
            'product_image'             => $upload_data['uploads']['file_name'],
            'product_status'            => $this->input->post('product_status'),
            'product_keywords'          => $this->input->post('product_keywords'),
            'field1'                    => $this->input->post('field1'),
            'field2'                    => $this->input->post('field2'),
            'field3'                    => $this->input->post('field3'),
            'field4'                    => $this->input->post('field4'),
            'updated_at'                => date('Y-m-d H:i:s')
          ];
          $this->product_model->update($data);
          $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
          redirect(base_url('admin/product'), 'refresh');
        }
      } else {

        if ($product->product_image != "")
          $data  = [
            'id'                        => $id,
            'product_name'              => $this->input->post('product_name'),
            'product_desc'              => $this->input->post('product_desc'),
            'topup_rules'               => $this->input->post('topup_rules'),
            'product_status'            => $this->input->post('product_status'),
            'product_keywords'          => $this->input->post('product_keywords'),
            'field1'                    => $this->input->post('field1'),
            'field2'                    => $this->input->post('field2'),
            'field3'                    => $this->input->post('field3'),
            'field4'                    => $this->input->post('field4'),
            'updated_at'                => date('Y-m-d H:i:s')
          ];
        $this->product_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
        redirect(base_url('admin/product'), 'refresh');
      }
    }

    $data = [
      'title'                         => 'Update Product',
      'product'                        => $product,
      'content'                       => 'admin/product/update'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function delete($id)
  {
    is_login();
    $product = $this->product_model->product_detail($id);

    if ($product->product_image != "") {
      unlink('./assets/img/product/' . $product->product_image);
    }

    $data = ['id'                   => $product->id];
    $this->product_model->delete($data);
    $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
    redirect($_SERVER['HTTP_REFERER']);
  }

  // PAKET
  public function voucher($product_id)
  {
    $product      = $this->product_model->detail_product($product_id);
    $voucher      = $this->product_model->listvoucher($product_id);

    $valid = $this->form_validation;

    $valid->set_rules(
      'voucher_name',
      'Nama Voucher',
      'required',
      array('required'      => '%s harus dicontent')
    );

    $valid->set_rules(
      'voucher_price',
      'Harga Voucher',
      'required',
      array('required'      => '%s harus dicontent')
    );

    if ($valid->run() === FALSE) {
      $data = array(
        'title'        => 'Tambah Voucher',
        'product'        => $product,
        'voucher'        => $voucher,
        'product_id'     => $product_id,
        'content'      => 'admin/product/index_voucher'
      );
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {
      $i     = $this->input;
      $data  = array(
        'product_id'          => $product_id,
        'voucher_name'        => $i->post('voucher_name'),
        'voucher_price'       => $i->post('voucher_price'),
        'created_at'          => date('Y-m-d H:i:s')
      );
      $this->voucher_model->create($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
      redirect(base_url('admin/product/voucher/' . $product_id), 'refresh');
    }
    $data = array(
      'title'             => 'Tambah Voucher',
      'product'           => $product,
      'voucher'           => $voucher,
      'content'           => 'admin/product/voucher'
    );
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function update_voucher($id)
  {

    $voucher      = $this->voucher_model->detail_voucher($id);
    $product_id   = $voucher->product_id;


    $valid = $this->form_validation;
    $valid->set_rules(
      'voucher_name',
      'Nama Voucher',
      'required',
      array('required'      => '%s harus dicontent')
    );

    $valid->set_rules(
      'voucher_price',
      'Harga Voucher',
      'required',
      array('required'      => '%s harus dicontent')
    );


    if ($valid->run() === FALSE) {
      $data = array(
        'title'             => 'Edit Voucher',
        'voucher'             => $voucher,
        'content'           => 'admin/product/update_voucher'
      );
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {
      $i     = $this->input;
      $data  = array(
        'id'                => $id,
        'product_id'          => $i->post('product_id'),
        'voucher_name'        => $i->post('voucher_name'),
        'voucher_price'       => $i->post('voucher_price'),
        'updated_at'      => date('Y-m-d H:i:s')
      );
      $this->voucher_model->update($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
      redirect(base_url('admin/product/voucher/' . $product_id), 'refresh');
    }

    $data = array(
      'title'         => 'Edit Voucher',
      'voucher'         => $voucher,
      'content'       => 'admin/product/update_voucher'
    );
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }

  public function delete_voucher($id)
  {
    is_login();
    $voucher = $this->voucher_model->detail_voucher($id);
    $data = array('id'   => $voucher->id);
    $this->voucher_model->delete($data);
    $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
