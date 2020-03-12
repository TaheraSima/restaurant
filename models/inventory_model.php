<?php include 'config/db_info.php' ?>
<?php
//inventory Models
class inventory_Model extends Model
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