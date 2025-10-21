        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">

                    <h4 class="card-title">View Parcel Transaction</h4>
                    <br>
                    <?php
                      if (isset($_POST['save'])) {
                        if (!isset($_POST['status'])){
                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Please select a status!</p>
                            </div>
                          <?php
                        }
                        else{
                          $parcelcode = trim($_POST['parcelcode']);
                          $trackingnum = trim($_POST['trackingnum']);
                          $parcelstatus = trim($_POST['status']);

                          $sql = "UPDATE tbl_parcels SET STATUS='$parcelstatus' WHERE PARCELCODE = '$parcelcode'";
                          if (!mysqli_query($conn,$sql)) {
                              die('Error:'.mysqli_error($conn));
                          }

                          $sqlselect = mysqli_query($conn,"SELECT * FROM tbl_track WHERE TRACKINGNUM ='$trackingnum' AND STATUS ='$parcelstatus'");
                          if (mysqli_num_rows($sqlselect) > 0) {
                            $info = mysqli_fetch_array($sqlselect);

                          }
                          else{
                            date_default_timezone_set('Asia/Manila');
                            $dateon = strtotime(date("Y-m-d g:i a"));
                            $trackcode = date('ymd-His') . "-". intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
                            $usercode = $_SESSION['USERCODE'];

                            if ($parcelstatus == 'Preparing'){
                              $remarks = "Preparing to ship item";

                              $sql = "INSERT INTO tbl_track(TRACKCODE, USERCODE, TRACKINGNUM, REMARKS, DATEON, STATUS) VALUES('$trackcode','$usercode','$trackingnum','','$dateon','Created')";
                              if (!mysqli_query($conn,$sql)) {
                                 die('Error:'.mysqli_error($conn));
                              }

                              $sql = "INSERT INTO tbl_track(TRACKCODE, USERCODE, TRACKINGNUM, REMARKS, DATEON, STATUS) VALUES('$trackcode','$usercode','$trackingnum','$remarks','$dateon','$parcelstatus')";
                              if (!mysqli_query($conn,$sql)) {
                                 die('Error:'.mysqli_error($conn));
                              }
                            }
                          }

                          ?>

                            <script type="text/javascript">
                              Swal.fire(
                                'Updated!',
                                'Status updated successfully!',
                                'success'
                              ).then((result) => {
                                window.location = "index.php?page=parcel&a=adminparcel";
                              });
                            </script>
                          <?php
                        }
                      }
                    ?>

                    <div class="row">
                      <table class="table table-bordered">
                        <tr>
                          <td width="30%" class="text-center">Tracking Number</td>
                          <td width="30%" class="text-center">Transaction Date and Time</td>
                          <td width="40%" class="text-center">Status</td>
                        </tr>
                        <tr>
                        <?php
                              if (isset($_GET['parcelcode'])) {
                                $parcelcode = $_GET['parcelcode'];
                                $sql = mysqli_query($conn,"SELECT * FROM tbl_parcels WHERE PARCELCODE = '$parcelcode' ORDER BY PARCELCODE DESC LIMIT 1");
                                if (mysqli_num_rows($sql) > 0) {
                                  $info = mysqli_fetch_array($sql);

                                  ?>
                                  <td width="30%" class="text-center"><b><?php echo $info['TRACKINGNUM']; ?></b></td>
                                  <td width="30%" class="text-center"><b><?php echo $info['DATEON']; ?></b></td>
                                  <td width="40%" class="text-center">
                                    <?php
                                      if (isset($_POST['status'])) {
                                        $status = trim($_POST['status']);
                                      }
                                      else{
                                        $status = $info['STATUS'];
                                      }

                                      if ($status == 'Delivered' || $status == 'Completed') {
                                        echo "<b>Completed</b>";
                                      }
                                      else{
                                        ?>
                                        <form class="forms-sample" action="index.php?page=parcel&a=adminparcelview&parcelcode=<?php echo $_GET['parcelcode']; ?>" method="POST">
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <div class="form-group">
                                                <select class="form-control form-control-sm text-dark" name="status">
                                                  <option disabled selected>Select Status</option>
                                                  <?php
                                                    if (isset($_POST['status'])) {
                                                      $status = trim($_POST['status']);
                                                    }
                                                    else{
                                                       $status = $info['STATUS'];
                                                    }

                                                    if ($status == "Pending"){
                                                      ?>
                                                        <option value="Pending" <?php if ($status == 'Pending') { echo "selected"; } ?>>Pending</option>
                                                        <option value="Preparing" <?php if ($status == 'Preparing') { echo "selected"; } ?>>Preparing</option>
                                                      <?php
                                                    }
                                                    else if ($status == "Preparing"){
                                                      ?>
                                                        <option value="Preparing" <?php if ($status == 'Preparing') { echo "selected"; } ?>>Preparing</option>
                                                        <option value="Item Accepted by Courier" <?php if ($status == 'Item Accepted by Courier') { echo "selected"; } ?>>Item Accepted by Courier</option>
                                                        <option value="In-transit" <?php if ($status == 'In-transit') { echo "selected"; } ?>>In-transit</option>
                                                      <?php
                                                    }
                                                    else if ($status == "Item Accepted by Courier"){
                                                      ?>
                                                        <option value="Item Accepted by Courier" <?php if ($status == 'Item Accepted by Courier') { echo "selected"; } ?>>Item Accepted by Courier</option>
                                                        <option value="In-transit" <?php if ($status == 'In-transit') { echo "selected"; } ?>>In-transit</option>
                                                      <?php
                                                    }
                                                    else if ($status == "In-transit"){
                                                      ?>
                                                        <option value="In-transit" <?php if ($status == 'In-transit') { echo "selected"; } ?>>In-transit</option>
                                                        <option value="Out for Delivery" <?php if ($status == 'Out for Delivery') { echo "selected"; } ?>>Out for Delivery</option>
                                                        <option value="Pick-up" <?php if ($status == 'Pick-up') { echo "selected"; } ?>>Pick-up</option>
                                                      <?php
                                                    }
                                                    else if ($status == "Out for Delivery"){
                                                      ?>
                                                        <option value="Out for Delivery" <?php if ($status == 'Out for Delivery') { echo "selected"; } ?>>Out for Delivery</option>
                                                        <option value="Delivered" <?php if ($status == 'Delivered') { echo "selected"; } ?>>Delivered</option>
                                                        <option value="Unsuccessfull Delivery Attempt" <?php if ($status == 'Unsuccessfull Delivery Attempt') { echo "selected"; } ?>>Unsuccessfull Delivery Attempt</option>
                                                      <?php
                                                    }
                                                    else if ($status == "Pick-up"){
                                                      ?>
                                                        <option value="Pick-up" <?php if ($status == 'Pick-up') { echo "selected"; } ?>>Pick-up</option>
                                                        <option value="Completed" <?php if ($status == 'Completed') { echo "selected"; } ?>>Completed</option>
                                                      <?php
                                                    }
                                                    else if ($status == "Unsuccessfull Delivery Attempt"){
                                                      ?>
                                                        <option value="Out for Delivery" <?php if ($status == 'Out for Delivery') { echo "selected"; } ?>>Out for Delivery</option>
                                                        <option value="Delivered" <?php if ($status == 'Delivered') { echo "selected"; } ?>>Delivered</option>
                                                        <option value="Unsuccessfull Delivery Attempt" <?php if ($status == 'Unsuccessfull Delivery Attempt') { echo "selected"; } ?>>Unsuccessfull Delivery Attempt</option>
                                                      <?php
                                                    }
                                                  ?>
                                                </select>
                                              </div>
                                            </div>
                                          </div>

                                          <p>
                                            <input type="hidden" class="form-control" name="parcelcode" value="<?php echo $_GET['parcelcode']; ?>" />
                                            <input type="hidden" class="form-control" name="trackingnum" value="<?php echo $info['TRACKINGNUM']; ?>" />
                                            <button type="submit" class="btn btn-info btn-sm" name="save">Save</button>
                                          </p>
                                        </form>
                                        <?php
                                      }
                                    ?>
                                  </td>
                                  <?php
                                }
                              }
                        ?>
                        </tr>
                      </table>
                    </div><br><br>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <table class="table table-bordered">
                            <tr>
                              <td width="25%" class="text-center">Trip Details</td>
                              <td width="25%" class="text-center">Movement</td>
                              <td width="25%" class="text-center">Service Mode</td>
                              <td width="25%" class="text-center">Pay Mode</td>
                            </tr>
                            <tr>
                            <?php
                              if (isset($_GET['parcelcode'])) {
                                $parcelcode = $_GET['parcelcode'];
                                $sql = mysqli_query($conn,"SELECT * FROM tbl_parcels WHERE PARCELCODE = '$parcelcode' ORDER BY PARCELCODE DESC LIMIT 1");
                                if (mysqli_num_rows($sql) > 0) {
                                  $info = mysqli_fetch_array($sql);

                                  ?>
                                  <td width="25%" class="text-center"><b><?php echo $info['ORIGIN'] ." - ". $info['DESTINATION']; ?></b></td>
                                  <td width="25%" class="text-center"><b><?php echo $info['MOVEMENT']; ?></b></td>
                                  <td width="25%" class="text-center"><b><?php echo $info['SERVICEMODE']; ?></b></td>
                                  <td width="25%" class="text-center"><b><?php echo $info['PAYMODE']; ?></b></td>
                                  <?php
                                }
                              }
                            ?>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-12">
                        <p class="card-description"> Shipper Information </p>
                        <div class="form-group row">
                          <table class="table table-bordered">
                            <?php
                              if (isset($_GET['parcelcode'])) {
                                $parcelcode = $_GET['parcelcode'];
                                $sql = mysqli_query($conn,"SELECT * FROM tbl_parcels WHERE PARCELCODE = '$parcelcode' ORDER BY PARCELCODE DESC LIMIT 1");
                                if (mysqli_num_rows($sql) > 0) {
                                  $info = mysqli_fetch_array($sql);

                                  ?>
                                  <tr>
                                    <td width="30%">Shipper</td>
                                    <td width="70%"><b><?php echo $info['SHIPPERNAME']; ?></b></td>
                                  </tr>
                                  <tr>
                                    <td width="30%">Contact</td>
                                    <td width="70%"><b><?php echo $info['SHIPPERCONTACT']; ?></b></td>
                                  </tr>
                                  <tr>
                                    <td width="30%">Address</td>
                                    <td width="70%" style="word-wrap: break-word; white-space: normal !important; text-align: justify; line-height: 1.3;"><b><?php echo $info['SHIPPERADDRESS']; ?></b></td>
                                  </tr>
                                  <?php
                                }
                              }
                            ?>
                          </table>
                        </div>
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-12">
                        <p class="card-description"> Consignee Information </p>
                        <div class="form-group row">
                          <table class="table table-bordered">
                            <?php
                              if (isset($_GET['parcelcode'])) {
                                $parcelcode = $_GET['parcelcode'];
                                $sql = mysqli_query($conn,"SELECT * FROM tbl_parcels WHERE PARCELCODE = '$parcelcode' ORDER BY PARCELCODE DESC LIMIT 1");
                                if (mysqli_num_rows($sql) > 0) {
                                  $info = mysqli_fetch_array($sql);

                                  ?>
                                  <tr>
                                    <td width="30%">Consignee</td>
                                    <td width="70%"><b><?php echo $info['CONSIGNEE']; ?></b></td>
                                  </tr>
                                  <tr>
                                    <td width="30%">Contact</td>
                                    <td width="70%"><b><?php echo $info['CONSIGNCONTACT']; ?></b></td>
                                  </tr>
                                  <tr>
                                    <td width="30%">Address</td>
                                    <td width="70%" style="word-wrap: break-word; white-space: normal !important; text-align: justify; line-height: 1.3;"><b><?php echo $info['CONSIGNADDRESS']; ?></b></td>
                                  </tr>
                                  <?php
                                }
                              }
                            ?>
                          </table>
                        </div>
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-12">
                        <p class="card-description"> Parcel Details </p>
                        <div class="form-group row">
                          <table class="table table-bordered">
                            <tr>
                              <td width="60%" class="text-center">Description</td>
                              <td width="10%" class="text-center">QTY</td>
                              <td width="10%" class="text-center">CBM</td>
                              <td width="10%" class="text-center">Weight</td>
                              <td width="10%" class="text-center">Rate</td>
                            </tr>
                            <tr>
                            <?php
                              if (isset($_GET['parcelcode'])) {
                                $parcelcode = $_GET['parcelcode'];
                                $sql = mysqli_query($conn,"SELECT * FROM tbl_parcels WHERE PARCELCODE = '$parcelcode' ORDER BY PARCELCODE DESC LIMIT 1");
                                if (mysqli_num_rows($sql) > 0) {
                                  $info = mysqli_fetch_array($sql);

                                  ?>
                                  <td width="25%" class="text-center" style="word-wrap: break-word; white-space: normal !important; text-align: justify; line-height: 1.3;"><b><?php echo $info['DESCRIPTION']; ?></b></td>
                                  <td width="25%" class="text-center"><b><?php echo number_format($info['PIECES'], 1, '.', ','); ?></b></td>
                                  <td width="25%" class="text-center">
                                    <?php
                                      if ($info['CBM'] != '0.00') {
                                        echo "<b>".$info['CBM']."</b>";
                                      }
                                    ?>
                                  </td>
                                  <td width="25%" class="text-center"><b><?php echo number_format($info['WEIGHT']) ." kgs"; ?></b></td>
                                  <td width="25%" class="text-center"><b><?php echo $info['RATE']; ?></b></td>
                                  <?php
                                }
                              }
                            ?>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div><br>

                    <div class="row">
                      <div class="col-md-12">
                        <p class="card-description"> Billing Details </p>
                        <div class="form-group row">
                          <table class="table table-bordered">
                            <?php
                              if (isset($_GET['parcelcode'])) {
                                $parcelcode = $_GET['parcelcode'];
                                $sql = mysqli_query($conn,"SELECT * FROM tbl_parcels WHERE PARCELCODE = '$parcelcode' ORDER BY PARCELCODE DESC LIMIT 1");
                                if (mysqli_num_rows($sql) > 0) {
                                  $info = mysqli_fetch_array($sql);

                                  ?>
                                  <tr>
                                    <td width="60%" style="text-align: left;">Freight Charge</td>
                                    <td width="40%" style="text-align: right;"><?php echo number_format($info['FREIGHT'], 2, '.', ','); ?></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" style="text-align: left;">Valuation Charge</td>
                                    <td width="40%" style="text-align: right;"><?php echo $info['VALUATION']; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" style="text-align: left;">Waybill Charge</td>
                                    <td width="40%" style="text-align: right;"><?php echo $info['WAYBILL']; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" style="text-align: left;">Fuel Surcharge</td>
                                    <td width="40%" style="text-align: right;"><?php echo $info['FUELSURCHARGE']; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" style="text-align: left;">Insurance Fee </td>
                                    <td width="40%" style="text-align: right;"><?php echo $info['INSURANCEFEE']; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" style="text-align: left;">Special Handling Fee</td>
                                    <td width="40%" style="text-align: right;"><?php echo $info['SPECIALHANDLING']; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" style="text-align: left;">Pick Up & Delivery Fee</td>
                                    <td width="40%" style="text-align: right;"><?php echo $info['PICKUPDELIVERY']; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" style="text-align: left;">Others</td>
                                    <td width="40%" style="text-align: right;"><?php echo $info['OTHERS']; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" style="text-align: right;"><b>SUBTOTAL</b></td>
                                    <td width="40%" style="text-align: right;"><b><?php echo number_format($info['SUBTOTAL'], 2, '.', ','); ?></b></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" style="text-align: right;"><b>VAT</b></td>
                                    <td width="40%" style="text-align: right;"><?php echo number_format($info['VAT'], 2, '.', ','); ?></td>
                                  </tr>
                                  <tr>
                                    <td width="60%" style="text-align: right;"><b>TOTAL CHARGES</b></td>
                                    <td width="40%" style="text-align: right;"><b><?php echo number_format($info['TOTALCHARGES'], 2, '.', ','); ?></b></td>
                                  </tr>
                                  <?php
                                }
                              }
                            ?>
                          </table>
                        </div>
                      </div>
                    </div>

                    <br><br>

                    <p class="text-center">
                      <a href="index.php?page=parcel&a=adminparcel" class="btn btn-gradient-light btn-md">Back</a>
                    </p>

                  </div>
                </div>
              </div>
            </div>
          </div>

          
            