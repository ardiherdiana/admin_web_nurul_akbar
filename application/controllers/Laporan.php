<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Pemasukan_model');
        $this->load->model('Pengeluaran_model');
        $this->load->library('session');
        $this->load->helper('url');
        
        // Cek apakah sudah login
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth');
        }
    }
    
    public function index() {
        $data['title'] = 'Laporan Keuangan';
        
        // Filter berdasarkan tanggal atau bulan
        $filter_type = $this->input->get('filter_type') ?: 'bulan';
        $tahun = $this->input->get('tahun') ?: date('Y');
        $bulan = $this->input->get('bulan') ?: date('m');
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        
        if ($filter_type == 'periode' && $tanggal_mulai && $tanggal_akhir) {
            // Filter berdasarkan periode tanggal
            $data['filter_type'] = 'periode';
            $data['tanggal_mulai'] = $tanggal_mulai;
            $data['tanggal_akhir'] = $tanggal_akhir;
            
            $data['pemasukan'] = $this->Pemasukan_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total_pemasukan'] = $this->Pemasukan_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
            
            $data['pengeluaran'] = $this->Pengeluaran_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total_pengeluaran'] = $this->Pengeluaran_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
        } else {
            // Filter berdasarkan bulan
            $data['filter_type'] = 'bulan';
            $data['tahun'] = $tahun;
            $data['bulan'] = $bulan;
            
            $tanggal_awal_bulan = $tahun . '-' . $bulan . '-01';
            $tanggal_akhir_bulan = date('Y-m-t', strtotime($tanggal_awal_bulan));
            
            $data['tanggal_mulai'] = $tanggal_awal_bulan;
            $data['tanggal_akhir'] = $tanggal_akhir_bulan;
            
            $data['pemasukan'] = $this->Pemasukan_model->get_by_periode($tanggal_awal_bulan, $tanggal_akhir_bulan);
            $data['total_pemasukan'] = $this->Pemasukan_model->sum_by_period($tanggal_awal_bulan, $tanggal_akhir_bulan);
            
            $data['pengeluaran'] = $this->Pengeluaran_model->get_by_periode($tanggal_awal_bulan, $tanggal_akhir_bulan);
            $data['total_pengeluaran'] = $this->Pengeluaran_model->sum_by_period($tanggal_awal_bulan, $tanggal_akhir_bulan);
        }
        
        // Hitung saldo
        $data['saldo'] = $data['total_pemasukan'] - $data['total_pengeluaran'];
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function cetak() {
        // Filter berdasarkan tanggal atau bulan
        $filter_type = $this->input->get('filter_type') ?: 'bulan';
        $tahun = $this->input->get('tahun') ?: date('Y');
        $bulan = $this->input->get('bulan') ?: date('m');
        $tanggal_mulai = $this->input->get('tanggal_mulai');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        
        if ($filter_type == 'periode' && $tanggal_mulai && $tanggal_akhir) {
            // Filter berdasarkan periode tanggal
            $data['filter_type'] = 'periode';
            $data['tanggal_mulai'] = $tanggal_mulai;
            $data['tanggal_akhir'] = $tanggal_akhir;
            
            $data['pemasukan'] = $this->Pemasukan_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total_pemasukan'] = $this->Pemasukan_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
            
            $data['pengeluaran'] = $this->Pengeluaran_model->get_by_periode($tanggal_mulai, $tanggal_akhir);
            $data['total_pengeluaran'] = $this->Pengeluaran_model->sum_by_period($tanggal_mulai, $tanggal_akhir);
        } else {
            // Filter berdasarkan bulan
            $data['filter_type'] = 'bulan';
            $data['tahun'] = $tahun;
            $data['bulan'] = $bulan;
            
            $tanggal_awal_bulan = $tahun . '-' . $bulan . '-01';
            $tanggal_akhir_bulan = date('Y-m-t', strtotime($tanggal_awal_bulan));
            
            $data['tanggal_mulai'] = $tanggal_awal_bulan;
            $data['tanggal_akhir'] = $tanggal_akhir_bulan;
            
            $data['pemasukan'] = $this->Pemasukan_model->get_by_periode($tanggal_awal_bulan, $tanggal_akhir_bulan);
            $data['total_pemasukan'] = $this->Pemasukan_model->sum_by_period($tanggal_awal_bulan, $tanggal_akhir_bulan);
            
            $data['pengeluaran'] = $this->Pengeluaran_model->get_by_periode($tanggal_awal_bulan, $tanggal_akhir_bulan);
            $data['total_pengeluaran'] = $this->Pengeluaran_model->sum_by_period($tanggal_awal_bulan, $tanggal_akhir_bulan);
        }
        
        // Hitung saldo
        $data['saldo'] = $data['total_pemasukan'] - $data['total_pengeluaran'];
        
        // Judul laporan
        $data['judul'] = 'Laporan Keuangan Masjid';
        
        $this->load->view('laporan/cetak', $data);
    }
    
    public function tahunan() {
        $data['title'] = 'Laporan Keuangan Tahunan';
        
        $tahun = $this->input->get('tahun') ?: date('Y');
        $data['tahun'] = $tahun;
        
        // Array untuk data bulanan
        $data['bulanan'] = [];
        
        // Loop untuk 12 bulan
        for ($i = 1; $i <= 12; $i++) {
            $bulan = sprintf('%02d', $i);
            $tanggal_awal = $tahun . '-' . $bulan . '-01';
            $tanggal_akhir = date('Y-m-t', strtotime($tanggal_awal));
            
            $total_pemasukan = $this->Pemasukan_model->sum_by_period($tanggal_awal, $tanggal_akhir);
            $total_pengeluaran = $this->Pengeluaran_model->sum_by_period($tanggal_awal, $tanggal_akhir);
            $saldo = $total_pemasukan - $total_pengeluaran;
            
            $data['bulanan'][$i] = [
                'bulan' => date('F', strtotime($tanggal_awal)),
                'total_pemasukan' => $total_pemasukan,
                'total_pengeluaran' => $total_pengeluaran,
                'saldo' => $saldo
            ];
        }
        
        // Hitung total tahunan
        $data['total_pemasukan_tahunan'] = array_sum(array_column($data['bulanan'], 'total_pemasukan'));
        $data['total_pengeluaran_tahunan'] = array_sum(array_column($data['bulanan'], 'total_pengeluaran'));
        $data['saldo_tahunan'] = $data['total_pemasukan_tahunan'] - $data['total_pengeluaran_tahunan'];
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('laporan/tahunan', $data);
        $this->load->view('templates/footer');
    }
    
    public function cetak_tahunan() {
        $tahun = $this->input->get('tahun') ?: date('Y');
        $data['tahun'] = $tahun;
        
        // Array untuk data bulanan
        $data['bulanan'] = [];
        
        // Loop untuk 12 bulan
        for ($i = 1; $i <= 12; $i++) {
            $bulan = sprintf('%02d', $i);
            $tanggal_awal = $tahun . '-' . $bulan . '-01';
            $tanggal_akhir = date('Y-m-t', strtotime($tanggal_awal));
            
            $total_pemasukan = $this->Pemasukan_model->sum_by_period($tanggal_awal, $tanggal_akhir);
            $total_pengeluaran = $this->Pengeluaran_model->sum_by_period($tanggal_awal, $tanggal_akhir);
            $saldo = $total_pemasukan - $total_pengeluaran;
            
            $data['bulanan'][$i] = [
                'bulan' => date('F', strtotime($tanggal_awal)),
                'total_pemasukan' => $total_pemasukan,
                'total_pengeluaran' => $total_pengeluaran,
                'saldo' => $saldo
            ];
        }
        
        // Hitung total tahunan
        $data['total_pemasukan_tahunan'] = array_sum(array_column($data['bulanan'], 'total_pemasukan'));
        $data['total_pengeluaran_tahunan'] = array_sum(array_column($data['bulanan'], 'total_pengeluaran'));
        $data['saldo_tahunan'] = $data['total_pemasukan_tahunan'] - $data['total_pengeluaran_tahunan'];
        
        // Judul laporan
        $data['judul'] = 'Laporan Keuangan Tahunan ' . $tahun;
        
        $this->load->view('laporan/cetak_tahunan', $data);
    }
}