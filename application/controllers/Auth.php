<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('session');
        $this->load->helper('url');
    }
    
    public function index() {
        // Redirect jika sudah login
        if ($this->session->userdata('admin_id')) {
            redirect('dashboard');
        }
        
        $this->load->view('auth/login');
    }
    
    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $admin = $this->Admin_model->get_by_username($username);
        
        if ($admin && password_verify($password, $admin->password)) {
            // Set session
            $this->session->set_userdata([
                'admin_id' => $admin->id_admin,
                'admin_name' => $admin->nama_admin,
                'is_logged_in' => true
            ]);
            
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect('auth');
        }
    }
    
    public function logout() {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('is_logged_in');
        
        redirect('auth');
    }
}