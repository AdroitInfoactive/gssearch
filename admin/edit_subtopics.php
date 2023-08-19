<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***********************************************************
Programm : edit_product_category.php	
Package : 
Purpose : For Edit Vehicle Product Category
Created By : Bharath
Created On : 20-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
 ************************************************************/
global $id, $pg, $countstart;
$rd_vwpgnm = "view_detail_subtopics.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "";
$pagenm = "subtopics";
/*****header link********/
if (isset($_POST['btnesubtopicssbmt']) && (trim($_POST['btnesubtopicssbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")) {
	include_once "../includes/inc_fnct_fleupld.php";
	include_once "../database/uqry_subtopics_mst.php";
}
if (isset($_REQUEST['edit']) && (trim($_REQUEST['edit']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$imgid      = glb_func_chkvl($_REQUEST['imgid']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
} elseif (isset($_REQUEST['hdnsubtopicsid']) && (trim($_REQUEST['hdnsubtopicsid']) != "") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage']) != "") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt']) != "")) {
	$id = glb_func_chkvl($_REQUEST['hdnsubtopicsid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}
$sqrysubtopics_mst = "SELECT 
								subtopicsm_name,subtopicsm_desc,subtopicsm_seotitle,subtopicsm_seodesc,
								subtopicsm_seohone,subtopicsm_seohtwo,subtopicsm_seokywrd,subtopicsm_prty,
								 subtopicsm_sts, subtopicsm_topicsm_id, topicsm_name,topicsm_id,subtopicsm_admtyp
							from 
								subtopics_mst
						inner join topics_mst
						on		topics_mst.topicsm_id=subtopics_mst.subtopicsm_topicsm_id
							where 
								subtopicsm_id='$id'";
$srssubtopics_mst = mysqli_query($conn, $sqrysubtopics_mst);
$cntrecsubtopics_mst = mysqli_num_rows($srssubtopics_mst);
if ($cntrecsubtopics_mst > 0) {
	$rowssubtopics_mst = mysqli_fetch_assoc($srssubtopics_mst);
	$db_mnlnksid = $rowssubtopics_mst['topicsm_id'];
	$db_mnlnksnm = $rowssubtopics_mst['topicsm_name'];
	$db_catmnlnksid = $rowssubtopics_mst['subtopicsm_topicsm_id'];
	$db_catname = $rowssubtopics_mst['subtopicsm_name'];
	$db_catdesc = stripslashes($rowssubtopics_mst['subtopicsm_desc']);
	$db_catseottl = $rowssubtopics_mst['subtopicsm_seotitle'];
	$db_catseodesc = $rowssubtopics_mst['subtopicsm_seodesc'];
	$db_catseokywrd = $rowssubtopics_mst['subtopicsm_seokywrd'];
	$db_catseohone = $rowssubtopics_mst['subtopicsm_seohone'];
	$db_catseohtwo = $rowssubtopics_mst['subtopicsm_seohtwo'];
	$db_catprty = $rowssubtopics_mst['subtopicsm_prty'];
	$db_catsts = $rowssubtopics_mst['subtopicsm_sts'];

}
?><?php
$loc = "&val=$srchval";
$pagetitle = "Edit Sub Topic";
?>
<!-- <link href="froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="froala-editor/js/froala_editor.pkgd.min.js"></script> -->
<script language="javaScript" type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
	var rules = new Array();
	rules[0] = 'lstcat:Topic|required|Select Main Topic';
	rules[1] = 'txtname:Name|required|Enter Sub Topic Name';
	rules[2] = 'txtprty:Priority|required|Enter Rank';
	rules[3] = 'txtprty:Priority|numeric|Enter Only Numbers';

	function setfocus() {
		document.getElementById('txtname').focus();
	}
</script>
<?php
include_once('script.php');
include_once('../includes/inc_fnct_ajax_validation.php');
?>
<script language="javascript" type="text/javascript">
	function funcChkDupName() {
    var prodmcatid = document.getElementById('lstcat').value;
    var name = document.getElementById('txtname').value;
		id = <?php echo $id; ?>;
		if (name != "") {
			var url = "chkduplicate.php?subtopicname=" + name + "&subtopicid=" + prodmcatid + "&subtopicsm_id=" + id; 
      xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		} else {
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}
	}

	function stateChanged() {
		if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
			var temp = xmlHttp.responseText;
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if (temp != 0) {
				document.getElementById('txtname').focus();
			}
		}
	}
	function get_admsn_dtls() {
		var slctdtyp = $("#lstcat").val();
		$.ajax({
			type: "POST",
			url: "../includes/inc_getStsk.php",
			data: 'adm_typ=' + slctdtyp,
			success: function (data) {
				// alert(data)
				$("#admtyp").html(data);
			}
		});
	}
	function get_cntnt()
	{
		var gnrttyp = $("#lstcntnttyp").val();
		$.ajax({
			type: "POST",
			url: "../includes/inc_getStsk.php",
			data: 'gnrttyp=' + gnrttyp,
			success: function (data) {
				// alert(data)
				// $("#admtyp").html(data);
				// $("#txtdesc").val(data);
				// CKEDITOR.instances['txtdesc'].setData("")
				CKEDITOR.instances['txtdesc'].setData(data)
			}
		});
	}
</script>
<?php
include_once $inc_adm_hdr;
include_once $inc_adm_lftlnk;
?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Edit Sub Topic</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Sub Topic</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtsubtopicsid" id="frmedtsubtopicsid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		enctype="multipart/form-data" onSubmit="return performCheck('frmedtsubtopicsid', rules, 'inline');">
		<input type="hidden" name="hdnsubtopicsid" value="<?php echo $id; ?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg; ?>">
		<input type="hidden" name="hdnval" value="<?php echo $srchval; ?>">
		<input type="hidden" name="hdnchk" value="<?php echo $chk; ?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart ?>">
		<input type="hidden" name="hdnbgimg" id="hdnbgimg" value="<?php echo $rowssubtopics_mst['subtopicsm_bnrimg']; ?>">
		<input type="hidden" name="hdnsmlimg" id="hdnsmlimg" value="<?php echo $rowsprodscat_mst['subtopicsm_icn']; ?>">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Main Topics *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqryprodmncat_mst = "select 
								topicsm_id,topicsm_name						
							from 
								topics_mst 
							where	 
								topicsm_sts = 'a'
							order by
							   topicsm_name";
								$srssubtopics_mst1 = mysqli_query($conn, $sqryprodmncat_mst);
								$cnt_prodmncat = mysqli_num_rows($srssubtopics_mst1);
								?>
								<select name="lstcat" id="lstcat" class="form-control" onchange="get_admsn_dtls();">
									<option value="">--Select Main Topic--</option>
									<?php
									if ($cnt_prodmncat > 0) {
										while ($rowsprodmncat_mst = mysqli_fetch_assoc($srssubtopics_mst1)) {
											$mncatid = $rowsprodmncat_mst['topicsm_id'];
											$mncatname = $rowsprodmncat_mst['topicsm_name'];
											?>
											<option value="<?php echo $mncatid; ?>" <?php if ($db_catmnlnksid == $mncatid) echo 'selected'; ?>><?php echo $mncatname; ?></option>
											<?php
										}
									}
									?>
								</select>
								<span id="errorsDiv_lstcat"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Sub Topic Name *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()"
									class="form-control" value="<?php echo $db_catname; ?>">
								<span id="errorsDiv_txtname"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtdesc" cols="60" rows="3" id="txtdesc"
									class="form-control"><?php echo $db_catdesc; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseotitle" id="txtseotitle" size="45" maxlength="250" class="form-control"
									value="<?php echo $db_catseottl; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseodesc" rows="3" cols="60" id="txtseodesc"
									class="form-control"><?php echo $db_catseodesc; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Keyword</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseokywrd" rows="3" cols="60" id="txtseokywrd"
									class="form-control"><?php echo $db_catseokywrd; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 </label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh1" id="txtseoh1" size="45" maxlength="250" class="form-control"
									value="<?php echo $db_catseohone; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 </label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh2" id="txtseoh2" size="45" maxlength="250" class="form-control"
									value="<?php echo $db_catseohtwo; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtprty" id="txtprty" class="form-control" size="4" maxlength="3"
									value="<?php echo $db_catprty; ?>">
								<span id="errorsDiv_txtprty"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Status</label>
							</div>
							<div class="col-sm-9">
								<select name="lststs" id="lststs" class="form-control">
									<option value="a" <?php if ($db_catsts == 'a')
										echo 'selected'; ?>>Active</option>
									<option value="i" <?php if ($db_catsts == 'i')
										echo 'selected'; ?>>Inactive</option>
								</select>
							</div>
						</div>
					</div>
									<p class="text-center">
										<input type="Submit" class="btn btn-primary btn-cst" name="btnesubtopicssbmt" id="btnesubtopicssbmt"
										value="Submit">
										&nbsp;&nbsp;&nbsp;
										<input type="reset" class="btn btn-primary btn-cst" name="btnsubtopicsreset" value="Clear"
										id="btnsubtopicsreset">
										&nbsp;&nbsp;&nbsp;
										<input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst"
										onclick="location.href='<?php echo $rd_vwpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>'">
									</p>
								</div>
							</div>
						</div>
					</form>
				</section>
				<?php include_once "../includes/inc_adm_footer.php"; ?>
				<script language="javascript" type="text/javascript">
					CKEDITOR.replace('txtdesc');
					// var editor = new FroalaEditor('#txtdesc');
					</script>