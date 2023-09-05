<?php
require('config.php');
require('razorpay-php/Razorpay.php');
session_start();
global $conn;
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);
if (!empty($_POST['hdntxnid'])) {
  $paymntid = $_POST['hdntxnid'];
  $payamnt = $_POST['hdnamount'];
  $payinfo = $_POST['hdnproductinfo'];
  $odrid = $_POST['hdnodrid'];
  // We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
  $orderData = [
    'receipt' => $paymntid,
    'amount' => $payamnt * 100,
    // 2000 rupees in paise
    'currency' => 'INR',
    'payment_capture' => 1 // auto capture
  ];
  //print_r($orderData);
  $razorpayOrder = $api->order->create($orderData);
  $razorpayOrderId = $razorpayOrder['id'];
  $_SESSION['razorpay_order_id'] = $razorpayOrderId;
  $displayAmount = $amount = $orderData['amount'];
  if ($displayCurrency !== 'INR') {
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);
    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
  }
  $checkout = 'automatic';
  if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true)) {
    $checkout = $_GET['checkout'];
  }
  $data = [
    "key" => $keyId,
    "amount" => $amount,
    //   "name" => $paynm,
    "description" => $payinfo,
    /*  "image" => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
     "prefill" => [
       "name" => $paynm,
       "email" => $paymnemil,
       "contact" => $paymphn,
     ], */
    "notes" => [
      "address" => $payinfo,
      "merchant_order_id" => $paymntid,
    ],
    "theme" => [
      "color" => "#F37254"
    ],
    "order_id" => $razorpayOrderId,
  ];
  if ($displayCurrency !== 'INR') {
    $data['display_currency'] = $displayCurrency;
    $data['display_amount'] = $displayAmount;
  }
  $json = json_encode($data);
  require("checkout/manual.php");
}
