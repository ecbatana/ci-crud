<!DOCTYPE html>
<html>
	<head>
		<title>add</title>
	</head>
	<body>
		<?php
			if(validation_errors()) {
				echo validation_errors();
			}
		?>
		<form method="POST" action="<?php echo base_url('add'); ?>">
			<input type="text" name="name" />
			<input type="text" name="status" />
			<input type="submit" name="submit" value="Submit" />
		</form>
	</body>
</html>