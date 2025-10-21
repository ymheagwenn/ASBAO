<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ASBAO - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="models/img/NWSSU.png" rel="icon">
  <link href="models/img/NWSSU.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="models/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="models/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="models/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="models/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="models/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- Template Main CSS File -->
  <link href="models/css/style.css" rel="stylesheet">
  <link href="models/css/preloader.css" rel="stylesheet">
  <script src="assets/js/jquery.js"></script>

  <style type="text/css">
      *{
         font-family: Arial, Helvetica, sans-serif;
         font-size: 14px;
      }

      .timeline {
          border-left: 3px solid #727cf5;
          border-bottom-right-radius: 4px;
          border-top-right-radius: 4px;
          background: rgba(114, 124, 245, 0.09);
          margin: 0 auto;
          letter-spacing: 0.2px;
          position: relative;
          line-height: 1.4em;
          font-size: 1.03em;
          padding: 50px;
          list-style: none;
          text-align: left;
          max-width: 40%;
      }

      @media (max-width: 767px) {
          .timeline {
              max-width: 98%;
              padding: 25px;
          }
      }

      .timeline h1 {
          font-weight: 300;
          font-size: 1.4em;
      }

      .timeline h2,
      .timeline h3 {
          font-weight: 600;
          font-size: 1rem;
          margin-bottom: 10px;
      }

      .timeline .event {
          border-bottom: 3px dashed #e8ebf1;
          padding-bottom: 25px;
          margin-bottom: 25px;
          position: relative;
      }

      @media (max-width: 767px) {
          .timeline .event {
              padding-top: 30px;
          }
      }

      .timeline .event:last-of-type {
          padding-bottom: 0;
          margin-bottom: 0;
          border: none;
      }

      .timeline .event:before,
      .timeline .event:after {
          position: absolute;
          display: block;
          top: 0;
      }

      .timeline .event:before {
          left: -207px;
          content: attr(data-date);
          text-align: right;
          font-weight: 100;
          font-size: 0.9em;
          min-width: 120px;
      }

      @media (max-width: 767px) {
          .timeline .event:before {
              left: 0px;
              text-align: left;
          }
      }

      .timeline .event:after {
          -webkit-box-shadow: 0 0 0 3px #727cf5;
          box-shadow: 0 0 0 3px #727cf5;
          left: -55.8px;
          background: #fff;
          border-radius: 50%;
          height: 9px;
          width: 9px;
          content: "";
          top: 5px;
      }

      .timeline #active:after {
          background: #727cf5;
      }

      @media (max-width: 767px) {
          .timeline .event:after {
              left: -31.8px;
          }
      }

      .rtl .timeline {
          border-left: 0;
          text-align: right;
          border-bottom-right-radius: 0;
          border-top-right-radius: 0;
          border-bottom-left-radius: 4px;
          border-top-left-radius: 4px;
          border-right: 3px solid #727cf5;
      }

      .rtl .timeline .event::before {
          left: 0;
          right: -170px;
      }

      .rtl .timeline .event::after {
          left: 0;
          right: -55.8px;
      }

      header.masthead {
        padding-top: 10.5rem;
        padding-bottom: 6rem;
        text-align: center;
        color: #fff;
        background-image: url("models/img/main-bg.png");
        background-repeat: no-repeat;
        background-attachment: scroll;
        background-position: center center;
        background-size: cover;
      }
      header.masthead .masthead-subheading {
        font-size: 1.5rem;
        font-style: italic;
        line-height: 1.5rem;
        margin-bottom: 25px;
        font-family: "Roboto Slab", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      }
      header.masthead .masthead-heading {
        font-size: 3.25rem;
        font-weight: 700;
        line-height: 3.25rem;
        margin-bottom: 2rem;
        font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      }

      @media (min-width: 768px) {
        header.masthead {
          padding-top: 17rem;
          padding-bottom: 12.5rem;
        }
        header.masthead .masthead-subheading {
          font-size: 2.25rem;
          font-style: italic;
          line-height: 2.25rem;
          margin-bottom: 2rem;
        }
        header.masthead .masthead-heading {
          font-size: 4.5rem;
          font-weight: 700;
          line-height: 4.5rem;
          margin-bottom: 4rem;
        }
      }

      .team-member {
        margin-bottom: 3rem;
        text-align: center;
      }
      .team-member img {
        width: 10rem;
        height: 10rem;
        border: 0.5rem solid rgba(0, 0, 0, 0.1);
      }
      .team-member h4, .team-member .h4 {
        margin-top: 1.5rem;
        margin-bottom: 0;
      }
   </style>
</head>

<body>
  <div class="loader-container">
    <div class="loader"></div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center" style="background-color: #40826D;">
    <div class="container d-flex align-items-center">
      <div class="logo me-auto">
        <a href="index.php"><img src="models/img/NWSSU.png" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar order-last order-sm-0" style="background-color: #40826D;">
        <ul style="background-color: #40826D;">
          <li><a class="nav-link text-white" href="index.php?a=login" style="font-weight: normal;">Login</a></li>
          <li><a class="nav-link text-white" href="index.php?a=register" style="font-weight: normal;">Signup</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle text-white"></i>
      </nav>
    </div>
  </header>

  <header class="masthead">
    <div class="container">
      <div class="masthead-heading"></div>
      <div class="masthead-subheading text-uppercase"></div><br><br><br><br><br><br><br>
      <a class="btn btn-danger btn-xl text-uppercase" style="background-color: #FF5733;" href="index.php?a=register">Find and Book Now</a>
      <div class="masthead-heading"></div>
    </div>
  </header>

  <section class="page-section bg-light" id="team">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">Our Venues</h2>
        <h3 class="section-subheading text-muted"><br></h3>
      </div>
      <div class="row">
        <?php
            date_default_timezone_set('Asia/Manila');
            $today = date('Y-m-d');
            $ctr = 0;
            $sql = mysqli_query($conn,"SELECT * FROM tbl_category WHERE STATUS = 'Active' ORDER BY CATEGORYNAME ASC");
            if (mysqli_num_rows($sql) > 0) {
              while ($info = mysqli_fetch_array($sql)){
                ?>
                  <div class="col-md-3">
                      <div class="team-member">
                        <a href="index.php?a=register">
                          <img class="mx-auto rounded-circle" src="<?php if (trim(CATEGORYPATH($info['CATEGORYCODE'])) == ''){ echo 'models/img/unavailable.jpg'; }else{ echo CATEGORYPATH($info['CATEGORYCODE']); } ?>" alt="..." />
                          <h4 style="color: #40826D; font-weight: bold;"><?php echo $info['CATEGORYNAME']; ?></h4><br>
                          <p class="text-dark"><?php echo $info['DESCRIPTION']; ?></p>
                        </a>
                      </div>
                  </div>
                <?php
              }
            }
          ?>
                    
      </div>
      
      <div class="row">
        <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">...</p></div>
      </div>
    </div>
  </section>


  <footer id="footer" style="background-color: #40826D;">
    <div class="container d-md-flex py-4">
      <div class="me-md-auto text-center text-md-start">
        <div class="copyright text-white">
          Copyright © Auxiliary Services and Business Affairs Office Venue Reservation <?php echo date('Y'); ?>
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="background-color: #40826D;"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="models/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="models/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="models/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="models/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="models/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="models/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="models/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="models/js/main.js"></script>

  <script>
    $(window).on("load",function(){
        $(".loader-container").fadeOut(1000);
    });
  </script>
</body>

</html>