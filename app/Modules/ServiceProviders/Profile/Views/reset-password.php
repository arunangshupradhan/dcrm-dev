<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<?php $validation = \Config\Services::validation(); ?>
<div class="col-md-8 col-lg-6 col-xl-5">
    <div class="card overflow-hidden">
        <div class="bg-primary bg-soft">
            <div class="row">
                <div class="col-7">
                    <div class="text-primary p-4">
                        <h5 class="text-primary">Set a new password !</h5>
                        <p>Explore more possibilitie with Docker</p>
                    </div>
                </div>
                <div class="col-5 align-self-end">
                    <img src="<?= site_url(); ?>assets/images/profile-img.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="card-body pt-0"> 
            <div class="auth-logo">
                <a href="index.html" class="auth-logo-light">
                    <div class="avatar-md profile-user-wid mb-4">
                        <span class="avatar-title rounded-circle bg-light">
                            <img src="<?= site_url(); ?>assets/images/logo-light.svg" alt="" class="rounded-circle" height="34">
                        </span>
                    </div>
                </a>

                <a href="index.html" class="auth-logo-dark">
                    <div class="avatar-md profile-user-wid mb-4">
                        <span class="avatar-title rounded-circle bg-light">
                            <img src="<?= site_url(); ?>assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                        </span>
                    </div>
                </a>
            </div>
            <div class="p-2">
                <?= view('AdminProfile\Views\_notifications') ?>
                <form class="form-horizontal" method="POST" action="<?= site_url('service-providers/reset-password'); ?>" accept-charset="UTF-8">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Token</label>
                        <input type="text" class="form-control" name="token" value="<?= $_GET['token'] ?>" readonly/>
                        <span class="text-danger"><?= $validation->getError('token'); ?></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <div class="input-group auth-pass-inputgroup">
                            <input type="password" name="password" class="form-control" placeholder="********" aria-label="Password" aria-describedby="password-addon" value="<?= old('password') ?>">
                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                        </div>
                        <span class="text-danger"><?= $validation->getError('password'); ?></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-group auth-pass-inputgroup">
                            <input type="password" name="password_confirm" class="form-control" placeholder="********" aria-label="password_confirm" aria-describedby="password-addon" value="<?= old('password_confirm') ?>">
                            <button class="btn btn-light " type="button" id="confirm-password-addon"><i class="mdi mdi-eye-outline"></i></button>
                        </div>
                        <span class="text-danger"><?= $validation->getError('password_confirm'); ?></span>
                    </div>

                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
