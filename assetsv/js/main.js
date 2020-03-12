$(".dashboard-menu-toggle").click(function(e){
	e.stopPropagation();
  $(".dashboard-menu-inner").toggleClass("show");
});
$(".dashboard-menu-inner").click(function(){
  $(this).removeClass("show");
});