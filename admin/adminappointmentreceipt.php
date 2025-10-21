<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ASBAO - QR Code</title>

    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="models/img/NWSSU.png" rel="icon">
    <link href="models/img/NWSSU.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="print/style.css" />
  </head>
  <body>
    <div class="buttons-container">
      <button id="save">Save</button>
      <button id="print">Print</button>
    </div>
    <a id="save_to_image">
      <div class="invoice-container">
        <table cellpadding="0" cellspacing="0">
          <tr class="top">
            <td colspan="4">
              <table>
                <tr>
                  <td class="title" style="text-align: center;">
                    <?php
                      if (isset($_GET['appointmentcode'])) {
                        $appointmentcode = trim($_GET['appointmentcode']);
                        $sqlservice = mysqli_query($conn, "SELECT * FROM tbl_appointment WHERE ID ='$appointmentcode'");
                        if (mysqli_num_rows($sqlservice) > 0){
                          $info = mysqli_fetch_array($sqlservice);

                          $departmentcode = $info['CONTROLCODE'];
                          ?>
                          <img src="<?php echo $info['QRCODE']; ?>" style="width: 100%; max-width: 100px;" />
                          <?php
                        }
                      }
                    ?>
                  </td>

                  <td class="title" style="text-align: center;">
                    <img src="models/img/NWSSU.png" style="width: 50%; max-width: 50px;" />
                    <h4 style="margin-top: 10px;">
                      Auxiliary Services and Business Affairs Office<br>
                      <span style="font-size: 15px; font-style: italic;">( Venue Reservation )</span>
                    </h4>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr class="information">
            <td colspan="4">
              <table> 
                <tr>
                  <?php
                    if (isset($_GET['appointmentcode'])) {
                      $appointmentcode = trim($_GET['appointmentcode']);
                      $sqlservice = mysqli_query($conn, "SELECT * FROM tbl_appointment WHERE ID ='$appointmentcode'");
                      if (mysqli_num_rows($sqlservice) > 0){
                        $info = mysqli_fetch_array($sqlservice);
                        ?>
                        <td>
                          <strong style="font-size: 11px;">BOOKED FULLNAME</strong>
                          <h4><b><?php echo $info['LASTNAME'] .", ".$info['FIRSTNAME']."&nbsp; ".$info['MIDDLENAME']; ?></b></h4>
                        </td>
                        <td>
                          <strong style="font-size: 11px;">APPOINTMENT NO.</strong>
                          <h4><b><?php echo $info['CONTROLCODE'] ?></b></h4>
                        </td>
                        <?php
                      }
                    }
                  ?>
                </tr>
              </table>
            </td>
          </tr>
          <tr class="heading">
            <td style="text-align: left;">Contact</td>
            <td style="text-align: center;">Address</td>
            <td style="text-align: center;">Type Appointment</td>
            <td style="text-align: center;">Date & Time</td>
          </tr>
          <tr class="item">
            <?php
              if (isset($_GET['controlcode'])) {
                $controlcode = trim($_GET['controlcode']);
                $sqlservice = mysqli_query($conn, "SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.CONTROLCODE ='$controlcode'");
                if (mysqli_num_rows($sqlservice) > 0){
                  $info = mysqli_fetch_array($sqlservice);
                  ?>
                      <td style="text-align: left;">
                        <?php echo $info['CONTACT']; ?>
                      </td>
                      <td style="text-align: center;">
                        <?php echo $info['EMAIL']; ?>
                      </td>
                      <td style="text-align: center;">
                        <?php echo $info['TYPE']; ?>
                      </td>
                      <td style="text-align: center;">
                        <?php echo date('M d, Y  g:i a', strtotime($info['DATEON'])); ?>
                      </td>
                    
                  <?php
                }
              }

            ?>
            <?php
              if (isset($_GET['controlcode'])) {
                $controlcode = trim($_GET['controlcode']);
                $sqlservice = mysqli_query($conn, "SELECT * FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.CONTROLCODE ='$controlcode'");
                if (mysqli_num_rows($sqlservice) > 0){
                  While ($info = mysqli_fetch_array($sqlservice)){
                    ?>
                    <tr class="item">
                      <td style="text-align: left;">
                        <?php echo $info['CATEGORYNAME']; ?>
                      </td>
                      <td></td>
                      <td style="text-align: center;">
                        <?php echo date('M d, Y', strtotime($info['VENUEDATE'])); ?>
                      </td>
                      <td style="text-align: center;">
                        <?php echo $info['VENUETIME']; ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
              }

            ?>
          <tr class="heading">
            <td colspan="4" style="text-align: left;">Details</td>
          </tr>
          <tr class="item">
            <?php
              if (isset($_GET['appointmentcode'])) {
                $appointmentcode = trim($_GET['appointmentcode']);
                $sqlservice = mysqli_query($conn, "SELECT * FROM tbl_appointment WHERE ID ='$appointmentcode'");
                if (mysqli_num_rows($sqlservice) > 0){
                  $info = mysqli_fetch_array($sqlservice);
                  ?>
                  <td colspan="4" style="text-align: left;"><?php echo APPOINTMENTDESCRIPTION($appointmentcode); ?></td>
                  <?php
                }
              }

            ?>
          </tr>
        </table>
      </div>
    </a>
    <script src="print/html2canvas.js"></script>
    <script src="print/index.js"></script>
  </body>
</html>
