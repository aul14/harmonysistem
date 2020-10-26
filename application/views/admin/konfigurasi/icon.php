<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="">Konfigurasi Icon Website</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Harmony Sistem</li>
</ol>

<!-- Begin Page Content -->
<div class="container-fluid">
<div class="row">
<div class="col-lg">
<?= $this->session->flashdata('notifKonfigurasi'); ?>
</div>
</div>
<!-- Page Heading -->
<!-- Basic Card Example -->
<div class="col-sm-10 offset-1">
<div class="card shadow mb-4">
<div class="card-header py-3 bg-lawrence">
    <h6 class="m-0 font-weight-bold text-white">Konfigurasi Icon Website</h6>
    
</div>

<form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="namaweb">Konfigurasi Icon Website</label>
        </div>
        <div class="col-sm-7">
            <input type="text" name="namaweb" id="namaweb" class="form-control" placeholder="Konfigurasi Icon Website" value="<?php echo $konfigurasi->namaweb ?>" required autofocus>
            <?= form_error('namaweb', '<small class="text-danger">', '</small>'); ?>

        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="icon">Upload Icon Website</label>
        </div>
        <div class="col-sm-7">
            <input type="file" name="icon" class="form-control" placeholder=" Upload Icon" value="<?php echo $konfigurasi->icon ?>">
            Icon lama: <br> <img src="<?= base_url('assets/upload/konfigurasi/' . $konfigurasi->icon) ?>" class="img img-responsive img-thumbnail">
        </div>
    </div>
        
    <div class="row mt-5">
        
        <div class="col-sm-7">
            <button type="submit" name="simpan" class="btn btn-outline-primary float-sm-right"><i class="fas fa-save">&nbsp;Simpan</i></button>
            <button type="reset" class="btn btn-outline-danger float-sm-right mr-2"><i class="fas fa-times-circle">&nbsp;Batal</i></button>
        </div>
    </div>

</form>
</div>
</div>
</div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->