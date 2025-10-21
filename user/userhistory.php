        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-history"></i>
                </span> History
              </h3>
            </div>

            
            <div class="row">  
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="dtInventory" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th width="5%" class="text-center"> # </th>
                            <th width="10%" class="text-center"> QR Code </th>
                            <th width="12%" class="text-center"> Venue </th>
                            <th width="25%"> Details </th>
                            <th width="15%" class="text-left"> Purpose </th>
                            <th width="10%" class="text-center"> Status </th>
                            <th width="15%" class="text-center"> Action </th>
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
                              $usercode = $_SESSION['USERCODE'];

                              $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.USERCODE = '$usercode' AND DEPARTMENT = '$department' AND DATE(DATEON) >= DATE('".$startformat."') AND DATE(DATEON) <= DATE('".$endformat."') GROUP BY tbl_appointment.CONTROLCODE ORDER BY tbl_appointment.ID ASC LIMIT 50");
                              if (mysqli_num_rows($sql) > 0) {
                                while ($info = mysqli_fetch_array($sql)){
                                  ?>
                                  <tr>
                                    <td class="text-center"><?php echo $count++;  ?></td>
                                    <td class="text-center">
                                      <?php
                                        if ($info['STATUS'] == 'ACCEPTED' && !empty($info['QRCODE'])) {
                                          ?>
                                            <img src="<?php echo $info['QRCODE']; ?>" style="width: 50px; height: 50px;" alt="QR Code" />
                                          <?php
                                        }
                                        else {
                                          ?>
                                            <span class="text-muted">-</span>
                                          <?php
                                        }
                                      ?>
                                    </td>
                                    <td class="text-center">
                                      <?php
                                        if (!empty($info['CONTROLCODE'])) {
                                          ?>
                                            <small style="font-weight: bold; font-size: 13px;"><?php echo $info['CATEGORYNAME']; ?></small>
                                          <?php
                                        }
                                      ?>
                                    </td>
                                    <td>
                                      <div style="font-weight: bold; font-size: 14px; margin-bottom: 5px;">
                                        <?php echo $info['LASTNAME'] .", ". $info['FIRSTNAME']. " ".$info['MIDDLENAME']; ?>
                                      </div>
                                      
                                      <div style="font-size: 12px; color: #666;">
                                        <?php
                                          if (!empty($info['CONTACT'])) {
                                            ?>
                                              <div><strong>Contact:</strong> <?php echo $info['CONTACT']; ?></div>
                                            <?php
                                          }
                                          
                                          if (!empty($info['DEPARTMENT'])) {
                                            ?>
                                              <div><strong>Department:</strong> <?php echo $info['DEPARTMENT']; ?></div>
                                            <?php
                                          }

                                          if (!empty($info['EMAIL'])) {
                                            ?>
                                              <div><strong>Email:</strong> <?php echo $info['EMAIL']; ?></div>
                                            <?php
                                          }
                                        ?>
                                      </div>
                                    </td>
                                    <td style="text-align: left;">
                                      <p style="height: 6em; line-height: 1.5em;white-space: normal; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;"><?php echo $info['REMARKS']; ?></p>
                                    </td>
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
                                      <button class="btn btn-success btn-rounded btn-icon" data-bs-toggle="modal" data-bs-target="#modItem<?php echo $info['ID']; ?>" style="width: 26px; height: 26px;" title="View Details">
                                        <i class="mdi mdi-eye"></i>
                                      </button>
                                      
                                      <?php if ($info['STATUS'] == 'ACCEPTED') { ?>
                                        <a href="index.php?page=appointment&a=userappointmentreceipt&appointmentcode=<?php echo $info['ID']; ?>&controlcode=<?php echo $info['CONTROLCODE']; ?>" target="_blank" style="text-decoration: none;">
                                          <button class="btn btn-gradient-info btn-rounded btn-icon" style="width: 26px; height: 26px;" title="View Receipt">
                                            <i class="mdi mdi-receipt"></i>
                                          </button>
                                        </a>
                                      <?php } ?>

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
                                                  <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details<?php echo $info['ID']; ?>" type="button" role="tab" aria-controls="details" aria-selected="true">Submitted Forms</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link" id="venue-tab" data-bs-toggle="tab" data-bs-target="#venue<?php echo $info['ID']; ?>" type="button" role="tab" aria-controls="venue" aria-selected="false">Venue & Schedule</button>
                                                </li>
                                                <?php if ($info['STATUS'] == 'ACCEPTED' && !empty($info['QRCODE'])) { ?>
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link" id="qrcode-tab" data-bs-toggle="tab" data-bs-target="#qrcode<?php echo $info['ID']; ?>" type="button" role="tab" aria-controls="qrcode" aria-selected="false">QR Code</button>
                                                </li>
                                                <?php } ?>
                                              </ul>

                                              <br><br>

                                              <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="details<?php echo $info['ID']; ?>" role="tabpanel" aria-labelledby="details-tab">
                                                  <div class="row">
                                                    <div class="col-md-12">
                                                      <h5 class="mb-3">Submitted Documents</h5>
                                                      <?php
                                                        if (!empty($info['FORMS'])) {
                                                          $files = explode(',', $info['FORMS']);
                                                          $file_count = 0;
                                                          
                                                          foreach($files as $file_path) {
                                                            if (!empty(trim($file_path))) {
                                                              $file_count++;
                                                              $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
                                                              $file_name = basename($file_path);
                                                              
                                                              ?>
                                                              <div class="col-md-6 mb-3" style="display: inline-block; vertical-align: top;">
                                                                <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                                  <div class="card-header" style="background-color: #f8f9fa; padding: 10px;">
                                                                    <h6 class="mb-0" style="font-size: 14px; word-break: break-all;">
                                                                      <i class="mdi mdi-file-document"></i> <?php echo $file_name; ?>
                                                                    </h6>
                                                                  </div>
                                                                  <div class="card-body" style="padding: 15px; text-align: center;">
                                                                    <?php if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
                                                                      <img src="<?php echo $file_path; ?>" alt="Document Image" style="max-width: 100%; max-height: 200px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);" />
                                                                    <?php } else { ?>
                                                                      <div style="font-size: 48px; color: #dc3545; margin: 20px 0;">
                                                                        <i class="mdi mdi-file-pdf-box"></i>
                                                                      </div>
                                                                      <p class="text-muted">PDF Document</p>
                                                                    <?php } ?>
                                                                    <div class="mt-2">
                                                                      <a href="<?php echo $file_path; ?>" target="_blank" class="btn btn-sm btn-primary">
                                                                        <i class="mdi mdi-eye"></i> View
                                                                      </a>
                                                                      <a href="<?php echo $file_path; ?>" download class="btn btn-sm btn-success">
                                                                        <i class="mdi mdi-download"></i> Download
                                                                      </a>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <?php
                                                            }
                                                          }
                                                          
                                                          if ($file_count == 0) {
                                                            ?>
                                                            <div class="col-12 text-center">
                                                              <p class="text-muted">No documents submitted</p>
                                                            </div>
                                                            <?php
                                                          }
                                                        } else {
                                                          ?>
                                                          <div class="col-12 text-center">
                                                            <p class="text-muted">No documents submitted</p>
                                                          </div>
                                                          <?php
                                                        }
                                                      ?>
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
                                                <?php if ($info['STATUS'] == 'ACCEPTED' && !empty($info['QRCODE'])) { ?>
                                                <div class="tab-pane fade" id="qrcode<?php echo $info['ID']; ?>" role="tabpanel" aria-labelledby="qrcode-tab">
                                                  <div class="row">
                                                    <div class="col-md-12 text-center">
                                                      <h5 class="mb-3">Appointment QR Code</h5>
                                                      <div class="qr-code-container" style="border: 2px solid #ddd; padding: 20px; border-radius: 10px; background-color: #f9f9f9; display: inline-block;">
                                                        <img src="<?php echo $info['QRCODE']; ?>" style="width: 200px; height: 200px;" alt="QR Code" />
                                                      </div>
                                                      <p class="mt-3 text-muted">
                                                        <strong>Control Code:</strong> <?php echo $info['CONTROLCODE']; ?>
                                                      </p>
                                                      <p class="text-muted">
                                                        <small>Present this QR code at the venue for verification</small>
                                                      </p>
                                                    </div>
                                                  </div>
                                                </div>
                                                <?php } ?>
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
                                  </tr>
                                  <?php
                                }
                              }
                              else{
                                ?>
                                <tr>
                                  <td colspan="6">
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
                              $usercode = $_SESSION['USERCODE'];
                              $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.USERCODE = '$usercode' AND (tbl_appointment.STATUS='ACCEPTED' OR tbl_appointment.STATUS='APPROVED') GROUP BY tbl_appointment.CONTROLCODE ORDER BY tbl_appointment.ID ASC LIMIT 50");
                              if (mysqli_num_rows($sql) > 0) {
                                while ($info = mysqli_fetch_array($sql)){
                                  ?>
                                  <tr>
                                    <td class="text-center"><?php echo $count++;  ?></td>
                                    <td class="text-center">
                                      <?php
                                        if ($info['STATUS'] == 'ACCEPTED' && !empty($info['QRCODE'])) {
                                          ?>
                                            <img src="<?php echo $info['QRCODE']; ?>" style="width: 50px; height: 50px;" alt="QR Code" />
                                          <?php
                                        }
                                        else {
                                          ?>
                                            <span class="text-muted">-</span>
                                          <?php
                                        }
                                      ?>
                                    </td>
                                    <td class="text-center">
                                      <?php
                                        if (!empty($info['CONTROLCODE'])) {
                                          ?>
                                            <small style="font-weight: bold; font-size: 13px;"><?php echo $info['CATEGORYNAME']; ?></small>
                                          <?php
                                        }
                                      ?>
                                    </td>
                                    <td>
                                      <div style="font-weight: bold; font-size: 14px; margin-bottom: 5px;">
                                        <?php echo $info['LASTNAME'] .", ". $info['FIRSTNAME']. " ".$info['MIDDLENAME']; ?>
                                      </div>
                                      
                                      <div style="font-size: 12px; color: #666;">
                                        <?php
                                          if (!empty($info['CONTACT'])) {
                                            ?>
                                              <div><strong>Contact:</strong> <?php echo $info['CONTACT']; ?></div>
                                            <?php
                                          }
                                          
                                          if (!empty($info['DEPARTMENT'])) {
                                            ?>
                                              <div><strong>Department:</strong> <?php echo $info['DEPARTMENT']; ?></div>
                                            <?php
                                          }

                                          if (!empty($info['EMAIL'])) {
                                            ?>
                                              <div><strong>Email:</strong> <?php echo $info['EMAIL']; ?></div>
                                            <?php
                                          }
                                        ?>
                                      </div>
                                    </td>
                                    <td style="text-align: left;">
                                      <p style="height: 6em; line-height: 1.5em;white-space: normal; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;"><?php echo $info['REMARKS']; ?></p>
                                    </td>
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
                                      <button class="btn btn-success btn-rounded btn-icon" data-bs-toggle="modal" data-bs-target="#modItem<?php echo $info['ID']; ?>" style="width: 26px; height: 26px;" title="View Details">
                                        <i class="mdi mdi-eye"></i>
                                      </button>
                                      
                                      <?php if ($info['STATUS'] == 'ACCEPTED') { ?>
                                        <a href="index.php?page=appointment&a=userappointmentreceipt&appointmentcode=<?php echo $info['ID']; ?>&controlcode=<?php echo $info['CONTROLCODE']; ?>" target="_blank" style="text-decoration: none;">
                                          <button class="btn btn-gradient-info btn-rounded btn-icon" style="width: 26px; height: 26px;" title="View Receipt">
                                            <i class="mdi mdi-receipt"></i>
                                          </button>
                                        </a>
                                      <?php } ?>

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
                                                  <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details<?php echo $info['ID']; ?>" type="button" role="tab" aria-controls="details" aria-selected="true">Submitted Forms</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link" id="venue-tab" data-bs-toggle="tab" data-bs-target="#venue<?php echo $info['ID']; ?>" type="button" role="tab" aria-controls="venue" aria-selected="false">Venue & Schedule</button>
                                                </li>
                                                <?php if ($info['STATUS'] == 'ACCEPTED' && !empty($info['QRCODE'])) { ?>
                                                <li class="nav-item" role="presentation">
                                                  <button class="nav-link" id="qrcode-tab" data-bs-toggle="tab" data-bs-target="#qrcode<?php echo $info['ID']; ?>" type="button" role="tab" aria-controls="qrcode" aria-selected="false">QR Code</button>
                                                </li>
                                                <?php } ?>
                                              </ul>

                                              <br><br>

                                              <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="details<?php echo $info['ID']; ?>" role="tabpanel" aria-labelledby="details-tab">
                                                  <div class="row">
                                                    <div class="col-md-12">
                                                      <h5 class="mb-3">Submitted Documents</h5>
                                                      <?php
                                                        if (!empty($info['FORMS'])) {
                                                          $files = explode('|', $info['FORMS']);
                                                          $file_count = 0;
                                                          
                                                          foreach($files as $file_path) {
                                                            if (!empty(trim($file_path))) {
                                                              $file_count++;
                                                              $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
                                                              $file_name = basename($file_path);
                                                              
                                                              ?>
                                                              <div class="col-md-6 mb-3" style="display: inline-block; vertical-align: top;">
                                                                <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                                  <div class="card-header" style="background-color: #f8f9fa; padding: 10px;">
                                                                    <h6 class="mb-0" style="font-size: 14px; word-break: break-all;">
                                                                      <i class="mdi mdi-file-document"></i> <?php echo $file_name; ?>
                                                                    </h6>
                                                                  </div>
                                                                  <div class="card-body" style="padding: 15px; text-align: center;">
                                                                    <?php if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
                                                                      <img src="<?php echo $file_path; ?>" alt="Document Image" style="max-width: 100%; max-height: 200px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);" />
                                                                    <?php } else { ?>
                                                                      <div style="font-size: 48px; color: #dc3545; margin: 20px 0;">
                                                                        <i class="mdi mdi-file-pdf-box"></i>
                                                                      </div>
                                                                      <p class="text-muted">PDF Document</p>
                                                                    <?php } ?>
                                                                    <div class="mt-2">
                                                                      <a href="<?php echo $file_path; ?>" target="_blank" class="btn btn-sm btn-primary">
                                                                        <i class="mdi mdi-eye"></i> View
                                                                      </a>
                                                                      <a href="<?php echo $file_path; ?>" download class="btn btn-sm btn-success">
                                                                        <i class="mdi mdi-download"></i> Download
                                                                      </a>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <?php
                                                            }
                                                          }
                                                          
                                                          if ($file_count == 0) {
                                                            ?>
                                                            <div class="col-12 text-center">
                                                              <p class="text-muted">No documents submitted</p>
                                                            </div>
                                                            <?php
                                                          }
                                                        } else {
                                                          ?>
                                                          <div class="col-12 text-center">
                                                            <p class="text-muted">No documents submitted</p>
                                                          </div>
                                                          <?php
                                                        }
                                                      ?>
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
                                                <?php if ($info['STATUS'] == 'ACCEPTED' && !empty($info['QRCODE'])) { ?>
                                                <div class="tab-pane fade" id="qrcode<?php echo $info['ID']; ?>" role="tabpanel" aria-labelledby="qrcode-tab">
                                                  <div class="row">
                                                    <div class="col-md-12 text-center">
                                                      <h5 class="mb-3">Appointment QR Code</h5>
                                                      <div class="qr-code-container" style="border: 2px solid #ddd; padding: 20px; border-radius: 10px; background-color: #f9f9f9; display: inline-block;">
                                                        <img src="<?php echo $info['QRCODE']; ?>" style="width: 200px; height: 200px;" alt="QR Code" />
                                                      </div>
                                                      <p class="mt-3 text-muted">
                                                        <strong>Control Code:</strong> <?php echo $info['CONTROLCODE']; ?>
                                                      </p>
                                                      <p class="text-muted">
                                                        <small>Present this QR code at the venue for verification</small>
                                                      </p>
                                                    </div>
                                                  </div>
                                                </div>
                                                <?php } ?>
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
                                  </tr>
                                  <?php
                                }
                              }
                              else{
                                ?>
                                <tr>
                                  <td colspan="6">
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
          </div>
          </div>