<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#"><?= $title ?></a>
        </li>
        <li class="breadcrumb-item active">Harmony Sistem</li>
    </ol>

   
        <div class="col-lg">
        <?= $this->session->flashdata('notifTransaksi'); ?>
        </div>
   

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">List Data Transaksi</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Total</th>
                            <th>Status Bayar</th>   
                            <th>Status Pengiriman</th>
                            <?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98 or $this->session->userdata('id_jabatan') == 1 or $this->session->userdata('id_jabatan') == 2) { ?>
                            <th>Pengiriman</th>     
                            <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($transaksi as $u) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $u->order_id ?></td>
                                <td><?php echo $u->tanggal_transaksi ?></td>
                                <td><?= $u->total_item ?></td>
                                <td>Rp.<?= number_format($u->sub_total, '0',',','.') ?></td>
                                <td>Rp.<?= number_format($u->total, '0',',','.') ?></td>
                            
                                <td><?= $u->transaction_status ?></td>
                                <td><?= $u->pengiriman ?></td>
                                <?php if ($this->session->userdata('id_jabatan') == 99 or $this->session->userdata('id_jabatan') == 98 or $this->session->userdata('id_jabatan') == 1 or $this->session->userdata('id_jabatan') == 2) { ?>
                               <td>
                               <?php if ($u->transaction_status == 'pending') { ?>
                                <button disabled class="badge badge-warning">pending</button>
                               <?php } elseif ($u->transaction_status == 'settlement' and $u->pengiriman == 'pending') { ?>
                                <a href="<?= base_url('admin/transaksi/dikemas/'.encrypt_url($u->id_transaksi)) ?>" id="dikemas" class="badge badge-dark">dikemas</a>
                               <?php } elseif ($u->transaction_status == 'settlement' and $u->pengiriman == 'dikemas') { ?>
                                <a href="<?= base_url('admin/transaksi/dikirim/'. encrypt_url($u->id_transaksi)) ?>" id="dikirim" class="badge badge-success">dikirim</a>
                               <?php } elseif ($u->transaction_status == 'settlement' and $u->pengiriman == 'dikirim') { ?>
                                <a href="<?= base_url('admin/transaksi/selesai/'. encrypt_url($u->id_transaksi)) ?>" id="selesai" class="badge badge-primary">selesai</a>
                               <?php } else if ($u->transaction_status == 'expire') { ?>
                                <a href="<?= base_url('admin/transaksi/expire/'.encrypt_url($u->id_transaksi)) ?>" class="badge badge-warning">dibatalkan</a>
                               <?php } else { ?>
                                <a href="<?= base_url('admin/transaksi/expire/'.encrypt_url($u->id_transaksi)) ?>"  class="badge badge-danger">dibatalkan</a>
                               <?php } ?>
                               </td>
                                <td>
                                <a href="<?= base_url('admin/transaksi/detail/'. encrypt_url($u->id_transaksi)) ?>" class="badge badge-info">Detail</a>
                                </td>
                               <?php } ?>

                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
</div>
