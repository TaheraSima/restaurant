<?php
//Company_Settings Controller
class Company_Settings extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'company_settings');
	}
	
	public function index()
	{
		$data = $this->model->fetch('company_settings');
		$data2 = $this->model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$data3 = $this->model->query_out('user_status=1 AND user_type != 1', '*', 'users');
		$data4 = $this->model->fetch('customergroup');
		$this->view->admin('company_settings/index', $data, $data2, $data3, $data4);
	}

	public function all()
	{
		$data = $this->model->fetch('company_settings');
		$data2 = $this->model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$data3 = $this->model->query_out('user_status=1 AND user_type != 1', '*', 'users');
		$data4 = $this->model->fetch('customergroup');
		$this->view->admin('company_settings/index', $data, $data2, $data3, $data4);
	}

	public function company_details()
	{
		$data = $this->model->fetch('company_settings');
		$data2 = $this->model->query_out('user_type_status=1 AND user_type_id!=1', '*', 'user_type');
		$data3 = $this->model->query_out('user_status=1 AND user_type != 1', '*', 'users');
		$this->view->admin('company_settings/company_details', $data, $data2, $data3);
	}
	
	public function save()
	{
		$data = $this->model->save('company_settings');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('company_details');
		}else{
			$this->redirect('company_details');
		}
	}
	
	public function update(){
		$data = $this->model->update('company_settings');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('company_details');
		}else{
			$this->redirect('company_details');
		}
	}

}