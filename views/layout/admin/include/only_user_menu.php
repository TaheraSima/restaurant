<?php
	// require ('config/db_info.php');
	$userFromSession = $_SESSION['username'];
	$con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

	$sql = "SELECT * FROM main_menu WHERE main_menu_status=1 ORDER BY main_menu_rank ASC";
	$run_sql = mysqli_query($con, $sql);
	$menu = '';
	while ($main = mysqli_fetch_assoc($run_sql)) {
		$main_menu_name = $main['main_menu_name'];
		$main_menu_icon = $main['main_menu_icon'];
		$main_menu_link = $main['main_menu_link'];
		$main_menu_id = $main['main_menu_id'];
		$main_menu_has_access = $main['main_menu_has_access'];
		$assess = explode(',', $main_menu_has_access);
		if (in_array($userFromSession, $assess)) {
		
			$sub_sql = "SELECT * FROM sub_menu WHERE sub_menu_main=$main_menu_id AND sub_menu_status=1 ORDER BY sub_menu_rank ASC";
			$run_sub_sql = mysqli_query($con, $sub_sql);
			if (mysqli_num_rows($run_sub_sql) > 0) {
				$menu .= '<li class="menu-item has-child">';
			}else{
				$menu .= '<li class="menu-item">';
			}
			
			$menu .= '<a href="'.url($main_menu_link).'" class="menu-link"><i class="menu-icon '.$main_menu_icon.'"></i> <span class="menu-text">'.$main_menu_name.'</span></a>';
			$menu .= '<ul class="menu">';
			
			while ($sub = mysqli_fetch_assoc($run_sub_sql)) {
				$sub_menu_name = $sub['sub_menu_name'];
				$sub_menu_link = $sub['sub_menu_link'];
				$sub_menu_icon = $sub['sub_menu_icon'];
				$menu .= '<li class="menu-item">
		        	<a href="'.url($sub_menu_link).'" class="menu-link">
		        		<i class="menu-icon '.$sub_menu_icon.'"></i> '.$sub_menu_name.'
		        	</a>
		        </li>';
			}
			$menu .= '</ul></li>';
		}	
        
	}

	echo $menu;
?>

	