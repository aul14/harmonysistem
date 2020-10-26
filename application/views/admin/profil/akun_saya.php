<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"></h1>

    <div class="row">
        <div class="col-lg-6">
            
        </div>
    </div>
    <ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="">Profil</a>
	</li>
	<li class="breadcrumb-item active" aria-current="page">Harmony Sistem</li>
</ol>
    <div class="row mb-3 col-lg-6">
        <a class="nav-link btn btn-info bg-lawrence mr-3" href="<?= base_url('admin/profil/edit/') . encrypt_url($karyawan['id_karyawan']) ?>">
            <i class="fas fa-fw fa-user-edit"></i>
            <span>Edit Profil</span></a>
        <a class="nav-link btn btn-info bg- mr-3" href="<?= base_url(); ?>admin/profil/gantipassword">
            <i class="fas fa-fw fa-key"></i>
            <span>Ganti Password</span></a>
    </div>
    <div class="col-lg">
      <?= $this->session->flashdata('notifProfil'); ?>
    </div>
    <div class="card " style="max-width: 640px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/upload/user/') . $karyawan['foto']; ?>" style="padding-top: 25px" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $karyawan['nama_karyawan']; ?></h5>
                    <?php foreach($tbl_karyawan as $u) { ?>
                    <p class="card-text"><?= $u->id_jabatan ?></p>
                    <?php } ?>
                </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email : <?= $karyawan['email_karyawan']; ?></li>
                   
                    <li class="list-group-item">No Hp : <?= $karyawan['hp_karyawan']; ?></li>
                    </ul>
                    <div class="card-body">
                    <p class="card-text"><small class="text-muted">Tanggal Pendaftaran:  <?= $karyawan['karyawan_register']; ?></small></p>
                    </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->