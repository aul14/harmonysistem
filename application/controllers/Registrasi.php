<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {
    
    public function __construct()
    {    
        parent::__construct();
        $this->load->model('Pelanggan_model');
        $this->load->model('Daerah_model','daerah');
        
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }
    
    public function index()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required',
        ['alamat' => '%s Harus diisi']);
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'trim|required',
        ['kode_pos' => '%s Harus diisi']);
        $this->form_validation->set_rules('id_kab', 'Kota / Kabupaten', 'trim|required',
        ['kota' => '%s Harus diisi']);
        $this->form_validation->set_rules('id_kel', 'Kelurahan', 'trim|required',
        ['kelurahan' => '%s Harus diisi']);
        $this->form_validation->set_rules('id_kec', 'Kecamatan', 'trim|required',
        ['kecamatan' => '%s Harus diisi']);
        $this->form_validation->set_rules('id_prov', 'Provinsi', 'trim|required',
        ['provinsi' => '%s Harus diisi']);
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pelanggan.email]',
        ['is_unique' => '%s Sudah terdaftar']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');

        $pass = $this->input->post('password');
        $lowercase = preg_match('@[a-z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);
        
        if ($this->form_validation->run() == FALSE) {
            $provinsi = $this->daerah->getProv();
            
            $data=[
                'title' => 'Registrasi Pelanggan',
                'provinsi' => $provinsi,
                'isi' => 'registrasi/list'
            ];
            $this->load->view('layout/wrapper', $data);
        } else if (!$lowercase || !$number) {
            $this->session->set_flashdata('sukses', '<strong>Gagal!!</strong> Password harus terdiri dari huruf dan angka');
            
            redirect('registrasi','refresh');
        } else {
            $email = $this->input->post('email');
            $data = [
                'id_status' => 0,
                'nama_pelanggan' => stripslashes(strip_tags(htmlspecialchars($this->input->post('nama_pelanggan')))),
                'email' => stripslashes(strip_tags(htmlspecialchars($email))),
                'password' => password_hash($pass,  PASSWORD_DEFAULT),
                'telepon' => stripslashes(strip_tags(htmlspecialchars($this->input->post('telepon')))),
                'alamat' => stripslashes(strip_tags(htmlspecialchars($this->input->post('alamat')))),
                'id_prov' => stripslashes(strip_tags(htmlspecialchars($this->input->post('id_prov')))),
                'id_kab' => stripslashes(strip_tags(htmlspecialchars($this->input->post('id_kab')))),
                'id_kec' => stripslashes(strip_tags(htmlspecialchars($this->input->post('id_kec')))),
                'id_kel' => stripslashes(strip_tags(htmlspecialchars($this->input->post('id_kel')))),
                'kode_pos' => stripslashes(strip_tags(htmlspecialchars($this->input->post('kode_pos')))),
                'pelanggan_daftar' => date('Y-m-d H:i:s')
            ];

            //siapkan token
           $token = base64_encode(random_bytes(32));
           $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
           ];
          $this->db->insert('user_token', $user_token);
           
          $this->Pelanggan_model->tambah($data);

            $this->_sendEmail($token, 'verify');
            
            $this->session->set_flashdata('sukses', 'Registrasi Berhasil, Silahkan aktivasi email yang sudah didaftarkan');

            redirect('registrasi/sukses', 'refresh');
        }
        
       
        
    }

    private function _sendEmail($token, $type) 
    {
        
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'noreply.harmonysistem@gmail.com',
            'smtp_pass' => 'maubangetlu1716',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'priority' => 1
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config); 

        $this->email->from('noreply.harmonysistem@gmail.com', 'Harmony Sistem');
        $this->email->to($this->input->post('email'));
        $message =  "
        <html>
        <head>
        <title>Kode Verifikasi</title>
        </head>
        <body>
        <h2>Terimakasih telah mendaftar.</h2>
        <p>Your Account:</p>
       <p>Email: ".$this->input->post('email')."</p>
        <p>Silahkan klik link <strong>Aktivasi Akun Saya.</strong></p>
        <h4><a href='".base_url()."registrasi/verify?email=" . $this->input->post('email') . 
        "&token=" . urlencode($token) . "'>Aktivasi Akun Saya</a></h4>
        </body>
        </html>
        ";
        if ($type == 'verify') {
            $this->email->subject('Intruksi Verifikasi Akun');
            $this->email->message($message);
        }

        if($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
         
        
    }
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('pelanggan', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {       
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('id_status', 1);
                    $this->db->where('email', $email);
                    $this->db->update('pelanggan');
                    
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('sukses', 'Verifikasi akun Berhasil');
             
                    redirect('masuk','refresh');
                } else {
                 $this->db->delete('pelanggan', ['email' => $email]);
                 $this->db->delete('user_token', ['email' => $email]);
                 
                 $this->session->set_flashdata('sukses', 'Verifikasi akun gagal, Token Expired!!');
             
                 redirect('masuk','refresh');
                }
            } else {
                $this->session->set_flashdata('sukses', 'Verifikasi akun gagal, Token Invalid!!');
            
                redirect('masuk','refresh');
            }
        } else {
            $this->session->set_flashdata('sukses', 'Verifikasi akun gagal, Email Salah!!');
            
            redirect('masuk','refresh');
            
        }
    }
    public function sukses()
    {
        $data = [
            'title' => 'Registrasi Berhasil',
            'isi' => 'registrasi/sukses'
        ];
        $this->load->view('layout/wrapper', $data);
        
    }
    public function getKab($id_prov)
	{
	  $kab=$this->daerah->getKab($id_prov);
	   echo"<option value=''>Pilih Kota/Kabupaten</option>";
	  foreach($kab as $k){
	    echo "<option value='{$k->id_kab}'>{$k->nama}</option>";
	  }
	}
	
	public function getKec($id_kab)
	{
	  $kec=$this->daerah->getKec($id_kab);
	   echo"<option value=''>Pilih Kecamatan</option>";
	  foreach($kec as $k){
	    echo "<option value='{$k->id_kec}'>{$k->nama}</option>";
	  }
	}

	public function getKel($id_kec)
	{
	  $kel=$this->daerah->getKel($id_kec);
	   echo"<option value=''>Pilih Kelurahan/Desa</option>";
	  foreach($kel as $k){
	    echo "<option value='{$k->id_kel}'>{$k->nama}</option>";
	  }
	}	
}

/* End of file Registrasi.php */
