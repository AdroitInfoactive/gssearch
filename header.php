<?php
error_reporting(0);
session_start();
$servr_ip = $_SERVER['SERVER_ADDR'];
include_once 'includes/inc_config.php'; //Making paging validation	
include_once $inc_user_cnctn; //Making database Connection
include_once $inc_user_usr_fnctn; //checking for session	
include_once $inc_user_fldr_pth;
include_once $rtpth."script.php";
include_once $rtpth."includes/inc_fnct_ajax_validation.php";
if (isset($_POST['btnsbmt_lgn']) && (trim($_POST['btnsbmt_lgn']) == 'Login') && isset($_POST['txtpswd']) && (trim($_POST['txtpswd']) != '') && isset($_POST['txtemail']) && (trim($_POST['txtemail']) != '')) {
  include_once "database/sqry_mbr_mst.php";
}
if (isset($_POST['btnsbmt_rgstr']) && (trim($_POST['btnsbmt_rgstr']) == 'Register') && isset($_POST['txtemail_rgstr']) && (trim($_POST['txtemail_rgstr']) != '') && isset($_POST['txtpswd_rgstr']) && (trim($_POST['txtpswd_rgstr']) != '') && isset($_POST['txtcnfpswd_rgstr']) && (trim($_POST['txtcnfpswd_rgstr']) != '')) {
  // write new code to check the login
  include_once "database/iqry_mbr_mst.php";
}
?>
<!doctype html>
<html lang="en">

<head>
  <!--====== Required meta tags ======-->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    <?php if (isset($page_seo_title) && !empty($page_seo_title))
      echo $page_seo_title; ?>
  </title>
  <?php if (isset($db_seodesc) && isset($db_seokywrd)) { ?>
    <meta name="description" content="<?php echo $db_seodesc; ?>">
    <meta name="keywords" content="<?php echo $db_seokywrd; ?>">
  <?php } ?>
  <!--====== Bootstrap css ======-->
  <link rel="stylesheet" href="<?php echo $rtpth; ?>assets/css/bootstrap.min.css">
  <!--====== Animate css ======-->
  <link rel="stylesheet" href="<?php echo $rtpth; ?>assets/css/animate.css">
  <!--====== Fontawesome css ======-->
  <link rel="stylesheet" href="<?php echo $rtpth; ?>assets/css/font-awesome.min.css">
  <!--====== Magnific Popup css ======-->
  <link rel="stylesheet" href="<?php echo $rtpth; ?>assets/css/magnific-popup.css">
  <!--====== Nice Select css ======-->
  <link rel="stylesheet" href="<?php echo $rtpth; ?>assets/css/nice-select.css">
  <!--====== Slick css ======-->
  <link rel="stylesheet" href="<?php echo $rtpth; ?>assets/css/slick.css">
  <!--====== Default css ======-->
  <link rel="stylesheet" href="<?php echo $rtpth; ?>assets/css/default.css">
  <!--====== Style css ======-->
  <link rel="stylesheet" href="<?php echo $rtpth; ?>assets/css/style.css">
  <!--====== Responsive css ======-->
  <link rel="stylesheet" href="<?php echo $rtpth; ?>assets/css/responsive.css">
  <?php
  if ($servr_ip != "127.0.0.1") { ?>
    <script>
      document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
      });
      document.addEventListener('keydown', function (e) {
        if (e.key === 'F12' || e.keyCode === 123) {
          e.preventDefault();
        }
      });
    </script>
    <?php
  }
  ?>
</head>

