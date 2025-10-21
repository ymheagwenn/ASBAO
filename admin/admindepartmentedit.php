        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">

              <?php
                if (isset($_POST['departmentname']) &&
                    isset($_POST['description'])){

                    if (empty(trim($_POST['departmentname'])) ||
                        empty(trim($_POST['description']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>Please enter department name!</p>
                          </div>
                        <?php
                    }
                    else{
                      date_default_timezone_set('Asia/Manila');
                      $departmentcode = trim($_POST['departmentcode']);
                      $departmentname = str_replace("'", "", trim($_POST['departmentname']));
                      $description = str_replace("'", "", trim($_POST['description']));
                      $status = trim($_POST['status']);


                      $sql = mysqli_query($conn, "SELECT * FROM tbl_department WHERE DEPARTMENTNAME = '$departmentname' AND DESCRIPTION = '$description' AND STATUS = '$status'");
                      if (mysqli_num_rows($sql) > 0){
                          $info = mysqli_fetch_array($sql);

                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Department has been already recorded!</p>
                            </div>
                          <?php

                      }
                      else{
                          $sql = "UPDATE tbl_department SET DEPARTMENTNAME='$departmentname', DESCRIPTION='$description', STATUS='$status' WHERE DEPARTMENTCODE = '$departmentcode'";
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
                                window.location = "index.php?page=department&a=admindepartment";
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
                    <h4 class="card-title">Edit Department</h4>
                    <p class="card-description"> Please enter the department details. </p>

                    <form class="forms-sample" action="index.php?page=department&a=admindepartmentedit&departmentcode=<?php echo $_GET['departmentcode']; ?>" method="POST">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Department Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="departmentname" maxlength="100" value="<?php if (isset($_POST['departmentname'])){ echo $_POST['departmentname']; }else { echo DEPARTMENTNAME($_GET['departmentcode']); } ?>" />
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="description" maxlength="200" value="<?php if (isset($_POST['description'])){ echo $_POST['description']; }else { echo DEPARTMENTDESC($_GET['departmentcode']); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
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
                                       $status = DEPARTMENTSTATUS($_GET['departmentcode']);
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
                        <input type="hidden" name="departmentcode" value="<?php if (isset($_GET['departmentcode'])){ echo $_GET['departmentcode']; } ?>" />
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Update</button>
                        <a href="index.php?page=department&a=admindepartment" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            