<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Pengeluaran_model');
        $this->load->library('session');
        $this->load->helper('url');
        
        // Cek apakah sudah login
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth');
        }
    }
    
    public function index() {
        $data['title'] = 'Data Pengeluaran';
        $data['pengeluaran'] = $this->Pengeluaran_model->get_all();
        $data['total_pengeluaran'] = $this->Pengeluaran_model->sum_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pengeluaran/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function tambah() {
        $data['title'] = 'Tambah Pengeluaran';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pengeluaran/tambah', $data);
        $this->load->view('templates/footer');
    }
    
    public function simpan() {
        $data = [
            'id_admin' => $this->session->userdata('admin_id'),
            'tanggal' => $this->input->post('tanggal'),
            'jumlah' => $this->input->post('jumlah'),
            'tujuan' => $this->input->post('tujuan'),
            'metode_pembayaran' => $this->input->post('metode_pembayaran'),
            'catatan' => $this->input->post('catatan')
        ];
        
        if ($this->Pengeluaran_model->create($data)) {
            $this->session->set_flashdata('success', 'Data pengeluaran berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data pengeluaran');
        }
        
        redirect('pengeluaran');
    }
    
    public function edit($id) {
        $data['title'] = 'Edit Pengeluaran';
        $data['pengeluaran'] = $this->Pengeluaran_model->get_by_id($id);
        
        if (!$data['pengeluaran']) {
            $this->session->set_flashdata('error', 'Data pengeluaran tidak ditemukan');
            redirect('pengeluaran');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pengeluaran/edit', $data);
        $this->load->view('templates/footer');
    }
    
    public function update($id) {
        $pengeluaran = $this->Pengeluaran_model->get_by_id($id);
        
        if (!$pengeluaran) {
            $this->session->set_flashdata('error', 'Data pengeluaran tidak ditemukan');
            redirect('pengeluaran');
        }
        
        $data = [
            'id_admin' => $this->session->userdata('admin_id'),
            'tanggal' => $this->input->post('tanggal'),
            'jumlah' => $this->input->post('jumlah'),
            'tujuan' => $this->input->post('tujuan'),
            'metode_pembayaran' => $this->input->post('metode_pembayaran'),
            'catatan' => $this->input->post('catatan')
        ];
        
        if ($this->Pengeluaran_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Data pengeluaran berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data pengeluaran');
        }
        
        redirect('pengeluaran');
    }
    
    public function hapus($id) {
        $pengeluaran = $this->Pengeluaran_model->get_by_id($id);
        
        if (!$pengeluaran) {
            $this->session->set_flashdata('error', 'Data pengeluaran tidak ditemukan');
            redirect('pengeluaran');
        }
        
        if ($this->Pengeluaran_model->delete($id)) {
            $this->session->set_flashdata('success', 'Data pengeluaran berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data pengeluaran');
        }
        
        redirect('pengeluaran');
    }
    
    public function laporan() {
        $data['title'] = 'Laporan Pengeluaran';
        
        // Filter berdasarkan tanggal
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        
        if ($tanggal_mulai && $tanggal_akhir) {
            $data['pengeluaran'] = $this->Pengeluaran_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total'] = $this->Pengeluaran_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
        } else {
            // Default tampilkan bulan ini
            $bulan_ini = date('Y-m');
            $tanggal_mulai = $bulan_ini . '-01';
            $tanggal_akhir = date('Y-m-t', strtotime($tanggal_mulai));
            
            $data['pengeluaran'] = $this->Pengeluaran_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total'] = $this->Pengeluaran_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
        }
        
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['tanggal_akhir'] = $tanggal_akhir;
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pengeluaran/laporan', $data);
        $this->load->view('templates/footer');
    }
    
    public function cetak_laporan() {
        // Filter berdasarkan tanggal
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        
        if ($tanggal_mulai && $tanggal_akhir) {
            $data['pengeluaran'] = $this->Pengeluaran_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total'] = $this->Pengeluaran_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
        } else {
            // Default tampilkan bulan ini
            $bulan_ini = date('Y-m');
            $tanggal_mulai = $bulan_ini . '-01';
            $tanggal_akhir = date('Y-m-t', strtotime($tanggal_mulai));
            
            $data['pengeluaran'] = $this->Pengeluaran_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total'] = $this->Pengeluaran_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
        }
        
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['tanggal_akhir'] = $tanggal_akhir;
        $data['judul'] = 'Laporan Pengeluaran';
        
        $this->load->view('pengeluaran/cetak_laporan', $data);
    }
}