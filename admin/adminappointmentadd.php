        <style>
          /* Mobile optimizations for Admin Create Appointment */
          @media (max-width: 768px) {
            .forms-sample .form-group .col-sm-2,
            .forms-sample .form-group .col-sm-10,
            .forms-sample .form-group .col-sm-4,
            .forms-sample .form-group .col-sm-8 {
              width: 100% !important;
              max-width: 100% !important;
              flex: 0 0 100% !important;
            }
            .forms-sample .form-group .col-sm-2,
            .forms-sample .form-group .col-sm-4 {
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
                    elseif (!isset($_POST['department'])){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please select a department!</p>
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
                      $type = "Walk-in";
                      $status = "ACCEPTED";

                      $qrcode = "qrcodes/";
                      $qrname = trim(strtolower($last)) ."-".trim(strtolower($first));
                      $qrimage = $controlcode.'.png';
                      $pathqrcode = $qrcode.$qrimage;
                      $urlqrcode = $qrcode.$qrimage;

                      date_default_timezone_set('Asia/Manila');
                      $dateon = date('Y-m-d g:i a');

                      $desired_dir = "uploads/clients/";
                      foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                        $file_name = $usercode."-".strtolower($_FILES['files']['name' ][$key]);
                        $size =$_FILES['files']['size'][$key];
                        $file_f = $size / 1024;
                        $file_size =round($file_f);
                        $file_tmp =$_FILES['files']['tmp_name'][$key];
                        $file_type=$_FILES['files']['type'][$key];
                        $path="uploads/clients/$file_name";

                        if (empty($_FILES['files']['name' ][$key]) || $_FILES['files']['name' ][$key] = ''){
                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Attach File is missing! Please try again!</p>
                            </div>
                          <?php
                        }
                        else{
                          if (!file_exists($pathqrcode)) {
                            QRcode::png($controlcode, $pathqrcode);

                              $sql = "INSERT INTO tbl_appointment(CONTROLCODE, LASTNAME, FIRSTNAME, MIDDLENAME, CONTACT, DEPARTMENT, EMAIL, ADDRESS, REMARKS, QRCODE, FORMS, TYPE, FEEDBACK, STATUS, DATEON) VALUES('$controlcode','$last','$first','$middle','$contact','$department','$email','$address','$remarks','$urlqrcode','$path','$type','NOT RATED','$status','$dateon')";
                              if (!mysqli_query($conn,$sql)) {
                                die('Error:'.mysqli_error($conn));
                              }

                              move_uploaded_file($file_tmp,"$desired_dir".$file_name);

                              $sqlvr = mysqli_query($conn, "SELECT * FROM tbl_venuelists WHERE USERCODE ='$usercode' AND AVAILABILITY='0'");
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
                                    window.location = "index.php?page=appointment&a=adminappointment";
                                  });
                                </script>
                              <?php
                          }
                          else{
                              ?>
                                <div class="row text-center">
                                  <p class="text-danger" style='font-size: 15px;'>QR code already generated! Please try again!</p>
                                </div>
                              <?php
                          }
                        }
                      }
                    }
                  }
              ?>

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create Appointment</h4>

                    <form class="forms-sample" action="index.php?page=appointment&a=adminappointmentadd" method="POST" enctype="multipart/form-data">
                      
                      <br><p class="card-description"> Booking Information </p>
                      <div class="row">
                        <?php
                        $usercode = $_SESSION['USERCODE'];
                          if (VENUELISTSCHECK($usercode) > 0) {
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
                                      $sql = mysqli_query($conn,"SELECT * FROM tbl_venuelists WHERE USERCODE='$usercode' AND AVAILABILITY='0' ORDER BY VENUEID ASC");
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
                              <input type="file" class="form-control" name="files[]" accept="image/*; pdf/*" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Remarks <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                              <textarea name="remarks" style="line-height: 1.6em;" class="form-control" rows="3"><?php if (isset($_POST['remarks'])){ echo $_POST['remarks']; } ?></textarea>
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
                              <input type="text" class="form-control" name="last" maxlength="60" value="<?php if (isset($_POST['last'])){ echo $_POST['last']; } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Contact <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="contact" maxlength="11" value="<?php if (isset($_POST['contact'])){ echo $_POST['contact']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

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
                            <label class="col-sm-4 col-form-label">Email Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="email" maxlength="100" value="<?php if (isset($_POST['email'])){ echo $_POST['email']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Middle Name</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="middle" maxlength="100" value="<?php if (isset($_POST['middle'])){ echo $_POST['middle']; } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Address <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="address" maxlength="200" value="<?php if (isset($_POST['address'])){ echo $_POST['address']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Department</label>
                            <div class="col-sm-8">
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

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

                      <br>

                      <p class="text-center">
                        <input type="hidden" class="form-control" name="usercode" value="<?php if (isset($_SESSION['USERCODE'])){ echo $_SESSION['USERCODE']; } ?>" />
                        <button type="submit" name="saveappointment" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Save</button>
                        <a href="index.php?page=appointment&a=adminappointment" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>