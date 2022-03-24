<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
	<div class="login col-md-3 mx-auto text-center" style="margin-top: 200px;">
		<?php $validation = \Config\Services::validation(); ?>
		<form method="post" action="<?php echo base_url('home/validateCredentials');?>">
			<h2 >Register</h2>
			<div class="form-group mb-3">
				<input type="text" name="firstname" placeholder="first name" class="form-control">
					<div class='alert-danger'>
					</div>
			</div>
			<div class="form-group mb-3">
				<input type="text" name="secondname" placeholder="second name" class="form-control">
					<div class='alert-danger'>
					</div>
			</div>
			<div class="form-group mb-3">
				<input type="text" name="username" placeholder="username" class="form-control">
				<?php if($validation->getError('username')) {?>
					<div class='alert-danger'>
						<?= $error = $validation->getError('username'); ?>
					</div>
				<?php }?>
			</div>
			<div class="form-group mb-3">
				<input type="password" name="password" placeholder="password" class="form-control">
				<?php if($validation->getError('password')) {?>
					<div class='alert-danger'>
						<?= $error = $validation->getError('password'); ?>
					</div>
				<?php }?>
			</div>
			<div class="form-group mb-3">
				<input type="password" name="re-password" placeholder="re-password" class="form-control">
					<div class='alert-danger'>
					</div>
			</div>
			<?php $session = \Config\Services::session(); if ($session->getFlashdata('msg')) { ?>
        		<div class="alert-danger"> <?php echo $session->getFlashdata('msg') ?> </div>
    		<?php } ?>
			<div class="form-group mb-3">
				<input type="submit" name="submit" class="btn btn-primary btn-block">
			</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />	
</body>
</html>