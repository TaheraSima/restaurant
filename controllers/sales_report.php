<?php
//sales_report Controller
class sales_report extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'sales_report');
	}
	
	public function index()
	{
		$data = $this->model->fetch('sales_report');
		$data2 = $this->model->fetch('order_main');
		$data3 = $this->model->fetch('category');
		$this->view->admin('sales_report/index', $data, $data2, $data3);
	}

	public function all()
	{
		$data = $this->model->fetch('sales_report');
		$data2 = $this->model->fetch('order_main');
		$data3 = $this->model->fetch('category');
		$this->view->admin('sales_report/index', $data, $data2, $data3);
	}
	public function index_categorysale()
	{		
		$data = $this->model->fetch('sales_report');
		$data4 = $this->model->fetch('category');
		$data5 = $this->model->fetch('categorysale');
		$this->view->admin('sales_report/index_categorysale', $data, $data4, $data5);
	}
	public function index_productsale()
	{		
		$data = $this->model->fetch('sales_report');
		$this->view->admin('sales_report/index_productsale', $data);
	}
	public function sales_by_item()
	{		
		$data = $this->model->fetch('sales_report');
		$this->view->admin('sales_report/sales_by_item', $data);
	}
	public function index_receivablesale()
	{		
		$data = $this->model->fetch('sales_report');
		$this->view->admin('sales_report/index_receivablesale', $data);
	}
	public function receipts()
	{		
		$data = $this->model->fetch('sales_report');
		$this->view->admin('sales_report/receipts', $data);
	}
	public function sales_by_employee()
	{		
		$data = $this->model->fetch('sales_report');
		$this->view->admin('sales_report/sales_by_employee', $data);
	}
	public function sales_by_payment_type()
	{		
		$data = $this->model->fetch('sales_report');
		$this->view->admin('sales_report/sales_by_payment_type', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('sales_report');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('sales_report');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}