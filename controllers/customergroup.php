<?php
//customergroup Controller
class customergroup extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'customergroup');
	}
	
	public function index()
	{
		$data = $this->model->fetch('customergroup');
		$this->view->admin('customergroup/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('customergroup');
		$this->view->admin('customergroup/index', $data);
	}

	public function cusgroup_details()
	{
		$data = $this->model->fetch('customergroup');
		$this->view->admin('customergroup/cusgroup_details', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('customergroup');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('cusgroup_details');
		}else{
			$this->redirect('cusgroup_details');
		}
	}
	
	public function update(){
		$data = $this->model->update('customergroup');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('cusgroup_details');
		}else{
			$this->redirect('cusgroup_details');
		}
	}

}