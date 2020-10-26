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
   
        <?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98 or $this->session->userdata('id_jabatan') == 1 or $this->session->userdata('id_jabatan') == 2) { ?>
    <div class="row mb-3 col-lg-6">
        <a class="nav-link btn btn-info bg-lawrence mr-3" href="<?= site_url('admin/kategori/tambah') ?>">
            <i class="fas fa-store"></i>
            <span>Tambah Kategori Baru</span></a>
    </div>
        <?php } ?>
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
                            <?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98 or $this->session->userdata('id_jabatan') == 1 or $this->session->userdata('id_jabatan') == 2) { ?>
                            <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($kategori as $u) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $u->nama_kategori ?></td>
                                <td><?php echo $u->slug_kategori ?></td>
                                <td><?php echo $u->urutan ?></td>
                                <?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98 or $this->session->userdata('id_jabatan') == 1 or $this->session->userdata('id_jabatan') == 2) { ?>
                                <td>
                                <a href="<?= base_url('admin/kategori/edit/'. $u->id_kategori) ?>" class="badge badge-info">Edit</a>
                                <a href="<?= base_url('admin/kategori/hapus/'. $u->id_kategori) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus nama kategori <?= $u->nama_kategori ?>?')">Hapus</a>
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