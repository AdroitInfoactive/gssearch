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

<div class="modal fade" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="subscribeModalLabel"
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
          <h4 class="text-danger">OOPS..!</h4>
          <p class="bg-primary p-3 mt-3 text-white">You have reached your free searches limit or your subscription
            expired.</p>
        </div>
        <div class="d-flex flex-column text-center">
          <p>Please subscribe to continue searching. </p>
          <?php
          $sqry_sub_amt = "SELECT subscrptnm_amt_id,subscrptnm_amt_name from subscrptn_amt_mst where subscrptnm_amt_sts = 'a' order by subscrptnm_amt_id limit 1";
          $srs_sub_amt = mysqli_query($conn, $sqry_sub_amt);
          $srow_sub_amt = mysqli_fetch_array($srs_sub_amt);
          $sub_id = $srow_sub_amt['subscrptnm_amt_id'];
          $sub_amt = $srow_sub_amt['subscrptnm_amt_name'];
          ?>
          <h4 class="text-primary"><i class="fa fa-rupee"></i>
            <?php echo $sub_amt; ?>/- per year
          </h4>
          <form name="frm_subs" id="frm_subs" enctype="multipart/form-data" method="POST"
            action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <input type="hidden" name="hdn_mbrsub_id" id="hdn_mbrsub_id" value="<?php echo $membrid; ?>" />
              <input type="hidden" name="hdn_sub_amt_id" id="hdn_sub_amt_id" value="<?php echo $sub_id; ?>" />
              <input type="hidden" name="hdn_sub_amt" id="hdn_sub_amt" value="<?php echo $sub_amt; ?>" />
            </div>
            <!-- <div class="form-group">
              <input type="text" class="form-control" id="txtemail" name="txtemail" placeholder="Email Address*">
              <span id="errorsDiv_txtemail" style="color: orangered;"></span>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="txtpswd" name="txtpswd" placeholder="Password*">
          <span id="errorsDiv_txtpswd" style="color: orangered;"></span>
        </div> -->
            <!-- <button type="button" class="main-btn">Login</button> -->
            <input type="submit" name="btnsbmt_subs" id="btnsbmt_subs" value="Continue to payment" class="main-btn" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ------------------------------------------------------------------------------------- -->
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
          <form name="frm_lgn" id="frm_lgn" enctype="multipart/form-data" method="POST"
            action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return performCheck('frm_lgn', lgnrules,'inline')">
            <div class="form-group">
              <input type="text" class="form-control" id="txtemail" name="txtemail" placeholder="Email Address*">
              <span id="errorsDiv_txtemail" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="txtpswd" name="txtpswd" placeholder="Password*">
              <span id="errorsDiv_txtpswd" style="color: orangered;"></span>
            </div>
            <!-- <button type="button" class="main-btn">Login</button> -->
            <input type="submit" name="btnsbmt_lgn" id="btnsbmt_lgn" value="Login" class="main-btn" />
          </form>
          <div class="text-center text-muted delimiter">or use a Google Account</div>
          <a class="login-with-google-btn"
            href="<?= 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>"><i
              class="fab fa-google-plus-g"></i> Login / Register with Google</a>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">Not a member yet? <a href="" data-toggle="modal" data-target="#registerModal"
            data-dismiss="modal" class="text-info">Register</a>.</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="chngpwdModal" tabindex="-1" role="dialog" aria-labelledby="chngpwdModalLabel"
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
          <h4>Change Password</h4>
        </div>
        <div class="d-flex flex-column text-center">
          <form name="frm_chng_pwd" id="frm_chng_pwd" enctype="multipart/form-data" method="POST" action=""
            onsubmit="return performCheck('frm_chng_pwd', chng_pwdrules,'inline')">
            <input type="hidden" name="hdn_mbr_id" id="hdn_mbr_id" value="<?php echo $membrid; ?>" />
            <div class="form-group">
              <input type="text" class="form-control" id="txtchngpwd_email" name="txtchngpwd_email"
                placeholder="Email Address*" value="<?php echo $membremail; ?>" disabled style="cursor: not-allowed;">
              <span id="errorsDiv_txtchngpwd_email" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="txtchngpwd_oldpswd" name="txtchngpwd_oldpswd"
                placeholder="Old Password*">
              <span id="errorsDiv_txtchngpwd_oldpswd" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="txtchngpwd_nwpswd" name="txtchngpwd_nwpswd"
                placeholder="New Password*">
              <span id="errorsDiv_txtchngpwd_nwpswd" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="txtchngpwd_nwcnfpswd" name="txtchngpwd_nwcnfpswd"
                placeholder="New Password*">
              <span id="errorsDiv_txtchngpwd_nwcnfpswd" style="color: orangered;"></span>
            </div>
            <!-- <button type="button" class="main-btn">Login</button> -->
            <input type="submit" name="btnsbmt_chng_pwd" id="btnsbmt_chng_pwd" value="Submit" class="main-btn" />
          </form>
          <!-- <div class="text-center text-muted delimiter">or use a Google Account</div>
          <button type="button" class="login-with-google-btn">Login with Google</button> -->
        </div>
      </div>
      <!-- <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">Not a member yet? <a href="" data-toggle="modal" data-target="#registerModal"
            data-dismiss="modal" class="text-info">Register</a>.</div>
      </div> -->
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
            <!-- <button type="button" class="main-btn">Login</button> -->
            <input type="submit" name="btnsbmt_rgstr" id="btnsbmt_rgstr" value="Register" class="main-btn" />
          </form>
          <div class="text-center text-muted delimiter">or use a Google Account</div>
          <a class="login-with-google-btn"
            href="<?= 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>"><i
              class="fab fa-google-plus-g"></i> Register / Login with Google</a>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <div class="signup-section">Already a member? <a href="#" data-toggle="modal" data-target="#subscribeModal"
            data-dismiss="modal" class="text-info"> Login</a>.</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="shareProduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ps-popup--select">
    <div class="modal-content">
      <div class="modal-body">
        <div class="wrap-modal-slider container-fluid">
          <button class="close ps-popup__close" type="button" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <div class="ps-popup__body">
            <h3 class="ps-popup__title">Share</h3>
            <div class="ps-product__social d-flex justify-content-center">
              <ul class="ps-social ps-social--color social" id="sclshare">
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<button id="open_add_wsh" style="display: none">Open Modal</button>
<div class="modal fade" id="add_wsh" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ps-popup--select">
    <div class="modal-content">
      <div class="modal-body">
        <div class="wrap-modal-slider container-fluid">
          <button class="close ps-popup__close" type="button" data-dismiss="modal" aria-label="Close"
            id="bkmrk_cls"><span aria-hidden="true">&times;</span></button>
          <div class="ps-popup__body">
            <h3 class="ps-popup__title">Bookmark</h3>
            <div class="ps-product__social d-flex justify-content-center">
              <p id="bkmrk_msg"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- start edit user details -->
