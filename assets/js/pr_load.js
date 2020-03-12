
$(".productcollapse").hide();
$("#All").show();
function collapseProduct(product_id){
  if (product_id=='All') {
    $(".productcollapse").hide();
    $("#All").show();
  }else{
    $(".productcollapse").hide();
    $("#"+product_id).show();
  }
}
$('.itemid').click(function(e) {
    e.preventDefault();
    var pid = $(this).val();
    alert("Hello");
});
