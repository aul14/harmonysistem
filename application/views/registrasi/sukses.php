
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
     <p class="alert alert-warning">Registrasi Berhasil.
        <a href="<?= base_url('masuk') ?>" class="btn btn-info">Login disini</a>
        Anda bisa melakukan&nbsp;<a href="<?= base_url('belanja/checkout') ?>" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Proses Pesanan</a>.

    </p>
 
   
</div>
</div>




<!-- 
<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
    <span class="s-text18 w-size19 w-full-sm">
        Shipping:
    </span>

    <div class="w-size20 w-full-sm">
        <p class="s-text8 p-b-23">
            There are no shipping methods available. Please double check your address, or contact us if you need any help.
        </p>

        <span class="s-text19">
            Calculate Shipping
        </span>

        <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
            <select class="selection-2" name="country">
                <option>Select a country...</option>
                <option>US</option>
                <option>UK</option>
                <option>Japan</option>
            </select>
        </div>

        <div class="size13 bo4 m-b-12">
        <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
        </div>

        <div class="size13 bo4 m-b-22">
            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">
        </div>

        <div class="size14 trans-0-4 m-b-10">
            <!-- Button -->
            <!-- <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                Update Totals
            </button>
        </div>
    </div>
</div> --> 

<!--  -->



</div>
</div>
</section>