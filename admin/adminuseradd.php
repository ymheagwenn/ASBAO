        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if (isset($_POST['first']) &&
                    isset($_POST['last']) &&
                    isset($_POST['gender']) &&
                    isset($_POST['email']) &&
                    isset($_POST['pass'])){

                    if (!isset($_POST['role'])){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please select an account role!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['first'])) ||
                        empty(trim($_POST['last'])) ||
                        empty(trim($_POST['gender'])) ||
                        empty(trim($_POST['email'])) ||
                        empty(trim($_POST['pass']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>One of the required field is empty or contains invalid data, please check your input!</p>
                          </div>
                        <?php
                    }
                    else{
                      date_default_timezone_set('Asia/Manila');
                      $usercode = date('ymd-His') . "-". intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
                      $first = str_replace("'", "", ucwords(strtolower(trim($_POST['first']))));
                      $last = str_replace("'", "", ucwords(strtolower(trim($_POST['last']))));
                      $gender = trim($_POST['gender']);
                      $role = trim($_POST['role']);
                      $email = str_replace("'", "", strtolower(trim($_POST['email'])));
                      $pass = md5(str_replace("'", "", trim($_POST['pass'])));
                      $profile = "No Image";
                      $status = "Active";
                      $dateon = strtotime(date("Y-m-d h:i:sa"));


                      $sqlpro = mysqli_query($conn, "SELECT * FROM tbl_users WHERE FIRSTNAME = '$first' AND LASTNAME ='$last' OR EMAIL ='$email'");
                      if (mysqli_num_rows($sqlpro) > 0){
                          $info = mysqli_fetch_array($sqlpro);

                          if (strtoupper($info['FIRSTNAME']) == strtoupper($first) AND strtoupper($info['LASTNAME']) == strtoupper($last)) {
                            ?>
                              <div class="row text-center">
                                <p class="text-danger" style='font-size: 15px;'>Profile name has already recorded!</p>
                              </div>
                            <?php
                          }
                          elseif (strtoupper($info['EMAIL']) == strtoupper($email)){
                            ?>
                              <div class="row text-center">
                                <p class="text-danger" style='font-size: 15px;'>Email has already recorded!</p>
                              </div>
                            <?php
                          }
                      }
                      else{
                          $sql = "INSERT INTO tbl_users(USERCODE, FIRSTNAME, LASTNAME, GENDER, EMAIL, PASSWORD, ROLE, PROFILE, STATUS, DATEON) VALUES('$usercode','$first','$last','$gender','$email','$pass','$role','$profile','$status','$dateon')";
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
                    <h4 class="card-title">Create User Account</h4>
                    <p class="card-description"> Please enter your personal information details. </p>

                    <form class="forms-sample" action="index.php?page=users&a=adminuseradd" method="POST">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="first" maxlength="60" value="<?php if (isset($_POST['first'])){ echo $_POST['first']; } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="last" maxlength="60" value="<?php if (isset($_POST['last'])){ echo $_POST['last']; } ?>" />
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
                                 $sex = 'Male';
                              }

                              if ($sex == 'Female') {
                                ?>
                                <div class="col-sm-4">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" value="Male">Male</label>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" value="Female" checked>Female</label>
                                  </div>
                                </div>
                                <?php
                              }
                              else{
                                ?>
                                <div class="col-sm-4">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" value="Male" checked>Male</label>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="form-check">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" value="Female">Female</label>
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
                                <select class="form-control form-control-lg text-dark" name="role">
                                  <option disabled selected>Select Role</option>
                                  <?php
                                    if (isset($_POST['role'])) {
                                      $roleaccount = trim($_POST['role']);
                                    }
                                    else{
                                       $roleaccount = '';
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
                              <input type="text" class="form-control" name="email" maxlength="60" value="<?php if (isset($_POST['email'])){ echo $_POST['email']; } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="password" class="form-control" name="pass" maxlength="60" value="<?php if (isset($_POST['pass'])){ echo $_POST['pass']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Save</button>
                        <a href="index.php?page=users&a=adminuser" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            