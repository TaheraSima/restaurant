<!DOCTYPE html>
<html lang="en">
<head>
	<title>SIMEC POS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="assets/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/assets/css/style.css">
 
	
</head>
<!-- <head>
	<title></title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head> -->
<body> 
	<div class="authentication-layout">
		<div class="authentication-layout-inner">
			<div class="authentication-layout-left">
				<div class="authentication-layout-logo">
					<img src="assets/icon/spos-logo.png">
				</div>
				<div class="authentication-layout-head">
					<h1 class="authentication-layout-title">SIMEC Point of Sale</h1>
					<h4 class="authentication-layout-sub-title">Run and grow your business</h4>
				</div>
				<div class="authentication-layout-footer">
					<a class="authentication-layout-footer-link" href="/">Learn about SIMEC</a>
				</div>
			</div>
			<div class="authentication-layout-right">
				<div class="authentication-layout-tab-area">

					  <div id="signin" class="fade in active" style="margin-top: 150px;">
					  	<form class="card-body" action="<?php echo base_url('site_link'); ?>login/run" method="post">
					  		<?php $_SESSION['csrf_token_login']=md5(rand()); ?>
					  		<input type="hidden" name="csrf_token_login" value="<?php echo $_SESSION['csrf_token_login']; ?>">
					  		
							<div class="simec-pos-input-group">
								<input type="text" name="username" class="simec-pos-input-box simec-pos-input-text" placeholder="User Name">
								<small id="username_error" class="form-text text-danger"></small>
							</div>
							 
							<div class="simec-pos-input-group">
								<input type="password" name="password" class="simec-pos-input-box simec-pos-input-text" placeholder="Password">
								<small id="password_error" class="form-text text-danger"></small>
							</div> 
							<div class="simec-pos-input-group">
								<button class="simec-pos-submit-bitton">Sign In</button>
							</div>
						</form>
					  </div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>
