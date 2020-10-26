<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_transaksi_model extends CI_Model {

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('detail_transaksi');

        $this->db->order_by('id_detailtransaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function pelanggan($id_pelanggan,$limit,$start)
    {
        $this->db->select('transaksi.*,
                        SUM(detail_transaksi.qty) AS total_item');
        $this->db->from('transaksi');
        $this->db->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi', 'left');
        $this->db->where('transaksi.id_pelanggan', $id_pelanggan);
        
        $this->db->group_by('transaksi.id_transaksi');
        
        $this->db->order_by('id_transaksi', 'desc');
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        return $query->result();
    }
    public function pelanggan2($id_pelanggan)
    {
        $this->db->select('transaksi.*,
                        SUM(detail_transaksi.qty) AS total_item');
        $this->db->from('transaksi');
        $this->db->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi', 'left');
        $this->db->where('transaksi.id_pelanggan', $id_pelanggan);
        
        $this->db->group_by('transaksi.id_transaksi');
        
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function listing2()
    {
        $this->db->select('transaksi.*,
                        SUM(detail_transaksi.qty) AS total_item');
        $this->db->from('transaksi');
        $this->db->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi', 'left');
        
        $this->db->group_by('transaksi.id_transaksi');
        
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function id_transaksi($id_transaksi)
    {
        // $query = "SELECT id_detailtransaksi,kode_produk,nama_produk,qty,detail_transaksi.harga,total_harga from produk,detail_transaksi where produk.id_produk = detail_transaksi.id_produk and detail_transaksi.id_transaksi = $id_transaksi";
        // return $this->db->query($query)->result();
        $this->db->select('detail_transaksi.*,
                        produk.nama_produk,
                        produk.kode_produk');
        $this->db->from('detail_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->join('produk', 'produk.id_produk = detail_transaksi.id_produk', 'left');
        
        $this->db->order_by('id_detailtransaksi', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail($id_header_transaksi)
    {
        $this->db->select('*');
        $this->db->from('detail_transaksi');
        $this->db->where('id_detailtransaksi', $id_header_transaksi);
        $this->db->order_by('id_detailtransaksi', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function tambah($data)
    {
        $this->db->insert('detail_transaksi', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_detailtransaksi', $id);
        $this->db->delete('detail_transaksi');
    }
   
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
}

/* End of file Detail_transaksi_model.php */
