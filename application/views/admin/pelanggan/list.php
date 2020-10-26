<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><?= $title; ?></a>
        </li>
        <li class="breadcrumb-item active">Harmony Sistem</li>
    </ol>

   
        <div class="col-lg">
        <?= $this->session->flashdata('notifPelanggan'); ?>
        </div>
   

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">List Data Pelanggan</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Email Pelanggan</th>
                            <th>Telepon Pelanggan</th>
                            <th>Alamat Pelanggan</th>
                            <th>Provinsi</th>
                            <th>Kota / Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan / Desa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($pelanggan as $u) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $u->nama_pelanggan ?></td>
                                <td><?php echo $u->email ?></td>
                               <td><?php echo $u->telepon ?></td>
                                <td><?php echo $u->alamat ?></td>
                                <td><?php echo $u->id_prov ?></td>
                                <td><?php echo $u->id_kab ?></td>
                                <td><?php echo $u->id_kec ?></td>
                                <td><?php echo $u->id_kel ?></td>

                                <td>
                               
                                <a href="<?= base_url('admin/pelanggan/hapus/'. $u->id_pelanggan) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus nama pelanggan <?= $u->nama_pelanggan ?>?')">Hapus</a>
                                   
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