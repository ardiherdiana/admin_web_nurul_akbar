<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acara_model extends CI_Model {
    
    private $table = 'acara';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all() {
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id_acara' => $id])->row();
    }
    
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data) {
        $this->db->where('id_acara', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function delete($id) {
        $this->db->where('id_acara', $id);
        return $this->db->delete($this->table);
    }
    
    public function count_all() {
        return $this->db->count_all($this->table);
    }
    
    public function get_latest($limit) {
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result();
    }
    
    public function get_upcoming() {
        $today = date('Y-m-d');
        $this->db->where('tanggal >=', $today);
        $this->db->order_by('tanggal', 'ASC');
        return $this->db->get($this->table)->result();
    }
}