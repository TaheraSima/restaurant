<?php
//store Controller
class store extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'store');
	}
	
	public function index()
	{
		$data = $this->model->fetch('store');
		$data2 = $this->model->query_out('m_store.m_store_id=material_store.m_store_id AND material_store.item_id=item.item_id AND material_store.purchase_unit=unit.unit_id GROUP BY material_store.item_id', 'm_store.*, material_store.*, item.*, unit.*', 'm_store, material_store, item, unit');
		$this->view->admin('store/index', $data, $data2);
	}

	public function all()
	{
		$data = $this->model->fetch('store');
		$data3 = $this->model->fetch('item');
		$data2 = $this->model->query_out('m_store.m_store_id=material_store.m_store_id AND material_store.item_id=item.item_id AND material_store.purchase_unit=unit.unit_id GROUP BY material_store.item_id', 'm_store.*, material_store.*, item.*, unit.*', 'm_store, material_store, item, unit');
		$this->view->admin('store/index', $data, $data2, $data3);
	}
	
	public function save()
	{
		$data = $this->model->save('store');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('store');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

}