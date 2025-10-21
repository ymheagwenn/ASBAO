        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-account"></i>
                </span> Profile Information
              </h3>
            </div>

            <div class="row">
              <div class="col-md-3"></div>

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
                                        window.location = "index.php?page=home&a=userdashboard";
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
                        <form class="forms-sample" action="index.php?page=home&a=userchangepass" method="POST">
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

              <div class="col-md-3"></div>
            </div>
          </div>