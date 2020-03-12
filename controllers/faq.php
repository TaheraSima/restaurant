<?php
//faq Controller
class faq extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'faq');
	}
	
	public function index()
	{
		$data = $this->model->fetch('faq');
		$this->view->admin('faq/index', $data);
	}

	public function all()
	{
		$data = $this->model->fetch('faq');
		$this->view->admin('faq/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('faq');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('faq');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}