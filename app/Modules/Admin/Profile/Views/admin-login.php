<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<div class="col-md-8 col-lg-6 col-xl-5">
    <div class="card overflow-hidden">
        <div class="bg-primary bg-soft">
            <div class="row">
                <div class="col-7">
                    <div class="text-primary p-4">
                        <h5 class="text-primary">Welcome Back !</h5>
                        <p>Sign in to continue to Docker.</p>
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
                <form class="form-horizontal" method="POST" action="<?= site_url('admin'); ?>" accept-charset="UTF-8">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="<?= old('email') ?>" placeholder="Enter Email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group auth-pass-inputgroup">
                            <input type="password" name="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                        </div>
                    </div>

                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="<?= site_url('admin/forgot-password') ?>" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="mt-5 text-center">

        <div>
            <p>© <script>document.write(new Date().getFullYear())</script> Docker. Crafted with <i class="mdi mdi-heart text-danger"></i> by Scriptlab</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
