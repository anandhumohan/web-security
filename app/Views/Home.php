<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
</head>
<body style = "background-color: rgba(249, 180, 69, 0.5);">
	<div class="row" style="display: flex;
  justify-content: center; margin-top: 300px;">
		<div class="col-sm-3">
			<div class="card" style="width: 18rem;">
				<div class="card-body">
					<h5 class="card-title">A2: Broken Authentication</h5>
					<p class="card-text">This vulnerability is related to the authentication mechanism.</p>
					<a href="<?=base_url('home/brockenAuthentication');?>" class="btn btn-primary btn-block">Here</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card" style="width: 18rem;">
				<div class="card-body">
					<h5 class="card-title">A7: Cross Site Scripting</h5>
					<p class="card-text">This is type of innjection, some malations scripts are injected.</p>
					<a href="<?=base_url('home/tryxss');?>" class="btn btn-primary btn-block">Here</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="card" style="width: 18rem;">
				<div class="card-body">
					<h5 class="card-title">OSWAP 3</h5>
					<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
					<p class="card-text">Sample 3.</p>
					<a href="#" class="btn btn-primary btn-block">Here</a>
					</div>
				</div>
			</div>
		</div>	
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
		</body>
		</html>