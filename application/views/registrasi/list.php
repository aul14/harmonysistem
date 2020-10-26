<script type="text/javascript" src="ajax_daerah.js"></script>

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
       echo '<div class="alert alert-danger alert-dismissible" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
       </button>';
       echo $this->session->flashdata('sukses');
       echo '</div>';
    } ?>
     <p class="alert alert-warning">Sudah memiliki akun? Silahkan
        <a href="<?= base_url('masuk') ?>" class="btn btn-info" >Login disini</a>
    </p>
   <div class="col-md-12">
       <?=
        validation_errors('<div class="alert alert-warning">','</div>');
       ?>
      <form action="" method="post" accept-charset="utf-8">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
       <table class="table">
           <thead>
               <tr>
                   <th>Nama Pelanggan</th>
                   <th><input type="text" name="nama_pelanggan"
                   class="form-control" value="<?= set_value('nama_pelanggan') ?>" placeholder="Nama Lengkap" required></th>
               </tr>
           </thead>
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
                   <br>
                   <h6> <i style="color:red">*Minimum 8 karakter termasuk A-Z, a-z, dan 1-9</i></p></h6>
                  </td>
               </tr>
           
               <tr>
                   <th>Telepon</th>
                   <td><input type="number" name="telepon"
                   class="form-control" value="<?= set_value('telepon') ?>" placeholder="Telepon" required></td>
               </tr>
               <tr>
                   <th>Alamat</th>
                   <td><textarea name="alamat" class="form-control" placeholder="Alamat" <?= set_value('alamat') ?> ></textarea></td>
               </tr>
               <tr>
                   <th>Provinsi</th>
                   <td>
                       <select name="id_prov" id="prop" onchange="ajaxkota(this.value)" class="form-control">
                           <option value="">Pilih Provinsi</option>
                           <?php 
                                foreach($provinsi as $data){
                                    echo '<option value="'.$data->id_prov.'">'.$data->nama.'</option>';
                                }
                                ?>
                       </select>
                </td>
               </tr>
               <tr>
                   <th>Kota / Kabupaten</th>
                   <td>
                      <select name="id_kab" id="kota" onchange="ajaxkec(this.value)" class="form-control">
                        <option value="">Pilih Kota/Kabupaten</option>
                        </select>
                   </td>
               </tr>
               <tr>
                   <th>Kecamatan</th>
                   <td>
                   <select name="id_kec" id="kec"  onchange="ajaxkel(this.value)" class="form-control">
                    <option value="">Pilih Kecamatan</option>
                   </td>
               </tr>
               <tr>
                   <th>Kelurahan / Desa</th>
                   <td>
                   <select name="id_kel" id="kel" class="form-control" onchange="showCoordinate();">
                    <option value="">Pilih Kelurahan/Desa</option>
                    </select>
                   </td>
               </tr>
               <tr>
                   <th>Kode Pos</th>
                   <td><input type="number" name="kode_pos"
                   class="form-control" value="<?= set_value('kode_pos') ?>" placeholder="Kode Pos" required></td>
               </tr>
              
               <tr>
                   <th></th>
                   <td>
                       <button class="btn btn-success btn-lg"  type="submit"><i class="fa fa-send"></i>&nbsp;Daftar</button>
                       <button class="btn btn-warning btn-lg" type="reset"><i class="fa fa-close"></i>&nbsp;Batal</button>
                   </td>
               </tr>
           </tbody>
       </table>
      </form>
   </div>
   
</div>
</div>




<!-- 
<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
    <span class="s-text18 w-size19 w-full-sm">
        Shipping:
    </span>

    <div class="w-size20 w-full-sm">
        <p class="s-text8 p-b-23">
            There are no shipping methods available. Please double check your address, or contact us if you need any help.
        </p>

        <span class="s-text19">
            Calculate Shipping
        </span>

        <div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
            <select class="selection-2" name="country">
                <option>Select a country...</option>
                <option>US</option>
                <option>UK</option>
                <option>Japan</option>
            </select>
        </div>

        <div class="size13 bo4 m-b-12">
        <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
        </div>

        <div class="size13 bo4 m-b-22">
            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">
        </div>

        <div class="size14 trans-0-4 m-b-10">
            <!-- Button -->
            <!-- <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                Update Totals
            </button>
        </div>
    </div>
</div> --> 

<!--  -->



</div>
</div>
</section>