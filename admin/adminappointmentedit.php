        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if (isset($_POST['saveappointment'])){

                    if (empty(trim($_POST['last']))){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please input last name!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['first']))){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please input first name!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['contact']))){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please input contact!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['email']))){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please input email address!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['address']))){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please input an address!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['remarks']))) {
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please input a remarks!</p>
                        </div>
                      <?php
                    }
                    elseif (!isset($_POST['status'])){
                    	?>
	                      <div class="row text-center">
	                        <p class="text-danger" style='font-size: 15px;'>Please select a appointment status!</p>
	                      </div>
	                    <?php
	                }
                    else{

                      date_default_timezone_set('Asia/Manila');
                      $usercode = $_SESSION['USERCODE'];
                      $controlcode = $_POST['controlcode'];
                      $last = str_replace("'", "", trim($_POST['last']));
                      $first = str_replace("'", "", trim($_POST['first']));
                      $middle = str_replace("'", "", trim($_POST['middle']));
                      $contact = str_replace("'", "", trim($_POST['contact']));
                      $email   = str_replace("'", "", trim($_POST['email']));
                      $address = str_replace("'", "", trim($_POST['address']));
                      $remarks = str_replace("'", "", trim($_POST['remarks']));
                      $status = trim($_POST['status']);

                      $sql = "UPDATE tbl_appointment SET LASTNAME='$last', FIRSTNAME='$first', MIDDLENAME='$middle', CONTACT='$contact', EMAIL='$email', ADDRESS='$address', REMARKS='$remarks', STATUS='$status'  WHERE CONTROLCODE = '$controlcode'";
                      if (!mysqli_query($conn,$sql)) {
                          die('Error:'.mysqli_error($conn));
                      }

                      if ($status == 'COMPLETED') {
                            $recipient = strtolower(trim($email));
                            $subject = "ASBAO Venue Booking Confirmation – [Event Name / Organization]";
                            $message = "Appointment Details";

                            include_once 'PHPMailerAutoload.php';
                            include_once 'credential.php';

                            $mail = new PHPMailer;

                            //$mail->SMTPDebug = 4;  

                            $mail->isSMTP();                                                                          
                            $mail->Host = 'smtp.gmail.com';                         
                            $mail->SMTPAuth = true;                                                      
                            $mail->Username = EMAIL;                                                                  
                            $mail->Password = PASS;                                                      
                            $mail->SMTPSecure = 'tls';                                                       
                            $mail->Port = 587;                                                         
                            $mail->setFrom(EMAIL, "ASBAO");
                            $mail->addAddress($recipient);  
                            $mail->addReplyTo(EMAIL);
                            $mail->isHTML(true);                                                                          
                            $mail->Subject = $subject;
                            $mail->AltBody = $message;

                            if(!$mail->send()) { 
                                                            
                              ?>
                                  <div class="col-xl-12 col-lg-12">
                                      <p class="text-danger text-center" style='font-size: 15px;'>Message could not be sent.</p>
                                  </div>
                              <?php
                            }
                      }

                      ?>
                          <script type="text/javascript">
                            Swal.fire(
                              'Saved!',
                              'Appointment updated successfully!',
                              'success'
                            ).then((result) => {
                              window.location = "index.php?page=appointment&a=adminappointment";
                            });
                          </script>
                      <?php
                    }
                }
              ?>

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Appointment Details</h4>

                    <form class="forms-sample" action="index.php?page=appointment&a=adminappointmentedit&appointmentcode=<?php echo $_GET['appointmentcode']; ?>" method="POST" enctype="multipart/form-data">
                      
                      <br><p class="card-description"> Booking Information </p>
                      <div class="row">
                        <?php
                          $controlcode = $_GET['appointmentcode'];
                          if (VENUELISTSCONTROLCODE($controlcode) > 0) {
                            ?>
                              <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th> # </th>
                                      <th width="30%" class="text-left"> Venue </th>
                                      <th width="35%" class="text-center"> Date </th>
                                      <th width="25%" class="text-center"> Time </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $count = 1;
                                      $controlcode = $_GET['appointmentcode'];
                                      $sql = mysqli_query($conn,"SELECT * FROM tbl_venuelists WHERE CONTROLCODE='$controlcode' AND AVAILABILITY='1' ORDER BY VENUEID ASC");
                                      if (mysqli_num_rows($sql) > 0) {
                                        while ($info = mysqli_fetch_array($sql)){
                                          ?>
                                          <tr>
                                            <td><?php echo $count++;  ?></td>
                                            <td class="text-left">
                                              <?php echo $info['CATEGORYNAME']; ?>
                                            </td>
                                            <td class="text-center">
                                              <?php echo date('M d, Y', strtotime($info['VENUEDATE'])); ?>
                                            </td>
                                            <td class="text-center">
                                              <?php echo $info['VENUETIME']; ?>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                      }
                                      else{
                                        ?>
                                        <tr>
                                          <td colspan="7">
                                            <br><br>
                                            <div class="col-12 text-center">
                                              <p class="text-dark" style='font-size: 15px;'>There was no schedule!</p>
                                            </div>
                                            <br>
                                          </td>
                                        </tr>
                                        <?php
                                      }
                                    ?>
                                  </tbody>
                                </table>
                              </div>
                            <?php
                          }
                        ?>
                        
                      </div><br><br>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Remarks <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                              <textarea name="remarks" style="line-height: 1.6em;" class="form-control" rows="3"><?php if (isset($_POST['remarks'])){ echo $_POST['remarks']; }else{ echo APPOINTREMARK($controlcode); } ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <br><p class="card-description"> Personal Information </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="last" maxlength="60" value="<?php if (isset($_POST['last'])){ echo $_POST['last']; }else{ echo APPOINTLAST($controlcode); } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Contact <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="contact" maxlength="11" value="<?php if (isset($_POST['contact'])){ echo $_POST['contact']; }else{ echo APPOINTCONTACT($controlcode); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="first" maxlength="60" value="<?php if (isset($_POST['first'])){ echo $_POST['first']; }else{ echo APPOINTFIRST($controlcode); } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="email" maxlength="100" value="<?php if (isset($_POST['email'])){ echo $_POST['email']; }else{ echo APPOINTEMAIL($controlcode); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Middle Name</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="middle" maxlength="100" value="<?php if (isset($_POST['middle'])){ echo $_POST['middle']; }else{ echo APPOINTMIDDLE($controlcode); } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="address" maxlength="200" value="<?php if (isset($_POST['address'])){ echo $_POST['address']; }else{ echo APPOINTADDRESS($controlcode); } ?>" />
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
                                  <option disabled selected>Select Appointment Status</option>
                                  <?php
                                    if (isset($_POST['status'])) {
                                      $status = trim($_POST['status']);
                                    }
                                    else{
                                       $status = APOINTSTATUS($controlcode);
                                    }
                                  ?>
                                  <option value="ACCEPTED" <?php if ($status == 'ACCEPTED') { echo "selected"; } ?>>Accept</option>
                                  <option value="COMPLETED" <?php if ($status == 'COMPLETED') { echo "selected"; } ?>>Complete</option>
                                  <option value="CANCELLED" <?php if ($status == 'CANCELLED') { echo "selected"; } ?>>Cancel</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

                      <br>

                      <p class="text-center">
                        <input type="hidden" class="form-control" name="controlcode" value="<?php if (isset($_GET['appointmentcode'])){ echo $_GET['appointmentcode']; } ?>" />
                        <button type="submit" name="saveappointment" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Save</button>
                        <a href="index.php?page=appointment&a=adminappointment" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            