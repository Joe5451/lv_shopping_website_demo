<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<base href="<?php echo url('admin'); ?>/">
    <link rel="stylesheet" href="css/sweetalert2.min.css" />
	<script src="js/sweetalert2.all.min.js"></script>
	<title>購物網站後台</title>
	<style>
		.swal2-styled.swal2-confirm {
			background-color: #0069d9 !important;
		}
	</style>
	
</head>
<body>
	<script>
		<?php
			if (!isset($icon_type)) $icon_type = 'info';
		?>
		
		Swal.fire({
			icon: '<?php echo $icon_type; ?>',
			title: '<?php echo $message; ?>',
			timer: 0,
			willClose: () => {
				history.back();
			},
		});
	</script>
</body>
</html>
