<?php
//categorysale Controller
class categorysale extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'categorysale');
	}
	
	public function index()
	{
		$data = $this->model->fetch('categorysale');
		$this->view->admin('categorysale/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('categorysale');
		$this->view->admin('categorysale/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('categorysale');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('categorysale');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}