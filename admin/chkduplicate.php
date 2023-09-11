<?php
/* echo "<pre>";
var_dump($_REQUEST);
echo "</pre>";
exit; */
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection
include_once "../includes/inc_usr_functions.php"; //Use function for validation and more

/***************************************************************
Programm 	  : chkduplicate.php	
Purpose 	  : For Checking Duplicate
Created By    : Mallikarjuna
Created On    :	20/03/2012
Modified By   : 
Modified On   : 
Purpose 	  : 
Company 	  : Adroit
 ************************************************************/
/************************************************************/


// ----------------------- to check duplicate main link name -----------------
if (isset($_REQUEST['prodmnexmsname']) && (trim($_REQUEST['prodmnexmsname']) != "")) {
	$name = glb_func_chkvl($_REQUEST['prodmnexmsname']);
	$sqryprodmncat_mst = "SELECT prodmnexmsm_name from prodmnexms_mst where prodmnexmsm_name='$name'";
	if (isset($_REQUEST['prodmncatid']) && ($_REQUEST['prodmncatid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['prodmncatid']);
		$sqryprodmncat_mst .= " and prodmnexmsm_id != $id";
	}
	// echo $sqryprodmncat_mst; exit;
	$srsprodmncat_mst = mysqli_query($conn, $sqryprodmncat_mst);
	$cnt = mysqli_num_rows($srsprodmncat_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Exam Name</strong></font>";
	}
}
// -----------------------END to check duplicate main link name -----------------
// ----------------------- to check duplicate years name -----------------
if (isset($_REQUEST['yearsname']) && (trim($_REQUEST['yearsname']) != "")) {
	$name = glb_func_chkvl($_REQUEST['yearsname']);
	$sqryyears_mst = "SELECT yearsm_name from years_mst where yearsm_name='$name'";
	if (isset($_REQUEST['prodmncatid']) && ($_REQUEST['prodmncatid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['prodmncatid']);
		$sqryyears_mst .= " and yearsm_id != $id";
	}
	// echo $sqryprodmncat_mst; exit;
	$srsyears_mst = mysqli_query($conn, $sqryyears_mst);
	$cnt = mysqli_num_rows($srsyears_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Year</strong></font>";
	}
}
// -----------------------END to check duplicate years name -----------------
// ----------------------- to check duplicate topics name -----------------
if (isset($_REQUEST['topicsname']) && (trim($_REQUEST['topicsname']) != "")) {
	$name = glb_func_chkvl($_REQUEST['topicsname']);
	$sqrytopics_mst = "SELECT topicsm_name from topics_mst where topicsm_name='$name'";
	if (isset($_REQUEST['prodmncatid']) && ($_REQUEST['prodmncatid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['prodmncatid']);
		$sqrytopics_mst .= " and topicsm_id != $id";
	}
	// echo $sqryprodmncat_mst; exit;
	$srstopics_mst = mysqli_query($conn, $sqrytopics_mst);
	$cnt = mysqli_num_rows($srstopics_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Name</strong></font>";
	}
}
// -----------------------END to check duplicate topics name -----------------
// ----------------------- to check duplicate Question name -----------------


if (isset($_REQUEST['addquesname']) && (trim($_REQUEST['addquesname']) != "") && isset($_REQUEST['exammnid']) && (trim($_REQUEST['exammnid']) != "")) {


	$name = addslashes(glb_func_chkvl($_REQUEST['addquesname']));
	$examnm = glb_func_chkvl($_REQUEST['exammnid']);
	$year = glb_func_chkvl($_REQUEST['yearmnid']);
	$exmsctid = glb_func_chkvl($_REQUEST['exmsctid']);
	$exmtypid = glb_func_chkvl($_REQUEST['exmtypid']);
	$sqryaddquess_mst = "SELECT addquesm_qnm from addques_mst where addquesm_prodmnexmsm_id='$examnm' and addquesm_qnm = '$name'  and addquesm_yearsm_id ='$year'  and addquesm_exmscat_id ='$exmsctid' and addquesm_typ_id ='$exmtypid'"; 
	if (isset($_REQUEST['qusid']) && ($_REQUEST['qusid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['qusid']);
		$sqryaddquess_mst .= " and addquesm_id != $id";
		
	}
	// echo $sqryaddquess_mst;exit;
	$srsaddquess_mst = mysqli_query($conn, $sqryaddquess_mst);
	$cnt = mysqli_num_rows($srsaddquess_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Question In The Combination Of Exam & Year </strong></font>";
	}
}
// -----------------------END to check duplicate Question name -----------------
// ----------------------- to check duplicate Category name -----------------
if (isset($_REQUEST['subtopicname']) && (trim($_REQUEST['subtopicname']) != "") && isset($_REQUEST['subtopicid']) && (trim($_REQUEST['subtopicid']) != "")) {
	$name = glb_func_chkvl($_REQUEST['subtopicname']);
	$prodmcat = glb_func_chkvl($_REQUEST['subtopicid']);

	$sqrysubtopics_mst = "SELECT subtopicsm_name from subtopics_mst where subtopicsm_topicsm_id='$prodmcat' and subtopicsm_name = '$name'"; 
	if (isset($_REQUEST['subtopicsid']) && ($_REQUEST['subtopicsid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['subtopicsid']);
		$sqrysubtopics_mst .= " and subtopicsm_id != $id";
	}
	$srssubtopics_mst = mysqli_query($conn, $sqrysubtopics_mst);
	$cnt = mysqli_num_rows($srssubtopics_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Combination Of Main Topics & Sub Topic Name</strong></font>";
	}
}
// -----------------------END to check duplicate Category name -----------------
// ----------------------- to check duplicate Sub Category name -----------------
if (isset($_REQUEST['prodscatname']) && (trim($_REQUEST['prodscatname']) != "") && isset($_REQUEST['prodmncatid']) && (trim($_REQUEST['prodmncatid']) != "") && isset($_REQUEST['prodcatid']) && (trim($_REQUEST['prodcatid']) != "")) {
	$name = glb_func_chkvl($_REQUEST['prodscatname']);
	$prodmncat = glb_func_chkvl($_REQUEST['prodmncatid']);
	$prodcat = glb_func_chkvl($_REQUEST['prodcatid']);
	$sqryprodscat_mst	= "select prodscatm_name from prodscat_mst where prodscatm_prodcatm_id='$prodcat' and prodscatm_prodmnexmsm_id='$prodmncat' and prodscatm_name='$name'";
	if (isset($_REQUEST['subcatid']) && ($_REQUEST['subcatid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['subcatid']);
		$sqryprodscat_mst .= " and prodscatm_id!=$id";
	}
	$srsprodscat_mst = mysqli_query($conn, $sqryprodscat_mst);
	$cnt = mysqli_num_rows($srsprodscat_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Combination Of Main Category, Category & Name</strong></font>";
	}
}

// ----------------------- to check duplicate Advertisement name -----------------
if (isset($_REQUEST['advdname']) && (trim($_REQUEST['advdname']) != "")) {
	// checking Duplicate name for Categoryone
	$result = "";
	$advdname = glb_func_chkvl($_REQUEST['advdname']);
	$sqryadvd_mst = "select 
								advdm_name 
							from 
								advd_mst
						   	where 
						   		advdm_name = '" . $advdname . "'";
	if (isset($_REQUEST['advdid']) && (trim($_REQUEST['advdid']) != "")) {
		$advdid = glb_func_chkvl($_REQUEST['advdid']);
		$sqryadvd_mst .= " and advdm_id != $advdid";
	}
	$srsadvd_mst  = mysqli_query($conn, $sqryadvd_mst);
	$reccnt_advd  = mysqli_num_rows($srsadvd_mst);
	if ($reccnt_advd > 0) {
		$result = "<font color ='red'><b>Duplicate Name</b></font>";
	}
	echo $result;
}
// ------------------------------------------------------------------------------
// ----------------------- to check duplicate Sub Category name -----------------
if (isset($_REQUEST['bnrname']) && (trim($_REQUEST['bnrname']) != "")) {
	// checking Duplicate name for Categoryone
	$result = "";
	$bnrname = glb_func_chkvl($_REQUEST['bnrname']);
	$sqrybnr_mst = "select 
								bnrm_name 
							from 
								bnr_mst
						   	where 
						   		bnrm_name = '" . $bnrname . "'";
	if (isset($_REQUEST['bnrid']) && (trim($_REQUEST['bnrid']) != "")) {
		$bnrid = glb_func_chkvl($_REQUEST['bnrid']);
		$sqrybnr_mst .= " and bnrm_id != $bnrid";
	}
	$srsbnr_mst  = mysqli_query($conn, $sqrybnr_mst);
	$reccnt_bnr  = mysqli_num_rows($srsbnr_mst);
	if ($reccnt_bnr > 0) {
		$result = "<font color ='red'><b>Duplicate Name</b></font>";
	}
	echo $result;
}
// ------------------------------------------------------------------------------
if (isset($_REQUEST['bodname']) && (trim($_REQUEST['bodname']) != "") && isset($_REQUEST['bodtyp']) && (trim($_REQUEST['bodtyp']) != "")) {
	// checking Duplicate name for Categoryone
	$result = "";
	$bodname = glb_func_chkvl($_REQUEST['bodname']);
	$bodtyp = glb_func_chkvl($_REQUEST['bodtyp']);
	$sqrybod_mst = "SELECT bodm_name from bod_mst where bodm_name = '" . $bodname . "' and bodm_typ = '" . $bodtyp . "'";
	if (isset($_REQUEST['bodid']) && (trim($_REQUEST['bodid']) != "")) {
		$bodid = glb_func_chkvl($_REQUEST['bodid']);
		$sqrybod_mst .= " and bodm_id != $bodid";
	}
	$srsbod_mst  = mysqli_query($conn, $sqrybod_mst);
	$reccnt_bod  = mysqli_num_rows($srsbod_mst);
	if ($reccnt_bod > 0) {
		$result = "<font color ='red'><b>Duplicate Name</b></font>";
	}
	echo $result;
}
// -----------------------------------------------------------------------------------------
// ----------------------- to check duplicate Grad Types -----------------
if (isset($_REQUEST['grad_typname']) && (trim($_REQUEST['grad_typname']) != "")) {
	// checking Duplicate name for Categoryone
	$result = "";
	$grad_typname = glb_func_chkvl($_REQUEST['grad_typname']);
	$sqrygradtyp_mst = "SELECT grad_typm_name from grad_typ_mst where grad_typm_name ='".$grad_typname."'";
	if (isset($_REQUEST['grad_typid']) && (trim($_REQUEST['grad_typid']) != "")) {
		$grad_typid = glb_func_chkvl($_REQUEST['grad_typid']);
		$sqrygradtyp_mst .= " and grad_typm_id != $grad_typid";
	}
	$srsbnr_mst = mysqli_query($conn, $sqrygradtyp_mst);
	$reccnt_bnr = mysqli_num_rows($srsbnr_mst);
	if ($reccnt_bnr > 0) {
		$result = "<font color ='red'><b>Duplicate Name</b></font>";
	}
	echo $result;
}
// -----------------------------------------------------------------------------------------
// --------------------------------------exective program category---------------------------------------------------
if (isset($_REQUEST['exect_catname']) && (trim($_REQUEST['exect_catname']) != "")) {
	// checking Duplicate name for Categoryone
	$result = "";
	$exect_catname = glb_func_chkvl($_REQUEST['exect_catname']);
	$sqrygradtyp_mst = "SELECT exect_catm_name from exect_cat_mst where exect_catm_name ='".$exect_catname."'";
	if (isset($_REQUEST['exect_catid']) && (trim($_REQUEST['exect_catid']) != "")) {
		$exect_catid = glb_func_chkvl($_REQUEST['exect_catid']);
		$sqrygradtyp_mst .= " and exect_catm_id != $exect_catid";
	}
	$srsbnr_mst = mysqli_query($conn, $sqrygradtyp_mst);
	$reccnt_bnr = mysqli_num_rows($srsbnr_mst);
	if ($reccnt_bnr > 0) {
		$result = "<font color ='red'><b>Duplicate Name</b></font>";
	}
	echo $result;
}
// ------------------------------------------------------------------------------------------------
// ------------------------------- exective program sub category---------------------------------------
if (isset($_REQUEST['exect_scatname']) && (trim($_REQUEST['exect_scatname']) != "") && isset($_REQUEST['exect_scatcatid']) && (trim($_REQUEST['exect_scatcatid']) != "")) {
	// checking Duplicate name for Categoryone
	$result = "";
	$exect_scatname = glb_func_chkvl($_REQUEST['exect_scatname']);
	$exect_catid = glb_func_chkvl($_REQUEST['exect_scatcatid']);
	$sqryexecprg_mst = "SELECT exect_scatm_name from exect_scat_mst where exect_scatm_name ='" . $exect_scatname . "' and exect_scatm_catm_id ='" . $exect_catid . "'";
	if (isset($_REQUEST['exect_scatid']) && (trim($_REQUEST['exect_scatid']) != "")) {
		$exect_scatid = glb_func_chkvl($_REQUEST['exect_scatid']);
		$sqryexecprg_mst .= " and exect_scatm_id != $exect_scatid";
	}
	$srsexecprg_mst = mysqli_query($conn, $sqryexecprg_mst);
	$reccnt_execprg = mysqli_num_rows($srsexecprg_mst);
	if ($reccnt_execprg > 0) {
		$result = "<font color ='red'><b>Duplicate Name in the combination</b></font>";
	}
	echo $result;
}
// ------------------------------------------------------------------------------------------------
// ------------------------------- exective program sub category---------------------------------------
if (isset($_REQUEST['exect_progname']) && (trim($_REQUEST['exect_progname']) != "") && isset($_REQUEST['exect_progcatid']) && (trim($_REQUEST['exect_progcatid']) != "") && isset($_REQUEST['exect_progscatid']) && (trim($_REQUEST['exect_progscatid']) != "")) {
	// checking Duplicate name for Categoryone
	$result = "";
	$exect_progname = glb_func_chkvl($_REQUEST['exect_progname']);
	$exect_catid = glb_func_chkvl($_REQUEST['exect_progcatid']);
	$exect_scatid = glb_func_chkvl($_REQUEST['exect_progscatid']);
	$sqryexecprg_mst = "SELECT exect_progm_name from exect_prog_mst where exect_progm_name ='" . $exect_progname . "' and exect_progm_catm_id ='" . $exect_catid . "' and exect_progm_scatm_id ='" . $exect_scatid . "'";
	if (isset($_REQUEST['exect_progid']) && (trim($_REQUEST['exect_progid']) != "")) {
		$exect_progid = glb_func_chkvl($_REQUEST['exect_progid']);
		$sqryexecprg_mst .= " and exect_progm_id != $exect_progid";
	}
	$srsexecprg_mst = mysqli_query($conn, $sqryexecprg_mst);
	$reccnt_execprg = mysqli_num_rows($srsexecprg_mst);
	if ($reccnt_execprg > 0) {
		$result = "<font color ='red'><b>Duplicate Name in the combination</b></font>";
	}
	echo $result;
}
// ------------------------------------------------------------------------------------------------
// ------------------------ Check course name duplicate ------------------------------
if (isset($_REQUEST['coursename']) && (trim($_REQUEST['coursename']) != "") && isset($_REQUEST['gradtyp']) && (trim($_REQUEST['gradtyp']) != "")) {
	$result = "";
	$gradtyp = glb_func_chkvl($_REQUEST['gradtyp']);
	$coursename = glb_func_chkvl($_REQUEST['coursename']);
	$sqrycrs_mst = "SELECT Coursm_name from cours_mst where Coursm_name ='$coursename' and Coursm_typ ='$gradtyp'";
	if (isset($_REQUEST['coursid']) && (trim($_REQUEST['coursid']) != "")) {
		$coursid = glb_func_chkvl($_REQUEST['coursid']);
		$sqrycrs_mst .= " and Coursm_id != $coursid";
	}
	$srscrs_mst = mysqli_query($conn, $sqrycrs_mst);
	$reccnt_crs = mysqli_num_rows($srscrs_mst);
	if ($reccnt_crs > 0) {
		$result = "<font color ='red'><b>Duplicate Name in the combination.</b></font>";
	}
	echo $result;
}
// -----------------------------------------------------------------------------------------
if (isset($_REQUEST['prtnrname']) && (trim($_REQUEST['prtnrname']) != "") && isset($_REQUEST['typ']) && (trim($_REQUEST['typ']) != "")) {
	// checking Duplicate name for Categoryone
	$result = "";
	$typ = glb_func_chkvl($_REQUEST['typ']);
	$prtnrname = glb_func_chkvl($_REQUEST['prtnrname']);
	$sqryprtnr_mst = "SELECT prtnrm_name from prtnr_mst where prtnrm_name = '" . $prtnrname . "' and prtnrm_typ = '" . $typ . "'";
	if (isset($_REQUEST['prtnrid']) && (trim($_REQUEST['prtnrid']) != "")) {
		$prtnrid = glb_func_chkvl($_REQUEST['prtnrid']);
		$sqryprtnr_mst .= " and prtnrm_id != $prtnrid";
	}
	$srsprtnr_mst = mysqli_query($conn, $sqryprtnr_mst);
	$reccnt_prtnr = mysqli_num_rows($srsprtnr_mst);
	if ($reccnt_prtnr > 0) {
		$result = "<font color ='red'><b>Duplicate Name</b></font>";
	}
	echo $result;
}
if (
	isset($_REQUEST['evntname']) && (trim($_REQUEST['evntname']) != "") &&
	isset($_REQUEST['evntstrtdt']) && (trim($_REQUEST['evntstrtdt']) != "")
) {
	$result = "";
	$name = glb_func_chkvl($_REQUEST['evntname']);
	$strtdt = glb_func_chkvl($_REQUEST['evntstrtdt']);
	$sqryevnt_mst = "select evntm_name from evnt_mst
						 where evntm_name = '". $name ."' and
						 evntm_strtdt = '$strtdt'";

	if (isset($_REQUEST['evntid']) && (trim($_REQUEST['evntid']) != "")) {
		$evntid = glb_func_chkvl($_REQUEST['evntid']);
	$sqryevnt_mst .= " and evntm_id != $evntid";
	}
	$srsevnt_mst  = mysqli_query($conn, $sqryevnt_mst);
	$reccnt		   = mysqli_num_rows($srsevnt_mst);
	if ($reccnt > 0) {
		$result = "<font color ='red'><b>Duplicate Name And Date</b></font>";
	}
	
	echo $result;
}
if (isset($_REQUEST['newsname']) && (trim($_REQUEST['newsname']) != "")) {
	$result = "";
	$newsname = glb_func_chkvl($_REQUEST['newsname']);
	$sqrynew_mst = "select 	
								nwsm_name 
						   from 
								nws_mst
						   where 
								nwsm_name = '" . $newsname . "'";
	if (isset($_REQUEST['newsid']) && (trim($_REQUEST['newsid']) != "")) {
		$newsid = glb_func_chkvl($_REQUEST['newsid']);
		$sqrynew_mst .= " and nwsm_id != $newsid";
	}
	$srsnew_mst  = mysqli_query($conn, $sqrynew_mst);
	$reccnt		   = mysqli_num_rows($srsnew_mst);
	if ($reccnt > 0) {
		$result = "<font color ='red'><b>Duplicate name</b></font>";
	}
	echo $result;
}


if (isset($_REQUEST['exmname']) && (trim($_REQUEST['exmname']) != "")) {
	$result = "";
	$exmsname = glb_func_chkvl($_REQUEST['exmname']);
	$sqryexm_mst = "select 	
								exmsm_name 
						   from 
								exms_mst
						   where 
								exmsm_name = '" . $exmsname . "'";
	if (isset($_REQUEST['exmid']) && (trim($_REQUEST['exmid']) != "")) {
		$exmid = glb_func_chkvl($_REQUEST['exmid']);
		$sqryexm_mst .= " and nwsm_id != $exmid";
	}
	$srsexm_mst  = mysqli_query($conn, $sqryexm_mst);
	$reccnt		   = mysqli_num_rows($srsexm_mst);
	if ($reccnt > 0) {
		$result = "<font color ='red'><b>Duplicate name</b></font>";
	}
	echo $result;
}

if (isset($_REQUEST['brndname']) && (trim($_REQUEST['brndname']) != ""))	// checking Duplicate name for Brand name
{
	$result 	  = "";
	$name 		  = glb_func_chkvl($_REQUEST['brndname']);
	$sqrybrnd_mst = "select 	
							 brndm_name 
						 from 
						 	brnd_mst
						 where 
						 	brndm_name = '" . $name . "'";
	if (isset($_REQUEST['brndid']) && (trim($_REQUEST['brndid']) != "")) {
		$brndid = $_REQUEST['brndid'];
		$sqrybrnd_mst .= " and brndm_id != $brndid";
	}
	$srsbrnd_mst  = mysqli_query($conn, $sqrybrnd_mst);
	$reccnt		   = mysqli_num_rows($srsbrnd_mst);

	if ($reccnt > 0) {
		$result = "<font color ='red'><b>Duplicate name</b></font>";
	}
	echo $result;
}

if (isset($_REQUEST['stdtestmnl']) && (trim($_REQUEST['stdtestmnl']) != ""))	// checking Duplicate name for Student Testimonial Name

{
	$result 	  = "";
	$name 		  = glb_func_chkvl($_REQUEST['stdtestmnl']);
	$sqrybrnd_mst = "select 	
	std_testmnlm_name 
						 from 
						 std_testmnl_mst
						 where 
						 std_testmnlm_name = '" . $name . "'";
	if (isset($_REQUEST['stdtest']) && (trim($_REQUEST['stdtest']) != "")) {
		$stdtest = $_REQUEST['stdtest'];
		$sqrybrnd_mst .= " and std_testmnlm_id != $stdtest";
	}
	$srsbrnd_mst  = mysqli_query($conn, $sqrybrnd_mst);
	$reccnt		   = mysqli_num_rows($srsbrnd_mst);

	if ($reccnt > 0) {
		$result = "<font color ='red'><b>Duplicate name</b></font>";
	}
	echo $result;
}

if (isset($_REQUEST['product']) && (trim($_REQUEST['product']) != ""))	// checking Duplicate name for Downloads Category Name

{
	$result 	  = "";
	$name 		  = glb_func_chkvl($_REQUEST['product']);
	$sqrybrnd_mst = "select 	
	prodm_name 
						 from 
						 prod_mst
						 where 
						 prodm_name = '" . $name . "'";
	if (isset($_REQUEST['prod']) && (trim($_REQUEST['prod']) != "")) {
		$prod = $_REQUEST['prod'];
		$sqrybrnd_mst .= " and prodm_id != $prod";
	}
	$srsbrnd_mst  = mysqli_query($conn, $sqrybrnd_mst);
	$reccnt		   = mysqli_num_rows($srsbrnd_mst);

	if ($reccnt > 0) {
		$result = "<font color ='red'><b>Duplicate name</b></font>";
	}
	echo $result;
}

if (isset($_REQUEST['abtus']) && (trim($_REQUEST['abtus']) != ""))	// checking Duplicate name for About Us Name

{
	$result 	  = "";
	$name 		  = glb_func_chkvl($_REQUEST['abtus']);
	$sqrybrnd_mst = "select 	
	abtusm_name 
						 from 
						 abtus_mst
						 where 
						 abtusm_name = '" . $name . "'";
	if (isset($_REQUEST['abt']) && (trim($_REQUEST['abt']) != "")) {
		$abt = $_REQUEST['abt'];
		$sqrybrnd_mst .= " and abtusm_id != $abt";
	}
	$srsbrnd_mst  = mysqli_query($conn, $sqrybrnd_mst);
	$reccnt		   = mysqli_num_rows($srsbrnd_mst);

	if ($reccnt > 0) {
		$result = "<font color ='red'><b>Duplicate name</b></font>";
	}
	echo $result;
}


// if (isset($_REQUEST['prodname']) && (trim($_REQUEST['prodname']) != ""))	// checking Duplicate name for Downloads Category Name

// {
// 	$result 	  = "";
// 	$name 		  = glb_func_chkvl($_REQUEST['prodname']);
// 	$sqrybrnd_mst = "select 	
// 	prodm_name 
// 						 from 
// 						 prod_mst
// 						 where 
// 						 prodm_name = '" . $name . "'";
// 	if (isset($_REQUEST['prod']) && (trim($_REQUEST['prod']) != "")) {
// 		$prod = $_REQUEST['prod'];
// 		$sqrybrnd_mst .= " and prodm_id != $prod";
// 	}
// 	$srsbrnd_mst  = mysqli_query($conn, $sqrybrnd_mst);
// 	$reccnt		   = mysqli_num_rows($srsbrnd_mst);

// 	if ($reccnt > 0) {
// 		$result = "<font color ='red'><b>Duplicate name</b></font>";
// 	}
// 	echo $result;
// }


if (isset($_REQUEST['prodname']) && (trim($_REQUEST['prodname']) != "") && isset($_REQUEST['prodm_id']) && (trim($_REQUEST['prodm_id']) != "")) { // Download Category And Download Name
	$name = glb_func_chkvl($_REQUEST['prodname']);
	$prodmcat = glb_func_chkvl($_REQUEST['prodm_id']);

	$sqrydownload_mst = "select dwnld_name from dwnld_dtl where dwnld_prodm_id='$prodmcat' and dwnld_name = '$name'";
	if (isset($_REQUEST['prodid']) && ($_REQUEST['prodid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['prodid']);
		$sqrydownload_mst .= " and dwnld_id != $id";
	}
	$srsprodcat_mst = mysqli_query($conn, $sqrydownload_mst);
	$cnt = mysqli_num_rows($srsprodcat_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Combination Of Downloads Category & Downloads Name</strong></font>";
	}
}


if (isset($_REQUEST['prodcatname']) && (trim($_REQUEST['prodcatname']) != "")) {
	$name	= glb_func_chkvl($_REQUEST['prodcatname']);

	$sqryprodcat_mst	= "select 
									prodcatm_name
							   from 
									prodcat_mst
							   where 
									prodcatm_name='$name'";
	exit;
	if (isset($_REQUEST['prodid']) && ($_REQUEST['prodid'] != "")) {

		$id = glb_func_chkvl($_REQUEST['prodid']);
		$sqryprodcat_mst .= " and prodcatm_id!=$id";
	}

	$srsprodcat_mst = mysqli_query($conn, $sqryprodcat_mst);
	$cnt           = mysqli_num_rows($srsprodcat_mst);
	if ($cnt > 0) {

		echo "<font color=red><strong>Duplicate Name</strong></font>";
	}
}

if (
	isset($_REQUEST['prodname']) && (trim($_REQUEST['prodname']) != "") &&
	isset($_REQUEST['prodcatid']) && (trim($_REQUEST['prodcatid']) != "")
) {
	$name	     	= glb_func_chkvl($_REQUEST['prodname']);
	$prodcat	   	= glb_func_chkvl($_REQUEST['prodcatid']);

	$sqryprodcat_mst	= "select 
									prodm_name
							   from 
									prod_mst
							   where 
									prodm_prodcatm_id='$prodcat' and					   
									prodm_name='$name'";
	if (isset($_REQUEST['prodid']) && ($_REQUEST['prodid'] != "")) {

		$id = glb_func_chkvl($_REQUEST['prodid']);
		$sqryprodcat_mst .= " and prodm_id!=$id";
	}

	$srsprodcat_mst = mysqli_query($conn, $sqryprodcat_mst);
	$cnt           = mysqli_num_rows($srsprodcat_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Combination Of Category&Name</strong></font>";
	}
}
if (
	isset($_REQUEST['pagcntnname']) && (trim($_REQUEST['pagcntnname']) != "") &&
	isset($_REQUEST['catname']) && (trim($_REQUEST['catname']) != "")
) {
	// checking Duplicate name for page contain
	$result = "";
	$pagcntnname = glb_func_chkvl($_REQUEST['pagcntnname']);
	$arycatid 		 = glb_func_chkvl($_REQUEST['catname']);
	$catid = explode('-', $arycatid);
	$sqrypgcnts_dtl = "select 
								pgcntsd_name 
							  from 
							  	vw_pgcnts_prodcat_prodscat_mst
						  	 where 
							 	pgcntsd_name = '" . $pagcntnname . "' and
								prodcatm_id = '" . $catid[0] . "'";

	if (isset($_REQUEST['deptid']) && (trim($_REQUEST['deptid']) != '')) {
		$dept     = glb_func_chkvl($_REQUEST['deptid']);
		$sqrypgcnts_dtl  .= " and pgcntsd_deptm_id=$dept";
	} else {
		$dept = 'NULL';
		$sqrypgcnts_dtl  .= " and pgcntsd_deptm_id IS NULL";
	}

	if (isset($_REQUEST['scatname']) && (trim($_REQUEST['scatname']) != '')) {
		$cattwo   = glb_func_chkvl($_REQUEST['scatname']);
		$sqrypgcnts_dtl  .= " and pgcntsd_prodscatm_id=$cattwo";
	} else {
		$cattwo = 'NULL';
		$sqrypgcnts_dtl  .= " and pgcntsd_prodscatm_id IS NULL";
	}
	if (isset($_REQUEST['pgcntid']) && (trim($_REQUEST['pgcntid']) != "")) {
		$pgcntsid = glb_func_chkvl($_REQUEST['pgcntid']);
		$sqrypgcnts_dtl .= " and pgcntsd_id != $pgcntsid";
	}

	$srspgcnts_dtl  = mysqli_query($conn, $sqrypgcnts_dtl);
	$reccnt_pgcnts  = mysqli_num_rows($srspgcnts_dtl);
	if ($reccnt_pgcnts > 0) {
		$result = "<font color ='red'><b>Duplicate Name</b></font>";
	}
	echo $result;
}




if (
	isset($_REQUEST['acadname']) && (trim($_REQUEST['acadname']) != "") &&
	isset($_REQUEST['dept']) && (trim($_REQUEST['dept']) != "")
) {
	// checking Duplicate name for page contain
	$result = "";
	$acadname = glb_func_chkvl($_REQUEST['acadname']);
	$arycatid 		 = glb_func_chkvl($_REQUEST['dept']);
	$catid = explode('-', $arycatid);
	$sqrypgcnts_dtl = "select 
								acadm_name,acadm_deptm_id,acadm_depsemm_id,acadm_id 
							  from 
							  	acad_mst
						  	 where 
							 	acadm_name = '" . $acadname . "' and
								acadm_deptm_id = '" . $catid[0] . "'";



	if (isset($_REQUEST['sem']) && (trim($_REQUEST['sem']) != '')) {
		$sem   = glb_func_chkvl($_REQUEST['sem']);


		$sqrypgcnts_dtl  .= " and acadm_depsemm_id = $sem";
	} else {
		$sem = 'NULL';
		$sqrypgcnts_dtl  .= " and acadm_depsemm_id IS NULL";
	}
	if (isset($_REQUEST['acadid']) && (trim($_REQUEST['acadid']) != "")) {
		$acadid = glb_func_chkvl($_REQUEST['acadid']);
		$sqrypgcnts_dtl .= " and acadm_id = $acadid";
	}
	//	echo $sqrypgcnts_dtl;//exit;
	$srspgcnts_dtl  = mysqli_query($conn, $sqrypgcnts_dtl);

	$reccnt_pgcnts  = mysqli_num_rows($srspgcnts_dtl);
	if ($reccnt_pgcnts == 1) {

		$result = "<font color ='red'><b>Duplicate Name</b></font>";
	}
	echo $result;
}







if (isset($_REQUEST['userid']) && (trim($_REQUEST['userid']) != "")) {
	$result = "";
	$usrid = strip_tags(substr(trim($_REQUEST['userid']), 0, 249));
	$sqrylgn_mst  = "select lgnm_uid  from lgn_mst 
						 where lgnm_uid = '" . $usrid . "'";
	if (isset($_REQUEST['idval']) && (trim($_REQUEST['idval']) != "")) {
		$id = $_REQUEST['idval'];
		$sqrylgn_mst .= " and lgnm_id!= $id";
	}
	$srslgn_mst  = mysqli_query($conn, $sqrylgn_mst);
	$reccnt		 = mysqli_num_rows($srslgn_mst);
	if ($reccnt > 0) {
		$result = "<font color ='red'><b>Duplicate name</b></font>";
	}
	echo $result;
}
if (isset($_REQUEST['deptname']) && (trim($_REQUEST['deptname']) != "")) {
	$name	      = glb_func_chkvl($_REQUEST['deptname']);
	$sqrydept_mst = "select 
							deptm_name
						 from 
							dept_mst
						 where 
							deptm_name='$name'";
	if (isset($_REQUEST['deptid']) && ($_REQUEST['deptid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['deptid']);
		$sqrydept_mst .= " and deptm_id!=$id";
	}
	$srsdept_mst = mysqli_query($conn, $sqrydept_mst);
	$cnt         = mysqli_num_rows($srsdept_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Name</strong></font>";
	}
}


if (isset($_REQUEST['depsemname']) && (trim($_REQUEST['depsemname']) != "")) {
	$name	      = glb_func_chkvl($_REQUEST['depsemname']);
	$sqrydept_mst = "select 
							depsemm_name
						 from 
							depsem_mst

						 where 
							depsemm_name='$name'";
	if (isset($_REQUEST['depsemid']) && ($_REQUEST['depsemid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['depsemid']);
		$sqrydept_mst .= " and depsemm_id!=$id";
	}
	$srsdept_mst = mysqli_query($conn, $sqrydept_mst);
	$cnt         = mysqli_num_rows($srsdept_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Name</strong></font>";
	}
}




if (isset($_REQUEST['facname']) && (trim($_REQUEST['facname']) != "")) {
	$name	      = glb_func_chkvl($_REQUEST['facname']);
	$sqrydept_mst = "select 
							 	factym_name
						 from 
							facty_mst

						 where 
							factym_name='$name'";
	if (isset($_REQUEST['facid']) && ($_REQUEST['facid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['facid']);
		$sqrydept_mst .= " and factym_id!=$id";
	}
	$srsdept_mst = mysqli_query($conn, $sqrydept_mst);
	$cnt         = mysqli_num_rows($srsdept_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Name</strong></font>";
	}
}


if (isset($_REQUEST['depsemcode']) && (trim($_REQUEST['depsemcode']) != "")) {
	$code	      = glb_func_chkvl($_REQUEST['depsemcode']);
	$sqrydept_mst = "select 
							depsemm_code
						 from 
							depsem_mst

						 where 
							depsemm_code='$code'";
	if (isset($_REQUEST['depsemid']) && ($_REQUEST['depsemid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['depsemid']);
		$sqrydept_mst .= " and depsemm_id!=$id";
	}
	$srsdept_mst = mysqli_query($conn, $sqrydept_mst);
	$cnt         = mysqli_num_rows($srsdept_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Code</strong></font>";
	}
}

if (isset($_REQUEST['acadcode']) && (trim($_REQUEST['acadcode']) != "")) {
	$code	      = glb_func_chkvl($_REQUEST['acadcode']);
	$sqrydept_mst = "select 
							acadm_code
						 from 
							acad_mst

						 where 
							acadm_code='$code'";
	if (isset($_REQUEST['acadid']) && ($_REQUEST['acadid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['acadid']);
		$sqrydept_mst .= " and acadm_id!=$id";
	}
	$srsdept_mst = mysqli_query($conn, $sqrydept_mst);
	$cnt         = mysqli_num_rows($srsdept_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Code</strong></font>";
	}
}


if (isset($_REQUEST['mdlname']) && (trim($_REQUEST['mdlname']) != "")) {
	$name	      = glb_func_chkvl($_REQUEST['mdlname']);
	$sqrymdl_mst = "select 
							mdlm_name
						 from 
							mdl_mst
						 where 
							mdlm_name='$name'";
	if (isset($_REQUEST['mdlid']) && ($_REQUEST['mdlid'] != "")) {
		$id = glb_func_chkvl($_REQUEST['mdlid']);
		$sqrymdl_mst .= " and mdlm_id!=$id";
	}
	$srsmdl_mst = mysqli_query($conn, $sqrymdl_mst);
	$cnt        = mysqli_num_rows($srsmdl_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Name</strong></font>";
	}
}
// ----------------------- to check duplicate placement year name -----------------
if (isset($_REQUEST['plcmtname']) && (trim($_REQUEST['plcmtname']) != "")) {
	$name = glb_func_chkvl($_REQUEST['plcmtname']);
	$sqryplcmt_mst = "SELECT plcmtm_name from plcmt_mst where plcmtm_name='$name'";
	if (isset($_REQUEST['plcmtm_id']) && ($_REQUEST['plcmtm_id'] != "")) {
		$id = glb_func_chkvl($_REQUEST['plcmtm_id']);
		$sqryplcmt_mst .= " and plcmtm_id != $id";
	}
	// echo $sqryprodmncat_mst; exit;
	$srsplcmt_mst = mysqli_query($conn, $sqryplcmt_mst);
	$cnt = mysqli_num_rows($srsplcmt_mst);
	if ($cnt > 0) {
		echo "<font color=red><strong>Duplicate Name</strong></font>";
	}
}
// -----------------------END to check duplicate placement name -----------------

// -----------------------START to check duplicate Achievements name -----------------
if (isset($_REQUEST['achmntname']) && (trim($_REQUEST['achmntname']) != "")) {

	$result = "";
	$achmntname = glb_func_chkvl($_REQUEST['achmntname']);
	$sqryach_mst = "SELECT 
								achmntm_name 
							from 
							achmnt_mst
						   	where 
							   achmntm_name = '" . $achmntname . "'";
	if (isset($_REQUEST['achmntid']) && (trim($_REQUEST['achmntid']) != "")) {
		$achmntid = glb_func_chkvl($_REQUEST['achmntid']);
		$sqryach_mst .= " and achmntm_id != $achmntid";
	}
	$srsach_mst  = mysqli_query($conn, $sqryach_mst);
	$reccnt_ach  = mysqli_num_rows($srsach_mst);
	if ($reccnt_ach > 0) {
		$result = "<font color ='red'><b>Duplicate Name</b></font>";
	}
	echo $result;
}
// -----------------------END to check duplicate Achievements name -----------------
// -----------------------START to check duplicate Events and News name -----------------
if(isset($_REQUEST['evntname']) && (trim($_REQUEST['evntname']) != "") &&
		isset($_REQUEST['evntid']) && (trim($_REQUEST['evntid']) != "")){
		$result = "";
		$name = glb_func_chkvl($_REQUEST['evntname']);
		$evntid = glb_func_chkvl($_REQUEST['evntid']);
		$sqryevnt_mst = "SELECT evntm_name from evnt_mst where evntm_name = '$name' and evntm_typ = '$evntid'"; 
		
		if(isset($_REQUEST['evnt_id']) && (trim($_REQUEST['evnt_id']) != ""))
		{
			$evntid = glb_func_chkvl($_REQUEST['evnt_id']);
			$sqryevnt_mst .= " and evntm_id != $evntid";	
		}	
		$srsevnt_mst  = mysqli_query($conn,$sqryevnt_mst);
		$reccnt		   = mysqli_num_rows($srsevnt_mst);
		if($reccnt > 0)
		{
			$result = "<font color ='red'><b>Duplicate Name</b></font>";
		}
		echo $result;
	}
	
// -----------------------End to check duplicate Events and News name -----------------
// if (isset($_REQUEST['prodcatname']) && (trim($_REQUEST['prodcatname']) != "") && isset($_REQUEST['prodmcatid']) && (trim($_REQUEST['prodmcatid']) != "")) {
// 	$name = glb_func_chkvl($_REQUEST['prodcatname']);
// 	$prodmcat = glb_func_chkvl($_REQUEST['prodmcatid']);

// 	$sqryprodcat_mst = "SELECT prodcatm_name from prodcat_mst where prodcatm_prodmnexmsm_id='$prodmcat' and prodcatm_name = '$name'";
// 	if (isset($_REQUEST['prodcatid']) && ($_REQUEST['prodcatid'] != "")) {
// 		$id = glb_func_chkvl($_REQUEST['prodcatid']);
// 		$sqryprodcat_mst .= " and prodcatm_id != $id";
// 	}
// 	$srsprodcat_mst = mysqli_query($conn, $sqryprodcat_mst);
// 	$cnt = mysqli_num_rows($srsprodcat_mst);
// 	if ($cnt > 0) {
// 		echo "<font color=red><strong>Duplicate Combination Of Main Link & Category Name</strong></font>";
// 	}
// }
// ----------------------------------------------------Users Valiodation--------------------------------------------------------------
if (isset($_REQUEST['usrnm'])&& (trim($_REQUEST['usrnm']) != ""))
{
	$result ="";
	$usrnm = glb_func_chkvl($_REQUEST['usrnm']);			 
	$sqryusr_mst ="SELECT lgnm_uid FROM lgn_mst WHERE lgnm_uid = '".mysqli_real_escape_string($conn,$usrnm)."'";
	if(isset($_REQUEST['usrid']) && (trim($_REQUEST['usrid']) != ""))
	{
		$usr_id = glb_func_chkvl($_REQUEST['usrid']);
		$sqryusr_mst .= " and lgnm_id != $usr_id";	
	}
	$srsusr_mst  = mysqli_query($conn,$sqryusr_mst);
	$reccnt		   = mysqli_num_rows($srsusr_mst);		
	if($reccnt > 0)
	{
		$result = "<font color ='red'><b>Duplicate Username</b></font>";
	}
	echo $result;
}