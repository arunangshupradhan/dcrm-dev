<script>
	site_url = '<?= site_url() ?>';
	var formProgress = 'formSubmitProgress',
	btnProgress = 'btn-progress',
	x_timer,
	btnReplace = '<i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Loading',
	btnText = '';
</script>
<script src="<?= site_url(); ?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?= site_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= site_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= site_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= site_url(); ?>assets/libs/node-waves/waves.min.js"></script>

<script src="<?= site_url(); ?>assets/libs/select2/js/select2.min.js"></script>
<script src="<?= site_url(); ?>assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="<?= site_url('assets/libs/scriptlab-confirm/jquery-confirm.min.js'); ?>"></script>




<!-- Datatable -->
<script src="<?= site_url('assets/libs/scriptlab-datatable/datatables.min.js') ?>"></script>
<script src="<?= site_url('assets/libs/scriptlab-swall/swall.min.js') ?>"></script>



<script src="<?=site_url('service-provider/js/scripts.js?v=').filemtime('service-provider/js/scripts.js')?>"></script>

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
	};
	
	function showTabs(tab) {
		$('a[href="'+tab+'"]').tab('show');
	};

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
<script src="<?= site_url(); ?>assets/js/app.js"></script>
