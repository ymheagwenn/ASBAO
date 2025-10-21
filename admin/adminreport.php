        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-printer"></i>
                </span> Reports
              </h3>
            </div>
            
            <div class="row">  
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="index.php?page=report&a=adminreport" method="POST">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group row">
                            <div class="col-sm-12">
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

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">From</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control" name="start" value="<?php if (isset($_POST['start'])){ echo $_POST['start']; } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">To</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" name="end" value="<?php if (isset($_POST['end'])){ echo $_POST['end']; } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-1">
                          <button type="submit" class="btn btn-success btn-md" name="fetch">Submit</button>
                        </div>
                      </div><br>
                    </form>
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dtInventory" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th width="5%" class="text-center"> # </th>
                            <th width="12%" class="text-center"> Reservation Date</th>
                            <th width="18%" class="text-center"> Name (Contact)</th>
                            <th width="12%" class="text-center"> Department</th>
                            <th width="12%" class="text-center"> Venue</th>
                            <th width="10%" class="text-center"> Time</th>
                            <th width="12%" class="text-center"> Activity Date</th>
                            <th width="14%" class="text-left"> Purpose </th>
                            <th width="8%" class="text-center"> Status </th>
                            <th width="8%" class="text-center"> Actions </th>
                            <th width="15%" class="text-center"> Feedback </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $count = 1;
                            
                            if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['department'])) {
                              $department = trim($_POST['department']);
                              $start = trim($_POST['start']);
                              $end = trim($_POST['end']);

                              date_default_timezone_set('Asia/Manila');
                              $startformat = date('Y-m-d', strtotime($start));
                              $endformat = date('Y-m-d', strtotime($end));

                              // Create a snapshot run entry for this generated report
                              $report_name = 'Appointments - '.mysqli_real_escape_string($conn, $department).' ('.mysqli_real_escape_string($conn, $startformat).' to '.mysqli_real_escape_string($conn, $endformat).')';
                              $generated_by = isset($_SESSION['FIRSTNAME']) ? $_SESSION['FIRSTNAME'] : 'system';
                              mysqli_query($conn, "INSERT INTO report_runs (name, department, start_date, end_date, generated_by) VALUES ('{$report_name}', '".mysqli_real_escape_string($conn, $department)."', '".mysqli_real_escape_string($conn, $startformat)."', '".mysqli_real_escape_string($conn, $endformat)."', '".mysqli_real_escape_string($conn, $generated_by)."')");
                              $run_id = mysqli_insert_id($conn);

                              $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE DEPARTMENT = '".mysqli_real_escape_string($conn, $department)."' AND DATE(DATEON) >= DATE('".$startformat."') AND DATE(DATEON) <= DATE('".$endformat."') GROUP BY tbl_appointment.CONTROLCODE ORDER BY tbl_appointment.ID ASC LIMIT 50");
                              if (mysqli_num_rows($sql) > 0) {
                                while ($info = mysqli_fetch_array($sql)){
                                  // Insert each row into report_entries snapshot for this run
                                  if (!empty($run_id)) {
                                    $controlcode = $info['CONTROLCODE'];
                                    $reservation_date = date('Y-m-d', strtotime($info['DATEON']));
                                    $last_name = mysqli_real_escape_string($conn, $info['LASTNAME']);
                                    $first_name = mysqli_real_escape_string($conn, $info['FIRSTNAME']);
                                    $contact = mysqli_real_escape_string($conn, $info['CONTACT']);
                                    $email = mysqli_real_escape_string($conn, $info['EMAIL']);
                                    $address = mysqli_real_escape_string($conn, $info['ADDRESS']);
                                    $dept = mysqli_real_escape_string($conn, $info['DEPARTMENT']);
                                    $venue = mysqli_real_escape_string($conn, $info['CATEGORYNAME']);
                                    $time_display = isset($info['VENUETIME']) ? mysqli_real_escape_string($conn, $info['VENUETIME']) : '';
                                    $activity_date = isset($info['VENUEDATE']) ? date('Y-m-d', strtotime($info['VENUEDATE'])) : null;
                                    $purpose = mysqli_real_escape_string($conn, $info['REMARKS']);
                                    $status = mysqli_real_escape_string($conn, $info['STATUS']);

                                    $latest_feedback = mysqli_query($conn, "SELECT qf.rating FROM question_feedback qf WHERE qf.appointid='".mysqli_real_escape_string($conn, $controlcode)."' ORDER BY qf.id DESC LIMIT 1");
                                    $feedback_rating = null;
                                    if (mysqli_num_rows($latest_feedback) > 0) {
                                      $lf = mysqli_fetch_array($latest_feedback);
                                      $feedback_rating = intval($lf['rating']);
                                    }

                                    $columns = "run_id, controlcode, reservation_date, last_name, first_name, contact, email, address, department, venue, time_display, activity_date, purpose, status, feedback_rating";
                                    $values = "{$run_id}, '".mysqli_real_escape_string($conn, $controlcode)."', '".$reservation_date."', '{$last_name}', '{$first_name}', '{$contact}', '{$email}', '{$address}', '{$dept}', '{$venue}', '{$time_display}', ".($activity_date ? "'{$activity_date}'" : "NULL").", '{$purpose}', '{$status}', ".(is_null($feedback_rating) ? "NULL" : $feedback_rating);
                                    mysqli_query($conn, "INSERT INTO report_entries ($columns) VALUES ($values)");
                                  }
                                  ?>
                                  <tr>
                                    <td class="text-center"><?php echo $count++;  ?></td>
                                    <td class="text-center"><?php echo date('M d, Y', strtotime($info['DATEON'])); ?></td>
                                    <td class="text-left">
                                      <b><?php echo $info['LASTNAME'] .", ". $info['FIRSTNAME']; ?></b>
                                      <br><small>Contact: <?php echo $info['CONTACT']; ?></small>
                                      <?php if (!empty($info['EMAIL'])) { ?>
                                        <br><small>Email: <?php echo $info['EMAIL']; ?></small>
                                      <?php } ?>
                                      <?php if (!empty($info['ADDRESS'])) { ?>
                                        <br><small>Address: <?php echo $info['ADDRESS']; ?></small>
                                      <?php } ?>
                                    </td>
                                    <td class="text-center"><?php echo $info['DEPARTMENT']; ?></td>
                                    <td class="text-center"><?php echo $info['CATEGORYNAME']; ?></td>
                                    <td class="text-center"><?php echo isset($info['VENUETIME']) ? $info['VENUETIME'] : ''; ?></td>
                                    <td class="text-center"><?php echo isset($info['VENUEDATE']) ? date('M d, Y', strtotime($info['VENUEDATE'])) : ''; ?></td>
                                    <td style="text-align: left;"><p title="<?php echo htmlspecialchars($info['REMARKS']); ?>" style="height: 6em; line-height: 1.5em;white-space: normal; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;"><?php echo $info['REMARKS']; ?></p></td>
                                    <td class="text-center">
                                      <?php
                                          if ($info['STATUS'] == 'PENDING') {
                                            ?>
                                              <label class="badge badge-dark"><?php echo $info['STATUS']; ?></label>
                                            <?php
                                          }
                                          elseif ($info['STATUS'] == 'ACCEPTED') {
                                            ?>
                                              <label class="badge badge-warning"><?php echo $info['STATUS']; ?></label>
                                            <?php
                                          }
                                          elseif ($info['STATUS'] == 'COMPLETED') {
                                            ?>
                                              <label class="badge badge-success"><?php echo $info['STATUS']; ?></label>
                                            <?php
                                          }
                                          elseif ($info['STATUS'] == 'CANCELLED') {
                                            ?>
                                              <label class="badge badge-danger"><?php echo $info['STATUS']; ?></label>
                                            <?php
                                          }
                                      ?>
                                    </td>
                                    <td class="text-center">

                                      <button class="btn btn-success btn-rounded btn-icon" data-bs-toggle="modal" data-bs-target="#modItem<?php echo $info['ID']; ?>" style="width: 26px; height: 26px;">
                                        <i class="mdi mdi-eye"></i>
                                      </button>

                                      <div class="modal fade" id="modItem<?php echo $info['ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content" style="background-color: #ffffff;">
                                            <div class="modal-header">
                                              <p class="modal-title" id="exampleModalLabel">View Appointment Details</p>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details<?php echo $info['ID']; ?>" type="button" role="tab" aria-controls="details" aria-selected="true">Client Info</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link" id="venue-tab" data-bs-toggle="tab" data-bs-target="#venue<?php echo $info['ID']; ?>" type="button" role="tab" aria-controls="venue" aria-selected="false">Venue & Schedule</button>
                                                </li>
                                              </ul>

                                              <br><br>

                                              <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="details<?php echo $info['ID']; ?>" role="tabpanel" aria-labelledby="details-tab">
                                                  <div class="row">
                                                    <div class="col-md-12">
                                                      <table class="table table-bordered">
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Full Name</td>
                                                          <td width="70%" style="text-align: left;"><b><?php echo $info['LASTNAME'] .", ". $info['FIRSTNAME']. " ".$info['MIDDLENAME']; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Contact</td>
                                                          <td width="70%" style="text-align: left;"><b><?php echo $info['CONTACT']; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Email Address</td>
                                                          <td width="70%" style="text-align: left;"><b><?php echo $info['EMAIL']; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Address</td>
                                                          <td width="70%" style="text-align: left;"><b style="height: 1.5em; line-height: 1.5em;white-space: normal; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;"><?php echo $info['ADDRESS']; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Status</td>
                                                          <td width="70%" style="text-align: left;">
                                                            <b>
                                                              <?php
                                                                if ($info['STATUS'] == 'PENDING') {
                                                                  ?>
                                                                    <label class="badge badge-dark"><?php echo $info['STATUS']; ?></label>
                                                                  <?php
                                                                }
                                                                elseif ($info['STATUS'] == 'ACCEPTED') {
                                                                  ?>
                                                                    <label class="badge badge-warning"><?php echo $info['STATUS']; ?></label>
                                                                  <?php
                                                                }
                                                                elseif ($info['STATUS'] == 'COMPLETED') {
                                                                  ?>
                                                                    <label class="badge badge-success"><?php echo $info['STATUS']; ?></label>
                                                                  <?php
                                                                }
                                                                elseif ($info['STATUS'] == 'CANCELLED') {
                                                                  ?>
                                                                    <label class="badge badge-danger"><?php echo $info['STATUS']; ?></label>
                                                                  <?php
                                                                }
                                                            ?>
                                                            </b>
                                                          </td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Appointment Type</td>
                                                          <td width="70%" style="text-align: left;"><b><?php echo $info['TYPE']; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Published on</td>
                                                          <td width="70%" style="text-align: left;"><b><?php echo date('M d, Y  g:i a', strtotime($info['DATEON'])); ?></b></td>
                                                        </tr>
                                                      </table>

                                                      <?php if (!empty($info['FORMS'])) { ?>
                                                        <br>
                                                        <p class="text-secondary" style="text-align: left;">Attachments</p>
                                                        <div>
                                                          <?php
                                                            $attachments = explode('|', $info['FORMS']);
                                                            foreach ($attachments as $att) {
                                                              $isPdf = (strtolower(pathinfo($att, PATHINFO_EXTENSION)) === 'pdf');
                                                              if ($isPdf) {
                                                                echo '<div style="margin-bottom:8px;"><a class="btn btn-sm btn-outline-primary" target="_blank" href="'. $att .'">View PDF</a></div>';
                                                              } else {
                                                                echo '<div style="margin-bottom:8px;"><a class="btn btn-sm btn-outline-primary" target="_blank" href="'. $att .'">View Image</a><br><img src="'. $att .'" alt="attachment" style="max-width: 200px; height: auto; margin-top:6px; border:1px solid #eee;"/></div>';
                                                              }
                                                            }
                                                          ?>
                                                        </div>
                                                      <?php } ?>
                                                    </div>

                                                  </div>
                                                </div>
                                                <div class="tab-pane fade" id="venue<?php echo $info['ID']; ?>" role="tabpanel" aria-labelledby="venue-tab">
                                                  <div class="row">
                                                    <div class="col-md-12">

                                                      <b style="height: 3em; line-height: 1.5em;white-space: normal; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"><?php echo $info['REMARKS']; ?></b><br>

                                                      <table class="table table-bordered">
                                                        <thead>
                                                          <tr>
                                                            <th width="5%" class="text-right"> <b>#</b> </th>
                                                            <th width="30%" class="text-center"> <b>Venue</b> </th>
                                                            <th width="20%" class="text-center"> <b>Date</b> </th>
                                                            <th width="15%" class="text-center"> <b>Time</b> </th>
                                                          </tr>
                                                        </thead>

                                                        <tbody>
                                                      <?php
                                                        $cter = 0;
                                                        $controlcode = $info['CONTROLCODE'];
                                                        $sqlven = mysqli_query($conn,"SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_appointment.CONTROLCODE = '$controlcode' ORDER BY tbl_appointment.ID ASC LIMIT 10");
                                                        if (mysqli_num_rows($sqlven) > 0) {
                                                          while ($infoven = mysqli_fetch_array($sqlven)){
                                                            $cter = $cter + 1;
                                                            ?>  
                                                              <tr>
                                                                <td class="text-left"><?php echo $cter; ?></td>
                                                                <td class="text-left"><?php echo $infoven['CATEGORYNAME']; ?></td>
                                                                <td class="text-left"><?php echo date('M d, Y', strtotime($infoven['VENUEDATE'])); ?></td>
                                                                <td class="text-left"><?php echo $infoven['VENUETIME']; ?></td>
                                                              </tr>

                                                            <?php
                                                          }
                                                        }
                                                      ?>
                                                        </tbody>
                                                      </table>
                                                    </div>

                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <!--
                                      <a href="index.php?page=appointment&a=adminappointmentedit&appointmentcode=<?php //echo $info['CONTROLCODE']; ?>" style="text-decoration: none;">
                                        <button class="btn btn-gradient-warning btn-rounded btn-icon" style="width: 26px; height: 26px;">
                                          <i class="mdi mdi-pencil"></i>
                                        </button>
                                      </a> -->
                                    </td>
                                    <td class="text-center">
                                      <?php
                                        // Fetch latest feedback rating for this control code if exists
                                        $latest_feedback = mysqli_query($conn, "SELECT qf.rating FROM question_feedback qf WHERE qf.appointid='".$info['CONTROLCODE']."' ORDER BY qf.id DESC LIMIT 1");
                                        if (mysqli_num_rows($latest_feedback) > 0) {
                                          $lf = mysqli_fetch_array($latest_feedback);
                                          echo '<span class="badge badge-info">Rating: '.intval($lf['rating']).'</span>';
                                        } else {
                                          echo '<span class="text-muted">No feedback</span>';
                                        }
                                      ?>
                                    </td>
                                  </tr>
                                  <?php
                                }
                              }
                              else{
                                ?>
                                <tr>
                                  <td colspan="11">
                                    <br><br><br><br>
                                    <div class="col-12 text-center">
                                      <p class="text-dark" style='font-size: 15px;'>There was no appointment records!</p>
                                    </div>
                                    <br><br><br>
                                  </td>
                                </tr>
                                <?php
                              }
                            }
                            else{
                              $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE GROUP BY tbl_appointment.CONTROLCODE ORDER BY tbl_appointment.ID ASC LIMIT 50");
                              if (mysqli_num_rows($sql) > 0) {
                                while ($info = mysqli_fetch_array($sql)){
                                  ?>
                                  <tr>
                                    <td class="text-center"><?php echo $count++;  ?></td>
                                    <td class="text-center"><?php echo date('M d, Y', strtotime($info['DATEON'])); ?></td>
                                    <td class="text-left">
                                      <b><?php echo $info['LASTNAME'] .", ". $info['FIRSTNAME']; ?></b>
                                      <br><small>Contact: <?php echo $info['CONTACT']; ?></small>
                                      <?php if (!empty($info['EMAIL'])) { ?>
                                        <br><small>Email: <?php echo $info['EMAIL']; ?></small>
                                      <?php } ?>
                                      <?php if (!empty($info['ADDRESS'])) { ?>
                                        <br><small>Address: <?php echo $info['ADDRESS']; ?></small>
                                      <?php } ?>
                                    </td>
                                    <td class="text-center"><?php echo $info['DEPARTMENT']; ?></td>
                                    <td class="text-center"><?php echo $info['CATEGORYNAME']; ?></td>
                                    <td class="text-center"><?php echo isset($info['VENUETIME']) ? $info['VENUETIME'] : ''; ?></td>
                                    <td class="text-center"><?php echo isset($info['VENUEDATE']) ? date('M d, Y', strtotime($info['VENUEDATE'])) : ''; ?></td>
                                    <td style="text-align: left;"><p title="<?php echo htmlspecialchars($info['REMARKS']); ?>" style="height: 6em; line-height: 1.5em;white-space: normal; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;"><?php echo $info['REMARKS']; ?></p></td>
                                    <td class="text-center">
                                      <?php
                                          if ($info['STATUS'] == 'PENDING') {
                                            ?>
                                              <label class="badge badge-dark"><?php echo $info['STATUS']; ?></label>
                                            <?php
                                          }
                                          elseif ($info['STATUS'] == 'ACCEPTED') {
                                            ?>
                                              <label class="badge badge-warning"><?php echo $info['STATUS']; ?></label>
                                            <?php
                                          }
                                          elseif ($info['STATUS'] == 'COMPLETED') {
                                            ?>
                                              <label class="badge badge-success"><?php echo $info['STATUS']; ?></label>
                                            <?php
                                          }
                                          elseif ($info['STATUS'] == 'CANCELLED') {
                                            ?>
                                              <label class="badge badge-danger"><?php echo $info['STATUS']; ?></label>
                                            <?php
                                          }
                                      ?>
                                    </td>
                                    <td class="text-center">

                                      <button class="btn btn-success btn-rounded btn-icon" data-bs-toggle="modal" data-bs-target="#modItem<?php echo $info['ID']; ?>" style="width: 26px; height: 26px;">
                                        <i class="mdi mdi-eye"></i>
                                      </button>

                                      <div class="modal fade" id="modItem<?php echo $info['ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content" style="background-color: #ffffff;">
                                            <div class="modal-header">
                                              <p class="modal-title" id="exampleModalLabel">View Appointment Details</p>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details<?php echo $info['ID']; ?>" type="button" role="tab" aria-controls="details" aria-selected="true">Client Info</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link" id="venue-tab" data-bs-toggle="tab" data-bs-target="#venue<?php echo $info['ID']; ?>" type="button" role="tab" aria-controls="venue" aria-selected="false">Venue & Schedule</button>
                                                </li>
                                              </ul>

                                              <br><br>

                                              <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="details<?php echo $info['ID']; ?>" role="tabpanel" aria-labelledby="details-tab">
                                                  <div class="row">
                                                    <div class="col-md-12">
                                                      <table class="table table-bordered">
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Full Name</td>
                                                          <td width="70%" style="text-align: left;"><b><?php echo $info['LASTNAME'] .", ". $info['FIRSTNAME']. " ".$info['MIDDLENAME']; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Contact</td>
                                                          <td width="70%" style="text-align: left;"><b><?php echo $info['CONTACT']; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Email Address</td>
                                                          <td width="70%" style="text-align: left;"><b><?php echo $info['EMAIL']; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Address</td>
                                                          <td width="70%" style="text-align: left;"><b style="height: 1.5em; line-height: 1.5em;white-space: normal; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;"><?php echo $info['ADDRESS']; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Status</td>
                                                          <td width="70%" style="text-align: left;">
                                                            <b>
                                                              <?php
                                                                if ($info['STATUS'] == 'PENDING') {
                                                                  ?>
                                                                    <label class="badge badge-dark"><?php echo $info['STATUS']; ?></label>
                                                                  <?php
                                                                }
                                                                elseif ($info['STATUS'] == 'ACCEPTED') {
                                                                  ?>
                                                                    <label class="badge badge-warning"><?php echo $info['STATUS']; ?></label>
                                                                  <?php
                                                                }
                                                                elseif ($info['STATUS'] == 'COMPLETED') {
                                                                  ?>
                                                                    <label class="badge badge-success"><?php echo $info['STATUS']; ?></label>
                                                                  <?php
                                                                }
                                                                elseif ($info['STATUS'] == 'CANCELLED') {
                                                                  ?>
                                                                    <label class="badge badge-danger"><?php echo $info['STATUS']; ?></label>
                                                                  <?php
                                                                }
                                                            ?>
                                                            </b>
                                                          </td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Appointment Type</td>
                                                          <td width="70%" style="text-align: left;"><b><?php echo $info['TYPE']; ?></b></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="30%" class="text-secondary" style="text-align: right;">Published on</td>
                                                          <td width="70%" style="text-align: left;"><b><?php echo date('M d, Y  g:i a', strtotime($info['DATEON'])); ?></b></td>
                                                        </tr>
                                                      </table>
                                                    </div>

                                                  </div>
                                                </div>
                                                <div class="tab-pane fade" id="venue<?php echo $info['ID']; ?>" role="tabpanel" aria-labelledby="venue-tab">
                                                  <div class="row">
                                                    <div class="col-md-12">

                                                      <b style="height: 3em; line-height: 1.5em;white-space: normal; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"><?php echo $info['REMARKS']; ?></b><br>

                                                      <table class="table table-bordered">
                                                        <thead>
                                                          <tr>
                                                            <th width="5%" class="text-right"> <b>#</b> </th>
                                                            <th width="30%" class="text-center"> <b>Venue</b> </th>
                                                            <th width="20%" class="text-center"> <b>Date</b> </th>
                                                            <th width="15%" class="text-center"> <b>Time</b> </th>
                                                          </tr>
                                                        </thead>

                                                        <tbody>
                                                      <?php
                                                        $cter = 0;
                                                        $controlcode = $info['CONTROLCODE'];
                                                        $sqlven = mysqli_query($conn,"SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_appointment.CONTROLCODE = '$controlcode' ORDER BY tbl_appointment.ID ASC LIMIT 10");
                                                        if (mysqli_num_rows($sqlven) > 0) {
                                                          while ($infoven = mysqli_fetch_array($sqlven)){
                                                            $cter = $cter + 1;
                                                            ?>  
                                                              <tr>
                                                                <td class="text-left"><?php echo $cter; ?></td>
                                                                <td class="text-left"><?php echo $infoven['CATEGORYNAME']; ?></td>
                                                                <td class="text-left"><?php echo date('M d, Y', strtotime($infoven['VENUEDATE'])); ?></td>
                                                                <td class="text-left"><?php echo $infoven['VENUETIME']; ?></td>
                                                              </tr>

                                                            <?php
                                                          }
                                                        }
                                                      ?>
                                                        </tbody>
                                                      </table>
                                                    </div>

                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <!--
                                      <a href="index.php?page=appointment&a=adminappointmentedit&appointmentcode=<?php //echo $info['CONTROLCODE']; ?>" style="text-decoration: none;">
                                        <button class="btn btn-gradient-warning btn-rounded btn-icon" style="width: 26px; height: 26px;">
                                          <i class="mdi mdi-pencil"></i>
                                        </button>
                                      </a> -->
                                    </td>
                                    <td class="text-center">
                                      <?php
                                        $latest_feedback = mysqli_query($conn, "SELECT qf.rating FROM question_feedback qf WHERE qf.appointid='".$info['CONTROLCODE']."' ORDER BY qf.id DESC LIMIT 1");
                                        if (mysqli_num_rows($latest_feedback) > 0) {
                                          $lf = mysqli_fetch_array($latest_feedback);
                                          echo '<span class="badge badge-info">Rating: '.intval($lf['rating']).'</span>';
                                        } else {
                                          echo '<span class="text-muted">No feedback</span>';
                                        }
                                      ?>
                                    </td>
                                  </tr>
                                  <?php
                                }
                              }
                              else{
                                ?>
                                <tr>
                                  <td colspan="11">
                                    <br><br><br><br>
                                    <div class="col-12 text-center">
                                      <p class="text-dark" style='font-size: 15px;'>There was no appointment records!</p>
                                    </div>
                                    <br><br><br>
                                  </td>
                                </tr>
                                <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
            
        <style>
          /* Sticky header for report table */
          #dtInventory thead th {
            position: sticky;
            top: 0;
            background: #ffffff;
            z-index: 2;
          }
        </style>