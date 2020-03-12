<?php
//forgotpassword Models
class forgotpassword_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//Fields_name_of_Carrying_fields

		//For_Image_Files

		$password = md5($_POST['password']);
		$passwordmatch = $_POST['password'];
		$pass = $_POST['pass'];
		$user_id = $_POST['user_id'];
		if ($_POST['user_id'] != '' && $_POST['password'] != '' ) {
			if ($passwordmatch == $pass ) {
				$stmt = $this->db->prepare("UPDATE users SET password = '$password' WHERE user_id =  $user_id ");
				if ( $stmt->execute() === TRUE ) {
					return 'SUCCESS';
				}else{
					return 'FAILED';
				}
			}
		
		}
		else{
			return 'Password Not Matched';
		}
	}
	
}