$("#OrderItems").delegate(".serials","click",function(){
  if (event.target.type !== 'checkbox') {
       $(':checkbox', this).trigger('click');
     }
     selectischecked();
   });
 
   function selectischecked(){
     var i = 0;
     $(":checkbox").each(function(){
       if ($(this).is(':checked')) {
         i++;
       }
       if ( i != 0 ) {
         $(".removebutton").attr('disabled', false);
       }else{
         $(".removebutton").attr('disabled', true);
       }
     })
   }
 
 
   $(".removebutton").click(function(){
    //console.log( 'hello' );
     selecteditemRemove();
     summation();
     var cashReceive = $('.cash_rcv').val();
     var getActualPrice = $('.amountTotal').val();     
     var amount = cashReceive - getActualPrice;
     $('.cash_return').val(Math.round(amount));
   })
 
   function selecteditemRemove(){
     $(":checkbox").each(function(){
       if ($(this).is(':checked')) {
         var tr = $(this).closest("tr");
         if( $( '[data-f-item-element=' + $( this ).data( 'item-id' ) + ']' ).hasClass( 'already-added' ) ) {
            $( '[data-f-item-element=' + $( this ).data( 'item-id' ) + ']' ).removeClass( 'already-added' );
         }
         if( $( '[data-raw-item-element=' + $( this ).data( 'item-id' ) + ']' ).hasClass( 'already-added' ) ) {
            $( '[data-raw-item-element=' + $( this ).data( 'item-id' ) + ']' ).removeClass( 'already-added' );
         }
         tr.remove();         
       }
     })
     $(".removebutton").attr('disabled', true);
     // Reset Serials
     $('.trSerial').each(function(idx, elem){
       $(elem).text(idx+1);
     });
   }
 
   $("#OrderItems").delegate(".minus","click",function(){
     var tr = $(this).closest("tr");
     var qty = parseInt(tr.find(".qty").val());
     qty = qty-1;
     if (qty<=0) {
      
       if( $( '[data-f-item-element=' + $( this ).data( 'item-id' ) + ']' ).hasClass( 'already-added' ) ) {
          $( '[data-f-item-element=' + $( this ).data( 'item-id' ) + ']' ).removeClass( 'already-added' );
       }
       if( $( '[data-raw-item-element=' + $( this ).data( 'item-id' ) + ']' ).hasClass( 'already-added' ) ) {
          $( '[data-raw-item-element=' + $( this ).data( 'item-id' ) + ']' ).removeClass( 'already-added' );
       }
      tr.remove();
     }
     var price = parseInt(tr.find(".products_price").val());
     var products_dis_price = parseInt(tr.find(".products_dis_price").val());
     tr.find(".qty").val(qty);
     tr.find(".quantity").val(qty);
    
     var sub_total = qty*price;
     var dis_total = qty*products_dis_price;
     tr.find(".sub_total").val(sub_total);
     tr.find(".subtotal").val(sub_total);
     tr.find(".tdis").val(dis_total);
     tr.find(".t_dis").val(dis_total);
     summation(); 
     var cashReceive = $('.cash_rcv').val();
     var getActualPrice = $('.amountTotal').val();     
     var amount = cashReceive - getActualPrice;
     $('.cash_return').val(Math.round(amount));
   });
 $(document).on( 'keyup', '.cash_rcv', function() {
     var cashReceive = $( this );
     var getGrandTotal = $('.grand_total').val();
     var getActualPrice = $('.amountTotal').val();
     
         var cashrcv = parseInt( cashReceive.val() );
         var amount = cashrcv - getActualPrice;
         $('.cash_return').val(Math.round(amount));
 
 }); 
     $(document).ready(function(){
       $("#payment").change(function(event){
           event.preventDefault();
           var payment_val = $(this).val();

           if (payment_val == 2)
           {
             var payment_stock = `
                     <input type="text" name="card_no" class="custom-text form-control" placeholder="--- Card No ---" required/>
                 `;
             $('.payment_stock').html(payment_stock);
           }
 
           if (payment_val == 1)
           {        
             var cashAmnt = `
                     <input type="text" name="cash_rcv" class="custom-text form-control cash_rcv" style="border: none; background: transparent;" placeholder="-- Cash Receive --" required/><br>
                     <input type="text" name="cash_rtn" class="custom-text form-control cash_return" style="border: none; background: transparent;" placeholder="-- Cash Return --" required/>
                 `;
             $('.payment_stock').html(cashAmnt);
           }
 
           if (payment_val == 3)
           {        
             var dueAmnt = `
                     <label>Amount is Due</label><br>
                     
                 `;
             $('.payment_stock').html(dueAmnt);
           }
           if (payment_val == ''){

              $('.payment_stock').empty();
              $('.payment_stock').empty();
              $('.payment_stock').empty();
           }
         });
     });