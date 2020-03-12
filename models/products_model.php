<?php include 'config/db_info.php' ?>
<?php
//Products Models
class Products_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		//For_Image_Files
		if ($_POST['category_id']== '') {
			$category_id = 7;
		}
		else
		{
			$category_id = $_POST['category_id'];			
		}
		
		$unit_type_id = $_POST['unit_type_id'];
		$products_name = $_POST['products_name'];
		$products_price = $_POST['products_price'];
		$products_cost = $_POST['products_cost'];
		$products_sku = $_POST['products_sku'];
		$products_barcode = $_POST['products_barcode'];
		$products_discount_price = $_POST['products_discount_price'];

		if ($_FILES['products_photo']['name'] != '') {
		  $products_photo = 'FILE-'.rand().$_FILES['products_photo']['name'];
		  $file_tmp =$_FILES['products_photo']['tmp_name'];
		  move_uploaded_file($file_tmp,"assets/products_photo/".$products_photo);
		}else{
			$products_photo = "defaultimg.jpg";
		}

		$stmt = $this->db->prepare("INSERT INTO `$table`(`category_id`, `unit_type_id`, `products_name`, `products_price`, `products_discount_price`, `products_cost`, `products_sku`, `products_barcode`, `products_photo`) VALUES ('$category_id', '$unit_type_id', '$products_name', '$products_price', '$products_discount_price', '$products_cost', '$products_sku', '$products_barcode', '$products_photo')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function update($table)
	{
		//Fields_name_of_Carrying_fields		
		$products_id             =  $_POST['products_id'];
		$unit_type_id            =  $_POST['unit_type_id'];
		$category_id             =  $_POST['category_id'];
		$products_name           =  $_POST['products_name'];
		$products_price          =  $_POST['products_price'];
		$products_discount_price =  $_POST['products_discount_price'];
		$products_cost           =  $_POST['products_cost'];


		$products_photo_pre =  $_POST['products_photo_pre'];
		$file_tmp_name 	    =  $_FILES['products_photo']['tmp_name'];
		$name 			    =  $_FILES['products_photo']['name'];
		$file_ext 		    =  explode('.',$name);
		$file_ext 		    =  end($file_ext);
		$file_ext 		    =  strtolower($file_ext);
		$products_photo     =  md5(rand()).'.'.$file_ext;

		if ($name == '') {
			$products_photo = $products_photo_pre;
		}
		
		$stmt = $this->db->prepare("UPDATE `$table` SET `category_id`='$category_id', `unit_type_id`='$unit_type_id', `products_name`='$products_name', `products_price`='$products_price',`products_cost`='$products_cost', `products_discount_price`='$products_discount_price', `products_photo`='$products_photo' WHERE `products_id`=$products_id");
		if ( $stmt->execute() === TRUE ){
			if ($name == !''){
				move_uploaded_file($file_tmp_name, 'assets/products_photo/'.$products_photo);
				$pre_file_link = 'assets/products_photo/'.$products_photo_pre;
				if (file_exists($pre_file_link) && $products_photo_pre != 'demo.png') {
					if (unlink($pre_file_link)) {
						$data = "SUCCESS";
					}else{
						$data = "FAILED";
					}
				}else{
					$data = "SUCCESS";
				}
			}
		}else{
			$data = 'FAILED';
		}
		return $data;
	}

	public function delete($table)
	{
		$products_id = $_POST['products_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `products_status`=0 WHERE `products_id`=$products_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function retrieve($table)
	{
		$products_id = $_POST['products_id'];
		$stmt = $this->db->prepare("UPDATE `$table` SET `products_status`=1 WHERE `products_id`=$products_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}

	public function load_item(){
		
		$searchTerm = $_POST["keyword"];
		$stmt = $this->db->prepare("SELECT * FROM  `products` WHERE `products_name` LIKE '%".$searchTerm."%' AND `products_status`=1");
		if ($searchTerm) {
		$stmt->execute();
		$item_data = '<ul id="item-list" style="box-sizing: border-box; list-style: decimal;">';
		$count = $stmt->rowCount();
		if($count > 0){ 
			$item ='';
			$item_data .='<center><b style="color:red; margin-top:15px;">Existing items list</b></center>';
		    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    	$item = $row["products_name"];
		        $item_data .='<li>'.$item.'</li>';
		    }
		}
		$item_data .='</ul>';
		 
		echo $item_data; die;
		}
	}
	
}