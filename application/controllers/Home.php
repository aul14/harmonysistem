<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Kategori_model');
        
    }
    
    public function index()
    {
        $site = $this->Konfigurasi_model->listing();
        $kategori = $this->Konfigurasi_model->nav_produk();
        $produk = $this->Produk_model->home();
        $data = array(
            'title' => $site->namaweb. ' - ' .$site->tagline,
            'keywords' => $site->keywords,
            'deskripsi' => $site->deskripsi,
            'site' => $site,
            'kategori' => $kategori,
            'produk' => $produk,
            'isi'   => 'home/list'
        );
        $this->load->view('layout/wrapper', $data);
    }
}

/* End of file Home.php */
