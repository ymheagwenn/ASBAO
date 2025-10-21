        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if(isset($_FILES['files'])){
                  $desired_dir = "uploads/profile/";

                  date_default_timezone_set('Asia/Manila');
                  $usercode = trim($_POST['usercode']);
                  $pathpicture = trim($_POST['pathpicture']);
                        
                  $count = 0;

                  foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                    $file_name = $usercode."-".strtolower($_FILES['files']['name' ][$key]);
                    $size =$_FILES['files']['size'][$key];
                    $file_f = $size / 1024;
                    $file_size =round($file_f);
                    $file_tmp =$_FILES['files']['tmp_name'][$key];
                    $file_type=$_FILES['files']['type'][$key];
                    $path="uploads/profile/$file_name";

                    if (empty($_FILES['files']['name' ][$key]) || $_FILES['files']['name' ][$key] = ''){
                      $path = "No Image";
                    }

                    $query = "UPDATE tbl_users SET PROFILE='$path' WHERE USERCODE = '$usercode'";
                    if(mysqli_query($conn,$query)){               
                      move_uploaded_file($file_tmp,"$desired_dir".$file_name);
                                
                      $count = $count + 1;
                      unlink($pathpicture);
                    }

                    ?>
                      <script type="text/javascript">
                        Swal.fire(
                          'Uploaded!',
                          'Photo uploaded successfully!',
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
                    <h4 class="card-title">Profile Picture</h4>
                    <p class="card-description"> Change a profile picture. </p>

                    <form class="forms-sample" action="index.php?page=home&a=userprofilepicture" method="POST" enctype="multipart/form-data">

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Select picture</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" name="files[]" accept="image/*" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <input type="hidden" class="form-control" name="usercode" value="<?php if (isset($_SESSION['USERCODE'])){ echo $_SESSION['USERCODE']; } ?>" />
                        <input type="hidden" class="form-control" name="pathpicture" value="<?php if (isset($_SESSION['USERCODE'])){ echo PROFILEPATH($_SESSION['USERCODE']); } ?>" />
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Upload</button>
                        <a href="index.php?page=home&a=userdashboard" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            