<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
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
        if ($_SESSION['id_jabatan'] == 1 or $_SESSION['id_jabatan'] == 2  or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifKaryawan', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/karyawan');
        }
        $this->form_validation->set_rules('laporan', 'Transaksi', 'required|in_list[transaksi,detail_transaksi]');
        $this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');
       
       if ($this->form_validation->run() == false) {
            $data['title'] = "Laporan Transaksi";
            $data['pelanggan'] = $this->beranda_model->hitungPelanggan();
            $data['pesan'] = $this->beranda_model->hitungPesan();
            $data['hitung'] = $this->beranda_model->hitung();
            $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
            $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
            $data['produk'] = $this->beranda_model->hitungProduk();
            $data['karyawan'] = $this->beranda_model->hitungKaryawan();
            $data['barang_min'] = $this->beranda_model->min('produk', 'stok', 10);
            $data['karyawan'] = $this->db->get_where('karyawan', [
                'nama_karyawan' => $this->session->userdata('nama_karyawan')
            ])->row_array();
           $this->load->view('admin/layout/head', $data);
           $this->load->view('admin/layout/sidebar');
           $this->load->view('admin/layout/nav', $data);
           $this->load->view('admin/laporan/list', $data);
           $this->load->view('admin/layout/footer');
           
       } else {
            $input = $this->input->post(null, true);
            $table = $input['laporan'];
            $tanggal = $input['tanggal'];
            $pecah = explode('- ', $tanggal);
            $mulai = date('Y-m-d', strtotime($pecah[0]));
            $akhir = date('Y-m-d', strtotime(end($pecah)));

            $query = '';
            if ($table == 'transaksi') {
               $query = $this->transaksi_model->getTransaksi(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            } else {
                $query = $this->transaksi_model->getDetailTransaksi(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
            }

            $this->_cetak($query, $table, $tanggal);
       }
    }
    
    private function _cetak($data, $table_, $tanggal)
    {
        $this->load->library('CustomPDF');
        $table = $table_ == 'transaksi' ? 'Transaksi' : 'Detail Transaksi';
        $gambar = base_url('assets/upload/konfigurasi/logoHS.jpg');

        $pdf = new FPDF();
        $pdf->AddPage('P', 'Letter');
        $pdf->Image($gambar, 50, 10, -200);
        $pdf->Image($gambar, 135, 10, -200);
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(190, 7, 'Laporan ' . $table, 0, 1, 'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(190, 4, 'Tanggal : ' . $tanggal, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);

        if ($table_ == 'transaksi') : 
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(45, 7, 'Tanggal Transaksi', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Kode Transaksi', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Total', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Nama Pelanggan', 1, 0, 'C');
            $pdf->Cell(30, 7, 'Status Transaksi', 1, 0, 'C');
            $pdf->Ln();

            $no = 1;
            foreach ($data as $d) {
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                $pdf->Cell(45, 7, $d['tanggal_update_transaksi'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['order_id'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['total'], 1, 0, 'C');
                $pdf->Cell(35, 7, $d['nama_pelanggan'], 1, 0, 'C');
                $pdf->Cell(30, 7, $d['transaction_status'], 1, 0, 'C');
                $pdf->Ln();
            } else :
            $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
            $pdf->Cell(25, 7, 'Tgl Transaksi', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Kode Transaksi', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Kode Produk', 1, 0, 'C');
            $pdf->Cell(65, 7, 'Nama Produk', 1, 0, 'C');
            $pdf->Cell(35, 7, 'Nama Pelanggan', 1, 0, 'C');
            $pdf->Ln();

                $no = 1;  
                foreach ($data as $d) {
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
                    $pdf->Cell(25, 7, $d['tanggal_update_transaksi'], 1, 0, 'C');
                    $pdf->Cell(35, 7, $d['order_id'], 1, 0, 'C');
                    $pdf->Cell(35, 7, $d['kode_produk'], 1, 0, 'C');
                    $pdf->Cell(65, 7, $d['nama_produk'], 1, 0, 'C');
                    $pdf->Cell(35, 7, $d['nama_pelanggan'], 1, 0, 'C');
                    $pdf->Ln();
            } 
         endif;
            // var_dump($data);die;

        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
  }
}
/* End of file Laporan.php */
