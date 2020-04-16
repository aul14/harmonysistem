<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model {

    public function listing()
    {
        $query = $this->db->get('tbl_konfigurasi');
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
        $this->db->select('tbl_produk.*,
        tbl_kategori.nama_kategori,
        tbl_kategori.slug_kategori');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'left');

        $this->db->group_by('tbl_produk.id_kategori');

        $this->db->order_by('tbl_kategori.urutan', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

}

/* End of file Konfigurasi_model.php */
