<?php
//vat_setting Controller
class vat_setting extends BaseController
{
	public function __construct(){
		parent::__construct();
		Session::init();
		Auth::check($_SESSION['user_type'], 'vat_setting');
	}
	
	public function index()
	{
		$data = $this->model->query_out('1 ORDER BY vat_setting_id DESC', '*', 'vat_setting');
		$this->view->admin('vat_setting/index', $data);
	}

	public function all()
	{
		$data = $this->model->query_out('1 ORDER BY vat_setting_id DESC', '*', 'vat_setting');
		$this->view->admin('vat_setting/index', $data);
	}

	public function vat_details()
	{
		$data = $this->model->query_out('1 ORDER BY vat_setting_id DESC', '*', 'vat_setting');
		$this->view->admin('vat_setting/vat_details', $data);
	}
	
	public function save()
	{
		$data = $this->model->save('vat_setting');
		if ( $data == 'SUCCESS' ) {
			$this->redirect('vat_details');
		}else{
			$this->redirect('vat_details');
		}
	}
	
	public function update(){
		$data = $this->model->update('vat_setting');

		if ( $data == 'SUCCESS' ) {
			$this->redirect('vat_details');
		}else{
			$this->redirect('vat_details');
		}
	}

}