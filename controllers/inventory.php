<?php
//inventory Controller
class inventory extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'inventory');
	}
	
	public function index()
	{
		$data = $this->model->fetch('inventory');
		$this->view->admin('inventory/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('inventory');
		$this->view->admin('inventory/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('inventory');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('inventory');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}