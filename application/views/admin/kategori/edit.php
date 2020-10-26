<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="">Edit Kategori Produk</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Harmony Sistem</li>
</ol>

<!-- Begin Page Content -->
<div class="container-fluid">
<?= $this->session->flashdata('notifKategori', '<small class="text-danger">', '</small>'); ?>
<h1 class="h3 text-gray-800"><?= $title; ?></h1>
<h6 class="mb-4">Harmony Sistem</h6>
<!-- Basic Card Example -->
<div class="row">
<div class="col">

            <form action="" method="post" accept-charset="utf-8">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="form-group row">
                
                        <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                
                    <div class="col-sm-6">
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Masukkan Nama Kategori" value="<?= $kategori->nama_kategori ?>" required autofocus>
                        <?= form_error('nama_kategori', '<small class="text-danger">', '</small>'); ?>

                    </div>
                </div>

                <div class="form-group row">
                   
                        <label for="urutan" class="col-sm-2 col-form-label">Urutan</label>
            
                
                    <div class="col-sm-6">
                  
                        <input type="text" name="urutan" id="urutan" class="form-control"  placeholder="Masukkan Urutan" value="<?= $kategori->urutan ?>" >
                        <?= form_error('urutan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                             

                <div class="form-group row justify-content-end">
                   <div class="col-sm-10">
                    <button type="submit" name="simpan" class="btn btn-outline-primary"><i class="fas fa-save">&nbsp;Simpan</i></button>
                    <button type="reset" class="btn btn-outline-danger "><i class="fas fa-times-circle">&nbsp;Batal</i></button>
                </div>
         </div>

            </form>
        </div>
    </div>
</div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->