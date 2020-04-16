<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rekening_model');
        if (!$_SESSION['email_karyawan']) {
            $this->session->set_flashdata('notifLogin', '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
                </button>
                <strong>Gagal!</strong> Silahkan Login Terlebih Dahulu.
                </div>');
            redirect('admin/login');
        }
    }
    
    public function index()
    {
        $data['title'] = "Data Rekening";
        $data['tbl_rekening'] = $this->Rekening_model->listing();
        $data['karyawan'] = $this->db->get_where('tbl_karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav',$data);
        $this->load->view('admin/rekening/list', $data);
        $this->load->view('admin/layout/footer');
    }
    public function tambah()
    {
        $this->form_validation->set_rules('nama_bank', 'Nama Rekening', 'required|is_unique[tbl_rekening.nama_bank]');
        $this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required');
        $this->form_validation->set_rules('nomor_rekening', 'Nomor Rekening', 'trim|required|is_unique[tbl_rekening.nomor_rekening]');

        
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Rekening Baru";
            $data['karyawan'] = $this->db->get_where('tbl_karyawan', [
                'nama_karyawan' => $this->session->userdata('nama_karyawan')
            ])->row_array();
            $this->load->view('admin/layout/head', $data);
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/layout/nav', $data);
            $this->load->view('admin/rekening/tambah');
            $this->load->view('admin/layout/footer');
        } else {
            
            $config['upload_path'] = './assets/upload/rekening/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2400';
            $config['max_width']  = '2024';
            $config['max_height']  = '2024';
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('gambar')){
                echo 'anda gagal upload';
                $this->upload->display_errors();
            }
            else{
                $file = $this->upload->data();
                $data = [
                    'id_karyawan' => $this->session->userdata('id_karyawan'),
                    'nama_bank' => htmlspecialchars($this->input->post('nama_bank')),
                    'nomor_rekening' => htmlspecialchars($this->input->post('nomor_rekening')),
                    'nama_pemilik' => htmlspecialchars($this->input->post('nama_pemilik')),
                    'gambar' => $file['file_name']
                ];
                $this->Rekening_model->tambah($data);
                $this->session->set_flashdata('notifRekening', '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                </button>
                    <strong>Sukses!</strong> Data Rekening berhasil ditambahkan.
                    </div');
                
                redirect('admin/rekening','refresh');
            }
            
        }
        
    }

}

/* End of file Rekening.php */
