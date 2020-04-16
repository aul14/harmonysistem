
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
            <p>Berikut adalah Detail Belanja <?= $this->session->userdata('nama_pelanggan') ?></p>
            <br>
            <?php if($header_transaksi) { ?>

                <table class="table table-bordered" width="100%" >
                    <thead>
                        <tr>
                            <th>Kode Transaksi</th>
                            <th><?= $header_transaksi->kode_transaksi ?></th>
                
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td><?= $header_transaksi->tanggal_transaksi ?></td>
                        </tr>
                        <tr>
                            <td>Total Pembayaran</td>
                            <td>Rp. <?= number_format($header_transaksi->total, '0',',','.') ?></td>
                        </tr>
                        <tr>
                            <td>Alamat Pengiriman</td>
                            <td><?= $header_transaksi->alamat_pengiriman ?></td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td><?= $header_transaksi->status_bayar ?></td>
                        </tr>
                      
                    </tbody>
                </table>

                <table class="table table-bordered" width="100%" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($transaksi as $u) { ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $u->kode_produk ?></td>
                            <td><?= $u->nama_produk ?></td>
                            <td><?= $u->qty ?></td>
                            <td>Rp.<?= number_format($u->harga, '0',',','.') ?></td>
                            <td>Rp.<?= number_format($u->total_harga, '0',',','.') ?></td>
                            
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

       
</div>
</div>
</section>