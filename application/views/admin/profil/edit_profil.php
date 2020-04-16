<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href=""><?= $title ?></a>
</li>
<li class="breadcrumb-item active" aria-current="page">Harmony Sistem</li>
</ol>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>
    <h6 class="mb-4">Edit Profil</h6>

    <div class="row">
        <div class="col-lg-10">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama Karyawan</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="<?php echo $karyawan['nama_karyawan']; ?>">
                    <?php echo form_error('nama_karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="email_karyawan" class="col-sm-2 col-form-label">Email Karyawan</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="email_karyawan" name="email_karyawan" value="<?php echo $karyawan['email_karyawan']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="hp_karyawan" class="col-sm-2 col-form-label">No Handphone</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" id="hp_karyawan" name="hp_karyawan" value="<?php echo $karyawan['hp_karyawan']; ?>">
                    <?php echo form_error('hp_karyawan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Foto Profil</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?php echo base_url('assets/upload/user/') . $karyawan['foto']; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-6">
                            <div class="custom-file">
                                <input type="file" name="image" class="form-control">

                                <small class="text text-danger">*Kosongkan jika tidak ingin mengganti foto profil</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" name="edit" class="btn btn-outline-primary"><i class="fas fa-save">&nbsp;Simpan</i></button>
                </div>
            </div>
          </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->