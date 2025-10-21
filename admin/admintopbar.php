      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background-color: #40826D;">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background-color: #40826D;">
          <div class="d-flex flex-column align-items-center justify-content-center">
            <img src="models/img/NWSSU.png" alt="NWSSU Logo" style="height: 60px; margin-bottom: 5px;">
            <h5 style="color: #fff; font-size: 14px; font-weight: bold; margin: 0;">ASBAO</h5>
          </div>
        </div>

        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <ul class="navbar-nav navbar-nav-left">
            <li class="nav-item nav-settings d-none d-lg-block text-white">
              <?php
                if (isset($_SESSION['USERCODE']) && isset($_SESSION['FIRSTNAME']) && isset($_SESSION['LASTNAME']) && isset($_SESSION['ROLE'])) {
                  echo "<b>Auxiliary Services and Business Affairs Office Venue Reservation</b>";
                }
              ?>
            </li>
          </ul>

          <!--
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search">
              </div>
            </form>
          </div> -->



          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="<?php if(isset($_SESSION['USERCODE'])){ echo PROFILEPATH($_SESSION['USERCODE']); } ?>" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-white">
                    <?php
                      if (isset($_SESSION['USERCODE']) && isset($_SESSION['FIRSTNAME']) && isset($_SESSION['LASTNAME']) && isset($_SESSION['ROLE'])) {
                        echo $_SESSION['FIRSTNAME'];
                      }
                      else{
                        ?>
                          <script type="text/javascript">
                            window.location.href = 'index.php?a=login';
                          </script>
                        <?php
                      }
                    ?>
                  </p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="index.php?page=home&a=adminprofilepicture">
                  <i class="mdi mdi-account-box me-2 text-success"></i> Edit Picture
                </a>
                <a class="dropdown-item" href="index.php?page=home&a=adminprofile">
                  <i class="mdi mdi-account me-2 text-success"></i> Profile Info
                </a>
                <a class="dropdown-item logout" href="javascript:void(0)">
                  <i class="mdi mdi-logout me-2 text-success"></i> Log out
                </a>
              </div>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-format-line-spacing"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>

