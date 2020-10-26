
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
                    
                    echo '<div class="alert alert-success alert-dismissible" role="alert">
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
                   <th>Nama Pelanggan</th>
                   <td><input type="text" name="nama_pelanggan"
                   class="form-control" value="<?= $profil['nama_pelanggan'] ?>" placeholder="Nama Pelanggan"></td>
               </tr>
               <tr>
                   <th>Email</th>
                   <td><input type="text" name="email"
                   class="form-control" value="<?= $profil['email'] ?>" placeholder="Password"  readonly>

                </td>   
               </tr>
               <tr>
                   <th>Telepon</th>
                   <td><input type="number" name="telepon"
                   class="form-control" value="<?= $profil['telepon'] ?>" placeholder="Nama Pelanggan" ></td>
               </tr>
               <tr>
                   <th></th>
                   <td> <h6> <i style="color:red">*Alamat pengiriman dapat diganti ketika melakukan <strong>proses pesanan</strong></i></p></h6></td>
               </tr>
               <tr>
                   <th></th>
                   <td>
                       <button class="btn btn-outline-success btn-lg" id="edit" name="edit"  type="submit"><i class="fa fa-save"></i>&nbsp;Edit</button>
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