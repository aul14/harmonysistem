<div class="limiter">
	<div class="container-login100" style="background-image: url(<?= base_url() ?>assets/upload/konfigurasi/bg-01.jpg);">
		<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
			<form action="" method="POST" accept-charset="utf-8">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<span class="login100-form-title p-b-53">
					PT Harmony Sistem
				</span>
				<?= $this->session->flashdata('notifLogin'); ?>
				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Email
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate="Email wajib diisi">
					<input class="input100" type="text" name="email_karyawan">
					<?= form_error('email_karyawan', '<small class="text-danger">', '</small>'); ?>
					<span class="focus-input100"></span>
				</div>

				<div class="p-t-13 p-b-9">
					<span class="txt1">
						Password
					</span>


				</div>
				<div class="wrap-input100 validate-input" data-validate="Password wajib diisi">
					<input class="input100" type="password" name="password">
					<?= form_error('password', '<small class="text-danger">', '</small>'); ?>
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn m-t-17">
					<button class="login100-form-btn">
						Login
					</button>
				</div>


			</form>
		</div>
	</div>
</div>


<div id="dropDownSelect1"></div>