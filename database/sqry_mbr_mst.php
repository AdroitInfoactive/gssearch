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
    $db_lgnm_id = $rowmbr_mst['mbrm_id'];
    $db_lgnm_nm = $rowmbr_mst['mbrm_name'];
    $db_lgnm_eml = $rowmbr_mst['mbrm_emailid'];
    $_SESSION['sesmbrid'] = $db_lgnm_id;
    $_SESSION['sesmbrname'] = $db_lgnm_nm;
    $_SESSION['sesmbremail'] = $db_lgnm_eml;
    $mbr_sid = session_id();
    // $_SESSION['sessuid'] = $mbr_sid;
    $iqry_mbr_mbr_lgntrck_mst = "INSERT into mbr_lgntrck_mst(mbr_lgntrckm_sesid,mbr_lgntrckm_ipadrs,mbr_lgntrckm_lgnm_id,mbr_lgntrckm_lgnsts,mbr_lgntrckm_crtdon,mbr_lgntrckm_crtdby)values('$mbr_sid','$ipadrs',$db_lgnm_id,'a','$dt','$db_lgnm_eml')";
    $irs_mbr_lgn_trck = mysqli_query($conn, $iqry_mbr_mbr_lgntrck_mst) or (die(mysqli_error($conn)));
    $uqry_prv_sess = "UPDATE mbr_lgntrck_mst SET mbr_lgntrckm_lgnsts = 'i' WHERE mbr_lgntrckm_sesid != '$mbr_sid' and mbr_lgntrckm_lgnm_id = '$db_lgnm_id'";
    $urs_prv_sess = mysqli_query($conn, $uqry_prv_sess) or (die(mysqli_error($conn)));
    $sqry_subs_sts = "SELECT mbrd_sbcr_id, mbrd_sbcr_paidon, mbrd_sbcr_endon from mbr_sbcr_dtl where mbr_sbcr_dtl = '$db_lgnm_id' order by mbrd_sbcr_paidon desc limit 1";
    $srssubs_sts = mysqli_query($conn, $sqry_subs_sts);
    $cntsubs_sts = mysqli_num_rows($srssubs_sts);
    if ($cntsubs_sts > 0) {
      $rowsubs_sts = mysqli_fetch_assoc($srssubs_sts);
      $db_sbcr_id = $rowsubs_sts['mbrd_sbcr_id'];
      $db_sbcr_paidon = $rowsubs_sts['mbrd_sbcr_paidon'];
      $db_sbcr_endon = $rowsubs_sts['mbrd_sbcr_endon'];
      $db_sbcr_paidon = date('Y-m-d H:i:s', strtotime($db_sbcr_paidon));
      $db_sbcr_endon = date('Y-m-d H:i:s', strtotime($db_sbcr_endon));
      $curr_dt = date('Y-m-d H:i:s');
      if ($curr_dt >= $db_sbcr_paidon && $curr_dt <= $db_sbcr_endon)
      {
        $sub_sts = "y";
      }
      else
      {
        $sub_sts = "n";
      }
    }
    else {
      $sub_sts = "n";
    }
    $_SESSION['sesssubsts'] = $sub_sts;
    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '')
    {
      $rdpth = $_SERVER['HTTP_REFERER'];
    }
    else {
      $rdpth = $rtpth.'home';
    }
    $_SERVER['HTTP_REFERER']
    ?>
    <script language="javascript" type="text/javascript">
      // alert("User account already exist with the provided email address");
      location.href = "<?php echo $rdpth; ?>";
    </script>
    <?php
    // $greg_msg = "Duplicate email id, account not created";
  } else {
    ?>
    <script language="javascript" type="text/javascript">
      alert("No Account found with the provided credentials. Please try again");
      location.href = "<?php echo $rdpth; ?>";
    </script>
    <?php
  }
}