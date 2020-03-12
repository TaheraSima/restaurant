<?php
//new_order Controller
class new_order extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		// Auth::check($_SESSION['user_type'], 'new_order');
	}
	
	public function index()
	{
		$data = $this->model->query_out('order_main.customer_id=customers.customers_id AND new_order.order_id=order_main.id GROUP BY order_main.id', 'customers.customers_name,customers.customers_address,customers.customers_phone, order_main.*, new_order.*', 'customers, order_main, new_order');
		// $data2 = $this->model->fetch('products');
		$data2 = $this->model->query_out(' products.products_id = production.production_products_id AND production.production_status = 1', 'products.*, production.production_products_id, production.production_id', 'products, production');
		$data3 = $this->model->query_out('category_status = 1', '*', 'category');
		$data4 = $this->model->fetch('sub_category');
		$data5 = $this->model->query_out('1 ORDER BY vat_setting_id DESC LIMIT 0,1','vat_setting.*','vat_setting');
		$data6 = $this->model->fetch('item');
		$this->view->admin('new_order/index', $data, $data2, $data3, $data4, $data5, $data6);
	}

	public function all()
	{
		$data = $this->model->query_out('order_main.customer_id=customers.customers_id AND new_order.order_id=order_main.id GROUP BY order_main.id', 'customers.customers_name,customers.customers_address,customers.customers_phone, order_main.*, new_order.*', 'customers, order_main, new_order');
		// $data2 = $this->model->fetch('products');
		$data2 = $this->model->query_out('1', 'products.*', 'products');
		$data3 = $this->model->query_out('category_status = 1', '*', 'category');
		$data4 = $this->model->fetch('sub_category');
		$data5 = $this->model->query_out('1 ORDER BY vat_setting_id DESC LIMIT 0,1','vat_setting.*','vat_setting');
		$data6 = $this->model->fetch('item');
		$this->view->admin('new_order/index', $data, $data2, $data3, $data4, $data5, $data6);
	}
	
	public function save()
	{
		$data = $this->model->save('new_order');
		if ( $data == 'SUCCESS' ) {
			$this->redirect(url('receipt_list/all'));
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('new_order');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('../vat_setting/all');
		}else{
			$this->redirect('all');
		}
	}

	public function search(){
		$data = $this->model->search('new_order');
		return json_encode( $data, true);
	}
	public function discountsearch(){
		$data = $this->model->discountsearch('');
		return json_encode( $data, true);
	}

	public function searchd(){
		$data = $this->model->searchd('new_order');
		return json_encode( $data, true);
	}

	public function checkavailability(){
		$data = $this->model->checkavailability();
		// return json_encode( $data, true);
		// print_r($data);die;
		return $data;
	}

	public function checkrawavailability(){
		$data = $this->model->checkrawavailability();
		// return json_encode( $data, true);
		return $data;
	}

	public function checkdiscount(){
		$data = $this->model->checkdiscount();
		return json_encode( $data, true);
	}

}