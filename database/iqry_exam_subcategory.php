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
	isset($_POST['btnexam_subcategorysbmt']) && (trim($_POST['btnexam_subcategorysbmt']) != "") &&
	isset($_POST['lstprodcat']) && (trim($_POST['lstprodcat']) != "") &&
	isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")
) {

	$exam_subcategory = glb_func_chkvl($_POST['lstprodcat']);
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
	
	 $sqryexam_subcategory_mst = "SELECT exam_subcategorym_name,exam_subcategorym_prodmnexmsm_id,exam_subcategorym_admtyp from exam_subcategory_mst where exam_subcategorym_name ='$name' and exam_subcategorym_prodmnexmsm_id ='$exam_subcategory'"; 
	$srsexam_subcategory_mst = mysqli_query($conn, $sqryexam_subcategory_mst);
	 $cntrec_cat = mysqli_num_rows($srsexam_subcategory_mst); 
	if ($cntrec_cat < 1) {
  
		$iqryexam_subcategory_mst = "INSERT into exam_subcategory_mst(exam_subcategorym_prodmnexmsm_id,exam_subcategorym_name,exam_subcategorym_desc,exam_subcategorym_seotitle,exam_subcategorym_seodesc,exam_subcategorym_seokywrd, exam_subcategorym_seohone,exam_subcategorym_seohtwo,exam_subcategorym_sts,exam_subcategorym_prty, exam_subcategorym_crtdon,exam_subcategorym_crtdby)values('$exam_subcategory','$name','$desc','$seotitle','$seodesc','$seokywrd', '$seoh1','$seoh2','$sts',$prior, '$dt','$ses_admin')"; 
		$irsexam_subcategory_mst = mysqli_query($conn, $iqryexam_subcategory_mst);
    $gmsg = "Record saved successfully";
  }
} else {
  $gmsg = "Duplicate name. Record not saved";
}
							
		
					

			
			