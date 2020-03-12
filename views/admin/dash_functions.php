<?php

	function in_out_object_product($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchObject();
		return $data;
	}

	function query_out_dash_function($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData = [];
		$string = '[';
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach ($data as $d) {
			$dt = new DateTime($d['order_date']);
			$dt = $dt->format('d-m-Y');
			if (!in_array($dt, $retData)) {
				array_push($retData, $dt);
				$string .='"'.$dt.'",';
			}			
		}
		$string = substr($string,0,-1);
		$string .= ']';
		return $string;
	}

	function query_out_dash_function_value($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData = [];
		$string = '[';
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach ($data as $d) {
			$dt = $d['sum_net_amount'];
			$string .='"'.$dt.'",';			
		}
		$string = substr($string,0,-1);
		$string .= ']';
		return $string;
	}
	
	function query_out_dash_function_top_product($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData = [];		
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		if (empty($data)) {
			return 0;
		}else{
			$string = '[';
			foreach ($data as $d) {
				$dt = in_out_object_product("products_id=".$d['products_id'], "products_name", "products");
				if ($dt != '') {
					$string .='"'.$dt->products_name.'",';
				}else{
					$string .=',';
				}
			}
			$string = substr($string,0,-1);
			$string .= ']';
			return $string;
		}
	}

	function query_out_dash_function_top_product_qty($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData = [];
		$string = '[';
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach ($data as $d) {
			$dt = $d['psumqty'];
			$string .='"'.$dt.'",';			
		}
		$string = substr($string,0,-1);
		$string .= ']';
		return $string;
	}

	function query_out_dash_function_top_product_string($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData['name'] = [];
		$retData['amount'] = [];
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		if (empty($data)) {
			return 0;
		}else{
			$string = '[';
			foreach ($data as $d) {
				$dt = in_out_object_product("products_id=".$d['products_id'], "products_name", "products");
				if ($dt != '') {
					$dtp = $d['psumqty'];
					array_push($retData['name'], $dt->products_name);
					array_push($retData['amount'], $dtp);
				}
			}
			return $retData;
		}
	}
?>