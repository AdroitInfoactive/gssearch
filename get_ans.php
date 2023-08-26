<?php
session_start();
error_reporting(0);
include_once 'includes/inc_config.php'; //Making paging validation	
include_once $inc_user_cnctn; //Making database Connection
include_once $inc_user_usr_fnctn; //checking for session	
include_once $inc_user_fldr_pth;

if ((isset($_GET['sno']) && $_GET['sno'] != "") && (isset($_GET['optnid']) && $_GET['optnid'] != "") && (isset($_GET['qtnid']) && $_GET['qtnid'] != ""))
{
  $qns_id = glb_func_chkvl($_GET['qtnid']);
  $sqry_ans = "SELECT addquesm_crtans, addquesm_expln from addques_mst where addquesm_id = $qns_id group by addquesm_id asc limit 1";
  $srs_ans = mysqli_query($conn, $sqry_ans);
  $cnt_ans = mysqli_num_rows($srs_ans);
  if ($cnt_ans > 0)
  {
    $srows_ans = mysqli_fetch_assoc($srs_ans);
    $ans_crtans = $srows_ans['addquesm_crtans'];
    $ans_expln = strip_tags(html_entity_decode($srows_ans['addquesm_expln']));
  }
  echo $ans_crtans."<-->". $ans_expln;
}