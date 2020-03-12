<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/frontend/css/custom.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url(<?php echo url('assets/images/Login1.jpg'); ?>); background-repeat: no-repeat;background-size: cover; overflow: hidden; width: 100%;">
	<div class="container row">
		<div class="col-md-8">
			<!-- <img src="assets/images/POS-logo.jpg" style="margin-left: 50px; margin-top: 50px; height: 60px; width: 60px;"> -->
		</div>
		<div class="col-md-4" style="margin-left: 85%; margin-top: 3%">
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade active in" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" style="margin-top: 150px;">
					<form class="card-body" action="<?php echo base_url('site_link'); ?>login/run" method="post">
						<?php $_SESSION['csrf_token_login']=md5(rand()); ?>
						<input type="hidden" name="csrf_token_login" value="<?php echo $_SESSION['csrf_token_login']; ?>">
						  <div class="simec-pos-input-group">
						    <input type="text" class="simec-pos-input-box simec-pos-input-text" name="username" placeholder="Enter email">
						    <small id="username_error" class="form-text text-danger"></small>
						  </div>
						  <div class="simec-pos-input-group">
						    <input type="password" class="simec-pos-input-box simec-pos-input-text"  name="password" placeholder="Password">
						    <small id="password_error" class="form-text text-danger"></small>
						  </div>
						  <button type="submit" class="simec-pos-submit-bitton">Sign In</button>
						  <div style="color: white; font-size: 16px;">
						  	<?php
			                    if(isset($_SESSION["error"])){
			                        $error = $_SESSION["error"];
			                        echo "<span>$error</span>";
			                    }
			                ?>  
			            </div>
						   
					</form>
				</div>
			</div>
		</div>
	</div>
	


</body>
</html>

<?php
    unset($_SESSION["error"]);
?>
