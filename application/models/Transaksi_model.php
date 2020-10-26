<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

   
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('transaksi');

        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function id_transaksi($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    function get_no_invoice(){
        $q = $this->db->query("SELECT MAX(RIGHT(order_id,5)) AS kd_max FROM transaksi WHERE DATE(tanggal_update_transaksi)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }else{
            $kd = "00001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "HSP". date('ymd') . $kd;
    }
    public function namaP($id_transaksi)
    {
        $query = "SELECT `b`.`nama_pelanggan`id_pelanggan,`order_id`order_id FROM transaksi INNER JOIN `pelanggan` `b` ON `b`.`id_pelanggan` = `transaksi`.`id_pelanggan` where id_transaksi = $id_transaksi";
        return $this->db->query($query)->result();
    }
    public function order_id($order_id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('order_id', $order_id);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function detail($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function tambah($data)
    {
        $this->db->insert('transaksi', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->delete('transaksi');
    }
   
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function getTransaksi($limit = null, $id_transaksi = null, $range = null)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan', 'inner');
        // $this->db->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi', 'inner');
        // $this->db->join('produk', 'produk.id_produk =  detail_transaksi.id_produk', 'inner');
        if ($limit != null) {
            $this->db->limit($limit);
        }

        if ($id_transaksi != null) {
            $this->db->where('transaksi.id_transaksi', $id_transaksi);
        }

        if ($range != null) {
            $this->db->where('tanggal_update_transaksi' . ' >=', $range['mulai']);
            $this->db->where('tanggal_update_transaksi' . ' <=', $range['akhir']);
        }

         $this->db->order_by('transaksi.id_transaksi', 'DESC');
        return $this->db->get()->result_array();
    }
  
    public function getDetailTransaksi($limit = null, $id_transaksi = null, $range = null)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan', 'inner');
        $this->db->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi', 'inner');
        $this->db->join('produk', 'produk.id_produk =  detail_transaksi.id_produk', 'inner');
        if ($limit != null) {
            $this->db->limit($limit);
        }

        if ($id_transaksi != null) {
            $this->db->where('
            transaksi.id_transaksi', $id_transaksi);
        }

        if ($range != null) {
            $this->db->where('tanggal_update_transaksi' . ' >=', $range['mulai']);
            $this->db->where('tanggal_update_transaksi' . ' <=', $range['akhir']);
        }

         $this->db->order_by('transaksi.id_transaksi', 'DESC');
        return $this->db->get()->result_array();
    }
    
}

/* End of file Transaksi_model.php */
