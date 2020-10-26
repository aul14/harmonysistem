<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Kategori_model');    
        
    }
    
    public function index()
    {
        $site = $this->Konfigurasi_model->listing();
        $listing_kategori = $this->Produk_model->listing_kategori();
        $total = $this->Produk_model->total_produk();
        //paginasi start
        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'produk/index/';
        $config['total_rows'] = $total->total;
        $config['use_page_numbers'] = true;
        $config['per_page'] = 6;
        $config['uri_segment'] = 3;
        $config['num_links'] = 5;

         $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $config['first_url'] = base_url().'/produk/';
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) * $config['per_page']:0;
        $produk = $this->Produk_model->produk($config['per_page'],$page); 
        //paginasi end
        $data = array(
            'title' => 'Produk ' . $site->namaweb,
            'site' => $site,
            'listing_kategori' => $listing_kategori,
            'produk' => $produk,
            'pagin' => $this->pagination->create_links(),
            'isi' => 'produk/list'
        );
        $this->load->view('layout/wrapper', $data);  
    }
    public function kategori($slug_kategori)
    {
        $kategori = $this->Kategori_model->read($slug_kategori);
        $id_kategori = $kategori->id_kategori;
        $site = $this->Konfigurasi_model->listing();
        $listing_kategori = $this->Produk_model->listing_kategori();
        $total = $this->Produk_model->total_kategori($id_kategori);
        //paginasi start
        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'produk/kategori/'.$slug_kategori.'/index/';
        $config['total_rows'] = $total->total;
        $config['use_page_numbers'] = true;
        $config['per_page'] = 6;
        $config['uri_segment'] = 5;
        $config['num_links'] = 5;

         $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $config['first_url'] = base_url().'/produk/kategori/'.$slug_kategori;
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(5)) ? ($this->uri->segment(5)-1) * $config['per_page']:0;
        $produk = $this->Produk_model->kategori($id_kategori,$config['per_page'],$page); 
        //paginasi end
        $data = array(
            'title' => $kategori->nama_kategori,
            'site' => $site,
            'listing_kategori' => $listing_kategori,
            'produk' => $produk,
            'pagin' => $this->pagination->create_links(),
            'isi' => 'produk/list'
        );
        $this->load->view('layout/wrapper', $data);  
    }

    public function detail($slug_produk)
    {
        $site = $this->Konfigurasi_model->listing();
        $produk= $this->Produk_model->read($slug_produk);
        $id_produk = $produk->id_produk;
        $gambar = $this->Produk_model->gambar($id_produk);
        $produk_related = $this->Produk_model->produk_terkait();

        $data = array(
            'title' => $produk->nama_produk,
            'site' => $site,
            'produk' => $produk,
            'gambar' => $gambar,
            'produk_related' => $produk_related,
            'isi' => 'produk/detail'
        );
        $this->load->view('layout/wrapper', $data);  
    }

}

/* End of file Produk.php */
