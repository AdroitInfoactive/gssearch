<?php
session_start();
include_once '../includes/inc_config.php'; //Making paging validation
include_once '../includes/inc_connection.php'; //Making paging validation
include_once '../includes/inc_usr_functions.php'; //Making paging validation
include_once '../includes/inc_nocache.php'; //Making paging validation
include_once '../includes/inc_membr_session.php'; //Making paging validation
require('config.php');
require('razorpay-php/Razorpay.php');
error_reporting(0);
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
$success = true;
$error = "Payment Failed";
if (empty($_POST['razorpay_payment_id']) === false) {
  $api = new Api($keyId, $keySecret);
  try {
    // Please note that the razorpay order ID must
    // come from a trusted source (session here, but
    // could be database or something else)
    $attributes = array(
      'razorpay_order_id' => $_SESSION['razorpay_order_id'],
      'razorpay_payment_id' => $_POST['razorpay_payment_id'],
      'razorpay_signature' => $_POST['razorpay_signature']
    );
    $api->utility->verifyPaymentSignature($attributes);
  } catch (SignatureVerificationError $e) {
    $success = false;
    $error = 'Razorpay Error : ' . $e->getMessage();
  }
} else { ?>
  <script language="javascript" type="text/javascript">
    location.href = "https://www.gssearch.in/cancel";
  </script>
  <?php
}
if ($success === true) {
  $txn_odrid = $_POST['razorpay_orderid'];
  $cur_dt = date('Y-m-d H:i:s');
  $to_dt = date('Y-m-d H:i:s', strtotime('+1 year'));
  //$txn_odrid = 1078;
  // write update query here with subscription start date and end date
  $uqry_sub_mst = "UPDATE mbr_sbcr_dtl set mbrd_sbcr_paidsts = 'y', mbrd_sbcr_paidon = '$cur_dt', mbrd_sbcr_endon = '$to_dt' where mbrd_sbcr_id = '$txn_odrid'";
  // $uqrycrtord_mst = "UPDATE crtord_mst set crtordm_paysts = 'y' where crtordm_id = '$txn_odrid'";
  $resuqrysub_mst = mysqli_query($conn, $uqry_sub_mst);
  if ($resuqrysub_mst == true) {
    $_SESSION['sesssubsts'] = 'y';
    ?>
    <script language="javascript" type="text/javascript">
      alert("Payment Successful");
      location.href = "https://www.gssearch.in/home";
    </script>
    <?php
  } else {
    ?>
    <script language="javascript" type="text/javascript">
      location.href = "https://www.gssearch.in/cancel";
    </script>
    <?php
  }
} else {
  ?>
  <script language="javascript" type="text/javascript">
    location.href = "https://www.gssearch.in/cancel";
  </script>
  <?php
}
