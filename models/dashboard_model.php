<?php
//Dashboard Model
class Dashboard_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function changeAndUploadAndDelete(){
		$user_photo_pre	= $_POST['user_photo_pre'];
		$user_id 		= $_POST['user_id'];
		$file_tmp_name 	= $_FILES['user_photo']['tmp_name'];
		$name 			= $_FILES['user_photo']['name'];
		$file_ext 		= explode('.',$name);
		$file_ext 		= end($file_ext);
		$file_ext 		= strtolower($file_ext);
		$file_name		= md5(rand()).'.'.$file_ext;

		$stmt = $this->db->prepare("UPDATE `users` SET `user_photo`='$file_name' WHERE `user_id`=$user_id");
		if ($stmt->execute()) {
			move_uploaded_file($file_tmp_name, 'assets/user_photo/'.$file_name);
			$pre_file_link = 'assets/user_photo/'.$user_photo_pre;
			if (file_exists($pre_file_link)) {
				if (unlink($pre_file_link)) {
					$_SESSION['user_photo'] = $file_name;
					$data = "SUCCESS";
				}else{
					$data = "FAILED";
				}
			}else{
				$_SESSION['user_photo'] = $file_name;
				$data = "SUCCESS";
			}
		}else{
			$_SESSION['user_photo'] = $file_name;
			$data = "SUCCESS";
		}
		return $data;
	}

	// public function query_out_dash($where, $targets, $tables)
	// {
	// 	$retData = [];
	// 	$string = '[';
	// 	$stmt = $this->db->prepare("SELECT ".$targets." FROM ".$tables." WHERE 1 AND ".$where);
	// 	$stmt->execute();
	// 	$data = $stmt->fetchAll();
	// 	foreach ($data as $d) {
	// 		$dt = new DateTime($d['order_date']);
	// 		$dt = $dt->format('d-m-Y');
	// 		if (!in_array($dt, $retData)) {
	// 			array_push($retData, $dt);
	// 			$string .='"'.$dt.'",';
	// 		}			
	// 	}
	// 	$string = substr($string,0,-1);
	// 	$string .= ']';
	// 	return $string;
	// }

	
}