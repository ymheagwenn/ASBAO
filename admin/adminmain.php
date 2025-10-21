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
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-home"></i>
                </span> Venue Lists
              </h3>
            </div>

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
                                  <a href="index.php?page=home&a=adminappointmentdate&venue=<?php echo $info['CATEGORYCODE']; ?>" style="text-decoration: none;">
                                    <img class="mx-auto rounded-circle" src="<?php if (trim(CATEGORYPATH($info['CATEGORYCODE'])) == ''){ echo 'models/img/unavailable.jpg'; }else{ echo CATEGORYPATH($info['CATEGORYCODE']); } ?>" alt="..." />
                                    <h4 style="color: #40826D; font-weight: bold;"><?php echo $info['CATEGORYNAME']; ?></h4><br>
                                    <p class="text-dark" style="background-color: #ffffff; padding: 10px; border-radius: 10px;"><?php echo $info['DESCRIPTION']; ?></p>
                                  </a>
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