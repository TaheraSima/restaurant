<?php
//test Controller
class test extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'test');
	}
	
	public function index()
	{
		$data = $this->model->fetch('test');
		$this->view->admin('test/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('test');
		$this->view->admin('test/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('test');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('test');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}