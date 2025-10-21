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
                      $schedulecode = trim($_POST['schedulecode']);
                      $checkin =  trim($_POST['checkin']);
                      $checkout = trim($_POST['checkout']);
                      $remarks = str_replace("'", "", trim($_POST['remarks']));
                      $status = trim($_POST['status']);


                      $sql = mysqli_query($conn, "SELECT * FROM tbl_schedule WHERE CHECKIN <= '$checkin' AND CHECKOUT >= '$checkout' AND REMARKS ='$remarks' AND STATUS='$status'");
                      if (mysqli_num_rows($sql) > 0){
                          $info = mysqli_fetch_array($sql);

                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Time schedule has been already recorded!</p>
                            </div>
                          <?php

                      }
                      else{
                          $sql = "UPDATE tbl_schedule SET CHECKIN='$checkin', CHECKOUT='$checkout', REMARKS='$remarks', STATUS='$status' WHERE SCHEDULECODE = '$schedulecode'";
                          if (!mysqli_query($conn,$sql)) {
                              die('Error:'.mysqli_error($conn));
                          }

                          ?>

                            <script type="text/javascript">
                              Swal.fire(
                                'Updated!',
                                'Data updated successfully!',
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
                    <h4 class="card-title">Edit Schedule</h4>
                    <p class="card-description"> Please enter the schedule details. </p>

                    <form class="forms-sample" action="index.php?page=schedule&a=adminscheduleedit&schedulecode=<?php echo $_GET['schedulecode']; ?>" method="POST">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Check-In <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="time" class="form-control" name="checkin" maxlength="10" value="<?php if (isset($_POST['checkin'])){ echo $_POST['checkin']; }else { echo SCHEDULECHECKIN($_GET['schedulecode']); } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Check-Out <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="time" class="form-control" name="checkout" maxlength="10" value="<?php if (isset($_POST['checkout'])){ echo $_POST['checkout']; }else { echo SCHEDULECHECKOUT($_GET['schedulecode']); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Remarks</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="remarks" maxlength="200" value="<?php if (isset($_POST['remarks'])){ echo $_POST['remarks']; }else { echo SCHEDULEREMARKS($_GET['schedulecode']); } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <div class="form-group">
                                <select class="form-control form-control-lg text-dark" id="exampleFormControlSelect1" name="status">
                                  <option disabled selected>Select Status</option>
                                  <?php
                                    if (isset($_POST['status'])) {
                                      $status = trim($_POST['status']);
                                    }
                                    else{
                                       $status = SCHEDULESTATUS($_GET['schedulecode']);
                                    }
                                  ?>
                                  <option value="Active" <?php if ($status == 'Active') { echo "selected"; } ?>>Active</option>
                                  <option value="Deactive" <?php if ($status == 'Deactive') { echo "selected"; } ?>>Deactive</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <input type="hidden" class="form-control" name="schedulecode" value="<?php if (isset($_GET['schedulecode'])){ echo $_GET['schedulecode']; } ?>" />
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Update</button>
                        <a href="index.php?page=schedule&a=adminschedule" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            