        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-success text-white me-2">
                  <i class="mdi mdi-account"></i>
                </span> Profile Information
              </h3>
              <div class="page-header-actions">
                <a href="index.php?page=home&a=usereditprofile" class="btn btn-success">
                  <i class="mdi mdi-account-edit"></i> Edit Profile
                </a>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Full Name</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" value="<?php echo MAINFULLNAME($_SESSION['USERCODE']); ?>" readonly />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Gender</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" value="<?php echo USERGENDER($_SESSION['USERCODE']); ?>" readonly />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" value="<?php echo USEREMAIL($_SESSION['USERCODE']); ?>" readonly />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" value="<?php echo USERSTATUS($_SESSION['USERCODE']); ?>" readonly />
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Contact</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" value="<?php echo USERCONTACT($_SESSION['USERCODE']); ?>" readonly />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Address</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" value="<?php echo USERADDRESS($_SESSION['USERCODE']); ?>" readonly />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" value="<?php echo USERROLE($_SESSION['USERCODE']); ?>" readonly />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Profile Picture</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" value="<?php echo USERPICTURE($_SESSION['USERCODE']); ?>" readonly />
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>