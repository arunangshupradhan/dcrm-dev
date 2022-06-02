<script>
	site_url = '<?= site_url() ?>';
</script>
<script src="<?= site_url(); ?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?= site_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= site_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= site_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= site_url(); ?>assets/libs/node-waves/waves.min.js"></script>

<script src="<?= site_url(); ?>assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="<?= site_url('assets/libs/scriptlab-confirm/jquery-confirm.min.js'); ?>"></script>



<script src="<?= site_url(); ?>assets/js/app.js"></script>

<!-- Datatable -->
<script src="<?= site_url('assets/libs/scriptlab-datatable/datatables.min.js') ?>"></script>
<script src="<?= site_url('assets/libs/scriptlab-swall/swall.min.js') ?>"></script>



<script src="<?=site_url('assets/js/common/scripts.js?v=').filemtime('assets/js/common/custom.js')?>"></script>
<script src="<?=site_url('assets/js/common/custom.js?v=').filemtime('assets/js/common/custom.js')?>"></script>

<script>
	//sweet alert
	var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3500,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	});

	function success(message, reload = 1, red = false) {
		Toast.fire({
			icon: 'success',
			title: message
		})

		if (reload) {
			setTimeout(function () {
				location.reload(true);
			}, 3500	);
		}
		if (red) {
			setTimeout(function () {
				window.location.href = red;
			}, 3500	);
		}
	}
	
	function error(message) {
		Toast.fire({
			icon: 'error',
			title: message
		})
	}	
</script>

<?php if($this->session->getFlashdata('message') && $this->session->getFlashdata('message_type') == 'success'){ ?>
	<script>
		$(document).ready(function(){
			Toast.fire({
				icon: 'success',
				title: "<?=$this->session->getFlashdata('message');?>"
			})
		});
		
	</script>
<?php } elseif ($this->session->getFlashdata('message') && $this->session->getFlashdata('message_type') == 'error') { ?>
	<script>
		$(document).ready(function(){
			Toast.fire({
				icon: 'error',
				title: "<?=$this->session->getFlashdata('message');?>"
			})
		});
		
	</script>
<?php } unset($_SESSION['message']); ?>

<!-- <script type="text/javascript">
	document.addEventListener('contextmenu', function(e) {
		e.preventDefault();
	});
	document.onkeydown = function(e) {
		if(event.keyCode == 123) {
			return false;
		}
		if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
			return false;
		}
		if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
			return false;
		}
		if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
			return false;
		}
		if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
			return false;
		}
	}
</script> -->