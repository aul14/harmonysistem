<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><?= $title ?></a>
        </li>
        <li class="breadcrumb-item active">Harmony Sistem</li>
    </ol>

   
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">List Pesan Masuk</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengirim</th>
                            <th>Subject</th>
                            <th>Email Pengirim</th>
                            <th>Isi Pesan</th>
                            <th>Status Pesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($pesanMasuk as $u) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $u->nama_pesan ?></td>
                                <td><?php echo $u->subject_pesan ?></td>
                                <td><?php echo $u->email_pesan ?></td>
                                <td><?php echo $u->pesan ?></td>
                                <td><?php echo $u->id_status ?></td>
                                <td>
                                    <?php if ($u->id_status == 'read') : ?>
                                <button id="read" name="read" class="badge badge-warning text-hov-white" disabled>Sudah dibaca</button>
                                    <?php else: ?>
                                <a href="<?= base_url('admin/pesan/read/'.$u->id_pesan) ?>" id="read" name="read" class="badge badge-success text-hov-white">dibaca</a>
                                  <?php endif; ?>
                                <a href="<?= base_url('admin/pesan/balas/'. $u->id_pesan) ?>" id="balas" class="badge badge-info">Balas</a>
                                <a href="<?= base_url('admin/pesan/hapus/'. $u->id_pesan) ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus data pesan masuk <?= $u->nama_pesan ?>?')">Hapus</a> 
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