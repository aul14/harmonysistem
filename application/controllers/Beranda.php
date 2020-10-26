<?php 

use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pelanggan_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Detail_transaksi_model','detail_transaksi_model');
        $this->load->model('Rekening_model');
        $this->load->model('beranda_model');
        
        $params = array('server_key' => 'SB-Mid-server-p3tc7DjNg2eIGlBgNCrGUfif', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
        if (!$_SESSION['email']) {
            $this->session->set_flashdata('sukses','<strong>Gagal!</strong> Silahkan Login terlebih dahulu');
            redirect('masuk');
        }
        
    }
    
    public function index()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->detail_transaksi_model->pelanggan2($id_pelanggan);
        $data=[
            'title' => 'Harmony Sistem | Jual, sewa mesin fotocopy Konica Minolta',
            'header_transaksi' => $header_transaksi,
            'isi' => 'dasbor/list'
        ];
        $this->load->view('layout/wrapper', $data);
        
    }
    public function belanja()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $total = $this->beranda_model->total_list();
        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'beranda/belanja/index/';
        $config['total_rows'] = $total->total;
        $config['use_page_numbers'] = true;
        $config['per_page'] = 3;
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;

         $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $config['first_url'] = base_url().'/beranda/belanja/';
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4)-1) * $config['per_page']:0;
        $header_transaksi = $this->detail_transaksi_model->pelanggan($id_pelanggan,$config['per_page'],$page);

        $data=[
            'title' => 'Riwayat Belanja',
            'header_transaksi' => $header_transaksi,
            'pagin' => $this->pagination->create_links(),
            'isi' => 'dasbor/belanja'
        ];
        $this->load->view('layout/wrapper', $data);
    }
    public function detail($id_transaksi)
    {
        $id_transaksi= decrypt_url($id_transaksi);
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $header_transaksi = $this->Transaksi_model->id_transaksi($id_transaksi);
        $transaksi = $this->detail_transaksi_model->id_transaksi($id_transaksi);
        $midtrans = $this->Konfigurasi_model->detailmidtrans($id_transaksi)->result();
        
        if ($header_transaksi->id_pelanggan != $id_pelanggan) {
            $this->session->set_flashdata('warning', 'Akses tidak diterima');
            
            redirect('beranda','refresh');
            
        } 
        $data=[
            'title' => 'Detail Belanja',
            'header_transaksi' => $header_transaksi,
            'transaksi' => $transaksi,
            'midtrans' => $midtrans,
            'isi' => 'dasbor/detail'
        ];
        $this->load->view('layout/wrapper', $data);
        
    }

    public function profil()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $pelanggan = $this->Pelanggan_model->detail($id_pelanggan);
        $data=[
            'title' => 'Profil '. $this->session->userdata('nama_pelanggan'),
            'pelanggan' => $pelanggan,
            'isi' => 'dasbor/profil'
        ];
        $this->load->view('layout/wrapper', $data);
    }
    public function editprofil($id)
    {
        $id= decrypt_url($id);
        $profil = $this->db->get_where('pelanggan', [
            'nama_pelanggan' => $this->session->userdata('nama_pelanggan')
        ])->row_array();
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'trim|required');
        $this->form_validation->set_rules('telepon', 'No Telepon', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $data=[
                'title' => 'Edit Profil '. $this->session->userdata('nama_pelanggan'),
                'profil' => $profil,
                'isi' => 'dasbor/edit_profil'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            if (isset($_POST['edit'])) {
                $const = $this->db->get_where('pelanggan', ['id_pelanggan' => $id])->row_array();
                $nama = stripslashes(htmlspecialchars(strip_tags($this->input->post('nama_pelanggan'))));
                $hp = stripslashes(htmlspecialchars(strip_tags($this->input->post('telepon'))));
                $email = $const['email'];

                $this->db->set('nama_pelanggan', $nama);
                $this->db->set('telepon', $hp);
                $this->db->where('email', $email);
                // var_dump($email);die;
                $this->db->update('pelanggan');
                $this->session->set_userdata('nama_pelanggan', $nama);
                $this->session->set_flashdata('sukses', 'Sukses! Data profil berhasil diganti');
               
                redirect('beranda/profil', 'refresh');
                
            }
        }
        
    }
    public function gantipassword()
    {
        $this->form_validation->set_rules('passwordLama', 'Password Lama', 'trim|required', [
            'required' => 'Password Lama Harus diisi!',
        ]);
        $this->form_validation->set_rules('passwordBaru', 'Password Baru', 'trim|required|min_length[8]|matches[passwordBaru1]', [
            'required' => 'Password baru harus diisi!',
            'min_lenght' => 'Password minimal 8 karakter',
            'matches' => 'Password Tidak Sama!'
        ]);
        $this->form_validation->set_rules('passwordBaru1', 'Konfirmasi Password', 'trim|required|min_length[8]|matches[passwordBaru]', [
            'required' => 'Konfirmasi password harus diisi!',
            'min_lenght' => 'Password minimal 8 karakter',
            'matches' => 'Password Tidak Sama!'
        ]);
        $data['pelanggan'] = $this->db->get_where('pelanggan', [
            'nama_pelanggan' => $this->session->userdata('nama_pelanggan')
        ])->row_array();
        
        if ($this->form_validation->run() == false) {
            $data=[
                'title' => 'Ganti Password Profil '. $this->session->userdata('nama_pelanggan'),
                'isi' => 'dasbor/ganti_password'
            ];
            $this->load->view('layout/wrapper', $data);
        } else {
            $passwordLama = stripslashes(htmlspecialchars(strip_tags($this->input->post('passwordLama'))));
            $passwordBaru = stripslashes(htmlspecialchars(strip_tags($this->input->post('passwordBaru'))));
            if (password_verify($passwordLama, $data['pelanggan']['password'])) {
                if ($passwordLama == $passwordBaru) {
                  $this->session->set_flashdata('sukses', 'Password lama tidak boleh sama dengan password baru!!');
                  
                  redirect('beranda/gantipassword','refresh');
                  
                } else {
                    // password bener
                    $hash = password_hash($passwordBaru, PASSWORD_DEFAULT);
                    $this->db->set('password', $hash);
                    $this->db->where('nama_pelanggan', $this->session->userdata('nama_pelanggan'));
                    $this->db->update('pelanggan');
                    $this->session->set_flashdata('sukses', 'Password berhasil diganti');
                    redirect('beranda/gantipassword', 'refresh');
                }
            } else {
                $this->session->set_flashdata('sukses', 'Password lama salah!!');
                 redirect('beranda/gantipassword', 'refresh');          
          }
        }
        
      
    }

}

/* End of file Dasbor.php */
