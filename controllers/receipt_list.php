<?php
//receipt_list Controller
class receipt_list extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'receipt_list');
	}
	
	public function index()
	{
		$data = $this->model->query_out('1 ORDER BY company_settings_id DESC LIMIT 1', 'company_settings.*', 'company_settings');
		$data2 = $this->model->query_out('products.products_id=new_order.products_id AND order_main.id=new_order.order_id ORDER BY id DESC LIMIT 1', 'order_main.*, new_order.*, products.*', 'order_main, new_order, products');
		$data3 = $this->model->query_out('1 ORDER BY vat_setting_id DESC LIMIT 0,1','vat_setting.*','vat_setting');	
		$this->view->admin('receipt_list/index', $data, $data2, $data3);
	}

	public function all()
	{
		$data = $this->model->query_out('1 ORDER BY company_settings_id DESC LIMIT 1', 'company_settings.*', 'company_settings');
		$data2 = $this->model->query_out('products.products_id=new_order.products_id AND order_main.id=new_order.order_id ORDER BY id DESC LIMIT 1', 'order_main.*, new_order.*, products.*', 'order_main, new_order, products');
		$data3 = $this->model->query_out('1 ORDER BY vat_setting_id DESC LIMIT 0,1','vat_setting.*','vat_setting');	
		$this->view->admin('receipt_list/index', $data, $data2, $data3);
	}
	
	public function save()
	{
		$data = $this->model->save('receipt_list');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('receipt_list');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}