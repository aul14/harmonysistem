
<!-- Cart -->
<section class=" bgwhite p-t-70 p-b-100">
<div class="container">
<!-- Cart item -->
<div class=" pos-relative">
<div class=" bgwhite">
    <h2><?= $title ?></h2>
    <hr>
    <div class="clearfix"></div>
    <?php if ($this->session->flashdata('sukses')
    ) {
        echo '<div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
        </button>';
        echo $this->session->flashdata('sukses');
        echo '</div>';
    } ?>
    <p class="alert alert-success">
        Terima Kasih telah berbelanja, Barang akan kami proses
    </p>
   
</div>
</div>






</div>
</div>
</section>