<?php
//Item Controller
class Item extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		// Auth::check($_SESSION['user_type'], 'item');
	}
	
	public function index()
	{
		// $data = $this->model->fetch('item');
		$data2 = $this->model->fetch('unit');
		$data = $this->model->query_out('item.item_unit=unit.unit_id ORDER BY item.item_name ASC', 'unit.unit_name, unit.unit_id , item.*', 'unit, item');
		$data3 = $this->model->fetch('customergroup');
		$this->view->admin('item/index', $data, $data2, $data3);
	}

	public function all()
	{
		// $data = $this->model->fetch('item');
		$data2 = $this->model->fetch('unit');
		$data = $this->model->query_out('item.item_unit=unit.unit_id ORDER BY item.item_name ASC', 'unit.unit_name, unit.unit_id , item.*', 'unit, item');
		$data3 = $this->model->fetch('customergroup');
		$this->view->admin('item/index', $data, $data2, $data3);
	}

// new code start for new design
	public function item_details()
	{
		// $data = $this->model->fetch('item');
		$data2 = $this->model->fetch('unit');
		$data = $this->model->query_out('item.item_unit=unit.unit_id ORDER BY item.item_name ASC', 'unit.unit_name, unit.unit_id , item.*', 'unit, item');
		$this->view->admin('item/item_details', $data, $data2);
	}

// new code start for new design
	public function item_details_inactive()
	{
		// $data = $this->model->fetch('item');
		$data2 = $this->model->fetch('unit');
		$data = $this->model->query_out('item.item_unit=unit.unit_id ORDER BY item.item_name ASC', 'unit.unit_name, unit.unit_id , item.*', 'unit, item');
		$this->view->admin('item/item_details_retrive', $data, $data2);
	}
// new code end for new design
	
	public function retrive()
	{
		$data = $this->model->retrive('item');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('item_details_inactive');
		}else{
			$this->redirect('item_details_inactive');
		}
	}
// new code end for new design
	
	public function save()
	{
		$data = $this->model->save('item');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('item_details');
		}else{
			$this->redirect('item_details');
		}
	}
	
	public function update(){
		$data = $this->model->update('item');
		return $data;
		// if ( $data == 'SUCCESS' ) {
		// 	$this->redirect('item_details');
		// }else{
		// 	$this->redirect('item_details');
		// }
	}

	function delete(){
		$data = $this->model->delete('item');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('item_details');
		}else{
			$this->redirect('item_details');
		}
	}

	public function load_item()
	{
		$data = $this->model->load_item('products');
		if ($data != '') {
			return json_encode( $data, true);
		}
		else{
			$data = 'Write Item Name' ;
			return json_encode( $data, true);
		}
		// return json_encode( $data, true);
	}

}