        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if(isset($_FILES['files'])){
                  if (empty(trim($_POST['filename']))) {

                  ?>
                    <div class="row text-center">
                      <p class="text-danger" style='font-size: 15px;'>One of the required field is empty or contains invalid data, please check your input!</p>
                    </div>
                  <?php
                  }
                  else{
                    $desired_dir = "uploads/forms/";

                    date_default_timezone_set('Asia/Manila');
                    $filename = trim($_POST['filename']);
                    $status = "Active";
                          
                    $count = 0;

                    foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                      $file_name = strtolower($_FILES['files']['name' ][$key]);
                      $size =$_FILES['files']['size'][$key];
                      $file_f = $size / 1024;
                      $file_size =round($file_f);
                      $file_tmp =$_FILES['files']['tmp_name'][$key];
                      $file_type=$_FILES['files']['type'][$key];
                      $path="uploads/forms/$file_name";

                      if (empty($_FILES['files']['name' ][$key]) || $_FILES['files']['name' ][$key] = ''){
                        ?>
                          <script type="text/javascript">
                            Swal.fire(
                              'Error!',
                              'Error uploading file!',
                              'error'
                            ).then((result) => {

                            });
                          </script>
                        <?php
                      }
                      else{
                        $query = "INSERT INTO tbl_forms(FILENAME, FILEPATH, STATUS) VALUES('$filename','$path','$status')";
                        if(mysqli_query($conn,$query)){               
                          move_uploaded_file($file_tmp,"$desired_dir".$file_name);
                                    
                          $count = $count + 1;
                        }

                        ?>
                          <script type="text/javascript">
                            Swal.fire(
                              'Uploaded!',
                              'Form uploaded successfully!',
                              'success'
                            ).then((result) => {
                              window.location = "index.php?page=forms&a=adminforms";
                            });
                          </script>
                        <?php
                      }
                    }
                  }
                }
            ?>

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Upload Form</h4>

                    <form class="forms-sample" action="index.php?page=forms&a=adminformsadd" method="POST" enctype="multipart/form-data">

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Form Name <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="filename" placeholder="Form Name" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Select File <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" name="files[]" accept="image/*; pdf/*" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Upload</button>
                        <a href="index.php?page=forms&a=adminforms" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            