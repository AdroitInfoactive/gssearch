<!--====== Footer PART START ======-->
<?php
require_once('settings.php');
?>
<footer class="footer_area bg_cover mt-60"
  style="background-image: url(<?php echo $rtpth; ?>assets/images/footer_bg.jpg)">
  <div class="footer_copyright">
    <div class="container">
      <div class="footer_copyright_wrapper text-center d-md-flex justify-content-between">
        <div class="copyright">
          <p>Website Developed by Adroit</p>
        </div>
        <div class="copyright">
          <p>&copy; Copyrights 2023 GS Search All rights reserved. </p>
        </div>
      </div>
    </div>
  </div>
</footer>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4>Login</h4>
        </div>
        <div class="d-flex flex-column text-center">
          <form name="frm_lgn" id="frm_lgn" enctype="multipart/form-data" method="POST" action=""
            onsubmit="return performCheck('frm_lgn', lgnrules,'inline')">
            <div class="form-group">
              <input type="text" class="form-control" id="txtemail" name="txtemail" placeholder="Email Address*">
              <span id="errorsDiv_txtemail" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="txtpswd" name="txtpswd" placeholder="Password*">
              <span id="errorsDiv_txtpswd" style="color: orangered;"></span>
            </div>
            <!-- <button type="button" class="btn btn-info btn-block btn-round">Login</button> -->
            <input type="submit" name="btnsbmt_lgn" id="btnsbmt_lgn" value="Login"
              class="btn btn-info btn-block btn-round" />
          </form>
          <div class="text-center text-muted delimiter">or use a Google Account</div>
          <button type="button" class="login-with-google-btn">Login with Google</button>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">Not a member yet? <a href="" data-toggle="modal" data-target="#registerModal"
            data-dismiss="modal" class="text-info">Register</a>.</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4>Register</h4>
        </div>
        <div class="d-flex flex-column text-center">
          <form name="frm_rgstr" id="frm_rgstr" enctype="multipart/form-data" method="POST" action=""
            onsubmit="return performCheck('frm_rgstr', rgstrrules,'inline')">
            <div class="form-group">
              <input type="text" class="form-control" id="txtname_rgstr" name="txtname_rgstr" placeholder="Full Name*">
              <span id="errorsDiv_txtname_rgstr" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="txtemail_rgstr" name="txtemail_rgstr"
                placeholder="Email Address*">
              <span id="errorsDiv_txtemail_rgstr" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="txtpswd_rgstr" name="txtpswd_rgstr"
                placeholder="Password*">
              <span id="errorsDiv_txtpswd_rgstr" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="txtcnfpswd_rgstr" name="txtcnfpswd_rgstr"
                placeholder="Confirm Password*">
              <span id="errorsDiv_txtcnfpswd_rgstr" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="txtphn_rgstr" name="txtphn_rgstr" placeholder="Mobile Number">
            </div>
            <!-- <button type="button" class="btn btn-info btn-block btn-round">Login</button> -->
            <input type="submit" name="btnsbmt_rgstr" id="btnsbmt_rgstr" value="Register"
              class="btn btn-info btn-block btn-round" />
          </form>
          <div class="text-center text-muted delimiter">or use a Google Account</div>
          <a class="login-with-google-btn"
            href="<?= 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>"><i
              class="fab fa-google-plus-g"></i> Register with Google</a>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">Already a member? <a href="#" data-toggle="modal" data-target="#loginModal"
            data-dismiss="modal" class="text-info"> Login</a>.</div>
      </div>
    </div>
  </div>
