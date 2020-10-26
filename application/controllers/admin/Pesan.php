<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pesan_model');
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
        $data['title'] = "Pesan Masuk";
        $data['pesanMasuk'] = $this->pesan_model->listing();
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
        $this->load->view('admin/pesan/list', $data);
        $this->load->view('admin/layout/footer');
       
    }
    public function read($id)
    {
           $data = [
             'id_status'=> 3
           ];
           $this->db->update('pesan',$data,['id_pesan'=>$id]);
           
           redirect('admin/pesan','refresh');
             
    }
    public function read2($id)
    {
           $data = [
             'id_status'=> 3
           ];
           $this->db->update('pesan',$data,['id_pesan'=>$id]);
           
           redirect('admin/pesan/balas/'.$id,'refresh');
             
    }
    public function hapus($id)
    {
        $this->pesan_model->hapus($id);
        $this->session->set_flashdata('notifPesan', '<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
        </button>
            <strong>Sukses!</strong> Pesan Dihapus.
            </div');
        
        redirect('admin/pesan','refresh');
    }
    public function balas($id)
    {
        $data['title'] = "Balas Pesan";
        $data['pesanM'] = $this->pesan_model->detail($id);
        $data['pesan'] = $this->beranda_model->hitungPesan();
        $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
        $data['hitung'] = $this->beranda_model->hitung();
        $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
        $data['karyawan'] = $this->db->get_where('karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav', $data);
        $this->load->view('admin/pesan/balas', $data);
        $this->load->view('admin/layout/footer');

        if (isset($_POST['kirim'])) {
            $this->_sendEmail();
        }
    }
    
    private function _sendEmail() 
    {
       $id= $this->uri->segment(4);
       $email = $this->pesan_model->detail2($id);
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'noreply.harmonysistem@gmail.com',
            'smtp_pass' => 'maubangetlu1716',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'newline' => "\r\n",
            'priority' => 1
        ];
        
        $this->load->library('email', $config);
        $this->email->initialize($config); 

        $this->email->from('noreply.harmonysistem@gmail.com', 'Harmony Sistem');
        $this->email->to($email['email_pesan']);
        $message =  "
        <html>
        <head>
        <title>Tanggapan Pesan PT Harmony Sistem</title>
        </head>
        <body>
        <h2>Terimakasih telah memberikan saran atau kritik kepada kami</h2>
        <h3>".$this->input->post('pesan')."</h3>
        <p>Jika anda merasa belum puas atas tanggapan dari kami, anda bisa melakukan kritik kembali melalui website resmi kami, Terima kasih</p>
        </body>
        </html>
        ";
      
        $this->email->subject('Tanggapan Pesan');
        $this->email->message($message);
    

        if($this->email->send()) {
            $this->session->set_flashdata('notifPesan', '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
            </button>
                <strong>Sukses!</strong>Pesan berhasil dibalas.
                </div');
        } else {
            echo $this->email->print_debugger();
            die;
        }
         
        
    }

}

/* End of file Pesan.php */