<div class="modal fade" id="editusrDetail" tabindex="-1" role="dialog" aria-labelledby="editusrDetailLabel"
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
          <h4>Edit Details</h4>
        </div>
        <div class="d-flex flex-column text-center">
          <form name="frm_mbr_dtl" id="frm_mbr_dtl" enctype="multipart/form-data" method="POST" action=""
            onsubmit="return performCheck('frm_mbr_dtl', edit_details,'inline')">
            <input type="hidden" name="hdn_mbr_id" id="hdn_mbr_id" value="<?php echo $membrid; ?>" />
            <input type="hidden" name="hdn_mbr_email" id="hdn_mbr_email" value="<?php echo $email; ?>" />
            <div class="form-group">
              <input type="text" class="form-control" id="edttxtemail" name="edttxtemail" placeholder="Email Address*"
                value="<?php echo $membremail; ?>" disabled style="cursor: not-allowed;">
              <span id="errorsDiv_edttxtemail" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="edttxtname" name="edttxtname" placeholder="Enter Name*"
                value="<?php echo $name; ?>" />
              <span id="errorsDiv_edttxtname" style="color: orangered;"></span>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="edttxtmobile" name="edttxtmobile"
                placeholder="Enter Mobile Number*" value="<?php echo $mobile; ?>" />
              <span id="errorsDiv_edttxtmobile" style="color: orangered;"></span>
            </div>
            <input type="submit" name="btnsbmt_edt_dtl" id="btnsbmt_edt_dtl" value="Submit" class="main-btn" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end edit user details -->
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


<script src="<?php echo $rtpth; ?>includes/yav.js" type="text/javascript"></script>
<script src="<?php echo $rtpth; ?>includes/yav-config.js" type="text/javascript"></script>




