<?php
//Sub_category Controller
class Sub_category extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'sub_category');
	}
	
	public function index()
	{
		$data = $this->model->query_out('sub_category.category_id=category.category_id', 'category.category_name, sub_category.*', 'category, sub_category');
		$data2 = $this->model->fetch('category');
		$this->view->admin('sub_category/index', $data, $data2);
	}

	public function all()
	{
		$data = $this->model->query_out('sub_category.category_id=category.category_id', 'category.category_name, sub_category.*', 'category, sub_category');
		$data2 = $this->model->fetch('category');
		$this->view->admin('sub_category/index', $data, $data2);
	}
	
	public function save()
	{
		$data = $this->model->save('sub_category');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('sub_category');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	public function delete(){
		$data = $this->model->delete('sub_category');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}