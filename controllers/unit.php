<?php
//unit Controller
class unit extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'unit');
	}
	
	public function index()
	{
		$data = $this->model->fetch('unit');
		$this->view->admin('unit/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('unit');
		$this->view->admin('unit/index', $data);
	}
	

	public function unit_details()
	{
		$data = $this->model->fetch('unit');
		$this->view->admin('unit/unit_details', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('unit');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('unit_details');
		}else{
			$this->redirect('unit_details');
		}
	}
	
	public function update(){
		$data = $this->model->update('unit');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('unit_details');
		}else{
			$this->redirect('unit_details');
		}
	}
	
	public function delete(){
		$data = $this->model->delete('unit');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('unit_details');
		}else{
			$this->redirect('unit_details');
		}
	}
	public function retrieve(){
		$data = $this->model->retrieve('unit');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('unit_details');
		}else{
			$this->redirect('unit_details');
		}
	}

}