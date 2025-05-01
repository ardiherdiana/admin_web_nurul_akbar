<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Pemasukan_model');
        $this->load->library('session');
        $this->load->helper('url');
        
        // Cek apakah sudah login
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth');
        }
    }
    
    public function index() {
        $data['title'] = 'Data Pemasukan';
        $data['pemasukan'] = $this->Pemasukan_model->get_all();
        $data['total_pemasukan'] = $this->Pemasukan_model->sum_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pemasukan/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function tambah() {
        $data['title'] = 'Tambah Pemasukan';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pemasukan/tambah', $data);
        $this->load->view('templates/footer');
    }
    
    public function simpan() {
        $data = [
            'id_admin' => $this->session->userdata('admin_id'),
            'nama_donatur' => $this->input->post('nama_donatur'),
            'tanggal' => $this->input->post('tanggal'),
            'jumlah' => $this->input->post('jumlah'),
            'jenis_pemasukan' => $this->input->post('jenis_pemasukan'),
            'metode_pembayaran' => $this->input->post('metode_pembayaran'),
            'catatan' => $this->input->post('catatan')
        ];
        
        if ($this->Pemasukan_model->create($data)) {
            $this->session->set_flashdata('success', 'Data pemasukan berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data pemasukan');
        }
        
        redirect('pemasukan');
    }
    
    public function edit($id) {
        $data['title'] = 'Edit Pemasukan';
        $data['pemasukan'] = $this->Pemasukan_model->get_by_id($id);
        
        if (!$data['pemasukan']) {
            $this->session->set_flashdata('error', 'Data pemasukan tidak ditemukan');
            redirect('pemasukan');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pemasukan/edit', $data);
        $this->load->view('templates/footer');
    }
    
    public function update($id) {
        $pemasukan = $this->Pemasukan_model->get_by_id($id);
        
        if (!$pemasukan) {
            $this->session->set_flashdata('error', 'Data pemasukan tidak ditemukan');
            redirect('pemasukan');
        }
        
        $data = [
            'id_admin' => $this->session->userdata('admin_id'),
            'nama_donatur' => $this->input->post('nama_donatur'),
            'tanggal' => $this->input->post('tanggal'),
            'jumlah' => $this->input->post('jumlah'),
            'jenis_pemasukan' => $this->input->post('jenis_pemasukan'),
            'metode_pembayaran' => $this->input->post('metode_pembayaran'),
            'catatan' => $this->input->post('catatan')
        ];
        
        if ($this->Pemasukan_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Data pemasukan berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data pemasukan');
        }
        
        redirect('pemasukan');
    }
    
    public function hapus($id) {
        $pemasukan = $this->Pemasukan_model->get_by_id($id);
        
        if (!$pemasukan) {
            $this->session->set_flashdata('error', 'Data pemasukan tidak ditemukan');
            redirect('pemasukan');
        }
        
        if ($this->Pemasukan_model->delete($id)) {
            $this->session->set_flashdata('success', 'Data pemasukan berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data pemasukan');
        }
        
        redirect('pemasukan');
    }
    
    public function laporan() {
        $data['title'] = 'Laporan Pemasukan';
        
        // Filter berdasarkan tanggal
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        
        if ($tanggal_mulai && $tanggal_akhir) {
            $data['pemasukan'] = $this->Pemasukan_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total'] = $this->Pemasukan_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
        } else {
            // Default tampilkan bulan ini
            $bulan_ini = date('Y-m');
            $tanggal_mulai = $bulan_ini . '-01';
            $tanggal_akhir = date('Y-m-t', strtotime($tanggal_mulai));
            
            $data['pemasukan'] = $this->Pemasukan_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total'] = $this->Pemasukan_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
        }
        
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['tanggal_akhir'] = $tanggal_akhir;
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pemasukan/laporan', $data);
        $this->load->view('templates/footer');
    }
    
    public function cetak_laporan() {
        // Filter berdasarkan tanggal
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        
        if ($tanggal_mulai && $tanggal_akhir) {
            $data['pemasukan'] = $this->Pemasukan_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total'] = $this->Pemasukan_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
        } else {
            // Default tampilkan bulan ini
            $bulan_ini = date('Y-m');
            $tanggal_mulai = $bulan_ini . '-01';
            $tanggal_akhir = date('Y-m-t', strtotime($tanggal_mulai));
            
            $data['pemasukan'] = $this->Pemasukan_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total'] = $this->Pemasukan_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
        }
        
        $data['tanggal_mulai'] = $tanggal_mulai;
        $data['tanggal_akhir'] = $tanggal_akhir;
        $data['judul'] = 'Laporan Pemasukan';
        
        $this->load->view('pemasukan/cetak_laporan', $data);
    }
}