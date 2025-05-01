<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengurus_model extends CI_Model {
    
    private $table = 'pengurus';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all() {
        $this->db->order_by('nama_pengurus', 'ASC');
        return $this->db->get($this->table)->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id_pengurus' => $id])->row();
    }
    
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data) {
        $this->db->where('id_pengurus', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function delete($id) {
        $this->db->where('id_pengurus', $id);
        return $this->db->delete($this->table);
    }
    
    public function count_all() {
        return $this->db->count_all($this->table);
    }
    
    public function get_by_jabatan($jabatan) {
        $this->db->where('jabatan', $jabatan);
        $this->db->order_by('nama_pengurus', 'ASC');
        return $this->db->get($this->table)->result();
    }
}