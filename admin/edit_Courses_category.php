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
$rd_vwpgnm = "view_detail_Courses_category.php";
$rd_crntpgnm = "view_Courses.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Regular Courses";
$pagecat = "Courses";
$pagenm = "Courses";
/*****header link********/
if (isset($_POST['btneCourssbmt']) && (trim($_POST['btneCourssbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")) {
	include_once "../includes/inc_fnct_fleupld.php";
	include_once "../database/uqry_Cours_mst.php";
}
if (isset($_REQUEST['edit']) && (trim($_REQUEST['edit']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
} elseif (isset($_REQUEST['hdnCoursid']) && (trim($_REQUEST['hdnCoursid']) != "") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage']) != "") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt']) != "")) {
	$id = glb_func_chkvl($_REQUEST['hdnCoursid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}
$sqrycours_mst = "SELECT  Coursm_name,Coursm_abot_desc,Coursm_career_desc,Coursm_elig_desc,Coursm_seotitle,Coursm_seodesc, Coursm_seohone,Coursm_seohtwo,Coursm_seokywrd,Coursm_prty, Coursm_sts, Coursm_typ,Coursm_img from cours_mst where Coursm_id='$id'";
$srscours_mst = mysqli_query($conn, $sqrycours_mst);
$cntreccours_mst = mysqli_num_rows($srscours_mst);
if ($cntreccours_mst > 0) {
	$rowscours_mst = mysqli_fetch_assoc($srscours_mst);
	// $db_mnlnksid	 = $rowscours_mst['prodmnlnksm_id'];
	// $db_mnlnksnm	 = $rowscours_mst['prodmnlnksm_name'];
	// $db_catmnlnksid	 = $rowscours_mst['Coursm_prodmnlnksm_id'];
	$db_catname = $rowscours_mst['Coursm_name'];
	$db_catdesc = stripslashes($rowscours_mst['Coursm_abot_desc']);
	$db_catdesc2 = stripslashes($rowscours_mst['Coursm_career_desc']);
	$db_catdesc3 = stripslashes($rowscours_mst['Coursm_elig_desc']);
	$db_cattyp = $rowscours_mst['Coursm_typ'];
	// $db_dsplytyp     = $rowscours_mst['Coursm_dsplytyp'];
	$db_catseottl = $rowscours_mst['Coursm_seotitle'];
	$db_catseodesc = $rowscours_mst['Coursm_seodesc'];
	$db_catseokywrd = $rowscours_mst['Coursm_seokywrd'];
	$db_catseohone = $rowscours_mst['Coursm_seohone'];
	$db_catseohtwo = $rowscours_mst['Coursm_seohtwo'];
	$db_catprty = $rowscours_mst['Coursm_prty'];
	$db_catsts = $rowscours_mst['Coursm_sts'];
} else { ?>
	<script>location.href = "<?php echo $rd_crntpgnm; ?>";</script>
	<?php
	exit();
}
$loc = "&val=$srchval";
$pagetitle = "Edit Category";
?>
<!-- <link href="froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="froala-editor/js/froala_editor.pkgd.min.js"></script> -->
<script language="javaScript" type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
	var rules = new Array();
	rules[0] = 'lstcat:Graduation Type|required|Select Graduation Type';
	rules[1] = 'txtname:Name|required|Enter Name';
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
		var name;
		name = document.getElementById('txtname').value;
		var gradtyp = document.getElementById('lstcat').value;
		id = <?php echo $id; ?>;
		if (name != "" && gradtyp != "" && id != "") {
			var url = "chkduplicate.php?coursename=" + name + "&gradtyp=" + gradtyp + "&coursid=" + id;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		} else {
			document.getElementById('errorsDiv_lstcat').innerHTML = "";
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}
	}
	function stateChanged() {
		if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
			var temp = xmlHttp.responseText;
			// alert(temp)
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
					<h1 class="m-0 text-dark">Edit Course</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Course</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtCoursid" id="frmedtCoursid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		enctype="multipart/form-data" onSubmit="return performCheck('frmedtCoursid', rules, 'inline');">
		<input type="hidden" name="hdnCoursid" value="<?php echo $id; ?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg; ?>">
		<input type="hidden" name="hdnval" value="<?php echo $srchval; ?>">
		<input type="hidden" name="hdnchk" value="<?php echo $chk; ?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart ?>">
		<input type="hidden" name="hdncrsimg" id="hdncrsimg" value="<?php echo $rowscours_mst['Coursm_img']; ?>">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Graduation type *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqryprodmncat_mst = "SELECT grad_typm_id,grad_typm_name from grad_typ_mst where grad_typm_sts = 'a' order by grad_typm_name";
								$srscours_mst1 = mysqli_query($conn, $sqryprodmncat_mst);
								$cnt_prodmncat = mysqli_num_rows($srscours_mst1);
								?>
								<select name="lstcat" id="lstcat" class="form-control" onchange="get_admsn_dtls(); funcChkDupName(); " >
									<option value="">--Select Graduation type--</option>
									<?php
									if ($cnt_prodmncat > 0) {
										while ($rowsprodmncat_mst = mysqli_fetch_assoc($srscours_mst1)) {
											$mncatid = $rowsprodmncat_mst['grad_typm_id'];
											$mncatname = $rowsprodmncat_mst['grad_typm_name'];
											?>
											<option value="<?php echo $mncatid; ?>" <?php if ($db_cattyp == $mncatid)
													 echo 'selected'; ?>><?php echo $mncatname; ?></option>
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
								<label>Name *</label>
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
								<label>About the Course</label>
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
								<label>Career Opportunities </label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtdesc2" cols="60" rows="3" id="txtdesc2"
									class="form-control"><?php echo $db_catdesc2; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Eligibility for Admission</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtdesc3" cols="60" rows="3" id="txtdesc3"
									class="form-control"><?php echo $db_catdesc3; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Image</label>
							</div>
							<div class="col-sm-9">
								<div class="custom-file">
									<input name="flecrsimg" type="file" class="form-control" id="flecrsimg">
								</div>
								<?php
								$crsimgnm = $rowscours_mst['Coursm_img'];
								$crsimgpath = $gcrs_fldnm . $crsimgnm;
								if (($crsimgnm != "") && file_exists($crsimgpath)) {
									echo "<img src='$crsimgpath' width='50pixel' height='50pixel'>";
								} else {
									echo "Image not available";
								}
								?>
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
						<input type="Submit" class="btn btn-primary btn-cst" name="btneCourssbmt" id="btneCourssbmt" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="btn btn-primary btn-cst" name="btnCoursreset" value="Clear" id="btnCoursreset">
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
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc2');
	// var editor = new FroalaEditor('#txtdesc');
</script>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc3');
	// var editor = new FroalaEditor('#txtdesc');
</script>