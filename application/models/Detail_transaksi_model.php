<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_transaksi_model extends CI_Model {

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('tbl_detail_transaksi');

        $this->db->order_by('id_detailtransaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function pelanggan($id_pelanggan)
    {
        $this->db->select('tbl_transaksi.*,
                        SUM(tbl_detail_transaksi.qty) AS total_item');
        $this->db->from('tbl_transaksi');
        $this->db->where('tbl_transaksi.id_pelanggan', $id_pelanggan);
        $this->db->join('tbl_detail_transaksi', 'tbl_detail_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');
        
        $this->db->group_by('tbl_transaksi.id_transaksi');
        
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function id_transaksi($id_transaksi)
    {
        // $query = "SELECT id_detailtransaksi,kode_produk,nama_produk,qty,tbl_detail_transaksi.harga,total_harga from tbl_produk,tbl_detail_transaksi where tbl_produk.id_produk = tbl_detail_transaksi.id_produk and tbl_detail_transaksi.id_transaksi = $id_transaksi";
        // return $this->db->query($query)->result();
        $this->db->select('tbl_detail_transaksi.*,
                        tbl_produk.nama_produk,
                        tbl_produk.kode_produk');
        $this->db->from('tbl_detail_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_detail_transaksi.id_produk', 'left');
        
        $this->db->order_by('id_detailtransaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail($id_header_transaksi)
    {
        $this->db->select('*');
        $this->db->from('tbl_detail_transaksi');
        $this->db->where('id_detailtransaksi', $id_header_transaksi);
        $this->db->order_by('id_detailtransaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function tambah($data)
    {
        $this->db->insert('tbl_detail_transaksi', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_detailtransaksi', $id);
        $this->db->delete('tbl_detail_transaksi');
    }
   
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
}

/* End of file Detail_transaksi_model.php */
