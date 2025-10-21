        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            
            <?php
              if (isset($_POST['controlnum'])) {
                ?>
                  <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">

                          <h3 class="card-title"><b>Client's Information</b></h3>
                          <br>

                          <div class="row">
                            <div class="col-md-12">
                              <p class="card-description"> Department & Control Number </p>
                              <div class="form-group row">
                                <table class="table table-bordered">
                                  <?php
                                    if (isset($_POST['controlnum'])) {
                                      $controlnum = $_POST['controlnum'];
                                      $sql = mysqli_query($conn,"SELECT * FROM tbl_items WHERE CONTROLNUM = '$controlnum'");
                                      if (mysqli_num_rows($sql) > 0) {
                                        $info = mysqli_fetch_array($sql);

                                        ?>
                                        <tr>
                                          <td width="30%">Control Number</td>
                                          <td width="70%" style="word-wrap: break-word; white-space: normal !important; text-align: justify; line-height: 1.3;"><b><?php echo $info['CONTROLNUM']; ?></b></td>
                                        </tr>
                                        <tr>
                                          <td width="30%">Department</td>
                                          <td width="70%" style="word-wrap: break-word; white-space: normal !important; text-align: justify; line-height: 1.3;"><b><?php echo DEPARTMENTDESCRIPTION($info['DEPARTMENTCODE']); ?></b></td>
                                        </tr>
                                        <?php
                                      }
                                    }
                                  ?>
                                </table>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              <p class="card-description"> View Reservation Details </p>
                              <div class="form-group row">
                                <table class="table table-bordered">
                                  <?php
                                    if (isset($_POST['controlnum'])) {
                                      $controlnum = $_POST['controlnum'];
                                      $sql = mysqli_query($conn,"SELECT * FROM tbl_items WHERE CONTROLNUM = '$controlnum'");
                                      if (mysqli_num_rows($sql) > 0) {
                                        $info = mysqli_fetch_array($sql);

                                        ?>
                                        <tr>
                                          <td width="30%">Purchase Vendor</td>
                                          <td width="70%" style="word-wrap: break-word; white-space: normal !important; text-align: justify; line-height: 1.3;"><b><?php echo $info['PURCHASEVENDOR']; ?></b></td>
                                        </tr>
                                        <tr>
                                          <td width="30%">Purchase Date</td>
                                          <td width="70%"><b><?php echo $info['PURCHASEDATE']; ?></b></td>
                                        </tr>
                                        <tr>
                                          <td width="30%">Warranty Period</td>
                                          <td width="70%" style="word-wrap: break-word; white-space: normal !important; text-align: justify; line-height: 1.3;"><b><?php echo $info['WARRANTYPERIOD']; ?></b></td>
                                        </tr>
                                        <?php
                                      }
                                    }
                                  ?>
                                </table>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                <?php
              }
            ?>

            <div class="row" style="padding: 0 20px;">

              <div class="col-md-5">
                <center>
                  <p style="border: 1px solid #0e6655; background-color: #0e6655; color: #fff; font-weight: bold; font-size: 20px; padding-top: 10px; padding-bottom: 10px;"><i class="glyphicon glyphicon-qrcode"></i> SCAN QR CODE</p>
                </center>
                <video id="preview" width="100%"></video>
              </div>

              <div class="col-md-7">
                <form action="index.php?page=appointment&a=adminappointmentscan" method="POST" class="form-horizontal">
                  <div class="row">
                    <center>
                      <div id="clockdate" style="border: 1px solid #0e6655;background-color: #0e6655">
                        <div class="clockdate-wrapper">
                            <div id="clock" style="font-weight: bold; color: #fff;font-size: 40px"></div>
                            <div id="date" style="color: #fff"><i class="glyphicon glyphicon-calendar"></i> <?php date_default_timezone_set('Asia/Manila'); echo date('l, F j, Y - g:i a'); ?></div>
                        </div>
                      </div>
                    </center>
                  </div><br><br>
                  <div class="row">
                    <div class="col-md-12">
                      <input type="text" name="qrcode" id="qrcode" class="form-control" placeholder="Scanning QR Code" readonly>
                    </div>
                  </div>
                </form><br>

                <?php
                  if (isset($_POST['qrcode'])){

                    $qrcode = trim($_POST['qrcode']);

                    $sqlappoint = mysqli_query($conn, "SELECT * FROM tbl_appointment WHERE CONTROLCODE ='$qrcode' LIMIT 1");
                    if (mysqli_num_rows($sqlappoint) > 0){
                      $infoappoint = mysqli_fetch_array($sqlappoint);

                      ?>  
                      <script type="text/javascript">
                        window.location.href = 'index.php?page=appointment&a=adminappointmentscan&qrcode=<?php echo $qrcode; ?>';
                      </script>
                      <?php
                      exit();
                    }
                    else{
                      echo "
                            <div class='alert alert-danger' id='qrerror'>
                                <h4>Error!</h4>
                                QR Code was not registered!
                            </div>";
                    }
                  }
                  elseif (isset($_GET['qrcode'])) {
                    $qrcode = trim($_GET['qrcode']);

                    ?>
                      <div class="row">  
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th width="5%"> # </th>
                                      <th width="30%"> Details </th>
                                      <th width="15%" class="text-center"> Status </th>
                                      <th width="10%" class="text-center"> Action </th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $count = 1;
                                      date_default_timezone_set('Asia/Manila');
                                      $today = date('Y-m-d');
                                      $sql = mysqli_query($conn,"SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_appointment.CONTROLCODE = '$qrcode' GROUP BY tbl_appointment.CONTROLCODE ORDER BY tbl_appointment.ID ASC LIMIT 50");
                                      if (mysqli_num_rows($sql) > 0) {
                                        while ($info = mysqli_fetch_array($sql)){
                                          ?>
                                          <tr>
                                            <td><?php echo $count++;  ?></td>
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

                                              <a href="index.php?page=appointment&a=adminappointmentedit&appointmentcode=<?php echo $info['CONTROLCODE']; ?>" style="text-decoration: none;">
                                                <button class="btn btn-gradient-warning btn-rounded btn-icon" style="width: 26px; height: 26px;">
                                                  <i class="mdi mdi-pencil"></i>
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
                    <?php  
                  }
                ?>
              </div>
            </div>
          </div>


  <script type="text/javascript" src="js/js/adapter.min.js"></script>
  <script type="text/javascript" src="js/js/vue.min.js"></script>
  <script type="text/javascript" src="js/js/instascan.min.js"></script>
  <script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false, scanPeriod: 5 });
                
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        //scanner.start(cameras[0]);
        
        var selectedCam = cameras[0];
        $.each(cameras, (i, c) => {
          if (c.name.indexOf('back') != -1) {
            selectedCam = c;
            return false;
          }
        });
        
        scanner.start(selectedCam);
      } else {
          console.error('No cameras found.');
      }
    }).catch(function (e) {
        console.error(e);
    });

    scanner.addListener('scan', function (c) {
        document.getElementById('qrcode').value = c;
        document.forms[0].submit();

    });
  </script>