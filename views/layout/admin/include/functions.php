<?php

	function query_out_2($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

	function in_out_object($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchObject();
		return $data;
	}

	function details($table, $compare, $value, $select){
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$stmt = $con->prepare("SELECT $select FROM $table WHERE $compare='$value'");
		$stmt->execute();
		$data = $stmt->fetchAll();
		return $data;
	}

	function company(){
		require 'config/db_info.php';
		$con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
		$sql = "SELECT * FROM company_settings WHERE company_settings_status=1 ORDER BY company_settings_id DESC LIMIT 0,1";
		$run_sql = mysqli_query($con, $sql);
		$company = '';
		while ($main = mysqli_fetch_assoc($run_sql)) {
			$company = $main['company_settings_name'];	        
		}

		return $company;
	}

	function website(){
		require 'config/db_info.php';
		$con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
		$sql = "SELECT * FROM company_settings WHERE company_settings_status=1 ORDER BY company_settings_id DESC LIMIT 0,1";
		$run_sql = mysqli_query($con, $sql);
		$website = '';
		while ($main = mysqli_fetch_assoc($run_sql)) {
			$website = $main['company_settings_website'];	        
		}

		return $website;
	}

	function logged_user_name($user_id){
		require 'config/db_info.php';
		$con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
		$sql = "SELECT username FROM users WHERE user_id=$user_id";
		$run_sql = mysqli_query($con, $sql);
		while ($main = mysqli_fetch_assoc($run_sql)) {
			$username = $main['username'];	        
		}
		return $username;
	}
	
?>

	