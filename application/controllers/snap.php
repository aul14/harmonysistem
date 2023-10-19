<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use GuzzleHttp\Client;

class Snap extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pelanggan_model');
		$params = array('server_key' => 'SB-Mid-server-p3tc7DjNg2eIGlBgNCrGUfif', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		if (!$_SESSION['email']) {
			$this->session->set_flashdata('sukses', '<strong>Gagal!</strong> Silahkan Login terlebih dahulu');
			redirect('masuk');
		}
		date_default_timezone_set('Asia/Jakarta');
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}
	public function token()
	{
		$id = $this->session->userdata('id_pelanggan');
		$pelanggan = $this->Pelanggan_model->sudah_login($id);
		$keranjang = $this->cart->contents();
		$kode = $this->transaksi_model->get_no_invoice();
		// ini harus di foreach ya? v gajuga sii ini mah cara gua aja biar ke panggil
		// kepanggil apa? = itu yg id price qty sm total
		// ok
		// fixed nih.
		$count = count($this->cart->contents());
		foreach ($this->cart->contents() as $u) {
			// var_dump($u);die;
			// Required
			$transaction_details = array(
				'order_id' => $kode,
				'gross_amount' => $this->cart->total(),
				// 'gross_amount' => $u['price'] * $u['qty'], // no decimal allowed for creditcard
			);
		};
		// jadi katanya gross amount sama price ga sama yup ga sama dimana nya

		// var_dump($transaction_details['gross_amount']); // 18 000 000

		$item_details = [];
		foreach ($this->cart->contents() as $key) {
			$temp = [
				'id' => $key['id'],
				'price' => $key['price'],
				'quantity' => $key['qty'],
				'name' => $key['name'],
			];
			array_push($item_details, $temp);
		};



		// Optional
		$billing_address = array(
			'first_name'    => $pelanggan->nama_pelanggan,
			'address'       => $pelanggan->alamat . $pelanggan->id_kec . $pelanggan->id_kel . $pelanggan->id_prov,
			'city'          => $pelanggan->id_kab,
			'postal_code'   => $pelanggan->kode_pos,
			'phone'         => $pelanggan->telepon,
			'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
			'first_name'    => "Kurir",
			'last_name'     => "Harmony Sistem",
			'phone'         => "021-82401323",
			'email' 		=> "info@harmonysistem.co.id",
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
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'hour',
			'duration'  => 1
		);
		//itu mi
		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			// 'item_details'       => $this->cart->contents(),
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}


	public function finish()
	{
		$result = json_decode($this->input->post('result_data'), true);
		// 	echo 'RESULT <br><pre>';
		// var_dump($result);die;
		// echo '</pre>';

		$kode = $result['order_id'];
		$total = $result['gross_amount'];
		$payment_type = $result['payment_type'];
		$tanggal_bayar = $result['transaction_time'];
		$transaction_status = $result['transaction_status'];
		$nama_bank_pelanggan = @$result['va_numbers'][0]['bank'];
		$va_number = @$result['va_numbers'][0]['va_number'];
		$biller_code = @$result['biller_code'];
		$bill_key = @$result['bill_key'];
		$permata_va_number = @$result['permata_va_number'];
		$payment_code = @$result['payment_code'];
		$cara_bayar = @$result['pdf_url'];



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
					'total' => $total,
					'sub_total' => htmlspecialchars($this->input->post('sub_total')),
					'alamat_pengiriman' => htmlspecialchars($this->input->post('alamat_pengiriman')),
					'payment_type' => $payment_type,
					'nama_bank_pelanggan' => $nama_bank_pelanggan,
					'va_number' => $va_number,
					'biller_code' => $biller_code,
					'bill_key' => $bill_key,
					'permata_va_number' => $permata_va_number,
					'payment_code' => $payment_code,
					'nama_pemilik_pelanggan' => $this->session->userdata('nama_pelanggan'),
					'transaction_status' => $transaction_status,
					'pengiriman' => 'pending',
					'tanggal_bayar' => $tanggal_bayar,
					'cara_bayar' => $cara_bayar,
					'tanggal_transaksi' => date('d M Y, H:i'),
					'tanggal_update_transaksi' => date('Y-m-d')
				];
				//   var_dump($data);die;
				$this->db->insert('transaksi', $data);
				$id = $this->db->insert_id();

				foreach ($keranjang as $keranjang) {
					$total = $keranjang['price'] * $keranjang['qty'];
					$data = [
						'id_transaksi' => $id,
						'id_produk' => $keranjang['id'],
						'qty' => $keranjang['qty'],
						'harga' => $keranjang['price'],
						'total_harga' => $total
					];
					$this->db->insert('detail_transaksi', $data);
				}
				$this->cart->destroy();
				$this->session->set_flashdata('sukses', 'Proses Pesanan berhasil, Transaksi Sedang diproses.');

				redirect('snap/sukses/' . encrypt_url($id), 'refresh');

				// redirect('belanja/sukses', 'refresh');
			}
		} else {
			$this->session->set_flashdata('sukses', 'Silahkan Login atau Registrasi terlebih dahulu');
			redirect('registrasi', 'refresh');
		}
		// echo 'RESULT <br><pre>';
		// var_dump($result);
		// echo '</pre>';
	}

	function sukses()
	{
		$id = decrypt_url($this->uri->segment(3));
		$detail = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();
		$data = array(
			'title' => 'Detail Pembayaran',
			'detail' => $detail,
			'isi' => 'belanja/sukses'
		);
		$this->load->view('layout/wrapper', $data);
	}
	function cekstatus()
	{
		// $url = file_get_contents("https://api.sandbox.midtrans.com/v2/9692/status");
		// $data = json_decode($url);
		// var_dump($url);


		$s = $this->Konfigurasi_model->cekstatus();
		echo $s['transaction_status'];
	}
}