</div>
<!--====== Footer PART ENDS ======-->
<!--====== BACK TOP TOP PART START ======-->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<!--====== BACK TOP TOP PART ENDS ======-->
<!--====== jquery js ======-->
<script src="<?php echo $rtpth; ?>assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="<?php echo $rtpth; ?>assets/js/vendor/jquery-1.12.4.min.js"></script>
<!--====== Bootstrap js ======-->
<script src="<?php echo $rtpth; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $rtpth; ?>assets/js/popper.min.js"></script>
<!--====== Slick js ======-->
<script src="<?php echo $rtpth; ?>assets/js/slick.min.js"></script>
<!--====== Magnific Popup js ======-->
<script src="<?php echo $rtpth; ?>assets/js/jquery.magnific-popup.min.js"></script>
<!--====== Counter Up js ======-->
<script src="<?php echo $rtpth; ?>assets/js/waypoints.min.js"></script>
<script src="<?php echo $rtpth; ?>assets/js/jquery.counterup.min.js"></script>
<!--====== Nice Select js ======-->
<script src="<?php echo $rtpth; ?>assets/js/jquery.nice-select.min.js"></script>
<!--====== Count Down js ======-->
<script src="<?php echo $rtpth; ?>assets/js/jquery.countdown.min.js"></script>
<!--====== Appear js ======-->
<script src="<?php echo $rtpth; ?>assets/js/jquery.appear.min.js"></script>
<!--====== Main js ======-->
<script src="<?php echo $rtpth; ?>assets/js/main.js"></script>
<!--====== jquery js ======-->
<script src="<?php echo $rtpth; ?>assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="<?php echo $rtpth; ?>assets/js/vendor/jquery-1.12.4.min.js"></script>
<!--====== Bootstrap js ======-->
<script src="<?php echo $rtpth; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo $rtpth; ?>assets/js/popper.min.js"></script>
<!--====== Slick js ======-->
<script src="<?php echo $rtpth; ?>assets/js/slick.min.js"></script>
<!--====== Magnific Popup js ======-->
<script src="<?php echo $rtpth; ?>assets/js/jquery.magnific-popup.min.js"></script>
<!--====== Ajax Contact js ======-->
<script src="<?php echo $rtpth; ?>assets/js/ajax-contact.html"></script>
<!--====== Counter Up js ======-->
<script src="<?php echo $rtpth; ?>assets/js/waypoints.min.js"></script>
<script src="<?php echo $rtpth; ?>assets/js/jquery.counterup.min.js"></script>
<!--====== Nice Select js ======-->
<script src="<?php echo $rtpth; ?>assets/js/jquery.nice-select.min.js"></script>
<!--====== Count Down js ======-->
<script src="<?php echo $rtpth; ?>assets/js/jquery.countdown.min.js"></script>
<!--====== Appear js ======-->
<script src="<?php echo $rtpth; ?>assets/js/jquery.appear.min.js"></script>
<!--====== Main js ======-->
<script src="<?php echo $rtpth; ?>assets/js/main.js"></script>
<script src="<?php echo $rtpth; ?>includes/yav.js" type="text/javascript"></script>
<script src="<?php echo $rtpth; ?>includes/yav-config.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function () {

    $('.js-btn-tooltip').tooltip();
    $('.js-btn-tooltip--custom').tooltip({
      customClass: 'tooltip-custom'
    });
    $('.js-btn-tooltip--custom-alt').tooltip({
      customClass: 'tooltip-custom-alt'
    });
  });
  var lgnrules = new Array();
  lgnrules[0] = 'txtemail|required|Enter Your Email';
  lgnrules[1] = 'txtemail|email|Enter Email Id only';
  lgnrules[2] = 'txtpswd|required|Enter Password';
  var rgstrrules = new Array();
  rgstrrules[0] = 'txtemail_rgstr|required|Enter Your Email';
  rgstrrules[1] = 'txtemail_rgstr|email|Enter Email Id only';
  rgstrrules[2] = 'txtname_rgstr|required|Enter Name';
  rgstrrules[3] = 'txtpswd_rgstr|required|Enter Password';
  rgstrrules[4] = 'txtcnfpswd_rgstr|required|Enter Confirm Password';
  rgstrrules[5] = 'txtcnfpswd_rgstr|equal|$txtpswd_rgstr|Password not match';
</script>
</body>
<!-- Mirrored from raistheme.com/html/GS Search/GS Search/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Aug 2023 19:13:08 GMT -->

</html>