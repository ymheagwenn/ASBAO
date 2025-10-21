        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-success align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>

              <div class="row">
                <div class="col-md-3 stretch-card grid-margin">
                  <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                      <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                      <h4 class="font-weight-normal mb-3" style="font-weight: bold;"><i class="mdi mdi-cube mdi-24px float-left"></i> &nbsp; Approved Booking
                      </h4>
                      <h1 class="mb-5"><?php echo TOTALAPPOINTMENTAPPROVED(); ?></h1>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 stretch-card grid-margin">
                  <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                      <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                      <h4 class="font-weight-normal mb-3" style="font-weight: bold;"><i class="mdi mdi-city mdi-24px float-left"></i> &nbsp; Pending Acceptance of Reservation
                      </h4>
                      <h1 class="mb-5"><?php echo TOTALAPPOINTMENTPENDING(); ?></h1>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 stretch-card grid-margin">
                  <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                      <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                      <h4 class="font-weight-normal mb-3" style="font-weight: bold;"><i class="mdi mdi-account-circle mdi-24px float-left"></i> &nbsp; Cancelled Booking
                      </h4>
                      <h1 class="mb-5"><?php echo TOTALAPPOINTMENTCANCELLED(); ?></h1>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 stretch-card grid-margin">
                  <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                      <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                      <h4 class="font-weight-normal mb-3" style="font-weight: bold;"><i class="mdi mdi-city mdi-24px float-left"></i> &nbsp; Completed Booking
                      </h4>
                      <h1 class="mb-5"><?php echo TOTALAPPOINTMENTCOMPLETED(); ?></h1>
                    </div>
                  </div>
                </div>
              </div>
          </div>

          <?php
            date_default_timezone_set('Asia/Manila');
            $today = date('Y-m-d');
            $ctr = 0;
            $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.VENUEDATE = '$today' AND tbl_appointment.STATUS = 'ACCEPTED' ORDER BY tbl_appointment.ID ASC LIMIT 10");
            if (mysqli_num_rows($sql) > 0) {
              while ($info = mysqli_fetch_array($sql)){
                $ctr = $ctr + 1;

                if ($ctr == 1){
                  ?>
                  <div class="content-wrapper" style="background-color: #D6F6D5;">
                    <div class="page-header">
                      <h3 class="page-title">
                        <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                          <i class="mdi mdi-calendar"></i>
                        </span> Today's Appointments 
                      </h3>
                    </div>

                    <div class="row"> 
                  <?php
                }
                ?>  
                   
                    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                      <div class="card">
                        <div class="product-item">
                          <img src="<?php if (trim(CATEGORYPATH($info['CATEGORYCODE'])) == ''){ echo 'models/img/unavailable.jpg'; }else{ echo CATEGORYPATH($info['CATEGORYCODE']); } ?>" class="w-100" width="300" height="150" alt="">
                          <div class="px-3 py-4">
                          	<p style="height: 3em; line-height: 1.5em; overflow: hidden; text-overflow: ellipsis; font-weight: bold; font-size: 14px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                              <?php echo $info['REMARKS']; ?>
                            </p>
                              
                            <div class="d-flex justify-content=between align-items-center">
                              <i class="mdi mdi-city"></i> &nbsp; <?php echo $info['CATEGORYNAME']; ?>
                            </div>
                            <br>
                            <div class="d-flex justify-content=between align-items-center">
                              <small style="font-size: 12px;"><i class="mdi mdi-calendar"></i> &nbsp; <?php echo date('F d, Y', strtotime($info['VENUEDATE'])); ?></small>
                            </div>
                            <br>
                            <div class="d-flex justify-content=between align-items-center">
                              <small style="font-size: 12px;"><i class="mdi mdi-clock"></i> &nbsp; <?php
                                $timeIn = (isset($info['VENUETIMEIN']) && trim($info['VENUETIMEIN']) !== '') ? date('g:i a', strtotime($info['VENUETIMEIN'])) : (isset($info['VENUETIME']) ? $info['VENUETIME'] : '');
                                $timeOut = (isset($info['VENUETIMEOUT']) && trim($info['VENUETIMEOUT']) !== '') ? date('g:i a', strtotime($info['VENUETIMEOUT'])) : '';
                                echo ($timeOut !== '') ? ($timeIn . " - " . $timeOut) : $timeIn;
                              ?></small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                
                <?php
              }
              ?>
                  </div>
                </div>
              <?php
            }
          ?>

          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-calendar"></i>
                </span> Upcoming Appointments 
              </h3>
            </div>
            
            <div class="row">  
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th width="35%" class="text-center"> Venue </th>
                            <th width="30%"> Details </th>
                            <th width="20%" class="text-left"> Purpose </th>
                            <th width="15%" class="text-center"> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $count = 1;
                            date_default_timezone_set('Asia/Manila');
                            $today = date('Y-m-d');
                            $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.VENUEDATE > '$today' AND tbl_appointment.STATUS = 'ACCEPTED' GROUP BY tbl_appointment.CONTROLCODE ORDER BY tbl_appointment.ID ASC LIMIT 10");
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
                                  
                                </tr>
                                <?php
                              }
                            }
                            else{
                              ?>
                              <tr>
                                <td colspan="5">
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