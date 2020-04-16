    <div class="container tengah">
        <div class="row justify-content-center">

            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-md-5 d-none d-md-block bagian-kiri m-auto">
                        <img src="<?= base_url(); ?>assets/img/logo_HS.jpg" alt="">
                        <h2>PT Harmony Sistem</h2>
                        <p>Halaman Login</p>
                        <div class="sponsor">
                        </div>
                    </div>
                    <div class="col-md-7 bagian-kanan">
                        <h2>PT Harmony Sistem</h2>
                        <p>Silahkan login</p>
                        <?= $this->session->flashdata('notifLogin'); ?>
                        <div class="register-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" name="email_karyawan" id="email_karyawan" class="form-control" placeholder="Masukkan Email Anda" value="<?= set_value('email_karyawan'); ?>">
                                    <?= form_error('email_karyawan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Anda">
                                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <button type="submit" name="submit" id="submit" class="btn btn-dark">Login!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

    </html>