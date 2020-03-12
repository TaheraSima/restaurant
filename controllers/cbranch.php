<?php
//cbranch Controller
class cbranch extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'cbranch');
	}
	
	public function index()
	{
		$data = $this->model->fetch('cbranch');
		$this->view->admin('cbranch/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('cbranch');
		$this->view->admin('cbranch/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('cbranch');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('cbranch');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}