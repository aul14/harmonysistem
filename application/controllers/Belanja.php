<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Kategori_model');
        $this->load->model('Pelanggan_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Detail_transaksi_model');
        $this->load->helper('string');
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
    }
    public function index()
    {
       
        $keranjang = $this->cart->contents();
        $data = array(
            'title' => 'Keranjang Belanja',
            'keranjang' => $keranjang,
            'isi' => 'belanja/list'
        );
        $this->load->view('layout/wrapper', $data);
        
    }
    public function sukses()
    {
       
        $data = array(
            'title' => 'Belanja Berhasil',
            'isi' => 'belanja/sukses'
        );
        $this->load->view('layout/wrapper', $data);
        
    }
    public function add()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        $name = $this->input->post('name');
        $redirect_page = $this->input->post('redirect_page');
        //memasukan keranjang belanja
        $data = [
            'id' => $id,
            'qty' => $qty,
            'price' => $price,
            'name' => $name
        ];
                  
        $this->cart->insert($data);
        
        redirect($redirect_page,'refresh');
        
    }
    public function hapus($rowid)
    {
        
            $this->cart->remove($rowid);
            $this->session->set_flashdata('sukses', 'Data Keranjang belanja dihapus');          
            redirect('belanja','refresh');
      
        
        
    }
    public function hapus_semua()
    {
        $this->cart->destroy();
        $this->session->set_flashdata('sukses', 'Data Keranjang belanja dihapus');          
        redirect('belanja','refresh');
    }
    public function update_cart($rowid)
    {
        if ($rowid) {
            $data = [
                'rowid' => $rowid,
                'qty' => $this->input->post('qty')          
            ];
            $this->cart->update($data);
            $this->session->set_flashdata('sukses', 'Data keranjang telah diupdate');
            redirect('belanja','refresh');
        } else {           
            redirect('belanja','refresh');           
        }
    }
   
    public function checkout()
    {
        $kode['kode'] = $this->db->order_by('order_id', 'DESC');
        $this->db->limit(1);
        $cek = $this->db->get('transaksi');
        ;
        if ($cek->num_rows() == 0) {
        $date = date('dmY');
        $kode       ="INV/".$date."/HSP/000000001";
        }else{
        $noUrut 	 			= substr($cek->row()->order_id, 17, 26);
        $noUrut++;
        $kode				="INV/".date('dmY')."/HSP/".sprintf("%09s", $noUrut);
        }
                        
        if ($this->session->userdata('email')) {
            $id = $this->session->userdata('id_pelanggan');
            $pelanggan = $this->Pelanggan_model->sudah_login($id);
            $keranjang = $this->cart->contents();

            $this->form_validation->set_rules('order_id', 'Kode Transaksi', 'trim|required|is_unique[transaksi.order_id]', ['is_unique' => 'Kode Transaksi Sudah digunakan']);

            
            if ($this->form_validation->run() ==  FALSE) {
                $data = array(
                    'title' => 'Proses Pesanan',
                    'keranjang' => $keranjang,
                    'pelanggan' => $pelanggan,
                    'isi' => 'belanja/checkout'
                );
                $this->load->view('layout/wrapper', $data);
            } else {
                $data = [
                    'id_pelanggan' => $pelanggan->id_pelanggan,
                    'order_id' => $kode,
                    'total' => htmlspecialchars($this->input->post('total')),
                    'sub_total' => htmlspecialchars($this->input->post('sub_total')),
                    'alamat_pengiriman' => htmlspecialchars($this->input->post('alamat_pengiriman')),
                    'tanggal_transaksi' => date('d M Y, H:i'),
                    'transaction_status' => 'Pending'
                ];
              
                // $this->db->insert('transaksi', $data);
                $id = $this->db->insert_id();
                
                foreach($keranjang as $keranjang) {
                    $total = $keranjang['price'] * $keranjang['qty'];
                    $data = [
                        'id_transaksi' => $id,
                        'id_produk' => $keranjang['id'],
                        'harga' => $keranjang['price'],
                        'total_harga' => $total,
                        'qty' => $keranjang['qty']
                    ];
                // $this->db->insert('detail_transaksi', $data);
                }
                // $this->cart->destroy();
                $this->session->set_flashdata('sukses','Proses Pesanan berhasil, Silahkan lakukan pembayaran.');
                
                redirect('belanja/sukses','refresh');
                
                // redirect('belanja/sukses', 'refresh');
            }                
        } else {
            $this->session->set_flashdata('sukses','Silahkan Login atau Registrasi terlebih dahulu');
            redirect('registrasi','refresh');
            
            
        }
    }

}

/* End of file Belanja.php */
