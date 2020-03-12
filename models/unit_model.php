<?php
//unit Models
class unit_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields
		$unit_name = $_POST['unit_name'];
		$stmt = $this->db->prepare("INSERT INTO `$table`(`unit_name`) VALUES ('$unit_name')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function update($table)
	{
		$unit_name = $_POST['unit_name'];
		$unit_id = $_POST['unit_id'];
		
		$stmt = $this->db->prepare("UPDATE $table SET unit_name='$unit_name' WHERE unit_id=$unit_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function delete($table)
	{
		//Fields_name_of_Carrying_fields
		$unit_id = $_POST['unit_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `unit_status`=0 WHERE `unit_id`=$unit_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function retrieve($table)
	{
		//Fields_name_of_Carrying_fields
		$unit_id = $_POST['unit_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `unit_status`=1 WHERE `unit_id`=$unit_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
}