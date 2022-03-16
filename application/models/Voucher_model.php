<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Voucher_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  //listing Voucher
  public function get_voucher()
  {
    $this->db->select('*');
    $this->db->from('voucher');
    $this->db->order_by('voucher_name', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }

  //Detail voucher
  public function detail_voucher($id)
  {
    $this->db->select('*');
    $this->db->from('voucher');
    $this->db->where('id', $id);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->row();
  }

  //tambah / Insert Data
  public function create($data)
  {
    $this->db->insert('voucher', $data);
  }

  //Edit Data
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('voucher', $data);
  }

  //Delete Data
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('voucher', $data);
  }
}

/* end of file Voucher_model.php */
/* Location /application/controller/admin/Voucher_model.php */
