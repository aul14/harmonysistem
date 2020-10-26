<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="#">Data Produk</a>
</li>
<li class="breadcrumb-item active">Harmony Sistem</li>
</ol>

<div class="row">
<div class="col-lg">
<?= $this->session->flashdata('notifProduk'); ?>
</div>
</div>

<?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98 or $this->session->userdata('id_jabatan') == 1 or $this->session->userdata('id_jabatan') == 2) { ?>
<div class="row mb-3 col-lg-6">
<a class="nav-link btn btn-info bg-lawrence mr-3" href="<?= site_url('admin/produk/tambah') ?>">
<i class="fas fa-cart-plus"></i>
<span>Tambah Produk Baru</span></a>
</div>
<?php } ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">List Produk</h6>

</div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
        <thead>
            <tr>
                <th>No. </th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori Produk</th>
                <th>Harga Produk</th>
                <th>Stok Produk</th>
                <th>Status Produk</th>
                <?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98 or $this->session->userdata('id_jabatan') == 1 or $this->session->userdata('id_jabatan') == 2) { ?>
                <th>Aksi</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($produk as $u) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td>
                    <img src="<?= base_url('assets/upload/produk/thumbs/' . $u->gambar) ?>" class="img img-responsive img-thumbnail" width="70">
                    </td>
                    <td><?php echo $u->nama_produk ?></td>
                    <td><?php echo $u->nama_kategori ?></td>
                    <td><?php echo number_format($u->harga, '0',',','.') ?></td>
                    <td><?php echo $u->stok ?></td>
                    <td><?php echo $u->status_produk ?></td>

                    <?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98 or $this->session->userdata('id_jabatan') == 1 or $this->session->userdata('id_jabatan') == 2) { ?>
                    <td>
                    <a href="<?= base_url('admin/produk/gambar/'. $u->id_produk) ?>" class="badge badge-success">Gambar&nbsp;(<?= $u->total_gambar ?>)</a>
                    <a href="<?= base_url('admin/produk/edit/'. $u->id_produk) ?>" class="badge badge-info">Edit</a>
                    <a href="<?= base_url('admin/produk/hapus/'. $u->id_produk) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus nama produk <?= $u->nama_produk ?>?')">Hapus</a>
                        
                    </td>
                    <?php } ?>

                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>
</div>
</div>

</div>
</div>