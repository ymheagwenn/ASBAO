        <style>
          /* Ensure content isn't hidden behind fixed footer */
          .content-wrapper { padding-bottom: 100px; }

          @media (max-width: 768px) {
            .page-header {
              flex-direction: column;
              align-items: flex-start !important;
            }
            .page-header-actions {
              margin-top: 10px;
              width: 100%;
            }
            .page-header-actions .btn {
              width: 100%;
            }
            .form-group label {
              font-size: 14px;
            }
            .card-title {
              font-size: 18px;
            }
            /* Make buttons and form controls more tappable */
            .forms-sample .btn { width: 100%; margin-bottom: 10px; }
            .forms-sample .form-control { font-size: 16px; }
            /* Stack columns nicely */
            .grid-margin { margin-bottom: 1rem; }
            /* Responsive avatar */
            .user-edit-avatar { width: 120px !important; height: 120px !important; }
          }
        </style>

        <div class="main-panel">
          <div class="content-wrapper" style="background-color: #D6F6D5;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-success text-white me-2">
                  <i class="mdi mdi-account-edit"></i>
                </span> Edit Profile Information
              </h3>
            </div>

            <?php
              // Handle form submission
              if (isset($_POST['update_profile'])) {
                $usercode = trim($_POST['usercode']);
                $firstname = trim($_POST['firstname']);
                $middlename = trim($_POST['middlename']);
                $lastname = trim($_POST['lastname']);
                $gender = trim($_POST['gender']);
                $contact = trim($_POST['contact']);
                $address = trim($_POST['address']);
                $email = trim($_POST['email']);

                // Basic validation
                $errors = array();
                
                if (empty($firstname)) {
                  $errors[] = "First name is required";
                }
                if (empty($lastname)) {
                  $errors[] = "Last name is required";
                }
                if (empty($email)) {
                  $errors[] = "Email is required";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  $errors[] = "Invalid email format";
                }
                if (empty($contact)) {
                  $errors[] = "Contact number is required";
                }
                if (empty($address)) {
                  $errors[] = "Address is required";
                }

                // Check if email already exists for another user
                if (empty($errors)) {
                  $check_email = mysqli_query($conn, "SELECT * FROM tbl_users WHERE EMAIL = '$email' AND USERCODE != '$usercode'");
                  if (mysqli_num_rows($check_email) > 0) {
                    $errors[] = "Email already exists for another user";
                  }
                }

                if (empty($errors)) {
                  // Update user profile
                  $sql = "UPDATE tbl_users SET 
                          FIRSTNAME = '$firstname',
                          MIDDLENAME = '$middlename',
                          LASTNAME = '$lastname',
                          GENDER = '$gender',
                          CONTACT = '$contact',
                          ADDRESS = '$address',
                          EMAIL = '$email'
                          WHERE USERCODE = '$usercode'";

                  if (mysqli_query($conn, $sql)) {
                    // Update session variables
                    $_SESSION['FIRSTNAME'] = $firstname;
                    $_SESSION['LASTNAME'] = $lastname;
                    $_SESSION['EMAIL'] = $email;
                    
                    ?>
                      <script type="text/javascript">
                        Swal.fire(
                          'Updated!',
                          'Profile updated successfully!',
                          'success'
                        ).then((result) => {
                          window.location = "index.php?page=home&a=usermain";
                        });
                      </script>
                    <?php
                  } else {
                    ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Failed to update profile. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php
                  }
                } else {
                  // Display validation errors
                  ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Please fix the following errors:</strong>
                      <ul class="mb-0 mt-2">
                        <?php foreach ($errors as $error): ?>
                          <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                      </ul>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php
                }
              }
            ?>

            <div class="row">
              <div class="col-lg-8 col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Personal Information</h4>
                    <p class="card-description">Update your personal details below</p>

                    <form class="forms-sample" action="index.php?page=home&a=usereditprofile" method="POST">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="firstname">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="firstname" name="firstname" 
                                   value="<?php echo USERFIRSTNAME($_SESSION['USERCODE']); ?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="middlename">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename" 
                                   value="<?php echo USERMIDDLENAME($_SESSION['USERCODE']); ?>">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="lastname">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lastname" name="lastname" 
                                   value="<?php echo USERLASTNAME($_SESSION['USERCODE']); ?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                              <option value="Male" <?php echo (USERGENDER($_SESSION['USERCODE']) == 'Male') ? 'selected' : ''; ?>>Male</option>
                              <option value="Female" <?php echo (USERGENDER($_SESSION['USERCODE']) == 'Female') ? 'selected' : ''; ?>>Female</option>
                              <option value="Other" <?php echo (USERGENDER($_SESSION['USERCODE']) == 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?php echo USEREMAIL($_SESSION['USERCODE']); ?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="contact">Contact Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="contact" name="contact" 
                                   value="<?php echo USERCONTACT($_SESSION['USERCODE']); ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo USERADDRESS($_SESSION['USERCODE']); ?></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control" value="<?php echo USERROLE($_SESSION['USERCODE']); ?>" readonly>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control" value="<?php echo USERSTATUS($_SESSION['USERCODE']); ?>" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-md-12 text-center">
                          <input type="hidden" name="usercode" value="<?php echo $_SESSION['USERCODE']; ?>">
                          <button type="submit" name="update_profile" class="btn btn-success me-2">
                            <i class="mdi mdi-content-save"></i> Update Profile
                          </button>
                          <a href="index.php?page=home&a=usermain" class="btn btn-light">
                            <i class="mdi mdi-close"></i> Cancel
                          </a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body text-center">
                    <h4 class="card-title">Profile Picture</h4>
                    <div class="mb-3">
                    <img src="<?php echo PROFILEPATH($_SESSION['USERCODE']); ?>" 
                         alt="Profile Picture" class="rounded-circle user-edit-avatar" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <p class="text-muted">Update your profile picture</p>
                    <a href="index.php?page=home&a=userprofilepicture" class="btn btn-outline-primary">
                      <i class="mdi mdi-camera"></i> Change Picture
                    </a>
                  </div>
                </div>

                <div class="card mt-3">
                  <div class="card-body text-center">
                    <h4 class="card-title">Security</h4>
                    <p class="text-muted">Change your password</p>
                    <a href="index.php?page=home&a=userchangepass" class="btn btn-outline-warning">
                      <i class="mdi mdi-lock-outline"></i> Change Password
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
