<aside class="app-aside app-aside-light">
	<div class="aside-content">
	  <header class="aside-header d-block d-md-none">
	    <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside"><span class="user-avatar user-avatar-lg"><img src="<?php echo base_url('site_link'); ?>assets/user_photo/salman.jpg" alt=""></span> <span class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span> <span class="account-summary"><span class="account-name"><?php echo $_SESSION['user_id']!=''?$_SESSION['fullname']:''; ?></span> <span class="account-description">Marketing Manager</span></span></button>
	    <div id="dropdown-aside" class="dropdown-aside collapse">
	      <div class="pb-3">
	        <a class="dropdown-item" href="user-profile.html"><span class="dropdown-icon oi oi-person"></span> Profile</a> <a class="dropdown-item" href="auth-signin-v1.html"><span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
	      </div>
	    </div>
	  </header>
	  <div class="aside-menu overflow-hidden">
	    <nav id="stacked-menu" class="stacked-menu">
	      <ul class="menu">
		<?php
			if ($_SESSION['user_type']=='1') {
		?>
		    <li class="menu-item has-active">
	          <a href="<?php echo url('dashboard'); ?>" class="menu-link"><span class="menu-icon fa fa-home"></span> <span class="menu-text">Dashboard</span></a>
	        </li>
	        <li class="menu-item has-child">
	          <a href="#" class="menu-link"><span class="menu-icon fa fa-puzzle-piece"></span> <span class="menu-text">Admin Settings</span></a>
	          <ul class="menu">
	            <li class="menu-item">
	              <a href="<?php echo url('modules/create'); ?>" class="menu-link">Make New Module</a>
	            </li>
	            <li class="menu-item">
	              <a href="<?php echo url('modules/all'); ?>" class="menu-link">All Modules</a>
	            </li>
	            <li class="menu-item has-child">
	              <a href="#" class="menu-link">Menu Setting</a>
	              <ul class="menu">
	                <li class="menu-item">
	                  <a href="<?php echo url('main_menu/all'); ?>" class="menu-link">Main Menu</a>
	                </li>
	                <li class="menu-item">
	                  <a href="<?php echo url('sub_menu/all'); ?>" class="menu-link">Sub Menu</a>
	                </li>
	                <li class="menu-item">
	                  <a href="<?php echo url('top_menu/all'); ?>" class="menu-link">Top Menu</a>
	                </li>
	              </ul>
	            </li>
	            <li class="menu-item has-child">
	              <a href="#" class="menu-link">Users</a>
	              <ul class="menu">
	                <li class="menu-item">
	                  <a href="<?php echo url('users/create_usertype'); ?>" class="menu-link">Create User Type</a>
	                </li>
	                <li class="menu-item">
	                  <a href="<?php echo url('users/create'); ?>" class="menu-link">Create User</a>
	                </li>
	                <li class="menu-item">
	                  <a href="<?php echo url('users/all'); ?>" class="menu-link">All Users</a>
	                </li>
	               <!--  <li class="menu-item">
	                  <a href="<?php //echo url('users/accesscreate'); ?>" class="menu-link">User Access</a>
	                </li>	 -->                
	              </ul>
	            </li>
	          </ul>
	        </li>
	        <hr>
		<?php
	    	}
	    	
	    	$userFromSession = logged_user_name($_SESSION['user_id']);
	    	$con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
			$sql = "SELECT * FROM main_menu WHERE main_menu_status=1 ORDER BY main_menu_rank ASC";
			$run_sql = mysqli_query($con, $sql);
			while ($main = mysqli_fetch_assoc($run_sql)) {
				$main_menu_name = $main['main_menu_name'];
				$main_menu_icon = $main['main_menu_icon'];
				$main_menu_link = $main['main_menu_link'];
				$main_menu_id = $main['main_menu_id'];
				$main_menu_has_access = $main['main_menu_has_access'];
				$access = explode(',', $main_menu_has_access);
				if (in_array($userFromSession, $access)) {
					$sub_sql = "SELECT * FROM sub_menu WHERE sub_menu_main=$main_menu_id AND sub_menu_status=1 ORDER BY sub_menu_rank ASC";
					$run_sub_sql = mysqli_query($con, $sub_sql);
					if (mysqli_num_rows($run_sub_sql) > 0) {
		?>
			<li class="menu-item has-child">
		<?php
					}else{
		?>
			<li class="menu-item">
		<?php
					}
		?>
				<a href="<?php echo url($main_menu_link); ?>" class="menu-link">
					<i class="menu-icon <?php echo $main_menu_icon; ?>"></i>
					<span class="menu-text"><?php echo $main_menu_name; ?></span>
				</a>
				<ul class="menu">
		<?php
					while ($sub = mysqli_fetch_assoc($run_sub_sql)) {
						$sub_menu_name = $sub['sub_menu_name'];
						$sub_menu_link = $sub['sub_menu_link'];
						$sub_menu_icon = $sub['sub_menu_icon'];
		?>
					<li class="menu-item" >
						<a href="<?php echo url($sub_menu_link); ?>" class="menu-link">
							<i  class="menu-icon <?php echo $sub_menu_icon; ?>"></i> <?php echo $sub_menu_name; ?>
						</a>
					</li>
		<?php
					}
		?>
				</ul>
			</li>
		<?php
				}
			}
		?>
	      </ul>
	    </nav>
	  </div>
	  <footer class="aside-footer border-top p-3">
	    <div class="copyright"> All Rights © <a href="<?php echo website(); ?>" target="_blank"><b style="color: darkcyan;"><?php echo company(); ?></b></a>.<br>Copyright © <?php echo date('Y'); ?>. <a href="http://simecsystem.com/" target="_blank"><b style="color: darkcyan;">SIMEC System</b></a>. </div>
	  </footer>
	</div>
</aside>