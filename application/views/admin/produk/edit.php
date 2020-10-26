<!-- Begin Page Content -->
<div class="container-fluid">
<?= $this->session->flashdata('notifProduk', '<small class="text-danger">', '</small>'); ?>
<!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>
    <h6 class="mb-4">Harmony Sistem</h6>
<!-- Basic Card Example -->
<div class="row">
<div class="col-lg-10">

<form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <div class="form-group row">
       
            <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
     
       <div class="col-sm-6">
            <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Masukkan Nama Produk" value="<?= $produk->nama_produk ?>" required autofocus>
            <?= form_error('nama_produk', '<small class="text-danger">', '</small>'); ?>

        </div>
    </div>

    <div class="form-group row">
       
            <label for="kode_produk" class="col-sm-2 col-form-label">Kode Produk</label>
        
       <div class="col-sm-6">
            <input type="text" name="kode_produk" id="kode_produk" class="form-control"  placeholder="Masukkan Kode Produk" value="<?php echo $produk->kode_produk ?>" required>
            <?= form_error('kode_produk', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="form-group row">
       
            <label for="id_kategori" class="col-sm-2 col-form-label">Kategori Produk</label>
       
       <div class="col-sm-6">
            <select name="id_kategori" class="form-control">
            <?php foreach ($kategori as $kategori) { ?>
                    <option value="<?= $kategori->id_kategori ?>" <?php if ($produk->id_kategori == $kategori->id_kategori) {
                                                                        echo "selected";
                                                                    } ?>><?= $kategori->nama_kategori ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        
            <label for="harga" class="col-sm-2 col-form-label">Harga Produk</label>
       
       <div class="col-sm-6">
            <input type="number" name="harga" id="harga" class="form-control"  placeholder="Masukkan Harga Produk" value="<?php echo $produk->harga ?>" required >
            <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="form-group row">
        
            <label for="stok" class="col-sm-2 col-form-label">Stok Produk</label>
      
       <div class="col-sm-6">
            <input type="number" name="stok" id="stok" class="form-control"  placeholder="Masukkan Stok Produk" value="<?php echo $produk->stok ?>" required >
            <?= form_error('stok', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="form-group row">
       
            <label for="berat" class="col-sm-2 col-form-label">Berat Produk</label>
      
       <div class="col-sm-6">
            <input type="text" name="berat" id="berat" class="form-control"  placeholder="Masukkan Berat Produk" value="<?php echo $produk->berat ?>" required >
            <?= form_error('berat', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="form-group row">
        
            <label for="ukuran" class="col-sm-2 col-form-label">Ukuran Produk</label>
      
       <div class="col-sm-6">
            <input type="text" name="ukuran" id="ukuran" class="form-control"  placeholder="Masukkan Ukuran Produk" value="<?php echo $produk->ukuran ?>" required >
            <?= form_error('ukuran', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="form-group row">
       
            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan Produk</label>
    
       <div class="col-sm-10">
            <textarea name="keterangan"  class="form-control" placeholder="Masukan Keterangan Produk" id="editor"><?= $produk->keterangan ?></textarea>
            <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="form-group row">
        
            <label for="keywords" class="col-sm-2 col-form-label">Keywords Produk</label>
      
       <div class="col-sm-6">
            <input type="text" name="keywords" id="keywords" class="form-control"  placeholder="Keywords (untuk SEO Google)" value="<?php echo $produk->keywords ?>" required>
            <?= form_error('keywords', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="form-group row">
        
            <label for="gambar" class="col-sm-2 col-form-label">Upload Gambar Produk</label>
      
       <div class="col-sm-6">
             <input type="file" name="gambar" class="form-control">
             <h6> <i style="color:red">*Kosongkan gambar jika tidak ingin mengganti gambar.</i></p>
        </div>
    </div>
    <div class="form-group row">
       
            <label for="status_produk" class="col-sm-2 col-form-label">Status Produk</label>
    
       <div class="col-sm-6">
            <select name="status_produk" class="form-control">
                <option value="publish">Publikasikan</option>
                <option value="draft" <?php if ($produk->status_produk == "draft") {
                                            echo "selected";
                                        } ?>>Simpan Sebagai Draft</option>
            </select>
        </div>
    </div>
    
    <div class="form-group row justify-content-end">
                   <div class="col-sm-10">
                    <button type="submit" name="simpan" class="btn btn-outline-primary"><i class="fas fa-save">&nbsp;Simpan</i></button>
                    <button type="reset" class="btn btn-outline-danger "><i class="fas fa-times-circle">&nbsp;Batal</i></button>
                    <a href="<?php echo site_url('admin/produk') ?>" class="btn btn-outline-success btn-xs  float-sm-right">Kembali&nbsp;<i class="fas fa-chevron-right"></i></a>
                </div>
   </div>

</form>
</div>
</div>
</div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->