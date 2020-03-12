<?php
//New_Purchase Controller
class New_Purchase extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'new_purchase');
	}
	
	public function index()
	{
		$data = $this->model->query_out('new_purchase.req_id=requisition.id AND requisition.user_id=users.user_id AND new_purchase.item_id=item.item_id GROUP BY new_purchase.req_id', 'requisition.id, requisition.req_no, users.full_name, requisition.date, requisition.status, item.item_name, new_purchase.*', 'requisition, users, item, new_purchase');
		$data2 = $this->model->fetch('unit');
		$data3 = $this->model->fetch('item');
		$data4 = $this->model->fetch('new_purchase');
		$this->view->admin('new_purchase/index', $data, $data2, $data3, $data4);
	}

	public function all()
	{
		$data = $this->model->query_out('new_purchase.req_id=requisition.id AND requisition.user_id=users.user_id AND new_purchase.item_id=item.item_id GROUP BY new_purchase.req_id', 'requisition.id, requisition.req_no, users.full_name, requisition.date, requisition.status, item.item_name, new_purchase.*', 'requisition, users, item, new_purchase');
		$data2 = $this->model->fetch('unit');
		$data3 = $this->model->fetch('item');
		$data4 = $this->model->fetch('new_purchase');
		$this->view->admin('new_purchase/index', $data, $data2, $data3, $data4);
	}
	
	public function save()
	{
		$data = $this->model->save('new_purchase');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}
	
	public function update(){
		$data = $this->model->update('new_purchase');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('all');
		}else{
			$this->redirect('all');
		}
	}

	public function searchd(){
		$data = $this->model->searchd('new_purchase');
		return json_encode( $data, true);
	}
	public function searchd_unit(){
		$data = $this->model->searchd_unit('new_purchase');
		return json_encode( $data, true);
	}

}