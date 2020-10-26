<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class pdf extends FPDF{
    function letak($gambar){
    //memasukkan gambar untuk header
    $this->Image($gambar,10,10,20,25);
    //menggeser posisi sekarang
    }

}

/* End of file Pdf.php */
