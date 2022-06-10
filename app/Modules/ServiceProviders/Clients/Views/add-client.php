<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="<?= site_url('service-providers/add-client') ?>" id="form-new-client">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist" id="parentTabHolder">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tab-cli-details" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">Client Details</span> 
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tab-cli-auth" role="tab">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">Client Authentication</span> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="tab-cli-details" role="tabpanel">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3 field-holder">
                                                    <label for="name">Name <span class="text-danger">*</span></label>
                                                    <input id="name" name="name" type="text" class="form-control" placeholder="Enter Name">
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3 field-holder">
                                                    <label for="email">Email <span class="text-danger">*</span></label>
                                                    <input id="email" name="email" type="text" class="form-control" placeholder="Enter Email">
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3 field-holder">
                                                    <label for="country">Country <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="country" id="country"></select>
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3 field-holder">
                                                    <label for="state">State <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="state" id="state"></select>
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3 field-holder">
                                                    <label for="city">City <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="city" id="city"></select>
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3 field-holder">
                                                    <label for="city">Phone <span class="text-danger">*</span></label>
                                                    <input id="phone" name="phone" type="text" class="form-control" >
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3 field-holder">
                                                    <label for="zip_code">Zip Code <span class="text-danger">*</span></label>
                                                    <input id="zip_code" name="zip_code" type="text" maxlength="6" class="form-control numbers" >
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3 field-holder">
                                                    <label for="web_site">Website <span class="text-danger">*</span></label>
                                                    <input id="web_site" name="web_site" type="text" class="form-control" >
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3 field-holder">
                                                    <label for="address">Address <span class="text-danger">*</span></label>
                                                    <textarea name="address" id="address" rows="3" class="form-control" placeholder="Enter address"></textarea>
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-cli-auth" role="tabpanel">
                                         <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3 field-holder">
                                                    <label for="username">Username <span class="text-danger">*</span></label>
                                                    <input id="username" name="username" type="text" class="form-control" placeholder="Enter Username">
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3 field-holder">
                                                    <label for="password">Password <span class="text-danger">*</span></label>
                                                    <input id="password" name="password" type="text" class="form-control" placeholder="Enter password">
                                                   <span class="error-input-feedback"></span><br>
                                                    <small><b>Length should be  8-15 and should include at least one upper case letter, one number and one special character.</b></small> 
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3 field-holder">
                                                    <label for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                                    <input id="confirm_password" name="confirm_password" type="text" class="form-control" placeholder="Enter confirm password">
                                                    <span class="error-input-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <?= csrf_field(); ?>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- load extra css and js -->
    <?= $this->section('css') ?>
        <link rel="stylesheet" href="<?= site_url('global/libs/intl-input/intlTelInput.min.css') ?>">
    <?= $this->endSection() ?>

    <?= $this->section('js') ?>
        <script src="<?= site_url('global/libs/intl-input/intlTelInput.min.js') ?>"></script>
        <script src="<?= site_url('service-provider/js/pages/save-client.init.js?v=').filemtime('service-provider/js/pages/save-client.init.js') ?>"></script>
    <?= $this->endSection() ?>

<?= $this->endSection() ?>