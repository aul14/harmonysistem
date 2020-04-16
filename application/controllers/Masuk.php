<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
       
    }
    
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('beranda','refresh');
         }
        $this->form_validation->set_rules('email', 'Email Pelanggan', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Login Pelanggan',
                'isi' => 'masuk/list'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $email = htmlentities(strip_tags(htmlspecialchars($this->input->post('email'))));
            $password = $this->input->post('password');

            $check_email = $this->db->get_where('tbl_pelanggan', ['email' => $email])->row_array();

            if ($check_email) {
                if ($check_email['id_status'] == 1) {
                    if (password_verify($password, $check_email['password'])) {
                        $ambil = [
                            'id_pelanggan' => $check_email['id_pelanggan'],
                            'nama_pelanggan' => $check_email['nama_pelanggan'],
                            'email' => $check_email['email'],
                        ];
                        $this->session->set_userdata($ambil);
    
                        redirect('beranda', 'refresh');
                    } else {
                        $this->session->set_flashdata('sukses', '<strong>Gagal!</strong> Email atau password salah');
                        redirect('masuk','refresh');
                    }
                } else {
                    $this->session->set_flashdata('sukses', '<strong>Gagal!</strong> Silahkan Aktivasi email yang telah didaftarkan');
                    redirect('masuk','refresh');
                }
            } else {
                $this->session->set_flashdata('sukses', '<strong>Gagal!</strong> Email atau password tidak terdaftar');
                redirect('masuk','refresh');
            }
        }   
        
    }
    
    public function logout()
    {
        $this->session->unset_userdata('id_pelanggan');
        $this->session->unset_userdata('nama_pelanggan');
        $this->session->unset_userdata('email');        
        $this->session->sess_destroy();
        redirect('masuk');
    }

}

/* End of file Controllername.php */
