<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  //List Semua Product dengan Limit Pagination
  public function get_product($limit, $start)
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Product Main Page
  public function total_row()
  {
    $this->db->select('*');
    $this->db->from('product');

    $this->db->where(['product_status'     => 1]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Total Detail product
  public function product_detail($id)
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function detail_product($product_id)
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where('id', $product_id);
    $query = $this->db->get();
    return $query->row();
  }
  //Paket
  public function listvoucher($product_id)
  {
    $this->db->select('*');
    $this->db->from('voucher');
    $this->db->where('product_id', $product_id);
    $this->db->order_by('voucher.voucher_price', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  // Insert data product ke database
  public function create($data)
  {
    $this->db->insert('product', $data);
  }
  //Update Data product ke database
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('product', $data);
  }
  //Hapus Data Dari Database
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('product', $data);
  }
  // Data Product yang di tampilkan di Front End
  //listing Product Main Page
  public function product($limit, $start)
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where(['product_status'     =>  1]);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  public function product_home()
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where(['product_status'     =>  1]);
    $this->db->order_by('product.id', 'DESC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Product Main Page
  public function total()
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where(['product_status'     =>  1]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  //Read Product
  public function read($product_slug)
  {
    $this->db->select('*');
    $this->db->from('product');
    $this->db->where(array(
      'product_status'           =>  1,
      'product.product_slug'      =>  $product_slug
    ));
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
  // Update Counter Views Product
  function update_counter($product_slug)
  {
    // return current article views
    $this->db->where('product_slug', urldecode($product_slug));
    $this->db->select('product_views');
    $count = $this->db->get('product')->row();
    // then increase by one
    $this->db->where('product_slug', urldecode($product_slug));
    $this->db->set('product_views', ($count->product_views + 1));
    $this->db->update('product');
  }
}
