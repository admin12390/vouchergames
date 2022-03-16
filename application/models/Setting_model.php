<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_meta()
  {
    $query = $this->db->get('email_setting');
    return $query->row();
  }
  public function email_register()
  {
    $this->db->select('*');
    $this->db->from('email_setting');
    $this->db->where('id', 1);
    $query = $this->db->get();
    return $query->row();
  }
  public function email_order()
  {
    $this->db->select('*');
    $this->db->from('email_setting');
    $this->db->where('id', 2);
    $query = $this->db->get();
    return $query->row();
  }
  public function detail_setting($id)
  {
    $this->db->select('*');
    $this->db->from('email_setting');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('email_setting', $data);
  }
  public function sendemail_status_all()
  {
    $this->db->select('*');
    $this->db->from('email_send');
    $query = $this->db->get();
    return $query->result();
  }
  public function sendemail_status_order()
  {
    $this->db->select('*');
    $this->db->from('email_send');
    $this->db->where('type', 'Order');
    $query = $this->db->get();
    return $query->row();
  }
  public function sendemail_status_register()
  {
    $this->db->select('*');
    $this->db->from('email_send');
    $this->db->where('type', 'Register');
    $query = $this->db->get();
    return $query->row();
  }
}
