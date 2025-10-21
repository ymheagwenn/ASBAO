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
                      $categorycode = trim($_POST['categorycode']);
                      $categoryvenue = str_replace("'", "", trim($_POST['categoryvenue']));
                      $categoryname = str_replace("'", "", trim($_POST['categoryname']));
                      $description = str_replace("'", "", trim($_POST['description']));
                      $status = trim($_POST['status']);

                      $sql = mysqli_query($conn, "SELECT * FROM tbl_category WHERE CATEGORYVENUE ='$categoryvenue' AND CATEGORYNAME ='$categoryname' AND DESCRIPTION ='$description' AND STATUS ='$status'");
                      if (mysqli_num_rows($sql) > 0){
                          $info = mysqli_fetch_array($sql);

                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Venue has been already recorded!</p>
                            </div>
                          <?php

                      }
                      else{
                          $sql = "UPDATE tbl_category SET CATEGORYVENUE='$categoryvenue', CATEGORYNAME='$categoryname', DESCRIPTION='$description', STATUS='$status' WHERE CATEGORYCODE = '$categorycode'";
                          if (!mysqli_query($conn,$sql)) {
                              die('Error:'.mysqli_error($conn));
                          }

                          ?>

                            <script type="text/javascript">
                              Swal.fire(
                                'Updated!',
                                'Data updated successfully!',
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
                    <h4 class="card-title">Edit Venue</h4>
                    <p class="card-description"> Please enter the venue details. </p>

                    <form class="forms-sample" action="index.php?page=categorycode&a=admincategoryedit&categorycode=<?php echo $_GET['categorycode']; ?>" method="POST">
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
                                       $categoryvenue = CATEGORYVENUE($_GET['categorycode']);;
                                    }
                                  ?>
                                  <option value="ADMIN BUILDING" <?php if ($categoryvenue == 'ADMIN BUILDING') { echo "selected"; } ?>>ADMIN BUILDING</option>
                                  <option value="OVAL" <?php if ($categoryvenue == 'OVAL') { echo "selected"; } ?>>OVAL</option>
                                  <option value="BDC" <?php if ($categoryvenue == 'BDC') { echo "selected"; } ?>>BDC</option>
                                  <option value="SOCIO" <?php if ($categoryvenue == 'SOCIO') { echo "selected"; } ?>>SOCIO</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Category Name <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" name="categoryname" maxlength="100" value="<?php if (isset($_POST['categoryname'])){ echo $_POST['categoryname']; }else { echo CATEGORYNAME($_GET['categorycode']); } ?>" />
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                              <div class="form-group">
                                <select class="form-control form-control-lg text-dark" id="exampleFormControlSelect1" name="status">
                                  <option disabled selected>Select Status</option>
                                  <?php
                                    if (isset($_POST['status'])) {
                                      $status = trim($_POST['status']);
                                    }
                                    else{
                                       $status = CATEGORYSTATUS($_GET['categorycode']);
                                    }
                                  ?>
                                  <option value="Active" <?php if ($status == 'Active') { echo "selected"; } ?>>Active</option>
                                  <option value="Deactive" <?php if ($status == 'Deactive') { echo "selected"; } ?>>Deactive</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                              <textarea class="form-control" rows="4" name="description" maxlength="500" style="line-height: 1.8em;"><?php if (isset($_POST['description'])){ echo $_POST['description']; }else { echo CATEGORYDESCRIPTION($_GET['categorycode']); } ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <input type="hidden" class="form-control" name="categorycode" value="<?php if (isset($_GET['categorycode'])){ echo $_GET['categorycode']; } ?>" />
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Update</button>
                        <a href="index.php?page=category&a=admincategory" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>