<body>
  <!--====== PRELOADER PART START ======-->
  <!-- <div id="preloader">
    <div class="preloader">
      <span></span>
      <span></span>
    </div>
  </div> -->
  <!--====== PRELOADER PART ENDS ======-->
  <!--====== Header Desktop PART START ======-->
  <section class="header_area header_area_2 d-none d-lg-block">
    <div class="container">
      <div class="header_top_wrapper_2 d-flex justify-content-between">
        <div class="header_top_info d-none d-md-block">
          <ul>
            <li><img src="<?php echo $rtpth; ?>assets/images/call-2.png" alt="call"><a href="#">+91 12345 67890</a></li>
            <li><img src="<?php echo $rtpth; ?>assets/images/mail-2.png" alt="mail"><a href="#">info@gssearch.in</a>
            </li>
          </ul>
        </div>
        <div class="header_menu_3">
          <ul class="main_menu">
            <li>
              <a href="<?php echo $rtpth; ?>home">Home </a>
            </li>
            <li>
              <a href="#">About Us</a>
            </li>
            <li>
              <a href="<?php echo $rtpth; ?>exam-categories">Practice Zone </a>
            </li>
            <!-- <li>
              <a href="#">Gallery </a>
            </li> -->
            <li>
              <a href="#">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="header_bottom_wrapper">
        <div class="row align-items-center">
          <div class="col-lg-3">
            <div class="logo">
              <a href="<?php echo $rtpth; ?>home"><img src="<?php echo $rtpth; ?>assets/images/logo.png" alt="logo"></a>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="header_search">
              <input type="text" placeholder="Search">
              <button><i class="fa fa-search"></i></button>
            </div>
          </div>
          <?php
          if ($_SESSION['sesmbrid'] == '') { ?>
            <div class="col-lg-4">
              <div class="header_bottom_login">
                <ul>
                  <li><a href="" data-toggle="modal" data-target="#registerModal">Create An Account</a></li>
                  <li>
                    <!-- <button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#loginModal"> Login </button> -->
                    <a class="main-btn" data-toggle="modal" data-target="#loginModal"><i class="fa fa-user-o"></i>
                      Login</a>
                  </li>
                </ul>
              </div>
            </div>
            <?php
          } else { ?>
            <ul class="topLinks" id="userMenu">
              <li class="dropdown show"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                  aria-expanded="true">
                  Welcome, <span class="user">
                    <?php echo $_SESSION['sesmbrname']; ?>
                  </span></span><i class="fa fa-user" style="color:#aa8c2c"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right show" role="menu" x-placement="bottom-end"
                  style="position: absolute; transform: translate3d(-134px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <li><a href="<?php echo $rtpth; ?>my-account">My Account</a>
                  </li>
                  <li><a href="<?php echo $rtpth; ?>change-password">Change
                      Password</a></li>
              </li>
              <li><a href="<?php echo $rtpth; ?>logout">Logout</a></li>
            </ul>
            </li>
            </ul>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </section>
  <!--====== Header Desktop PART ENDS ======-->
  <!--====== Header Mobile PART START ======-->
  <section class="header_area header_area_2 d-lg-none">
    <div class="header_top">
      <div class="container">
        <div class="header_top_wrapper d-flex justify-content-center justify-content-md-between">
          <div class="header_top_info d-none d-md-block">
            <ul>
              <li><img src="<?php echo $rtpth; ?>assets/images/call-2.png" alt="call"><a href="#">+91 12345 67890</a>
              </li>
              <li><img src="<?php echo $rtpth; ?>assets/images/mail-2.png" alt="mail"><a href="#">info@gssearch.in</a>
              </li>
            </ul>
          </div>
          <div class="header_top_login">
            <ul>
              <li><a href="#">Create An Account</a></li>
              <li><a class="main-btn" href="#"><i class="fa fa-user-o"></i>Log In</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="header_menu  header_mobile">
      <div class="container">
        <nav class="navbar navbar-expand-lg header_mobile_bg">
          <a class="navbar-brand" href="<?php echo $rtpth; ?>home">
            <img src="<?php echo $rtpth; ?>assets/images/logo.png" alt="logo">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-icon"></span>
            <span class="toggler-icon"></span>
            <span class="toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">
              <li>
                <a href="<?php echo $rtpth; ?>home">Home </a>
              </li>
              <li>
                <a href="#">About Us</a>
              </li>
              <li>
                <a href="<?php echo $rtpth; ?>exam-categories">Practice Zone </a>
              </li>
              <!-- <li>
                <a href="#">Gallery </a>
              </li> -->
              <li>
                <a href="#">Contact Us</a>
              </li>
            </ul>
          </div>
          <div class="navbar_meta">
            <ul>
              <li>
                <a id="search" href="#"><img src="<?php echo $rtpth; ?>assets/images/search-2.png" alt="search"></a>
                <div class="search_bar">
                  <input type="text" placeholder="Search">
                  <button><i class="fa fa-search"></i></button>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </section>
  <!--====== Header Mobile PART ENDS ======-->

  <!--  <section class="header_area header_area_2 d-lg-none">
    <div class="header_top">
      <div class="container">
        <div class="header_top_wrapper d-flex justify-content-center justify-content-md-between">
          <div class="header_top_info d-none d-md-block">
            <ul>
              <li><img src="<?php echo $rtpth; ?>assets/images/call-2.png" alt="call"><a href="#">+91 12345 67890</a>
              </li>
              <li><img src="<?php echo $rtpth; ?>assets/images/mail-2.png" alt="mail"><a href="#">info@gssearch.in</a>
              </li>
            </ul>
          </div>
          <div class="header_top_login">
            <ul>
              <li><a href="#">Create An Account</a></li>
              <li><a class="main-btn" href="#"><i class="fa fa-user-o"></i> Log In</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="header_menu  header_mobile">
      <div class="container">
        <nav class="navbar navbar-expand-lg header_mobile_bg">
          <a class="navbar-brand" href="index-3.html">
            <img src="<?php echo $rtpth; ?>assets/images/logo.png" alt="logo">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-icon"></span>
            <span class="toggler-icon"></span>
            <span class="toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">
              <li>
                <a href="#">Home </a>
              </li>
              <li>
                <a href="#">About Us</a>
              </li>
              <li>
                <a href="#">Practice Zone </a>
              </li>
              <li>
                <a href="#">Gallery </a>
              </li>
              <li>
                <a href="#">Contact Us</a>
              </li>
            </ul>
          </div>
          <div class="navbar_meta">
            <ul>
              <li>
                <a id="search" href="#"><img src="<?php echo $rtpth; ?>assets/images/search-2.png" alt="search"></a>
                <div class="search_bar">
                  <input type="text" placeholder="Search">
                  <button><i class="fa fa-search"></i></button>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </section> -->