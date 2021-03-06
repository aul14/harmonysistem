<!-- Title Page -->
<section class="bg-title-page" style="background-image: url(<?= base_url() ?>assets/upload/konfigurasi/coba.png);">

</section>

<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container">
<div class="row">
    <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
        <div class="leftbar p-r-20 p-r-0-sm">
            <!--  -->
            <h4 class="m-text14 p-b-7">
                Kategori Produk
            </h4>

            <ul class="p-b-54">
                <?php foreach($listing_kategori as $listing) { ?>
                <li class="p-t-4">
                    <a href="<?= base_url('produk/kategori/'.$listing->slug_kategori) ?>" class="s-text13 active1">
                    <?= $listing->nama_kategori ?>
                    </a>
                </li>
                
                <?php } ?>
               
            </ul>

            <!--  -->
           
        </div>
    </div>

    <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
       

        <!-- Product -->
        <div class="row">
            <?php foreach($produk as $produk) { ?>
            <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
            <?= 
            form_open(base_url('belanja/add'));
            echo form_hidden('id', $produk->id_produk);
            echo form_hidden('qty', 1);
            echo form_hidden('price', $produk->harga);
            echo form_hidden('name', $produk->nama_produk);
            echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                
            ?>
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-img wrap-pic-w of-hidden pos-relative block2">
                        <img src="<?= base_url('assets/upload/produk/thumbs/'. $produk->gambar) ?>" width="480" height="220" alt="<?= $produk->nama_produk ?>">

                        <div class="block2-overlay trans-0-4">
                            <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                <i class="far fa-heart" aria-hidden="true"></i>
                                <!-- <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i> -->
                            </a>

                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                <!-- Button -->
                                <button type="submit" value="submit" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="block2-txt p-t-20">
                        <a href="<?= base_url('produk/detail/'.$produk->slug_produk) ?>" class="block2-name dis-block s-text3 p-b-5">
                        <?= $produk->nama_produk ?>
                        </a>

                        <span class="block2-price m-text6 p-r-5">
                        IDR <?= number_format($produk->harga, '0',',','.') ?>
                        </span>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>

            <?php } ?>
        </div>

        <!-- Pagination -->
        <div class="pagination flex-m flex-w p-t-26 center">
            <?= $pagin ?>
        </div>
    </div>
</div>
</div>
</section>