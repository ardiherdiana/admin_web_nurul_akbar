<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acara extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Acara_model');
        $this->load->library('session');
        $this->load->helper('url');
        
        // Cek apakah sudah login
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth');
        }
    }
    
    public function index() {
        $data['title'] = 'Daftar Acara';
        $data['acara'] = $this->Acara_model->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('acara/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function tambah() {
        $data['title'] = 'Tambah Acara';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('acara/tambah', $data);
        $this->load->view('templates/footer');
    }
    
    public function simpan() {
        // Konfigurasi upload gambar
        $config['upload_path'] = './assets/uploads/acara/';
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
            'nama_acara' => $this->input->post('nama_acara'),
            'tanggal' => $this->input->post('tanggal'),
            'waktu' => $this->input->post('waktu'),
            'tempat' => $this->input->post('tempat'),
            'panitia' => $this->input->post('panitia'),
            'catatan' => $this->input->post('catatan')
        ];
        
        // Upload gambar jika ada
        if (!empty($_FILES['foto_acara']['name'])) {
            if ($this->upload->do_upload('foto_acara')) {
                $upload_data = $this->upload->data();
                $data['foto_acara'] = file_get_contents($upload_data['full_path']);
                unlink($upload_data['full_path']); // Hapus file temporary
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('acara/tambah');
            }
        }
        
        if ($this->Acara_model->create($data)) {
            $this->session->set_flashdata('success', 'Data acara berhasil disimpan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data acara');
        }
        
        redirect('acara');
    }
    
    public function edit($id) {
        $data['title'] = 'Edit Acara';
        $data['acara'] = $this->Acara_model->get_by_id($id);
        
        if (!$data['acara']) {
            $this->session->set_flashdata('error', 'Data acara tidak ditemukan');
            redirect('acara');
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('acara/edit', $data);
        $this->load->view('templates/footer');
    }
    
    public function update($id) {
        $acara = $this->Acara_model->get_by_id($id);
        
        if (!$acara) {
            $this->session->set_flashdata('error', 'Data acara tidak ditemukan');
            redirect('acara');
        }
        
        // Konfigurasi upload gambar
        $config['upload_path'] = './assets/uploads/acara/';
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
            'nama_acara' => $this->input->post('nama_acara'),
            'tanggal' => $this->input->post('tanggal'),
            'waktu' => $this->input->post('waktu'),
            'tempat' => $this->input->post('tempat'),
            'panitia' => $this->input->post('panitia'),
            'catatan' => $this->input->post('catatan')
        ];
        
        // Upload gambar jika ada
        if (!empty($_FILES['foto_acara']['name'])) {
            if ($this->upload->do_upload('foto_acara')) {
                $upload_data = $this->upload->data();
                $data['foto_acara'] = file_get_contents($upload_data['full_path']);
                unlink($upload_data['full_path']); // Hapus file temporary
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('acara/edit/' . $id);
            }
        }
        
        if ($this->Acara_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Data acara berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data acara');
        }
        
        redirect('acara');
    }
    
    public function hapus($id) {
        $acara = $this->Acara_model->get_by_id($id);
        
        if (!$acara) {
            $this->session->set_flashdata('error', 'Data acara tidak ditemukan');
            redirect('acara');
        }
        
        if ($this->Acara_model->delete($id)) {
            $this->session->set_flashdata('success', 'Data acara berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data acara');
        }
        
        redirect('acara');
    }
}