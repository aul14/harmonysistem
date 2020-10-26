<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Karyawan_model');
        $this->load->model('Jabatan_model');
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
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
        $data['title'] = "Data Karyawan";
        $data['tbl_karyawan'] = $this->Karyawan_model->listing();
        $data['pesan'] = $this->beranda_model->hitungPesan();
        $data['hitung'] = $this->beranda_model->hitung();
        $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
        $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
        $data['karyawan'] = $this->db->get_where('karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav', $data);
        $this->load->view('admin/karyawan/list', $data);
        $this->load->view('admin/layout/footer');
    }
    public function tambah()
    {
        if ($_SESSION['id_jabatan'] == 1 or $_SESSION['id_jabatan'] == 2 or $_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifKaryawan', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/karyawan');
        }
        $this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'trim|required|is_unique[karyawan.nama_karyawan]');
        $this->form_validation->set_rules('email_karyawan', 'Email Karyawan', 'trim|required|valid_email|is_unique[karyawan.email_karyawan]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password2', 'trim|required|min_length[8]|matches[password]');
        $jabatan = htmlspecialchars($this->input->post('id_jabatan'));
        
        $pass = stripslashes(htmlspecialchars(strip_tags($this->input->post('password'))));
        $lowercase = preg_match('@[a-z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);
       
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Karyawan";
            $data['pesan'] = $this->beranda_model->hitungPesan();
            $data['hitung'] = $this->beranda_model->hitung();
            $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
            $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
            $data['jabatan'] = $this->Jabatan_model->listing();
            $data['karyawan'] = $this->db->get_where('karyawan', [
                'nama_karyawan' => $this->session->userdata('nama_karyawan')
            ])->row_array();
            $this->load->view('admin/layout/head', $data);
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/layout/nav', $data);
            $this->load->view('admin/karyawan/tambah', $data);
            $this->load->view('admin/layout/footer');
        } else if ($jabatan == 99 and $jabatan == 98) {
            $this->session->set_flashdata('notifKaryawan', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
            </button>
                <strong>Gagal!</strong>Anda gagal menambahkan karyawan baru.
                </div');
            
            redirect('admin/karyawan/tambah','refresh');
        }  else if (!$lowercase || !$number) {
            $this->session->set_flashdata('notifKaryawan', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
            </button>
                <strong>Gagal!</strong>Password harus terdiri dari huruf dan angka.
                </div');
            
            redirect('admin/karyawan/tambah','refresh');
        } else {
            $data = [
                'nama_karyawan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('nama_karyawan')))),
                'email_karyawan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('email_karyawan')))),
                'foto' => 'default.jpg',
                'password_karyawan' => password_hash($pass, PASSWORD_DEFAULT),
                'alamat_karyawan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('alamat_karyawan')))),
                'hp_karyawan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('hp_karyawan')))),
                'id_jabatan' => $jabatan,
                'id_status' => 1,
                'karyawan_register' => date('Y-m-d H:i:s')
            ];
            $this->Karyawan_model->tambah($data);
            $this->session->set_flashdata('notifKaryawan', '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
            </button>
                <strong>Sukses!</strong> Data Karyawan Berhasil Ditambahkan.
                </div');
            
            redirect('admin/karyawan','refresh');
            
        }
        
        
    }

    public function edit($id_karyawan)
    {
        if ($_SESSION['id_jabatan'] == 1 or $_SESSION['id_jabatan'] == 2 or $_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifKaryawan', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/karyawan');
        }
        $id_karyawan= decrypt_url($id_karyawan);
        $this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required|is_unique[karyawan.nama_karyawan]');
        $this->form_validation->set_rules('email_karyawan', 'Email Karyawan', 'required|valid_email|is_unique[karyawan.email_karyawan]');
        $jabatan = htmlspecialchars($this->input->post('id_jabatan'));

        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Edit Karyawan";
            $data['jabatan'] = $this->Jabatan_model->listing();
            $data['pesan'] = $this->beranda_model->hitungPesan();
            $data['hitung'] = $this->beranda_model->hitung();
            $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
            $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
            $data['tbl_karyawan'] = $this->Karyawan_model->detail($id_karyawan);
            $data['karyawan'] = $this->db->get_where('karyawan', [
                'nama_karyawan' => $this->session->userdata('nama_karyawan')
            ])->row_array();
            $this->load->view('admin/layout/head', $data);
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/layout/nav',$data);
            $this->load->view('admin/karyawan/edit', $data);
            $this->load->view('admin/layout/footer');
        } else {
            $data = [
                'id_karyawan' => $id_karyawan,
                'nama_karyawan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('nama_karyawan')))),
                'email_karyawan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('email_karyawan')))),
                'foto' => 'default.jpg',
                'alamat_karyawan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('alamat_karyawan')))),
                'hp_karyawan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('hp_karyawan')))),
                'id_jabatan' => $jabatan,
                'id_status' => 1
            ];
            $where = ['id_karyawan' => $id_karyawan];
            $this->Karyawan_model->update($where, $data, 'karyawan');
            $this->session->set_flashdata('notifKaryawan', '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
            </button>
                <strong>Sukses!</strong> Data Karyawan Berhasil Diedit.
                </div');
            
            redirect('admin/karyawan','refresh');
        }
        
    }
    public function hapus($id)
    {
        if ($_SESSION['id_jabatan'] == 1 or $_SESSION['id_jabatan'] == 2 or $_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifKaryawan', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/karyawan');
        }
        $id= decrypt_url($id);
        $this->Karyawan_model->hapus($id);
        $this->session->set_flashdata('notifKaryawan', '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
            </button>
                <strong>Sukses!</strong> Data Karyawan Berhasil Dihapus.
                </div');
            
            redirect('admin/karyawan','refresh');
    }
}

/* End of file Karyawan.php */
