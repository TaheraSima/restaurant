<?php
//production Controller
class production extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'production');
	}
	
	public function index()
	{
		$data = $this->model->query_out('production.production_products_id=products.products_id AND production.production_id=production_details.production_details_production_id GROUP BY production.production_id ORDER BY production.production_date DESC', 'products.products_name,production.*,production_details.*', 'products,production,production_details');
		$data2 = $this->model->fetch('unit');
		$data3 = $this->model->query_out('products_status=1', '*', 'products');
		$data4 = $this->model->query_out('item_status=1', '*', 'item');
		$this->view->admin('production/index', $data, $data2, $data3, $data4);
	}

	public function all()
	{
		$data = $this->model->query_out('production.production_products_id=products.products_id AND production.production_id=production_details.production_details_production_id GROUP BY production.production_id ORDER BY production.production_date DESC', 'products.products_name,production.*,production_details.*', 'products,production,production_details');
		$data2 = $this->model->fetch('unit');
		$data3 = $this->model->query_out('products_status=1', '*', 'products');
		$data4 = $this->model->query_out('item_status=1', '*', 'item');
		$this->view->admin('production/index', $data, $data2, $data3, $data4);
	}

	public function production_details()
	{
		$data = $this->model->query_out('production.production_products_id=products.products_id AND production.production_id=production_details.production_details_production_id AND production.production_status=1 GROUP BY production.production_id ORDER BY production.production_date DESC', 'products.products_name,production.*,production_details.*', 'products,production,production_details');
		$data2 = $this->model->fetch('unit');
		$data3 = $this->model->fetch('products');
		$data4 = $this->model->query_out('item_status=1', '*', 'item');
		$this->view->admin('production/production_details', $data, $data2, $data3, $data4);
	}

	public function production_details_inactive()
	{
		$data = $this->model->query_out('production.production_products_id=products.products_id AND production.production_id=production_details.production_details_production_id AND production.production_status=0 GROUP BY production.production_id ORDER BY production.production_date DESC', 'products.products_name,production.*,production_details.*', 'products,production,production_details');
		$data2 = $this->model->fetch('unit');
		$data3 = $this->model->fetch('products');
		$data4 = $this->model->query_out('item_status=1', '*', 'item');
		$this->view->admin('production/production_details_inactive', $data, $data2, $data3, $data4);
	}
	
	public function save()
	{
		$data = $this->model->save('production');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('production_details');
		}else{
			$this->redirect('production_details');
		}
	}
	
	public function update(){
		$data = $this->model->update('production');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('production_details');
		}else{
			$this->redirect('production_details');
		}
	}

	public function delete(){
		$data = $this->model->delete('production');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('production_details');
		}else{
			$this->redirect('production_details');
		}
	}

	public function retrieve(){
		$data = $this->model->retrieve('production');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('production_details');
		}else{
			$this->redirect('production_details');
		}
	}

}