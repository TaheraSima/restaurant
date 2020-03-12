<?php
//receipt_list Models
class receipt_list_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields

		//For_Image_Files
		
		$stmt = $this->db->prepare("INSERT INTO `$table`() VALUES ()");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}