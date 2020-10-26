<!-- Begin Page Content -->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href=""><?= $title ?></a>
</li>
<li class="breadcrumb-item active" aria-current="page">Harmony Sistem</li>
</ol>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>
    <h6 class="mb-4">Ganti Password</h6>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('info'); ?>
            <form action="" method="post" accept-charset="utf-8">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                <div class="form-group">
                    <label for="passwordLama">Password Lama:</label>
                    <input type="password" name="passwordLama" id="passwordLama" class="form-control">
                    <?= form_error('passwordLama', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="passwordBaru">Password Baru:</label>
                    <input type="password" name="passwordBaru" id="passwordBaru" class="form-control">
                    <h6> <i style="color:red">*Minimum 8 karakter termasuk A-Z, a-z, dan 1-9</i></p></h6>
                    <?= form_error('passwordBaru', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="passwordBaru1">Ulangi Password:</label>
                    <input type="password" name="passwordBaru1" id="passwordBaru1" class="form-control">
                    <h6> <i style="color:red">*Password harus sama dengan password baru</i></p></h6>
                    <?= form_error('passwordBaru1', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark bg-lawrence">Ganti Password</button>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->