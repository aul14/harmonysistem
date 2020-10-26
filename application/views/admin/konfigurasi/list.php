<!-- Begin Page Content -->
<div class="container-fluid">
<?= $this->session->flashdata('notifKonfigurasi', '<small class="text-danger">', '</small>'); ?>
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>
    <h6 class="mb-4">Harmony Sistem</h6>
    <!-- Basic Card Example -->
    <div class="row">
        <div class="col">

            <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                 <div class="form-group row">
                   
                        <label for="namaweb" class="col-sm-2 col-form-label">Nama Website</label>
                   
                   <div class="col-sm-6">
                        <input type="text" name="namaweb" id="namaweb" class="form-control" placeholder="Masukkan Nama Website" value="<?php echo $konfigurasi->namaweb ?>" required autofocus>
                        <?= form_error('namaweb', '<small class="text-danger">', '</small>'); ?>

                    </div>
                </div>

                 <div class="form-group row">
                    
                        <label for="tagline" class="col-sm-2 col-form-label">Tagline</label>           
                   
                   <div class="col-sm-6">   
                        <input type="text" name="tagline" id="tagline" class="form-control"  placeholder="Tagline" value="<?php echo $konfigurasi->tagline ?>" required>
                        <?= form_error('tagline', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="form-group row">
                   
                        <label for="email" class="col-sm-2 col-form-label">Email</label>           
                   
                   <div class="col-sm-6">   
                        <input type="text" name="email" id="email" class="form-control"  placeholder="Email" value="<?php echo $konfigurasi->email ?>" required>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="form-group row">
                   
                        <label for="website" class="col-sm-2 col-form-label">Website</label>           
                    
                   <div class="col-sm-6">   
                        <input type="text" name="website" id="website" class="form-control"  placeholder="Website" value="<?php echo $konfigurasi->website ?>" required>
                        <?= form_error('website', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="form-group row">
                   
                        <label for="keywords" class="col-sm-2 col-form-label">Keyword (untuk SEO Google)</label>           
                   
                   <div class="col-sm-6">   
                        <input type="text" name="keywords" id="keywords" class="form-control"  placeholder="Keyword (untuk SEO Google)" value="<?php echo $konfigurasi->keywords ?>" required>
                        <?= form_error('keywords', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="form-group row">
                    
                        <label for="metatext" class="col-sm-2 col-form-label">Metatext</label>           
                 
                   <div class="col-sm-6">   
                        <input type="text" name="metatext" id="metatext" class="form-control"  placeholder="Metatext" value="<?php echo $konfigurasi->metatext ?>" required>
                        <?= form_error('metatext', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="form-group row">
                   
                        <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>           
                  
                   <div class="col-sm-6">   
                        <input type="text" name="telepon" id="telepon" class="form-control"  placeholder="Telepon" value="<?php echo $konfigurasi->telepon ?>" required>
                        <?= form_error('telepon', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="form-group row">
                  
                        <label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>           
                  
                   <div class="col-sm-6">   
                        <input type="text" name="whatsapp" id="whatsapp" class="form-control"  placeholder="Telepon" value="<?php echo $konfigurasi->whatsapp ?>" required>
                        <?= form_error('whatsapp', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="form-group row">
                    
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>           
                   
                   <div class="col-sm-6">   
                        <input type="text" name="alamat" id="alamat" class="form-control"  placeholder="Alamat" value="<?php echo $konfigurasi->alamat ?>" required>
                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="form-group row">
                    
                        <label for="facebook" class="col-sm-2 col-form-label">Alamat Facebook</label>           
                   
                   <div class="col-sm-6">   
                        <input type="text" name="facebook" id="facebook" class="form-control"  placeholder="Alamat Facebook" value="<?php echo $konfigurasi->facebook ?>" required>
                        <?= form_error('facebook', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="form-group row">
                   
                        <label for="instagram" class="col-sm-2 col-form-label">Alamat Instagram</label>           
                 
                   <div class="col-sm-6">   
                        <input type="text" name="instagram" id="instagram" class="form-control"  placeholder="Alamat Instagram" value="<?php echo $konfigurasi->instagram ?>" required>
                        <?= form_error('instagram', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="form-group row">
                   
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Website</label>           
                   
                    <div class="col">   
                      <textarea type="text" name="deskripsi" id="editor" class="form-control" placeholder="Deskripsi Website" required><?php echo $konfigurasi->deskripsi ?></textarea>
                    </div>
                </div>
           
               
                <div class="form-group row justify-content-end">
                   <div class="col-sm-10">
                    <button type="submit" name="simpan" class="btn btn-outline-primary"><i class="fas fa-save">&nbsp;Simpan</i></button>
                    <button type="reset" class="btn btn-outline-danger "><i class="fas fa-times-circle">&nbsp;Batal</i></button>
                </div>
                </div>

            </form>
        </div>
    </div>
</div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->