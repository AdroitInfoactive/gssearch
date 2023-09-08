<?php
session_start();
error_reporting(0);
include_once 'includes/inc_config.php'; //Making paging validation	
include_once $inc_user_cnctn; //Making database Connection
include_once $inc_user_usr_fnctn; //checking for session	
include_once $inc_user_fldr_pth;
	
/*************** Checking And Assigning Request Values *************************/
if(isset($_REQUEST['qnsid']) && (trim($_REQUEST['qnsid']) != "")){
	$wshprdid	 = addslashes(trim($_REQUEST['qnsid'])); 	// Stores the requested productid
}
if(isset($_REQUEST['action']) && (trim($_REQUEST['action']) != "")){
	$wshaction	 = glb_func_chkvl($_REQUEST['action']); 	// Stores the action to be taken (add,update,delete)
}

/**********************Checking And Assigning *************************/
$wish_action ="";
$wish_qnsid = "";	   // Stores the session qns id
$flg = 0;	   // Stores 0 if record not added or updated and 1 if record added successfully
/**********************Assigning Values to Sessions *************************/

$_SESSION['wishqnsid'] = $wshprdid;
$_SESSION['wishaction'] = $wshaction;
$_SESSION['pgname'] = "y";
if ($_SESSION['wishaction'] == 'b')
{
	$membrid = $_SESSION['sesmbrid'];
	$sessid = session_id();
	$dt = date('Y-m-d h:i:s');
	 $sqrybookmark_mst = "SELECT * from bookmark_mst where bookmark_qns_id='$wshprdid' and bookmark_usr_id='$membrid' ";
	$srsbookmark_mst = mysqli_query($conn, $sqrybookmark_mst);
	$norbookmark_mst = mysqli_num_rows($srsbookmark_mst);
	if ($norbookmark_mst == 0) {
		 $iqrybookmark_mst = "INSERT into bookmark_mst(bookmark_usr_id,bookmark_qns_id,bookmark_sts,bookmark_crtdon,bookmark_crtdby) values('$membrid','$wshprdid','a','$dt','$membrid')";
		$irsbookmark_mst = mysqli_query($conn, $iqrybookmark_mst);

		echo "yes";
		
	}
	else{
		echo "no";
		
	}
	// echo "yes";
}
else
{
	
}
?>