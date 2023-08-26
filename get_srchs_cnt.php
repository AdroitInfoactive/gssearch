<?php
// session_start();
error_reporting(0);
include_once 'includes/inc_config.php'; //Making paging validation	
include_once $inc_user_cnctn; //Making database Connection
include_once $inc_user_usr_fnctn; //checking for session	
include_once $inc_user_fldr_pth;
include_once $inc_mbr_sess;
if ((isset($_GET['srchtxt']) && $_GET['srchtxt'] != ""))
{
  $curr_dt = date('Y-m-d H:i:s');
  $srchtxt = ($_GET['srchtxt']);
  $srchtxt_qry = funcStrUnRplc($srchtxt);
  $sqry_srchlmt_cnt = "SELECT srchlmt_count from srchlmts_mst where srchlmt_id = 2";
  $srs_srchlmt_cnt = mysqli_query($conn, $sqry_srchlmt_cnt);
  $srows_srchlmt_cnt = mysqli_fetch_assoc($srs_srchlmt_cnt);
  $lmt_cnt = $srows_srchlmt_cnt['srchlmt_count'];
  $sqry_srch_txt = "SELECT mbrd_srch_txt from mbr_srch_dtl where mbrd_srch_mbrm_id = $membrid order by mbrd_srch_crtdon desc limit 1";
  $srs_srch_txt = mysqli_query($conn, $sqry_srch_txt);
  $cnt_srch_txt = mysqli_num_rows($srs_srch_txt);
  if ($cnt_srch_txt > 0)
  {
    $srows_srch_txt = mysqli_fetch_assoc($srs_srch_txt);
    $db_srch_txt = $srows_srch_txt['mbrd_srch_txt'];
    $sqry_srch_cnt = "SELECT count(*) as tot_cnt from mbr_srch_dtl where mbrd_srch_mbrm_id = $membrid";
    $srs_srch_cnt = mysqli_query($conn, $sqry_srch_cnt);
    $srows_srch_cnt = mysqli_fetch_assoc($srs_srch_cnt);
    $tot_cnt = $srows_srch_cnt['tot_cnt'];
    if ($tot_cnt < $lmt_cnt)
    {
      if($db_srch_txt != $srchtxt_qry)
      {
        $iqry_srch_cnt = "INSERT into mbr_srch_dtl (mbrd_srch_mbrm_id, mbrd_srch_txt, mbrd_srch_crtdon, mbrd_srch_crtdby) values ($membrid, '$srchtxt_qry', '$curr_dt', '$membremail')";
        $irsmbr_srch_cnt = mysqli_query($conn, $iqry_srch_cnt);
        echo "y";
      }
      else
      {
        echo "y";
      }
    }
    else {
      echo "n";
    }
  }
  else
  {
    $iqry_srch_cnt = "INSERT into mbr_srch_dtl (mbrd_srch_mbrm_id, mbrd_srch_txt, mbrd_srch_crtdon, mbrd_srch_crtdby) values ($membrid, '$srchtxt_qry', '$curr_dt', '$membremail')";
    $irsmbr_srch_cnt = mysqli_query($conn, $iqry_srch_cnt);
    echo "y";
  }
}