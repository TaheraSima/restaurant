<?php
//Item Models
class Item_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		$item_name = $_POST['item_name'];
		$item_unit = $_POST['item_unit'];
		$item_sale_permiss = $_POST['item_sale_permiss'];
		$buying_price = isset($_POST['buying_price'])?$_POST['buying_price']:0;
		$sell_price = isset($_POST['sell_price'])?$_POST['sell_price']:0;
		$per_pcs_profit = $sell_price-$buying_price;

		$stmt = $this->db->prepare("INSERT INTO `$table`(`item_name`, `item_sale_permiss`, `item_unit`, `buying_price`, `sell_price`, `per_pcs_profit`) VALUES ('$item_name', '$item_sale_permiss', '$item_unit', '$buying_price', '$sell_price', '$per_pcs_profit')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function update($table)
	{
		$item_id = $_POST['item_id'];
		$item_name = $_POST['item_name'];
		$item_unit = $_POST['item_unit'];

		if (isset($_POST['item_sale_permiss']) && $_POST['item_sale_permiss'] != '') {
			if ($_POST['item_sale_permiss'] == 'Allow') {
				$item_sale_permiss = 'Allow';
				$buying_price = isset($_POST['buying_price'])?$_POST['buying_price']:0;
				$sell_price = isset($_POST['sell_price'])?$_POST['sell_price']:0;
				$per_pcs_profit = $sell_price-$buying_price;
				$query="UPDATE `$table` SET `item_name`='$item_name', `item_unit`='$item_unit', `item_sale_permiss`='$item_sale_permiss', `buying_price`='$buying_price', `sell_price` = '$sell_price', `per_pcs_profit` = '$per_pcs_profit' WHERE `item_id`=$item_id";
			}
			if ($_POST['item_sale_permiss'] == 'Not_Allowed'){
				$item_sale_permiss = 'Not Allowed';
				$query="UPDATE `$table` SET `item_name`='$item_name', `item_unit`='$item_unit', `item_sale_permiss`='$item_sale_permiss' WHERE `item_id`=$item_id";
			}
		}else{
			$item_sale_permiss = $_POST['pre_item_sale_permiss'];
			//$sell_price = $_POST['pre_sell_price'];

			$query="UPDATE `$table` SET `item_name`='$item_name', `item_unit`='$item_unit', `item_sale_permiss`='$item_sale_permiss' WHERE `item_id`=$item_id";
		}

		//$query="UPDATE `$table` SET `item_name`='$item_name', `item_unit`='$item_unit', `item_sale_permiss`='$item_sale_permiss', `sell_price` = '$sell_price' WHERE `item_id`=$item_id";
		$stmt = $this->db->prepare($query);
		if ( $stmt->execute() === TRUE ) {
			echo 'SUCCESS';
		}else{
			echo 'FAILED';
		}
	}

	public function retrive($table)
	{
		//Fields_name_of_Carrying_fields
		$item_id = $_POST['item_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `item_status`=1 WHERE `item_id`=$item_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function delete($table)
	{
		//Fields_name_of_Carrying_fields
		$item_id = $_POST['item_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `item_status`=0 WHERE `item_id`=$item_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function load_item(){
		
		$searchTerm = $_POST["keyword"];
		$stmt = $this->db->prepare("SELECT * FROM  `item` WHERE `item_name` LIKE '%".$searchTerm."%' AND `item_status`=1");
		if ($searchTerm) {
		$stmt->execute();
		$item_data = '<ul id="item-list" style="box-sizing: border-box; list-style: decimal;">';
		$count = $stmt->rowCount();
		if($count > 0){ 
			$item_data .='<center><b style="color:red; margin-top:15px;">Existing items list</b></center>';
		    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    	$item = $row["item_name"];
		        $item_data .='<li>'.$item.'</li>';
		    }
		}
		$item_data .='</ul>';
		
		echo $item_data; die;
		}
	}
	
}