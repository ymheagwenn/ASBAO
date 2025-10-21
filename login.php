<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ASBAO - Login</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="models/img/NWSSU.png" rel="icon">
    <link href="models/img/NWSSU.png" rel="apple-touch-icon">
    <link href="models/css/preloader.css" rel="stylesheet">
    <script src="assets/js/jquery.js"></script>
  </head>
  <body>
    <div class="loader-container">
      <div class="loader"></div>
    </div>

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth" style="background-color: #D6F6D5;">
          <div class="row flex-grow">
            <div class="col-lg-5 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo" style="text-align: center;">
                  <img src="models/img/NWSSU.png" style="width: 35%;">
                  <h4 style="text-align: center; font-weight: bold; color: #40826D;">ASBAO VENUE RESERVATION SYSTEM</h4>
                </div>
                <?php
                  if (isset($_POST['login'])) {
                    if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] !='' && $_POST['password'] !=''){
                      $username = $_POST['username'];
                      $password = md5($_POST['password']);

                      $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE EMAIL ='$username' AND PASSWORD ='$password'");
                      if (mysqli_num_rows($sql) > 0){
                          $info = mysqli_fetch_array($sql);

                          $usercode = $info['USERCODE'];
                          $first = $info['FIRSTNAME'];
                          $last = $info['LASTNAME'];
                          $role = $info['ROLE'];
                          $status = $info['STATUS'];
                          $_SESSION['USERCODE'] = $usercode;
                          $_SESSION['FIRSTNAME'] = $first;
                          $_SESSION['LASTNAME'] = $last;
                          $_SESSION['ROLE'] = $role;

                          if ($role == 'Admin' && $status == 'Active') {
                            header('location: ?page=home&a=admindashboard');
                            exit();
                          }
                          if ($role == 'Staff' && $status == 'Active') {
                            header('location: ?page=home&a=admindashboard');
                            exit();
                          }
                          elseif ($role == 'Client' && $status == 'Active') {
                            header('location: ?page=home&a=userdashboard');
                            exit();
                          }
                          else{
                            ?>
                              <div class="row text-center">
                                  <h5 style='color:red; font-size: 14px;'>Your account has been disabled.</h5>
                              </div>
                            <?php
                          }
                      }
                      else{
                          ?>
                              <div class="row text-center">
                                  <h5 style='color:red; font-size: 14px;'>Invalid user account. Please try again!</h5>
                              </div>
                          <?php
                      }
                    }
                    else{
                      ?>
                        <div class="row text-center">
                          <h5 style='color:red; font-size: 14px;'>Please enter username and password!</h5>
                        </div>
                      <?php
                    }
                  }

                ?>
                <form class="pt-3" action="index.php?a=login" method="POST">
                  <div class="form-group">
                    <input type="email" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" value="<?php if (isset($_POST['username'])){ echo $_POST['username']; } ?>">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  </div>

                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" name="login" class="btn btn-block btn-lg font-weight-medium auth-form-btn text-white" style="background-color: #40826D;">LOGIN</button>
                  </div>

                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">

                    </div>
                    <a href="index.php?a=forgotpassword" class="auth-link text-success">Forgot password?</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="index.php?a=register" class="text-success">Create</a></div>                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>

    <script>
      $(window).on("load",function(){
          $(".loader-container").fadeOut(1000);
      });
    </script>
  </body>
</html>