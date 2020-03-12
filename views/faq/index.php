<!-- <div style="margin-top: 30px; background-image: url(<?php echo url('assets/images/SIMEC-POS.jpg'); ?>); background-repeat: no-repeat;background-size: cover; overflow: hidden; width: 100%; height: 100% !important;"> 
  <p>fhh</p>
</div> -->
<div class="col-md-12" style="margin-top: 50px;">
  <h3 style="text-align: center;">FREQUENTLY ASKED QUESTIONS</h3>
  
<div class="container">
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist" >
      <a class="nav-item nav-link active" style="font-size: 15px; padding: 13px 40px 12px; text-align: center;" id="nav-gross-sale-tab" data-toggle="tab" href="#nav-gross-sale" role="tab" aria-controls="nav-gross-sale" aria-selected="true">FAQ</a>
      <a class="nav-item nav-link" style="font-size: 15px; padding: 13px 40px 12px; text-align: center;" id="nav-discount-tab" data-toggle="tab" href="#nav-discount" role="tab" aria-controls="nav-discount" aria-selected="false">Contact Us</a>
    </div>
  </nav>
  <br>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade in active" id="nav-gross-sale" role="tabpanel" aria-labelledby="nav-gross-sale-tab">
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              About Raw Material
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            From here you can add New raw item, category, unit and discount. For <b>creating item</b> you shoud set the item name, unit and sales permission. Sales permission set as allow needed to write selling price by which you want to sell that raw item. For <b>creating Category</b> need to write the category name. For creating unit need to write the unit. For <b>creating discount</b> select the discount type. From here you can set customer loyality wise discount. You should select the customer group and set the discount price for that. From left side bar you can see the all details according to heading. you can also edit and delete the details from here.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              About Products Menu
            </button>
          </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            From here you can add New products and receipe for that product. For <b>creating products</b> you should write the product name, choose the option from sold by, write the selling price and production cost. You can also add the image of product, product category, product discount (if any) and SKU code is readonly auto-generated number. For <b>creating receipe</b> select the product name for which you create the receipe. then select raw material and write amount of raw item. <b><i>Note that without receipe of the product it will not shown in the sales page.</i></b> By click on Add Raw Materials, more raw item can added. From left side bar you can see the all details according to heading. you can also modify and delete the details from here.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingThree">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Sales
            </button>
          </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
             Here all products are visible except raw item. By click on the raw items you can see all the raw item which are allowed for sale. All category are shown horizontally. By click on the products it will be added to the order side. You can order the product from respective category as well. individual category  product quantity increse or decrease from order by click on + or - sign. If customer is registered then search customer by his/her contact no that was given at the register form. Other wise skip this search option. If added product has any discount it will shown in the item discount or if customer has any discount that will shown in the loyality discount automatically option. If salesman want to add any special discount on the actual bill nedd to click on (0.00) beside SP Discount option and type the amount. Then the total bill shows as charge in the button. By click on Charge you get the receipt to print. In this way for every new sale you should click on the New Sale button.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingFour">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              Receipts
            </button>
          </h2>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
          <div class="card-body">
            This is the list of all sales receipt. Orders are saved here in queue. For confirm an order click the Deliver button and click on cancel for order cancellation. Click on view for more details about the specific order. After deliver or cancel by click on Canceled and Delivered button order details are viewed.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingFive">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
              Purchase
            </button>
          </h2>
        </div>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
          <div class="card-body">
            Click on Create New for purchase raw items. Select raw item name, write the quantity of buying selected item and write the total price of that. Prev Quantity shows the current stock of selected item, stock represent after purchasing how much stock will be for selected item. Grand total is for total bill of a purchase. Click on More Material for purchasing more items.
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingSix">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
            Report
            </button>
          </h2>
        </div>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
          <div class="card-body">
            In the all Report By default it shows last 30 days information. Select date range for specific day's information. In the <b>Sales summary report</b> Gross Sales, Discounts, Net Sales and Gross Profit shows particular data of those. <b>Sales by Item</b> shows top 5 products whose are maximum sold and other products net sales, total cost of goods and gross profit for that product. <b>Sales by Employee shows</b> the gross sales, total discounts, net sales, total number of receipts for each employee. <b>Sales by Payment Type</b> shows the total number of receipt, receive amount, return amount and net amount under a payment type. <b>Receipts</b> shows....
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingSeven">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
              Online Sales
            </button>
          </h2>
        </div>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
          <div class="card-body">
            Here all the Business type customers list will shown. From where salesman can receive the due amount from customers by click on Due Receive button, here write the receive amount and receive date. By Click on SALE NOW salesman can order products from here also. 
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingEight">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
              Settings
            </button>
          </h2>
        </div>
        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
          <div class="card-body">
            From here you can set your company settings, vat, create customer group, new customer, employee and reset the passwords. From left side all details can be modified and deleted.
          </div>
        </div>
      </div>
    </div>    
  </div>

  <div class="tab-pane fade" id="nav-discount" role="tabpanel" aria-labelledby="nav-discount-tab">
    <div class="container">
      <h4>Email support</h4>
      Can't find the answer to your question? Feel free to mail us at <a href="http://www.simecsystem.com/software-development/contact/" target="_blank">info@simecsystem.com</a>, we are always ready to assist you with any questions you may have in mind.  
      <h4>Live support</h4>
      Feel free to contact us at <b>019215544654</b>, we are always ready to assist you with any questions you may have in mind.     
    </div>
  </div>

</div>