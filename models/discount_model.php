<?php
//discount Models
class discount_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields
		$discount_type = $_POST['discount_type'];
		$customer_group_id = $_POST['customer_id'];
		$discount_amount = $_POST['customer_discount_price'];

		$stmt = $this->db->prepare("INSERT INTO `$table`(`discount_type`,`customer_group_id`,`discount_amount`) VALUES ('$discount_type', '$customer_group_id', '$discount_amount')");
		
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	public function update($table)
	{
		//Fields_name_of_Carrying_fields
		$discount = $_POST['discount'];
		$discount_id = $_POST['discount_id'];

		$stmt = $this->db->prepare("UPDATE discount SET discount_amount = $discount WHERE discount_id = $discount_id ");
		
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function delete($table)
	{
		//Fields_name_of_Carrying_fields
		$discount_id = $_POST['discount_id'];

		$stmt = $this->db->prepare("UPDATE discount SET discount_status = 0 WHERE discount_id = $discount_id ");
		
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function retrieve($table)
	{
		//Fields_name_of_Carrying_fields
		$discount_id = $_POST['discount_id'];

		$stmt = $this->db->prepare("UPDATE discount SET discount_status = 1 WHERE discount_id = $discount_id ");
		
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}