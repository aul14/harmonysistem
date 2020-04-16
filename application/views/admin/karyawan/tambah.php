<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="">Tambah Karyawan</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Harmony Sistem</li>
</ol>

<!-- Begin Page Content -->
<div class="container-fluid">
<?= $this->session->flashdata('notifKaryawan', '<small class="text-danger">', '</small>'); ?>
    <!-- Page Heading -->
    <!-- Basic Card Example -->
    <div class="col-sm-10 offset-1">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-lawrence">
                <h6 class="m-0 font-weight-bold text-white">Tambah Karyawan</h6>
               
            </div>

            <form action="" method="post">
                <div class="row mt-3">
                    <div class="col-sm-3 offset-1">
                        <label for="nama_karyawan">Nama Karyawan</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" placeholder="Masukkan Nama Karyawan" required autofocus>
                        <?= form_error('nama_karyawan', '<small class="text-danger">', '</small>'); ?>

                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-3 offset-1">
                        <label for="email_karyawan">Email Karyawan</label>
            
                    </div>
                    <div class="col-sm-7">
                  
                        <input type="text" name="email_karyawan" id="email_karyawan" class="form-control"  placeholder="Masukkan Email Karyawan" >
                        <?= form_error('email_karyawan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-3 offset-1">
                        <label for="alamat_karyawan">Alamat Karyawan</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="alamat_karyawan" class="form-control" placeholder="Masukkan Alamat" required="required">
                        <?= form_error('hp_karyawan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-3 offset-1">
                        <label for="hp_karyawan">No Handphone</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="number" name="hp_karyawan"  class="form-control" placeholder="Masukkan No Handphone" required="required">
                        <?= form_error('hp_karyawan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-3 offset-1">
                        <label for="id_jabatan">Jabatan</label>
                    </div>
                    <div class="col-sm-7">
                    <select name="id_jabatan" class="form-control">
                        <?php foreach ($tbl_jabatan as $jabatan) { ?>
                            <option value="<?= $jabatan->id_jabatan ?>"><?= $jabatan->nama_jabatan ?></option>
                        <?php } ?>
                            </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-3 offset-1">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required="required">
                        <?= form_error('password'); ?>
                        <h6> <i style="color:red">*Panjang Password Min 5 Karakter</i></p></h6>

                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-3 offset-1">
                        <label for="password2">Masukan Kembali Password</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Masukan Kembali Password" required="required">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-sm-3  offset-1 ">
                        <a href="<?php echo site_url('admin/karyawan') ?>" class="btn btn-outline-success btn-xs"><i class="fas fa-chevron-left">
                                Kembali
                            </i></a>

                    </div>
                    <div class="col-sm-7">
                        <button type="submit" class="btn btn-outline-primary float-sm-right"><i class="fas fa-save">&nbsp;Simpan</i></button>
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