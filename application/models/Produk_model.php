<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    
    public function listing()
    {
        $this->db->select('produk.*,
                       karyawan.nama_karyawan,
                        kategori.nama_kategori,
                        kategori.slug_kategori,
                        count(gambar.id_gambar) as total_gambar');
        $this->db->from('produk');
        $this->db->join('karyawan', 'karyawan.id_karyawan = produk.id_karyawan', 'left');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
        $this->db->join('gambar', 'gambar.id_produk = produk.id_produk', 'left');

        $this->db->group_by('produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function listing_kategori()
    {
        $this->db->select('produk.*,
                       karyawan.nama_karyawan,
                        kategori.nama_kategori,
                        kategori.slug_kategori,
                        count(gambar.id_gambar) as total_gambar');
        $this->db->from('produk');
        $this->db->join('karyawan', 'karyawan.id_karyawan = produk.id_karyawan', 'left');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
        $this->db->join('gambar', 'gambar.id_produk = produk.id_produk', 'left');

        $this->db->group_by('produk.id_kategori');

        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function home()
    {
        $this->db->select('produk.*,
                       karyawan.nama_karyawan,
                        kategori.nama_kategori,
                        kategori.slug_kategori,
                        count(gambar.id_gambar) as total_gambar');
        $this->db->from('produk');
        $this->db->join('karyawan', 'karyawan.id_karyawan = produk.id_karyawan', 'left');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
        $this->db->join('gambar', 'gambar.id_produk = produk.id_produk', 'left');

        $this->db->where('produk.status_produk', 'publish');
           
        
        $this->db->group_by('produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
        $this->db->limit(4);
        
        
        $query = $this->db->get();
        return $query->result();
    }
    public function produk_terkait()
    {
        $this->db->select('produk.*,
                        karyawan.nama_karyawan,
                        kategori.nama_kategori,
                        kategori.slug_kategori,
                        count(gambar.id_gambar) as total_gambar');
        $this->db->from('produk');
        $this->db->join('karyawan', 'karyawan.id_karyawan = produk.id_karyawan', 'left');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
        $this->db->join('gambar', 'gambar.id_produk = produk.id_produk', 'left');

        $this->db->where('produk.status_produk', 'publish');
           
        
        $this->db->group_by('produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
        $this->db->limit(4);
        
        
        $query = $this->db->get();
        return $query->result();
    }
    public function read($slug_produk)
    {
        $this->db->select('produk.*,
                       karyawan.nama_karyawan,
                       kategori.nama_kategori,
                       kategori.slug_kategori,
                        count(gambar.id_gambar) as total_gambar');
        $this->db->from('produk');
        $this->db->join('karyawan', 'karyawan.id_karyawan = produk.id_karyawan', 'left');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
        $this->db->join('gambar', 'gambar.id_produk = produk.id_produk', 'left');

        $this->db->where('produk.status_produk', 'publish');    
        $this->db->where('produk.slug_produk', $slug_produk);
        
        $this->db->group_by('produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
                
        $query = $this->db->get();
        return $query->row();
    }
    public function produk($limit,$start)
    {
        $this->db->select('produk.*,
                       karyawan.nama_karyawan,
                       kategori.nama_kategori,
                       kategori.slug_kategori,
                        count(gambar.id_gambar) as total_gambar');
        $this->db->from('produk');
        $this->db->join('karyawan', 'karyawan.id_karyawan = produk.id_karyawan', 'left');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
        $this->db->join('gambar', 'gambar.id_produk = produk.id_produk', 'left');

        $this->db->where('produk.status_produk', 'publish');
           
        
        $this->db->group_by('produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
        $this->db->limit($limit,$start);
        
        $query = $this->db->get();
        return $query->result();
    }
    public function total_produk()
    {
        $this->db->select('count(*) as total');
        $this->db->from('produk');
        $this->db->where('status_produk', 'publish');
        $query = $this->db->get();
        return $query->row();
        
    }
    public function kategori($id_kategori,$limit,$start)
    {
        $this->db->select('produk.*,
                       karyawan.nama_karyawan,
                       kategori.nama_kategori,
                       kategori.slug_kategori,
                        count(gambar.id_gambar) as total_gambar');
        $this->db->from('produk');
        $this->db->join('karyawan', 'karyawan.id_karyawan = produk.id_karyawan', 'left');
        $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
        $this->db->join('gambar', 'gambar.id_produk = produk.id_produk', 'left');

        $this->db->where('produk.status_produk', 'publish');
        $this->db->where('produk.id_kategori', $id_kategori);
        
        
        $this->db->group_by('produk.id_produk');

        $this->db->order_by('id_produk', 'desc');
        $this->db->limit($limit,$start);
        
        $query = $this->db->get();
        return $query->result();
    }
    public function total_kategori($id_kategori)
    {
        $this->db->select('count(*) as total');
        $this->db->from('produk');
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
        $this->db->from('produk');
        $this->db->where('id_produk', $id_produk);
        $this->db->order_by('id_produk', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function detail_gambar($id_gambar)
    {
        $this->db->select('*');
        $this->db->from('gambar');
        $this->db->where('id_gambar', $id_gambar);
        $this->db->order_by('id_gambar', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function gambar($id_produk)
    {
        $this->db->select('*');
        $this->db->from('gambar');
        $this->db->where('id_produk', $id_produk);
        $this->db->order_by('id_gambar', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function tambah_gambar($data)
    {
        $this->db->insert('gambar', $data);
    }
    public function tambah($data)
    {
        $this->db->insert('produk', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete('produk');
    }
    public function hapus_gambar($id)
    {
        $this->db->where('id_gambar', $id);
        $this->db->delete('gambar');
    }

}

/* End of file Produk_model.php */
