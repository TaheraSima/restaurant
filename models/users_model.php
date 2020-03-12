<?php
//Users Model
class Users_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function usertype_save(){

		$user_type_name = $_POST['user_type_name'] ;
		$stmt = $this->db->prepare("INSERT INTO `user_type`(`user_type_name`) VALUES ('$user_type_name')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	function usertype_update(){

		$user_type_id = $_POST['user_type_id'];
		$user_type_name = $_POST['user_type_name'] ;
		$query="UPDATE `user_type` SET `user_type_name`='$user_type_name' WHERE `user_type_id`=$user_type_id";			
		$stmt = $this->db->prepare($query);
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function usertype_delete()
	{
		//Fields_name_of_Carrying_fields
		$user_type_id = $_POST['user_type_id'];
		$stmt = $this->db->prepare("UPDATE `user_type` SET `user_type_status`=0 WHERE `user_type_id`=$user_type_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	function save(){

		 if (isset($_SESSION['csrf_token_user_save']) && $_SESSION['csrf_token_user_save'] == $_POST['csrf_token_user_save']) {
		 	unset($_SESSION['csrf_token_user_save']);
			$password = md5($_POST['password']);			
			if ( $_POST['full_name'] != '' && $_POST['username'] != '' && $_POST['password'] != '' ) {
				$stmt = $this->db->prepare("INSERT INTO `users`( `full_name`, `username`, `password`, `user_type`, `user_status`) VALUES ('$_POST[full_name]','$_POST[username]','$password','$_POST[user_type]',0)");
				if ( $stmt->execute() === TRUE ) {
					$user_id = $this->db->lastInsertId();
					$user_id_md5 = md5($user_id);
					$upstmt = $this->db->prepare("UPDATE `users` SET `user_id_md5`='$user_id_md5' WHERE `user_id`=$user_id");
					if ($upstmt->execute() === TRUE) {
						return 'SUCCESS';
					}else{
						$upstmt = $this->db->prepare("DELETE * FROM `users` WHERE `user_id`=$user_id");
						return 'FAILED';
					}
				}else{
					return 'FAILED';
				}				
			}elseif( $_POST['full_name'] == '' &&  $_POST['username'] == '' &&  $_POST['password'] == '' ){
				$_SESSION['full_name']="Full Name Can not Empty";
				$_SESSION['username']="User Name Can not Empty";
				$_SESSION['password']="Password Can not Empty";
				return 'FAILED';
			}elseif( $_POST['full_name'] == '' &&  $_POST['username'] == '' ){
				$_SESSION['full_name']="Full Name Can not Empty";
				$_SESSION['username']="User Name Can not Empty";
				return 'FAILED';
			}elseif( $_POST['username'] == '' &&  $_POST['password'] == '' ){
				$_SESSION['username']="User Name Can not Empty";
				$_SESSION['password']="Password Can not Empty";
				return 'FAILED';
			}elseif( $_POST['full_name'] == '' &&  $_POST['password'] == '' ){
				$_SESSION['full_name']="Full Name Can not Empty";
				$_SESSION['password']="Password Can not Empty";
				return 'FAILED';
			}elseif( $_POST['username'] == '' ){
				$_SESSION['username']="User Name Can not Empty!";
				return 'FAILED';
			}elseif( $_POST['full_name'] == '' ){
				$_SESSION['full_name']="Full Name Can not Empty!";
				return 'FAILED';
			}elseif( $_POST['password'] == '' ){
				$_SESSION['password']="Password Can not Empty!";
				return 'FAILED';
			}else{
				return 'FAILED';
			}
		}else{
			unset($_SESSION['csrf_token_user_save']);
			return 'FAILED';
		}
	}

	function update(){
		$user_id_md5 = $_POST['user_id'];
		if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token'.$user_id_md5]) {
			if ( $_POST['full_name'] != '' && $_POST['username'] != '' && $_POST['user_type'] != '' ) {
				$upstmt = $this->db->prepare("UPDATE `users` SET `full_name`='".$_POST['full_name']."', `username`='".$_POST['username']."', `user_type`='".$_POST['user_type']."' WHERE `user_id_md5`='$user_id_md5'");
				if ( $upstmt->execute() === TRUE ) {
					return 'SUCCESS';
				}else{
					return 'FAILED01';
				}				
			}elseif( $_POST['full_name'] == '' &&  $_POST['username'] == '' ){
				$_SESSION['full_name']="Full Name Can not Empty";
				$_SESSION['username']="User Name Can not Empty";
				return 'FA ILED';
			}elseif( $_POST['full_name'] == '' ){
				$_SESSION['full_name']="Full Name Can not Empty";
				return 'FAI LED';
			}elseif( $_POST['username'] == '' ){
				$_SESSION['username']="User Name Can not Empty";
				return 'FAIL ED';
			}else{
				return 'FAILE D';
			}
		}else{
			return 'FAILED';
		}
	}

	function delete(){
		$user_id_md5 = $_POST['user_id'];
		if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token'.$user_id_md5]) {
			$upstmt = $this->db->prepare("UPDATE `users` SET `user_status`='3' WHERE `user_id_md5`='$user_id_md5'");
			if ( $upstmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}else{
			return 'FAILED';
		}
	}

	function undodelete(){
		$user_id_md5 = $_POST['user_id'];
		if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token'.$user_id_md5]) {
			$upstmt = $this->db->prepare("UPDATE `users` SET `user_status`='0' WHERE `user_id_md5`='$user_id_md5'");
			if ( $upstmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}else{
			return 'FAILED';
		}
	}

	function active(){
		$user_id_md5 = $_POST['user_id'];
		if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token'.$user_id_md5]) {
			$upstmt = $this->db->prepare("UPDATE `users` SET `user_status`='1' WHERE `user_id_md5`='$user_id_md5'");
			if ( $upstmt->execute() === TRUE ) {
				return 'SUCCESS';
			}else{
				return 'FAILED';
			}
		}else{
			return 'FAILED';
		}
	}

	function access_save(){
		$username = $_POST['user_name_select'];
		$access = $_POST['access'];
		foreach ($access as $menu_id) {
			$statement = $this->db->prepare("SELECT main_menu_has_access FROM main_menu WHERE main_menu_id=$menu_id");
			$statement->execute();
			$data = $statement->fetchAll();
			$access_old = '';
			foreach ($data as $value) {
				$access_old .= $value['main_menu_has_access'];
			}

			$single_access = explode(',', $access_old);
			if ( !in_array($username, $single_access)) {
				$access_old .= ','.$username;
			}
			$stmnt = $this->db->prepare("UPDATE `main_menu` SET `main_menu_has_access`='$access_old' WHERE main_menu_id=$menu_id");
			if ($stmnt->execute()) {
				$return = "SUCCESS";
			}
		}
		return $return;
	}

}