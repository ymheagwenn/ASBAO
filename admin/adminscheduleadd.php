        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if (isset($_POST['checkin']) &&
                    isset($_POST['checkout'])){

                    if (empty(trim($_POST['checkin'])) ||
                        empty(trim($_POST['checkout']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>Please set for time schedule reservation!</p>
                          </div>
                        <?php
                    }
                    else{
                      date_default_timezone_set('Asia/Manila');
                      $schedulecode = date('ymd-His') . "-". intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
                      $checkin = str_replace("'", "", trim($_POST['checkin']));
                      $checkout = str_replace("'", "", trim($_POST['checkout']));
                      $remarks = str_replace("'", "", trim($_POST['remarks']));
                      $status = "Active";


                      $sql = mysqli_query($conn, "SELECT * FROM tbl_schedule WHERE CHECKIN <= '$checkin' AND CHECKOUT >= '$checkout'");
                      if (mysqli_num_rows($sql) > 0){
                          $info = mysqli_fetch_array($sql);

                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Time schedule has been already recorded!</p>
                            </div>
                          <?php

                      }
                      else{
                          $sql = "INSERT INTO tbl_schedule(SCHEDULECODE, CHECKIN, CHECKOUT, REMARKS, STATUS) VALUES('$schedulecode','$checkin','$checkout','$remarks','$status')";
                          if (!mysqli_query($conn,$sql)) {
                              die('Error:'.mysqli_error($conn));
                          }

                          ?>

                            <script type="text/javascript">
                              Swal.fire(
                                'Saved!',
                                'Data saved successfully!',
                                'success'
                              ).then((result) => {
                                window.location = "index.php?page=schedule&a=adminschedule";
                              });
                            </script>
                          <?php
                      } 
                    }
                }
            ?>

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Schedule</h4>
                    <p class="card-description"> Please enter the schedule details. </p>

                    <form class="forms-sample" action="index.php?page=schedule&a=adminscheduleadd" method="POST">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Check-In <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="time" class="form-control" name="checkin" maxlength="10" value="<?php if (isset($_POST['checkin'])){ echo $_POST['checkin']; } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Check-Out <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="time" class="form-control" name="checkout" maxlength="10" value="<?php if (isset($_POST['checkout'])){ echo $_POST['checkout']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Remarks</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="remarks" maxlength="200" value="<?php if (isset($_POST['remarks'])){ echo $_POST['remarks']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Save</button>
                        <a href="index.php?page=department&a=adminschedule" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            