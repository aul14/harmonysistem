<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_model extends CI_Model {

    public function listing()
    {
       $query = "SELECT `id_pesan`,`nama_pesan` nama_pesan,`email_pesan`email_pesan,`pesan`pesan,`b`.`status_nama`id_status,`subject_pesan` FROM pesan INNER JOIN `status` `b` ON `b`.`id_status` = `pesan`.`id_status`";
       return $this->db->query($query)->result();
    }
    public function detail($id)
    {
        $query = "SELECT `id_pesan`,`nama_pesan` nama_pesan,`email_pesan`email_pesan,`pesan`pesan,`b`.`status_nama`id_status,`subject_pesan` FROM pesan INNER JOIN `status` `b` ON `b`.`id_status` = `pesan`.`id_status` where id_pesan = $id";
        return $this->db->query($query)->row();
    }
    public function detail2($id)
    {
        $this->db->select('*');
        $this->db->from('pesan');
        $this->db->where('id_pesan', $id);
        $this->db->order_by('id_pesan', 'desc');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function hapus($id)
    {
        $this->db->where('id_pesan', $id);
        $this->db->delete('pesan');
    }
}

/* End of file Pesan_model.php */
