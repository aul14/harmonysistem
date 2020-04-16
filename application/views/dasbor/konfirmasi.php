
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
            <p>Berikut adalah Konfirmasi Pembayaran <?= $this->session->userdata('nama_pelanggan') ?></p>
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
                            <td>Status Pembayaran</td>
                            <td><?= $header_transaksi->status_bayar ?></td>
                        </tr>
                      
                    </tbody>
                </table>
                <?php 
                if (isset($error)) {
                    echo '<p class="alert alert-warnig">'.$error.'</p>';
                }
                echo validation_errors('<p class="alert alert-warnig"></p>');  
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>Pembayaran ke Rekening</td>
                                <td>
                               <div class="form-check col-md-10">
                               <?php foreach($rekening as $u) { ?>
                                <input class="form-check-input" type="radio" name="id_rekening" onclick="displayResult(this.value)" data-toggle="collapse" data-target="#rekening"value="<?= $u->id_rekening ?>" required>
                                <label class="form-check-label" for="exampleRadios1">
                                <img src="<?= base_url('assets/upload/rekening/' . $u->gambar) ?>" class="img img-responsive img-thumbnail" width="50" >&nbsp; <strong><?= $u->nama_bank ?>,  No. Rekening: <?= $u->nomor_rekening ?> a.n <?= $u->nama_pemilik ?> </strong>
                                
                                </label>
                                <?php } ?>
                                </div>
                                </div>
                               </td>  
                            </tr>
                        </tbody>
                        <tbody>
                            <!-- <tr>
                                <td></td>
                                <td>
                                <div id="rekening" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                
                                <div class="card-body">
                                <img src="<?= base_url('assets/upload/rekening/' . $u->gambar) ?>" class="img img-responsive img-thumbnail" width="50">  
                                <?= $u->nama_bank ?>, No. Rekening: <?= $u->nomor_rekening ?> a.n <?= $u->nama_pemilik ?>
                                </div>
                                </div>
                                </td>
                            </tr> -->
                            <tr>
                                <td>Nama Rekening Pelanggan</td>
                                <td>
                                    <input type="text" name="nama_bank" value="<?= set_value('nama_bank') ?>" 
                                    placeholder="Nama Rekening">
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Rekening</td>
                                <td>
                                    <input type="text" name="rekening_pembayaran" value="<?= set_value('rekening_pembayaran') ?>" 
                                    placeholder="Nomor Rekening">
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Pemilik</td>
                                <td>
                                    <input type="text" name="rekening_pelanggan" value="<?= set_value('rekening_pelanggan') ?>" 
                                    placeholder="Nama Pemilik" required>

                                </td>
                            </tr>
                            <tr>
                                <td>Upload Bukti Pembayaran</td>
                                <td>
                                    <input type="file" name="gambar" 
                                    placeholder="Upload Bukti Bayar">
                                    <h6> <i style="color:red">*Format file png,jpg,jpeg</i></p></h6>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><div class="alert alert-default">
                                        <h4>Peringatan!!</h4>
                                        <hr>
                                        <strong><p>1. Jumlah Pembayaran harus sesuai dengan total pembayaran.</p></strong>
                                        <strong><p>2. Pembayaran yang tidak mengirimkan bukti pembayaran tidak akan diproses lebih lanjut.</p></strong>
                                        <strong><p>3. Pembayaran yang kurang dari total pembayaran tidak akan diproses lebih lanjut.</p></strong>
                                        <strong><p>4. Pembayaran yang lebih tidak akan dikembalikan.</p></strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-info btn-lg" type="submit" name="submit">
                                            <i class="fa fa-upload">&nbsp;Kirim</i>
                                        </button>
                                        <button class="btn btn-warning btn-lg" type="reset">
                                            <i class="fa fa-close">&nbsp;Reset</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>

            <?php } else { ?>
                <p class="alert alert-success">
                    Belum ada data Transaksi
                </p>
            <?php } ?>
        </div>

       
</div>
</div>
</section>