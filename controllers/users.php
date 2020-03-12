<?php
// Users Controller
class Users extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'users');
	}

	function index(){
		$data = $this->model->fetch('users');
		$data2 = $this->model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$data3 = $this->model->query_out('user_status=1 AND user_type != 1 ORDER BY user_id DESC', '*', 'users');
		$this->view->admin('users/index', $data, $data2, $data3);
	}
	
	function all(){
		$data = $this->model->fetch('users');
		$data2 = $this->model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$data3 = $this->model->query_out('user_status=1 AND user_type != 1 ORDER BY user_id DESC', '*', 'users');
		$this->view->admin('users/index', $data, $data2, $data3);
	}
	
	function user_details(){
		$data = $this->model->fetch('users');
		$data2 = $this->model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$data3 = $this->model->query_out('user_type != 1 ORDER BY user_id DESC', '*', 'users');
		$this->view->admin('users/user_details', $data, $data2, $data3);
	}

	function create(){
		$data = $this->model->fetch('users');
		$data2 = $this->model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$this->view->admin('users/create', $data, $data2);
	}

	function create_usertype(){
		$data = $this->model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$this->view->admin('users/create_usertype', $data);
	}

	function all_usertype(){
		$data = $this->model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$this->view->admin('users/create_usertype', $data);
	}

	function save(){
		$data = $this->model->save();
		if ( $data == 'SUCCESS' ) {
			$this->redirect('user_details');
		}else{
			$this->redirect('user_details');
		}
	}

	function update(){
		$data = $this->model->update();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('user_details');
		}else{
			$this->redirect('user_details');
		}
	}

	function delete(){
		$data = $this->model->delete();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('user_details');
		}else{
			$this->redirect('user_details');
		}
	}

	function usertype_save(){
		$data = $this->model->usertype_save();
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all_usertype');
		}else{
			$this->redirect('all_usertype');
		}
	}

	function usertype_update(){
		$data = $this->model->usertype_update();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all_usertype');
		}else{
			$this->redirect('all_usertype');
		}
	}

	function usertype_delete(){
		$data = $this->model->usertype_delete();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all_usertype');
		}else{
			$this->redirect('all_usertype');
		}
	}

	function undodelete(){
		$data = $this->model->undodelete();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('user_details');
		}else{
			$this->redirect('user_details');
		}
	}

	function active(){
		$data = $this->model->active();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('user_details');
		}else{
			$this->redirect('user_details');
		}
	}

	function accesscreate(){
		$data = $this->model->query_out('user_type!=1', '*', 'users');
		$menu = $this->model->fetch('main_menu');
		$this->view->admin('users/accesscreate', $data, $menu);
	}

	function access_save(){
		$data = $this->model->access_save();
		if ( $data == 'SUCCESS' ) {
			// $this->redirect('../main_menu/all');
			$this->redirect('accesscreate');
		}else{
			// $this->redirect('../main_menu/all');
			$this->redirect('accesscreate');
		}
	}

	public function checkoutaccess()
	{
		$username = $_POST['user'];
		$data = $this->model->fetch_json_menu('main_menu_id,main_menu_has_access', 'main_menu', $username);
		return $data;
	}
}