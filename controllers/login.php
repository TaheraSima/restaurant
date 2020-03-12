<?php
//Login Controller
class Login extends BaseController
{
	
	public function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if ($logged == true) {
			$this->redirect("./dashboard");
			exit;
		}
	}
	public function index()
	{
		$this->view->login('login/login');
	}

	public function run()
	{
		$data = $this->model->login('users', 'username', 'password');		
		$error = "Username OR Password is Incorrect";
		if ( $data == 'SUCCESS') {
			if ($_SESSION['user_type'] == 4) {
				$this->redirect("../sales_report/all");
			}
			else{
				$this->redirect("../new_order/all");
			}
			
		}else{
			$_SESSION["error"] = $error;
			$this->redirect("../login");
		}
	}

}