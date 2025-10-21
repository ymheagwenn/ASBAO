        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon text-white me-2" style="background-color: #FF5733;">
                  <i class="mdi mdi-file"></i>
                </span> Manage Rate Question
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item" aria-current="page" style="font-weight: normal;">
                    <a href="index.php?page=feedback&a=adminfeedbackadd" style="text-decoration: none; padding: 8px;" class="btn-dark text-white">
                      <i class="mdi mdi-plus icon-sm align-middle"></i>
                      <span></span>&nbsp; Add Question
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
                    <table class="table table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th width="5%"> # </th>
                          <th width="40%"> Questions </th>
                          <th width="10%" class="text-center"> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $count = 1;
                          $sql = mysqli_query($conn,"SELECT * FROM questions ORDER BY id ASC");
                          if (mysqli_num_rows($sql) > 0) {
                            while ($info = mysqli_fetch_array($sql)){
                              ?>
                              <tr>
                                <td class="text-right">
                                  <?php echo $count++;  ?>
                                </td>
                                <td class="py-1">
                                  <?php echo $info['question_text']; ?>
                                </td>
                                <td class="text-center">
                                  <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"> Manage </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="index.php?page=feedback&a=adminfeedbackedit&id=<?php echo $info['id']; ?>">Edit</a>
                                      <div class="dropdown-divider"></div>
                                      <form action="admin/admindelete.php" method="POST" onsubmit="return confirm('Delete this question?');">
                                        <input type="hidden" name="deletequestionid" value="<?php echo $info['id']; ?>">
                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                      </form>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <?php
                            }
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
            