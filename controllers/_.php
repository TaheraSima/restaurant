<?php
//_ Controller
class _ extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], '_');
	}
	
	public function index()
	{
		$data = $this->model->fetch('_');
		$this->view->admin('_/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('_');
		$this->view->admin('_/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('_');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('_');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}