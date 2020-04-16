<script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-G8fuQnJ6BOmSixfK"></script>
 <script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
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
            <p>Berikut adalah Riwayat Belanja <?= $this->session->userdata('nama_pelanggan') ?></p>
            <br>
            <?php if($header_transaksi) { ?>
                <form id="payment-form" method="post" action="<?=site_url()?>/snap/finish">
                <input type="hidden" name="result_type" id="result-type" value="">
                <input type="hidden" name="result_data" id="result-data" value="">
                </form>
                <table class="table table-bordered" width="100%" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Total</th>
                            <th>Status Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($header_transaksi as $u) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $u->kode_transaksi ?></td>
                            <td><?= $u->tanggal_transaksi ?></td>
                            <td><?= $u->total_item ?></td>
                            <td>Rp.<?= number_format($u->sub_total, '0',',','.') ?></td>
                            <td>Rp.<?= number_format($u->total, '0',',','.') ?></td>
                            <td><?= $u->status_bayar ?></td>
                            <td>
                                <div class="btn-group">
                                <button id="pay-button" class="btn btn-warning btn-sm">Pay!</button>
                                <a href="<?= base_url('beranda/detail/'. encrypt_url($u->id_transaksi)) ?>"
                                class="btn btn-info btn-sm"><i class="fa fa-eye"></i>&nbsp;Detail</a>&nbsp;
                                <a href="<?= base_url('beranda/konfirmasi/'. encrypt_url($u->id_transaksi)) ?>"
                                class="btn btn-success btn-sm"><i class="fa fa-upload"></i>&nbsp;Konfirmasi Bayar</a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>

            <?php } else { ?>
                <p class="alert alert-success">
                    Belum ada data Transaksi
                </p>
            <?php } ?>
        </div>
        <script type="text/javascript">
  
  $('#pay-button').click(function (event) {
    event.preventDefault();
    $(this).attr("disabled", "disabled");
  
  $.ajax({
    url: '<?=site_url()?>/snap/token',
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
    }
  });
});

</script>
       
</div>
</div>
</section>