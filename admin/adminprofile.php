        <div class="main-panel">
          <div class="content-wrapper">
            <?php
              // Handle profile info update
              if (isset($_POST['saveprofile'])){
                $usercode   = trim($_POST['usercode']);
                $firstname  = str_replace("'", "", trim($_POST['firstname']));
                $middlename = str_replace("'", "", trim($_POST['middlename']));
                $lastname   = str_replace("'", "", trim($_POST['lastname']));
                $gender     = str_replace("'", "", trim($_POST['gender']));
                $email      = str_replace("'", "", trim($_POST['email']));
                $contact    = str_replace("'", "", trim($_POST['contact']));
                $address    = str_replace("'", "", trim($_POST['address']));
                $role       = str_replace("'", "", trim($_POST['role']));

                if (!empty($firstname) && !empty($lastname) && !empty($email)){
                  $sql = "UPDATE tbl_users SET FIRSTNAME='$firstname', MIDDLENAME='$middlename', LASTNAME='$lastname', GENDER='$gender', EMAIL='$email', CONTACT='$contact', ADDRESS='$address', ROLE='$role' WHERE USERCODE = '$usercode'";
                  if (!mysqli_query($conn,$sql)) {
                    die('Error:'.mysqli_error($conn));
                  }

                  ?>
                    <script type="text/javascript">
                      Swal.fire(
                        'Updated!',
                        'Profile updated successfully!',
                        'success'
                      ).then((result) => {
                        window.location = "index.php?page=home&a=adminprofile";
                      });
                    </script>
                  <?php
                } else {
                  ?>
                    <div class="row text-center">
                      <p class="text-danger" style='font-size: 15px;'>First name, last name, and email are required.</p>
                    </div>
                  <?php
                }
              }
            ?>
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-success text-white me-2">
                  <i class="mdi mdi-account"></i>
                </span> Profile Information
              </h3>
            </div>

            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <form class="forms-sample" action="index.php?page=home&a=adminprofile" method="POST">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="firstname" value="<?php echo USERFIRSTNAME($_SESSION['USERCODE']); ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Middle Name</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="middlename" value="<?php echo USERMIDDLENAME($_SESSION['USERCODE']); ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="lastname" value="<?php echo USERLASTNAME($_SESSION['USERCODE']); ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Gender</label>
                            <div class="col-sm-8">
                              <select class="form-control" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male" <?php if (USERGENDER($_SESSION['USERCODE'])=='Male'){ echo 'selected'; } ?>>Male</option>
                                <option value="Female" <?php if (USERGENDER($_SESSION['USERCODE'])=='Female'){ echo 'selected'; } ?>>Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                              <select class="form-control" name="role">
                                <option value="Admin" <?php if (USERROLE($_SESSION['USERCODE'])=='Admin'){ echo 'selected'; } ?>>Admin</option>
                                <option value="Staff" <?php if (USERROLE($_SESSION['USERCODE'])=='Staff'){ echo 'selected'; } ?>>Staff</option>
                                <option value="Client" <?php if (USERROLE($_SESSION['USERCODE'])=='Client'){ echo 'selected'; } ?>>Client</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="email" class="form-control" name="email" value="<?php echo USEREMAIL($_SESSION['USERCODE']); ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Contact</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="contact" value="<?php echo USERCONTACT($_SESSION['USERCODE']); ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="address" value="<?php echo USERADDRESS($_SESSION['USERCODE']); ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <p style="text-align: right;">
                        <input type="hidden" class="form-control" name="usercode" value="<?php echo $_SESSION['USERCODE']; ?>" />
                        <button type="submit" class="btn btn-sm text-white" name="saveprofile" style="background-color: #40826D;">Save Changes</button>
                      </p>
                      </form>
                  </div>
                </div>
              </div>

              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title text-center">Change Password</h3>
                      <br>
                      <?php
                        if (isset($_POST['password']) &&
                            isset($_POST['confirm'])){

                            if (empty(trim($_POST['password'])) ||
                                empty(trim($_POST['confirm']))) {

                                ?>
                                  <div class="row text-center">
                                    <p class="text-danger" style='font-size: 15px;'>One of the required field is empty or contains invalid data, please check your input!</p>
                                  </div>
                                <?php
                            }
                            else{
                              $usercode = trim($_POST['usercode']);
                              $password = md5(str_replace("'", "", trim($_POST['password'])));
                              $confirm = md5(str_replace("'", "", trim($_POST['confirm'])));

                              if ($password == $confirm){
                                  $sql = "UPDATE tbl_users SET PASSWORD='$password' WHERE USERCODE = '$usercode'";
                                  if (!mysqli_query($conn,$sql)) {
                                      die('Error:'.mysqli_error($conn));
                                  }

                                  ?>

                                    <script type="text/javascript">
                                      Swal.fire(
                                        'Updated!',
                                        'Password changed successfully!',
                                        'success'
                                      ).then((result) => {
                                        window.location = "index.php?page=home&a=adminprofile";
                                      });
                                    </script>
                                  <?php
                              }
                              else{
                                  ?>
                                    <div class="row text-center">
                                      <p class="text-danger" style='font-size: 15px;'>Password does not matched!</p>
                                    </div>
                                    <br>
                                  <?php
                              } 
                            }
                        }
                    ?>
                      <br><br>
                        <form class="forms-sample" action="index.php?page=home&a=adminprofile" method="POST">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Password <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="password" maxlength="60" value="" />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Confirm <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="confirm" maxlength="60" value="" />
                                </div>
                              </div>
                            </div>
                          </div>

                          <p style="text-align: right;">
                            <input type="hidden" class="form-control" name="usercode" value="<?php echo $_SESSION['USERCODE']; ?>" />
                            <button type="submit" class="btn btn-sm text-white" name="change" style="background-color: #40826D;">Change Password</button>
                          </p>
                        </form>
                  </div>
                </div>
              </div>
            </div>
          </div>