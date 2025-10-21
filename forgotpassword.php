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
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo" style="text-align: center;">
                  <img src="models/img/NWSSU.png" style="width: 30%;">
                </div>
                <?php
                  $recipient = "";
                  if (isset($_POST['email'])) {
                    $recipient = strtolower(trim($_POST['email']));
                    $subject = "Reset Password";
                    $message = "Password";
                    $pass = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
                    $password = md5($pass);

                    $sql = mysqli_query($conn, "SELECT * FROM tbl_users WHERE EMAIL ='$recipient'");
                    if (mysqli_num_rows($sql) > 0){
                      $info = mysqli_fetch_array($sql);

                      $usercode = $info['USERCODE'];
                      $first = $info['FIRSTNAME'];

                      // Prepare email first; only update password if email sends successfully
                      require_once 'PHPMailerAutoload.php';
                     require_once 'credential.php';

                      $mail = new PHPMailer;

                      // SMTP debugging disabled for production use

                      $mail->isSMTP();                                                                      
                      $mail->Host = 'smtp.gmail.com';                         
                      $mail->SMTPAuth = true;                                                      
                      $mail->Username = EMAIL;                                                                  
                      $mail->Password = PASS;                                                      
                      $mail->SMTPSecure = 'tls';                                                       
                      $mail->Port = 587;
                      $mail->CharSet = 'UTF-8';
                      // Allow self-signed/relax verification for local dev Windows/XAMPP
                      $mail->SMTPOptions = array(
                        'ssl' => array(
                          'verify_peer' => false,
                          'verify_peer_name' => false,
                          'allow_self_signed' => true
                        )
                      );
         //              $mail->SMTPOptions = array(
					    //     'ssl' => array(
					    //         'verify_peer' => false,
					    //         'verify_peer_name' => false,
					    //         'allow_self_signed' => true
					    //     )
					    // );                                               
                      $mail->setFrom(EMAIL, "ASBAO");
                      $mail->addAddress($recipient);  
                      $mail->addReplyTo(EMAIL);
                      $mail->isHTML(true);                                                                          
                      $mail->Subject = $subject;
                      $mail->Body    = "Your OTP to change your password is <b>".$pass ."</b>. Please use this code within 10 minutes. Do not share this code with anyone.";
                      $mail->AltBody = $message;

                      if($mail->send()) { 
                        // Email delivered: commit the temporary password
                        $sql = "UPDATE tbl_users SET PASSWORD='$password' WHERE USERCODE='$usercode'";
                        if (!mysqli_query($conn,$sql)) {
                          die('Error:'.mysqli_error($conn));
                        }
                        ?>
                            <div class="col-xl-12 col-lg-12">
                                <p class="text-success text-center" style='font-size: 15px;'>Message has been sent.</p>
                            </div>
                        <?php
                      } else {
                        // Retry with SMTPS on port 465 if STARTTLS failed
                        error_log('Email send failed on 587/TLS (forgotpassword): '.$mail->ErrorInfo);
                        $mail->smtpClose();
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = EMAIL;
                        $mail->Password = PASS;
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;
                        $mail->CharSet = 'UTF-8';
                        $mail->SMTPOptions = array(
                          'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                          )
                        );
                        // Reapply headers
                        $mail->setFrom(EMAIL, "ASBAO");
                        $mail->clearAddresses();
                        $mail->addAddress($recipient);
                        $mail->addReplyTo(EMAIL);
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body    = "Your OTP to change your password is <b>".$pass ."</b>. Please use this code within 10 minutes. Do not share this code with anyone.";
                        $mail->AltBody = $message;

                        if ($mail->send()) {
                          // Email delivered via SSL 465: commit the temporary password
                          $sql = "UPDATE tbl_users SET PASSWORD='$password' WHERE USERCODE='$usercode'";
                          if (!mysqli_query($conn,$sql)) {
                            die('Error:'.mysqli_error($conn));
                          }
                          ?>
                              <div class="col-xl-12 col-lg-12">
                                  <p class="text-success text-center" style='font-size: 15px;'>Message has been sent.</p>
                              </div>
                          <?php
                        } else {
                          error_log('Email send failed on 465/SSL (forgotpassword): '.$mail->ErrorInfo);
                          ?>
                              <div class="col-xl-12 col-lg-12">
                                  <p class="text-danger text-center" style='font-size: 15px;'>Message could not be sent.</p>
                              </div>
                          <?php
                          header('Refresh: 2;url=index.php?a=forgotpassword');
                        }
                      }

                      // Optional SMS OTP
                      require_once 'credential.php';
                      if (defined('TWILIO_SID') && TWILIO_SID !== '' && defined('TWILIO_TOKEN') && TWILIO_TOKEN !== '' && defined('TWILIO_FROM') && TWILIO_FROM !== '') {
                        $contactNum = isset($info['CONTACT']) ? $info['CONTACT'] : '';
                        $toNumber = preg_replace('/\D+/', '', $contactNum);
                        if (!empty($toNumber)) {
                          if (substr($toNumber, 0, 2) === '09') {
                            $toNumber = '+63'.substr($toNumber, 1);
                          } elseif (substr($toNumber, 0, 1) === '9' && strlen($toNumber) === 10) {
                            $toNumber = '+63'.$toNumber;
                          } elseif (substr($toNumber, 0, 1) !== '+') {
                            $toNumber = '+'.$toNumber;
                          }

                          $smsBody = 'ASBAO: Your OTP is '.$pass.'. Use within 10 minutes.';
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
                          if ($resp === false) { error_log('Twilio SMS error (otp): '.curl_error($ch)); }
                          curl_close($ch);
                        }
                      }
                    }
                    else{
                        ?>
                            <div class="col-xl-12 col-lg-12">
                                <p class="text-danger text-center" style='font-size: 15px;'>There was no email from the server.<br>Please try again!</p>
                            </div>
                        <?php
                    }
                  }
                ?>
                <h3 class="text-center mt-4 font-weight-light">ASBAO</h3>

                <form class="pt-3" action="index.php?a=forgotpassword" method="POST">
                  <div class="form-group">
                    <h6 class="text-center mt-4 font-weight-light">Please enter your recovery email address and we will send you temporarily password thru email.</h6><br>
                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Recovery Email Address" value="<?php if (isset($_POST['email'])){ echo $_POST['email']; } ?>">
                  </div>

                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" name="forgotpassword" class="btn btn-block btn-lg font-weight-medium auth-form-btn text-white" style="background-color: #40826D;">SUBMIT</button>
                  </div>

                  <br>
                  <div class="text-center mt-4 font-weight-light"><a href="index.php" class="text-success">Back to Home</a></div>                  
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