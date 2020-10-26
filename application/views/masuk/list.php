
<!-- Cart -->
<section class=" bgwhite p-t-70 p-b-100">
<div class="container">
<!-- Cart item -->
<div class=" pos-relative">
<div class=" bgwhite">
    <h2><?= $title ?></h2>
    <hr>
    <div class="clearfix"></div>
    <?php if ($this->session->flashdata('sukses')
    ) {
     
        echo '<div class="alert alert-warning alert-dismissible" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
       </button>';
       echo $this->session->flashdata('sukses');
       echo '</div>';
      
    } ?>
     <p class="alert alert-warning">Tidak memiliki akun? Silahkan
        <a href="<?= base_url('registrasi') ?>" class="btn btn-info" >Daftar disini</a>
    </p>
    
   <div class="col-md-12">
       <?=
        validation_errors('<div class="alert alert-warning">','</div>');
       ?>
      <form action="" method="post" accept-charset="utf-8">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
       <table class="table table-bordered">
           <tbody>
               <tr>
                   <th>Email</th>
                   <td><input type="text" name="email"
                   class="form-control" value="<?= set_value('email') ?>" placeholder="Email" required></td>
               </tr>
               <tr>
                   <th>Password</th>
                   <td><input type="password" name="password"
                   class="form-control" value="<?= set_value('password') ?>" placeholder="Password" required>

                </td>   
               </tr>
           
               <tr>
                   <th></th>
                   <td>
                       <button class="btn btn-success btn-lg"  type="submit"><i class="fa fa-lock"></i>&nbsp;Login</button>
                       
                   </td>
               </tr>
           </tbody>
       </table>
      </form>
   </div>
   
</div>
</div>

</div>
</div>
</section>