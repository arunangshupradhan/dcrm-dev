<!doctype html>
    <html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Admin Dashboard | Docker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Scriptlab" name="author" />
        <link rel="shortcut icon" href="<?= site_url(); ?>assets/images/favicon.ico">

        <link href="<?= site_url(); ?>assets/libs/scriptlab-datatable/datatables.min.css" rel="stylesheet" />
        <link href="<?= site_url(); ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" />
        <link href="<?= site_url(); ?>assets/css/icons.min.css" rel="stylesheet" />
        <link href="<?= site_url(); ?>assets/css/app.min.css" id="app-style" rel="stylesheet" />
        <link href="<?= site_url('assets/libs/scriptlab-confirm/jquery-confirm.min.css'); ?>" rel="stylesheet" />
        <link href="<?= site_url('assets/libs/scriptlab-swall/swall.min.css'); ?>" rel="stylesheet" />

        <link href="<?= site_url(); ?>assets/css/style.css" rel="stylesheet" />
        <link href="<?= site_url(); ?>assets/css/custom.css" rel="stylesheet" />

    </head>

    <body data-sidebar="colored">
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box">
                            <a href="<?= site_url('admin/dashboard') ?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?= site_url(); ?>assets/images/logo.svg" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= site_url(); ?>assets/images/logo-dark.png" alt="" height="17">
                                </span>
                            </a>

                            <a href="<?= site_url('admin/dashboard') ?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?= site_url(); ?>assets/images/logo-light.svg" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?= site_url(); ?>assets/images/logo-light.png" alt="" height="19">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                          <h4 class="mb-sm-0 font-size-18 top-title"><?= $title ?></h4>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img id="header-lang-img" src="<?= site_url(); ?>assets/images/flags/us.jpg" alt="Header Language" height="16">
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                        <img src="<?= site_url(); ?>assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                        <img src="<?= site_url(); ?>assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                        <img src="<?= site_url(); ?>assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                        <img src="<?= site_url(); ?>assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                        <img src="<?= site_url(); ?>assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                    </a>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-customize"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <div class="px-lg-2">
                    <div class="row g-0">
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="<?= site_url(); ?>assets/images/brands/github.png" alt="Github">
                                <span>GitHub</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="<?= site_url(); ?>assets/images/brands/bitbucket.png" alt="bitbucket">
                                <span>Bitbucket</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="<?= site_url(); ?>assets/images/brands/dribbble.png" alt="dribbble">
                                <span>Dribbble</span>
                            </a>
                        </div>
                    </div>

                    <div class="row g-0">
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="<?= site_url(); ?>assets/images/brands/dropbox.png" alt="dropbox">
                                <span>Dropbox</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="<?= site_url(); ?>assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                <span>Mail Chimp</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="<?= site_url(); ?>assets/images/brands/slack.png" alt="slack">
                                <span>Slack</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown d-none d-lg-inline-block ms-1">
            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                <i class="bx bx-fullscreen"></i>
            </button>
        </div>

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-bell bx-tada"></i>
            <span class="badge bg-danger rounded-pill">3</span>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
        aria-labelledby="page-header-notifications-dropdown">
        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0" key="t-notifications"> Notifications </h6>
                </div>
                <div class="col-auto">
                    <a href="#!" class="small" key="t-view-all"> View All</a>
                </div>
            </div>
        </div>
        <div data-simplebar style="max-height: 230px;">
            <a href="javascript: void(0);" class="text-reset notification-item">
                <div class="d-flex">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                            <i class="bx bx-cart"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1" key="t-your-order">Your order is placed</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="javascript: void(0);" class="text-reset notification-item">
                <div class="d-flex">
                    <img src="<?= site_url(); ?>assets/images/users/avatar-3.jpg"
                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                    <div class="flex-grow-1">
                        <h6 class="mb-1">James Lemire</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1" key="t-simplified">It will seem like simplified English.</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="javascript: void(0);" class="text-reset notification-item">
                <div class="d-flex">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title bg-success rounded-circle font-size-16">
                            <i class="bx bx-badge-check"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1" key="t-shipped">Your item is shipped</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="javascript: void(0);" class="text-reset notification-item">
                <div class="d-flex">
                    <img src="<?= site_url(); ?>assets/images/users/avatar-4.jpg"
                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Salena Layfield</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1" key="t-occidental">As a skeptical Cambridge friend of mine occidental.</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="p-2 border-top d-grid">
            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span> 
            </a>
        </div>
    </div>
</div>

<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <img class="rounded-circle header-profile-user" src="<?= site_url(); ?>assets/images/users/avatar-1.jpg"
    alt="Header Avatar">
    <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?= admin_name(); ?></span>
    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
</button>
<div class="dropdown-menu dropdown-menu-end">
    <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
    <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">My Wallet</span></a>
    <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
    <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item text-danger" href="<?= site_url('logout'); ?>"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
</div>
</div>

</div>
</div>
</header>