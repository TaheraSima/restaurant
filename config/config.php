<?php

	function home(){
		//return "http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT']."/dev2/restaurants/";
					//for server
		//return "http://202.86.217.200:8147/dev2/restaurants/";
					//for server
		
		// return "http://cowboy.restaurant.simecdemo.com/";

 		return "http://localhost/cowboy/";
	}
	
	function base_url($what){
		if ($what == 'site_link') {
			return home();
		}elseif ($what == 'title') {
			return 'SIMEC';
		}else{
			return 'NOTHING';
		}
	}

	function url($link){
		if ($link == './' || $link == '/' || $link == '') {
			return home();
		}else{
			return home().$link;
		}
	}


?>