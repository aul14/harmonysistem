<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{

    public function listing()
    {
        $query = "SELECT `id_pelanggan`,`nama_pelanggan`,`email`,`telepon`,`alamat`,`a`.`nama`id_prov,`b`.`nama`id_kab,`c`.`nama`id_kec,`d`.`nama`id_kel FROM tbl_pelanggan INNER JOIN `provinsi` `a` ON `a`.`id_prov` = `tbl_pelanggan`.`id_prov` INNER JOIN `kabupaten` `b` ON `b`.`id_kab` = `tbl_pelanggan`.`id_kab` INNER JOIN `kecamatan` `c` ON `c`.`id_kec` = `tbl_pelanggan`.`id_kec` INNER JOIN `kelurahan` `d` ON `d`.`id_kel` = `tbl_pelanggan`.`id_kel`";
        return $this->db->query($query)->result();
    }
    public function detail($id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('tbl_pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->order_by('id_pelanggan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
   public function sudah_login($id)
   {
    $query = "SELECT `id_pelanggan`,`nama_pelanggan`,`email`,`telepon`,`alamat`,`kode_pos`,`a`.`nama`id_prov,`b`.`nama`id_kab,`c`.`nama`id_kec,`d`.`nama`id_kel FROM tbl_pelanggan INNER JOIN `provinsi` `a` ON `a`.`id_prov` = `tbl_pelanggan`.`id_prov` INNER JOIN `kabupaten` `b` ON `b`.`id_kab` = `tbl_pelanggan`.`id_kab` INNER JOIN `kecamatan` `c` ON `c`.`id_kec` = `tbl_pelanggan`.`id_kec` INNER JOIN `kelurahan` `d` ON `d`.`id_kel` = `tbl_pelanggan`.`id_kel` where id_pelanggan = $id";
    return $this->db->query($query)->row();
   }

    public function tambah($data)
    {
        $this->db->insert('tbl_pelanggan', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_pelanggan', $id);
        $this->db->delete('tbl_pelanggan');
    }
   
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
}

/* End of file Pelanggan_model.php */
