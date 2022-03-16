<?php
$meta = $this->meta_model->get_meta();
?>

<div class="container my-5">
    <div class="col-md-5 mx-auto">
        <div class="card bg-dark shadow">
            <div class="card-body">
                <div class="text-muted">
                    <h1 class="h4 text-gray-900 mb-4"><i class="bi-person-check" style="font-size: 2rem;"></i> Buat Akun Gratis!</h1>
                </div>
                <?php
                echo form_open('auth/register',  array('class' => 'needs-validation', 'novalidate' => 'novalidate'))
                ?>

                <div class="form-group">
                    <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap" value="<?php echo set_value('fullname'); ?>" required>
                    <div class="invalid-feedback">Silahkan Masukan Nama Lengkap</div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="whatsapp" placeholder="Whatsapp" value="<?php echo set_value('whatsapp'); ?>" required>
                    <div class="invalid-feedback">Silahkan Masukan Nama Lengkap</div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>" style="text-transform: lowercase" required>
                    <div class="invalid-feedback">Silahkan Masukan Email</div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control" name="password1" placeholder="Password" required>
                        <div class="invalid-feedback">Buat Password</div>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="password2" placeholder="Repeat Password" required>
                        <div class="invalid-feedback">Ulangi Password</div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-block">
                    Daftar Sekarang
                </button>

                <?php echo form_close() ?>
                <hr>
                <div class="text-center">
                    <a class="text-muted" href="<?php echo base_url('auth/forgotpassword'); ?>">Lupa Password?</a>
                </div>
                <div class="text-center text-white">
                    Sudah Punya Akun? <a class="text-muted" href="<?php echo base_url('auth') ?>"> Silahkan Login!</a>
                </div>
            </div>
        </div>
    </div>
</div>