<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengurus extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Pengurus_model');
        $this->load->library('session');
        $this->load->helper('url');
        
        // Cek apakah sudah login
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth');
        }
    }
    
    public function index() {
        $data['title'] = 'Daftar Pengurus';
        $data['pengurus'] = $this->Pengurus_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pengurus/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function tambah() {
        $data['title'] = 'Tambah Pengurus';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pengurus/tambah', $data);
        $this->load->view('templates/footer');
    }
    
    public function simpan() {
        // Konfigurasi upload gambar
        $config['upload_path'] = './assets/uploads/pengurus/';
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
            'nama_pengurus' => $this->input->post('nama_pengurus'),
            'jabatan' => $this->input->post('jabatan'),
            'jobdesk' => $this->input->post('jobdesk'),
            'catatan' => $this->input->post('catatan')
        ];
        
        // Upload gambar jika ada
        if (!empty($_FILES['foto_pengurus']['name'])) {
            if ($this->upload->do_upload('foto_pengurus')) {
                $upload_data = $this->upload->data();
                $data['foto_pengurus'] = file_get_contents($upload_data['full_path']);
                unlink($upload_data['full_path']); // Hapus file temporary
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('pengurus/tambah');
            }
        }
        
        if ($this->Pengurus_model->create($data)) {
            $this->session->set_flashdata('success', 'Data pengurus berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data pengurus');
        }
        
        redirect('pengurus');
    }
    
    public function edit($id) {
        $data['title'] = 'Edit Pengurus';
        $data['pengurus'] = $this->Pengurus_model->get_by_id($id);
        
        if (!$data['pengurus']) {
            $this->session->set_flashdata('error', 'Data pengurus tidak ditemukan');
            redirect('pengurus');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pengurus/edit', $data);
        $this->load->view('templates/footer');
    }
    
    public function update($id) {
        $pengurus = $this->Pengurus_model->get_by_id($id);
        
        if (!$pengurus) {
            $this->session->set_flashdata('error', 'Data pengurus tidak ditemukan');
            redirect('pengurus');
        }
        
        // Konfigurasi upload gambar
        $config['upload_path'] = './assets/uploads/pengurus/';
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
            'nama_pengurus' => $this->input->post('nama_pengurus'),
            'jabatan' => $this->input->post('jabatan'),
            'jobdesk' => $this->input->post('jobdesk'),
            'catatan' => $this->input->post('catatan')
        ];
        
        // Upload gambar jika ada
        if (!empty($_FILES['foto_pengurus']['name'])) {
            if ($this->upload->do_upload('foto_pengurus')) {
                $upload_data = $this->upload->data();
                $data['foto_pengurus'] = file_get_contents($upload_data['full_path']);
                unlink($upload_data['full_path']); // Hapus file temporary
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('pengurus/edit/' . $id);
            }
        }
        
        if ($this->Pengurus_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Data pengurus berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data pengurus');
        }
        
        redirect('pengurus');
    }
    
    public function hapus($id) {
        $pengurus = $this->Pengurus_model->get_by_id($id);
        
        if (!$pengurus) {
            $this->session->set_flashdata('error', 'Data pengurus tidak ditemukan');
            redirect('pengurus');
        }
        
        if ($this->Pengurus_model->delete($id)) {
            $this->session->set_flashdata('success', 'Data pengurus berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data pengurus');
        }
        
        redirect('pengurus');
    }
}