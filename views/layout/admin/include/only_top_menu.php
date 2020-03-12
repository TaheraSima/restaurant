<?php
	require 'config/db_info.php';

	$con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

	$sql = "SELECT * FROM top_menu WHERE top_menu_status=1 ORDER BY top_menu_rank ASC";
	$run_sql = mysqli_query($con, $sql);
	$menu = '';
	while ($top = mysqli_fetch_assoc($run_sql)) {
		$top_menu_name = $top['top_menu_name'];
		$top_menu_icon = $top['top_menu_icon'];
		$top_menu_link = $top['top_menu_link'];
		$top_menu_id = $top['top_menu_id'];
		$menu .= '<div class="dropdown-sheet-item">';
		$menu .= '<a href="'.url($top_menu_link).'" class="tile-wrapper"><span class="tile tile-lg bg-indigo">';
		$menu .= '<i class="'.$top_menu_icon.'"></i></span>';
		$menu .= '<span class="tile-peek">'.$top_menu_name.'</span></a>';
		$menu .= '</div>';

	}

	echo $menu;
	$top_menu_name = '';
	$top_menu_icon = '';
	$top_menu_link = '';
	$top_menu_id = '';
?>
	