<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<div class="col-md-8 col-lg-6 col-xl-5">
    <div class="card overflow-hidden">
        <div class="bg-primary bg-soft">
            <div class="row">
                <div class="col-7">
                    <div class="text-primary p-4">
                        <h5 class="text-primary"> Reset Password</h5>
                        <p>Reset Password with Docker.</p>
                    </div>
                </div>
                <div class="col-5 align-self-end">
                    <img src="<?= site_url(); ?>assets/images/profile-img.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="card-body pt-0"> 
            <div>
                <a href="index.html">
                    <div class="avatar-md profile-user-wid mb-4">
                        <span class="avatar-title rounded-circle bg-light">
                            <img src="<?= site_url(); ?>assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                        </span>
                    </div>
                </a>
            </div>
            <div class="p-2">
                <?= view('AdminProfile\Views\_notifications') ?>
                <form class="form-horizontal" method="POST" action="<?= site_url('admin/forgot-password'); ?>" onsubmit="submitButton.disabled = true; return true;" accept-charset="UTF-8">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="useremail" class="form-label">Email</label>
                        <input type="text" value="<?= old('email') ?>" class="form-control" name="email" placeholder="Enter email">
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="mt-5 text-center">
        <p>Remember It ? <a href="<?= site_url('admin') ?>" class="fw-medium text-primary"> Sign In here</a> </p>
        <p>© <script>document.write(new Date().getFullYear())</script> Docker. Crafted with <i class="mdi mdi-heart text-danger"></i> by Scriptlab</p>
    </div>
</div>
<?= $this->endSection() ?>
