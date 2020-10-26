<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="">Edit Karyawan</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Harmony Sistem</li>
</ol>

<!-- Begin Page Content -->
<div class="container-fluid">
<?= $this->session->flashdata('notifKaryawan', '<small class="text-danger">', '</small>'); ?>
  <!-- Page Heading -->
  <h1 class="h3 text-gray-800"><?= $title; ?></h1>
    <h6 class="mb-4">Harmony Sistem</h6>
<!-- Basic Card Example -->
<div class="row">
<div class="col">

        <form action="" method="post" accept-charset="utf-8">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
             <div class="form-group row">
                
                    <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama Karyawan</label>
              
                <div class="col-sm-6">
                         <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" placeholder="Masukkan Nama Karyawan" value="<?= $tbl_karyawan->nama_karyawan ?>" required autofocus>
                        <?= form_error('nama_karyawan', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>

             <div class="form-group row">
               
                    <label for="email_karyawan" class="col-sm-2 col-form-label">Email Karyawan</label>
        
              
                <div class="col-sm-6">
                
                         <input type="text" name="email_karyawan" id="email_karyawan" class="form-control"  placeholder="Masukkan Email Karyawan" value="<?= $tbl_karyawan->email_karyawan ?>" >
                        <?= form_error('email_karyawan', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>

             <div class="form-group row">
              
                    <label for="alamat_karyawan" class="col-sm-2 col-form-label">Alamat Karyawan</label>
              
                <div class="col-sm-6">
                     <input type="text" name="alamat_karyawan" class="form-control" placeholder="Masukkan Alamat" required value="<?= $tbl_karyawan->alamat_karyawan ?>">
                        <?= form_error('alamat_karyawan', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
             <div class="form-group row">
               
                    <label for="hp_karyawan" class="col-sm-2 col-form-label">No Handphone</label>
              
                <div class="col-sm-6">
                    <input type="number" name="hp_karyawan"  class="form-control" placeholder="Masukkan No Handphone" value="<?= $tbl_karyawan->hp_karyawan ?>">
                        <?= form_error('hp_karyawan', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>
             <div class="form-group row">
            
                    <label for="id_jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                
                <div class="col-sm-6">
                <select name="id_jabatan" class="form-control">
                    <option value="">Pilih Jabatan</option>
                        <?php foreach ($jabatan as $jabatan) { ?>
                          
                            <option value="<?= $jabatan->id_jabatan ?>" <?php if ($tbl_karyawan->id_jabatan == $jabatan->id_jabatan) {
                                echo "selected";
                            } ?>><?= $jabatan->nama_jabatan ?></option>
                        <?php } ?>
                            </select>
                </div>
            </div>
             
            <div class="form-group row justify-content-end">
                   <div class="col-sm-10">
                    <button type="submit" name="simpan" class="btn btn-outline-primary"><i class="fas fa-save">&nbsp;Simpan</i></button>
                    <button type="reset" class="btn btn-outline-danger "><i class="fas fa-times-circle">&nbsp;Batal</i></button>
                    <a href="<?php echo site_url('admin/karyawan') ?>" class="btn btn-outline-success btn-xs  float-sm-right">Kembali&nbsp;<i class="fas fa-chevron-right"></i></a>
                </div>
         </div>
            
        </form>
</div>
</div>
</div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->