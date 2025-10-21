        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if (isset($_POST['hdate'])){

                    if (empty(trim($_POST['hdate']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>Please set for holiday date!</p>
                          </div>
                        <?php
                    }
                    else{
                      date_default_timezone_set('Asia/Manila');
                      $holidaycode = trim($_POST['holidaycode']);
                      $holidaydate =  trim($_POST['hdate']);
                      $remarks = str_replace("'", "", trim($_POST['remarks']));
                      $status = trim($_POST['status']);


                      $sql = mysqli_query($conn, "SELECT * FROM tbl_holiday WHERE HOLIDAYDATE = '$holidaydate' AND REMARKS = '$remarks' AND STATUS='$status'");
                      if (mysqli_num_rows($sql) > 0){
                          $info = mysqli_fetch_array($sql);

                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Holiday has been already recorded!</p>
                            </div>
                          <?php

                      }
                      else{
                          $sql = "UPDATE tbl_holiday SET HOLIDAYDATE='$holidaydate', REMARKS='$remarks', STATUS='$status' WHERE HOLIDAYCODE = '$holidaycode'";
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
                                window.location = "index.php?page=holiday&a=adminholiday";
                              });
                            </script>
                          <?php
                      } 
                    }
                }
            ?>

              <div class="col-2 grid-margin stretch-card"></div>
              <div class="col-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Holiday</h4>
                    <p class="card-description"> Please enter the holiday details. </p>

                    <form class="forms-sample" action="index.php?page=holiday&a=adminholidayedit&holidaycode=<?php echo $_GET['holidaycode']; ?>" method="POST">

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Holiday Date <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" id="datepicker" name="hdate" value="<?php if (isset($_POST['hdate'])){ echo $_POST['hdate']; }else { echo HOLIDAYDATE($_GET['holidaycode']); } ?>" />
                              <script src="assets/js/jquery.js"></script>
                              <script language="javascript">
                                var today = new Date();
                                var dd = String(today.getDate()).padStart(2, '0');
                                var mm = String(today.getMonth() + 1).padStart(2, '0');
                                var yyyy = today.getFullYear();

                                today = yyyy + '-' + mm + '-' + dd;
                                $('#datepicker').attr('min',today);
                              </script>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Remarks</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="remarks" maxlength="200" value="<?php if (isset($_POST['remarks'])){ echo $_POST['remarks']; }else { echo HOLIDAYREMARKS($_GET['holidaycode']); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <div class="form-group">
                                <select class="form-control form-control-lg text-dark" id="exampleFormControlSelect1" name="status">
                                  <option disabled selected>Select Status</option>
                                  <?php
                                    if (isset($_POST['status'])) {
                                      $status = trim($_POST['status']);
                                    }
                                    else{
                                       $status = HOLIDAYSTATUS($_GET['holidaycode']);
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
                        <input type="hidden" class="form-control" name="holidaycode" value="<?php if (isset($_GET['holidaycode'])){ echo $_GET['holidaycode']; } ?>" />
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Update</button>
                        <a href="index.php?page=holiday&a=adminholiday" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-2 grid-margin stretch-card"></div>

            </div>
          </div>

          
            