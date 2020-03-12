<?php
//Category Models
class Category_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields
		$category_name= $_POST['category_name'];
		$stmt = $this->db->prepare("INSERT INTO `$table`(`category_name`) VALUES ('$category_name')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function update($table)
	{
		//Fields_name_of_Carrying_fields
		$category_id = $_POST['category_id'];
		$category_name = $_POST['category_name'] ;
		$query="UPDATE `$table` SET `category_name`='$category_name' WHERE `category_id`=$category_id";			
		$stmt = $this->db->prepare($query);
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function delete($table)
	{
		//Fields_name_of_Carrying_fields
		$category_id = $_POST['category_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `category_status`=0 WHERE `category_id`=$category_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function retrieve($table)
	{
		//Fields_name_of_Carrying_fields
		$category_id = $_POST['category_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `category_status`=1 WHERE `category_id`=$category_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}