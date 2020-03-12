<?php
include('config/db_info.php');
include('include/functions.php');
// include('include/dash_functions.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title> Dashboard || <?php echo base_url('title'); ?> </title>
	    <link rel="shortcut icon" href="<?php echo base_url('site_link'); ?>assets/images/favicon.png" type="image/png">
	    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
	    <link rel="stylesheet" href="<?php echo base_url('site_link'); ?>assets/css/bootstrap/css/open-iconic-bootstrap.min.css">
	    <link rel="stylesheet" href="<?php echo base_url('site_link'); ?>assets/css/fontawesome/css/all.css">
	    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> -->
	    <link rel="stylesheet" href="<?php echo base_url('site_link'); ?>assets/css/bootstrap/css/flatpickr.min.css">
	    <link rel="stylesheet" href="<?php echo base_url('site_link'); ?>assets/css/bootstrap/css/theme.min.css" data-skin="default">
	    <link href="<?php echo base_url('site_link'); ?>assets/frontend/css/custom.css" rel="stylesheet">
	    <link rel="stylesheet" href="<?php echo base_url('site_link'); ?>assets/css/bootstrap/css/jquery.dataTables.min.css" data-skin="default">
	    <script src="<?php echo base_url('site_link'); ?>assets/css/bootstrap/js/jquery.min.js"></script>
	    <!-- <link rel="stylesheet" href="<?php //echo base_url('site_link'); ?>assets/bootstrap/css/theme-dark.min.css" data-skin="dark"> -->
	    <script>
	      setTimeout(function() {
	        $('#hideMe').fadeOut('slow');
	      }, 5000);
	    </script>
	</head>
	<body class=" default-skin pace-done">
		<!-- <div class="pace  pace-inactive">
			<div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
				<div class="pace-progress-inner"></div>
			</div>
			<div class="pace-activity"></div>
		</div> -->
    	<div class="app has-fullwidth">