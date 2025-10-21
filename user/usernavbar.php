      <div class="container-fluid page-body-wrapper">  
        <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #40826D;">
          <ul class="nav">
            <li class="nav-item nav-profile" style="background-color: #40826D;">
              <br>
              <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <span class="navbar-brand brand-logo"><img src="models/img/NWSSU.png" alt="logo" width="50%" />
                  <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2 text-white">ASBAO</span>
                  </div>
                </span>
              </div>
              <hr>
            </li>
            <li class="nav-item nav-profile" style="background-color: #40826D;">
              <a href="index.php?page=home&a=usermain" class="nav-link">
                <div class="nav-profile-image">
                  <img src="<?php if(isset($_SESSION['USERCODE'])){ echo PROFILEPATH($_SESSION['USERCODE']); } ?>" alt="profile" width="50%">
                  <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2 text-white">
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
            </li>
            <?php
              if ($_SESSION['ROLE'] == 'Client') {
                ?>
                <li class="nav-item" <?php echo PAGEDASHBOARD(); ?>>
                  <a class="nav-link" href="index.php?page=home&a=userdashboard">
                    <span class="menu-title" <?php echo PAGEACTIVEDASHBOARD(); ?>>Dashboard</span>
                    <i class="mdi mdi-home menu-icon" <?php echo PAGEACTIVEDASHBOARD(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGEFORMS(); ?>>
                  <a class="nav-link" href="index.php?page=forms&a=userforms">
                    <span class="menu-title" <?php echo PAGEACTIVEFORMS(); ?>>Forms</span>
                    <i class="mdi mdi-download menu-icon" <?php echo PAGEACTIVEFORMS(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGEHISTORY(); ?>>
                  <a class="nav-link" href="index.php?page=history&a=userhistory">
                    <span class="menu-title" <?php echo PAGEACTIVEHISTORY(); ?>>Appointment History</span>
                    <i class="mdi mdi-history menu-icon" <?php echo PAGEACTIVEHISTORY(); ?>></i>
                  </a>
                </li>
                <li class="nav-item" <?php echo PAGEFEEDBACK(); ?>>
                  <a class="nav-link" href="index.php?page=home&a=userfeedback">
                    <span class="menu-title d-flex align-items-center" <?php echo PAGEACTIVEFEEDBACK(); ?>>
                      Feedback
                    </span>
                    <i class="mdi mdi-comment-text menu-icon" <?php echo PAGEACTIVEFEEDBACK(); ?>></i>
                  </a>
                </li>
                <?php
              }
            ?>
          </ul>
        </nav>


<?php
  /***********************     PAGE SELECTED     ***********************/

  function PAGEDASHBOARD(){
    // Don't highlight Dashboard when on Feedback page
    if ($_GET['page'] == 'home' && (!isset($_GET['a']) || $_GET['a'] != 'userfeedback')) {
      echo 'style="background-color: #FF5733;"'; //BFF4BE  198450
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

  function PAGEHISTORY(){
    if ($_GET['page'] == 'history') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  function PAGEFEEDBACK(){
    if (isset($_GET['a']) && $_GET['a'] == 'userfeedback') {
      echo 'style="background-color: #FF5733;"';
    }
    else{
      echo 'style="background-color: #40826D;"';
    }
  }

  /***********************     PAGE ACTIVE     ***********************/

  function PAGEACTIVEDASHBOARD(){
    if ($_GET['page'] == 'home') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  function PAGEACTIVEFORMS(){
    if ($_GET['page'] == 'forms') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }


  function PAGEACTIVEHISTORY(){
    if ($_GET['page'] == 'history') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }

  function PAGEACTIVEFEEDBACK(){
    if (isset($_GET['a']) && $_GET['a'] == 'userfeedback') {
      echo 'style="color: #ffffff;"';
    }
    else{
      echo 'style="color: #ffffff;"';
    }
  }
?>