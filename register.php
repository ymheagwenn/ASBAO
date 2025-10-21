<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ASBAO - Register</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="models/img/NWSSU.png" rel="icon">
    <link href="models/img/NWSSU.png" rel="apple-touch-icon">
    <link href="models/css/preloader.css" rel="stylesheet">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/sweetalert.js"></script>
  </head>
  <body>
    <div class="loader-container">
      <div class="loader"></div>
    </div>

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper" style="background-color: #D6F6D5;">

            <div class="row">

              <?php
                if (isset($_POST['register'])){

                    if (!isset($_POST['gender'])){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please select a gender!</p>
                        </div>
                      <?php
                    }
                    elseif (!isset($_POST['department'])){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please select a department!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['first'])) ||
                        empty(trim($_POST['middle'])) ||
                        empty(trim($_POST['last'])) ||
                        empty(trim($_POST['contact'])) ||
                        empty(trim($_POST['address'])) ||
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
                      $middle = str_replace("'", "", ucwords(strtolower(trim($_POST['middle']))));
                      $last = str_replace("'", "", ucwords(strtolower(trim($_POST['last']))));
                      $gender = trim($_POST['gender']);
                      $contact = str_replace("'", "", trim($_POST['contact']));
                      $address = str_replace("'", "", trim($_POST['address']));
                      $department = str_replace("'", "", trim($_POST['department']));
                      $role = "Client";
                      $email = str_replace("'", "", strtolower(trim($_POST['email'])));
                      $pass = md5(str_replace("'", "", trim($_POST['pass'])));
                      $profile = "No Image";
                      $status = "Active";
                      date_default_timezone_set('Asia/Manila');
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
                          $sql = "INSERT INTO tbl_users(USERCODE, FIRSTNAME, MIDDLENAME, LASTNAME, GENDER, CONTACT, ADDRESS, DEPARTMENT, EMAIL, PASSWORD, ROLE, PROFILE, STATUS, DATEON) VALUES('$usercode','$first','$middle','$last','$gender','$contact','$address','$department','$email','$pass','$role','$profile','$status','$dateon')";
                          if (!mysqli_query($conn,$sql)) {
                              die('Error:'.mysqli_error($conn));
                          }

                          // Send registration confirmation email
                          include_once 'PHPMailerAutoload.php';
                          include_once 'credential.php';

                          $mail = new PHPMailer;
                          //$mail->SMTPDebug = 2;  // enable for debugging
                          $mail->isSMTP();
                          $mail->Host = 'smtp.gmail.com';
                          $mail->SMTPAuth = true;
                          $mail->Username = EMAIL;
                          $mail->Password = PASS;
                          $mail->SMTPSecure = 'tls';
                          $mail->Port = 587;
                          $mail->CharSet = 'UTF-8';
                          // Allow self-signed in local dev environments
                          $mail->SMTPOptions = array(
                            'ssl' => array(
                              'verify_peer' => false,
                              'verify_peer_name' => false,
                              'allow_self_signed' => true
                            )
                          );

                          $mail->setFrom(EMAIL, 'ASBAO');
                          $mail->addAddress($email, $first.' '.$last);
                          $mail->addReplyTo(EMAIL);
                          $mail->isHTML(true);

                          $mail->Subject = 'Registration Complete!';
                          $mail->Body = '✅ <strong>Registration Complete!</strong><br><br>'
                            .'Welcome aboard, <strong>'.htmlspecialchars($first).'</strong>!<br><br>'
                            .'Your email has been recorded and your account has been successfully created. '
                            .'You can now log in and start exploring.';
                          $mail->AltBody = 'Registration Complete! Welcome aboard, '.htmlspecialchars($first).'! Your email has been recorded and your account has been created. You can now log in and start exploring.';

                          // Send but do not block UX if it fails
                          try {
                            $mail->send();
                          } catch (Exception $e) {
                            error_log('Registration email failed: '.$mail->ErrorInfo);
                          }

                          // Optional: SMS notification via Twilio if credentials are configured
                          if (defined('TWILIO_SID') && TWILIO_SID !== '' && defined('TWILIO_TOKEN') && TWILIO_TOKEN !== '' && defined('TWILIO_FROM') && TWILIO_FROM !== '') {
                            $toNumber = preg_replace('/\D+/', '', $contact);
                            // Try to normalize PH numbers starting with 09 to +63
                            if (substr($toNumber, 0, 2) === '09') {
                              $toNumber = '+63'.substr($toNumber, 1);
                            } elseif (substr($toNumber, 0, 1) === '9' && strlen($toNumber) === 10) {
                              $toNumber = '+63'.$toNumber;
                            } elseif (substr($toNumber, 0, 1) !== '+') {
                              $toNumber = '+'.$toNumber;
                            }

                            $smsBody = 'ASBAO: Registration complete. Welcome, '.$first.'! You can now log in.';

                            $twilioUrl = 'https://api.twilio.com/2010-04-01/Accounts/'.TWILIO_SID.'/Messages.json';
                            $postFields = http_build_query(array(
                              'From' => TWILIO_FROM,
                              'To' => $toNumber,
                              'Body' => $smsBody
                            ));

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $twilioUrl);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_USERPWD, TWILIO_SID.':'.TWILIO_TOKEN);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            $resp = curl_exec($ch);
                            if ($resp === false) {
                              error_log('Twilio SMS error: '.curl_error($ch));
                            }
                            curl_close($ch);
                          }

                          $_SESSION['USERCODE'] = $usercode;
                          $_SESSION['FIRSTNAME'] = $first;
                          $_SESSION['LASTNAME'] = $last;
                          $_SESSION['ROLE'] = $role;

                          ?>
                            <script type="text/javascript">
                              Swal.fire(
                                'Successfully Registered!',
                                'Welcome to ASBAO Venue Reservation',
                                'success'
                              ).then((result) => {
                                window.location = "index.php?page=home&a=userdashboard";
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
                    <h4 class="card-title">ASBAO Online Registration</h4>
                    <p class="card-description"> Please fill in the form below. </p>
                    <form class="forms-sample" action="index.php?a=register" method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="last" maxlength="60" value="<?php if (isset($_POST['last'])){ echo $_POST['last']; } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="first" maxlength="60" value="<?php if (isset($_POST['first'])){ echo $_POST['first']; } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Middle Name</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="middle" maxlength="60" value="<?php if (isset($_POST['middle'])){ echo $_POST['middle']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Gender <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <div class="form-group">
                                <select class="form-control form-control-lg text-dark" name="gender">
                                  <option disabled selected>Select Gender</option>
                                  <?php
                                    if (isset($_POST['gender'])) {
                                      $gender = trim($_POST['gender']);
                                    }
                                    else{
                                       $gender = '';
                                    }
                                  ?>
                                  <option value="Male" <?php if ($gender == 'Male') { echo "selected"; } ?>>Male</option>
                                  <option value="Female" <?php if ($gender == 'Female') { echo "selected"; } ?>>Female</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Contact <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="contact" maxlength="11" value="<?php if (isset($_POST['contact'])){ echo $_POST['contact']; } ?>" />
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Home Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="address" maxlength="200" value="<?php if (isset($_POST['address'])){ echo $_POST['address']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Department <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <div class="form-group">
                                <select class="form-control form-control-lg text-dark" name="department">
                                  <option disabled selected>Select Department</option>
                                  <?php
                                    if (isset($_POST['department'])) {
                                      $department = trim($_POST['department']);
                                    }
                                    else{
                                       $department = '';
                                    }

                                    $sql = mysqli_query($conn,"SELECT * FROM tbl_department WHERE STATUS ='Active'");
                                      if (mysqli_num_rows($sql) > 0) {
                                          while ($info = mysqli_fetch_array($sql)) {
                                            ?>
                                              <option value="<?php echo $info['DEPARTMENTNAME']; ?>" <?php if ($department == $info['DEPARTMENTNAME']) { echo "selected"; } ?>><?php echo $info['DESCRIPTION']; ?></option>
                                            <?php
                                          }
                                      }
                                  ?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                      	<div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="email" maxlength="100" value="<?php if (isset($_POST['email'])){ echo $_POST['email']; } ?>" />
                            </div>
                          </div>
                        </div>

                      	<div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Password <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="password" class="form-control" name="pass" maxlength="60" value="<?php if (isset($_POST['pass'])){ echo $_POST['pass']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <button type="submit" name="register" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Register</button>
                        <a href="index.php" class="btn btn-gradient-light btn-md me-2">Back to Home</a>
                      </p>
                    </form>
                  </div>
            </div>
          </div>

          <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="index.php?a=login" class="text-success">Login</a></div>
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