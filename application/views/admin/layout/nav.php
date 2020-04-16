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
         <!-- Nav Item - Search Dropdown (Visible Only XS) -->
         <li class="nav-item dropdown no-arrow d-sm-none">
           <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-search fa-fw"></i>
           </a>
           <!-- Dropdown - Messages -->
           <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
             <form class="form-inline mr-auto w-100 navbar-search">
               <div class="input-group">
                 <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                 <div class="input-group-append">
                   <button class="btn btn-primary" type="button">
                     <i class="fas fa-search fa-sm"></i>
                   </button>
                 </div>
               </div>
             </form>
           </div>
         </li>

         <!-- Nav Item - Alerts -->

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