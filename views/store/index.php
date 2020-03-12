<hr style="position: relative; margin-top: 60px; border: none;">
<div class="row">
  <div class="col-12 col-lg-12 col-xl-12">
    <div class="card card-fluid">
      <div class="card-body">
        <center><h4>Stock Balance</h4></center>
        <div class="table-responsive">
        <table class="table datatable table-hover">
          <thead>
            <tr style="background-color: #4ab300; color: white; font-size: 25px;">
              <th scope="col" style="width: 50px;">#</th>
              <th scope="col" style="width: 250px;">Raw Material</th>
              <th scope="col" style="width: 100px;">Current Stock</th>
              <th scope="col" style="width: 300px;">Unit</th>
            </tr>
          </thead>
         <tbody style="font-size: 22px;">
          <?php
            $i=0;
            foreach($data3 as $item){
              $id = $item['item_unit'];
              $dd = in_out_object("unit_id=$id","unit_name", "unit");

              $item_id = $item['item_id'];
              $cls = in_out_object("item_id=$item_id ORDER BY m_store_details_id DESC LIMIT 0,1","closing_qty", "material_store");

          ?>
            <tr>
              <td><?php echo ++$i; ?></td>
              <td><?php echo $item['item_name']; ?></td>
              <?php  
                $sql = "SELECT count(item_id) as id FROM material_store WHERE item_id = $item_id";
                $result = mysqli_query($conn, $sql); 
                while($row = mysqli_fetch_assoc($result))
                {
                  $countid = $row['id'];
                  if ($countid != 0) {?>
                    <td><?php echo $cls->closing_qty; ?></td>
                  <?php }
                  else{?>
                     <td>0</td>
                  <?php }
                }?>
              <td><?php echo $dd->unit_name; ?></td>
              <!-- <td><a href="#" data-toggle="modal" title="Delete" data-target="#Edit_store"><i class="fa fa-edit text-warning"></i></a></td> -->
            </tr>
          <?php } ?>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>