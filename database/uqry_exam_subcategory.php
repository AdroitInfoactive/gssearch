<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth;
global $ses_admin;
if (isset($_POST['btneexam_subcategorysbmt']) && (trim($_POST['btneexam_subcategorysbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")) {
	//echo "here";exit;
	$exam_subcategory = glb_func_chkvl($_POST['lstcat']);
	$id = glb_func_chkvl($_POST['hdnexam_subcategoryid']);
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
	$sqryexam_subcategory_mst = "SELECT exam_subcategorym_name  from exam_subcategory_mst where exam_subcategorym_name='$name' and exam_subcategorym_prodmnexmsm_id = '$exam_subcategory' and exam_subcategorym_id='$id'";
	$srsexam_subcategory_mst = mysqli_query($conn, $sqryexam_subcategory_mst);
	$rows_cnt = mysqli_num_rows($srsexam_subcategory_mst);
	if ($rows_cnt > 1) { ?>
		<script type="text/javascript">
			location.href = "view_detail_exam_subcategory.php?vw=<?php echo $id; ?>&sts=d&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		</script>
		<?php
	} else {
		$uqryexam_subcategory_mst = "UPDATE exam_subcategory_mst set 
		exam_subcategorym_name='$name', 
		exam_subcategorym_prodmnexmsm_id ='$exam_subcategory',
		exam_subcategorym_sts='$sts', 
		exam_subcategorym_desc='$desc', 
		exam_subcategorym_seotitle='$title', 
		exam_subcategorym_seodesc='$seodesc', 
		exam_subcategorym_seokywrd='$kywrd', 
		exam_subcategorym_seohone='$seoh1', 
		exam_subcategorym_seohtwo='$seoh2',
		exam_subcategorym_prty ='$prior', 
		exam_subcategorym_mdfdon ='$cur_dt',
		exam_subcategorym_mdfdby='$ses_admin'";
		$uqryexam_subcategory_mst .= " where exam_subcategorym_id = $id"; 
		$ursprodmncat_mst = mysqli_query($conn, $uqryexam_subcategory_mst);
		if ($ursprodmncat_mst == true){ 
    ?>
			<script type="text/javascript">
				location.href = "view_detail_exam_subcategory.php?vw=<?php echo $id; ?>&sts=y&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
			</script>
			<?php
		} else { ?>
			<script type="text/javascript">
				location.href = "view_detail_exam_subcategory.php?vw=<?php echo $id; ?>&sts=n&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
			</script>
			<?php
		}
		}
}
?>