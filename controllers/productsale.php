<?php
//productsale Controller
class productsale extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'productsale');
	}
	
	public function index()
	{
		$data = $this->model->fetch('productsale');
		$this->view->admin('productsale/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('productsale');
		$this->view->admin('productsale/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('productsale');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('productsale');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}