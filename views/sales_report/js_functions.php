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
			$dt = new DateTime($d['date_of_sale']);
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

	function query_out_dash_function_top_products($where, $targets, $tables)
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
				if ($d['products_type'] == 2) {
					$dt = in_out_object_product("products_id=".$d['products_id'], "products_name", "products");
					if ($dt != '') {
						$string .='"'.$dt->products_name.'",';
					}else{
						$string .=',';
					}
				}else{
					$dt = in_out_object_product("item_id=".$d['products_id'], "item_name", "item");
					if ($dt != '') {
						$string .='"'.$dt->item_name.'",';
					}else{
						$string .=',';
					}
				}
			}
			$string = substr($string,0,-1);
			$string .= ']';
			return $string;
		}
	}

	function query_out_dash_function_top_products_qty($where, $targets, $tables)
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

	function query_out_dash_function_netvalue($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData = [];
		$string = '[';
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach ($data as $d) {
			$dt = new DateTime($d['selling_date']);
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

	function query_out_dash_function_value_netvalue($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData = [];
		$string = '[';
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach ($data as $d) {
			$dt = $d['total_amount'];
			$string .='"'.$dt.'",';			
		}
		$string = substr($string,0,-1);
		$string .= ']';
		return $string;
	}

	function query_out_dash_function_discounts($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData = [];
		$string = '[';
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach ($data as $d) {
			$dt = new DateTime($d['date_of_discount']);
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

	function query_out_dash_function_value_discounts($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData = [];
		$string = '[';
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach ($data as $d) {
			$dt = $d['sum_discount'];
			$string .='"'.$dt.'",';			
		}
		$string = substr($string,0,-1);
		$string .= ']';
		return $string;
	}

	function query_out_dash_function_profit($where, $targets, $tables)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData = [];
		$string = '[';
		$stmt = $con->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach ($data as $d) {
			$dt = new DateTime($d['date_of_profit']);
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

	function query_out_dash_function_value_profit($query)
	{
		require 'config/db_info.php';
		$con = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
		$retData = [];
		$stmt = $con->prepare("SELECT DATE(`order_date`) as date_only FROM order_main WHERE 1 AND ".$query);
		$stmt->execute();
		$data = $stmt->fetchAll();
		$string = '[';
		
		foreach ($data as $date) {
			$date_only = $date['date_only'];
			$data_costing = (float)0;
			$stmt_price = $con->prepare("SELECT * FROM order_main WHERE  DATE(order_date)='$date_only' ORDER BY id ASC");
			$stmt_price->execute();
			$data_price = $stmt_price->fetchAll();
			$total_amnt=0;
			foreach ($data_price as $price) {
				$total_amnt += $price['net_amount'];
			}

			$stmt_om_dtls = $con->prepare("SELECT * FROM order_main WHERE  DATE(order_date)='$date_only' ORDER BY id ASC");
			$stmt_om_dtls->execute();
			$data_om_dtls = $stmt_om_dtls->fetchAll();
			$p_amnt=0;
			$ordr_dt= '';
			foreach ($data_om_dtls as $dtls) {
				$id = $dtls['id'];
				$stmt_new_order = $con->prepare("SELECT products_id,products_type,products_quantity FROM new_order WHERE order_id=$id");
				$stmt_new_order->execute();
				$data_new_order = $stmt_new_order->fetchAll();
				foreach ($data_new_order as $pid) {//2
					$pid_id = $pid['products_id'];
					$pid_qty = $pid['products_quantity'];
					$products_type = $pid['products_type'];
					if ($products_type == 2) {
						$stmt_products = $con->prepare("SELECT products_cost FROM products WHERE products_id=$pid_id");
						$stmt_products->execute();
						$data_products = $stmt_products->fetchAll();
						$total_amnt -= (float)$data_products[0]['products_cost']*$pid_qty;
					}else{
						$stmt_products = $con->prepare("SELECT buying_price FROM item WHERE item_id=$pid_id");
						$stmt_products->execute();
						$data_products = $stmt_products->fetchAll();
						$total_amnt -= (float)$data_products[0]['buying_price']*$pid_qty;
					}
					
				}
				$p_amnt += $total_amnt;
			}
			$string .='"'.$total_amnt.'",';
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