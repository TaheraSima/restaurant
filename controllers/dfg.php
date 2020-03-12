<?php
//dfg Controller
class dfg extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'dfg');
	}
	
	public function index()
	{
		$data = $this->model->fetch('dfg');
		$this->view->admin('dfg/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('dfg');
		$this->view->admin('dfg/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('dfg');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('dfg');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}