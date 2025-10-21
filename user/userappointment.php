        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-success text-white me-2">
                  <i class="mdi mdi-timetable"></i>
                </span> Appointment Lists
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item" aria-current="page" style="font-weight: normal;">
                    <a href="index.php?page=appointment&a=userappointmentadd" style="text-decoration: none; padding: 8px;" class="btn-dark text-white">
                      <i class="mdi mdi-plus icon-sm align-middle"></i>
                      <span></span>&nbsp; Create
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            
            <div class="row">  
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table" <?php if (USERAPPOINTMENTCHECK($_SESSION['USERCODE']) > 0){ echo 'id="dtAppointment"'; } ?>>
                        <thead>
                          <tr class="bg-success text-white">
                            <th> # </th>
                            <th width="15%" class="text-center"> Venue </th>
                            <th width="30%"> Details </th>
                            <th width="20%" class="text-left"> Remarks </th>
                            <th width="15%" class="text-center"> Status </th>
                            <th width="10%" class="text-center"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $count = 1;
                            date_default_timezone_set('Asia/Manila');
                            $today = date('Y-m-d');
                            $usercode = $_SESSION['USERCODE'];
                            $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.USERCODE = '$usercode' AND tbl_appointment.STATUS != 'COMPLETED' AND tbl_appointment.STATUS != 'CANCELLED' GROUP BY tbl_appointment.CONTROLCODE ORDER BY tbl_appointment.ID ASC LIMIT 50");
                            if (mysqli_num_rows($sql) > 0) {
                              while ($info = mysqli_fetch_array($sql)){
                                ?>
                                <tr>
                                  <td><?php echo $count++;  ?></td>
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
                                    <?php echo $info['LASTNAME'] .", ". $info['FIRSTNAME']. " ".$info['MIDDLENAME']; ?>

                                    <?php
                                      if (!empty($info['CONTACT'])) {
                                        ?>
                                          <br><br>
                                          <small style="font-weight: bold; font-size: 10px;">Contact: &nbsp; <?php echo $info['CONTACT']; ?></small>
                                        <?php
                                      }

                                      if (!empty($info['EMAIL'])) {
                                        ?>
                                          <br><br>
                                          <small style="font-weight: bold; font-size: 10px;">Email: &nbsp; <?php echo $info['EMAIL']; ?></small>
                                        <?php
                                      }

                                      if (!empty($info['ADDRESS'])) {
                                        ?>
                                          <br><br>
                                          <small style="font-weight: bold; font-size: 10px;">Address: &nbsp; <?php echo $info['ADDRESS']; ?></small>
                                        <?php
                                      }
                                    ?>
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
                                                    <table>
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

                                                    <table class="table table-bordered table-responsive">
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
                                                              <td class="text-left"><?php echo date('g:ia', strtotime($infoven['VENUETIMEIN'])) ." - ".date('g:ia', strtotime($infoven['VENUETIMEOUT'])); ?></td>
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

                                    <a href="index.php?page=appointment&a=userappointmentedit&appointmentcode=<?php echo $info['CONTROLCODE']; ?>" style="text-decoration: none;">
                                      <button class="btn btn-gradient-warning btn-rounded btn-icon" style="width: 26px; height: 26px;">
                                        <i class="mdi mdi-pencil"></i>
                                      </button>
                                    </a>

                                    <a href="index.php?page=appointment&a=userappointmentreceipt&appointmentcode=<?php echo $info['ID']; ?>&controlcode=<?php echo $info['CONTROLCODE']; ?>" target="_blank" style="text-decoration: none;">
                                      <button class="btn btn-gradient-info btn-rounded btn-icon" style="width: 26px; height: 26px;">
                                        <i class="mdi mdi-download"></i>
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
                                  <br><br><br><br>
                                  <div class="col-12 text-center">
                                    <p class="text-dark" style='font-size: 15px;'>There was no appointment records!</p>
                                  </div>
                                  <br><br><br>
                                </td>
                              </tr>
                              <?php
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
          
            