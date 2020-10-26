
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
               
                <table class="table table-bordered" width="100%" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Transaksi</th>
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
                            <td><?= $u->order_id ?></td>
                            <td><?= $u->tanggal_transaksi ?></td>
                            <td><?= $u->total_item ?></td>
                            <td>Rp.<?= number_format($u->sub_total, '0',',','.') ?></td>
                            <td>Rp.<?= number_format($u->total, '0',',','.') ?></td>
                           
                            <td><?= $u->transaction_status ?></td>
                            
                            <td>
                                <div class="btn-group">
                                <a href="<?= base_url('beranda/detail/'. encrypt_url($u->id_transaksi)) ?>"
                                class="btn btn-info btn-sm"><i class="fa fa-eye"></i>&nbsp;Detail</a>&nbsp;
                                <!-- <a href="<?= base_url('beranda/konfirmasi/'. encrypt_url($u->id_transaksi)) ?>"
                                class="btn btn-success btn-sm"><i class="fa fa-upload"></i>&nbsp;Konfirmasi Bayar</a> -->
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                <?= $pagin ?>
            <?php } else { ?>
                <p class="alert alert-success">
                    Belum ada data Transaksi
                </p>
            <?php } ?>
        </div>
        
       
</div>
</div>
</section>