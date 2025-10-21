        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if (isset($_POST['categoryname']) &&
                    isset($_POST['description'])){

                    if (empty(trim($_POST['categoryname'])) ||
                        empty(trim($_POST['description']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>One of the required field is empty or contains invalid data, please check your input!</p>
                          </div>
                        <?php
                    }
                    elseif (!isset($_POST['categoryvenue'])){
                      ?>
                        <div class="row text-center">
                          <p class="text-danger" style='font-size: 15px;'>Please select a category!</p>
                        </div>
                      <?php
                    }
                    else{
                      date_default_timezone_set('Asia/Manila');
                      $categorycode = date('ymd-His') . "-". intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
                      $categoryvenue = str_replace("'", "", trim($_POST['categoryvenue']));
                      $categoryname = str_replace("'", "", trim($_POST['categoryname']));
                      $description = str_replace("'", "", trim($_POST['description']));
                      $status = "Active";


                      $sql = mysqli_query($conn, "SELECT * FROM tbl_category WHERE CATEGORYVENUE ='$categoryvenue' AND CATEGORYNAME ='$categoryname'");
                      if (mysqli_num_rows($sql) > 0){
                          $info = mysqli_fetch_array($sql);

                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Venue has been already recorded!</p>
                            </div>
                          <?php

                      }
                      else{
                          $sql = "INSERT INTO tbl_category(CATEGORYCODE, CATEGORYVENUE, CATEGORYNAME, DESCRIPTION, STATUS) VALUES('$categorycode','$categoryvenue','$categoryname','$description','$status')";
                          if (!mysqli_query($conn,$sql)) {
                              die('Error:'.mysqli_error($conn));
                          }

                          ?>

                            <script type="text/javascript">
                              Swal.fire(
                                'Saved!',
                                'Data saved successfully!',
                                'success'
                              ).then((result) => {
                                window.location = "index.php?page=category&a=admincategory";
                              });
                            </script>
                          <?php
                      } 
                    }
                }
            ?>

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Venue</h4>
                    <p class="card-description"> Please enter the venue details. </p>

                    <form class="forms-sample" action="index.php?page=category&a=admincategoryadd" method="POST">
                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <div class="form-group">
                                <select class="form-control form-control-lg text-dark" id="exampleFormControlSelect1" name="categoryvenue">
                                  <option disabled selected>Select Category</option>
                                  <?php
                                    if (isset($_POST['categoryvenue'])) {
                                      $categoryvenue = trim($_POST['categoryvenue']);
                                    }
                                    else{
                                       $categoryvenue = '';
                                    }
                                  ?>
                                  <option value="ADMIN BUILDING" <?php if ($categoryvenue == 'ADMIN BUILDING') { echo "selected"; } ?>>ADMIN BUILDING</option>
                                  <option value="OVAL" <?php if ($categoryvenue == 'OVAL') { echo "selected"; } ?>>OVAL</option>
                                  <option value="BDC" <?php if ($categoryvenue == 'BDC') { echo "selected"; } ?>>BDC</option>
                                  <option value="SOCIO" <?php if ($categoryvenue == 'SOCIO') { echo "selected"; } ?>>SOCIO</option>
                                  <option value="OTHER" <?php if ($categoryvenue == 'OTHER') { echo "selected"; } ?>>OTHER</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Venue Name <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="categoryname" maxlength="100" value="<?php if (isset($_POST['categoryname'])){ echo $_POST['categoryname']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                              <textarea class="form-control" rows="3" name="description" maxlength="500" style="line-height: 1.8em;"><?php if (isset($_POST['description'])){ echo $_POST['description']; } ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Save</button>
                        <a href="index.php?page=category&a=admincategory" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            