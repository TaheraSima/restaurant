<?php
//discount Controller
class discount extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'discount');
	}
	
	public function index()
	{
		$data = $this->model->fetch('discount');
		$data2 = $this->model->fetch('products');
		$data3 = $this->model->fetch('customergroup');
		$this->view->admin('discount/index', $data, $data2, $data3);
	}

	public function all()
	{
		$data = $this->model->fetch('discount');
		$data2 = $this->model->fetch('products');
		$data3 = $this->model->fetch('customergroup');
		$this->view->admin('discount/index', $data, $data2, $data3);
	}

	public function discount_details()
	{
		$data = $this->model->fetch('discount');
		$data2 = $this->model->fetch('products');
		$data3 = $this->model->fetch('customergroup');
		$this->view->admin('discount/discount_details', $data, $data2, $data3);
	}
	
	public function save()
	{
		$data = $this->model->save('discount');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('discount_details');
		}else{
			$this->redirect('discount_details');
		}
	}
	
	public function update(){
		$data = $this->model->update('discount');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('discount_details');
		}else{
			$this->redirect('discount_details');
		}
	}
	
	public function delete(){
		$data = $this->model->delete('discount');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('discount_details');
		}else{
			$this->redirect('discount_details');
		}
	}
	
	public function retrieve(){
		$data = $this->model->retrieve('discount');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('discount_details');
		}else{
			$this->redirect('discount_details');
		}
	}

}