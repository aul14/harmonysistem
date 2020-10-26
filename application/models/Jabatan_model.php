<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan_model extends CI_Model
{
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('jabatan');
        $this->db->where_not_in('id_jabatan', 99) and  $this->db->where_not_in('id_jabatan', 98);
        $this->db->order_by('id_jabatan', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file Jabatan_model.php */
