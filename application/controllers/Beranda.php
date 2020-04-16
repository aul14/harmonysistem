<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Detail_transaksi_model','detail_transaksi_model');
        $this->load->model('Rekening_model');
        if (!$_SESSION['email']) {
            $this->session->set_flashdata('sukses','<strong>Gagal!</strong> Silahkan Login terlebih dahulu');
            redirect('masuk');
        }
        
    }
    
    public function index()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->detail_transaksi_model->pelanggan($id_pelanggan);
        $data=[
            'title' => 'Harmony Sistem | Jual, sewa mesin fotocopy Konica Minolta',
            'header_transaksi' => $header_transaksi,
            'isi' => 'dasbor/list'
        ];
        $this->load->view('layout/wrapper', $data);
        
    }
    public function belanja()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->detail_transaksi_model->pelanggan($id_pelanggan);
        $data=[
            'title' => 'Riwayat Belanja',
            'header_transaksi' => $header_transaksi,
            'isi' => 'dasbor/belanja'
        ];
        $this->load->view('layout/wrapper', $data);
    }
    public function detail($id_transaksi)
    {
        $id_transaksi= decrypt_url($id_transaksi);
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->Transaksi_model->id_transaksi($id_transaksi);
        $transaksi = $this->detail_transaksi_model->id_transaksi($id_transaksi);
        if ($header_transaksi->id_pelanggan != $id_pelanggan) {
            $this->session->set_flashdata('warning', 'Akses tidak diterima');
            
            redirect('beranda','refresh');
            
        } 
        $data=[
            'title' => 'Detail Belanja',
            'header_transaksi' => $header_transaksi,
            'transaksi' => $transaksi,
            'isi' => 'dasbor/detail'
        ];
        $this->load->view('layout/wrapper', $data);
        
    }

    public function profil()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $pelanggan = $this->Pelanggan_model->detail($id_pelanggan);
        $data=[
            'title' => 'Profil '. $this->session->userdata('nama_pelanggan'),
            'pelanggan' => $pelanggan,
            'isi' => 'dasbor/profil'
        ];
        $this->load->view('layout/wrapper', $data);
    }

    public function konfirmasi($id_transaksi)
    {
        $id_transaksi= decrypt_url($id_transaksi);
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->Transaksi_model->id_transaksi($id_transaksi);
        $rekening = $this->Rekening_model->listing();
        if ($header_transaksi->id_pelanggan != $id_pelanggan) {
            $this->session->set_flashdata('warning', 'Akses tidak diterima');
            
            redirect('beranda','refresh');
            
        } 
        $data = [
            'title' => 'Konfirmasi Pembayaran',
            'header_transaksi' => $header_transaksi,
            'rekening' => $rekening,
            'isi' => 'dasbor/konfirmasi'
        ];
        $this->load->view('layout/wrapper', $data);
        
    }

}

/* End of file Dasbor.php */
