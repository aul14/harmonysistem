<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Karyawan_model');
        
    }
    
    public function index()
    {
        if ($this->session->userdata('email_karyawan')) {
           redirect('admin/beranda','refresh');
        }
        $this->form_validation->set_rules('email_karyawan', 'Email Karyawan', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        
        if ($this->form_validation->run() == false) {
            $data['title'] = "Login - PT Harmony Sistem";
            $this->load->view('admin/auth/auth_header', $data);
            $this->load->view('admin/auth/login', $data);
            $this->load->view('admin/auth/auth_footer');
        } else {
            $emailkaryawan = htmlentities(htmlspecialchars(strip_tags($this->input->post('email_karyawan'))));
            $password = $this->input->post('password');

            $check_email = $this->db->get_where('tbl_karyawan', ['email_karyawan' => $emailkaryawan])->row_array();

            if ($check_email) {
                // if(!$this->karyawan_model->cek_salah_login()){
                //     //kalau user salah login melebihi batas yang ditentukan, maka proses langsung berhenti
                //     $this->session->set_flashdata('notifLogin', '<div class="alert alert-danger alert-dismissible" role="alert">
                //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                //         <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                //     </button>
                //     <strong>Gagal!</strong> Anda tidak bisa login karena kesalahan login terlalu banyak!!!
                //      </div>');
                // }
                if (password_verify($password, $check_email['password_karyawan'])) {
                    $ambil = [
                        'id_karyawan' => $check_email['id_karyawan'],
                        'nama_karyawan' => $check_email['nama_karyawan'],
                        'email_karyawan' => $check_email['email_karyawan'],
                        'id_jabatan' => $check_email['id_jabatan'],
                        'id_status' => $check_email['id_status']
                    ];
                    $this->session->set_userdata($ambil);

                    redirect('admin/beranda', 'refresh');
                }else {
                    $this->session->set_flashdata('notifLogin', '<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                    </button>
                    <strong>Gagal!</strong> email atau password salah!
                     </div>');
                    
                    redirect('admin/login','refresh');
                    
                }
            } else {
                $this->session->set_flashdata('notifLogin', '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                </button>
                <strong>Gagal!</strong> email atau password tidak terdaftar!
                 </div>');
                
                redirect('admin/login','refresh');
                
            }
        }
        
    }

    public function logout()
    {
        $this->session->unset_userdata('email_karyawan');
        $this->session->unset_userdata('nama_karyawan');
        $this->session->unset_userdata('id_karyawan');
        $this->session->unset_userdata('id_status');
        $this->session->unset_userdata('id_jabatan');
        $this->session->sess_destroy();
        redirect('admin/login');
    }

}

/* End of file Auth.php */
