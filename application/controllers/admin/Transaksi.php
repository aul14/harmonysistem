<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->model('detail_transaksi_model');
        
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
        $data['title'] = "Data Transaksi";
        $data['transaksi'] = $this->detail_transaksi_model->listing2();
        $data['pesan'] = $this->beranda_model->hitungPesan();
        $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
        $data['hitung'] = $this->beranda_model->hitung();
        $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
        $data['karyawan'] = $this->db->get_where('karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav', $data);
        $this->load->view('admin/transaksi/list', $data);
        $this->load->view('admin/layout/footer');
    }
    public function detail($id_transaksi)
    {
        if ($_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifTransaksi', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/transaksi');
        }
        $id_transaksi= decrypt_url($id_transaksi);
        $data['title'] = "Data Detail Transaksi";
        $data['header_transaksi'] = $this->transaksi_model->id_transaksi($id_transaksi);
        $data['nama'] = $this->transaksi_model->namaP($id_transaksi);
        $data['transaksi'] = $this->detail_transaksi_model->id_transaksi($id_transaksi);
        $data['midtrans'] = $this->Konfigurasi_model->detailmidtrans($id_transaksi)->result();
        $data['pesan'] = $this->beranda_model->hitungPesan();
        $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
        $data['karyawan'] = $this->db->get_where('karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $data['hitung'] = $this->beranda_model->hitung();
        $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav', $data);
        $this->load->view('admin/transaksi/detail', $data);
        $this->load->view('admin/layout/footer');
    }
    public function dikirim($id)
    {
        if ($_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifTransaksi', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/transaksi');
        }
        $id = decrypt_url($id);
         $data = [
            'pengiriman'=> 'dikirim'
          ];
          $this->db->update('transaksi',$data,['id_transaksi'=>$id]);
          
          redirect('admin/transaksi','refresh');
    }
    public function dikemas($id)
    {
        if ($_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifTransaksi', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/transaksi');
        }
        $id = decrypt_url($id);
         $data = [
            'pengiriman'=> 'dikemas'
          ];
          $this->db->update('transaksi',$data,['id_transaksi'=>$id]);
          
          redirect('admin/transaksi','refresh');
    }
    public function selesai($id)
    {
        if ($_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifTransaksi', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/transaksi');
        }
        $id = decrypt_url($id);
         $data = [
            'pengiriman'=> 'Barang sampai kepada pelanggan'
          ];
          $this->db->update('transaksi',$data,['id_transaksi'=>$id]);
          
          redirect('admin/transaksi','refresh');
    }
    public function expire($id)
    {
        if ($_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifTransaksi', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/transaksi');
        }
        $id = decrypt_url($id);
         $data = [
            'pengiriman'=> 'dibatalkan'
          ];
          $this->db->update('transaksi',$data,['id_transaksi'=>$id]);
          
          redirect('admin/transaksi','refresh');
    }
}

/* End of file Transaksi.php */
