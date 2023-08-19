<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth;
global $ses_admin;
if (isset($_POST['btneaddquessbmt']) && (trim($_POST['btneaddquessbmt']) != "") && isset($_POST['txtque']) && (trim($_POST['txtque']) != "") && isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")) {
	//echo "here";exit;
	$ques = addslashes($_POST['txtque']);
  $examid = glb_func_chkvl($_POST['lstcat']);
  $yearid = glb_func_chkvl($_POST['txtname']);
	$year = glb_func_chkvl($_POST['lstyear']);
	$examnm = addslashes($_POST['lastexamnm']);
	$optn1 = addslashes($_POST['txtopt1']);
	$optn2 = addslashes($_POST['txtopt2']);
	$optn3 = addslashes($_POST['txtopt3']);
	$optn4= addslashes($_POST['txtopt4']);
	$crtans = glb_func_chkvl($_POST['lstcrtans']);
	$explan = addslashes($_POST['txtexplan']);
	$topicid = glb_func_chkvl($_POST['lsttopic']);
	$subtopicid = glb_func_chkvl($_POST['lstsubtopic']);
	$txtprty = glb_func_chkvl($_POST['txtprty']);
	$lststs = glb_func_chkvl($_POST['lststs']);
	$crtdt = date('Y-m-d h:i:s');
	if ($chk != '') {
		$loc .= "&chk=y";
	}
	$sqryaddques_mst = "SELECT addquesm_qnm  from addques_mst where addquesm_name='$name' and addquesm_prodmnexmsm_id = '$examid' and addquesm_yearsm_id = '$yearid' and addquesm_topicsm_id = '$topicid' and addquesm_subtopicsm_id ='$subtopicid' and addquesm_id='$id'";
	$srsaddques_mst = mysqli_query($conn, $sqryaddques_mst);
	$rows_cnt = mysqli_num_rows($srsaddques_mst);
	if ($rows_cnt > 1) { ?>
		<script type="text/javascript">
			location.href = "view_detail_questions.php?vw=<?php echo $id; ?>&sts=d&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		</script>
		<?php
	} else {
	  $uqryaddques_mst = "UPDATE addques_mst set 
		addquesm_qnm= '$ques', 
		addquesm_prodmnexmsm_id ='$examid',
    addquesm_yearsm_id ='$yearid',
    addquesm_topicsm_id ='$topicid',
    addquesm_subtopicsm_id ='$subtopicid',
    addquesm_optn1 ='$optn1',
    addquesm_optn2 ='$optn2',
    addquesm_optn3 ='$optn3',
    addquesm_optn4 ='$optn4',
    addquesm_crtans ='$addcrtans',
    addquesm_expln = '$explan',
		addquesm_sts='$sts', 
		addquesm_prty ='$prior', 
		addquesm_mdfdon ='$cur_dt',
		addquesm_mdfdby='$ses_admin'"; 
		$uqryaddques_mst .= " where addquesm_id = $id"; 
		$ursprodmncat_mst = mysqli_query($conn, $uqryaddques_mst);
		if ($ursprodmncat_mst == true){ 
    ?>
			<script type="text/javascript">
				location.href = "view_detail_questions.php?vw=<?php echo $id; ?>&sts=y&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
			</script>
			<?php
		} else { ?>
			<script type="text/javascript">
				location.href = "view_detail_questions.php?vw=<?php echo $id; ?>&sts=n&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
			</script>
			<?php
		}
		}
}
?>