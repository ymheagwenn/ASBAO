        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">

              <?php
                if (isset($_POST['updateappointment'])){

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
                          <p class="text-danger" style='font-size: 15px;'>Please input a purpose!</p>
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
                      
                      $sql = "UPDATE tbl_appointment SET LASTNAME='$last', FIRSTNAME='$first', MIDDLENAME='$middle', CONTACT='$contact', EMAIL='$email', ADDRESS='$address', REMARKS='$remarks' WHERE CONTROLCODE = '$controlcode'";
                      if (!mysqli_query($conn,$sql)) {
                          die('Error:'.mysqli_error($conn));
                      }

                      ?>
                          <script type="text/javascript">
                            Swal.fire(
                              'Saved!',
                              'Appointment updated successfully!',
                              'success'
                            ).then((result) => {
                              window.location = "index.php?page=appointment&a=userappointment";
                            });
                          </script>
                      <?php
                    }
                }
              ?>

              <!-- Important Notice for Booking -->
              <div class="col-12 mb-4">
                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: #fff3cd; border-color: #ffeaa7; border-radius: 8px;">
                  <div class="d-flex align-items-center">
                    <i class="mdi mdi-information-outline me-3" style="font-size: 24px; color: #856404; flex-shrink: 0;"></i>
                    <div class="flex-grow-1">
                      <h6 class="alert-heading mb-1" style="color: #856404; font-weight: bold;">Important Notice</h6>
                      <p class="mb-0" style="color: #856404;">
                        <strong>When updating your appointment:</strong> Please ensure you have the required forms ready. 
                        You must submit the following requirements three (3) days before the scheduled event:
                      </p>
                      <ul class="mb-0 mt-2" style="color: #856404;">
                        <li>Duly filled out IRS FORM</li>
                        <li>Supporting documents</li>
                      </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="flex-shrink: 0;"></button>
                  </div>
                </div>
              </div>

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Appointment Details</h4>

                    <form class="forms-sample" action="index.php?page=appointment&a=userappointmentedit&appointmentcode=<?php echo $_GET['appointmentcode']; ?>" method="POST" enctype="multipart/form-data">
                      
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
                                      <th width="15%" class="text-center"> Date </th>
                                      <th width="15%" class="text-center"> Time </th>
                                      <th width="15%" class="text-center"> Purpose </th>
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
                                              <?php echo date('g:ia', strtotime($info['VENUETIMEIN']))." - ".date('g:ia', strtotime($info['VENUETIMEOUT'])); ?>
                                            </td>
                                            <td class="text-center">
                                              <?php echo $info['VENUEREMARKS']; ?>
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
                            <label class="col-sm-2 col-form-label">Purpose <span class="text-danger">*</span></label>
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

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

                      <br>

                      <p class="text-center">
                        <input type="hidden" class="form-control" name="controlcode" value="<?php if (isset($_GET['appointmentcode'])){ echo $_GET['appointmentcode']; } ?>" />
                        <button type="submit" name="updateappointment" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Save</button>
                        <a href="index.php?page=appointment&a=userappointment" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>