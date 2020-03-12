<?php
//receivablesale Controller
class receivablesale extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'receivablesale');
	}
	
	public function index()
	{
		$data = $this->model->fetch('receivablesale');
		$this->view->admin('receivablesale/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('receivablesale');
		$this->view->admin('receivablesale/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('receivablesale');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('receivablesale');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}