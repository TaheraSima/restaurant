<?php
//Customers Controller
class Customers extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'customers');
	}
	
	public function index()
	{
		$data = $this->model->query_out('customergroup.customergroup_id=customers.customers_group_id', 'customers.*, customergroup.*', 'customers, customergroup');
		$data2 = $this->model->fetch('customergroup');
		$this->view->admin('customers/index', $data, $data2);
	}

	public function all()
	{
		$data = $this->model->query_out('customergroup.customergroup_id=customers.customers_group_id', 'customers.*, customergroup.*', 'customers, customergroup');
		$data2 = $this->model->fetch('customergroup');
		$this->view->admin('customers/index', $data, $data2);
	}

	public function onlinesale()
	{
		$data = $this->model->query_out('customergroup.customergroup_id=customers.customers_group_id AND customers_type = "Business" ', 'customers.*, customergroup.*', 'customers, customergroup');
		$data2 = $this->model->fetch('customergroup');
		$this->view->admin('customers/onlinesale', $data, $data2);
	}
	
	public function save()
	{
		$data = $this->model->save('customers');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function dueReceive()
	{
		// echo "contrl";die();
		$data = $this->model->dueReceive('customers');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('onlinesale');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('customers');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	public function delete(){
		$data = $this->model->delete('customers');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	public function retrieve(){
		$data = $this->model->retrieve('customers');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}