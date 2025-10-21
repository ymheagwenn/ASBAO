      <div class="container-fluid page-body-wrapper">  
        <style>
          body.sidebar-icon-only .sidebar .menu-title { display: none !important; }
          body.sidebar-icon-only .sidebar .nav .nav-item .nav-link { justify-content: center; }
        </style>
        <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #40826D;">
          <ul class="nav">
            <li class="nav-item nav-profile" style="background-color: #40826D;">
              <a href="index.php?page=home&a=adminprofile" class="nav-link">
                <div class="nav-profile-image">
                  <img src="<?php if(isset($_SESSION['USERCODE'])){ echo PROFILEPATH($_SESSION['USERCODE']); } ?>" alt="profile" width="50%">
                  <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold text-white mb-2">
                    <?php
                      if (isset($_SESSION['USERCODE']) && isset($_SESSION['FIRSTNAME']) && isset($_SESSION['LASTNAME']) && isset($_SESSION['ROLE'])) {
                        echo $_SESSION['FIRSTNAME'] ." ". $_SESSION['LASTNAME'];
                      }
                      else{
                        ?>
                          <script type="text/javascript">
                            window.location.href = 'index.php?a=login';
                          </script>
                        <?php
                      }
                    ?>
                  </span>
                  <span class="text-white text-small">
                    <?php
                      if (isset($_SESSION['USERCODE']) && isset($_SESSION['FIRSTNAME']) && isset($_SESSION['LASTNAME']) && isset($_SESSION['ROLE'])) {
                        echo $_SESSION['ROLE'];
                      }
                      else{
                        ?>
                          <script type="text/javascript">
                            window.location.href = 'index.php?a=login';
                          </script>
                        <?php
                      }
                    ?>
                  </span>
                </div>
                <!-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> -->
              </a>
              <hr>
            </li>
            <?php
              if ($_SESSION['ROLE'] == 'Admin') {
                ?>
                <li class="nav-item" <?php echo PAGEDASHBOARD(); ?>>
                  <a class="nav-link" href="index.php?page=dashboard&a=admindashboard" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                    <span class="menu-title" <?php echo PAGEACTIVEDASHBOARD(); ?>>Dashboard</span>
                    <i class="mdi mdi-home menu-icon" <?php echo PAGEACTIVEDASHBOARD(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGEAPPOINTMENT(); ?>>
                  <a class="nav-link" href="index.php?page=appointment&a=adminappointment" data-bs-toggle="tooltip" data-bs-placement="right" title="Appointments">
                    <span class="menu-title" <?php echo PAGEACTIVEAPPOINTMENT(); ?>>Appointments</span>
                    <i class="mdi mdi-timetable menu-icon" <?php echo PAGEACTIVEAPPOINTMENT(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGECATEGORY(); ?>>
                  <a class="nav-link" href="index.php?page=category&a=admincategory" data-bs-toggle="tooltip" data-bs-placement="right" title="Venues">
                    <span class="menu-title" <?php echo PAGEACTIVECATEGORY(); ?>>Venues</span>
                    <i class="mdi mdi-wall menu-icon" <?php echo PAGEACTIVECATEGORY(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGEFORMS(); ?>>
                  <a class="nav-link" href="index.php?page=forms&a=adminforms" data-bs-toggle="tooltip" data-bs-placement="right" title="Forms">
                    <span class="menu-title" <?php echo PAGEACTIVEFORMS(); ?>>Forms</span>
                    <i class="mdi mdi-file menu-icon" <?php echo PAGEACTIVEFORMS(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGEDEPARTMENT(); ?>>
                  <a class="nav-link" href="index.php?page=department&a=admindepartment" data-bs-toggle="tooltip" data-bs-placement="right" title="Department">
                    <span class="menu-title" <?php echo PAGEACTIVEDEPARTMENT(); ?>>Department</span>
                    <i class="mdi mdi-school menu-icon" <?php echo PAGEACTIVEDEPARTMENT(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGESCHEDULE(); ?>>
                  <a class="nav-link" href="index.php?page=schedule&a=adminschedule" data-bs-toggle="tooltip" data-bs-placement="right" title="Schedule">
                    <span class="menu-title" <?php echo PAGEACTIVESCHEDULE(); ?>>Schedule</span>
                    <i class="mdi mdi-clock menu-icon" <?php echo PAGEACTIVESCHEDULE(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGEHOLIDAY(); ?>>
                  <a class="nav-link" href="index.php?page=holiday&a=adminholiday" data-bs-toggle="tooltip" data-bs-placement="right" title="Holiday">
                    <span class="menu-title" <?php echo PAGEACTIVEHOLIDAY(); ?>>Holiday</span>
                    <i class="mdi mdi-calendar menu-icon" <?php echo PAGEACTIVEHOLIDAY(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGEFEEDBACK(); ?>>
                  <a class="nav-link" href="index.php?page=feedback&a=adminfeedback" data-bs-toggle="tooltip" data-bs-placement="right" title="Questions">
                    <span class="menu-title" <?php echo PAGEACTIVEFEEDBACK(); ?>>Questions</span>
                    <i class="mdi mdi-file menu-icon" <?php echo PAGEACTIVEFEEDBACK(); ?>></i>
                  </a>
                </li>
                
                <li class="nav-item sidebar-actions">
                  <span class="nav-link">
                    <div class="border-bottom">
                      <h6 class="font-weight-normal mb-3 text-light">Settings</h6>
                    </div>
                    <li class="nav-item" <?php echo PAGEUSER(); ?>>
                      <a class="nav-link" href="index.php?page=users&a=adminuser" data-bs-toggle="tooltip" data-bs-placement="right" title="Users">
                        <span class="menu-title" <?php echo PAGEACTIVEUSER(); ?>>Users</span>
                        <i class="mdi mdi-account-circle menu-icon" <?php echo PAGEACTIVEUSER(); ?>></i>
                      </a>
                    </li>
                    <li class="nav-item" <?php echo PAGEREPORT(); ?>>
                      <a class="nav-link" href="index.php?page=report&a=adminreport" data-bs-toggle="tooltip" data-bs-placement="right" title="Reports">
                        <span class="menu-title" <?php echo PAGEACTIVEREPORT(); ?>>Reports</span>
                        <i class="mdi mdi-printer menu-icon" <?php echo PAGEACTIVEREPORT(); ?>></i>
                      </a>
                    </li>
                  </span>
                </li>
                <?php
              }
              elseif ($_SESSION['ROLE'] == 'Staff'){
                ?>
                <li class="nav-item" <?php echo PAGEDASHBOARD(); ?>>
                  <a class="nav-link" href="index.php?page=dashboard&a=admindashboard">
                    <span class="menu-title" <?php echo PAGEACTIVEDASHBOARD(); ?>>Dashboard</span>
                    <i class="mdi mdi-home menu-icon" <?php echo PAGEACTIVEDASHBOARD(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGEAPPOINTMENT(); ?>>
                  <a class="nav-link" href="index.php?page=appointment&a=adminappointment">
                    <span class="menu-title" <?php echo PAGEACTIVEAPPOINTMENT(); ?>>Appointments</span>
                    <i class="mdi mdi-timetable menu-icon" <?php echo PAGEACTIVEAPPOINTMENT(); ?>></i>
                  </a>
                </li>
                <li class="nav-item sidebar-actions">
                  <span class="nav-link">
                    <div class="border-bottom">
                      <h6 class="font-weight-normal mb-3">Settings</h6>
                    </div>
                    <li class="nav-item" <?php echo PAGECATEGORY(); ?>>
                      <a class="nav-link" href="index.php?page=category&a=admincategory">
                        <span class="menu-title" <?php echo PAGEACTIVECATEGORY(); ?>>Venues</span>
                        <i class="mdi mdi-wall menu-icon" <?php echo PAGEACTIVECATEGORY(); ?>></i>
                      </a>
                    </li>
                    <li class="nav-item" <?php echo PAGEFORMS(); ?>>
                      <a class="nav-link" href="index.php?page=forms&a=adminforms">
                        <span class="menu-title" <?php echo PAGEACTIVEFORMS(); ?>>Forms</span>
                        <i class="mdi mdi-file menu-icon" <?php echo PAGEACTIVEFORMS(); ?>></i>
                      </a>
                    </li>
                    <li class="nav-item" <?php echo PAGEDEPARTMENT(); ?>>
                      <a class="nav-link" href="index.php?page=department&a=admindepartment">
                        <span class="menu-title" <?php echo PAGEACTIVEDEPARTMENT(); ?>>Department</span>
                        <i class="mdi mdi-school menu-icon" <?php echo PAGEACTIVEDEPARTMENT(); ?>></i>
                      </a>
                    </li>
                    <li class="nav-item" <?php echo PAGESCHEDULE(); ?>>
                      <a class="nav-link" href="index.php?page=schedule&a=adminschedule">
                        <span class="menu-title" <?php echo PAGEACTIVESCHEDULE(); ?>>Schedule</span>
                        <i class="mdi mdi-clock menu-icon" <?php echo PAGEACTIVESCHEDULE(); ?>></i>
                      </a>
                    </li>
                    <li class="nav-item" <?php echo PAGEHOLIDAY(); ?>>
                      <a class="nav-link" href="index.php?page=holiday&a=adminholiday">
                        <span class="menu-title" <?php echo PAGEACTIVEHOLIDAY(); ?>>Holiday</span>
                        <i class="mdi mdi-calendar menu-icon" <?php echo PAGEACTIVEHOLIDAY(); ?>></i>
                      </a>
                    </li>
                    <li class="nav-item" <?php echo PAGEFEEDBACK(); ?>>
                      <a class="nav-link" href="index.php?page=feedback&a=adminfeedback">
                        <span class="menu-title" <?php echo PAGEACTIVEFEEDBACK(); ?>>Questions</span>
                        <i class="mdi mdi-file menu-icon" <?php echo PAGEACTIVEFEEDBACK(); ?>></i>
                      </a>
                    </li>
                    
                  </span>
                </li>
                <?php
              }
            ?>
          </ul>
        </nav>


<?php
  /***********************     PAGE SELECTED     ***********************/

  function PAGEDASHBOARD(){
    if ($_GET['page'] == 'dashboard') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  function PAGEAPPOINTMENT(){
    if ($_GET['page'] == 'item') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  function PAGECATEGORY(){
    if ($_GET['page'] == 'category') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  function PAGEFORMS(){
    if ($_GET['page'] == 'forms') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  function PAGEDEPARTMENT(){
    if ($_GET['page'] == 'department') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  function PAGESCHEDULE(){
    if ($_GET['page'] == 'schedule') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  function PAGEHOLIDAY(){
    if ($_GET['page'] == 'holiday') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  function PAGEFEEDBACK(){
    if ($_GET['page'] == 'feedback' && $_GET['a'] == 'adminfeedback') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  

  function PAGEUSER(){
    if ($_GET['page'] == 'users') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  function PAGEREPORT(){
    if ($_GET['page'] == 'report') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  /***********************     PAGE ACTIVE     ***********************/

  function PAGEACTIVEDASHBOARD(){
    if ($_GET['page'] == 'dashboard') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  function PAGEACTIVEAPPOINTMENT(){
    if ($_GET['page'] == 'appointment') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  function PAGEACTIVECATEGORY(){
    if ($_GET['page'] == 'category') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  function PAGEACTIVEFORMS(){
    if ($_GET['page'] == 'department') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  function PAGEACTIVEDEPARTMENT(){
    if ($_GET['page'] == 'department') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  function PAGEACTIVESCHEDULE(){
    if ($_GET['page'] == 'schedule') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  function PAGEACTIVEHOLIDAY(){
    if ($_GET['page'] == 'holiday') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  function PAGEACTIVEFEEDBACK(){
    if ($_GET['page'] == 'feedback' && $_GET['a'] == 'adminfeedback') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  

  function PAGEACTIVEUSER(){
    if ($_GET['page'] == 'users') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  function PAGEACTIVEREPORT(){
    if ($_GET['page'] == 'report') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }
?>