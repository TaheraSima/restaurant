<?php
//customergroup Models
class customergroup_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields
		$customergroup_name = $_POST['customergroup_name'];

		$stmt = $this->db->prepare("INSERT INTO `$table`(customergroup_name) VALUES ('$customergroup_name')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function update($table)
	{
		//Fields_name_of_Carrying_fields
		$customergroup_id = $_POST['customergroup_id'];
		$customergroup_name = $_POST['customergroup_name'];

		$stmt = $this->db->prepare("UPDATE `$table` SET customergroup_name = '$customergroup_name' WHERE customergroup_id = $customergroup_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}