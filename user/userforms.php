        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-download"></i>
                </span> Download Forms
              </h3>
            </div>
            
            <div class="row">  
                  <div class="table-responsive">
                    <table class="table table-striped" style="width:100%">
                      <thead>
                        <tr class="text-white" style="background-color: #FF5733;">
                          <th width="5%"> # </th>
                          <th width="40%" class="text-center"> File Name </th>
                          <th width="10%"> Status </th>
                          <th width="20%" class="text-center"> Action </th>
                          <th width="2%"> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $count = 1;
                          $sql = mysqli_query($conn,"SELECT * FROM tbl_forms WHERE STATUS = 'Active' ORDER BY ID ASC LIMIT 100");
                          if (mysqli_num_rows($sql) > 0) {
                            while ($info = mysqli_fetch_array($sql)){
                              ?>
                              <tr>
                                <td class="text-right">
                                  <?php echo $count++;  ?>
                                </td>
                                <td class="text-center">
                                  <?php echo $info['FILENAME']; ?>
                                </td>
                                <td class="py-1">
                                  <?php echo $info['STATUS']; ?>
                                </td>
                                <td class="py-1 text-center" >
                                  <a class="btn btn-success btn-sm" target="_blank" href="<?php echo $info['FILEPATH']; ?>"> Download </a>
                                </td>
                                <td>
                                  <?php
                                    if ($info['STATUS'] != 'Active') {                                 
                                      echo '<i class="mdi mdi-brightness-1 text-danger"></i>';
                                    }
                                  ?>
                                </td>
                              </tr>
                              <?php
                            }
                          }
                          else{
                            ?>
                            <tr>
                              <td colspan="6">
                                <br><br><br><br>
                                <div class="col-12 text-center">
                                  <p class="text-dark" style='font-size: 15px;'>There was no forms.</p>
                                </div>
                                <br><br><br>
                              </td>
                            </tr>
                            <?php
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
            </div>
          </div>
            