<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<div class="col-md-8 col-lg-6 col-xl-5">
    <div class="card overflow-hidden">
        <div class="bg-primary bg-soft">
            <div class="row">
                <div class="col-7">
                    <div class="text-primary p-4">
                        <h5 class="text-primary">Free Register</h5>
                        <p>Get your free Docker account now.</p>
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
                <form class="form-horizontal" method="POST" action="<?= site_url('service-providers/sign-up'); ?>" accept-charset="UTF-8">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="<?= old('name') ?>" placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Usernme</label>
                        <input type="text" class="form-control" name="username" value="<?= old('username') ?>" placeholder="Enter Username">
                    </div>
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
                    <div class="mb-3">
                       
                        <div class="input-group">
                            <span><img src="/captcha.php?captcha=<?= $captchaCode ?>" alt="captcha"></span>
                            <input type="text" name="captcha" class="form-control" placeholder="Enter Captcha">
                        </div>
                    </div>

                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light" type="submit">Sign Up</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="mt-5 text-center">

        <div>
            <p>Already have an account ? <a href="<?= site_url('service-providers') ?>" class="fw-medium text-primary"> Login</a> </p>
            <p>© <script>document.write(new Date().getFullYear())</script> Docker. Crafted with <i class="mdi mdi-heart text-danger"></i> by Scriptlab</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
