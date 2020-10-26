<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    
    public function index()
    {
        $data = array(
            'title' => 'Tentang Kami',
            'isi' => 'about/list'
        );
        $this->load->view('layout/wrapper', $data);
    }

}

/* End of file About.php */
