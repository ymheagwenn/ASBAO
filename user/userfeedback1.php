        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if (isset($_POST['remarks'])){

                    if (empty(trim($_POST['remarks']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>Please enter remarks!</p>
                          </div>
                        <?php
                    }
                    else{
                      date_default_timezone_set('Asia/Manila');
                      $usercode = $_SESSION['USERCODE'];
                      $remarks = str_replace("'", "", trim($_POST['remarks']));
                      date_default_timezone_set('Asia/Manila');
                      $dateon = date('Y-m-d g:i a');


                      $sql = "INSERT INTO tbl_feedback(USERCODE, REMARKS, DATEON) VALUES('$usercode','$remarks','$dateon')";
                      if (!mysqli_query($conn,$sql)) {
                        die('Error:'.mysqli_error($conn));
                      }

                      $sql = mysqli_query($conn,"SELECT tbl_appointment.CONTROLCODE AS CCODE FROM tbl_appointment INNER JOIN tbl_venuelists ON tbl_appointment.CONTROLCODE = tbl_venuelists.CONTROLCODE WHERE tbl_venuelists.USERCODE = '$usercode' AND FEEDBACK = 'NOT RATED' GROUP BY tbl_appointment.CONTROLCODE");
                      if (mysqli_num_rows($sql) > 0) {
                          $info = mysqli_fetch_array($sql);
                          
                          $cc = $info['CCODE'];

                          $sql = "UPDATE tbl_appointment SET FEEDBACK='RATED' WHERE CONTROLCODE = '$cc'";
                          if (!mysqli_query($conn,$sql)) {
                              die('Error:'.mysqli_error($conn));
                          }
                      }

                      ?>

                            <script type="text/javascript">
                              Swal.fire(
                                'Submitted!',
                                'Data submitted successfully!',
                                'success'
                              ).then((result) => {
                                window.location = "index.php?page=home&a=userdashboard";
                              });
                            </script>
                      <?php
                    }
                }
            ?>

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Send Feedback</h4>
                    <p class="card-description"> Please enter the feedback details. </p>

                    <form class="forms-sample" action="index.php?page=home&a=userfeedback" method="POST">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Remarks <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                              <textarea name="remarks" style="line-height: 1.6em;" class="form-control" rows="3"><?php if (isset($_POST['remarks'])){ echo $_POST['remarks']; } ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Submit Feedback</button>
                        <a href="index.php?page=home&a=userdashboard" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            