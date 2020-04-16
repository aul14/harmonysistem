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
        $data['produk'] = $this->beranda_model->hitungProduk();
        $data['tbl_karyawan'] = $this->beranda_model->hitungKaryawan();
        $data['barang_min'] = $this->beranda_model->min('tbl_produk', 'stok', 10);
        $data['karyawan'] = $this->db->get_where('tbl_karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();

         // Line Chart
         $bln = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
         $data['transaksi'] = [];
 
         foreach ($bln as $b) {
            $data['transaksi'][] = $this->beranda_model->chartTransaksi($b);
         }
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav', $data);
        $this->load->view('admin/layout/isi', $data);
        $this->load->view('admin/layout/footer');
    }
}

/* End of file Beranda.php */
