function summation(){
    var sum = 0;
   
    var ttl_vat = 0;
    var gt = 0;
    var sumD = 0; 
    $('.tdis').each(function(m,n){
        sumD +=  parseInt($(n).val());
    });
    $('.pdis_price').val(sumD); 
        var pdrpc = sumD;

    $('.sub_total').each(function(i,e){
        sum +=  parseInt($(e).val());
    });

    $('.total').val(sum);

    var getVat = $('.vat_setting_value').val();
    var vatC = (getVat/100);
    ttl_vat = (vatC*sum);
    console.log(ttl_vat);
    $('.vat').val(ttl_vat.toFixed(2));
    gt = (sum+ttl_vat);
    $('.grand_total').val(Math.round(gt));

    var gprc = parseInt($('.grand_total').val());
    var loyality_dis = parseInt($('.dis_amnt').val());

    var comissionamnt = (loyality_dis*gprc)/100;
    var loyaprc = pdrpc + comissionamnt;

    var acPrc = gprc - loyaprc;


    $('.actual_price').val(Math.round(acPrc));  
    $('.amountTotal').val(Math.round(acPrc));  
    $('#amountTotalbtn').html(Math.round(acPrc));    
    $('.due_amount').val(Math.round(gt));
    cashReturn();
}

