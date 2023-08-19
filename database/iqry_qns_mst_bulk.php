<?php

//error_reporting(~0);	
include_once '../includes/inc_nocache.php'; //Clearing the cache information
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_folder_path.php";
include_once "../includes/inc_usr_functions.php"; //Include user functions
include_once "../includes/inc_fnct_blkupld.php";
include_once '../includes/inc_connection.php'; //Making database Connection
include_once '../includes/inc_config.php';
// For uploading files 	
global $conn;
if (
  isset($_POST['clmsbmt']) && (trim($_POST['clmsbmt']) != "") &&
  isset($_FILES['fleblkupld']) && (trim($_FILES['fleblkupld']['name']) != "")
) {

  $flg = "";
  $flenm = ($_FILES['fleblkupld']['name']);

  $simgval = funcBlkUpld('fleblkupld', '');
  if ($simgval != "") {
    $simgary = explode(":", $simgval, 2);
    $sdest = $simgary[0];
    $ssource = $simgary[1];
  }

  if (($ssource != 'none') && ($ssource != '') && ($sdest != "")) {
    $dt = date('Y-m-d h:i:s');
    $adm_dtls = "," . "'$dt'" . "," . "'$ses_admin'";
    $updtSlno = 0;
    $handle = fopen($ssource, "r");
    $flg = move_uploaded_file($ssource, $gadmxddlsclm . $sdest);
    //header('Content-Type: text/plain');
    require('../spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
    require('../spreadsheet-reader-master/SpreadsheetReader.php');
    date_default_timezone_set('UTC');
    //	$xlfle = $gadmxlsclm.$sdest;exit;
    //	$finm = $gadmxlsclm.$flenm;exit;
    $Spreadsheet = new SpreadsheetReader($gadmxddlsclm . $sdest);
    $Sheets = $Spreadsheet->Sheets();
    $i = 0;
    // $c = 1;
    foreach ($Sheets as $Index => $Name) {
      $Time = microtime(true);
      $Spreadsheet->ChangeSheet($Index);
      $d = 1;
      if ($i == 0) {
        foreach ($Spreadsheet as $Key => $filesop) {
          $Key . ': ';
          if ($filesop) {
            if ($d > 1) {

              $c;
              $examnm = $filesop[0];
              $year = $filesop[1];
              $topic = $filesop[2];
              $sub_topic = $filesop[3];
              $qnsnm = $filesop[4];
            
              $opt1 = $filesop[5];
              $opt2 = $filesop[6];
              $opt3 = $filesop[7];
              $opt4 = $filesop[8];
              $corect_ans = $filesop[9];
              $explntion = $filesop[10];

              $rank = $filesop[11];
              $status = $filesop[12];

              if ($ses_admin != '') {
                $sts = 'i';

              } else {
                $sts = 'a';

              }

              if ($examnm != '') //prod main scat name
              {
                $sqlexmnm = "SELECT prodmnexmsm_id from prodmnexms_mst
                      where
                      prodmnexmsm_name = '$examnm' ";
                $remncat = mysqli_query($conn, $sqlexmnm);
                $nmmsct = mysqli_num_rows($remncat);
                if ($nmmsct > 0) {
                  $rwmnscatid = mysqli_fetch_array($remncat);
                  $exam_id = $rwmnscatid['prodmnexmsm_id'];

                }
              }
              if ($year != '') //year id
              {
                $sqlyear = "SELECT yearsm_id from years_mst
                      where
                      yearsm_name = '$year' ";
                $resyear = mysqli_query($conn, $sqlyear);
                $nmmsct = mysqli_num_rows($resyear);
                if ($nmmsct > 0) {
                  $rwsyearid = mysqli_fetch_array($resyear);
                  $year_id = $rwsyearid['yearsm_id'];

                }
              }
              if ($topic != '') //Topic id
              {
                $sqltopic = "SELECT topicsm_id from topics_mst
                      where
                      topicsm_name = '$topic' ";
                $restopic = mysqli_query($conn, $sqltopic);
                $nmtopic = mysqli_num_rows($restopic);
                if ($nmtopic > 0) {
                  $rwstopicid = mysqli_fetch_array($restopic);
                  $topic_id = $rwstopicid['topicsm_id'];

                }
              }
              if ($sub_topic != '') //Sub-Topic id
              {
                $sqlsub_topic = "SELECT subtopicsm_id,subtopicsm_topicsm_id from subtopics_mst
                      where
                      subtopicsm_name = '$sub_topic' and subtopicsm_topicsm_id = '$topic_id' ";
                $ressub_topic = mysqli_query($conn, $sqlsub_topic);
                $nmsub_topic = mysqli_num_rows($ressub_topic);
                if ($nmsub_topic > 0) {
                  $rwssub_topicid = mysqli_fetch_array($ressub_topic);
                  $sub_topic_id = $rwssub_topicid['subtopicsm_id'];
                  // $sub_topic_id = $rwssub_topicid['subtopicsm_id']; 

                }
              }

              if ($corect_ans != '') {
                if ($corect_ans == 'option 1') {
                  $typ = 1;
                } elseif ($corect_ans == 'option 2') {
                  $typ = 2;
                } elseif ($corect_ans == 'option 3') {
                  $typ = 3;
                } elseif ($corect_ans == 'option 4') {
                  $typ = 4;
                }
                else {
                  $typ = 0;
                }
              } else {
                $typ = 0;
              }


              $curdt = date('Y-m-d h:i:s');

              if ($qnsnm != '') {

                $sqryprod_mst = "SELECT  addquesm_id,addquesm_prodmnexmsm_id,addquesm_yearsm_id,addquesm_topicsm_id,addquesm_subtopicsm_id from  addques_mst where  addquesm_qnm='$qnsnm'";
                $srsprod_mst = mysqli_query($conn, $sqryprod_mst);
                $count1 = mysqli_num_rows($srsprod_mst);
                $rwsprdid = mysqli_fetch_array($srsprod_mst);
                if ($count1 > 0) {
                  $strprodid = $rwsprdid['addquesm_id'];
                  $flag = 1;
                }
                if ($flag != 1) {



                  /**********************Product*****************************/
                  $iqryprod_mst = "INSERT into addques_mst(
                  addquesm_qnm, addquesm_prodmnexmsm_id, addquesm_yearsm_id, addquesm_topicsm_id, addquesm_subtopicsm_id, addquesm_optn1, addquesm_optn2, addquesm_optn3, addquesm_optn4, addquesm_crtans, addquesm_expln, addquesm_prty, addquesm_sts, addquesm_crtdon, addquesm_crtdby)values(
                '$qnsnm','$exam_id','$year_id','$topic_id','$sub_topic_id','$opt1','$opt2','$opt3','$opt4','$typ','$explntion','$rank','$sts','$dt','admin')";

                  // echo 	$iqryprod_mst;exit;
                  $irsprod_mst = mysqli_query($conn, $iqryprod_mst) or die(mysqli_error($conn));
                  // $prodid = mysqli_insert_id($conn);
                } else {
                  $prodid = $strprodid;
                }
                /**/


              } //sku ends

            } //if $c>1 line ends




          } //file sop close
          else {
            $gmsg = "Error record not saved. Excel file Format  issue.";
          } //exit;


          $d++;

        } //change content loop close
      } 
      
      
      
    
      else {

        // skip 3rd sheet
      }
      $i++;
    }
    //---
    if ($irsprod_mst == true) {
      echo "<script>";
      echo "location.href='add_blkqns.php?sts=y'";
      echo "</script>";
      exit;
    }
     else {
      $gmsg = "Question Not Added Duplicate Question Name Exists";

      echo "<script>";
      echo "location.href='add_blkqns.php?sts=d'";
      echo "</script>";
      exit;
    }
  } //sheets as index close
} //excel file source end
else {
  $gmsg = "Error record not saved. Excel file is missing.";
}
?>