<!-- Begin Page Content -->
<div class="container-fluid">
<?= $this->session->flashdata('notifRekening', '<small class="text-danger">', '</small>'); ?>
<!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>
    <h6 class="mb-4">Harmony Sistem</h6>
<!-- Basic Card Example -->
<div class="row">
<div class="col">

<form action="" method="post" enctype="multipart/form-data">
   <div class="form-group row">
            <label for="nama_bank" class="col-sm-2 col-form-label">Nama Bank</label>
           <div class="col-sm-6">
            <input type="text" name="nama_bank" id="nama_bank" class="form-control" placeholder="Masukkan Nama Bank" required autofocus>
            <?= form_error('nama_bank', '<small class="text-danger">', '</small>'); ?>

        </div>
    </div>

   <div class="form-group row">
            <label for="nomor_rekening" class="col-sm-2 col-form-label">Nomor Rekening</label>
           <div class="col-sm-6">
            <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control"  placeholder="Masukkan Nomor Rekening" required >
            <?= form_error('nomor_rekening', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
   <div class="form-group row">
            <label for="nama_pemilik" class="col-sm-2 col-form-label">Nama Pemilik</label>
           <div class="col-sm-6">
            <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control"  placeholder="Masukkan Nama Pemilik" required >
            <?= form_error('nama_pemilik', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
  
   <div class="form-group row">
        
            <label for="gambar" class="col-sm-2 col-form-label">Upload Gambar Bank</label>
       
           <div class="col-sm-6">
             <input type="file" name="gambar" class="form-control" required>

        </div>
    </div>
   
    
    <div class="form-group row justify-content-end">
                   <div class="col-sm-10">
                    <button type="submit" name="simpan" class="btn btn-outline-primary"><i class="fas fa-save">&nbsp;Simpan</i></button>
                    <button type="reset" class="btn btn-outline-danger "><i class="fas fa-times-circle">&nbsp;Batal</i></button>
                    <a href="<?= site_url('admin/rekening') ?>" class="btn btn-outline-success btn-xs  float-sm-right">Kembali&nbsp;<i class="fas fa-chevron-right"></i></a>
                </div>
   </div>

</form>
</div>
</div>
</div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->