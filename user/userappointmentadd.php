        <style>
          /* Mobile optimizations for Create Appointment */
          @media (max-width: 768px) {
            .forms-sample .form-group .col-sm-2,
            .forms-sample .form-group .col-sm-10 {
              width: 100% !important;
              max-width: 100% !important;
              flex: 0 0 100% !important;
            }
            .forms-sample .form-group .col-sm-2 {
              margin-bottom: 6px;
            }
            .forms-sample .btn {
              width: 100%;
              margin-bottom: 10px;
            }
            .card-body {
              padding: 16px;
            }
          }
        </style>

        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <?php
              // Check if user has pending feedback
              $usercode = $_SESSION['USERCODE'];
              $feedback_count = CHECKFEEDBACK($usercode);
              if ($feedback_count > 0) {
            ?>
            <div class="container mb-4">
              <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: #fff3cd; border-color: #ffeaa7;">
                <div class="d-flex align-items-center">
                  <i class="mdi mdi-information-outline me-3" style="font-size: 24px; color: #856404;"></i>
                  <div>
                    <h6 class="alert-heading mb-1" style="color: #856404; font-weight: bold;">Feedback Required</h6>
                    <p class="mb-0" style="color: #856404;">
                      You have <strong><?php echo $feedback_count; ?> completed appointment(s)</strong> that need your feedback before making a new booking.
                    </p>
                    <div class="mt-2">
                      <a href="index.php?page=home&a=userfeedback" class="btn btn-warning btn-sm">
                        <i class="mdi mdi-comment-text"></i> Provide Feedback First
                      </a>
                      <a href="index.php?page=home&a=userdashboard" class="btn btn-secondary btn-sm">
                        <i class="mdi mdi-arrow-left"></i> Back to Dashboard
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php 
              // Hide the booking interface when feedback is pending
              echo '<div class="container text-center"><p class="text-muted">Please complete your feedback before booking a new appointment.</p></div>';
              exit();
            } 
            ?>
            <div class="row">

              <?php
                // Get the selected venue from URL parameter
                $selected_venue = isset($_GET['venue']) ? $_GET['venue'] : '';
                if (!empty($selected_venue)) {
                  $venue_name = CATEGORYNAME($selected_venue);
                  echo '<div class="col-12 mb-3">';
                  echo '<div class="alert alert-info">';
                  echo '<h5><i class="mdi mdi-map-marker"></i> Selected Venue: ' . $venue_name . '</h5>';
                  echo '<p class="mb-0">You are booking for: <strong>' . $venue_name . '</strong></p>';
                  echo '</div>';
                  echo '</div>';
                }
              ?>

              <?php
                if (isset($_POST['saveappointment'])){
                    if (empty(trim($_POST['last']))){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Lastname is missing!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['first']))){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Firstname is missing!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['contact']))){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Contact is missing!</p>
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
                    elseif (empty(trim($_POST['email']))){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Email address is missing!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['address']))){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Home address is missing!</p>
                        </div>
                      <?php
                    }
                    elseif (empty(trim($_POST['remarks']))) {
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please input a purpose!</p>
                        </div>
                      <?php
                    }
                    else{
                      include 'phpqrcode/qrlib.php';
                      $path = 'qrcodes/';

                      date_default_timezone_set('Asia/Manila');
                      $usercode = $_SESSION['USERCODE'];
                      $controlcode = date('ymdHi') ."". intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) );
                      $last = str_replace("'", "", trim($_POST['last']));
                      $first = str_replace("'", "", trim($_POST['first']));
                      $middle = str_replace("'", "", trim($_POST['middle']));
                      $contact = str_replace("'", "", trim($_POST['contact']));
                      $department = str_replace("'", "", trim($_POST['department']));
                      $email   = str_replace("'", "", trim($_POST['email']));
                      $address = str_replace("'", "", trim($_POST['address']));
                      $category = '';
                      $scheduledate = '';
                      $scheduletime = '';
                      $remarks = str_replace("'", "", trim($_POST['remarks']));
                      $type = "Online";
                      $status = "PENDING";

                      $qrcode = "qrcodes/";
                      $qrname = trim(strtolower($last)) ."-".trim(strtolower($first));
                      $qrimage = $controlcode.'.png';
                      $pathqrcode = $qrcode.$qrimage;
                      $urlqrcode = $qrcode.$qrimage;

                      date_default_timezone_set('Asia/Manila');
                      $dateon = date('Y-m-d g:i a');

                      // Validate at least one file selected
                      $hasFile = false;
                      if (isset($_FILES['files']) && is_array($_FILES['files']['name'])) {
                        foreach ($_FILES['files']['name'] as $n) { if (!empty($n)) { $hasFile = true; break; } }
                      }
                      if (!$hasFile) {
                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>Attach at least one file! Please try again!</p>
                          </div>
                        <?php
                      }
                      else{
                        // Generate QR once
                        if (!file_exists($pathqrcode)) {
                          QRcode::png($controlcode, $pathqrcode);
                        }

                        $desired_dir = "uploads/clients/";
                        $file_paths = array();
                        foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                          if (empty($_FILES['files']['name' ][$key])) { continue; }
                          $file_name = $usercode."-".strtolower($_FILES['files']['name' ][$key]);
                          $file_tmp =$_FILES['files']['tmp_name'][$key];
                          $path="uploads/clients/$file_name";

                          if (move_uploaded_file($file_tmp, "$desired_dir".$file_name)) {
                            $file_paths[] = $path;
                          }
                        }

                        $forms_value = implode('|', $file_paths);

                        // Insert single appointment with all attachments concatenated
                        $sql = "INSERT INTO tbl_appointment(CONTROLCODE, LASTNAME, FIRSTNAME, MIDDLENAME, CONTACT, DEPARTMENT, EMAIL, ADDRESS, REMARKS, QRCODE, FORMS, TYPE, FEEDBACK, STATUS, DATEON) VALUES('$controlcode','$last','$first','$middle','$contact','$department','$email','$address','$remarks','$urlqrcode','$forms_value','$type','NOT RATED','$status','$dateon')";
                        if (!mysqli_query($conn,$sql)) {
                          die('Error:'.mysqli_error($conn));
                        }

                        // Tie selected venue dates to this control code
                        if (!empty($selected_venue)) {
                          $sqlvr = mysqli_query($conn, "SELECT * FROM tbl_venuelists WHERE USERCODE ='$usercode' AND AVAILABILITY='0' AND CATEGORYCODE='$selected_venue'");
                        } else {
                          $sqlvr = mysqli_query($conn, "SELECT * FROM tbl_venuelists WHERE USERCODE ='$usercode' AND AVAILABILITY='0'");
                        }
                        if (mysqli_num_rows($sqlvr) > 0){
                            while ($infovr = mysqli_fetch_array($sqlvr)) {
                              $venueid = $infovr['VENUEID'];
                              $req_query = "UPDATE tbl_venuelists SET CONTROLCODE='$controlcode', AVAILABILITY='1' WHERE VENUEID = '$venueid'";
                              $req_query_run = mysqli_query($conn, $req_query);
                            }
                        }

                        ?>
                          <script type="text/javascript">
                            Swal.fire(
                              'Saved!',
                              'Data saved successfully!',
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
                    <h4 class="card-title">Create Appointment</h4>

                    <form class="forms-sample" action="index.php?page=appointment&a=userappointmentadd" method="POST" enctype="multipart/form-data">
                      
                      <br><p class="card-description"> Booking Information </p>
                      
                      <div class="row">
                        <?php
                        $usercode = $_SESSION['USERCODE'];
                        // Check if user has selected dates for the specific venue
                        if (!empty($selected_venue)) {
                          $venue_check_sql = mysqli_query($conn, "SELECT COUNT(*) as count FROM tbl_venuelists WHERE USERCODE='$usercode' AND AVAILABILITY='0' AND CATEGORYCODE='$selected_venue'");
                          $venue_check_result = mysqli_fetch_array($venue_check_sql);
                          $has_venue_dates = $venue_check_result['count'] > 0;
                        } else {
                          $has_venue_dates = VENUELISTSCHECK($usercode) > 0;
                        }
                        
                        if ($has_venue_dates) {
                            ?>
                              <div class="col-md-12">
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr>
                                      <th> # </th>
                                      <th width="30%" class="text-left"> Venue </th>
                                      <th width="15%" class="text-center"> Date </th>
                                      <th width="15%" class="text-center"> Time </th>
                                      <th width="10%" class="text-center"> Action </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $count = 1;
                                      $usercode = $_SESSION['USERCODE'];
                                      // Filter by selected venue if specified
                                      if (!empty($selected_venue)) {
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_venuelists WHERE USERCODE='$usercode' AND AVAILABILITY='0' AND CATEGORYCODE='$selected_venue' ORDER BY VENUEID ASC");
                                      } else {
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_venuelists WHERE USERCODE='$usercode' AND AVAILABILITY='0' ORDER BY VENUEID ASC");
                                      }
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
                                            <td class="text-center">
                                              <input type="hidden" class="deletescheduleid" value="<?php echo $info['VENUEID']; ?>">

                                              <a href="javascript:void(0)" style="text-decoration: none;" class="deletevenueschedule">
                                                  <button class="btn btn-danger btn-rounded btn-icon" type="submit" name="deletevenueschedule" style="width: 26px; height: 26px;">
                                                      <i class="mdi mdi-delete"></i>
                                                  </button>
                                              </a>
                                            </td>
                                          </tr>
                                          <?php
                                        }
                                      }
                                      else{
                                        ?>
                                        <tr>
                                          <td colspan="6">
                                            <br><br>
                                            <div class="col-12 text-center">
                                              <?php if (!empty($selected_venue)): ?>
                                                <p class="text-warning" style='font-size: 15px;'>No dates selected for <strong><?php echo CATEGORYNAME($selected_venue); ?></strong>!</p>
                                                <p class="text-muted" style='font-size: 14px;'>Please go back to select dates for this venue first.</p>
                                                <a href="index.php?page=home&a=userappointmentdate&venue=<?php echo $selected_venue; ?>" class="btn btn-primary btn-sm">
                                                  <i class="mdi mdi-calendar"></i> Select Dates
                                                </a>
                                              <?php else: ?>
                                                <p class="text-dark" style='font-size: 15px;'>There was no schedule!</p>
                                              <?php endif; ?>
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
                              </div>
                            <?php
                          }
                        ?>
                        
                      </div><br><br>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Attach File <span class="text-danger">*</span><br><small style="font-style: italic; font-size: 10px;">( Request Slip Form )</small></label>
                            <div class="col-sm-10">
                              <div class="mb-2" style="font-size: 12px;">
                                <a href="index.php?page=forms&a=userforms" class="text-primary" style="text-decoration: underline;">Download this form before booking</a>
                              </div>
                              <input type="file" class="form-control" name="files[]" accept="image/*,application/pdf" multiple />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Purpose <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                              <textarea name="remarks" style="line-height: 1.6em;" class="form-control" rows="3"><?php if (isset($_POST['remarks'])){ echo $_POST['remarks']; } ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <br><p class="card-description" style="display: none;"> Personal Information </p>
                      <div class="row" style="display: none;">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Last Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="last" maxlength="60" value="<?php if (isset($_POST['last'])){ echo $_POST['last']; }else{ echo USERLASTNAME($_SESSION['USERCODE']); } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Contact <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="contact" maxlength="11" value="<?php if (isset($_POST['contact'])){ echo $_POST['contact']; }else{ echo USERCONTACT($_SESSION['USERCODE']); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row" style="display: none;">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">First Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="first" maxlength="60" value="<?php if (isset($_POST['first'])){ echo $_POST['first']; }else{ echo USERFIRSTNAME($_SESSION['USERCODE']); } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="email" maxlength="100" value="<?php if (isset($_POST['email'])){ echo $_POST['email']; }else{ echo USEREMAIL($_SESSION['USERCODE']); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row" style="display: none;">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Middle Name</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="middle" maxlength="100" value="<?php if (isset($_POST['middle'])){ echo $_POST['middle']; }else{ echo USERMIDDLENAME($_SESSION['USERCODE']); } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="address" maxlength="200" value="<?php if (isset($_POST['address'])){ echo $_POST['address']; }else{ echo USERADDRESS($_SESSION['USERCODE']); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row" style="display: none;">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Department <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="department" maxlength="100" value="<?php if (isset($_POST['department'])){ echo $_POST['department']; }else{ echo USERDEPARTMENTNAME($_SESSION['USERCODE']); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

                      <br>

                      <p class="text-center">
                        <input type="hidden" class="form-control" name="usercode" value="<?php if (isset($_SESSION['USERCODE'])){ echo $_SESSION['USERCODE']; } ?>" />
                        <?php if (!empty($selected_venue)): ?>
                          <input type="hidden" name="selected_venue" value="<?php echo $selected_venue; ?>" />
                        <?php endif; ?>
                        <button type="submit" name="saveappointment" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Save</button>
                        <a href="index.php?page=home&a=userdashboard" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            