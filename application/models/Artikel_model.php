<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel_model extends CI_Model {
    
    private $table = 'artikel';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    // Get all articles
    public function get_all() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    // Get only published articles
    public function get_published() {
        $this->db->where('status', 'published');
        $this->db->order_by('tanggal_publikasi', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    // Get article by ID
    public function get_by_id($id) {
        $this->db->where('id_artikel', $id);
        return $this->db->get($this->table)->row();
    }
    
    // Create new article
    public function create($data) {
        // Log data yang akan diinsert (untuk debugging)
        log_message('debug', 'Inserting article: ' . json_encode(array_keys($data)));
        
        $result = $this->db->insert($this->table, $data);
        
        if (!$result) {
            log_message('error', 'Error inserting article: ' . $this->db->error()['message']);
        }
        
        return $result;
    }
    
    // Update article
    public function update($id, $data) {
        $this->db->where('id_artikel', $id);
        return $this->db->update($this->table, $data);
    }
    
    // Delete article
    public function delete($id) {
        $this->db->where('id_artikel', $id);
        return $this->db->delete($this->table);
    }
    
    // Get articles by status
    public function get_by_status($status) {
        $this->db->where('status', $status);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    // Count articles
    public function count() {
        return $this->db->count_all($this->table);
    }
    
    // Count published articles
    public function count_published() {
        $this->db->where('status', 'published');
        return $this->db->count_all_results($this->table);
    }
    
    // Count draft articles
    public function count_draft() {
        $this->db->where('status', 'draft');
        return $this->db->count_all_results($this->table);
    }
    
    // Search articles
    public function search($keyword) {
        $this->db->like('judul', $keyword);
        $this->db->or_like('isi', $keyword);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    // Check table structure (for debugging)
    public function check_table_structure() {
        return $this->db->field_data($this->table);
    }
}