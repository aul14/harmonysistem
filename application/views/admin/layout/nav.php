 <!-- Content Wrapper -->
 <div id="content-wrapper" class="d-flex flex-column">

   <!-- Main Content -->
   <div id="content">
     <!-- <div id="content"> -->

     <!-- Topbar -->
     <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


       <!-- Topbar Navbar -->
       <marquee scrollamount="8"><strong style="color:lawrence;">Selamat Datang di Halaman Admin Penjualan Harmony Sistem</strong></marquee>
       <ul class="navbar-nav ml-auto">
         
          <!-- Nav Item - Alerts -->
          <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <?php foreach($hitung as $u) { ?>
                <span class="badge badge-danger badge-counter"><?= $u->total ?></span>
                <?php } ?>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Pengiriman Belum dikemas
                </h6>
              <?php foreach($transaksi3 as $u) { ?>
                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('admin/transaksi/detail/'. encrypt_url($u->id_transaksi)) ?>">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="<?= base_url('assets/upload/konfigurasi/warning.png') ?>" alt="">

                  </div>
                  <div>
                    <div class="small text-gray-500"><?= $u->tanggal_transaksi ?></div>
                   Kode Transaksi   : <?= $u->order_id ?>
                   Status Pengiriman: <?= $u->pengiriman ?>
                   <p> <i style="color:red">*Silahkan lakukan pengemasan agar pelanggan tidak menunggu.</i></p>
                  </div>
                </a>
              <?php } ?>
                <a class="dropdown-item text-center small text-gray-500" href="<?= base_url('admin/transaksi') ?>">Lihat Semua Transaksi</a>
              </div>
            </li>
          <!-- Nav Item - Messages -->
          <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <?php foreach($pesan as $p) { ?>
                <span class="badge badge-danger badge-counter"><?= $p->totalPesan ?></span>
                <?php } ?>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Pesan Masuk
                </h6>
                <?php foreach($tbl_pesan as $ps) { ?>
                <a class="dropdown-item d-flex align-items-center" href="<?= base_url('admin/pesan/balas/'. $ps->id_pesan) ?>">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="<?= base_url('assets/upload/user/default.jpg') ?>" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  
                  <div class="font-weight-bold">
                    <div class="text-truncate"><?= $ps->pesan ?> </div>
                    <div class="small text-gray-500"><?= $ps->email_pesan ?></div>
                  </div>
                  
                </a>
                <?php } ?>
                <a class="dropdown-item text-center small text-gray-500" href="<?= site_url('admin/pesan') ?>">Lihat Semua Pesan</a>
              </div>
            </li>

         <!-- Nav Item - Alerts -->
         <div class="topbar-divider d-none d-sm-block"></div>

         <!-- Nav Item - User Information -->
         <li class="nav-item dropdown no-arrow">
           <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <img class="img-profile rounded-circle" src="<?= base_url('assets/upload/user/') .$karyawan['foto']; ?>"><span>&nbsp;&nbsp;</span>
             <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <strong style="color:black;">
                 <?=
                    $karyawan['nama_karyawan'];
                  ?>
               </strong></span>

           </a>
           <!-- Dropdown - User Information -->
           <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
             <a class="dropdown-item" href="<?php echo site_url('admin/profil') ?>">
               <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
               Profile
             </a>

             <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
               <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
               Keluar
             </a>
           </div>
         </li>

       </ul>

     </nav>
     <!-- End of Topbar -->