<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Artikel_model');
        $this->load->library('session');
        $this->load->helper('url');
        
        // Cek apakah sudah login
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth');
        }
    }
    
    public function index() {
        $data['title'] = 'Kelola Artikel';
        $data['artikel'] = $this->Artikel_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('artikel/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function tambah() {
        $data['title'] = 'Tambah Artikel';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('artikel/tambah', $data);
        $this->load->view('templates/footer');
    }
    
    public function simpan() {
        // Konfigurasi upload gambar
        $config['upload_path'] = './assets/uploads/artikel/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;
        
        // Buat folder jika belum ada
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        
        $this->load->library('upload', $config);
        
        $data = [
            'id_admin' => $this->session->userdata('admin_id'),
            'judul' => $this->input->post('judul'),
            'isi' => $this->input->post('isi'),
            'status' => $this->input->post('status'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Jika status published, tambahkan tanggal publikasi
        if ($data['status'] == 'published') {
            $data['tanggal_publikasi'] = date('Y-m-d');
        }
        
        // Upload gambar jika ada
        if (!empty($_FILES['foto_artikel']['name'])) {
            if ($this->upload->do_upload('foto_artikel')) {
                $upload_data = $this->upload->data();
                $data['foto_artikel'] = file_get_contents($upload_data['full_path']);
                unlink($upload_data['full_path']); // Hapus file temporary
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('artikel/tambah');
            }
        }
        
        if ($this->Artikel_model->create($data)) {
            $this->session->set_flashdata('success', 'Artikel berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan artikel');
        }
        
        redirect('artikel');
    }
    
    public function edit($id) {
        $data['title'] = 'Edit Artikel';
        $data['artikel'] = $this->Artikel_model->get_by_id($id);
        
        if (!$data['artikel']) {
            $this->session->set_flashdata('error', 'Artikel tidak ditemukan');
            redirect('artikel');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('artikel/edit', $data);
        $this->load->view('templates/footer');
    }
    
    public function update($id) {
        $artikel = $this->Artikel_model->get_by_id($id);
        
        if (!$artikel) {
            $this->session->set_flashdata('error', 'Artikel tidak ditemukan');
            redirect('artikel');
        }
        
        // Konfigurasi upload gambar
        $config['upload_path'] = './assets/uploads/artikel/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;
        
        // Buat folder jika belum ada
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        
        $this->load->library('upload', $config);
        
        $data = [
            'id_admin' => $this->session->userdata('admin_id'),
            'judul' => $this->input->post('judul'),
            'isi' => $this->input->post('isi'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // Jika status published dan belum pernah publish, tambahkan tanggal publikasi
        if ($data['status'] == 'published' && ($artikel->status != 'published' || empty($artikel->tanggal_publikasi))) {
            $data['tanggal_publikasi'] = date('Y-m-d');
        }
        
        // Upload gambar jika ada
        if (!empty($_FILES['foto_artikel']['name'])) {
            if ($this->upload->do_upload('foto_artikel')) {
                $upload_data = $this->upload->data();
                $data['foto_artikel'] = file_get_contents($upload_data['full_path']);
                unlink($upload_data['full_path']); // Hapus file temporary
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('artikel/edit/' . $id);
            }
        }
        
        if ($this->Artikel_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Artikel berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui artikel');
        }
        
        redirect('artikel');
    }
    
    public function hapus($id) {
        $artikel = $this->Artikel_model->get_by_id($id);
        
        if (!$artikel) {
            $this->session->set_flashdata('error', 'Artikel tidak ditemukan');
            redirect('artikel');
        }
        
        if ($this->Artikel_model->delete($id)) {
            $this->session->set_flashdata('success', 'Artikel berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus artikel');
        }
        
        redirect('artikel');
    }
    
    public function publikasi($id) {
        $artikel = $this->Artikel_model->get_by_id($id);
        
        if (!$artikel) {
            $this->session->set_flashdata('error', 'Artikel tidak ditemukan');
            redirect('artikel');
        }
        
        $data = [
            'status' => 'published',
            'tanggal_publikasi' => date('Y-m-d'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->Artikel_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Artikel berhasil dipublikasikan');
        } else {
            $this->session->set_flashdata('error', 'Gagal mempublikasikan artikel');
        }
        
        redirect('artikel');
    }
    
    public function draft($id) {
        $artikel = $this->Artikel_model->get_by_id($id);
        
        if (!$artikel) {
            $this->session->set_flashdata('error', 'Artikel tidak ditemukan');
            redirect('artikel');
        }
        
        $data = [
            'status' => 'draft',
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->Artikel_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Artikel berhasil disimpan sebagai draft');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan artikel sebagai draft');
        }
        
        redirect('artikel');
    }
}