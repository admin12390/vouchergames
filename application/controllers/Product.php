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
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
        $this->load->model('product_model');
        $this->load->model('meta_model');
        $this->load->library('pagination');
    }
    public function index()
    {
        $meta                           = $this->meta_model->get_meta();
        $this->load->library('pagination');
        $config['base_url']             = base_url('product/index/');
        $config['total_rows']           = count($this->product_model->total());
        $config['per_page']             = 6;
        $config['uri_segment']          = 3;

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
        $limit                          = $config['per_page'];
        $start                          = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        $this->pagination->initialize($config);
        $product = $this->product_model->product($limit, $start);

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = array(
                'title'                       => 'Berita - ' . $meta->title,
                'deskripsi'                   => 'Berita - ' . $meta->description,
                'keywords'                    => 'Berita - ' . $meta->keywords,
                'paginasi'                    => $this->pagination->create_links(),
                'product'                      => $product,
                'content'                     => 'front/product/index'
            );
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            // Mobile View
            $data = array(
                'title'                       => 'Berita - ' . $meta->title,
                'deskripsi'                   => 'Berita - ' . $meta->description,
                'keywords'                    => 'Berita - ' . $meta->keywords,
                'paginasi'                    => $this->pagination->create_links(),
                'product'                      => $product,
                'content'                     => 'mobile/product/index'
            );
            $this->load->view('mobile/layout/wrapp', $data, FALSE);
        }
    }
    public function item($product_slug = NULL)
    {
        if (!empty($product_slug)) {
            $product_slug;
        } else {
            redirect(base_url('product'));
        }

        $product                    = $this->product_model->read($product_slug);
        $product_id                 = $product->id;
        $list_voucher               = $this->product_model->listvoucher($product_id);

        // if (!$this->agent->is_mobile()) {
        //     // Desktop View
        //     $data                           = array(
        //         'title'                       => $product->product_name,
        //         'deskripsi'                   => $product->product_name,
        //         'keywords'                    => $product->product_keywords,
        //         'product'                      => $product,
        //         'list_voucher'                => $list_voucher,
        //         'content'                     => 'front/product/detail'
        //     );
        //     $this->add_count($product_slug);
        //     $this->load->view('front/layout/wrapp', $data, FALSE);
        // } else {
        //     // Mobile View
        //     $data                           = array(
        //         'title'                       => $product->product_name,
        //         'deskripsi'                   => $product->product_name,
        //         'keywords'                    => $product->berita_keywords,
        //         'product'                      => $product,
        //         'list_voucher'                => $list_voucher,
        //         'content'                     => 'front/product/detail'
        //     );
        //     $this->add_count($product_slug);
        //     $this->load->view('front/layout/wrapp', $data, FALSE);
        // }




        $this->form_validation->set_rules(
            'whatsapp',
            'Nomor Whatsapp',
            'required',
            array(
                'required'                        => '%s Harus Diisi',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                       => $product->product_name,
                'deskripsi'                   => $product->product_name,
                'keywords'                    => $product->product_keywords,
                'product'                      => $product,
                'list_voucher'                => $list_voucher,
                'content'                     => 'front/product/detail'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            $data  = [
                'product_id'                   => $product_id,
                'product_id'                   => $this->input->post('product_id'),
                'product_id'                   => $this->input->post('product_id'),
                'created_at'                    => date('Y-m-d H:i:s')
            ];
            $this->category_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect(base_url('product/success'), 'refresh');
        }
    }



    function add_count($product_slug)
    {
        // load cookie helper
        $this->load->helper('cookie');
        // this line will return the cookie which has slug name
        $check_visitor = $this->input->cookie(urldecode($product_slug), FALSE);
        // this line will return the visitor ip address
        $ip = $this->input->ip_address();
        // if the visitor visit this article for first time then //
        //set new cookie and update article_views column  ..
        //you might be notice we used slug for cookie name and ip
        //address for value to distinguish between articles  views
        if ($check_visitor == false) {
            $cookie = array(
                "name"                      => urldecode($product_slug),
                "value"                     => "$ip",
                "expire"                    =>  time() + 7200,
                "secure"                    => false
            );
            $this->input->set_cookie($cookie);
            $this->product_model->update_counter(urldecode($product_slug));
        }
    }
}
