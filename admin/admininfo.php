        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">

              <?php
                if (isset($_POST['phone']) &&
                    isset($_POST['email']) &&
                    isset($_POST['address']) &&
                    isset($_POST['service'])){

                    if (empty(trim($_POST['phone'])) ||
                        empty(trim($_POST['email']))  ||
                        empty(trim($_POST['address']))  ||
                        empty(trim($_POST['service']))) {

                        ?>
                          <div class="row text-center">
                            <p class="text-danger" style='font-size: 15px;'>One of the required field is empty or contains invalid data, please check your input!</p>
                          </div>
                        <?php
                    }
                    else{

                      $servicecode = str_replace("'", "", trim($_POST['servicecode']));
                      $phone = str_replace("'", "", trim($_POST['phone']));
                      $email = str_replace("'", "", strtolower(trim($_POST['email'])));
                      $address = str_replace("'", "", trim($_POST['address']));
                      $service = str_replace("'", "", trim($_POST['service']));

                      if (isset($_POST['save'])) {
                        $sql = "INSERT INTO tbl_services(SERVICECODE, PHONE, EMAIL, ADDRESS, SERVICES) VALUES('$servicecode','$phone','$email','$address','$service')";
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
                              window.location = "index.php?page=info&a=admininfo";
                            });
                          </script>
                        <?php
                      }
                      elseif (isset($_POST['update'])) {
                        $sqlservice = mysqli_query($conn, "SELECT * FROM tbl_services WHERE PHONE ='$phone' AND EMAIL ='$email' AND ADDRESS ='$address' AND SERVICES ='$service'");
                        if (mysqli_num_rows($sqlservice) > 0){
                            $info = mysqli_fetch_array($sqlservice);

                            ?>
                              <div class="row text-center">
                                <p class="text-danger" style='font-size: 15px;'>Service info has been already recorded!</p>
                              </div>
                            <?php

                        }
                        else{
                          $sql = "UPDATE tbl_services SET PHONE='$phone', EMAIL='$email', ADDRESS='$address', SERVICES='$service' WHERE SERVICECODE = '$servicecode'";
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
                                window.location = "index.php?page=info&a=admininfo";
                              });
                            </script>
                          <?php
                        }
                      }
                    }
                }
            ?>

            <?php
              $sql = mysqli_query($conn, "SELECT * FROM tbl_services WHERE SERVICECODE ='101010'");
              if (mysqli_num_rows($sql) > 0){
                $info = mysqli_fetch_array($sql);

                ?>
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Services Info</h4><br>

                        <form class="forms-sample" action="index.php?page=info&a=admininfo" method="POST">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="phone" maxlength="50" value="<?php if (isset($_POST['phone'])){ echo $_POST['phone']; }else { echo $info['PHONE']; } ?>" />
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="email" maxlength="100" value="<?php if (isset($_POST['email'])){ echo $_POST['email']; }else { echo $info['EMAIL']; } ?>" />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                  
                                  <textarea style="line-height: 1.6em;" name="address" maxlength="200" class="form-control" id="exampleTextarea1" rows="4"><?php if (isset($_POST['address'])){ echo $_POST['address']; }else { echo $info['ADDRESS']; } ?></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Services <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                  
                                  <textarea style="line-height: 1.6em;" name="service" maxlength="500" class="form-control" id="exampleTextarea1" rows="4"><?php if (isset($_POST['service'])){ echo $_POST['service']; }else { echo $info['SERVICES']; } ?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>

                          <p class="text-center">
                            <input type="hidden" class="form-control" name="servicecode" value="101010" />
                            <button type="submit" class="btn btn-info btn-md me-2" name="update">Update</button>
                          </p>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php
              }
              else{
                ?>
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Services Info</h4><br>

                        <form class="forms-sample" action="index.php?page=info&a=admininfo" method="POST">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="phone" maxlength="50" value="<?php if (isset($_POST['phone'])){ echo $_POST['phone']; } ?>" />
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="email" maxlength="100" value="<?php if (isset($_POST['email'])){ echo $_POST['email']; } ?>" />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                  
                                  <textarea style="line-height: 1.6em;" name="address" maxlength="200" class="form-control" id="exampleTextarea1" rows="4"><?php if (isset($_POST['address'])){ echo $_POST['address']; } ?></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Services <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                  
                                  <textarea style="line-height: 1.6em;" name="service" maxlength="500" class="form-control" rows="4"><?php if (isset($_POST['service'])){ echo $_POST['service']; } ?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>

                          <p class="text-center">
                            <input type="hidden" class="form-control" name="servicecode" value="101010" />
                            <button type="submit" class="btn btn-info btn-md me-2" name="save">Save</button>
                          </p>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php
              }
            ?>

            </div>
          </div>
            