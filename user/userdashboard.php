  <style type="text/css">
    .team-member {
        margin-bottom: 3rem;
        text-align: center;
      }
      .team-member img {
        width: 6rem;
        height: 6rem;
        border: 0.3rem solid rgba(0, 0, 0, 0.1);
      }
      .team-member h4, .team-member .h4 {
        margin-top: 1.5rem;
        margin-bottom: 0;
      }
  </style>

        <div class="main-panel">
          <div class="content-wrapper" style="background-image: url('models/img/backdrop.jpg'); background-repeat: no-repeat; background-position: center center; background-position: 0% 0%; background-size: 100% 100%;">




            <section class="page-section" id="team">
              <div class="container">
                <div class="row">
                  <?php
                      date_default_timezone_set('Asia/Manila');
                      $today = date('Y-m-d');
                      $ctr = 0;
                      $sql = mysqli_query($conn,"SELECT * FROM tbl_category WHERE STATUS = 'Active' ORDER BY CATEGORYNAME ASC LIMIT 16");
                      if (mysqli_num_rows($sql) > 0) {
                        while ($info = mysqli_fetch_array($sql)){
                          ?>
                            <div class="col-md-3">
                                <div class="team-member">
                                  <?php
                                    $usercode = $_SESSION['USERCODE'];
                                    if (CHECKFEEDBACK($usercode) > 0){
                                      ?>
                                        <a href="#" onclick="showFeedbackModal()" style="text-decoration: none;">
                                          <img class="mx-auto rounded-circle" src="<?php if (trim(CATEGORYPATH($info['CATEGORYCODE'])) == ''){ echo 'models/img/unavailable.jpg'; }else{ echo CATEGORYPATH($info['CATEGORYCODE']); } ?>" alt="..." />
                                          <h4 style="color: #FF5733; font-weight: bold;"><?php echo $info['CATEGORYNAME']; ?></h4><br>
                                          <p class="text-dark" style="background-color: #ffffff; padding: 10px; border-radius: 10px;"><?php echo $info['DESCRIPTION']; ?></p>
                                        </a>
                                      <?php
                                    }
                                    else{
                                      ?>
                                        <a href="index.php?page=home&a=userappointmentdate&venue=<?php echo $info['CATEGORYCODE']; ?>" style="text-decoration: none;">
                                          <img class="mx-auto rounded-circle" src="<?php if (trim(CATEGORYPATH($info['CATEGORYCODE'])) == ''){ echo 'models/img/unavailable.jpg'; }else{ echo CATEGORYPATH($info['CATEGORYCODE']); } ?>" alt="..." />
                                          <h4 style="color: #FF5733; font-weight: bold;"><?php echo $info['CATEGORYNAME']; ?></h4><br>
                                          <p class="text-dark" style="background-color: #ffffff; padding: 10px; border-radius: 10px;"><?php echo $info['DESCRIPTION']; ?></p>
                                        </a>
                                      <?php
                                    }
                                  ?>
                                </div>
                            </div>
                          <?php
                        }
                      }
                    ?>
                              
                </div>
              </div>
            </section>
          </div>

          <!-- Feedback Modal -->
          <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="feedbackModalLabel">Feedback Required</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="alert alert-info">
                    <i class="mdi mdi-information"></i>
                    <strong>Please provide feedback for your completed appointment(s) before making a new booking.</strong>
                  </div>
                  <p>You have completed appointment(s) that require your feedback. Please help us improve our services by rating your experience.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <a href="index.php?page=home&a=userfeedback" class="btn btn-success">
                    <i class="mdi mdi-comment-text"></i> Provide Feedback
                  </a>
                </div>
              </div>
            </div>
          </div>

          <script>
            function showFeedbackModal() {
              var feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
              feedbackModal.show();
            }
          </script>