<?php
include_once 'includes/inc_nocache.php'; // Clearing the cache information
include_once "includes/inc_adm_session.php"; //checking for session
include_once '../includes/inc_usr_functions.php'; //Use function for validation and more	
include_once "includes/inc_fnct_fleupld.php"; // For uploading files
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
// exit;
if (
	isset($_POST['btnquestionssbmt']) && (trim($_POST['btnquestionssbmt']) != "") &&
	isset($_POST['txtque']) && (trim($_POST['txtque']) != "") &&
	isset($_POST['lastexamnm']) && (trim($_POST['lastexamnm']) != "") 
) 
{
 $ques = glb_func_chkvl(addslashes(($_POST['txtque'])));
	$year = glb_func_chkvl($_POST['lstyear']);
	$examnm = glb_func_chkvl(addslashes($_POST['lastexamnm']));
	$optn1 = glb_func_chkvl(addslashes($_POST['txtopt1']));
	$optn2 = glb_func_chkvl(addslashes($_POST['txtopt2']));
	$optn3 = glb_func_chkvl(addslashes($_POST['txtopt3']));
	$optn4= glb_func_chkvl(addslashes($_POST['txtopt4']));
	$crtans = glb_func_chkvl($_POST['addcrtans']);
	$explan = glb_func_chkvl(addslashes($_POST['txtexplan']));
	$topic = glb_func_chkvl($_POST['lst_topic']);
	$subtopic = glb_func_chkvl($_POST['lst_subtopic']);
	$txtprty = glb_func_chkvl($_POST['txtprty']);
	$lststs = glb_func_chkvl($_POST['lststs']);
	$crtdt = date('Y-m-d h:i:s');
 $sqryQstMstNm = "SELECT 
	addquesm_qnm 
	from
	addques_mst
	where
	addquesm_qnm ='$ques'"; 
	$srsQstMstNm = mysqli_query($conn, $sqryQstMstNm);
	$cntQstMstNm = mysqli_num_rows($srsQstMstNm);
  
 $iqryQstMst = "INSERT into addques_mst(addquesm_qnm,addquesm_prodmnexmsm_id,addquesm_yearsm_id,addquesm_topicsm_id,addquesm_subtopicsm_id,addquesm_optn1,addquesm_optn1Img,addquesm_optn2,addquesm_optn2Img,addquesm_optn3,addquesm_optn3Img,addquesm_optn4,addquesm_optn4Img,addquesm_crtans,addquesm_expln ,addquesm_prty,addquesm_sts,addquesm_crtdon,addquesm_crtdby) values( '$ques','$examnm','$year','$topic','$subtopic','$optn1', '$optnaimg','$optn2','$optnbimg','$optn3', '$optncimg','$optn4','$optndimg','$crtans', '$explan','$txtprty','$lststs', '$crtdt','$ses_admin')"; 
		$irsQstMst = mysqli_query($conn, $iqryQstMst);
		// if ($irsQstMst == true) {
			// if ($sqstimgval != "") {
			// 	move_uploaded_file($ssqstsource, $gaddques_fldnm . $sqstdest);
			// }
			// if ($soptnaimgval != "") {
			// 	move_uploaded_file($soptnasource, $gaddques_fldnm . $soptnadest);
			// }
			// if ($soptnbimgval != "") {
			// 	move_uploaded_file($soptnbsource, $gaddques_fldnm . $soptnbdest);
			// }
			// if ($soptncimgval != "") {
			// 	move_uploaded_file($soptncsource, $gaddques_fldnm . $soptncdest);
			// }
			// if ($soptndimgval != "") {
			// 	move_uploaded_file($soptndsource, $gaddques_fldnm . $soptnddest);
			// }}

			$gmsg = "Record saved successfully";
		} else {
			$gmsg = "Record not saved";
		}
	

?>