<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Acara_model');
        $this->load->model('Pengurus_model');
        $this->load->model('Pemasukan_model');
        $this->load->model('Pengeluaran_model');
        $this->load->model('Artikel_model');
        $this->load->library('session');
        $this->load->helper('url');

        // Cek apakah sudah login
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['total_acara'] = $this->Acara_model->count_all();
        $data['total_pengurus'] = $this->Pengurus_model->count_all();
        $data['total_pemasukan'] = $this->Pemasukan_model->sum_all();
        $data['total_pengeluaran'] = $this->Pengeluaran_model->sum_all();
        $data['acara_terbaru'] = $this->Acara_model->get_latest(5);
        $data['pemasukan_terbaru'] = $this->Pemasukan_model->get_latest(5);
        $data['pengeluaran_terbaru'] = $this->Pengeluaran_model->get_latest(5);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    // Fungsi untuk halaman profil admin
    public function profil()
    {
        $admin_id = $this->session->userdata('admin_id');
        $data['title'] = 'Profil Admin';
        $data['admin'] = $this->Admin_model->get_by_id($admin_id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/profil', $data);
        $this->load->view('templates/footer');
    }

    // Fungsi untuk memperbarui profil admin
    public function update_profil()
    {
        $admin_id = $this->session->userdata('admin_id');
        $admin = $this->Admin_model->get_by_id($admin_id);

        // Update nama admin
        $data = [
            'nama_admin' => $this->input->post('nama_admin')
        ];

        // Cek apakah password akan diubah
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        if (!empty($current_password) && !empty($new_password)) {
            // Validasi password saat ini
            if (!password_verify($current_password, $admin->password)) {
                $this->session->set_flashdata('error', 'Password saat ini tidak sesuai');
                redirect('dashboard/profil');
            }

            // Validasi konfirmasi password
            if ($new_password !== $confirm_password) {
                $this->session->set_flashdata('error', 'Konfirmasi password baru tidak cocok');
                redirect('dashboard/profil');
            }

            // Update password
            $data['password'] = password_hash($new_password, PASSWORD_DEFAULT);
        }

        // Update data admin
        if ($this->Admin_model->update($admin_id, $data)) {
            // Update session jika nama admin berubah
            if ($data['nama_admin'] !== $this->session->userdata('admin_name')) {
                $this->session->set_userdata('admin_name', $data['nama_admin']);
            }

            $this->session->set_flashdata('success', 'Profil berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui profil');
        }

        redirect('dashboard/profil');
    }
}
