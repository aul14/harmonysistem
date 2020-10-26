<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 text-gray-800"><?= $title; ?></h1>
<h6 class="mb-4">Harmony Sistem</h6>
<!-- Basic Card Example -->
<div class="row">
<div class="col">


<form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <div class="form-group row">
        
            <label for="judul_gambar" class="col-sm-2 col-form-label">Judul Gambar</label>
       
        <div class="col-sm-6">
            <input type="text" name="judul_gambar" id="judul_gambar" class="form-control" placeholder="Masukkan Judul Gambar" required autofocus>
            <?= form_error('judul_gambar', '<small class="text-danger">', '</small>'); ?>

        </div>
    </div>

    
    <div class="form-group row">
       
            <label for="gambar" class="col-sm-2 col-form-label">Upload Gambar Produk</label>
       
        <div class="col-sm-6">
             <input type="file" name="gambar" class="form-control" required>

        </div>
    </div>
    
    <div class="form-group row justify-content-end">
                   <div class="col-sm-10">
                    <button type="submit" name="simpan" class="btn btn-outline-primary"><i class="fas fa-save">&nbsp;Simpan</i></button>
                    <button type="reset" class="btn btn-outline-danger "><i class="fas fa-times-circle">&nbsp;Batal</i></button>
                   <a href="<?php echo site_url('admin/produk') ?>" class="btn btn-outline-success btn-xs" >Kembali&nbsp;<i class="fas fa-chevron-right"></i></a>
                </div>
   </div>

</form>
<hr  noshade>
<div class="row">
<div class="col-lg">
<?= $this->session->flashdata('notifProduk'); ?>
</div>
</div>

<table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>
                <img src="<?= base_url('assets/upload/produk/thumbs/' . $produk->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
            </td>
            <td><?php echo $produk->nama_produk ?></td>
            <td>

            </td>
        </tr>
        <?php $no = 2;
        foreach ($gambar as $gambar) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td>
                    <img src="<?= base_url('assets/upload/produk/thumbs/' . $gambar->gambar) ?>" class="img img-responsive img-thumbnail" width="60">
                </td>
                <td><?php echo $gambar->judul_gambar ?></td>
                <td>
                    <a href="<?php echo base_url('admin/produk/hapus_gambar/' . $produk->id_produk . '/' . $gambar->id_gambar) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus gambar ini <?= $gambar->judul_gambar ?>?')">Hapus</a>

                </td>
            </tr>
        <?php } ?>
    </tbody>

    </table>
</div>
</div>
</div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->