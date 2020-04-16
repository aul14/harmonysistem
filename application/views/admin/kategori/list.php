<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Data Kategori Produk</a>
        </li>
        <li class="breadcrumb-item active">Harmony Sistem</li>
    </ol>

   
        <div class="col-lg">
        <?= $this->session->flashdata('notifKategori'); ?>
        </div>
   

    <div class="row mb-3 col-lg-6">
        <a class="nav-link btn btn-info bg-lawrence mr-3" href="<?= site_url('admin/kategori/tambah') ?>">
            <i class="fas fa-store"></i>
            <span>Tambah Kategori Baru</span></a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">List Kategori Produk</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Slug Kategori</th>
                            <th>Urutan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($tbl_kategori as $u) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $u->nama_kategori ?></td>
                                <td><?php echo $u->slug_kategori ?></td>
                                <td><?php echo $u->urutan ?></td>
                              
                                <td>
                                <a href="<?= base_url('admin/kategori/edit/'. $u->id_kategori) ?>" class="badge badge-info">Edit</a>
                                <a href="<?= base_url('admin/kategori/hapus/'. $u->id_kategori) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus nama kategori <?= $u->nama_kategori ?>?')">Hapus</a>
                                   
                                </td>


                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
</div>