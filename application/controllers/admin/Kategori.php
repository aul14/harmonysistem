<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
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
        $data['title'] = "Data Kategori Produk";
        $data['tbl_kategori'] = $this->Kategori_model->listing();
        $data['karyawan'] = $this->db->get_where('tbl_karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav',$data);
        $this->load->view('admin/kategori/list', $data);
        $this->load->view('admin/layout/footer');
    }
    public function tambah()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|is_unique[tbl_kategori.nama_kategori]');
        
        
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Kategori Produk";
            $data['karyawan'] = $this->db->get_where('tbl_karyawan', [
                'nama_karyawan' => $this->session->userdata('nama_karyawan')
            ])->row_array();
            $this->load->view('admin/layout/head', $data);
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/layout/nav', $data);
            $this->load->view('admin/kategori/tambah');
            $this->load->view('admin/layout/footer');
        } else {
            $slug_kategori = url_title($this->input->post('nama_kategori'), 'dash', TRUE);
            $data = [
                'slug_kategori' => $slug_kategori,
                'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori')),
                'urutan' => htmlspecialchars($this->input->post('urutan'))
            ];
            $this->Kategori_model->tambah($data);
            $this->session->set_flashdata('notifKategori', '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
            </button>
                <strong>Sukses!</strong> Data Kategori Produk Ditambahkan.
                </div');
            
            redirect('admin/kategori','refresh');
        }
        
    }
    public function edit($id_kategori)
    {
        $data['kategori'] = $this->Kategori_model->detail($id_kategori);
        
        if ($this->form_validation->run() ==  FALSE) {
            $data['title'] = "Edit Kategori Produk";
            $data['karyawan'] = $this->db->get_where('tbl_karyawan', [
                'nama_karyawan' => $this->session->userdata('nama_karyawan')
            ])->row_array();
            $this->load->view('admin/layout/head', $data);
            $this->load->view('admin/layout/sidebar');
            $this->load->view('admin/layout/nav', $data);
            $this->load->view('admin/kategori/edit', $data);
            $this->load->view('admin/layout/footer');
        } 
        if (isset($_POST['simpan'])) {
            $slug_kategori = url_title($this->input->post('nama_kategori'), 'dash', TRUE);
            $data = [
                'id_kategori' => $id_kategori,
                'slug_kategori' => $slug_kategori,
                'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori')),
                'urutan' => htmlspecialchars($this->input->post('urutan'))
            ];
            $where = ['id_kategori' => $id_kategori];
            $this->Kategori_model->update($where, $data, 'tbl_kategori');
            $this->session->set_flashdata('notifKategori', '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
            </button>
                <strong>Sukses!</strong> Data Kategori Produk Diedit.
                </div');
            
            redirect('admin/kategori','refresh');
        }
        
    }
    public function hapus($id)
    {
        $this->Kategori_model->hapus($id);
        $this->session->set_flashdata('notifKategori', '<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
        </button>
            <strong>Sukses!</strong> Data Kategori Produk Dihapus.
            </div');
        
        redirect('admin/kategori','refresh');
    }
}

/* End of file Kategori.php */
