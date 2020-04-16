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
        $params = array('server_key' => 'SB-Mid-server-p3tc7DjNg2eIGlBgNCrGUfif', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
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
        if ($rowid) {
            $this->cart->remove($rowid);
            $this->session->set_flashdata('sukses', 'Data Keranjang belanja dihapus');          
            redirect('belanja','refresh');
        }else{
            $this->cart->destroy();
            $this->session->set_flashdata('sukses', 'Data Keranjang belanja dihapus');          
            redirect('belanja','refresh');
        }
        
        
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
    public function token()
    {
        $id = $this->session->userdata('id_pelanggan');
        $pelanggan = $this->Pelanggan_model->sudah_login($id);
        $keranjang = $this->cart->contents();
        $kode['kode'] = $this->db->order_by('kode_transaksi', 'DESC');
        $this->db->limit(1);
        $cek = $this->db->get('tbl_transaksi');
        ;
        if ($cek->num_rows() == 0) {
        $date = date('dmY');
        $kode       ="INV/".$date."/HSP/000000001";
        }else{
        $noUrut 	 			= substr($cek->row()->kode_transaksi, 17, 26);
        $noUrut++;
        $kode				="INV/".date('dmY')."/HSP/".sprintf("%09s", $noUrut);
        }
		// Required
		$transaction_details = array(
		  'order_id' => $kode,
		  'gross_amount' => $this->cart->total(), // no decimal allowed for creditcard
		);

		// Optional
		$item_details = array(
		  'id' => $this->cart->id(),
		  'price' => $this->cart->price(),
		  'quantity' => $this->cart->qty(),
		  'name' => $this->cart->name()
		);

		

		// Optional
		$billing_address = array(
		  'first_name'    => $pelanggan->nama_pelanggan,
		  'address'       => $pelanggan->alamat,$pelanggan->id_kec,$pelanggan->id_kel,$pelanggan->id_prov,
		  'city'          => $pelanggan->id_kab,
		  'postal_code'   => $pelanggan->kode_pos,
		  'phone'         => $pelanggan->telepon,
		  'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "Obet",
		  'last_name'     => "Supriadi",
		  'address'       => "Manggis 90",
		  'city'          => "Jakarta",
		  'postal_code'   => "16601",
		  'phone'         => "08113366345",
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
          'first_name'    => $pelanggan->nama_pelanggan,
          'last_name'     => "",
		  'email'         => $pelanggan->email,
		  'phone'         => $pelanggan->telepon,
		  'billing_address'  => $billing_address,
		   'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'hour', 
            'duration'  => 1
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    // public function finish()
    // {
    //     // $data = array(
    //     //     'title' => 'Belanja Berhasil',
    //     //     'isi' => 'belanja/sukses'
    //     // );
    //     // $this->load->view('layout/wrapper', $data);
    // 	$result = json_decode($this->input->post('result_data'));
    // 	echo 'RESULT <br><pre>';
    // 	var_dump($result);
    // 	echo '</pre>' ;

    // }
    public function checkout()
    {
        $kode['kode'] = $this->db->order_by('kode_transaksi', 'DESC');
        $this->db->limit(1);
        $cek = $this->db->get('tbl_transaksi');
        ;
        if ($cek->num_rows() == 0) {
        $date = date('dmY');
        $kode       ="INV/".$date."/HSP/000000001";
        }else{
        $noUrut 	 			= substr($cek->row()->kode_transaksi, 17, 26);
        $noUrut++;
        $kode				="INV/".date('dmY')."/HSP/".sprintf("%09s", $noUrut);
        }
                        
        if ($this->session->userdata('email')) {
            $id = $this->session->userdata('id_pelanggan');
            $pelanggan = $this->Pelanggan_model->sudah_login($id);
            $keranjang = $this->cart->contents();

            $this->form_validation->set_rules('kode_transaksi', 'Kode Transaksi', 'trim|required|is_unique[tbl_transaksi.kode_transaksi]', ['is_unique' => 'Kode Transaksi Sudah digunakan']);

            
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
                    'kode_transaksi' => $kode,
                    'total' => htmlspecialchars($this->input->post('total')),
                    'sub_total' => htmlspecialchars($this->input->post('sub_total')),
                    'alamat_pengiriman' => htmlspecialchars($this->input->post('alamat_pengiriman')),
                    'tanggal_transaksi' => date('d M Y, H:i'),
                    'status_bayar' => 'Pending'
                ];
              
                // $this->db->insert('tbl_transaksi', $data);
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
                // $this->db->insert('tbl_detail_transaksi', $data);
                }
                // $this->cart->destroy();
                $this->session->set_flashdata('sukses','Proses Pesanan berhasil, Silahkan lakukan pembayaran.');
                
                redirect('belanja/token','refresh');
                
                // redirect('belanja/sukses', 'refresh');
            }                
        } else {
            $this->session->set_flashdata('sukses','Silahkan Login atau Registrasi terlebih dahulu');
            redirect('registrasi','refresh');
            
            
        }
    }

}

/* End of file Belanja.php */
