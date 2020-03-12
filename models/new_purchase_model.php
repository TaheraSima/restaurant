<?php
//New_Purchase Models
class New_Purchase_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields
		$item_id = $_POST['item_id'];
		$new_purchase_quantity = $_POST['new_purchase_quantity'];
		$new_purchase_unit_price = $_POST['new_purchase_unit_price'];
		$prev_pur_qty = $_POST['prev_pur_qty'];
		$closing_qty = $_POST['closing_qty'];

		$req_no = $_POST['req_no'];	
		$total = $_POST['total'];	
		$new_purchase_unit = $_POST['unit_id'];	
		$username = $_POST['username'];
		$user_id = $_POST['user_id'];

		$c = count($item_id);

		$stmt = $this->db->prepare("INSERT INTO `requisition` (`req_no`, `total`, `user_id`, `username`) VALUES ('$req_no', '$total', '$user_id', '$username')");
		if ($stmt->execute()) {
			$id = $this->db->lastInsertId();
			$stmt = $this->db->prepare("INSERT INTO `m_store` (`req_id`) VALUES ($id)");
			if ($stmt->execute()) {
				$m_store_id = $this->db->lastInsertId();
				for ($i=0; $i<$c; $i++ ) {
				$stmt = $this->db->prepare("INSERT INTO `new_purchase` ( `req_id`, `item_id`, `new_purchase_quantity`, `prev_pur_qty`, `closing_qty`, `new_purchase_unit`, `new_purchase_unit_price`) VALUES ( $id, $item_id[$i], $new_purchase_quantity[$i], $prev_pur_qty[$i], $closing_qty[$i], $new_purchase_unit[$i], $new_purchase_unit_price[$i])");
					if ($stmt->execute()) {
						$stmt = $this->db->prepare("INSERT INTO `material_store` ( `m_store_id`, `item_id`, `prev_pur_qty`, `quantity`, `closing_qty`, `transaction_type`, `purchase_unit`) VALUES ( $m_store_id, $item_id[$i], $prev_pur_qty[$i], $new_purchase_quantity[$i], $closing_qty[$i], 'In', $new_purchase_unit[$i])");
						$stmt->execute();
					}
				}
				return "SUCCESS";
			}else{
				return "FAILED";
			}
		}else{
			return "FAILED";
		}
	}
	public function searchd($table){
		if (isset($_POST["id"])) {
			$p_id = $_POST["id"];
			$stmt = $this->db->prepare("SELECT material_store.*, item.* FROM material_store, item WHERE material_store.item_id='$p_id' AND material_store.purchase_unit = item.item_unit ORDER BY material_store.m_store_details_id desc LIMIT 0,1 ");
			$stmt->execute();
			return $data = $stmt->fetchObject();
		}	
	}
	public function update($table)
	{
		$stmt = $this->db->prepare("UPDATE `new_purchase` SET `closing_qty`='$closing_qty[$i]', `transaction_type` = 'Out' WHERE `item_id`=$item_id[$i] ORDER BY new_purchase_id desc LIMIT 1");
		if ($stmt->execute()) {
			echo "Success";
		}
		else{
		echo "FAILED1";die;
		}
	}

	public function searchd_unit($table){
		if (isset($_POST["id"])) {
			$p_id = $_POST["id"];
			$stmt = $this->db->prepare("SELECT item.*, unit.* FROM item, unit WHERE item.item_id=$p_id AND item.item_unit=unit.unit_id");
			$stmt->execute();
			return $data = $stmt->fetchObject();
		}	
	}

	// public function update($table)
	// {
	// 	$item_id = $_POST['item_id'];
	// 	$r_id = $_POST['r_id'];
	// 	$approved_qty = $_POST['approved_qty'];
	// 	$c = count($item_id);
	// 	$stmt = $this->db->prepare("UPDATE `requisition` SET `status`=1 WHERE `id`=$r_id");	
	// 	if ($stmt->execute()) {
	// 		for ($i=0; $i<$c; $i++ ) {
	// 		$stmt1 = $this->db->prepare("UPDATE `new_purchase` SET `approved_qty`='$approved_qty[$i]' WHERE `req_id`=$r_id");
	// 		if ($stmt1->execute()) {
	// 				echo "Success";
	// 		}else{
	// 			echo "FAILED";die;
	// 		}
	// 	}
	// 	}
	// 	else{
	// 		echo "FAILED";die;
	// 	}

	// 	// for ($i=0; $i<$c; $i++ ) {
	// 	// 	$stmt1 = $this->db->prepare("UPDATE `new_purchase` SET `approved_qty`='$approved_qty' WHERE `req_id`=$r_id");
	// 	// 	if ($stmt1->execute()) {
	// 	// 			echo "Success";
	// 	// 	}else{
	// 	// 		echo "FAILED";die;
	// 	// 	}
	// 	// }
	// }
	
}