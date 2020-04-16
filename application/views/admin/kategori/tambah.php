<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="">Tambah Kategori Baru</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Harmony Sistem</li>
</ol>

<!-- Begin Page Content -->
<div class="container-fluid">
<?= $this->session->flashdata('notifKategori', '<small class="text-danger">', '</small>'); ?>
    <!-- Page Heading -->
    <!-- Basic Card Example -->
    <div class="col-sm-10 offset-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-lawrence">
                <h6 class="m-0 font-weight-bold text-white">Tambah Kategori Baru</h6>
               
            </div>

            <form action="" method="post">
                <div class="row mt-3">
                    <div class="col-sm-3 offset-1">
                        <label for="nama_kategori">Nama Kategori</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Masukkan Nama Kategori" required autofocus>
                        <?= form_error('nama_kategori', '<small class="text-danger">', '</small>'); ?>

                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-3 offset-1">
                        <label for="urutan">Urutan</label>
            
                    </div>
                    <div class="col-sm-7">
                  
                        <input type="text" name="urutan" id="urutan" class="form-control"  placeholder="Masukkan Urutan" >
                        <?= form_error('urutan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
           
               
                <div class="row mt-5">
                    <div class="col-sm-3  offset-1 ">
                        <a href="<?php echo site_url('admin/kategori') ?>" class="btn btn-outline-success btn-xs"><i class="fas fa-chevron-left">
                                Kembali
                            </i></a>

                    </div>
                    <div class="col-sm-7">
                        <button type="submit" class="btn btn-outline-primary float-sm-right"><i class="fas fa-save">&nbsp;Simpan</i></button>
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