<?php
//placeorder Controller
class placeorder extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'placeorder');
	}
	
	public function index()
	{
		$data = $this->model->fetch('placeorder');
		$this->view->admin('placeorder/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('placeorder');
		$this->view->admin('placeorder/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('placeorder');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('placeorder');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}