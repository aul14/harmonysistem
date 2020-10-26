<!-- Title Page -->
<section class="bg-title-page" style="background-image: url(<?= base_url() ?>assets/upload/konfigurasi/coba.png);">

</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">
					<div class="p-r-20 p-r-0-lg">
						<div class="contact-map size21" id="google_map" data-map-x="-6.2764314" data-map-y="107.0018838" data-pin="<?= base_url() ?>assets/template/images/icons/icon2.png" data-scrollwhell="0" data-draggable="1"></div>
					</div>
				</div>

				<div class="col-md-6 p-b-30">
				<?php if ($this->session->flashdata('sukses')
					) {
					
						echo '<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					</button>';
					echo $this->session->flashdata('sukses');
					echo '</div>';
					
				} ?>
                <?=
                    validation_errors('<div class="alert alert-warning">','</div>');
                ?>
					<form class="leave-comment" method="POST" accept-charset="utf-8">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<h4 class="m-text26 p-b-36 p-t-15">
							Hubungi Kami Melalui Email
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" value="<?= set_value('nama') ?>" type="text" name="nama" placeholder="Nama Anda" required>
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" value="<?= set_value('subject') ?>" name="subject" placeholder="Subject">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" value="<?= set_value('email') ?>" name="email" placeholder="Alamat Email">
						</div>

						<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20"  name="pesan" placeholder="Pesan Anda"><?= set_value('pesan') ?></textarea>

						<div class="w-size25">
							<!-- Button -->
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
								Kirim
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>