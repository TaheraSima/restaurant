<?php
// Dashboard Controller
class Dashboard extends BaseController
{
	
	public function __construct()
	{
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'dashboard');
	}

	public function index(){
		$data['pro_photo'] = $this->model->findProfilephoto('users', 'user_id', $_SESSION['user_id'], 'user_photo');
		$data2 = $this->model->in_out($_SESSION['user_id'], 'user_id', '*', 'users');
		$data2 = json_encode( $data2 );
		$data3 = $this->dashboard_data();
		$this->view->admin('admin/dashboard', $data, $data2, $data3);
	}

	public function last7dayssales(){
		$data = $this->model->query_out_dash("order_date >= DATE_ADD(CURDATE(),INTERVAL -7 DAY) GROUP BY order_date ORDER BY order_date ASC", "order_date", "order_main");
		return $data;
	}

	public function last7dayssalesamount(){
		$data = $this->model->query_out_dash("order_date >= DATE_ADD(CURDATE(),INTERVAL -7 DAY) GROUP BY order_date ORDER BY order_date ASC", "SUM(net_amount)", "order_main");
		return json_encode( $data, true );
	}

	public function dashboard_data(){
		$data['users'] = $this->model->fetchAndCount('users');
		$data['main_menu'] = $this->model->fetchAndCount('main_menu');
		$data['sub_menu'] = $this->model->fetchAndCount('sub_menu');
		return json_encode( $data );
	}

	public function topMenu(){
		$data = $this->model->fetch('top_menu');
		return json_encode( $data );
	}

	public function changepassword($id){
		$this->view->photo = $this->model->findProfilephoto('users', 'user_id', $_SESSION['user_id'], 'user_photo');
		$this->view->data = $this->model->findProfile('users', 'user_id_md5', $id);
		$this->view->admin('admin/changepassword');
	}

	public function profile($id){
		$this->view->photo = $this->model->findProfilephoto('users', 'user_id', $_SESSION['user_id'], 'user_photo');
		$this->view->data = $this->model->findProfile('users', 'user_id_md5', $id);
		$this->view->admin('admin/profile');
	}

	public function changePhoto(){
		$data = $this->model->changeAndUploadAndDelete();
		$this->redirect('profile/'.md5(rand()).md5($_SESSION['user_id']));
	}
}