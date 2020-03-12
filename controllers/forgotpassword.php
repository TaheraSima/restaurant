<?php
//forgotpassword Controller
class forgotpassword extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'forgotpassword');
	}
	
	public function index()
	{
		$data = $this->model->fetch('users');
		$data2 = $this->model->query_out('user_status=1 AND user_type != 1', '*', 'users');
		$this->view->admin('forgotpassword/index', $data, $data2);
	}

	public function all()
	{
		$data = $this->model->fetch('users');
		$data2 = $this->model->query_out('user_status=1 AND user_type != 1', '*', 'users');
		$this->view->admin('forgotpassword/index', $data, $data2);
	}
	
	public function company_index()
	{
		$data = $this->model->fetch('company_settings');
		$data2 = $this->model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$data3 = $this->model->query_out('user_status=1 AND user_type != 1', '*', 'users');
		$this->view->admin('company_settings/index', $data, $data2, $data3);
	}

	public function save()
	{
		$data = $this->model->save('forgotpassword');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('company_index');
		}else{
			$this->redirect('company_index');
		}
	}
	
	public function update(){
		$data = $this->model->update('forgotpassword');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('company_index');
		}else{
			$this->redirect('company_index');
		}
	}

}