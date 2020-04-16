<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
          <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PT Harmony Sistem</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider ">
      <!-- Heading -->
      <div class="sidebar-heading">
        Home
      </div>
      <!-- Nav Item - Dashboard -->
      <li class="<?php if ($this->uri->segment(2) == "beranda") {
                    echo "nav-item active";
                  } else {
                    echo "nav-item";
                  } ?>">
        <a class="nav-link " href="<?= base_url('admin/beranda') ?>">
          <i class="fas fa-fw fa-home"></i>
          <span>Beranda</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Profile
      </div>
      <li class="<?php if ($this->uri->segment(2) == "profil") {
                    echo "nav-item active";
                  } else {
                    echo "nav-item";
                  } ?>">
        <a class="nav-link " href="<?= base_url('admin/profil') ?>">
          <i class="fas fa-user"></i>
          <span>Profile</span></a>
      </li>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Karyawan
      </div>

      <!-- Nav Item - Charts -->
      <li class="<?php if ($this->uri->segment(2) == "karyawan") {
                    echo "nav-item active";
                  } else {
                    echo "nav-item";
                  } ?>">
        <a class="nav-link" href="<?= base_url('admin/karyawan') ?>">
          <i class="fas fa-address-card"></i>
          <span>Karyawan</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pelanggan
      </div>

      <!-- Nav Item - Charts -->
      <li class="<?php if ($this->uri->segment(2) == "pelanggan") {
                    echo "nav-item active";
                  } else {
                    echo "nav-item";
                  } ?>">
        <a class="nav-link" href="<?= base_url('admin/pelanggan') ?>" >
          <i class="fas fa-users"></i>
          <span>Pelanggan</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>
      <li class="nav-item">
        <a class="nav-link" href="">
          <i class="fas fa-shopping-cart"></i>
          <span>Transaksi Penjualan</span></a>
      </li>
       <!-- Nav Item - Charts -->
          <li class="<?php if ($this->uri->segment(2) == "rekening") {
                    echo "nav-item active";
                  } else {
                    echo "nav-item";
                  } ?>">
            <a class="nav-link" href="<?= base_url('admin/rekening') ?>" >
            <i class="fas fa-money-check-alt"></i>
              <span>Data Rekening</span></a>
          </li>
      <li class="<?php if ($this->uri->segment(2) == "produk") {
                    echo "nav-item active";
                  } else {
                    echo "nav-item";
                  } ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-balance-scale"></i>
          <span>Produk</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Produk:</h6>
            <a class="collapse-item" href="<?= base_url('admin/produk/tambah') ?>"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Tambah Produk</a>
            <a class="collapse-item" href="<?= base_url('admin/produk') ?>"><i class="fas fa-calculator"></i>&nbsp;&nbsp;&nbsp;Data Produk</a>
            <a class="collapse-item" href="<?= base_url('admin/kategori') ?>"><i class="fas fa-tags"></i>&nbsp;&nbsp;Kategori Produk</a>
          </div>
        </div>
      </li>

      <li class="<?php if ($this->uri->segment(2) == "konfigurasi") {
                    echo "nav-item active";
                  } else {
                    echo "nav-item";
                  } ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-cogs"></i>
          <span>Konfigurasi</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header ">Konfigurasi:</h6>
            <a class="collapse-item" href="<?= base_url('admin/konfigurasi') ?>"><i class="fas fa-cog"></i> &nbsp;&nbsp;Konfigurasi Umum</a>
            <a class="collapse-item" href="<?= base_url('admin/konfigurasi/logo') ?>"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;Konfigurasi Logo</a>
            <a class="collapse-item" href="<?= base_url('admin/konfigurasi/icon') ?>"><i class="fas fa-icons"></i>&nbsp;&nbsp;Konfigurasi Icon</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Laporan Transaksi
      </div>

      <!-- Nav Item - Charts -->

      <li class="nav-item">
        <a class="nav-link" href="">
          <i class="fas fa-atlas"></i>
          <span>Laporan Transaksi</span></a>
      </li>


      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Logout
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-power-off"></i>
          <span>Logout</span></a>
      </li>
      <p></p>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <p></p>
      <p></p>
      <p></p>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->