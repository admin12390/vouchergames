<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sendemail_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //listing Paket
    public function get_sendemail()
    {
        $this->db->select('*');
        $this->db->from('email_send');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    //Detail kirim_email
    public function detail_kirim_email($id)
    {
        $this->db->select('*');
        $this->db->from('email_send');
        $this->db->where('id', $id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->row();
    }
    //tambah / Insert Data
    public function create($data)
    {
        $this->db->insert('email_send', $data);
    }

    //Edit Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('email_send', $data);
    }

    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('email_send', $data);
    }

    public function get_kirim_email_active()
    {
        $this->db->select('*');
        $this->db->from('email_send');
        $this->db->where('status', 1);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}
