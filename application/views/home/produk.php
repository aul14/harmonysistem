<!-- Shipping -->
<section class="shipping bgwhite p-t-62 p-b-46" >
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Free Delivery Worldwide
				</h4>

				<a href="#" class="s-text11 t-center">
					Click here for more info
				</a>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<h4 class="m-text12 t-center">
					30 Days Return
				</h4>

				<span class="s-text11 t-center">
					Simply return it within 30 days for an exchange.
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					Store Opening
				</h4>

				<span class="s-text11 t-center">
					Shop open from Monday to Sunday
				</span>
			</div>
		</div>
	</section>
    <!-- New Product -->
    <section class="newproduct p-t-45 p-b-105">
    <div class="container">
    <div class="sec-title p-b-60">
    <h3 class="m-text5 t-center">
    Produk Terbaru
    </h3>
    </div>

    <!-- Slide2 -->
    <div class="wrap-slick2">
    <div class="slick2">
    <?php foreach($produk as $produk) { ?>
    <div class="item-slick2 p-l-15 p-r-15">

    <?= 
    form_open(base_url('belanja/add'));
    echo form_hidden('id', $produk->id_produk);
    echo form_hidden('qty', 1);
    echo form_hidden('price', $produk->harga);
    echo form_hidden('name', $produk->nama_produk);
    echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
     
    ?>
    <!-- Block2 -->
     <div class="block2" >
        <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
          <img src="<?= base_url('assets/upload/produk/'. $produk->gambar) ?>" width="480" height="220" alt="<?= $produk->nama_produk ?>">

             <div class="block2-overlay trans-0-4">
                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                    <i class="far fa-heart" aria-hidden="true"></i>
                    <!-- <i class="fa fa-heart dis-none" aria-hidden="true"></i> -->
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
</div>

</div>
</section>