<?php
//all_receipt Controller
class all_receipt extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'all_receipt');
	}
	
	public function index()
	{
		$data = $this->model->fetch('all_receipt');
		$data2 = $this->model->query_out('products.products_id=new_order.products_id AND order_main.id=new_order.order_id ', 'order_main.*, new_order.*, products.*', 'order_main, new_order, products');
		$data3 = $this->model->query_out('order_main.id=new_order.order_id AND order_main.user_id=users.user_id GROUP BY order_main.order_no ORDER BY order_main.id DESC', 'order_main.*, new_order.*, users.*', 'order_main, new_order, users');
		$data4 = $this->model->query_out('1 ORDER BY company_settings_id DESC LIMIT 1', 'company_settings.*', 'company_settings');		
		$this->view->admin('all_receipt/index', $data, $data2, $data3, $data4);
	}

	public function all()
	{
		$data = $this->model->fetch('all_receipt');
		$data2 = $this->model->query_out('products.products_id=new_order.products_id AND order_main.id=new_order.order_id', 'order_main.*, new_order.*, products.*', 'order_main, new_order, products');
		$data3 = $this->model->query_out('order_main.id=new_order.order_id AND order_main.user_id=users.user_id GROUP BY order_main.order_no ORDER BY order_main.id DESC', 'order_main.*, new_order.*, users.*', 'order_main, new_order, users');
		$data4 = $this->model->query_out('1 ORDER BY company_settings_id DESC LIMIT 1', 'company_settings.*', 'company_settings');		
		$this->view->admin('all_receipt/index', $data, $data2, $data3, $data4);
	}
	
	public function save()
	{
		$data = $this->model->save('all_receipt');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('all_receipt');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function dueReceive(){
		$data = $this->model->dueReceive('all_receipt');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function deliver(){
		$data = $this->model->deliver('all_receipt');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function cancel(){
		echo "cancel";
		$data = $this->model->cancel('all_receipt');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}