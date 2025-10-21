        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if (isset($_POST['filename'])){

                    if (empty(trim($_POST['filename']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>Please enter a name of form!</p>
                          </div>
                        <?php
                    }
                    else{
                      date_default_timezone_set('Asia/Manila');
                      $id = trim($_POST['id']);
                      $filename = str_replace("'", "", trim($_POST['filename']));
                      $status = trim($_POST['status']);


                      $sql = mysqli_query($conn, "SELECT * FROM tbl_forms WHERE FILENAME = '$filename' AND STATUS='$status'");
                      if (mysqli_num_rows($sql) > 0){
                          $info = mysqli_fetch_array($sql);

                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Form has been already recorded!</p>
                            </div>
                          <?php

                      }
                      else{
                          $sql = "UPDATE tbl_forms SET FILENAME='$filename', STATUS='$status' WHERE ID = '$id'";
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
                                window.location = "index.php?page=forms&a=adminforms";
                              });
                            </script>
                          <?php
                      } 
                    }
                }
            ?>

              <div class="col-2 grid-margin stretch-card"></div>
              <div class="col-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Form</h4>
                    <p class="card-description"> Please enter the form details. </p>

                    <form class="forms-sample" action="index.php?page=forms&a=adminformsedit&id=<?php echo $_GET['id']; ?>" method="POST">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Form Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="filename" maxlength="200" value="<?php if (isset($_POST['filename'])){ echo $_POST['filename']; }else { echo FORMNAME($_GET['id']); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <div class="form-group">
                                <select class="form-control form-control-lg text-dark" id="exampleFormControlSelect1" name="status">
                                  <option disabled selected>Select Status</option>
                                  <?php
                                    if (isset($_POST['status'])) {
                                      $status = trim($_POST['status']);
                                    }
                                    else{
                                       $status = FORMSTATUS($_GET['id']);
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

                      <p class="text-center">
                        <input type="hidden" class="form-control" name="id" value="<?php if (isset($_GET['id'])){ echo $_GET['id']; } ?>" />
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Update</button>
                        <a href="index.php?page=holiday&a=adminforms" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-2 grid-margin stretch-card"></div>

            </div>
          </div>

          
            