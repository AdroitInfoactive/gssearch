<?php
include_once "../includes/inc_nocache.php"; // Clearing the cache information
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more
//checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth;
global $ses_admin;

if (
	isset($_POST['btnsubtopicssbmt']) && (trim($_POST['btnsubtopicssbmt']) != "") &&
	isset($_POST['lstprodcat']) && (trim($_POST['lstprodcat']) != "") &&
	isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")
) {

	$subtopics = glb_func_chkvl($_POST['lstprodcat']);
	$name = glb_func_chkvl($_POST['txtname']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$prior = glb_func_chkvl($_POST['txtprty']);
	// $gnrtdfrm = glb_func_chkvl($_POST['lstcntnttyp']);
	/* $cattyp = glb_func_chkvl($_POST['lstcattyp']);
	$admtyp = glb_func_chkvl($_POST['admtype']); //admissions type ug/pg
	$disptyp = glb_func_chkvl($_POST['lstdsplytyp']); */
	$seotitle = glb_func_chkvl($_POST['txtseotitle']);
	$seodesc = glb_func_chkvl($_POST['txtseodesc']);
	$seokywrd = glb_func_chkvl($_POST['txtseokywrd']);
	$seoh1 = glb_func_chkvl($_POST['txtseoh1']);
	$seoh2 = glb_func_chkvl($_POST['txtseoh2']);
	$sts = $_POST['lststs'];
	$dt = date('Y-m-d h:i:s');
	
	 $sqrysubtopics_mst = "SELECT subtopicsm_name,subtopicsm_topicsm_id,subtopicsm_admtyp from subtopics_mst where subtopicsm_name ='$name' and subtopicsm_topicsm_id ='$subtopics'"; 
	$srssubtopics_mst = mysqli_query($conn, $sqrysubtopics_mst);
	 $cntrec_cat = mysqli_num_rows($srssubtopics_mst); 
	if ($cntrec_cat < 1) {
  
		$iqrysubtopics_mst = "INSERT into subtopics_mst(subtopicsm_topicsm_id,subtopicsm_name,subtopicsm_desc,subtopicsm_seotitle,subtopicsm_seodesc,subtopicsm_seokywrd, subtopicsm_seohone,subtopicsm_seohtwo,subtopicsm_sts,subtopicsm_prty, subtopicsm_crtdon,subtopicsm_crtdby)values('$subtopics','$name','$desc','$seotitle','$seodesc','$seokywrd', '$seoh1','$seoh2','$sts',$prior, '$dt','$ses_admin')"; 
		$irssubtopics_mst = mysqli_query($conn, $iqrysubtopics_mst);
    $gmsg = "Record saved successfully";
  }
} else {
  $gmsg = "Duplicate name. Record not saved";
}
							
		
					

			
			