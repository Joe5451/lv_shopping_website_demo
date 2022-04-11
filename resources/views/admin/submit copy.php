<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
	
<base href="<?php echo base_url(); ?>/">
	
<?php /*更好的alert*/ ?>
<script src="ctr/js/sweetalert2.js"></script>

</head>

<body>
<script language="javascript">
	<?php
	if( !(isset($submit_type)) ) $submit_type = 'info';
	if( !(isset($submit_timer)) ) $submit_timer = '0';
	
	echo <<<EchoData
	Swal.fire({
		icon: '$submit_type',
		title: '$message',
		timer: $submit_timer,
		onClose: () => {
			// window.location.href='$location';
			window.location.replace('$location');
		},
	});
EchoData;
	?>
</script>
<style>
	/*新版alert樣式*/
	.swal2-container.swal2-backdrop-show {
		background: rgba(0,0,0,.75)!important;
	}

	.swal2-container{
		z-index: 99999!important;
	}
</style>
</body>
</html>