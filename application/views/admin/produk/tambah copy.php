<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="">Tambah Produk Baru</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Harmony Sistem</li>
</ol>

<!-- Begin Page Content -->
<div class="container-fluid">
<?= $this->session->flashdata('notifProduk', '<small class="text-danger">', '</small>'); ?>
<!-- Page Heading -->
<!-- Basic Card Example -->
<div class="col-sm-10 offset-1">
<div class="card shadow mb-4">
<div class="card-header py-3 bg-lawrence">
    <h6 class="m-0 font-weight-bold text-white">Tambah Produk Baru</h6>
    
</div>

<form action="" method="post" enctype="multipart/form-data">
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="nama_produk">Nama Produk</label>
        </div>
        <div class="col-sm-7">
            <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Masukkan Nama Produk" required autofocus>
            <?= form_error('nama_produk', '<small class="text-danger">', '</small>'); ?>

        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="kode_produk">Kode Produk</label>
        </div>
        <div class="col-sm-7">
            <input type="text" name="kode_produk" id="kode_produk" class="form-control"  placeholder="Masukkan Kode Produk" >
            <?= form_error('kode_produk', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="id_kategori">Kategori Produk</label>
        </div>
        <div class="col-sm-7">
            <select name="id_kategori" class="form-control">
                <?php foreach ($kategori as $kategori) { ?>
                    <option value="<?= $kategori->id_kategori ?>"><?= $kategori->nama_kategori ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="harga">Harga Produk</label>
        </div>
        <div class="col-sm-7">
            <input type="number" name="harga" id="harga" class="form-control"  placeholder="Masukkan Harga Produk" >
            <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="stok">Stok Produk</label>
        </div>
        <div class="col-sm-7">
            <input type="number" name="stok" id="stok" class="form-control"  placeholder="Masukkan Stok Produk" >
            <?= form_error('stok', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="berat">Berat Produk</label>
        </div>
        <div class="col-sm-7">
            <input type="text" name="berat" id="berat" class="form-control"  placeholder="Masukkan Berat Produk" >
            <?= form_error('berat', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="ukuran">Ukuran Produk</label>
        </div>
        <div class="col-sm-7">
            <input type="text" name="ukuran" id="ukuran" class="form-control"  placeholder="Masukkan Ukuran Produk" >
            <?= form_error('ukuran', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="keterangan">Keterangan Produk</label>
        </div>
        <div class="col-sm-7">
            <textarea name="keterangan"  class="form-control" placeholder="Masukan Keterangan Produk" id="editor"></textarea>
            <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="keywords">Keywords Produk</label>
        </div>
        <div class="col-sm-7">
            <input type="text" name="keywords" id="keywords" class="form-control"  placeholder="Keyword (untuk SEO Google)" >
            <?= form_error('keywords', '<small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="gambar">Upload Gambar Produk</label>
        </div>
        <div class="col-sm-7">
             <input type="file" name="gambar" class="form-control" required>

        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-3 offset-1">
            <label for="status_produk">Status Produk</label>
        </div>
        <div class="col-sm-7">
            <select name="status_produk" class="form-control">
                <option value="publish">Publikasikan</option>
                <option value="draft">Simpan Sebagai Draft</option>
            </select>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-sm-3  offset-1 ">
            <a href="<?php echo site_url('admin/produk') ?>" class="btn btn-outline-success btn-xs"><i class="fas fa-chevron-left">
                    Kembali
                </i></a>

        </div>
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