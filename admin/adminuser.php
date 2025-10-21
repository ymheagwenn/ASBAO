        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-account-circle"></i>
                </span> Users
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item" aria-current="page">
                    <a href="index.php?page=users&a=adminuseradd" style="text-decoration: none; padding: 8px;" class="btn-dark text-white">
                      <i class="mdi mdi-account-plus icon-sm align-middle"></i>
                      <span></span>&nbsp; Add User
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
                    <table class="table table-striped" id="dtUser">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th width="40%"> Fullname </th>
                          <th width="15%"> Gender </th>
                          <th width="20%"> Role </th>
                          <th width="10%"> Status </th>
                          <th width="10%" class="text-center"> Action </th>
                          <th width="2%"> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $count = 1;
                          $sql = mysqli_query($conn,"SELECT * FROM tbl_users ORDER BY FIRSTNAME ASC LIMIT 500");
                          if (mysqli_num_rows($sql) > 0) {
                            while ($info = mysqli_fetch_array($sql)){
                              ?>
                              <tr>
                                <td>
                                  <?php echo $count++;  ?>
                                </td>
                                <td class="py-1">
                                  <?php
                                    if ($info['PROFILE'] == 'No Image') {
                                      echo '<img src="assets/images/icons/profile.png" alt="image" />';
                                    }
                                    else{
                                      echo '<img src="'.$info['PROFILE'].'" alt="image" />';
                                    }
                                  ?>
                                  &nbsp;
                                  <?php echo $info['FIRSTNAME'] ." ". $info['LASTNAME']; ?>
                                </td>
                                <td>
                                  <?php echo $info['GENDER']; ?>
                                </td>
                                <td>
                                  <?php echo $info['ROLE']; ?>
                                </td>
                                <td>
                                  <?php if ($info['STATUS'] == 'Active') { ?>
                                    <span class="badge bg-success text-white">Active</span>
                                  <?php } else { ?>
                                    <span class="badge bg-danger text-white">Inactive</span>
                                  <?php } ?>
                                </td>
                                <td class="text-center">
                                  <a href="index.php?page=users&a=adminuseredit&usercode=<?php echo $info['USERCODE']; ?>" style="text-decoration: none;">
                                    <button class="btn btn-success btn-rounded btn-icon" style="width: 26px; height: 26px;">
                                      <i class="mdi mdi-pencil"></i>
                                    </button>
                                  </a>

                                  <?php
                                  	if ($info['ROLE'] == 'Admin'){
                                  		?>
                                  			&nbsp;
			                                <button class="btn btn-white btn-rounded btn-icon" disabled style="width: 26px; height: 26px;">
                                              
                                      </button>
                                  		<?php
                                  	}
                                  	else{
                                  		?>
                                  			&nbsp;
			                                <input type="hidden" class="deleteuserid" value="<?php echo $info['ID']; ?>">
			                                <input type="hidden" class="deleteusercode" value="<?php echo $info['USERCODE']; ?>">

			                                <a href="javascript:void(0)" style="text-decoration: none;" class="deleteuser">
			                                    <button class="btn btn-danger btn-rounded btn-icon" style="width: 26px; height: 26px;">
			                                        <i class="mdi mdi-delete"></i>
			                                    </button>
			                                </a>
                                  		<?php
                                  	}
                                  ?>
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
                                <div class="row text-center">
                                  <p class="text-dark" style='font-size: 15px;'>There was no user records.</p>
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

          
            