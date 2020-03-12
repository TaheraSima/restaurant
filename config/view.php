<?php
//View Class For Common View
class View
{
	
	function __construct()
	{
		// $this->view = new View();
		// echo "SALMAN FROM VIEW";
	}

	function load($file, $data=[], $data2=[], $data3=[], $data4=[], $data5=[], $data6=[], $data7=[], $data8=[], $data9=[]){
		include('views/layout/header.php');
		include('views/layout/navbar.php');
		include('views/'.$file.'.php');
		include('views/layout/footer.php');
	}

	function login($file, $data=[], $data2=[], $data3=[], $data4=[], $data5=[], $data6=[], $data7=[], $data8=[], $data9=[]){
		include('views/'.$file.'.php');
	}

	function admin($file, $data=[], $data2=[], $data3=[], $data4=[], $data5=[], $data6=[], $data7=[], $data8=[], $data9=[]){
		include('views/layout/admin/header.php');
		include('views/layout/admin/topbar.php');
		include('views/layout/admin/sidebar.php');
		include('views/'.$file.'.php');
		include('views/layout/admin/footer.php');
	}
}