<?php include 'config/db_info.php' ?>
<?php
//new_order Models
class new_order_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function save($table)
	{
		$customer_id=$_POST['customers_id']==''?0:$_POST['customers_id'];
		$customers_type=$_POST['customers_type'];
		$order_no=$_POST['order_no'];
		$order_vat = "";
		$amount = $_POST['total'];
		$user_id = $_POST['user_id'];

		$products_discount = $_POST['pdis_price'];
		$loyality_discount = $_POST['dis_amnt'];
		$actual_amount = $_POST['actual_price'];
		$special_discount = $_POST['sp_discount'];
		
		$net_amount = $_POST['amountTotal'];

		$products_id=$_POST['products_id'];
		$products_price=$_POST['products_price'];
		$products_quantity=$_POST['products_qty'];
		$products_value=$_POST['sub_total'];
		$products_type=$_POST['products_type_id'];

		$grand_total=$_POST['grand_total'];
		$order_vat=$_POST['vat'];

		$payment_type = $_POST['payment_type'];
		if ($payment_type == 1) {
			$recv_amount=$_POST['cash_rcv'];
			$retn_amount=$_POST['cash_rtn'];
			$card_no = "";
			$due = 0;
		}
		if ($payment_type == 2) {
			$recv_amount = $net_amount;
			$retn_amount = 0;
			$card_no=$_POST['card_no'];
			$due = 0;
		}
		if ($payment_type == 3) {
			$recv_amount = 0;
			$retn_amount = 0;
			$card_no=$_POST['card_no'];
			$due = $net_amount;
		}
		

		$c = count($products_id);

		$stmt = $this->db->prepare("INSERT INTO `order_main` (`customer_id`, `customers_type`, `user_id`, `order_no`, `order_vat`, `amount`, `total_amount`, `recv_amount`, `retn_amount`, `due_amount`, `products_discount`, `loyality_discount`,`actual_amount`, `special_discount`, `net_amount`, `card_no`, `payment_type`) VALUES ('$customer_id', '$customers_type', '$user_id', '$order_no', '$order_vat', '$amount',  '$grand_total', '$recv_amount', '$retn_amount', '$due', '$products_discount', '$loyality_discount', '$actual_amount', '$special_discount', '$net_amount', '$card_no', '$payment_type')");
		if ($stmt->execute()) {
			$id = $this->db->lastInsertId();
			for ($i=0; $i<$c; $i++ ) {
				$pid = $products_id[$i];
				$pqty = $products_quantity[$i];
				$st_sql = $this->db->prepare("SELECT production_id FROM production WHERE production_products_id=$pid");
				$st_sql->execute();
				$prd_id = $st_sql->fetchObject()->production_id;

				$std_sql = $this->db->prepare("SELECT production_details_item_id,production_details_amount FROM production_details WHERE production_details_production_id=$prd_id");
				$std_sql->execute();
				$prd_details = $std_sql->fetchAll();
				foreach ($prd_details as $details) {
					$raw_mat_id = $details['production_details_item_id'];
					$raw_mat_amount = $details['production_details_amount']*$pqty;
					$pre_st_sql = $this->db->prepare("SELECT closing_qty,purchase_unit FROM material_store WHERE item_id=$raw_mat_id ORDER BY m_store_details_id DESC LIMIT 0,1");
					$pre_st_sql->execute();
					$pre_stok_data = $pre_st_sql->fetchObject();
					$pre_stok = $pre_stok_data->closing_qty;
					$pre_stok_unit = $pre_stok_data->purchase_unit;

					$new_stk = $pre_stok-$raw_mat_amount;
					$new_st_sql = $this->db->prepare("INSERT INTO material_store (item_id, prev_pur_qty, quantity, closing_qty, transaction_type, purchase_unit) VALUES ($raw_mat_id, $pre_stok, $raw_mat_amount, $new_stk, 'Out', $pre_stok_unit)");
					if ($new_st_sql->execute()) {
					}else{
						die("STOCK DEDUCTION ERR!");
					}
				}

				$stmt = $this->db->prepare("INSERT INTO `new_order` ( `order_id`, `products_id`, `products_type`, `products_price`, `products_quantity`, `products_value`, `grand_total`) VALUES ( $id, $products_id[$i], $products_type[$i], '$products_price[$i]', '$products_quantity[$i]', '$products_value[$i]', '$grand_total')");
				if ($stmt->execute()) {
					$pid = $products_id[$i];
					$tqty = $products_quantity[$i];
					//  echo $pid, $tqty;
					// $dtlMultiply = query_out_2("production.production_id=production_details.production_details_production_id AND production.production_products_id=$pid", "production.*, production_details.*", "production, production_details");
					// foreach ($dtlMultiply as $dm) {
					// 	$iID = $dm['production_details_item_id'];
					// 	$iQTY = $dm['production_details_amount'];
					// 	echo  $iID , $iQTY;
					// }

					$ret = "SUCCESS";
				}else{
					$ret = "FAILED";
				}
	    	}
		}else{
			$ret = "FAILED2";
		}
		return $ret;
        // return "INSERT INTO `order_main` (`customer_id`, `customers_type`, `user_id`, `order_no`, `order_vat`, `amount`, `total_amount`, `recv_amount`, `retn_amount`, `due_amount`, `products_discount`, `loyality_discount`,`actual_amount`, `special_discount`, `net_amount`, `card_no`, `payment_type`) VALUES ($customer_id, '$customers_type', '$user_id', '$order_no', '$order_vat', '$amount',  '$grand_total', '$recv_amount', '$retn_amount', '$due', '$products_discount', '$loyality_discount', '$actual_amount', '$special_discount', '$net_amount', '$card_no', '$payment_type')";
	}

	public function search($table){
		if (isset($_POST["id"])) { 
			$name = $_POST["id"]; 
			// echo $name; 
			// $stmt = $this->db->prepare("SELECT * FROM customers WHERE customers_name LIKE '%$name%' OR customers_phone LIKE '%$name%' LIMIT 0,1");
			// $stmt = $this->db->prepare("SELECT customers.*, customergroup.* FROM customers, customergroup  WHERE customers.customers_group_id=customergroup.customergroup_id AND customers_phone LIKE '%$name%' LIMIT 0,1");
			$stmt = $this->db->prepare("SELECT customers.*, customergroup.* FROM customers, customergroup  WHERE customers.customers_group_id=customergroup.customergroup_id AND customers.customers_phone = $name");
			$stmt->execute();
			return $data = $stmt->fetchObject();
		}
		else{

		}
	}

	public function discountsearch($table){
		if (isset($_POST["id"])) {
			$groupDis = $_POST["id"];
			// $stmt = $this->db->prepare("SELECT * FROM discount WHERE customer_group_id=$groupDis");
			$stmt = $this->db->prepare("SELECT count(customer_group_id) as c_grp_id,discount_amount FROM discount WHERE customer_group_id=$groupDis AND discount_status=1");
			$stmt->execute();
			return $data = $stmt->fetchObject();
		}
	}

	public function searchrecp($table){
		if (isset($_POST["id"])) {
			$pID = $_POST["id"];
			$stmt = $this->db->prepare("SELECT order_main.*, new_order.*, production.*, production_details.* FROM order_main, new_order, production, production_details WHERE order_main.id = new_order.order_id AND new_order.products_id = production.production_products_id AND production.production_id = production_details.production_details_production_id AND production.production_products_id = $pID");
			$stmt->execute();
			return $data = $stmt->fetchObject();
		}
	}

	public function searchd($table){
		if (isset($_POST["id"])) {
			$p_id = $_POST["id"];
			$stmt = $this->db->prepare("SELECT * FROM products WHERE products_id='$p_id' ");
			$stmt->execute();
			return $data = $stmt->fetchObject();
		}	
	}

	public function checkavailability(){
		$pid = $_POST['pid'];
		$pqty = $_POST['pqty'];
		
			$ddq = $this->db->prepare("SELECT production_id FROM production WHERE production_products_id=$pid");
			$ddq->execute();
			$data = $ddq->fetchObject();
	      	$prid = $data->production_id;

	      	$ddstock = $this->db->prepare("SELECT production_details_item_id,production_details_amount FROM production_details WHERE production_details_production_id=$prid");
			$ddstock->execute();
			$datastock = $ddstock->fetchAll();
			$rvalue = [];
	      	foreach ($datastock as $itm) {
	      		$itmid = $itm['production_details_item_id'];
	      		$itmamnt = $itm['production_details_amount'];
	      		$ttl_itmamnt = $itmamnt * $pqty;

	      		$stqty = $this->db->prepare("SELECT closing_qty FROM material_store WHERE item_id=$itmid ORDER BY m_store_details_id DESC LIMIT 0,1");
				$stqty->execute();
				$qtstock = $stqty->fetchAll();

	      		$pstqt = $qtstock[0] ['closing_qty'];
	      		if ($ttl_itmamnt > $pstqt) {
	      			array_push($rvalue,'NOT');
	      		}else{
	      			array_push($rvalue,'YES');
	      		}
	      	}
	      	if (in_array('NOT', $rvalue)) {
	      		return 'NOT';
	      	}else{
	      		return 'YES';
	      	}	

	}

	public function checkrawavailability(){
		$pid = $_POST['pid'];
		$pqty = $_POST['pqty'];
		
		$sqlRaw = $this->db->prepare("SELECT closing_qty FROM material_store WHERE item_id=$pid ORDER BY m_store_details_id DESC LIMIT 0,1");
		$sqlRaw->execute();
			$rawQtstock = $sqlRaw->fetchObject();
			$rawsqt = $rawQtstock->closing_qty;
			//echo $rawsqt; 
			$rvalue = [];
				if ($rawsqt < $pqty) {
					array_push($rvalue,'NOT');
		      	}else{
		      		array_push($rvalue,'YES');
		      	}
			
			if (in_array('NOT', $rvalue)) {
	      		return 'NOT';
	      	}else{
	      		return 'YES';
	      	}		

	}

	public function checkdiscount(){
		if (isset($_POST["id"])) {
			$p_id = $_POST["id"];
			$stmt = $this->db->prepare("SELECT item_price FROM discount WHERE item_id=$p_id");
			$stmt->execute();
			return $data = $stmt->fetchObject();
		}		
      	
	}
}