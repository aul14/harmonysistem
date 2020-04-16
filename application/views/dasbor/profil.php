
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
            <div class="row mb-3 col-lg-6">
                <a class="nav-link btn btn-info bg-info mr-3" href="#">
                    <i class="fa fa-edit"></i>
                    <span>Edit Profil</span></a>
                <a class="nav-link btn btn-info bg-primary mr-3" href="#">
                    <i class="fa fa-key"></i>
                    <span>Ganti Password</span></a>
            </div>
                <?= $this->session->flashdata('sukses'); ?>

            <div class="card mb-3 " style="max-width: 440px;">
            <div class="card-body">
                    <h5 class="card-title"><?= $pelanggan->nama_pelanggan ?></h5>
                    <p class="card-text">Pelanggan</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email: <?= $pelanggan->email ?></li>
                    <li class="list-group-item">Telepon: <?= $pelanggan->telepon ?></li>
                    <li class="list-group-item">Alamat: <?= $pelanggan->alamat ?></li>
                </ul>
                <div class="card-body">
                <small class="text-muted">Tanggal Pendaftaran:  <?= $pelanggan->pelanggan_daftar ?></small>
                </div>
            </div>


        </div>

       
</div>
</div>
</section>