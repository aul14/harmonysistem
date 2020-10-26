<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 text-gray-800"><?= $title; ?></h1>
<h6 class="mb-4">Harmony Sistem</h6>
<!-- Basic Card Example -->
<div class="row">
<div class="col">

<form action="" method="post" accept-charset="utf-8">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

    <div class="form-group row">
        
       <label for="pesan" class="col-sm-2 col-form-label">Isi Pesan</label>
       
        <div class="col">
        <textarea name="pesan"  class="form-control" placeholder="Masukan Pesan Anda" rows="6" id="editor"></textarea>
            <?= form_error('pesan', '<small class="text-danger">', '</small>'); ?>

        </div>
    </div>

    
    <div class="form-group row justify-content-end">
                   <div class="col-sm-10">
                    <button type="submit" name="kirim" id="kirim" class="btn btn-outline-primary"><i class="fa fa-paper-plane">&nbsp;Kirim</i></button>
                    <button type="reset" class="btn btn-outline-danger "><i class="fas fa-times-circle">&nbsp;Batal</i></button>
                   <a href="<?php echo site_url('admin/pesan') ?>" class="btn btn-outline-success btn-xs" >Kembali&nbsp;<i class="fas fa-chevron-right"></i></a>
                   <?php if ($pesanM->id_status == 'read') : ?>
                    <button  class="btn btn-outline-warning " disabled><i class="fas fa-times-circle">&nbsp;Sudah dilihat</i></button>
                    <?php else: ?>
                     <a href="<?= base_url('admin/pesan/read2/'. $pesanM->id_pesan) ?>" id="read" name="read" class="btn btn-outline-info btn-xs"><i class="fas fa-eye">&nbsp;dibaca</i></a>
                    <?php endif; ?>
                </div>
   </div>

</form>
<hr  noshade>
<div class="row">
<div class="col-lg">
<?= $this->session->flashdata('notifPesan'); ?>
</div>
</div>

<table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Subject</th>
                <th>Email</th>
                <th>Status Pesan</th>
                <th>Pesan</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td><?= $pesanM->nama_pesan ?></td>
            <td><?= $pesanM->subject_pesan ?></td>
            <td><?= $pesanM->email_pesan ?></td>
            <td><?= $pesanM->id_status ?></td>
            <td><?= $pesanM->pesan ?></td>
        </tr>
       
    </tbody>

    </table>
</div>
</div>
</div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->