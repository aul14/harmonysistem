<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    
    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('pesan', 'Pesan', 'trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            
            $data=[
                'title' => 'Hubungi Kami',
                'isi' => 'kontak/list'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $data = [
                'nama_pesan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('nama')))),
                'subject_pesan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('subject')))),
                'email_pesan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('email')))),
                'pesan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('pesan')))),
                'id_status' => 2
            ];
            $this->db->insert('pesan', $data);
            $this->session->set_flashdata('sukses', 'Terimakasih atas saran dan kritik anda, kami akan menanggapi melalui email');
            
            redirect('kontak','refresh');
            
        }
    }

}

/* End of file Kontak.php */
