        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if (isset($_POST['usercode']) &&
                    isset($_POST['first']) &&
                    isset($_POST['last']) &&
                    isset($_POST['gender']) &&
                    isset($_POST['role']) &&
                    isset($_POST['email']) &&
                    isset($_POST['status'])){

                    if (empty(trim($_POST['usercode'])) ||
                        empty(trim($_POST['first'])) ||
                        empty(trim($_POST['last'])) ||
                        empty(trim($_POST['gender'])) ||
                        empty(trim($_POST['role'])) ||
                        empty(trim($_POST['email'])) ||
                        empty(trim($_POST['status']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>One of the required field is empty or contains invalid data, please check your input!</p>
                          </div>
                        <?php
                    }
                    else{
                      $usercode = trim($_POST['usercode']);
                      $first = str_replace("'", "", ucwords(strtolower(trim($_POST['first']))));
                      $last = str_replace("'", "", ucwords(strtolower(trim($_POST['last']))));
                      $gender = trim($_POST['gender']);
                      $role = trim($_POST['role']);
                      $email = str_replace("'", "", strtolower(trim($_POST['email'])));
                      $status = trim($_POST['status']);

                      $sqlpro = mysqli_query($conn, "SELECT * FROM tbl_users WHERE FIRSTNAME ='$first' AND LASTNAME ='$last' AND GENDER ='$gender' AND EMAIL ='$email' AND ROLE ='$role' AND STATUS ='$status'");
                      if (mysqli_num_rows($sqlpro) > 0){
                          $info = mysqli_fetch_array($sqlpro);

                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Profile details has been already recorded!</p>
                            </div>
                          <?php

                      }
                      else{
                          $sql = "UPDATE tbl_users SET FIRSTNAME='$first', LASTNAME='$last', GENDER='$gender', EMAIL='$email', ROLE='$role', STATUS='$status' WHERE USERCODE = '$usercode'";
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
                                window.location = "index.php?page=users&a=adminuser";
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
                    <h4 class="card-title">Edit Profile Details</h4>
                    <p class="card-description"> Profile #: &nbsp;&nbsp;&nbsp; <?php echo $_GET['usercode']; ?></p>

                    <form class="forms-sample" action="index.php?page=users&a=adminuseredit&usercode=<?php echo $_GET['usercode']; ?>" method="POST">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="first" maxlength="60" value="<?php if (isset($_POST['first'])){ echo $_POST['first']; }else { echo USERFIRSTNAME($_GET['usercode']); } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="last" maxlength="60" value="<?php if (isset($_POST['last'])){ echo $_POST['last']; }else { echo USERLASTNAME($_GET['usercode']); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Gender <span class="text-danger">*</span></label>
                            <?php

                              if (isset($_POST['gender'])) {
                                $sex = trim($_POST['gender']);
                              }
                              else{
                                 $sex = USERGENDER($_GET['usercode']);
                              }

                              if ($sex == 'Female') {
                                ?>
                                <div class="col-sm-4">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="membershipRadios1" value="Male">Male</label>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="membershipRadios2" value="Female" checked>Female</label>
                                  </div>
                                </div>
                                <?php
                              }
                              else{
                                ?>
                                <div class="col-sm-4">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="membershipRadios1" value="Male" checked>Male</label>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="membershipRadios2" value="Female">Female</label>
                                  </div>
                                </div>
                                <?php
                              }
                            ?>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Role <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <div class="form-group">
                                <select class="form-control form-control-lg text-dark" id="exampleFormControlSelect1" name="role">
                                  <option disabled selected>Select Role</option>
                                  <?php
                                    if (isset($_POST['role'])) {
                                      $roleaccount = trim($_POST['role']);
                                    }
                                    else{
                                       $roleaccount = USERROLE($_GET['usercode']);
                                    }
                                  ?>
                                  <option value="Admin" <?php if ($roleaccount == 'Admin') { echo "selected"; } ?>>Admin</option>
                                  <option value="Staff" <?php if ($roleaccount == 'Staff') { echo "selected"; } ?>>Staff</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="email" maxlength="60" value="<?php if (isset($_POST['email'])){ echo $_POST['email']; }else { echo USEREMAIL($_GET['usercode']); } ?>" readonly />
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
                                      $statusaccount = trim($_POST['status']);
                                    }
                                    else{
                                       $statusaccount = USERSTATUS($_GET['usercode']);
                                    }
                                  ?>
                                  <option value="Active" <?php if ($statusaccount == 'Active') { echo "selected"; } ?>>Active</option>
                                  <option value="Deactive" <?php if ($statusaccount == 'Deactive') { echo "selected"; } ?>>Deactive</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <p class="text-center">
                        <input type="hidden" class="form-control" name="usercode" value="<?php if (isset($_GET['usercode'])){ echo $_GET['usercode']; } ?>" />
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Update</button>
                        <a href="index.php?page=users&a=adminuser" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            