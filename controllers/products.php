<?php
//Products Controller
class Products extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'products');
	}
	
	public function index()
	{
		$data = $this->model->query_out('products.category_id=category.category_id AND products.unit_type_id = unit.unit_id AND products.products_status=1', 'category.category_name, unit.*, products.*', 'category, unit, products');
		$data2 = $this->model->query_out('category_status = 1', '*', 'category');
		$data3 = $this->model->fetch('unit');
		$data4 = $this->model->query_out('item_status=1', '*', 'item');
		$data5 = $this->model->fetch('unit');
		$data6 = $this->model->query_out('products_status=1', '*', 'products');

		$this->view->admin('products/index', $data, $data2, $data3, $data4, $data5, $data6);
	}

	public function all()
	{
		$data = $this->model->query_out('products.category_id=category.category_id AND products.unit_type_id = unit.unit_id AND products.products_status=1', 'category.category_name, unit.*, products.*', 'category, unit, products');
		$data2 = $this->model->query_out('category_status = 1', '*', 'category');
		$data3 = $this->model->fetch('unit');
		$data4 = $this->model->query_out('item_status=1', '*', 'item');
		$data5 = $this->model->fetch('unit');
		$data6 = $this->model->query_out('products_status=1', '*', 'products');

		$this->view->admin('products/index', $data, $data2, $data3, $data4, $data5, $data6);
	}

	public function products_details()
	{
		$data = $this->model->query_out('products.category_id=category.category_id AND products.unit_type_id = unit.unit_id AND products.products_status=1', 'category.category_name, unit.*, products.*', 'category, unit, products');
		$data2 = $this->model->query_out('category_status = 1', '*', 'category');
		$data3 = $this->model->fetch('unit');
		$data4 = $this->model->query_out('item_status=1', '*', 'item');
		$data5 = $this->model->fetch('unit');
		$data6 = $this->model->fetch('products');

		$this->view->admin('products/products_details', $data, $data2, $data3, $data4, $data5, $data6);
	}

	public function products_details_inactive()
	{
		$data = $this->model->query_out('products.category_id=category.category_id AND products.unit_type_id = unit.unit_id AND products.products_status=0', 'category.category_name, unit.*, products.*', 'category, unit, products');
		$data2 = $this->model->query_out('category_status = 0', '*', 'category');
		$data3 = $this->model->fetch('unit');
		$data4 = $this->model->query_out('item_status=1', '*', 'item');
		$data5 = $this->model->fetch('unit');
		$data6 = $this->model->fetch('products');

		$this->view->admin('products/products_details_inactive', $data, $data2, $data3, $data4, $data5, $data6);
	}
	
	public function save()
	{
		$data = $this->model->save('products');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('products_details');
		}else{
			$this->redirect('products_details');
		}
	}
	
	public function update(){
		$data = $this->model->update('products');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('products_details');
		}else{
			$this->redirect('products_details');
		}
	}
	
	public function delete(){
		$data = $this->model->delete('products');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('products_details');
		}else{
			$this->redirect('products_details');
		}
	}
	public function retrieve(){
		$data = $this->model->retrieve('products');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('products_details_inactive');
		}else{
			$this->redirect('products_details_inactive');
		}
	}

	public function additem()
	{
		$data = $this->model->fetch('add_item');
		$data2 = $this->model->query_out('category_status=1', '*', 'category');
		$data3 = $this->model->fetch('unit');
		$this->view->admin('products/additem', $data, $data2, $data3);
	}

	public function itemall()
	{
		$data = $this->model->fetch('add_item');
		$data2 = $this->model->fetch('category');
		$data3 = $this->model->fetch('unit');
		$this->view->admin('products/itemindex', $data, $data2, $data3);
	}

	public function load_item()
	{
		$data = $this->model->load_item('products');
		return json_encode( $data);
	}

}