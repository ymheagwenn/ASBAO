        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">

              <?php
                if(isset($_FILES['files'])){
                  $desired_dir = "uploads/category/";

                  date_default_timezone_set('Asia/Manila');
                  $categorycode = trim($_POST['categorycode']);
                  $pathpicture = trim($_POST['pathpicture']);
                        
                  $count = 0;

                  foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                    $file_name = $categorycode."-".strtolower($_FILES['files']['name' ][$key]);
                    $size =$_FILES['files']['size'][$key];
                    $file_f = $size / 1024;
                    $file_size =round($file_f);
                    $file_tmp =$_FILES['files']['tmp_name'][$key];
                    $file_type=$_FILES['files']['type'][$key];
                    $path="uploads/category/$file_name";

                    if (empty($_FILES['files']['name' ][$key]) || $_FILES['files']['name' ][$key] = ''){
                      $path = "";
                    }

                    $query = "UPDATE tbl_category SET PHOTOS='$path' WHERE CATEGORYCODE = '$categorycode'";
                    if(mysqli_query($conn,$query)){               
                      move_uploaded_file($file_tmp,"$desired_dir".$file_name);
                                
                      $count = $count + 1;
                      if ($pathpicture != 'models/img/unavailable.jpg') {
                        unlink($pathpicture);
                      }
                    }

                    ?>
                      <script type="text/javascript">
                        Swal.fire(
                          'Uploaded!',
                          'Photo uploaded successfully!',
                          'success'
                        ).then((result) => {
                          window.location = "index.php?page=category&a=admincategoryupload&categorycode=<?php echo $categorycode; ?>";
                        });
                      </script>
                    <?php
                  }
                }
            ?>

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><?php echo CATEGORYNAME($_GET['categorycode']); ?></h4>
                    <p class="card-description"> Change a cover picture. </p>

                    <form class="forms-sample" action="index.php?page=category&a=admincategoryupload&categorycode=<?php echo $_GET['categorycode']; ?>" method="POST" enctype="multipart/form-data">

                      <div class="row">
                        <div class="col-md-8"><br><br>
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Select picture <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <input type="file" class="form-control" name="files[]" accept="image/*" required />
                            </div>
                          </div>


                          <p class="text-center">
                            <input type="hidden" class="form-control" name="categorycode" value="<?php if (isset($_GET['categorycode'])){ echo $_GET['categorycode']; } ?>" />
                            <input type="hidden" class="form-control" name="pathpicture" value="<?php if (isset($_GET['categorycode'])){ echo CATEGORYPATH($_GET['categorycode']); } ?>" />
                            <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Upload</button>
                            <a href="index.php?page=category&a=admincategory" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                          </p>
                        </div>

                        <div class="col-sm-4">
                          <div class="card">
                            <div class="product-item">
                              <img src="<?php if (isset($_GET['categorycode'])){ echo CATEGORYPATH($_GET['categorycode']); } ?>" class="w-100" alt="" style="border: 1px solid #FF5733;">
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>