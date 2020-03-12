<?php
//suppliers Models
class suppliers_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		$suppliers_name = $_POST['suppliers_name'];
		$suppliers_business_name = $_POST['suppliers_business_name'];
		$suppliers_phone = $_POST['suppliers_phone'];
		$suppliers_address = $_POST['suppliers_address'];
		
		$stmt = $this->db->prepare("INSERT INTO `$table`(`suppliers_name`, `suppliers_business_name`, `suppliers_phone`, `suppliers_address`) VALUES ('$suppliers_name', '$suppliers_business_name', '$suppliers_phone', '$suppliers_address')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function update($table)
	{
		$suppliers_id = $_POST['suppliers_id'];
		$suppliers_name = $_POST['suppliers_name'];
		$suppliers_business_name = $_POST['suppliers_business_name'];
		$suppliers_phone = $_POST['suppliers_phone'];
		$suppliers_address = $_POST['suppliers_address'];
		
		$stmt = $this->db->prepare("UPDATE $table SET suppliers_name='$suppliers_name', suppliers_business_name='$suppliers_business_name', suppliers_phone='$suppliers_phone', suppliers_address='$suppliers_address' WHERE suppliers_id=$suppliers_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}