<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan_model extends CI_Model {
    
    private $table = 'pemasukan';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all() {
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id_pemasukan' => $id])->row();
    }
    
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data) {
        $this->db->where('id_pemasukan', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function delete($id) {
        $this->db->where('id_pemasukan', $id);
        return $this->db->delete($this->table);
    }
    
    public function sum_all() {
        $this->db->select_sum('jumlah');
        $query = $this->db->get($this->table);
        return $query->row()->jumlah ?? 0;
    }
    
    public function get_latest($limit) {
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result();
    }
    
    public function sum_by_period($start_date, $end_date) {
        $this->db->select_sum('jumlah');
        $this->db->where('tanggal >=', $start_date);
        $this->db->where('tanggal <=', $end_date);
        $query = $this->db->get($this->table);
        return $query->row()->jumlah ?? 0;
    }
    
    public function get_by_jenis($jenis) {
        $this->db->where('jenis_pemasukan', $jenis);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function get_by_periode($tanggal_mulai, $tanggal_akhir) {
        $this->db->where('tanggal >=', $tanggal_mulai);
        $this->db->where('tanggal <=', $tanggal_akhir);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get($this->table)->result();
    }
}