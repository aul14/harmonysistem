<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Data Karyawan</a>
        </li>
        <li class="breadcrumb-item active">Harmony Sistem</li>
    </ol>

   
        <div class="col-lg">
        <?= $this->session->flashdata('notifKaryawan'); ?>
        </div>
   
        <?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98) { ?>
    <div class="row mb-3 col-lg-6">
        <a class="nav-link btn btn-info bg-gradient-primary mr-3" href="<?= base_url('admin/karyawan/tambah') ?>">
            <i class="fas fa-user-plus"></i>
            <span>Tambah Karyawan Baru</span></a>
    </div>
        <?php } ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">List Data Karyawan</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Email Karyawan</th>
                            <th>Foto</th>
                            <th>No Handpone</th>
                            <th>Alamat Karyawan</th>
                            <th>Jabatan</th>
                            <th>Tanggal Pendaftaran</th>
                            <?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98) { ?>
                            <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($tbl_karyawan as $u) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $u->nama_karyawan ?></td>
                                <td><?php echo $u->email_karyawan ?></td>
                                <td>
                                <img  src="<?= base_url('assets/upload/user/'.$u->foto) ?>" class="img img-responsive img-thumbnail" width="70">
                                </td>
                                <td><?php echo $u->hp_karyawan ?></td>
                                <td><?php echo $u->alamat_karyawan ?></td>
                                <td><?php echo $u->id_jabatan ?></td>
                                <td><?php echo $u->karyawan_register ?></td>
                                <?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98) { ?>
                                <td>
                                <a href="<?= base_url('admin/karyawan/edit/'. encrypt_url($u->id_karyawan)) ?>" class="badge badge-info">Edit</a>
                                <a href="<?= base_url('admin/karyawan/hapus/'. encrypt_url($u->id_karyawan)) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus nama karyawan <?= $u->nama_karyawan ?>?')">Hapus</a>
                                   
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