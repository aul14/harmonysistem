<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{
    public function listing()
    {
        $query = "SELECT `id_karyawan`,`nama_karyawan` nama_karyawan,`email_karyawan`email_karyawan,`foto`foto,`hp_karyawan`hp_karyawan,`alamat_karyawan`alamat_karyawan,`b`.`nama_jabatan`id_jabatan,`karyawan_register`karyawan_register FROM tbl_karyawan INNER JOIN `tbl_jabatan` `b` ON `b`.`id_jabatan` = `tbl_karyawan`.`id_jabatan`";
        return $this->db->query($query)->result();
    }
    public function listing_profil()
    {
        $id = $this->session->userdata('id_karyawan');
        $query = "SELECT `b`.`nama_jabatan`id_jabatan,`karyawan_register`karyawan_register FROM tbl_karyawan INNER JOIN `tbl_jabatan` `b` ON `b`.`id_jabatan` = `tbl_karyawan`.`id_jabatan` where id_karyawan = $id";
        
        return $this->db->query($query)->result();
    }
    public function listing2()
    {
        $this->db->select('*');
        $this->db->from('tbl_karyawan');
        $this->db->order_by('id_karyawan', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    public function update($where, $data, $table)
    {

        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function cek_salah_login($limit=5){
		#method ini dipanggil sekali di login-proses paling atas. 
		#$limit bisa disesuaikan sesuai kebutuhan kita. 
		//cek apakah di tabel tb_admin_log ada 5 IP yang sama dalam keadaan salah login (STAT = 0)

		$ip = $_SERVER['REMOTE_ADDR'];
		$cek = $this->db->prepare("SELECT * FROM tbl_karyawan_log WHERE stat = 0 AND ip = ?");

		$cek->execute(array($ip));
		if($cek->rowCount() >= $limit)
			return false;
		return true;
	}
    public function detail($id_karyawan)
    {
        $this->db->select('*');
        $this->db->from('tbl_karyawan');
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->order_by('id_karyawan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
   
    public function tambah($data)
    {
        $this->db->insert('tbl_karyawan', $data);
    }
    public function hapus($id)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->delete('tbl_karyawan');
    }
}

/* End of file Karyawan_model.php */
