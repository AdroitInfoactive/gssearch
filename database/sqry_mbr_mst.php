<?php
session_start();
if (isset($_POST['btnsbmt_lgn']) && (trim($_POST['btnsbmt_lgn']) == 'Login') && isset($_POST['txtpswd']) && (trim($_POST['txtpswd']) != '') && isset($_POST['txtemail']) && (trim($_POST['txtemail']) != '')) {
  $email = glb_func_chkvl($_POST['txtemail']);
  $pswd = glb_func_chkvl($_POST['txtpswd']);
  $ipadrs = $_SERVER['REMOTE_ADDR'];
  $pwd = md5($pswd);
  $dt = date('Y-m-d h:i:s');
  $sts = 'a';
  $sqrymbr_mst = "SELECT mbrm_id, mbrm_name, mbrm_emailid from mbr_mst where mbrm_emailid = '$email' and mbrm_pwd = '$pwd'";
  $srsmbr_mst = mysqli_query($conn, $sqrymbr_mst);
  $cntmbr_mst = mysqli_num_rows($srsmbr_mst);
  if ($cntmbr_mst > 0) {
    $rowmbr_mst = mysqli_fetch_array($srsmbr_mst);
    $_SESSION['sesmbrid'] = $rowmbr_mst['mbrm_id'];
    $_SESSION['sesmbrname'] = $rowmbr_mst['mbrm_name'];
    $_SESSION['sesmbremail'] = $rowmbr_mst['mbrm_emailid'];
    ?>
    <script language="javascript" type="text/javascript">
      // alert("User account already exist with the provided email address");
      location.href = "<?php echo $rtpth . 'home' ?>";
    </script>
    <?php
    // $greg_msg = "Duplicate email id, account not created";
  } else {
    ?>
    <script language="javascript" type="text/javascript">
      alert("No Account found with the provided credentials. Please try again");
      location.href = "<?php echo $rtpth . 'home' ?>";
    </script>
    <?php
  }
}