<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><?= $title ?></a>
        </li>
        <li class="breadcrumb-item active">Harmony Sistem</li>
    </ol>

   
        <div class="col-lg">
        <?= $this->session->flashdata('notifRekening'); ?>
        </div>
   

    <div class="row mb-3 col-lg-6">
        <a class="nav-link btn btn-info bg-lawrence mr-3" href="<?= site_url('admin/rekening/tambah') ?>">
        <i class="far fa-credit-card"></i>
            <span>Tambah Rekening Baru</span></a>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">List Rekening</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bank</th>
                            <th>Nomor Rekening</th>
                            <th>Nama Pemilik</th>
                            <th>Gambar Bank</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($tbl_rekening as $u) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $u->nama_bank ?></td>
                                <td><?php echo $u->nomor_rekening ?></td>
                                <td><?php echo $u->nama_pemilik ?></td>
                                <td>
                                <img src="<?= base_url('assets/upload/rekening/' . $u->gambar) ?>" class="img img-responsive img-thumbnail" width="70">
                                </td>
                                <td>
                                <a href="<?= base_url('admin/rekening/edit/'. $u->id_rekening) ?>" class="badge badge-info">Edit</a>
                                <a href="<?= base_url('admin/rekening/hapus/'. $u->id_rekening) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus data bank <?= $u->nama_bank ?>?')">Hapus</a> 
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