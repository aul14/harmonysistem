<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{
    public function listing()
    {
        $query = "SELECT `id_karyawan`,`nama_karyawan` nama_karyawan,`email_karyawan`email_karyawan,`foto`foto,`hp_karyawan`hp_karyawan,`alamat_karyawan`alamat_karyawan,`b`.`nama_jabatan`id_jabatan,`karyawan_register`karyawan_register FROM karyawan INNER JOIN `jabatan` `b` ON `b`.`id_jabatan` = `karyawan`.`id_jabatan`";
        return $this->db->query($query)->result();
    }
    public function listing_profil()
    {
        $id = $this->session->userdata('id_karyawan');
        $query = "SELECT `b`.`nama_jabatan`id_jabatan,`karyawan_register`karyawan_register FROM karyawan INNER JOIN `jabatan` `b` ON `b`.`id_jabatan` = `karyawan`.`id_jabatan` where id_karyawan = $id";
        
        return $this->db->query($query)->result();
    }
    public function listing2()
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->order_by('id_karyawan', 'desc');
        return $this->db->get()->result();
        
    }
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
   
    public function detail($id_karyawan)
    {
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->order_by('id_karyawan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
   
    public function tambah($data)
    {
        $this->db->insert('karyawan', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->delete('karyawan');
    }
}

/* End of file Karyawan_model.php */
