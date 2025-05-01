<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    private $table = 'admin';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_by_username($username) {
        return $this->db->get_where($this->table, ['nama_admin' => $username])->row();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id_admin' => $id])->row();
    }
    
    public function get_all() {
        return $this->db->get($this->table)->result();
    }
    
    public function update($id, $data) {
        $this->db->where('id_admin', $id);
        return $this->db->update($this->table, $data);
    }
}