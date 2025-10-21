        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="row">

              <?php
                if (isset($_POST['question'])){

                    if (empty(trim($_POST['question']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>Please enter question!</p>
                          </div>
                        <?php
                    }
                    else{
                      date_default_timezone_set('Asia/Manila');
                      $id = trim($_POST['id']);
                      $question = str_replace("'", "", trim($_POST['question']));

                      $sql = mysqli_query($conn, "SELECT * FROM questions WHERE question_text = '$question'");
                      if (mysqli_num_rows($sql) > 0){
                          $info = mysqli_fetch_array($sql);

                          ?>
                            <div class="row text-center">
                              <p class="text-danger" style='font-size: 15px;'>Question has been already recorded!</p>
                            </div>
                          <?php

                      }
                      else{
                          $sql = "UPDATE questions SET question_text='$question' WHERE id = '$id'";
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
                                window.location = "index.php?page=feedback&a=adminfeedback";
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
                    <h4 class="card-title">Edit Question</h4>
                    <p class="card-description"> Please enter the question details. </p>

                    <form class="forms-sample" action="index.php?page=feedback&a=adminfeedbackedit&id=<?php echo $_GET['id']; ?>" method="POST">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Form Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="question" maxlength="200" value="<?php if (isset($_POST['question'])){ echo $_POST['question']; }else { echo QUESTIONNAME($_GET['id']); } ?>" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="text-center">
                        <input type="hidden" class="form-control" name="id" value="<?php if (isset($_GET['id'])){ echo $_GET['id']; } ?>" />
                        <button type="submit" class="btn btn-md me-2 text-white" style="background-color: #40826D;">Update</button>
                        <a href="index.php?page=feedback&a=adminfeedback" class="btn btn-gradient-light btn-md me-2">Cancel</a>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-2 grid-margin stretch-card"></div>

            </div>
          </div>

          
            