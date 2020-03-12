<?php
//hw Controller
class hw extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'hw');
	}
	
	public function index()
	{
		$data = $this->model->fetch('hw');
		$this->view->admin('hw/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('hw');
		$this->view->admin('hw/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('hw');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('hw');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}