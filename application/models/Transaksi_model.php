<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

   
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');

        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function id_transaksi($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function kode_transaksi($kode_transaksi)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function detail($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function tambah($data)
    {
        $this->db->insert('tbl_transaksi', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->delete('tbl_transaksi');
    }
   
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
}

/* End of file Transaksi_model.php */
