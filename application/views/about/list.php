<!-- Title Page -->
<section class="bg-title-page" style="background-image: url(<?= base_url() ?>assets/upload/konfigurasi/coba.png);">

</section>
	<?php 
	$list['list'] = $this->Konfigurasi_model->listing();
	?>
	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
			<div class="row">
				<div class="col-md-4 p-b-30">
					<div class="hov-img-zoom">
						<img src="<?= base_url() ?>assets/upload/konfigurasi/about.jpg" alt="IMG-ABOUT">
					</div>
				</div>

				<div class="col-md-8 p-b-30">
					<h3 class="m-text26 p-t-15 p-b-16">
						Tentang Kami
					</h3>
					<?php foreach($list as $u) { ?>	
					<p class="p-b-28" style="text-align:justify">
						<?= htmlspecialchars_decode($u->deskripsi) ?>
					</p>
					<?php } ?>
					<div class="bo13 p-l-29 m-l-9 p-b-10" style="text-align:justify">
						<p class="p-b-11">
						PT. HARMONY SISTEM  mulai berdiri tahun 2002, yang telah berkembang menjadi sebuah Perusahaan operator layanan dokumen utama, melayani banyak Perusahaan (besar dan kecil) dan copy center, melalui perbaikan yang efektif dan solusi dalam biaya dan pemeliharaan.						</p>

						<span class="s-text7">
							- Harmony Sistem
						</span>
					</div>
				</div>
			</div>
		</div>
	</section>