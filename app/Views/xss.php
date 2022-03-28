<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body class="bg-light">
	<form  style="display: flex;
		justify-content: center; margin-top: 300px; method="GET" action="" name="form"">
		<div class="form-group">
		<input type="text" class="form-control" id="input"placeholder="Enter something">
		<button type="submit" class="form-control btn btn-primary">Submit</button>
	</div>
</form>
<?php
if(isset($_GET["username"]))

	echo("Your name is ". htmlspecialchars($_GET["username"]))?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
</body>
</html>