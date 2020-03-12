<?php
//all_receipt Models
class all_receipt_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{		
		$stmt = $this->db->prepare("INSERT INTO `$table`() VALUES ()");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function dueReceive($table)
	{		
		$rcv_amount = $_POST['rcv_amount'];
		$order_no = $_POST['order_no'];
		$stmt = $this->db->prepare("UPDATE order_main SET recv_amount = $rcv_amount, due_amount = 0 WHERE order_no = '$order_no' ");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function deliver($table)
	{		
		echo $order_main_id = $_POST['order_main_id'];
		date_default_timezone_set('Asia/Dhaka');	
		$dt = new DateTime('now');
		$datetim = $dt->format('Y-m-d H:i:s');
		$stmt = $this->db->prepare("UPDATE order_main SET order_status = 2, order_time = '$datetim' WHERE id = '$order_main_id' ");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function cancel($table)
	{		
		echo $order_main_id = $_POST['order_main_id'];
		date_default_timezone_set('Asia/Dhaka');	
		$dt = new DateTime('now');
		$datetim = $dt->format('Y-m-d H:i:s');
		$stmt = $this->db->prepare("UPDATE order_main SET order_status = 3, cancel_time = '$datetim' WHERE id = '$order_main_id' ");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}