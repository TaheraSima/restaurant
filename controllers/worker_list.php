<?php
//Worker_List Controller
class Worker_List extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'worker_list');
	}
	
	public function index()
	{
		$data = $this->model->query_out("user_type NOT IN ('Master Admin','Super Admin')", '*', 'users');
		$this->view->admin('worker_list/index', $data);
	}

	public function all()
	{
		$data = $this->model->query_out("user_type NOT IN ('Master Admin','Super Admin')", '*', 'users');
		$this->view->admin('worker_list/index', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('users');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('users');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	function delete(){
		$data = $this->model->delete('users');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	function active(){
		$data = $this->model->active();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	function undodelete(){
		$data = $this->model->undodelete();

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}