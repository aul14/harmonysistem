
        <!-- Product -->
            <h2><?= $title ?></h2>
            <br>
            <?php foreach($nama as $nama) { ?>
            <p>Berikut adalah Detail Transaksi <?= $nama->id_pelanggan ?></p>
            <?php } ?>
            <br>
            <?php if($header_transaksi) { ?>

                <table class="table table-bordered" width="100%" >
                    <thead>
                        <tr>
                            <th>Kode Transaksi</th>
                            <th><?= $header_transaksi->order_id ?></th>
                
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
                            <td>Tipe Pembayaran</td>
                            <td><?= $header_transaksi->payment_type ?></td>
                        </tr>
                        <tr>
                            <td>Nama Bank atau Kode Bank</td>
                            <td><?= $header_transaksi->nama_bank_pelanggan ?> <?= $header_transaksi->biller_code ?></td>
                        </tr>
                        <tr>
                            <td>VA Number</td>
                            <td><?= $header_transaksi->va_number ?> <?= $header_transaksi->bill_key ?> <?= $header_transaksi->permata_va_number ?></td>
                        </tr>
                        <?php foreach($midtrans as $m) { 
                        $id = $m->order_id;
                        if($m->transaction_status == 'pending'){
                   
                            $cek=$this->Konfigurasi_model->cekstatus($id);
                            // echo $m->transaction_status."-".$cek['transaction_status'];
                            if($cek['transaction_status'] != 'pending'){
                              // echo "JALANKAN UPDATE";
                              $update = $this->Konfigurasi_model->update_midtrans($cek['order_id'],$cek['transaction_status']);
                              
                            } 
                            
                          }
                        ?>
                        <tr> 
                            <td>Status Pembayaran</td>
                            <td><?= $m->transaction_status ?></td>
                           
                        </tr>
                        <?php } ?>
                        <?php foreach($midtrans as $m) { 
                          $id = $m->order_id;
                          if($m->transaction_status == 'settlement'){
                              $cek=$this->Konfigurasi_model->cekstatus($id);
                               if($cek['transaction_status'] == 'deny') {
                                $data = [
                                    'pengiriman'=>'dibatalkan',
                                    'transaction_status' => 'deny'
                                  ];
                                  $this->db->update('transaksi',$data,['order_id'=>$id]);
                              }  else if($cek['transaction_status'] == 'expire') {
                                $data = [
                                    'pengiriman'=>'dibatalkan',
                                    'transaction_status' => 'expire'
                                  ];
                                  $this->db->update('transaksi',$data,['order_id'=>$id]);
                              }    
                          } 
                        ?>
                        
                        <tr>
                            <td>Pengiriman</td>
                            <td><?= $m->pengiriman ?></td>
                           
                               
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>Kembali</td>
                            <td><a href="<?= base_url('admin/transaksi') ?>" class="btn btn-outline-success btn-sm" >Kembali&nbsp;<i class="fa fa-arrow-right"></i></a>
                        </td>
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

       
