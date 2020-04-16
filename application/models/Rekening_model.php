<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekening_model extends CI_Model
{


    public function listing()
    {
        $this->db->select('*');
        $this->db->from('tbl_rekening');

        $this->db->order_by('id_rekening', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail($id_rekening)
    {
        $this->db->select('*');
        $this->db->from('tbl_rekening');
        $this->db->where('id_rekening', $id_rekening);
        $this->db->order_by('id_rekening', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    public function tambah($data)
    {
        $this->db->insert('tbl_rekening', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_rekening', $id);
        $this->db->delete('tbl_rekening');
    }
   
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
}

/* End of file Rekening_model.php */
