<?php
//Customers Models
class Customers_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields
		$customers_name = $_POST['customers_name'];
		$customers_group_id = $_POST['customers_group_id'];
		$customers_address = $_POST['customers_address'];
		$customers_email = $_POST['customers_email'];
		$customers_phone = $_POST['customers_phone'];
		$customers_type = $_POST['customers_type'];
		if ($customers_group_id == '') {
			$customers_group_id = 6;
		}
		
		//For_Image_Files
		$file_tmp_name 	= $_FILES['customers_photo']['tmp_name'];
		$name 			= $_FILES['customers_photo']['name'];
		$file_ext 		= explode('.',$name);
		$file_ext 		= end($file_ext);
		$file_ext 		= strtolower($file_ext);
		$customers_photo= md5(rand()).'.'.$file_ext;

		if ($name == '') {
			$customers_photo = 'demo.png';
		}
		
		$stmt = $this->db->prepare("INSERT INTO `$table`(`customers_name`, `customers_type`, `customers_group_id`, `customers_address`, `customers_email`, `customers_phone`, `customers_photo`) VALUES ('$customers_name', '$customers_type', '$customers_group_id', '$customers_address', '$customers_email', '$customers_phone', '$customers_photo')");
		// print_r($stmt); die;
		if ( $stmt->execute() === TRUE ) {
			move_uploaded_file($file_tmp_name, 'assets/customers_photo/'.$customers_photo);
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function dueReceive($table)
	{
		//Fields_name_of_Carrying_fields
		$due_collection_customer_id = $_POST['customers_id'];
		$due_collection_receive_amount = $_POST['receive_amount'];
		$due_collection_date = $_POST['rcvdate'];



		$stmt = $this->db->prepare("INSERT INTO `due_collection` (`due_collection_customer_id`, `due_collection_receive_amount`, `due_collection_date`) VALUES ('$due_collection_customer_id', '$due_collection_receive_amount', '$due_collection_date')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}


	public function update($table)
	{
		//Fields_name_of_Carrying_fields
		$customers_id = $_POST['customers_id'];
		$customers_name = $_POST['customers_name'];
		$customers_group_id = $_POST['customers_group_id'];
		$customers_type = $_POST['customers_type'];
		$customers_address = $_POST['customers_address'];
		$customers_email = $_POST['customers_email'];
		$customers_phone = $_POST['customers_phone'];
		$customers_photo_pre = $_POST['customers_photo_pre'];
		//For_Image_Files
		$file_tmp_name 	= $_FILES['customers_photo']['tmp_name'];
		$name 			= $_FILES['customers_photo']['name'];
		$file_ext 		= explode('.',$name);
		$file_ext 		= end($file_ext);
		$file_ext 		= strtolower($file_ext);
		$customers_photo= md5(rand()).'.'.$file_ext;

		if ($name == '') {
			$customers_photo = $customers_photo_pre;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET `customers_name`='$customers_name', `customers_type`='$customers_type', `customers_group_id`='$customers_group_id', `customers_address`='$customers_address', `customers_email`='$customers_email', `customers_phone`='$customers_phone', `customers_photo`='$customers_photo' WHERE `customers_id`=$customers_id");
		if ( $stmt->execute() === TRUE ) {
			move_uploaded_file($file_tmp_name, 'assets/customers_photo/'.$customers_photo);
			$pre_file_link = 'assets/customers_photo/'.$customers_photo_pre;
			if (file_exists($pre_file_link) && $customers_photo_pre != 'demo.png') {
				if (unlink($pre_file_link)) {
					$data = "SUCCESS";
				}else{
					$data = "FAILED";
				}
			}else{
				$data = "SUCCESS";
			}
		}else{
			$data = 'FAILED';
		}
		return $data;
	}

	public function delete($table)
	{
		//Fields_name_of_Carrying_fields
		$customers_id = $_POST['customers_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `customers_status`=0 WHERE `customers_id`=$customers_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function retrieve($table)
	{
		//Fields_name_of_Carrying_fields
		$customers_id = $_POST['customers_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `customers_status`=1 WHERE `customers_id`=$customers_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}