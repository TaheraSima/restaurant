<?php
//Category Controller
class Category extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'category');
	}
	
	public function index()
	{
		$data = $this->model->query_out('1 ORDER BY category_name ASC', '*', 'category');
		$this->view->admin('category/index', $data);
	}

	public function all()
	{
		$data = $this->model->query_out('1 ORDER BY category_name ASC', '*', 'category');
		$this->view->admin('category/index', $data);
	}
	
	public function category_details()
	{
		$data = $this->model->query_out('1 ORDER BY category_name ASC', '*', 'category');
		$this->view->admin('category/category_details', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('category');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('category_details');
		}else{
			$this->redirect('category_details');
		}
	}
	
	public function update(){
		$data = $this->model->update('category');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('category_details');
		}else{
			$this->redirect('category_details');
		}
	}
	public function delete(){
		$data = $this->model->delete('category');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('category_details');
		}else{
			$this->redirect('category_details');
		}
	}
	public function retrieve(){
		$data = $this->model->retrieve('category');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('category_details');
		}else{
			$this->redirect('category_details');
		}
	}
}