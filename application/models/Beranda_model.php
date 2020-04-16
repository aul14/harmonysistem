<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda_model extends CI_Model {

    public function hitungPelanggan()
    {

        $this->db->select('COUNT(*) as total');
        $query = $this->db->get('tbl_pelanggan');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function hitungProduk()
    {

        $this->db->select('COUNT(*) as total');
        $query = $this->db->get('tbl_produk');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function hitungKaryawan()
    {

        $this->db->select('COUNT(*) as total');
        $query = $this->db->get('tbl_karyawan');
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
    public function chartTransaksi()
    {
        $this->db->like('id_transaksi', 'after');
        return count($this->db->get('tbl_transaksi')->result_array());
    }

}

/* End of file Beranda_model.php */
