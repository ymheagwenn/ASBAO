        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-clock"></i>
                </span> Manage Department
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item" aria-current="page" style="font-weight: normal;">
                    <a href="index.php?page=department&a=admindepartmentadd" style="text-decoration: none; padding: 8px;" class="btn-dark text-white">
                      <i class="mdi mdi-plus icon-sm align-middle"></i>
                      <span></span>&nbsp; Add Department
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
                    <table class="table table-striped" id="dtDepartment" style="width:100%">
                      <thead>
                        <tr>
                          <th width="5%"> # </th>
                          <th width="30%" class="text-center"> Department Name </th>
                          <th width="40%"> Description </th>
                          <th width="10%" class="text-center"> Action </th>
                          <th width="2%"> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $count = 1;
                          $sql = mysqli_query($conn,"SELECT * FROM tbl_department ORDER BY DEPARTMENTNAME ASC LIMIT 100");
                          if (mysqli_num_rows($sql) > 0) {
                            while ($info = mysqli_fetch_array($sql)){
                              ?>
                              <tr>
                                <td class="text-right">
                                  <?php echo $count++;  ?>
                                </td>
                                <td class="text-center">
                                  <?php echo $info['DEPARTMENTNAME']; ?>
                                </td>
                                <td class="py-1">
                                  <?php echo $info['DESCRIPTION']; ?>
                                </td>
                                <td class="text-center">
                                  <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"> Manage </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="index.php?page=department&a=admindepartmentedit&departmentcode=<?php echo $info['DEPARTMENTCODE']; ?>">Edit</a>
                                      <div class="dropdown-divider"></div>
                                      <form action="admin/admindelete.php" method="POST" onsubmit="return confirm('Delete this department?');">
                                        <input type="hidden" name="deletedepartmentcode" value="<?php echo $info['DEPARTMENTCODE']; ?>">
                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                      </form>
                                    </div>
                                  </div>
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
                              <td colspan="4">
                                <br><br><br><br>
                                <div class="col-12 text-center">
                                  <p class="text-dark" style='font-size: 15px;'>There was no department records.</p>
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
            