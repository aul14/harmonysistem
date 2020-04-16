<!-- Header -->
<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="topbar">
				<div class="topbar-social">
					<a href="<?= $site->facebook ?>" class="topbar-social-item fa fa-facebook"></a>
					<a href="<?= $site->instagram ?>" class="topbar-social-item fa fa-instagram"></a>
					
				</div>

				<span class="topbar-child1">
					<?= $site->tagline ?>
				</span>

				<div class="topbar-child2">
					<span class="topbar-email">
						<?= $site->email ?>
					</span>

					<div class="topbar-language rs1-select2">
						<select class="selection-1" name="time">
							<option><?= $site->telepon ?></option>
							<option><?= $site->whatsapp ?></option>
						</select>
					</div>
				</div>
			</div>