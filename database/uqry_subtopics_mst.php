<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth;
global $ses_admin;
if (isset($_POST['btnesubtopicssbmt']) && (trim($_POST['btnesubtopicssbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")) {
	//echo "here";exit;
	$subtopics = glb_func_chkvl($_POST['lstcat']);
	$id = glb_func_chkvl($_POST['hdnsubtopicsid']);
	$name = glb_func_chkvl($_POST['txtname']);
	$prior = glb_func_chkvl($_POST['txtprty']);
	//$hmprior = glb_func_chkvl($_POST['txthmprior']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$admtyp = glb_func_chkvl($_POST['admtype']); //admissions type ug/pg
	$title = glb_func_chkvl($_POST['txtseotitle']);
	$seodesc = glb_func_chkvl($_POST['txtseodesc']);
	$kywrd = glb_func_chkvl($_POST['txtseokywrd']);
	// $gnrtdfrm = glb_func_chkvl($_POST['lstcntnttyp']);
	$seoh1 = glb_func_chkvl($_POST['txtseoh1']);
	$seoh2 = glb_func_chkvl($_POST['txtseoh2']);
	$seoh1_desc = glb_func_chkvl($_POST['txtseoh1desc']);
	$seoh2_desc = glb_func_chkvl($_POST['txtseoh2desc']);
	/* $cattyp = glb_func_chkvl($_POST['lstcattyp']);
	$disptyp = glb_func_chkvl($_POST['lstdsplytyp']); */
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$hdnsmlimg = glb_func_chkvl($_POST['hdnsmlimg']);
	$hdnbnrimg = glb_func_chkvl($_POST['hdnbgimg']);
	$sts = glb_func_chkvl($_POST['lststs']);
	$srchval = glb_func_chkvl($_REQUEST['hdnval']);
	$chk = glb_func_chkvl($_REQUEST['hdnchk']);
	$cur_dt = date('Y-m-d h:i:s');
	$loc = "&val=$srchval";
	if ($chk != '') {
		$loc .= "&chk=y";
	}
	$sqrysubtopics_mst = "SELECT subtopicsm_name  from subtopics_mst where subtopicsm_name='$name' and subtopicsm_topicsm_id = '$subtopics' and subtopicsm_id='$id'";
	$srssubtopics_mst = mysqli_query($conn, $sqrysubtopics_mst);
	$rows_cnt = mysqli_num_rows($srssubtopics_mst);
	if ($rows_cnt > 1) { ?>
		<script type="text/javascript">
			location.href = "view_detail_subtopics.php?vw=<?php echo $id; ?>&sts=d&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		</script>
		<?php
	} else {
		$uqrysubtopics_mst = "UPDATE subtopics_mst set 
		subtopicsm_name='$name', 
		subtopicsm_topicsm_id ='$subtopics',
		subtopicsm_sts='$sts', 
		subtopicsm_desc='$desc', 
		subtopicsm_seotitle='$title', 
		subtopicsm_seodesc='$seodesc', 
		subtopicsm_seokywrd='$kywrd', 
		subtopicsm_seohone='$seoh1', 
		subtopicsm_seohtwo='$seoh2',
		subtopicsm_prty ='$prior', 
		subtopicsm_mdfdon ='$cur_dt',
		subtopicsm_mdfdby='$ses_admin'";
		$uqrysubtopics_mst .= " where subtopicsm_id = $id"; 
		$ursprodmncat_mst = mysqli_query($conn, $uqrysubtopics_mst);
		if ($ursprodmncat_mst == true){ 
    ?>
			<script type="text/javascript">
				location.href = "view_detail_subtopics.php?vw=<?php echo $id; ?>&sts=y&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
			</script>
			<?php
		} else { ?>
			<script type="text/javascript">
				location.href = "view_detail_subtopics.php?vw=<?php echo $id; ?>&sts=n&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
			</script>
			<?php
		}
		}
}
?>