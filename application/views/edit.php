<!DOCTYPE html>
<html>
	<head>
		<title>add</title>
	</head>
	<body>
		<?php
			$id = $data->id;
			$name = $data->name;
			$status = $data->status;

			$error = $this->session->flashdata('error');
			echo isset($error) && !empty($error) ? $error : '';
			
			if(validation_errors()) {
				echo validation_errors();
			}
		?>
		<form method="post" action="<?php echo base_url('update'); ?>">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="text" name="name" value="<?php echo $name; ?>" />
			<input type="text" name="status" value="<?php echo $status; ?>" />
			<input type="submit" name="submit" value="Submit" />
		</form>
	</body>
</html>