<?php
//Sub_category Models
class Sub_category_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//For_Image_Files
		$category_id = $_POST['category_id'];
		$sub_category_name = $_POST['sub_category_name'];
		
		$stmt = $this->db->prepare("INSERT INTO `$table`(`category_id`,`sub_category_name`)VALUES('$category_id','$sub_category_name')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function update($table)
	{
		//Fields_name_of_Carrying_fields
		$sub_category_id = $_POST['sub_category_id'];
		$category_id = $_POST['category_id'];
		$sub_category_name = $_POST['sub_category_name'];
		$query="UPDATE `$table` SET `category_id`='$category_id', `sub_category_name`='$sub_category_name' WHERE `sub_category_id`=$sub_category_id";			
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
		$sub_category_id = $_POST['sub_category_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `sub_category_status`=0 WHERE `sub_category_id`=$sub_category_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}