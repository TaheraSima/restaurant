<?php
//Main_menu Controller
class Main_menu extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'main_menu');
	}
	
	public function index()
	{
		$data = $this->model->fetch('users');
		$data_x = $this->model->fetch('main_menu');
		$this->view->admin('menu/create_main_menu', $data_x, $data);
	}

	public function all()
	{
		$data = $this->model->fetch('users');
		$data_x = $this->model->fetch('main_menu');
		$this->view->admin('menu/create_main_menu', $data_x, $data);
	}
	
	public function save()
	{
		$data = $this->model->save('main_menu');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	function update(){
		$data = $this->model->update('main_menu');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}