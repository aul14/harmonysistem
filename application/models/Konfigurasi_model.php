<?php 

use GuzzleHttp\Client;

defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model {
  
  public function __construct()
  {
    parent::__construct();
    $params = array('server_key' => 'SB-Mid-server-p3tc7DjNg2eIGlBgNCrGUfif', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
  }
  

    public function listing()
    {
        $query = $this->db->get('konfigurasi');
        return $query->row();
    }
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
    // load menu kategori produk
    public function nav_produk()
    {
        $this->db->select('produk.*,
        kategori.nama_kategori,
        kategori.slug_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');

        $this->db->group_by('produk.id_kategori');

        $this->db->order_by('kategori.urutan', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function idmidtrans()
    {
      $id = $this->session->userdata['id_pelanggan'];
      $query = "SELECT id_transaksi from transaksi where id_pelanggan = $id";
      return $this->db->query($query)->row_array();
    }
   function cekstatus($id){
        $url = "https://api.sandbox.midtrans.com/v2/".$id."/status";
        $client = new Client();
        $response = $client->request('GET',$url,
        [
          'auth' => ['SB-Mid-server-p3tc7DjNg2eIGlBgNCrGUfif',''],
          'verify' => false 
        ]);

        $result = json_decode($response->getBody()->getContents(),true);
        //  var_dump($result);die;
        return $result;
      }
    
      function update_midtrans($id,$transaction_status){
        $data = [
          'transaction_status'=>$transaction_status
        ];
        $this->db->update('transaksi',$data,['order_id'=>$id]);
      }
      function detailmidtrans($id_transaksi){
        return $this->db->get_where('transaksi',array('id_transaksi'=>$id_transaksi));
      }
      function detailmidtrans2($id_pelanggan){
        return $this->db->get_where('transaksi',array('id_pelanggan'=>$id_pelanggan));
      }

}

/* End of file Konfigurasi_model.php */
