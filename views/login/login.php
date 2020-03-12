<!DOCTYPE html>
<html lang="en">
<head>
	<title>SIMEC POS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="assetsv/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assetsv/css/style.css">
 
	
</head>
<body> 
	<div class="authentication-layout">
		<div class="authentication-layout-inner">
			<div class="authentication-layout-left">
				<div class="authentication-layout-logo">
					<img src="assetsv/icon/spos-logo.png">
				</div>
				<div class="authentication-layout-head">
					<h1 class="authentication-layout-title">SIMEC Point of Sale</h1>
					<h4 class="authentication-layout-sub-title">Run and grow your business</h4>
				</div>
				<div class="authentication-layout-footer">
					<a class="authentication-layout-footer-link" href="http://www.simecsystem.com/" target="_blank">Learn about SIMEC</a>
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
							<div class="simec-pos-input-group" style="color: white; font-size: 16px;">
						  	<?php
			                    if(isset($_SESSION["error"])){
			                        $error = $_SESSION["error"];
			                        echo "<span>$error</span>";
			                        unset($_SESSION["error"]);
			                    }
			                ?>  
			            </div>
						</form>
					  </div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="assetsv/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assetsv/js/main.js"></script>
</body>
</html>