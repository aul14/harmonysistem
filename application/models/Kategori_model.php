<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    public function listing()
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->order_by('id_kategori', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function detail($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->where('id_kategori', $id_kategori);
        $this->db->order_by('id_kategori', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
    public function read($slug_kategori)
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->where('slug_kategori', $slug_kategori);
        $this->db->order_by('id_kategori', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
   
    public function tambah($data)
    {
        $this->db->insert('kategori', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori');
    }

}

/* End of file Kategori_model.php */