<script type="text/javascript">
  function remvbkmrkqns(bokmark_id, crtactn) {
    var confirmation = confirm("Are you sure you want to remove this question from bookmarks?");
    if (confirmation) {
      $.ajax({
        url: `<?php echo $rtpth; ?>manage_bookmark.php?bokmark_id=${bokmark_id}&bokaction=${crtactn}`,
        type: "GET",
        success: function (data) {
          if (data == "yes") {
            document.getElementById("bkmrk_msg").innerHTML = "Question Removed from Bookmark";
          } else {
            document.getElementById("bkmrk_msg").innerHTML = "Something went wrong. Please try again later.";
          }
          mod = "add_wsh";
          document.getElementById(mod).classList.add("show");
          document.getElementById(mod).style.display = "block";
          setTimeout(function () {
            document.getElementById(mod).classList.remove("show");
            document.getElementById(mod).style.display = "none";
            location.reload();
          }, 3000);
          preventDefault();
        }
      });
    }
  }
  function frmprdsub(qns_id, crtactn) {
    mbr_id = '<?php echo $membrid; ?>';
    if (mbr_id == "") {
      alert("Please login to Bookmark");
      $('#loginModal').modal('show');
    }
    else {
      $.ajax({
        url: `<?php echo $rtpth; ?>manage_bookmark.php?qnsid=${qns_id}&action=${crtactn}`,
        type: "GET",
        success: function (data) {
          mod = "add_wsh";
          if (data == "y") {
            document.getElementById("bkmrk_msg").innerHTML = "Question Added to Bookmark";
          }
          if (data == "n") {
            document.getElementById("bkmrk_msg").innerHTML = "Something Went Wrong. Please try again later";
          }
          if (data == "a") {
            document.getElementById("bkmrk_msg").innerHTML = "Already added to Bookmark";
          }
          document.getElementById(mod).classList.add("show");
          document.getElementById(mod).style.display = "block";
          setTimeout(function () {
            document.getElementById(mod).classList.remove("show");
            document.getElementById(mod).style.display = "none";
          }, 3000);
          preventDefault();
        }
      });
    }
  }
  var closeButton = document.getElementById('bkmrk_cls'); // Replace 'closeButton' with your close button's ID
  closeButton.addEventListener('click', function () {
    document.getElementById(mod).classList.remove('show');
    document.getElementById(mod).style.display = 'none';
  });
  function srch(substs) {
    txtsrchval = document.frmserqtn.txtsrchval.value;
    if (txtsrchval == "") {
      alert("Please Enter Search criteria");
      document.frmserqtn.txtsrchval.focus();
      event.preventDefault();
      return false;
    }
    if (txtsrchval != "") {
      var srchid = document.frmserqtn.txtsrchval.value;
      srchtxt = srchid.replace(/ /g, "-");
      if (substs == '') {
        alert("Please Login to enable search...");
        $('#loginModal').modal('show');
        event.preventDefault();
        return false;
      }
      if (substs == 'n') {
        // get searches count from database
        $.ajax({
          url: `<?php echo $rtpth; ?>get_srchs_cnt.php?srchtxt=${srchtxt}`,
          type: 'GET',
          success: function (data) {
            // alert(data);
            if (data == "y") {
              document.frmserqtn.action = "<?php echo $rtpth; ?>search?text=" + srchtxt;
              document.frmserqtn.submit();
            } else {
              $('#subscribeModal').modal('show');
              // alert("Please subscribe to get full search access");
              event.preventDefault();
              return false;
            }
          }
        });
      } else {
        document.frmserqtn.action = "<?php echo $rtpth; ?>search?text=" + srchtxt;
        document.frmserqtn.submit();
      }
      event.preventDefault();
    }
  }
  function show_ans(sno, optnid, qtnid) {
    $.ajax({
      url: `<?php echo $rtpth; ?>get_ans.php?sno=${sno}&optnid=${optnid}&qtnid=${qtnid}`,
      type: 'GET',
      success: function (data) {
        var data_arr = data.split("<-->");
        var crct_ans = data_arr[0];
        var expl = data_arr[1];
        if (Number(optnid) == Number(crct_ans)) {
          $('#crct' + sno).css('display', 'block');
          $('#wrng' + sno).css('display', 'none');
        } else {
          $('#crct' + sno).css('display', 'none');
          $('#wrng' + sno).css('display', 'block');
        }
        if (expl != '') {
          expl_cntnt = '<h4 class="courses_details_title">Explanation</h4><p style="text-align: left;">' + expl + '</p >';
          $('#explnbx_' + sno).html(expl_cntnt);
          $('#explnbx_' + sno).css('display', 'block');
        }
      }
    });
  }
  function get_rel_qns() {
    var srch_txt = "<?php echo $srch_txt; ?>";
    var yrs_url = "<?php echo $yr_ids; ?>";
    var exm_url = "<?php echo $exm_ids; ?>";
    var topc_url = "<?php echo $topc_ids; ?>";
    yr_chkbx = document.getElementsByName("year_nm");
    var yrs_ids = [];
    for (i = 0; i < yr_chkbx.length; i++) {
      if (yr_chkbx[i].checked) {
        if (yr_chkbx[i].value != null) {
          yrs_ids.push(yr_chkbx[i].value);
        }
      }
    }
    exm_chkbx = document.getElementsByName("exam_nm");
    var exm_ids = [];
    for (i = 0; i < exm_chkbx.length; i++) {
      if (exm_chkbx[i].checked) {
        if (exm_chkbx[i].value != null) {
          exm_ids.push(exm_chkbx[i].value);
        }
      }
    }
    topc_chkbx = document.getElementsByName("topc_nm");
    var topc_ids = [];
    for (i = 0; i < topc_chkbx.length; i++) {
      if (topc_chkbx[i].checked) {
        if (topc_chkbx[i].value != null) {
          topc_ids.push(topc_chkbx[i].value);
        }
      }
    }
    srch_url = "<?php echo $rtpth; ?>search?text=" + srch_txt;
    if (yrs_ids.length != "") {
      srch_url += "&yrs_ids=" + yrs_ids;
    }
    if (exm_ids.length != "") {
      srch_url += "&exm_ids=" + exm_ids;
    }
    if (topc_ids.length != "") {
      srch_url += "&topc_ids=" + topc_ids;
    }
    window.location.href = srch_url;
  }
  <?php
  if ($page_title == "Search") { ?>
    $(document).ready(function () {
      // Initial page load
      var srch_txt = "<?php echo $srch_txt; ?>";
      var yrs_ids = "<?php echo $yr_ids; ?>";
      var exm_ids = "<?php echo $exm_ids; ?>";
      var topc_ids = "<?php echo $topc_ids; ?>";
      var tot_qns_srch = <?php echo $tot_qns; ?>;
      loadPage_srch(1, srch_txt, yrs_ids, exm_ids, topc_ids);
      // Load next page
      $('#qns_lst_dsp_srch').on('click', '.next', function () {
        let nextPage_srch = parseInt($(this).data('page'))
        loadPage_srch(nextPage_srch, srch_txt, yrs_ids, exm_ids, topc_ids);
      });
      // Load specific page
      $('#qns_lst_dsp_srch').on('click', '.page-number', function () {
        let pageNumber = parseInt($(this).data('page'));
        loadPage_srch(pageNumber, srch_txt, yrs_ids, exm_ids, topc_ids);
      });
      // Load previous page
      $('#qns_lst_dsp_srch').on('click', '.prev', function () {
        let prevPage_srch = parseInt($(this).data('page'))
        loadPage_srch(prevPage_srch, srch_txt, yrs_ids, exm_ids, topc_ids);
      });
      function loadPage_srch(page_srch, srch_txt, yrs_ids, exm_ids, topc_ids) {
        srch_url = `<?php echo $rtpth; ?>get_qns.php?page=${page_srch}`;
        if (srch_txt != "") {
          srch_url += "&srch=" + srch_txt;
        }
        if (yrs_ids.length != "") {
          srch_url += "&yrs_ids=" + yrs_ids;
        }
        if (exm_ids.length != "") {
          srch_url += "&exm_ids=" + exm_ids;
        }
        if (topc_ids.length != "") {
          srch_url += "&topc_ids=" + topc_ids;
        }
        $.ajax({
          url: srch_url,
          // url: `<?php echo $rtpth; ?>get_qns.php?page=${page_srch}&srch=${srch_txt}`,
          type: 'GET',
          success: function (data_srch) {
            var content_srch = '';
            content_srch += data_srch;
            // Append pagination controls
            content_srch += '<ul class="pagination col-sm-12">';
            if (page_srch > 1) {
              content_srch += `<li><button class="prev main-btn" data-page="${page_srch - 1}">Prev</button></li>`;
            }
            for (let k = 1; k <= Math.ceil(tot_qns_srch / 10); k++) {
              if (k === page_srch) {
                content_srch += `<li><button class="page-number" active data-page="${k}">${k}</button></li>`;
              } else {
                content_srch += `<li><button class="page-number" data-page="${k}">${k}</button></li>`;
              }
              content_srch += ``;
            }
            if (page_srch * 10 < tot_qns_srch) {
              content_srch += `<li class="text-right"><button class="next" data-page="${page_srch + 1}">Next</button></li>`;
            }
            content_srch += '</ul>';
            $('#qns_lst_dsp_srch').html(content_srch);
          }
        });
      }
    });
    <?php
  } else if ($page_title == "Bookmark Questions") { ?>
      $(document).ready(function () {
        // Initial page load
        var tot_qns_pg = <?php echo $tot_qns; ?>;
        var mbr_id = <?php echo $membrid; ?>;
        loadPage_pg(1, mbr_id);
        // Load next page
        $('#qns_lst_dsp_pg').on('click', '.next', function () {
          let nextPage_srch = parseInt($(this).data('page'))
          loadPage_pg(nextPage_srch, mbr_id);
        });
        // Load specific page
        $('#qns_lst_dsp_pg').on('click', '.page-number', function () {
          let pageNumber = parseInt($(this).data('page'));
          loadPage_pg(pageNumber, mbr_id);
        });
        // Load previous page
        $('#qns_lst_dsp_pg').on('click', '.prev', function () {
          let prevPage_srch = parseInt($(this).data('page'))
          loadPage_pg(prevPage_srch, mbr_id);
        });
        function loadPage_pg(page_srch, mbr_id) {
          $.ajax({
            url: `<?php echo $rtpth; ?>get_qns.php?page=${page_srch}&mbr_id=${mbr_id}`,
            // url: `<?php echo $rtpth; ?>bookmark.php?page=${page_srch}`,
            type: 'GET',
            success: function (data_srch) {
              var content_srch = '';
              content_srch += data_srch;
              // Append pagination controls
              content_srch += '<ul class="pagination">';
              if (page_srch > 1) {
                content_srch += `<li><button class="prev" data-page="${page_srch - 1}">Prev</button></li>`;
              }
              for (let k = 1; k <= Math.ceil(tot_qns_pg / 10); k++) {
                if (k === page_srch) {
                  content_srch += `<li><button class="page-number" active data-page="${k}">${k}</button></li>`;
                } else {
                  content_srch += `<li><button class="page-number" data-page="${k}">${k}</button></li>`;
                }
                content_srch += ``;
              }
              if (page_srch * 10 < tot_qns_pg) {
                content_srch += `<li class="text-right"><button class="next main-btn" data-page="${page_srch + 1}">Next</button>	</li>`;
              }
              content_srch += '</ul>';
              $('#qns_lst_dsp_pg').html(content_srch);
            }
          });
        }
      });
    <?php
  } else {
    if ($tot_qns == "") {
      $tot_qns1 = 0;
    } else {
      $tot_qns1 = $tot_qns;
    }
    ?>
      $(document).ready(function () {
        // Initial page load
        var cat_id = "<?php echo $cat_id; ?>";
        var scat_id = "<?php echo $scat_id; ?>";
        var yr_id = "<?php echo $yr_id; ?>";
        var tot_qns = <?php echo $tot_qns1; ?>;
        loadPage(1, cat_id, scat_id, yr_id);
        // Load next page
        $('#qns_lst_dsp').on('click', '.next', function () {
          let nextPage = parseInt($(this).data('page'))
          loadPage(nextPage, cat_id, scat_id, yr_id);
        });
        // Load specific page
        $('#qns_lst_dsp').on('click', '.page-number', function () {
          let pageNumber = parseInt($(this).data('page'));
          loadPage(pageNumber, cat_id, scat_id, yr_id);
        });
        // Load previous page
        $('#qns_lst_dsp').on('click', '.prev', function () {
          let prevPage = parseInt($(this).data('page'))
          loadPage(prevPage, cat_id, scat_id, yr_id);
        });
        function loadPage(page, cat_id, scat_id, yr_id) {
          $.ajax({
            url: `<?php echo $rtpth; ?>get_qns.php?page=${page}&catid=${cat_id}&scatid=${scat_id}&yr=${yr_id}`,
            type: 'GET',
            success: function (data) {
              var content = '';
              content += data;
              // Append pagination controls
              content += '<ul class="pagination">';
              if (page > 1) {
                content += `<li><button class="prev main-btn" data-page="${page - 1}">Prev</button></li>`;
              }
              for (let k = 1; k <= Math.ceil(tot_qns / 10); k++) {
                if (k === page) {
                  content += `<li><button class="page-number" active data-page="${k}">${k}</button></li>`;
                } else {
                  content += `<li><button class="page-number" data-page="${k}">${k}</button></li>`;
                }
                content += ``;
              }
              if (page * 10 < tot_qns) {
                content += `<li class="text-right"><button class="next main-btn" data-page="${page + 1}">Next</button></li>`;
              }
              content += '</li></ul>';
              $('#qns_lst_dsp').html(content);
            }
          });
        }
      });
    <?php
  }
  /*   if (!isset($_SESSION['sesmbrid']) || ($_SESSION['sesmbrid'] == "")) { ?>
              const searchInput = document.getElementById('header_search');
        const errorMessage = document.getElementById('error-message');
        searchInput.addEventListener('mouseover', () => {
          errorMessage.style.display = 'block';
        });
        searchInput.addEventListener('mouseout', () => {
          errorMessage.style.display = 'none';
        });
        searchInput.addEventListener('blur', () => {
          searchInput.blur();
          // searchButton.blur();
        });
                    <?php
    } */
  ?>
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
  var chng_pwdrules = new Array();
  chng_pwdrules[1] = 'txtchngpwd_oldpswd|required|Enter Old Password';
  chng_pwdrules[2] = 'txtchngpwd_nwpswd|required|Enter New Password';
  chng_pwdrules[3] = 'txtchngpwd_nwcnfpswd|required|Enter Confirm Password';
  chng_pwdrules[4] = 'txtchngpwd_nwcnfpswd|equal|$txtchngpwd_nwpswd|Password not match';
  var edit_details = new Array();
  edit_details[1] = 'edttxtname|required|Enter Name';
  edit_details[2] = 'edttxtname|alphaspace|Enter Only Name';
  // edit_details[3] = 'edttxtemail|required|Enter Email';
  // edit_details[4] = 'edttxtemail|email|Enter Email Id only';
  edit_details[5] = 'edttxtmobile|required|Enter Mobile Number';
  edit_details[6] = 'edttxtmobile|numeric|Enter Numbers only';
  function get_qns_lnk(url) {
    var encurl = encodeURI(url)
    var waurl = "whatsapp://send?text=I would like to share a link with you: " + encurl;
    var fburl = "https://www.facebook.com/sharer.php?u=" + encurl;
    var twturl = "https://twitter.com/intent/tweet?url=" + encurl;
    var mlurl = "mailto:?Subject=I would like to share a link with you&body=" + encurl;
    var telurl = "https://t.me/share/url?url=" + encurl + "&text=I would like to share a link with you";
    var disp = "<li><a class='ps-social__link facebook' href='" + fburl +"' target='_blank'><i class='fa fa-facebook'> </i><span class='ps-tooltip'></span></a></li>";
    disp += "<li><a class='ps-social__link twitter' href='" + twturl +"' target='_blank'><i class='fa fa-twitter'></i><span class='ps-tooltip'></span></a></li>";
    disp += "<li><a class='ps-social__link whatsapp' href='" + waurl +
      "' target='_blank'><i class='fa fa-whatsapp'></i><span class='ps-tooltip'></span></a></li>";
    disp += "<li><a class='ps-social__link envelope' href='" + mlurl +
      "' target='_blank'><i class='fa fa-envelope-o'></i><span class='ps-tooltip'></span></a></li>";
    disp += "<li><a class='ps-social__link telegram' href='" + telurl +
      "' target='_blank'><i class='fa fa-telegram'></i><span class='ps-tooltip'></span></a></li>";
    disp += "<li><a class='ps-social__link copy' href='#' onclick=\"copylnk('" + encurl + "')\"><i class='fa fa-copy'></i><span class='ps-tooltip'></span></a></li>";

    document.getElementById("sclshare").innerHTML = disp;
  }
  function copylnk(link) {
    navigator.clipboard.writeText(link).then(function () {
      alert('Copied to clipboard');
    }).catch(function (error) {
      console.error('Clipboard copy failed: ', error);
    });
  }
</script>
</body>

</html>