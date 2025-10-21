        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-wall"></i>
                </span> Venues
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item" aria-current="page" style="font-weight: normal;">
                    <a href="index.php?page=category&a=admincategoryadd" style="text-decoration: none; padding: 8px;" class="btn-dark text-white">
                      <i class="mdi mdi-plus icon-sm align-middle"></i>
                      <span></span>&nbsp; Add Venue
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            
            <div class="row">  
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped" id="dtCategory " style="width:100%">
                      <thead>
                        <tr>
                          <th width="8%"> # </th>
                          <th width="15%" class="text-center"> Category Name </th>
                          <th width="20%" class="text-left"> Venue Name </th>
                          <th width="40%"> Description </th>
                          <th width="5%" class="text-center"> Action </th>
                          <th width="2%"> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $count = 1;
                          $sql = mysqli_query($conn,"SELECT * FROM tbl_category ORDER BY CATEGORYNAME ASC LIMIT 100");
                          if (mysqli_num_rows($sql) > 0) {
                            while ($info = mysqli_fetch_array($sql)){
                              ?>
                              <tr>
                                <td class="text-right">
                                  <?php echo $count++;  ?>
                                </td>
                                <td class="text-center">
                                  <?php echo $info['CATEGORYVENUE']; ?>
                                </td>
                                <td class="text-left">
                                  <?php echo $info['CATEGORYNAME']; ?>
                                </td>
                                <td class="py-1" style="width: 100px; text-overflow: ellipsis; overflow: hidden; white-space: normal; line-height: 1.3em;">
                                  <?php echo $info['DESCRIPTION']; ?>
                                </td>
                                <td class="text-center">
                                  <a href="index.php?page=category&a=admincategoryedit&categorycode=<?php echo $info['CATEGORYCODE']; ?>" class="text-primary" style="text-decoration: none;">Edit Venue</a>
                                  |
                                  <a href="index.php?page=category&a=admincategoryupload&categorycode=<?php echo $info['CATEGORYCODE']; ?>" class="text-secondary" style="text-decoration: none;">Cover Picture</a>
                                  |
                                  <form action="admin/admindelete.php" method="POST" onsubmit="return confirm('Delete this venue?');" style="display:inline;">
                                    <input type="hidden" name="deletecategorycode" value="<?php echo $info['CATEGORYCODE']; ?>">
                                    <button type="submit" class="text-danger" style="background: transparent; border: 0; padding: 0;">Delete</button>
                                  </form>
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
                              <td colspan="5">
                                <br><br><br><br>
                                <div class="col-12 text-center">
                                  <p class="text-dark" style='font-size: 15px;'>There was no category records.</p>
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
              </div>
            </div>
          </div>
            