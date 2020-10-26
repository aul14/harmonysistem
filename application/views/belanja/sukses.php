
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
    <p class="alert alert-success">
        Terima Kasih telah berbelanja, Barang akan kami proses
    </p>
    <div class="col-md-12">
       <?=
        validation_errors('<div class="alert alert-warning">','</div>');
       ?>
       <table class="table table-bordered">
           <tbody>
               <tr>
                   <th>No. Transaksi</th>
                   <td><?= $detail['order_id']; ?></td>
               </tr>
               <tr>
                   <th>Tgl. Transaksi</th>
                   <td><?= $detail['tanggal_bayar'] ?></td>   
               </tr>
               <tr>
                   <th>Nama</th>
                   <td><?= $detail['nama_pemilik_pelanggan'] ?></td>
               </tr>
               <tr>
                   <th>Jenis Pembayaran</th>
                   <td><?= $detail['payment_type'] ?></td>
               </tr>
               <tr>
                   <th>Kode Pembayaran</th>
                   <td><?= $detail['va_number'] ?> <?= $detail['bill_key'] ?> <?= $detail['permata_va_number'] ?> <?= $detail['payment_code'] ?></td>
               </tr>
               <tr>
                   <th>Status Transaksi</th>
                   <td><?= $detail['transaction_status'] ?></td>
               </tr>
               <tr>
                   <th>Pengiriman</th>
                   <td><?= $detail['pengiriman'] ?></td>
               </tr>
           
               <tr>
                   <th></th>
                   <td>
                       <a href="<?= $detail['cara_bayar'] ?>" class="btn btn-success btn-lg"  type="submit"><i class="fa fa-download"></i>&nbsp;Download Intruksi Pembayaran</a>
                       <a href="<?= site_url('beranda/belanja') ?>" class="btn btn-warning btn-lg" type="reset"><i class="fa fa-arrow-right"></i>&nbsp;Kembali Riwayat Belanja</a>
                   </td>
               </tr>
           </tbody>
       </table>
  
   </div>
</div>
</div>

</div>
</div>
</section>