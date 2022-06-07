<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?= $title ?> | Docker</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
		<meta content="Themesbrand" name="author" />
		<link rel="shortcut icon" href="<?= site_url(); ?>assets/images/favicon.ico">
		<link href="<?= site_url(); ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
		<link href="<?= site_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= site_url(); ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
		<style>
			body{margin:0;padding:0;width:100%;font-family:sans-serif;font-size:15px;color:#444}main{padding:30px;padding-top:60px;box-sizing:border-box}form{margin-bottom:40px}.auth-menu{position:fixed;left:0;top:0;z-index:10001;width:100%;box-sizing:border-box;line-height:40px;background-color:#444;color:#fff;font-size:14px;padding-left:15px;padding-right:15px}.auth-menu a{color:#fff;text-decoration:none;font-weight:700}.notification{list-style-type:none;padding:10px;background-color:#eee;font-weight:700;margin-bottom:30px}
		</style>
	</head>

	<body>
		<div class="account-pages my-5 pt-sm-5">
			<div class="container">
				<div class="row justify-content-center">
					<?= $this->renderSection('main') ?>
				</div>
			</div>
		</div>
		<script src="<?= site_url(); ?>assets/libs/jquery/jquery.min.js"></script>
		<script src="<?= site_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?= site_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
		<script src="<?= site_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
		<script src="<?= site_url(); ?>assets/libs/node-waves/waves.min.js"></script>
		<script src="<?= site_url(); ?>assets/js/app.js"></script>
	</body>
</html>