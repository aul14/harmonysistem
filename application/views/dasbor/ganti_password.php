
<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
<div class="container">
<div class="row">
    <div class="col-sm-6 col-md-3 col-lg-3 p-b-50">
        <div class="leftbar p-r-20 p-r-0-sm">
            
        <?php include('menu.php') ?>
           
        </div>
    </div>

    <div class="col-sm-6 col-md-9 col-lg-9 p-b-50">
       

        <!-- Product -->
            <h2><?= $title ?></h2>
            <br>
            <?php if ($this->session->flashdata('sukses')
                ) {
                    
                    echo '<div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
                    </button>';
                    echo $this->session->flashdata('sukses');
                    echo '</div>';
                    
                } ?>
            <form action="" method="post" accept-charset="utf-8">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
       <table class="table table-bordered">
           <tbody>
               <tr>
                   <th>Masukan Password Lama</th>
                   <td> <input type="password" name="passwordLama" id="passwordLama" class="form-control">
                    <?= form_error('passwordLama', '<small class="text-danger">', '</small>'); ?></td>
               </tr>
               <tr>
                   <th>Masukan Password Baru</th>
                   <td><input type="password" name="passwordBaru" id="passwordBaru" class="form-control">
                    <p> <i style="color:red">*Minimum 8 karakter termasuk A-Z, a-z, dan 1-9</i></p></h6>
                    <?= form_error('passwordBaru', '<small class="text-danger">', '</small>'); ?>

                </td>   
               </tr>
               <tr>
                   <th>Masukan Kembali Password Baru</th>
                   <td> <input type="password" name="passwordBaru1" id="passwordBaru1" class="form-control">
                    <p> <i style="color:red">*Password harus sama dengan password baru</i></p></h6>
                    <?= form_error('passwordBaru1', '<small class="text-danger">', '</small>'); ?></td>
               </tr>
              
               <tr>
                   <th></th>
                   <td>
                       <button class="btn btn-outline-success btn-lg" type="submit"><i class="fa fa-save"></i>&nbsp;Edit</button>
                       <button class="btn btn-outline-warning btn-lg" type="reset"><i class="fa fa-close"></i>&nbsp;Batal</button>
                       <a href="<?= base_url('beranda/profil') ?>" class="btn btn-outline-primary btn-lg" >Kembali&nbsp;<i class="fa fa-chevron-circle-right"></i></a>
                   </td>
               </tr>
           </tbody>
       </table>
      </form>


    </div>

       
</div>
</div>
</section>