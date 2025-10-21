        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
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
                      $departmentcode = date('ymd-His') . "-". intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
                      $departmentname = str_replace("'", "", trim($_POST['departmentname']));
                      $description = str_replace("'", "", trim($_POST['description']));
                      $status = "Active";


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
                          $sql = "INSERT INTO tbl_department(DEPARTMENTCODE, DEPARTMENTNAME, DESCRIPTION, STATUS) VALUES('$departmentcode','$departmentname','$description','$status')";
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
                    <h4 class="card-title">Add Department</h4>
                    <p class="card-description"> Please enter the department details. </p>

                    <form class="forms-sample" action="index.php?page=department&a=admindepartmentadd" method="POST">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Department Name</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="departmentname" maxlength="100" value="<?php if (isset($_POST['departmentname'])){ echo $_POST['departmentname']; } ?>" />
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="description" maxlength="200" value="<?php if (isset($_POST['description'])){ echo $_POST['description']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Save</button>
                        <a href="index.php?page=department&a=admindepartment" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            