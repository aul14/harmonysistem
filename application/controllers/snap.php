<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

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
		// ini harus di foreach ya? v gajuga sii ini mah cara gua aja biar ke panggil
		// kepanggil apa? = itu yg id price qty sm total
		// ok
		// fixed nih.
		foreach($this->cart->contents() as $u) {
		// var_dump($u);die;
		// Required
		$transaction_details = array(
		  'order_id' => $kode,
		  'gross_amount' => $u['price']*$u['qty'], // no decimal allowed for creditcard
		);
	};
	// break dulu, lu bikin akun github coba

		foreach($this->cart->contents() as $x) {
		// var_dump($u);die;
		// Required
		
		$item_details = array(
			  'id' => $x['id'],
			  'price' => $x['price'],
			  'quantity' => $x['qty'],
			  'name' => $x['name']
			);
	};
	var_dump($transaction_details);
	var_dump($item_details);

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
		  'address'       => $pelanggan->alamat,$pelanggan->id_kec,$pelanggan->id_kel,$pelanggan->id_prov,
		  'city'          => $pelanggan->id_kab,
		  'postal_code'   => $pelanggan->kode_pos,
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
        //itu mi
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
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

    // public function token()
    // {
		
	// 	// Required
	// 	$transaction_details = array(
	// 	  'order_id' => rand(),
	// 	  'gross_amount' => 94000, // no decimal allowed for creditcard
	// 	);

	// 	// Optional
	// 	$item1_details = array(
	// 	  'id' => 'a1',
	// 	  'price' => 18000,
	// 	  'quantity' => 3,
	// 	  'name' => "Apple"
	// 	);

	// 	// Optional
	// 	$item2_details = array(
	// 	  'id' => 'a2',
	// 	  'price' => 20000,
	// 	  'quantity' => 2,
	// 	  'name' => "Orange"
	// 	);

	// 	// Optional
	// 	$item_details = array ($item1_details, $item2_details);

	// 	// Optional
	// 	$billing_address = array(
	// 	  'first_name'    => "Andri",
	// 	  'last_name'     => "Litani",
	// 	  'address'       => "Mangga 20",
	// 	  'city'          => "Jakarta",
	// 	  'postal_code'   => "16602",
	// 	  'phone'         => "081122334455",
	// 	  'country_code'  => 'IDN'
	// 	);

	// 	// Optional
	// 	$shipping_address = array(
	// 	  'first_name'    => "Obet",
	// 	  'last_name'     => "Supriadi",
	// 	  'address'       => "Manggis 90",
	// 	  'city'          => "Jakarta",
	// 	  'postal_code'   => "16601",
	// 	  'phone'         => "08113366345",
	// 	  'country_code'  => 'IDN'
	// 	);

	// 	// Optional
	// 	$customer_details = array(
	// 	  'first_name'    => "Andri",
	// 	  'last_name'     => "Litani",
	// 	  'email'         => "andri@litani.com",
	// 	  'phone'         => "081122334455",
	// 	  'billing_address'  => $billing_address,
	// 	  'shipping_address' => $shipping_address
	// 	);

	// 	// Data yang akan dikirim untuk request redirect_url.
    //     $credit_card['secure'] = true;
    //     //ser save_card true to enable oneclick or 2click
    //     //$credit_card['save_card'] = true;

    //     $time = time();
    //     $custom_expiry = array(
    //         'start_time' => date("Y-m-d H:i:s O",$time),
    //         'unit' => 'hour', 
    //         'duration'  => 1
    //     );
        
    //     $transaction_data = array(
    //         'transaction_details'=> $transaction_details,
    //         'item_details'       => $item_details,
    //         'customer_details'   => $customer_details,
    //         'credit_card'        => $credit_card,
    //         'expiry'             => $custom_expiry
    //     );

	// 	error_log(json_encode($transaction_data));
	// 	$snapToken = $this->midtrans->getSnapToken($transaction_data);
	// 	error_log($snapToken);
	// 	echo $snapToken;
    // }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
    	echo 'RESULT <br><pre>';
    	var_dump($result);
    	echo '</pre>' ;

    }
}
