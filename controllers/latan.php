<?php
//latan Controller
class latan extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'latan');
	}
	
	public function index()
	{
		$data = $this->model->fetch('latan');
		$this->view->admin('latan/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('latan');
		$this->view->admin('latan/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('latan');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('latan');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}