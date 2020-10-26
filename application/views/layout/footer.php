<?php 
$site = $this->Konfigurasi_model->listing();
$nav_produk_footer = $this->Konfigurasi_model->nav_produk();
?>
<!-- Footer -->
<footer class="p-t-45 p-b-43 p-l-45 p-r-45" style="background-color: #ebebeb;">
<div class="flex-w p-b-90">
	<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
		<h4 class="s-text12 p-b-30">
			Kontak Kami
		</h4>

		<div>
			<p class="s-text7 w-size27">
			<i class="fas fa-map-marker-alt"></i>&nbsp; <?= nl2br($site->alamat) ?>
				<br><i class="fa fa-envelope"></i>&nbsp; <?= $site->email ?>
				<br><i class="fa fa-phone"></i>&nbsp; <?= $site->telepon ?>
			</p>

			<div class="flex-m p-t-30">
				<a href="<?= $site->facebook ?>" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
				<a href="<?= $site->instagram ?>" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
				
			</div>
		</div>
	</div>

	<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
		<h4 class="s-text12 p-b-30">
			Kategori
		</h4>

		<ul>
			<?php foreach($nav_produk_footer as $nav_produk_footer) { ?>
			<li class="p-b-9">
				<a href="<?= base_url('produk/kategori/'. $nav_produk_footer->slug_kategori) ?>" class="s-text7">
					<?= $nav_produk_footer->nama_kategori ?>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>

	<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
		<h4 class="s-text12 p-b-30">
			Links
		</h4>

		<ul>
		
			<li class="p-b-9">
				<a href="<?= base_url('about') ?>" class="s-text7">
					Tentang Kami
				</a>
			</li>

			<li class="p-b-9">
				<a href="<?= base_url('kontak') ?>" class="s-text7">
					Hubungi Kami
				</a>
			</li>

			<li class="p-b-9">
				<a href="<?= base_url('kontak') ?>" class="s-text7">
					Returns
				</a>
			</li>
		</ul>
	</div>

	<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
		<h4 class="s-text12 p-b-30">
			Help
		</h4>

		<ul>
			<li class="p-b-9">
				<a href="#" class="s-text7">
					Track Order
				</a>
			</li>

			<li class="p-b-9">
				<a href="#" class="s-text7">
					Returns
				</a>
			</li>

			<li class="p-b-9">
				<a href="#" class="s-text7">
					Shipping
				</a>
			</li>

			<li class="p-b-9">
				<a href="#" class="s-text7">
					FAQs
				</a>
			</li>
		</ul>
	</div>

	<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					Newsletter
				</h4>

				<form>
					<div class="effect1 w-size9">
						<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
						<span class="effect1-line"></span>
					</div>

					<div class="w-size2 p-t-20">
						<!-- Button -->
						<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
							Subscribe
						</button>
					</div>

				</form>
			</div>
		</div>
<div class="t-center p-l-15 p-r-15">
	<img class="img img-responsive" width="450" src="<?= base_url('assets/upload/konfigurasi/payment.png') ?>" alt="">
	<div class="t-center s-text8 p-t-20">
		<strong>Copyright © <?= date('Y'); ?> Harmony Sistem. by <a href="<?= base_url() ?>" ><strong> <i>Harmony Sistem</strong></a></i></strong>
	</div>
</div>
</footer>



<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
<span class="symbol-btn-back-to-top">
	<i class="fa fa-angle-double-up" aria-hidden="true"></i>
</span>
</div>

<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>



<!--===============================================================================================-->
<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

<!--===============================================================================================-->
<script type="text/javascript" src="<?= base_url() ?>assets/template/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?= base_url() ?>assets/template/vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/template/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?= base_url() ?>assets/template/vendor/select2/select2.min.js"></script>
<script type="text/javascript">
$(".selection-1").select2({
	minimumResultsForSearch: 20,
	dropdownParent: $('#dropDownSelect1')
});
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?= base_url() ?>assets/template/vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/template/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?= base_url() ?>assets/template/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?= base_url() ?>assets/template/vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="<?= base_url() ?>assets/template/vendor/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/plugins/ui/moment/moment.min.js"></script>
<script src="<?= base_url() ?>assets/calender/js/pignose.calendar.js"></script>

<script type="text/javascript">
$('.block2-btn-addcart').each(function(){
	var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
	$(this).on('click', function(){
		swal(nameProduct, "is added to cart !", "success");
	});
});

$('.block2-btn-addwishlist').each(function(){
	var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
	$(this).on('click', function(){
		swal(nameProduct, "is added to wishlist !", "success");
	});
});
</script>

<!--===============================================================================================-->
<script src="<?= base_url() ?>assets/template/js/main.js"></script>

<script type="text/javascript">
   $(function() {
     function onClickHandler(date, obj) {


       var $calendar = obj.calendar;
       var $box = $calendar.parent().siblings('.box').show();
       var text = 'Anda memilih tanggal ';

       if (date[0] !== null) {
         text += date[0].format('DD MMMM YYYY');
       }

       if (date[0] !== null && date[1] !== null) {
         text += ' ~ ';
       } else if (date[0] === null && date[1] == null) {
         text += 'tidak ada';
       }

       if (date[1] !== null) {
         text += date[1].format('DD MMMM YYYY');
       }

       $box.text(text);
     }

     $('.calendar').pignoseCalendar({
       lang: 'ind',
       select: onClickHandler,
       theme: 'light' // light, dark, blue
     });
   });
 </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhjcrba7OFou4Do510Y4pPffdXBz6oNf4"></script>
<script src="<?= base_url() ?>assets/template/js/map.js"></script>
 
</body>
</html>