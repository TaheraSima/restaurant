<?php

	$dbtype = 'mysql';
	$host = 'localhost';
	$dbname = 'restaurants';
	$dbuser = 'root';
	$dbpassword = '';

			//for server
	// $dbuser = 'restaurants';
	// $dbpassword = 'restaurants123';
			//for server

	// $dbname = 'simecdemo_cowboy2';
	// $dbuser = 'simecdemo_cowboy2';
	// $dbpassword = 'zamo9JwC';

	$conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

?>