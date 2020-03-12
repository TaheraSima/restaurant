<li class="nav-item dropdown header-nav-dropdown">
  <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="oi oi-grid-three-up"></span></a>
  <div class="dropdown-menu dropdown-menu-rich dropdown-menu-right">
    <div class="dropdown-arrow"></div>
    <div class="dropdown-sheets">

    <?php include('only_top_menu.php'); ?>

    </div>
  </div>
</li>
<script>
  $(document).ready(function(){
    $.ajax({
      url   : 'dashboard/topMenu',
      method: 'GET',
      success:function(data){
        console.log(data);
      }
    })
  })
</script>