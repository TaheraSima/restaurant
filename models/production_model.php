<?php
//production Models
class production_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields
		$production_details_item_id = $_POST['products_id'];
		$item_id = $_POST['item_id'];
		// $prev_pur_qty = $_POST['closing_qty'];
		$production_details_unit = $_POST['production_details_unit'];
		$production_details_amount = $_POST['production_details_amount'];
		$closing_qty = $_POST['current_stock'];
		$c = count($item_id);

		$stmt = $this->db->prepare("INSERT INTO `production` (`production_products_id`) VALUES ('$production_details_item_id')");
		if ($stmt->execute()) {
			$id = $this->db->lastInsertId();
			for ($i=0; $i<$c; $i++ ) {
				$stmt = $this->db->prepare("INSERT INTO `production_details` ( `production_details_production_id`, `production_details_item_id`, `production_details_unit`, `production_details_amount`) VALUES ( $id, $item_id[$i], '$production_details_unit[$i]', '$production_details_amount[$i]')");

					$stmt->execute();
			}
		}
	}
	
	public function update($table)
	{
		//Fields_name_of_Carrying_fields		
		$production_details_item_id = $_POST['production_details_item_id'];
		//print_r($production_details_item_id) ; 
		$production_details_amount = $_POST['production_details_amount'];
		$production_details_production_id = $_POST['production_details_production_id'];
		//print_r($production_details_amount) ;
		$c = count($production_details_item_id);
		
			for ($i=0; $i<$c; $i++ ) {
				$stmt = $this->db->prepare("UPDATE production_details SET production_details_amount = '$production_details_amount[$i]' WHERE production_details_item_id= '$production_details_item_id[$i]' AND production_details_production_id = '$production_details_production_id[$i]' ");

					$stmt->execute();
			}
		
	}

	public function delete($table)
	{
		//Fields_name_of_Carrying_fields
		$production_id = $_POST['production_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `production_status`=0 WHERE `production_id`=$production_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function retrieve($table)
	{
		//Fields_name_of_Carrying_fields
		$production_id = $_POST['production_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `production_status`=1 WHERE `production_id`=$production_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}
