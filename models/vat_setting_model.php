<?php
//vat_setting Models
class vat_setting_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields
		$vat_setting_value = $_POST['vat_setting_value'];
		$stmt = $this->db->prepare("INSERT INTO `$table`(`vat_setting_value`) VALUES ($vat_setting_value)");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function update($table)
	{
		//Fields_name_of_Carrying_fields
		$vat_setting_id = $_POST['vat_setting_id'];
		$vat_setting_value = $_POST['vat_setting_value'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `vat_setting_value` = $vat_setting_value WHERE vat_setting_id = $vat_setting_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}