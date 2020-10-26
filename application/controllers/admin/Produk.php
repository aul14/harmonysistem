<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $this->load->model('Produk_model');
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
        $data['title'] = "Data Produk";
        $data['produk'] = $this->Produk_model->listing();
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
        $this->load->view('admin/produk/list', $data);
        $this->load->view('admin/layout/footer');   
    }
    public function gambar($id_produk)
    {
        if ($_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifProduk', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/produk');
        }
        $produk = $this->Produk_model->detail($id_produk);
        $gambar = $this->Produk_model->gambar($id_produk);

        //validasi input
        $this->form_validation->set_rules('judul_gambar', 'Nama Gambar', 'trim|required');

        if ($this->form_validation->run()) {

            $config['upload_path'] = './assets/upload/produk/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']  = '2400';
            $config['max_width']  = '2024';
            $config['max_height']  = '2024';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $data = [
                    'title' => 'Tambah Gambar Produk: ' .$produk->nama_produk,
                    'produk' => $produk,
                    'gambar' => $gambar,
                    'eror' => $this->upload->display_errors(),
                ];
                $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
                $data['pesan'] = $this->beranda_model->hitungPesan();
                $data['hitung'] = $this->beranda_model->hitung();
                $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
                $data['karyawan'] = $this->db->get_where('karyawan', [
                    'nama_karyawan' => $this->session->userdata('nama_karyawan')
                ])->row_array();
                $this->load->view('admin/layout/head', $data);
                $this->load->view('admin/layout/sidebar');
                $this->load->view('admin/layout/nav', $data);
                $this->load->view('admin/produk/gambar', $data);
                $this->load->view('admin/layout/footer');   
            } else {
                $upload_gambar = array('upload_data' => $this->upload->data());

                //create thumbnail
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/upload/produk/' . $upload_gambar['upload_data']['file_name'];
                //lokasi folder thumbnail
                $config['new_image'] = './assets/upload/produk/thumbs/';
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 250; //pixel
                $config['height']       = 250;
                $config['thumb_marker'] = '';

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
                //end thumbnail

                $data = [
                    'id_produk' => $id_produk,
                    'judul_gambar' => stripslashes(htmlspecialchars(strip_tags($this->input->post('judul_gambar')))),
                    'gambar' => $upload_gambar['upload_data']['file_name'],

                ];

                $this->Produk_model->tambah_gambar($data);
                $this->session->set_flashdata('notifProduk', '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                </button>
                    <strong>Sukses!</strong> Data Gambar Produk Ditambah.
                    </div');


                redirect('admin/produk/gambar/' . $id_produk, 'refresh');
            }
        }
        $data = [
            'title' => 'Tambah Gambar Produk: ' .$produk->nama_produk,
            'produk' => $produk,
            'gambar' => $gambar,
        ];
        $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
        $data['pesan'] = $this->beranda_model->hitungPesan();
        $data['hitung'] = $this->beranda_model->hitung();
        $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
        $data['karyawan'] = $this->db->get_where('karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav',$data);
        $this->load->view('admin/produk/gambar', $data);
        $this->load->view('admin/layout/footer');  
    }
    public function tambah()
    {
        if ($_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifProduk', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/produk');
        }
        $kategori = $this->Kategori_model->listing();
        //validasi input
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'trim|required|is_unique[produk.kode_produk]', ['is_unique' => '%s sudah ada. Buat kode produk baru']);

        if ($this->form_validation->run()) {

            $config['upload_path'] = './assets/upload/produk/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']  = '2400';
            $config['max_width']  = '2024';
            $config['max_height']  = '2024';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $data = [
                    'title' => 'Tambah Produk',
                    'kategori' => $kategori,
                    'eror' => $this->upload->display_errors(),
                ];
                $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
                $data['pesan'] = $this->beranda_model->hitungPesan();
                $data['hitung'] = $this->beranda_model->hitung();
                $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
                $data['karyawan'] = $this->db->get_where('karyawan', [
                    'nama_karyawan' => $this->session->userdata('nama_karyawan')
                ])->row_array();
                $this->load->view('admin/layout/head', $data);
                $this->load->view('admin/layout/sidebar');
                $this->load->view('admin/layout/nav', $data);
                $this->load->view('admin/produk/tambah', $data);
                $this->load->view('admin/layout/footer');   
            } else {
                $upload_gambar = array('upload_data' => $this->upload->data());

                //create thumbnail
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/upload/produk/' . $upload_gambar['upload_data']['file_name'];
                //lokasi folder thumbnail
                $config['new_image'] = './assets/upload/produk/thumbs/';
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width']         = 250; //pixel
                $config['height']       = 250;
                $config['thumb_marker'] = '';

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();
                //end thumbnail
                //slug produk
                $slug_produk = url_title($this->input->post('nama_produk') . '_' . $this->input->post('kode_produk'), 'dash', TRUE);
                $data = [
                    'id_karyawan' =>  $this->session->userdata('id_karyawan'),
                    'id_kategori' => $this->input->post('id_kategori'),
                    'kode_produk' => stripslashes(htmlspecialchars(strip_tags($this->input->post('kode_produk')))),
                    'nama_produk' => stripslashes(htmlspecialchars(strip_tags($this->input->post('nama_produk')))),
                    'slug_produk' => $slug_produk,
                    'keterangan' => trim(stripslashes(htmlspecialchars(strip_tags($this->input->post('keterangan'))))),
                    'keywords' => stripslashes(htmlspecialchars(strip_tags($this->input->post('keywords')))),
                    'harga' => stripslashes(htmlspecialchars(strip_tags($this->input->post('harga')))),
                    'stok' => stripslashes(htmlspecialchars(strip_tags($this->input->post('stok')))),
                    'gambar' => $upload_gambar['upload_data']['file_name'],
                    'berat' => stripslashes(htmlspecialchars(strip_tags($this->input->post('berat')))),
                    'ukuran' => stripslashes(htmlspecialchars(strip_tags($this->input->post('ukuran')))),
                    'status_produk' => stripslashes(htmlspecialchars(strip_tags($this->input->post('status_produk')))),
                    'tanggal_post' => date('Y-m-d H:i:s')
                ];

                $this->Produk_model->tambah($data);
                $this->session->set_flashdata('notifProduk', '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                </button>
                    <strong>Sukses!</strong> Data Produk Ditambah.
                    </div');


                redirect('admin/produk', 'refresh');
            }
        }
        $data = [
            'title' => 'Tambah Produk',
            'kategori' => $kategori,
        ];
        $data['karyawan'] = $this->db->get_where('karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
        $data['pesan'] = $this->beranda_model->hitungPesan();
        $data['hitung'] = $this->beranda_model->hitung();
        $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav', $data);
        $this->load->view('admin/produk/tambah', $data);
        $this->load->view('admin/layout/footer');   
    }
    public function edit($id_produk)
    {
        if ($_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifProduk', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/produk');
        }
        $produk = $this->Produk_model->detail($id_produk);
        $kategori = $this->Kategori_model->listing();
          //validasi input
          $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required');
          $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'trim|required');
  
          if ($this->form_validation->run()) {
              //checking jika gambar diganti
              if (!empty($_FILES['gambar']['name'])) {
  
  
                  $config['upload_path'] = './assets/upload/produk/';
                  $config['allowed_types'] = 'gif|jpg|png|jpeg';
                  $config['max_size']  = '2400';
                  $config['max_width']  = '2024';
                  $config['max_height']  = '2024';
  
                  $this->load->library('upload', $config);
  
                  if (!$this->upload->do_upload('gambar')) {
                      $data = [
                          'title' => 'Edit Produk: ' . $produk->nama_produk,
                          'kategori' => $kategori,
                          'produk' => $produk,
                          'eror' => $this->upload->display_errors()  
                      ];
                      $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
                      $data['pesan'] = $this->beranda_model->hitungPesan();
                      $data['hitung'] = $this->beranda_model->hitung();
                      $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
                      $data['karyawan'] = $this->db->get_where('karyawan', [
                        'nama_karyawan' => $this->session->userdata('nama_karyawan')
                    ])->row_array();
                        $this->load->view('admin/layout/head', $data);
                        $this->load->view('admin/layout/sidebar');
                        $this->load->view('admin/layout/nav', $data);
                        $this->load->view('admin/produk/edit', $data);
                        $this->load->view('admin/layout/footer');   
                  } else {
  
                      $this->db->where('id_produk', $id_produk);
                      $query = $this->db->get('produk');
                      $row = $query->row();
                      // var_dump($row);die;
                      unlink('./assets/upload/produk/' . $row->gambar);
                      unlink('./assets/upload/produk/thumbs/' . $row->gambar);
                      $upload_gambar = array('upload_data' => $this->upload->data());
  
                      //create thumbnail
                      $config['image_library'] = 'gd2';
                      $config['source_image'] = './assets/upload/produk/' . $upload_gambar['upload_data']['file_name'];
                      //lokasi folder thumbnail
                      $config['new_image'] = './assets/upload/produk/thumbs/';
                      $config['create_thumb'] = TRUE;
                      $config['maintain_ratio'] = TRUE;
                      $config['width']         = 250; //pixel
                      $config['height']       = 250;
                      $config['thumb_marker'] = '';
  
                      $this->load->library('image_lib', $config);
  
                      $this->image_lib->resize();
                      //end thumbnail
                      //slug produk
                      $slug_produk = url_title($this->input->post('nama_produk') . '_' . $this->input->post('kode_produk'), 'dash', TRUE);
                      $data = [
                          'id_produk' => $id_produk,
                          'id_karyawan' => $this->session->userdata('id_karyawan'),
                          'id_kategori' => stripslashes(htmlspecialchars(strip_tags($this->input->post('id_kategori')))),
                          'kode_produk' => stripslashes(htmlspecialchars(strip_tags($this->input->post('kode_produk')))),
                          'nama_produk' => stripslashes(htmlspecialchars(strip_tags($this->input->post('nama_produk')))),
                          'slug_produk' => $slug_produk,
                          'keterangan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('keterangan')))),
                          'keywords' => stripslashes(htmlspecialchars(strip_tags($this->input->post('keywords')))),
                          'harga' => stripslashes(htmlspecialchars(strip_tags($this->input->post('harga')))),
                          'stok' => stripslashes(htmlspecialchars(strip_tags($this->input->post('stok')))),
                          'gambar' => $upload_gambar['upload_data']['file_name'],
                          'berat' => stripslashes(htmlspecialchars(strip_tags($this->input->post('berat')))),
                          'ukuran' => stripslashes(htmlspecialchars(strip_tags($this->input->post('ukuran')))),
                          'status_produk' => stripslashes(htmlspecialchars(strip_tags($this->input->post('status_produk'))))
                      ];
                      $where = ['id_produk' => $id_produk];
                      $this->Produk_model->update($where, $data, 'produk');
                      $this->session->set_flashdata('notifProduk', '<div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                      </button>
                          <strong>Sukses!</strong> Data Produk Diedit.
                          </div');
  
                      redirect('admin/produk', 'refresh');
                  }
              } else {
                  //edit produk tanpa ganti gambar
                  $slug_produk = url_title($this->input->post('nama_produk') . '_' . $this->input->post('kode_produk'), 'dash', TRUE);
                  $data = [
                      'id_produk' => $id_produk,
                      'id_karyawan' => $this->session->userdata('id_karyawan'),
                      'id_kategori' => $this->input->post('id_kategori'),
                      'kode_produk' => stripslashes(htmlspecialchars(strip_tags($this->input->post('kode_produk')))),
                      'nama_produk' => stripslashes(htmlspecialchars(strip_tags($this->input->post('nama_produk')))),
                      'slug_produk' => $slug_produk,
                      'keterangan' => stripslashes(htmlspecialchars(strip_tags($this->input->post('keterangan')))),
                      'keywords' => stripslashes(htmlspecialchars(strip_tags($this->input->post('keywords')))),
                      'harga' => stripslashes(htmlspecialchars(strip_tags($this->input->post('harga')))),
                      'stok' => stripslashes(htmlspecialchars(strip_tags($this->input->post('stok')))),
                      'berat' => stripslashes(htmlspecialchars(strip_tags($this->input->post('berat')))),
                      'ukuran' => stripslashes(htmlspecialchars(strip_tags($this->input->post('ukuran')))),
                      'status_produk' => stripslashes(htmlspecialchars(strip_tags($this->input->post('status_produk'))))
                  ];
                  $where = ['id_produk' => $id_produk];
                  $this->Produk_model->update($where, $data, 'produk');
                  $this->session->set_flashdata('notifProduk', '<div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                      </button>
                          <strong>Sukses!</strong> Data Produk Diedit.
                          </div');
  
  
                  redirect('admin/produk', 'refresh');
              }
          }
          $data = [
            'title' => 'Edit Produk: ' . $produk->nama_produk,
            'kategori' => $kategori,
            'produk' => $produk, 
        ];
        $data['karyawan'] = $this->db->get_where('karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
        $data['pesan'] = $this->beranda_model->hitungPesan();
        $data['hitung'] = $this->beranda_model->hitung();
        $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
          $this->load->view('admin/layout/head', $data);
          $this->load->view('admin/layout/sidebar');
          $this->load->view('admin/layout/nav', $data);
          $this->load->view('admin/produk/edit', $data);
          $this->load->view('admin/layout/footer');  
    }
    public function hapus($id_produk)
    {
        if ($_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifProduk', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/produk');
        }
        $produk = $this->Produk_model->detail($id_produk);
        unlink('./assets/upload/produk/' . $produk->gambar);
        unlink('./assets/upload/produk/thumbs/' . $produk->gambar);
        $this->Produk_model->hapus($id_produk);
        $this->session->set_flashdata('notifProduk', '<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
        </button>
            <strong>Sukses!</strong> Data Produk Dihapus.
            </div');
        redirect('admin/produk', 'refresh');
    }
    public function hapus_gambar($id_produk, $id_gambar)
    {
        if ($_SESSION['id_jabatan'] == 3 or $_SESSION['id_jabatan'] == 4) {
            $this->session->set_flashdata('notifProduk', '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;&nbsp;&nbsp;</span>
            </button>
            <strong>Gagal!</strong> Akses tidak diberikan.
            </div>');
        redirect('admin/produk');
        }
        $gambar = $this->Produk_model->detail_gambar($id_gambar);
        unlink('./assets/upload/produk/' . $gambar->gambar);
        unlink('./assets/upload/produk/thumbs/' . $gambar->gambar);
        $this->Produk_model->hapus_gambar($id_gambar);
        $this->session->set_flashdata('notifProduk', '<div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
        </button>
            <strong>Sukses!</strong> Data Gambar Dihapus.
            </div');
        redirect('admin/produk/gambar/' . $id_produk, 'refresh');
    }
}

/* End of file Produk.php */
