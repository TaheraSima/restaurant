<script language="javascript">
  var gAutoPrint = true;

  function processPrint(){
    if (document.getElementById != null){
      var html = '';
      var printReadyElem = document.getElementById("printMe");
      if (printReadyElem != null) html += printReadyElem.innerHTML;
      else{
      alert("Error, no contents.");
      return;
      }
      var printWin = window.open("","processPrint");
      printWin.document.open();
      printWin.document.write(html);
      printWin.document.close();
      if (gAutoPrint) printWin.print();
    } else alert("Browser not supported.");
  }
</script>
<main class="app-main">
  <div class="wrapper">
    <div class="page">
      <div class="page-inner">
        <div class="page-section">
          <div>
            <!-- <a href="<?php //echo url('new_order/all'); ?>">New Sale</a> -->
            <button style="background-color: #E5FECE; max-width: 302px; margin-right: 2px;" class="form-control"><a href="<?php echo url('new_order/all'); ?>">New Sale</a></button>
            <!-- <a href="javascript:void(processPrint());">Print</a> -->
            <button style="background-color: #cfe7f3; max-width: 302px; margin-right: 2px;" class="form-control"><a href="javascript:void(processPrint());">Print</a></button>
            <div>
              <div>
                <div style="font-size: 10px;">
                  <div style="max-width: 302px; margin-right: 2px;" id="printMe">
                    <?php foreach ($data as $company) {
                      $com_logo = $company['company_settings_logo'];
                      $com_name = $company['company_settings_name'];
                      $com_add = $company['company_settings_address'];
                      $com_phone = $company['company_settings_phone'];
                      $com_email = $company['company_settings_email'];
                    }

                      if ($com_logo != '') {
                    ?>
                      <center>
                        <a href="<?php echo url('assets/company_settings_logo/').$com_logo; ?>" download target="_blank">  <img src="<?php echo url('assets/company_settings_logo/').$com_logo; ?>" alt="File" width="70"></a>
                      </center>
                    <?php }else{ ?>
                      <center ><?php echo $com_name;?></center>
                    <?php }
                        foreach ($data2 as $order) {
                          $orderId = $order['id'];
                          $orderVat = $order['order_vat'];
                          ?>
                          <div style="width: 100%;">
                            <b><?php echo $com_add.'. Con:-'.$com_phone.', Email: '.$com_email;?></b>
                          </div>
                          <div style="width: 100%;">
                            <div style="width: 49%; float: left;">Invoice # <?php echo $order['order_no']; ?></div>
                            <div style="width: 49%; float: right;">Service By: <?php echo $_SESSION['username'];?></div>
                          </div>
                          <div style="border-top: 1px dotted black;clear: both;">
                            VAT Reg # 00000 &nbsp;&nbsp;
                            Date # <?php echo $order['order_date']; ?>  
                          </div>
                          <center style="border-top: 1px dotted black;clear: both;">
                            <?php 
                            $cid = $order['customer_id'];
                             $cd = query_out_2("customers_id=$cid","customers_name", "customers");
                             foreach ($cd as $cnam) {
                               $cname = $cnam['customers_name'];
                               if ($cname != ''){?>
                                 Cusomer Name # <?php echo $cname;
                               }
                               else{
                                echo "ggg";
                               }
                             }
                            ?>
                           
                          </center>
                           <center style="border-top: 1px dotted black;clear: both;"></center>
                          <table style="width: 100%; padding: 2px; margin:1px;">
                            <thead style="background-color: #E0DEE0 !important; padding: 2px !important;">
                              <tr>
                                <th align="left">#</th>
                                <th align="left">Product(s)</th>
                                <th align="left">Rate</th>
                                <th align="left">Qty</th>
                                <th align="right">Tk.</th>
                                <th align="right"></th>
                              </tr>
                            </thead>
                            <tbody>
                               <?php
                              $dt_all = query_out_2("new_order.order_id= $orderId AND new_order.products_id=products.products_id", "products.products_name, new_order.* ", "new_order, products");
                              $i = 0;
                              foreach ($dt_all as $orderdetl) { ?>
                               <tr style="border-bottom: 1px dotted #CCC; ">
                                <td align="center"><?php echo ++$i;?></td>
                                <td align="left"><?php echo $orderdetl['products_name'];?></td>
                                <td align="left"><?php echo $orderdetl['products_price'];?></td>
                                <td align="center"><?php echo $orderdetl['products_quantity'];?></td>
                                <td align="right"><?php echo $orderdetl['products_value'];?></td>
                                <td align="right"></td>
                              </tr>
                              <?php } ?>
                              <tr>
                                <td colspan="3">Sub Total:</td>
                                <td colspan="2" align="right"><?php echo $order['amount'];?></td>
                                <td align="right"></td>
                              </tr>
                              <tr style="border-bottom: 1px dotted #CCC;">
                                <?php 
                                  foreach ($data3 as $vat) {
                                    $vat_val = $vat['vat_setting_value']; 
                                  }
                                ?>
                                <td colspan="3">Vat(<?php echo $vat_val; ?>%):</td>
                                <td colspan="2" align="right"><?php echo  $orderVat;?></td>
                                <td align="right"></td>
                              </tr>
                              
                               <tr style="border-bottom: 1px dotted #CCC;">
                                <td colspan="3">Discount:</td>
                                <td colspan="2" align="right"><?php 
                                $products_discount = $order['products_discount'];
                                $loyality_discount = $order['loyality_discount'];
                                $special_discount = $order['special_discount'];
                                $total_discount = $products_discount + $loyality_discount + $special_discount;
                                echo $total_discount;
                                ?>
                                  
                                </td>
                                <td align="right"></td>
                              </tr>
                              <tr style="border-bottom: 1px dotted #CCC;">
                                <td colspan="3">Net Total:</td>
                                <td colspan="2" align="right"><?php echo $order['net_amount'];?></td>
                                <td align="right"></td>
                              </tr>
                             

                              <?php 
                                  if ($order['payment_type'] == "Cash") {
                                    $payment = "Cash";
                                  }
                                  elseif($order['payment_type'] == "Card"){
                                    $payment = "Card (".$order['card_no'].")";
                                  }
                                  elseif($order['payment_type'] == "Receivable"){
                                    $payment = "Receivable ";
                                  }
                                ?>
                              <tr>
                                <?php
                                  if ($order['recv_amount'] == 0.00) {
                                    $amnt =  $order['due_amount'];
                                  }
                                  else
                                  {
                                    $amnt =  $order['recv_amount'];
                                  } ?>
                                <td>Pay Type:</td>
                                <td colspan="3"><?php echo $payment;?></td>
                                <td align="right"><?php echo $amnt ;?></td>
                              </tr>
                              <?php 
                                if ($order['payment_type'] == "Cash") {
                                  if ($order['retn_amount'] < 0) {
                                    $txt = 'Due Amount';
                                  }else{
                                    $txt = 'Change Amount';
                                  }
                              ?>
                              <tr>
                                <td></td>
                                <td align="center" colspan="3"><?php echo $txt; ?>:</td>
                                <td align="right"><?php echo  $order['retn_amount'];?></td>
                              </tr>
                             <?php }?>
                            </tbody>
                          </table>
                           <center style="border-top: 1px dotted black;">
                             <div>**VAT against this challan is payable through central registration board of NBR.</div>
                             <div><strong>Thank You. See You Again</strong></div>
                           </center>
                          <center style="border-top: 1px dotted black;"><p style="font-weight: bold;"><small>PoweredBy: </small>SIMEC System <br> <i>https://www.simecsystem.com/</i></p></center>
                        <?php }

                        ?>

                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Insertion Modal -->
