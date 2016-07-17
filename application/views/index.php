<!DOCTYPE html>
<html>
	<head>
		<title>add</title>
	</head>
	<body>
		<?php
			$success = $this->session->flashdata('success');
			echo isset($success) && !empty($success) ? $success : '';

			$error = $this->session->flashdata('error');
			echo isset($error) && !empty($error) ? $error : '';
			
			if(validation_errors()) {
				echo validation_errors();
			}
		?>
		<table>
			<tr>
				<td>ID</td>
				<td>Nama</td>
				<td>Status</td>
				<td>Aksi</td>
			</tr>
			<?php if(!empty($data) && isset($data)): ?>
			<?php foreach($data as $row): ?>
			<tr>
				<td><?php echo $row->id; ?></td>
				<td><?php echo $row->name; ?></td>
				<td><?php echo $row->status; ?></td>
				<td><a href="<?php echo base_url("edit/{$row->id}"); ?>">Edit</a> / <a href="<?php echo base_url("delete/{$row->id}"); ?>">Hapus</a></td>
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td>No</td>
				<td>such</td>
				<td>Data</td>
				<td>Available</td>
			</tr>
			<?php endif; ?>
		</table>
	</body>
</html>