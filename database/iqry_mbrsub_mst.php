<?php
// write code here for subscription entry
session_start();
/* echo "<pre>";
var_dump($_POST);
echo "</pre>";
exit(); */
if (isset($_POST['btnsbmt_subs']) && (trim($_POST['btnsbmt_subs']) == 'Continue to payment')) {
  // 1st cross check weather already existing subscription is there or not
  $sqry_sub_lst = "SELECT mbrd_sbcr_id from mbr_sbcr_dtl where mbrd_sbcr_endon <= CURDATE() and mbrd_sbcr_mbrm_id = $membrid";
  $srs_sub_lst = mysqli_query($conn, $sqry_sub_lst);
  $cnt_sub_lst = mysqli_num_rows($srs_sub_lst);
  $sub_amt = $_POST['hdn_sub_amt'];
  $sub_amt_id = $_POST['hdn_sub_amt_id'];
  $mem_id = $_POST['hdn_mbrsub_id'];
  $curr_dt = date('Y-m-d H:i:s');
  if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
    $rdpth = $_SERVER['HTTP_REFERER'];
  } else {
    $rdpth = $rtpth . 'home';
  }
  if ($cnt_sub_lst < 1) {
    // write new insertion query
    $iqry_sub_lst = "INSERT into mbr_sbcr_dtl (mbrd_sbcr_mbrm_id, mbrd_sbcr_amt_id, mbrd_sbcr_crtdon, mbrd_sbcr_crtdby,mbrd_sbcr_paidsts) values ('$membrid', '$sub_amt_id', '$curr_dt', '$membremail','n')";
    $irsmbr_sub_lst = mysqli_query($conn, $iqry_sub_lst);
    $insert_id = mysqli_insert_id($conn);
    $newcrtord_code = "gssearch-".$insert_id;
    $Rzaction = $rtpth . "razorpay/pay.php";
    ?>
    <form method="POST" name="frmpymntRzrpy" id="frmpymntRzrpy" action="">
      <input type="hidden" name="hdntxnid" value="<?php echo $newcrtord_code; ?>" />
      <input type="hidden" name="hdnamount" id="hdnamount" value="<?php echo $sub_amt; ?>" />
      <input type="hidden" name="hdnproductinfo" id="hdnproductinfo" value="1" size="64" />
      <input type="hidden" name="hdnodrid" value="<?php echo $insert_id; ?>" />
        </form>
        <script language="javascript" type="text/javascript">
          document.getElementById('frmpymntRzrpy').action = "<?php echo $Rzaction; ?>";
      document.getElementById('frmpymntRzrpy').submit();
    </script>
    <?php
  } else {
    ?>
    <script type="text/javascript">
      alert("Your subscription is already exists. Please login to continue or contact support.");
      location.href = "<?php echo $rdpth; ?>";
    </script>
    <?php
  }
}
?>