<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
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
        $data['title'] = 'Profil '. $this->session->userdata('nama_karyawan');
        $data['karyawan'] = $this->db->get_where('tbl_karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $data['tbl_karyawan'] = $this->Karyawan_model->listing_profil();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav', $data);
        $this->load->view('admin/profil/akun_saya', $data);
        $this->load->view('admin/layout/footer');
    }
    public function edit($id)
    {
        $id = decrypt_url($id);
        $data['title'] = 'Profil '. $this->session->userdata('nama_karyawan');
        $data['karyawan'] = $this->db->get_where('tbl_karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $karyawan = $this->Karyawan_model->listing2();
        $this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required|is_unique[tbl_karyawan.nama_karyawan]');
        $this->form_validation->set_rules('hp_karyawan', 'Hp Karyawan', 'required');
        
        
        
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layout/head', $data);
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/layout/nav', $data);
            $this->load->view('admin/profil/edit_profil', $data);
            $this->load->view('admin/layout/footer');
        } 
      
            if (isset($_POST['edit'])) {
                $const = $this->db->get_where('tbl_karyawan', ['id_karyawan' =>$this->session->userdata('id_karyawan')])->row_array();
                $nama = htmlspecialchars($this->input->post('nama_karyawan'));
                $hp = htmlspecialchars($this->input->post('hp_karyawan'));
                $email = $const['email_karyawan'];
                
                // cek jika ada gambar yang akan diupload
                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG';
                    $config['max_size']     = '2400';
                    $config['max_width']  = '2024';
                    $config['max_height']  = '2024';
                    $config['upload_path'] = './assets/upload/user/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image'))
                     {
                        $oldImage = $data['karyawan']['foto'];
                        if ($oldImage != 'default.jpg') {
                            unlink(FCPATH . 'assets/upload/user/' . $oldImage);
                        }
                        $newImage = $this->upload->data('file_name');
                        $this->db->set('foto', $newImage);
                    } else {
                        $this->upload->display_errors();
                        die;
                    }
                }

                $this->db->set('nama_karyawan', $nama);
                $this->db->set('hp_karyawan', $hp);
                $this->db->where('email_karyawan', $email);
                $this->db->update('tbl_karyawan');
               
                $this->session->set_userdata('nama_karyawan', $nama);
                $this->session->set_flashdata('notifProfil', '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                </button>
                    <strong>Sukses!</strong> Data Profil Berhasil diedit.
                    </div');
                redirect('admin/profil', 'refresh');
            } 
            
        
        
    }

    public function gantipassword()
    {
        $data['title'] = 'Profil '. $this->session->userdata('nama_karyawan');
        $data['karyawan'] = $this->db->get_where('tbl_karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $this->form_validation->set_rules('passwordLama', 'Password Lama', 'trim|required', [
            'required' => 'Password Lama Harus diisi!',
        ]);
        $this->form_validation->set_rules('passwordBaru', 'Password Baru', 'trim|required|min_length[5]|matches[passwordBaru1]', [
            'required' => 'Password baru harus diisi!',
            'matches' => 'Password Tidak Sama!'
        ]);
        $this->form_validation->set_rules('passwordBaru1', 'Konfirmasi Password', 'trim|required|min_length[5]|matches[passwordBaru]', [
            'required' => 'Konfirmasi password harus diisi!',
            'matches' => 'Password Tidak Sama!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/layout/head', $data);
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/layout/nav', $data);
            $this->load->view('admin/profil/ganti_password', $data);
            $this->load->view('admin/layout/footer');
          } else {
            $passwordLama = htmlspecialchars($this->input->post('passwordLama'));
            $passwordBaru = htmlspecialchars($this->input->post('passwordBaru'));

            if (password_verify($passwordLama, $data['karyawan']['password_karyawan'])) {
                if ($passwordLama == $passwordBaru) {
                    $this->session->set_flashdata('info', '<div class="alert alert-warning text-center" role="alert">
                    Password lama tidak boleh sama dengan password baru! </div>');
                    redirect('admin/profil/gantipassword', 'refresh');
                } else {
                    // password bener
                    $hash = password_hash($passwordBaru, PASSWORD_DEFAULT);
                    $this->db->set('password_karyawan', $hash);
                    $this->db->where('nama_karyawan', $this->session->userdata('nama_karyawan'));
                    $this->db->update('tbl_karyawan');
                    $this->session->set_flashdata('info', '<div class="alert alert-success text-center" role="alert">
                    Password berhasil diganti! </div>');
                    redirect('admin/profil/gantipassword', 'refresh');
                }
            } else {
                $this->session->set_flashdata('info', '<div class="alert alert-danger text-center" role="alert">
                 Password lama Salah! </div>');
                 redirect('admin/profil/gantipassword', 'refresh');            }
        }
    }

}

/* End of file Profil.php */
