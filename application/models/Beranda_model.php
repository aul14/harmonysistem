<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_model extends CI_Model {

    public function hitungPelanggan()
    {

        $this->db->select('COUNT(*) as total');
        $query = $this->db->get('pelanggan');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function hitungProduk()
    {

        $this->db->select('COUNT(*) as total');
        $query = $this->db->get('produk');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function hitungKaryawan()
    {

        $this->db->select('COUNT(*) as total');
        $query = $this->db->get('karyawan');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function min($table, $field, $min)
    {
        $field = $field . ' <=';
        $this->db->where($field, $min);
        return $this->db->get($table)->result_array();
    }
    public function chartTransaksi($bulan)
    {
        $like = 'HSP' . date('y') . $bulan;
        $this->db->where('transaction_status', 'settlement');
        
        $this->db->like('order_id', $like, 'after');
        return count($this->db->get('transaksi')->result_array());
    }
    public function chartTransaksi2($bulan)
    {
        $like = 'HSP' . date('y') . $bulan;

       $this->db->where('transaction_status', 'pending');
        
        $this->db->like('order_id', $like, 'after');
        return count($this->db->get('transaksi')->result_array());
    }
    public function chartTransaksi3($bulan)
    {
        $like = 'HSP' . date('y') . $bulan;

       $this->db->where('transaction_status', 'expire');
        
        $this->db->like('order_id', $like, 'after');
        return count($this->db->get('transaksi')->result_array());
    }
    public function chartTransaksi4($bulan)
    {
        $like = 'HSP' . date('y') . $bulan;

       $this->db->where('transaction_status', 'deny');
        
        $this->db->like('order_id', $like, 'after');
        return count($this->db->get('transaksi')->result_array());
    }
    public function hitungPesan($id = 2)
    {

        $this->db->select('pesan.id_pesan, COUNT(pesan.id_status) as totalPesan');
        $this->db->where('id_status', $id);
        $query = $this->db->get('pesan');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function total_list()
    {
        $id = $this->session->userdata('id_pelanggan');
        
        $this->db->select('count(*) as total');
        $this->db->from('transaksi');
        $this->db->where('id_pelanggan', $id);
        $query = $this->db->get();
        return $query->row();
        
    }
    public function hitung()
    {

        $this->db->select('transaksi.id_transaksi, COUNT(transaksi.transaction_status) as total');
        $this->db->where('transaction_status', 'settlement');
        $this->db->where('pengiriman', 'pending');
        $query = $this->db->get('transaksi');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function tampilPesan()
    {
        $query = "SELECT * from pesan where pesan.id_status = 2";
        return $this->db->query($query)->result();
    }
    public function tampilTransaksi()
    {
        $query = "SELECT * from transaksi where transaksi.transaction_status = 'settlement' and transaksi.pengiriman = 'pending'";
        return $this->db->query($query)->result();
    }

}

/* End of file Beranda_model.php */
