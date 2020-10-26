<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('beranda_model');
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
        $data['title'] = "Halaman Admin";
        $data['pelanggan'] = $this->beranda_model->hitungPelanggan();
        $data['pesan'] = $this->beranda_model->hitungPesan();
        $data['hitung'] = $this->beranda_model->hitung();
        $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
        $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
        $data['produk'] = $this->beranda_model->hitungProduk();
        $data['tbl_karyawan'] = $this->beranda_model->hitungKaryawan();
        $data['barang_min'] = $this->beranda_model->min('produk', 'stok', 10);
        $data['karyawan'] = $this->db->get_where('karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();

         // Line Chart
         $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
         $data['transaksi'] = [];
         $data['transaksi2'] = [];
         $data['transaksi4'] = [];
         $data['transaksi5'] = [];
 
         foreach ($bln as $b) {
            $data['transaksi'][] = $this->beranda_model->chartTransaksi($b);
            $data['transaksi2'][] = $this->beranda_model->chartTransaksi2($b);
            $data['transaksi4'][] = $this->beranda_model->chartTransaksi3($b);
            $data['transaksi5'][] = $this->beranda_model->chartTransaksi4($b);
         }
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav', $data);
        $this->load->view('admin/layout/isi', $data);
        $this->load->view('admin/layout/footer');
    }
}

/* End of file Beranda.php */
