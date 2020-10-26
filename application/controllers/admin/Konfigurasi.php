<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Konfigurasi_model');
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
        $konfigurasi = $this->Konfigurasi_model->listing();

        //validasi input
        $this->form_validation->set_rules('namaweb', 'Nama Website', 'required');



        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Konfigurasi Website',
                'konfigurasi' => $konfigurasi,
            ];
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
            $this->load->view('admin/konfigurasi/list', $data);
            $this->load->view('admin/layout/footer');
        } else {
            $data = [
                'id_konfigurasi' => $konfigurasi->id_konfigurasi,
                'id_karyawan' => $this->session->userdata('id_karyawan'),
                'namaweb' => stripslashes(htmlspecialchars(strip_tags($this->input->post('namaweb')))),
                'tagline' => stripslashes(htmlspecialchars(strip_tags($this->input->post('tagline')))),
                'email' => stripslashes(htmlspecialchars(strip_tags($this->input->post('email')))),
                'website' => stripslashes(htmlspecialchars(strip_tags($this->input->post('website')))),
                'keywords' => stripslashes(htmlspecialchars(strip_tags($this->input->post('keywords')))),
                'metatext' => stripslashes(htmlspecialchars(strip_tags($this->input->post('metatext')))),
                'telepon' => stripslashes(htmlspecialchars(strip_tags($this->input->post('telepon')))),
                'whatsapp' => stripslashes(htmlspecialchars(strip_tags($this->input->post('whatsapp')))),
                'alamat' => stripslashes(htmlspecialchars(strip_tags($this->input->post('alamat')))),
                'facebook' => stripslashes(htmlspecialchars(strip_tags($this->input->post('facebook')))),
                'instagram' => stripslashes(htmlspecialchars(strip_tags($this->input->post('instagram')))),
                'deskripsi' => stripslashes(htmlspecialchars(strip_tags($this->input->post('deskripsi'))))
               

            ];

            $where = ['id_konfigurasi' => $konfigurasi->id_konfigurasi];
            $this->Konfigurasi_model->update($where, $data, 'konfigurasi');
            $this->session->set_flashdata('notifKonfigurasi', '<div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                      </button>
                          <strong>Sukses!</strong> Data Konfigurasi Website Diedit.
                          </div');


            redirect('admin/konfigurasi', 'refresh');
        }
    }
    public function logo()
    {
        $konfigurasi = $this->Konfigurasi_model->listing();
        //validasi input
        $this->form_validation->set_rules('namaweb', 'Nama Website', 'trim|required');

        if ($this->form_validation->run()) {
            //checking jika gambar diganti
            if (!empty($_FILES['logo']['name'])) {


                $config['upload_path'] = './assets/upload/konfigurasi/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']  = '2400';
                $config['max_width']  = '2024';
                $config['max_height']  = '2024';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('logo')) {
                    $data = [
                        'title' => 'Konfigurasi Logo Website ',
                        'konfigurasi' => $konfigurasi,
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
                    $this->load->view('admin/konfigurasi/logo', $data);
                    $this->load->view('admin/layout/footer');
                } else {

                    $this->db->where('id_konfigurasi', $konfigurasi->id_konfigurasi);
                    $query = $this->db->get('konfigurasi');
                    $row = $query->row();
                    // var_dump($row);die;
                    unlink('./assets/upload/konfigurasi/' . $row->logo);
                    unlink('./assets/upload/konfigurasi/thumbs/' . $row->logo);
                    $upload_gambar = array('upload_data' => $this->upload->data());

                    //create thumbnail
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/upload/konfigurasi/' . $upload_gambar['upload_data']['file_name'];
                    //lokasi folder thumbnail
                    $config['new_image'] = './assets/upload/konfigurasi/thumbs/';
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 250; //pixel
                    $config['height']       = 250;
                    $config['thumb_marker'] = '';

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();
                    //end thumbnail
                    $data = [
                        'id_konfigurasi' => $konfigurasi->id_konfigurasi,
                        'namaweb' => stripslashes(htmlspecialchars(strip_tags($this->input->post('namaweb')))),
                        'logo' => $upload_gambar['upload_data']['file_name']

                    ];

                    $where = ['id_konfigurasi' => $konfigurasi->id_konfigurasi];
                    $this->Konfigurasi_model->update($where, $data, 'konfigurasi');
                    $this->session->set_flashdata('notifKonfigurasi', '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                    </button>
                        <strong>Sukses!</strong> Data Konfigurasi Logo Website Diedit.
                        </div');


                    redirect('admin/konfigurasi/logo', 'refresh');
                }
            } else {
                $data = [
                    'id_konfigurasi' => $konfigurasi->id_konfigurasi,
                    'namaweb' => stripslashes(htmlspecialchars(strip_tags($this->input->post('namaweb')))),
                    //'logo' => $upload_gambar['upload_data']['file_name']

                ];
                $where = ['id_konfigurasi' => $konfigurasi->id_konfigurasi];
                $this->Konfigurasi_model->update($where, $data, 'konfigurasi');
                $this->session->set_flashdata('notifKonfigurasi', '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                </button>
                    <strong>Sukses!</strong> Data Konfigurasi Logo Website Diedit.
                    </div');

                redirect('admin/konfigurasi/logo', 'refresh');
            }
        }
        $data = [
            'title' => 'Konfigurasi Logo Website ',
            'konfigurasi' => $konfigurasi        
        ];
        $data['karyawan'] = $this->db->get_where('karyawan', [
            'nama_karyawan' => $this->session->userdata('nama_karyawan')
        ])->row_array();
        $data['pesan'] = $this->beranda_model->hitungPesan();
        $data['tbl_pesan'] = $this->beranda_model->tampilPesan();
        $data['hitung'] = $this->beranda_model->hitung();
        $data['transaksi3'] = $this->beranda_model->tampilTransaksi();
        $this->load->view('admin/layout/head', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/layout/nav', $data);
        $this->load->view('admin/konfigurasi/logo', $data);
        $this->load->view('admin/layout/footer');
    }
    public function icon()
    {
        $konfigurasi = $this->Konfigurasi_model->listing();
        //validasi input
        $this->form_validation->set_rules('namaweb', 'Nama Website', 'trim|required');

        if ($this->form_validation->run()) {
            //checking jika gambar diganti
            if (!empty($_FILES['icon']['name'])) {


                $config['upload_path'] = './assets/upload/konfigurasi/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG';
                $config['max_size']  = '2400';
                $config['max_width']  = '2024';
                $config['max_height']  = '2024';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('icon')) {
                    $data = [
                        'title' => 'Konfigurasi Icon Website ',
                        'konfigurasi' => $konfigurasi,
                        'eror' => $this->upload->display_errors(),
                    ];
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
                    $this->load->view('admin/konfigurasi/icon', $data);
                    $this->load->view('admin/layout/footer');                
                } else {

                    $this->db->where('id_konfigurasi', $konfigurasi->id_konfigurasi);
                    $query = $this->db->get('konfigurasi');
                    $row = $query->row();
                    // var_dump($row);die;
                    unlink('./assets/upload/konfigurasi/' . $row->icon);
                    unlink('./assets/upload/konfigurasi/thumbs/' . $row->icon);
                    $upload_gambar = array('upload_data' => $this->upload->data());

                    //create thumbnail
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/upload/konfigurasi/' . $upload_gambar['upload_data']['file_name'];
                    //lokasi folder thumbnail
                    $config['new_image'] = './assets/upload/konfigurasi/thumbs/';
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width']         = 250; //pixel
                    $config['height']       = 250;
                    $config['thumb_marker'] = '';

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();
                    //end thumbnail
                    $data = [
                        'id_konfigurasi' => $konfigurasi->id_konfigurasi,
                        'namaweb' => stripslashes(htmlspecialchars(strip_tags($this->input->post('namaweb')))),
                        'icon' => $upload_gambar['upload_data']['file_name']

                    ];

                    $where = ['id_konfigurasi' => $konfigurasi->id_konfigurasi];
                    $this->Konfigurasi_model->update($where, $data, 'konfigurasi');
                    $this->session->set_flashdata('notifKonfigurasi', '<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                    </button>
                        <strong>Sukses!</strong> Data Konfigurasi Icon Website Diedit.
                        </div');


                    redirect('admin/konfigurasi/icon', 'refresh');
                }
            } else {
                $data = [
                    'id_konfigurasi' => $konfigurasi->id_konfigurasi,
                    'namaweb' => stripslashes(htmlspecialchars(strip_tags($this->input->post('namaweb')))),
                    //'logo' => $upload_gambar['upload_data']['file_name']

                ];
                $where = ['id_konfigurasi' => $konfigurasi->id_konfigurasi];
                $this->Konfigurasi_model->update($where, $data, 'konfigurasi');
                $this->session->set_flashdata('notifKonfigurasi', '<div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                </button>
                    <strong>Sukses!</strong> Data Konfigurasi Icon Website Diedit.
                    </div');


                redirect('admin/konfigurasi/icon', 'refresh');
            }
        }
        $data = [
            'title' => 'Konfigurasi Icon Website ',
            'konfigurasi' => $konfigurasi,
        ];
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
        $this->load->view('admin/konfigurasi/icon', $data);
        $this->load->view('admin/layout/footer');      
    
    }

}

/* End of file Konfigurasi.php */
