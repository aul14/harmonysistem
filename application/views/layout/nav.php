<?php 

$nav_produk = $this->Konfigurasi_model->nav_produk();
$nav_produk_mobile = $this->Konfigurasi_model->nav_produk();
?>

<div class="wrap_header">
	<!-- Logo -->
	<a href="<?= base_url() ?>" class="logo">
		<img src="<?= base_url('assets/upload/konfigurasi/'.$site->logo) ?>" alt="<?= $site->namaweb ?> | <?= $site->tagline ?>">
	</a>

	<!-- Menu -->
	<div class="wrap_menu">
		<nav class="menu">
			<ul class="main_menu">
				<!-- home -->
				<?php if($this->session->userdata('email')) { ?>
				<li>
					<a href="<?= base_url('beranda') ?>">Beranda</a>
				</li>
				<?php } else { ?>
				<li>
					<a href="<?= base_url() ?>">Beranda</a>
				</li>
				<?php } ?>
				<!-- Menu Produk -->
				<li>
					<a href="<?= base_url('produk') ?>">Produk &amp; Belanja</a>
					<ul class="sub_menu">
						<?php foreach ($nav_produk as $nav_produk) { ?>
						<li><a href="<?= base_url('produk/kategori/'. $nav_produk->slug_kategori) ?>"><?= $nav_produk->nama_kategori ?></a></li>
						<?php } ?>
					</ul>
				</li>
							
				<!-- <li>
					<a href="about.html">Testimonial</a>
				</li> -->

				<li>
					<a href="<?= base_url('about') ?>">Tentang Kami</a>
				</li>

				<li>
					<a href="<?= base_url('kontak') ?>">Hubungi Kami</a>
				</li>
			</ul>
		</nav>
	</div>

	<!-- Header Icon -->
	<div class="header-icons">
		<div class="header-wrapicon1 ">
			<img src="<?= base_url() ?>assets/template/images/icons/icon-header-01.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
			&nbsp;<?= $this->session->userdata('nama_pelanggan') ?>
			<div class="header-cart header-dropdown">
				<ul class="header-cart-wrapitem">
				<?php if ($this->session->userdata('email')) { ?>
				<div class="header-cart-buttons">
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('masuk/logout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text5 trans-0-4 text-white">
							Keluar
						</a>
					</div>
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('beranda/profil') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text5 trans-0-4 text-white">
							Profil
						</a>
					</div>

				</div>
				<?php } else { ?>
					<div class="header-cart-buttons">
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('masuk') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text5 trans-0-4 text-white">
							Masuk
						</a>
					</div>

					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('registrasi') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text5 trans-0-4 text-white" >
							Daftar
						</a>
					</div>
				</div>

				<?php } ?>
			
				</ul>
			</div>
		</div>

		<span class="linedivide1"></span>

		<div class="header-wrapicon2">
			<?php 
				$keranjang = $this->cart->contents();
			?>
			<img src="<?= base_url() ?>assets/template/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
			<span class="header-icons-noti"><?= $this->cart->total_items() ?></span>

			<!-- Header cart noti -->
			<div class="header-cart header-dropdown">
				<ul class="header-cart-wrapitem">
					<?php 
					if (empty($keranjang)) {
					?>
					<li class="header-cart-item-info">
						<p class="alert alert-info text-center">Keranjang Belanja Kosong, Yuk Kita Belanja</p>
					</li>
					<?php
      				$total_belanja ="Rp. 0";
					} else {
						$total_belanja ='Rp. ' .number_format($this->cart->total(),'0',',','.');
						//tampilkan data belanja
						foreach($keranjang as $keranjang) {
							$id_produk = $keranjang['id'];
							$produknya = $this->Produk_model->detail($id_produk);

					?>
					<li class="header-cart-item">
						<div class="header-cart-item-img">
							<img src="<?= base_url('assets/upload/produk/thumbs/'.$produknya->gambar) ?>" alt="<?= $keranjang['name'] ?>">
						</div>

						<div class="header-cart-item-txt">
							<a href="<?= base_url('produk/detail/'. $produknya->slug_produk) ?>" class="header-cart-item-name">
								<?= $keranjang['name'] ?>
							</a>

							<span class="header-cart-item-info">
								<?= $keranjang['qty'] ?> x Rp. <?= number_format($keranjang['price'],'0',',','.')  ?> = Rp. <?= number_format($keranjang['subtotal'],'0',',','.')  ?> 
							</span>
						</div>
					</li>
					<?php } } ?>
											
				</ul>

				<div class="header-cart-total">
					Total: <?= $total_belanja ?>
				</div>

				<div class="header-cart-buttons">
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('belanja') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text5 trans-0-4 text-white">
							Lihat Keranjang
						</a>
					</div>

					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('belanja/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text5 trans-0-4 text-white" >
							Proses Pesanan
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<!-- Header Mobile -->
<div class="wrap_header_mobile">
<!-- Logo moblie -->
<a href="<?= base_url() ?>" class="logo-mobile">
<img src="<?= base_url('assets/upload/konfigurasi/'.$site->logo) ?>" alt="<?= $site->namaweb ?> | <?= $site->tagline ?>">
</a>

<!-- Button show menu -->
<div class="btn-show-menu">
	<!-- Header Icon mobile -->
	<div class="header-icons-mobile">
	<div class="header-wrapicon1 ">
			<img src="<?= base_url() ?>assets/template/images/icons/icon-header-01.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
			&nbsp;<?= $this->session->userdata('nama_pelanggan') ?>
			<div class="header-cart header-dropdown">
				<ul class="header-cart-wrapitem">
				<?php if ($this->session->userdata('email')) { ?>
				<div class="header-cart-buttons">
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('masuk/logout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text5 trans-0-4 text-white">
							Keluar
						</a>
					</div>
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('beranda/profil') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text5 trans-0-4 text-white">
							Profil
						</a>
					</div>

				</div>
				<?php } else { ?>
					<div class="header-cart-buttons">
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('masuk') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text5 trans-0-4 text-white">
							Masuk
						</a>
					</div>

					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('registrasi') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text5 trans-0-4 text-white" >
							Daftar
						</a>
					</div>
				</div>

				<?php } ?>
			
				</ul>
			</div>
		</div>

		<span class="linedivide2"></span>

		<div class="header-wrapicon2">
			<?php 
				$keranjang_mobile = $this->cart->contents();
			?>
			<img src="<?= base_url() ?>assets/template/images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
			<span class="header-icons-noti"><?= $this->cart->total_items() ?></span>

			<!-- Header cart noti -->
			<div class="header-cart header-dropdown">
				<ul class="header-cart-wrapitem">


					<?php 
					if (empty($keranjang_mobile)) {
					?>
					<li class="header-cart-item">
						<p class="alert alert-info">Keranjang Belanja Kosong</p>
					</li>
					<?php

					} else {
						$total_belanja ='Rp. ' .number_format($this->cart->total(),'0',',','.');
						//tampilkan data belanja
						foreach($keranjang_mobile as $keranjang_mobile) {
							$id_produk_mobile = $keranjang_mobile['id'];
							$produk_mobile = $this->Produk_model->detail($id_produk_mobile);
					?>
					<li class="header-cart-item">
						<div class="header-cart-item-img">
							<img src="<?= base_url('assets/upload/produk/thumbs/'.$produk_mobile->gambar) ?>" alt="<?= $keranjang_mobile['name'] ?>">
						</div>

						<div class="header-cart-item-txt">
							<a href="#" class="header-cart-item-name">
							<?= $keranjang_mobile['name'] ?>
						</a>

							<span class="header-cart-item-info">
							<?= $keranjang_mobile['qty'] ?> x Rp. <?= number_format($keranjang_mobile['price'],'0',',','.')  ?> = Rp. <?= number_format($keranjang_mobile['subtotal'],'0',',','.')  ?> 

							</span>
						</div>
					</li>
						<?php } } ?>										
				</ul>

				<div class="header-cart-total">
					Total: <?= $total_belanja ?>
				</div>

				<div class="header-cart-buttons">
					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('belanja') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text6 trans-0-4 text-white">
							Lihat Keranjang
						</a>
					</div>

					<div class="header-cart-wrapbtn">
						<!-- Button -->
						<a href="<?= base_url('belanja/checkout') ?>" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text6 trans-0-4 text-white">
							Proses Pesanan
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
		<span class="hamburger-box">
			<span class="hamburger-inner"></span>
		</span>
	</div>
</div>
</div>

<!-- Menu Mobile -->
<div class="wrap-side-menu" >
<nav class="side-menu">
	<ul class="main-menu">
		<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
			<span class="topbar-child1">
				<?= $site->tagline ?>
			</span>
		</li>

		<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
			<div class="topbar-child2-mobile">
				<span class="topbar-email">
					<?= $site->email ?>
				</span>

				<div class="topbar-language rs1-select2">
					<select class="selection-1" name="time">
						<option><?= $site->telepon ?></option>
						<option><?= $site->email ?></option>
					</select>
				</div>
			</div>
		</li>

		<li class="item-topbar-mobile p-l-10">
			<div class="topbar-social-mobile">
				<a href="<?= $site->facebook ?>" class="topbar-social-item fa fa-facebook"></a>
				<a href="<?= $site->instagram ?>" class="topbar-social-item fa fa-instagram"></a>
			
			</div>
		</li>
		<?php if($this->session->userdata('email')) { ?>
		<li class="item-menu-mobile">
			<a href="<?= base_url('beranda') ?>">Beranda</a>
		</li>
		<?php } else { ?>
		<!-- menu mobile homepage -->
		<li class="item-menu-mobile">
			<a href="<?= base_url() ?>">Beranda</a>
		</li>
		<?php } ?>
		<!-- menu mobile produk  -->
		<li class="item-menu-mobile">
			<a href="<?= base_url('produk') ?>">Produk &amp; Belanja</a>
			<ul class="sub-menu">
						<?php foreach ($nav_produk_mobile as $nav_produk_mobile) { ?>
						<li><a href="<?= base_url('produk/kategori/'. $nav_produk_mobile->slug_kategori) ?>"><?= $nav_produk_mobile->nama_kategori ?></a></li>
						<?php } ?>
				
			</ul>
			<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
		</li>
					
		<!-- <li class="item-menu-mobile">
			<a href="about.html">Testimonial</a>
		</li> -->
		
		<li class="item-menu-mobile">
			<a href="<?= base_url('about') ?>">Tentang Kami</a>
		</li>

		<li class="item-menu-mobile">
			<a href="<?= base_url('kontak') ?>">Hubungi Kami</a>
		</li>
	</ul>
</nav>
</div>
</header>