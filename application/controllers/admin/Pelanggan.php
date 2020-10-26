<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelanggan_model');
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        if (!$_SESSION['email_karyawan']) {
            $this->session->set_flashdata('notifLogin', '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
                </button>
                <strong>Gagal!</strong> Silahkan Login Terlebih Dahulu.
                </div>');
            redirect('admin/login');
        }
    }
    
    public function index()
    {
        $data['title'] = "Data Pelanggan";
        $data['pelanggan'] = $this->pelanggan_model->listing();
        $data['pesan'] = $this->beranda_model->hitungPesan();
        $data['hitung'] = $this->beranda_model->hitung();
        $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
        $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
        $data['karyawan'] = $this->db->get_where('karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav', $data);
        $this->load->view('admin/pelanggan/list', $data);
        $this->load->view('admin/layout/footer');
    }

    public function hapus($id)
    {
        $this->pelanggan_model->hapus($id);
        $this->session->set_flashdata('notifPelanggan', '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
            </button>
                <strong>Sukses!</strong> Data Pelanggan Berhasil Dihapus.
                </div');
            
            redirect('admin/pelanggan','refresh');
    }

}

/* End of file Pelanggan.php */
