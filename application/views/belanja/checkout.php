<script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-G8fuQnJ6BOmSixfK"></script>
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
<div class="container">
<!-- Cart item -->
<div class="container-table-cart pos-relative">
<div class="wrap-table-shopping-cart bgwhite">
    <h2><?= $title ?></h2>
    <hr>
    <div class="clearfix"></div>
    <?php if ($this->session->flashdata('sukses')
    ) {
       echo '<div class="alert alert-warning">';
       echo $this->session->flashdata('sukses');
       echo '</div>';
    } ?>
    <table class="table-shopping-cart">
        <tr class="table-head">
            <th class="column-1">Gambar</th>
            <th class="column-2">Produk</th>
            <th class="column-3">Harga Satuan</th>
            <th class="column-4 p-l-70">Quantity</th>
            <th class="column-5">Total</th>
            <th class="column-6" width="20%" >Update & Hapus Keranjang</th>
        </tr>
        <?php 
       

        foreach($keranjang as $keranjang) { 
            $id_produk = $keranjang['id'];
            $produk = $this->Produk_model->detail($id_produk);

            echo form_open(base_url('belanja/update_cart/'.$keranjang['rowid']));
            
               
         ?>
        <tr class="table-row">
            <td class="column-1">
                <div class="cart-img-product b-rad-4 o-f-hidden">
                    <img src="<?= base_url('assets/upload/produk/thumbs/'.$produk->gambar) ?>" alt="<?= $keranjang['name'] ?>">
                </div>
            </td>
            <td class="column-2"><?= $keranjang['name'] ?></td>
            <td class="column-3">Rp.<?= number_format($keranjang['price'],'0',',','.') ?></td>
            <td class="column-4 p-l-60">
                <div class="flex-w bo5 of-hidden w-size17">
                    <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                        <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                    </button>

                    <input class="size8 m-text18 t-center num-product" type="number" name="qty" value="<?= $keranjang['qty'] ?>">

                    <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                        <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
            </td>
            <td class="column-5">Rp.<?= number_format($keranjang['subtotal'],'0',',','.')  ?> </td>
            <td class="column-6 p-l-20">
                <button type="submit" name="update" class="btn btn-info btn-sm">
                    <i class="fa fa-edit"></i> Update
                </button>
                <a href="<?=  base_url('belanja/hapus/'.$keranjang['rowid']) ?>" type="submit" name="hapus" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php 
        echo form_close();

        } 
        ?>
         
    </table>
</div>
</div>
<!-- Total -->
<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
<h5 class="m-text20 p-b-24">
    Cart Totals
</h5>

<!--  -->
<div class="flex-w flex-sb-m p-b-12">
    <span class="s-text18 w-size19 w-full-sm">
        Subtotal:
    </span>

    <span class="m-text21 w-size20 w-full-sm">
            Rp. <?= number_format($this->cart->total(),'0',',','.') ?>

    </span>
</div>

<div class="flex-w flex-sb-m p-t-26 p-b-30">
    <span class="m-text22 w-size19 w-full-sm">
        Total:
    </span>

    <span class="m-text21 w-size20 w-full-sm">
    Rp. <?= number_format($this->cart->total(),'0',',','.') ?>
    </span>
</div>
</div>
<br>
<div class="container-table-cart pos-relative">
<div class="wrap-table-shopping-cart bgwhite">
<form id="payment-form" method="post" action="<?=site_url()?>snap/finish" accept-charset="utf-8">
      <input type="hidden" name="result_type" id="result-type" value=""></div>
      <input type="hidden" name="result_data" id="result-data" value=""></div>
    
<?php

$kode = $this->transaksi_model->get_no_invoice();
?>
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="id_pelanggan" value="<?= $pelanggan->id_pelanggan ?>">
    <input type="hidden" name="total" value="<?= $this->cart->total() ?>">
    <input type="hidden" name="sub_total" value="<?= $this->cart->total() ?>">
    <input type="hidden" name="tanggal_transaksi" value="<?= date('Y-m-d'); ?>">
<table class="table">
           <thead>
               <tr>
                   <th>Kode Transaksi</th>
                   <th><input type="text" name="order_id"
                   class="form-control" value="<?= $kode ?>" placeholder="Nama Lengkap" required readonly></th>
               </tr>
               <tr>
                   <th>Nama Penerima</th>
                   <th><input type="text" name="nama_pelanggan"
                   class="form-control" value="<?= $pelanggan->nama_pelanggan ?>" placeholder="Nama Lengkap" required readonly></th>
               </tr>
           </thead>
           <tbody>
               <tr>
                   <th>Email Penerima</th>
                   <td><input type="text" name="email"
                   class="form-control" value="<?= $pelanggan->email ?>" placeholder="Email" required readonly></td>
               </tr>
                        
               <tr>
                   <th>Telepon Penerima</th>
                   <td><input type="text" name="telepon"
                   class="form-control" value="<?= $pelanggan->telepon ?>" placeholder="Telepon" required readonly></td>
               </tr>
               <tr>
                   <th>Alamat Pengiriman</th>
                   <td><textarea name="alamat_pengiriman"  class="form-control" id="alamat" placeholder="Alamat" ><?= $pelanggan->alamat ?>, <?= $pelanggan->id_kab ?>, <?= $pelanggan->id_kec ?>, <?= $pelanggan->id_kel ?>, <?= $pelanggan->id_prov ?>, <?= $pelanggan->kode_pos ?> </textarea></td>
               </tr>
              
               <tr>
                   <th></th>
                   <td>
                       <button id="pay-button" class="btn btn-success btn-lg"  type="submit"><i class="fa fa-save"></i>&nbsp;Pembayaran</button>
                       <a href="<?= site_url('belanja') ?>" class="btn btn-warning btn-lg" type="reset">Kembali&nbsp;<i class="fas fa-arrow-right"></i></a>
                   </td>
               </tr>
           </tbody>
       </table>
</form>
</div>
<hr>


</div>


</div>
<script type="text/javascript">
  
  $('#pay-button').click(function (event) {
    event.preventDefault();
    $(this).attr("disabled", "disabled");
  
  $.ajax({
    url: '<?=site_url()?>snap/token/',
    cache: false,

    success: function(data) {
      //location = data;

      console.log('token = '+data);
      
      var resultType = document.getElementById('result-type');
      var resultData = document.getElementById('result-data');

      function changeResult(type,data){
        $("#result-type").val(type);
        $("#result-data").val(JSON.stringify(data));
        //resultType.innerHTML = type;
        //resultData.innerHTML = JSON.stringify(data);
      }

      snap.pay(data, {
        
        onSuccess: function(result){
          changeResult('success', result);
          console.log(result.status_message);
          console.log(result);
          $("#payment-form").submit();
        },
        onPending: function(result){
          changeResult('pending', result);
          console.log(result.status_message);
          $("#payment-form").submit();
        },
        onError: function(result){
          changeResult('error', result);
          console.log(result.status_message);
          $("#payment-form").submit();
        }
      });
    },
    error: function (e) { 
        console.log(e);
     }
  });
});

</script>
</section>