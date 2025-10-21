        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if (isset($_POST['description'])){

                    if (empty(trim($_POST['description']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>Please enter question!</p>
                          </div>
                        <?php
                    }
                    else{
                      date_default_timezone_set('Asia/Manila');
                      $departmentcode = date('ymd-His') . "-". intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
                      $description = str_replace("'", "", trim($_POST['description']));
                      $status = "Active";


                      $sql = mysqli_query($conn, "SELECT * FROM questions WHERE question_text = '$description'");
                      if (mysqli_num_rows($sql) > 0){
                          $info = mysqli_fetch_array($sql);

                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Question has been already recorded!</p>
                            </div>
                          <?php

                      }
                      else{
                          $sql = "INSERT INTO questions(question_text) VALUES('$description')";
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
                                window.location = "index.php?page=feedback&a=adminfeedback";
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
                    <h4 class="card-title">Add Question</h4>
                    <p class="card-description"> Please enter the question details. </p>

                    <form class="forms-sample" action="index.php?page=feedback&a=adminfeedbackadd" method="POST">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="description" maxlength="200" value="<?php if (isset($_POST['description'])){ echo $_POST['description']; } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Save</button>
                        <a href="index.php?page=feedback&a=adminfeedback" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>

          
            