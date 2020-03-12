<header class="app-header app-header-dark">
  <div class="top-bar">
    <div class="top-bar-brand bg-transparent">
      <button class="hamburger hamburger-squeeze" style="margin-top: -20px; margin-right: 20px;" type="button" data-toggle="aside" aria-label="toggle menu">
        <!-- <span class="hamburger-box"><span class="hamburger-inner"></span></span> -->
        <span class="hamburger-box"><span class="fas fa-bars 2x"></span></span>
      </button>
      <a href="<?php echo url('dashboard'); ?>">
      <?php
        $logo = in_out_object("company_settings_status=1 ORDER BY company_settings_id DESC LIMIT 0,1", "company_settings_logo", "company_settings");
        if($logo != null):
      ?>
        <img src="<?php echo url('assets/company_settings_logo/').$logo->company_settings_logo; ?>" style="width:240px; height:56px;">
      <?php elseif($logo -= null): ?>
        <img src="<?php echo url('assets/company_settings_logo/').'logo.png'; ?>" style="width:240px; height:56px;">
      <?php endif; ?>
      </a>
    </div>
    <div class="top-bar-list">
      <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
        <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="toggle menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
      </div>
      <div class="top-bar-item top-bar-item-full">
        <?php //include('include/search.php'); ?>
      </div>
      <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
        <ul class="header-nav nav">
          <!-- <?php //include('include/1st.php'); ?>
          <?php //include('include/2nd.php'); ?> -->
          <!-- <?php //include('include/3rd.php'); ?> -->
        </ul>
        <?php include('include/pro.php'); ?>
      </div>
    </div>
  </div>
</header>