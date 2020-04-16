<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    
    public function listing()
    {
        $this->db->select('tbl_produk.*,
                       tbl_karyawan.nama_karyawan,
                        tbl_kategori.nama_kategori,
                        tbl_kategori.slug_kategori,
                        count(tbl_gambar.id_gambar) as total_gambar');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan = tbl_produk.id_karyawan', 'left');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'left');
        $this->db->join('tbl_gambar', 'tbl_gambar.id_produk = tbl_produk.id_produk', 'left');

        $this->db->group_by('tbl_produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function listing_kategori()
    {
        $this->db->select('tbl_produk.*,
                       tbl_karyawan.nama_karyawan,
                        tbl_kategori.nama_kategori,
                        tbl_kategori.slug_kategori,
                        count(tbl_gambar.id_gambar) as total_gambar');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan = tbl_produk.id_karyawan', 'left');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'left');
        $this->db->join('tbl_gambar', 'tbl_gambar.id_produk = tbl_produk.id_produk', 'left');

        $this->db->group_by('tbl_produk.id_kategori');

        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function home()
    {
        $this->db->select('tbl_produk.*,
                       tbl_karyawan.nama_karyawan,
                        tbl_kategori.nama_kategori,
                        tbl_kategori.slug_kategori,
                        count(tbl_gambar.id_gambar) as total_gambar');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan = tbl_produk.id_karyawan', 'left');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'left');
        $this->db->join('tbl_gambar', 'tbl_gambar.id_produk = tbl_produk.id_produk', 'left');

        $this->db->where('tbl_produk.status_produk', 'publish');
           
        
        $this->db->group_by('tbl_produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
        $this->db->limit(4);
        
        
        $query = $this->db->get();
        return $query->result();
    }
    public function produk_terkait()
    {
        $this->db->select('tbl_produk.*,
                        tbl_karyawan.nama_karyawan,
                        tbl_kategori.nama_kategori,
                        tbl_kategori.slug_kategori,
                        count(tbl_gambar.id_gambar) as total_gambar');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan = tbl_produk.id_karyawan', 'left');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'left');
        $this->db->join('tbl_gambar', 'tbl_gambar.id_produk = tbl_produk.id_produk', 'left');

        $this->db->where('tbl_produk.status_produk', 'publish');
           
        
        $this->db->group_by('tbl_produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
        $this->db->limit(4);
        
        
        $query = $this->db->get();
        return $query->result();
    }
    public function read($slug_produk)
    {
        $this->db->select('tbl_produk.*,
                       tbl_karyawan.nama_karyawan,
                       tbl_kategori.nama_kategori,
                       tbl_kategori.slug_kategori,
                        count(tbl_gambar.id_gambar) as total_gambar');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan = tbl_produk.id_karyawan', 'left');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'left');
        $this->db->join('tbl_gambar', 'tbl_gambar.id_produk = tbl_produk.id_produk', 'left');

        $this->db->where('tbl_produk.status_produk', 'publish');    
        $this->db->where('tbl_produk.slug_produk', $slug_produk);
        
        $this->db->group_by('tbl_produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
                
        $query = $this->db->get();
        return $query->row();
    }
    public function produk($limit,$start)
    {
        $this->db->select('tbl_produk.*,
                       tbl_karyawan.nama_karyawan,
                       tbl_kategori.nama_kategori,
                       tbl_kategori.slug_kategori,
                        count(tbl_gambar.id_gambar) as total_gambar');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan = tbl_produk.id_karyawan', 'left');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'left');
        $this->db->join('tbl_gambar', 'tbl_gambar.id_produk = tbl_produk.id_produk', 'left');

        $this->db->where('tbl_produk.status_produk', 'publish');
           
        
        $this->db->group_by('tbl_produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
        $this->db->limit($limit,$start);
        
        $query = $this->db->get();
        return $query->result();
    }
    public function total_produk()
    {
        $this->db->select('count(*) as total');
        $this->db->from('tbl_produk');
        $this->db->where('status_produk', 'publish');
        $query = $this->db->get();
        return $query->row();
        
    }
    public function kategori($id_kategori,$limit,$start)
    {
        $this->db->select('tbl_produk.*,
                       tbl_karyawan.nama_karyawan,
                       tbl_kategori.nama_kategori,
                       tbl_kategori.slug_kategori,
                        count(tbl_gambar.id_gambar) as total_gambar');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.id_karyawan = tbl_produk.id_karyawan', 'left');
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.id_kategori', 'left');
        $this->db->join('tbl_gambar', 'tbl_gambar.id_produk = tbl_produk.id_produk', 'left');

        $this->db->where('tbl_produk.status_produk', 'publish');
        $this->db->where('tbl_produk.id_kategori', $id_kategori);
        
        
        $this->db->group_by('tbl_produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
        $this->db->limit($limit,$start);
        
        $query = $this->db->get();
        return $query->result();
    }
    public function total_kategori($id_kategori)
    {
        $this->db->select('count(*) as total');
        $this->db->from('tbl_produk');
        $this->db->where('status_produk', 'publish');
        $this->db->where('id_kategori', $id_kategori);
        
        $query = $this->db->get();
        return $query->row();
        
    }
   
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function detail($id_produk)
    {
        $this->db->select('*');
        $this->db->from('tbl_produk');
        $this->db->where('id_produk', $id_produk);
        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function detail_gambar($id_gambar)
    {
        $this->db->select('*');
        $this->db->from('tbl_gambar');
        $this->db->where('id_gambar', $id_gambar);
        $this->db->order_by('id_gambar', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function gambar($id_produk)
    {
        $this->db->select('*');
        $this->db->from('tbl_gambar');
        $this->db->where('id_produk', $id_produk);
        $this->db->order_by('id_gambar', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function tambah_gambar($data)
    {
        $this->db->insert('tbl_gambar', $data);
    }
    public function tambah($data)
    {
        $this->db->insert('tbl_produk', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete('tbl_produk');
    }
    public function hapus_gambar($id)
    {
        $this->db->where('id_gambar', $id);
        $this->db->delete('tbl_gambar');
    }

}

/* End of file Produk_model.php */
