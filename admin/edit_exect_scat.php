<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**********************************************************
Programm : edit_exect_scat.php 
Purpose : For Editing exect_scat
Created By : Bharath
Created On : 05-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/
/*****header link********/
$pagemncat = "Executive Programs";
$pagecat = "Executive Sub Category";
$pagenm = "Executive Sub Category";
/*****header link********/
global $id, $pg, $countstart;
$rd_vwpgnm = "view_detail_exect_scat.php";
$rd_crntpgnm = "view_all_exect_scat.php";
$clspn_val = "4";
if (isset($_POST['btneexect_scatsbmt']) && (trim($_POST['btneexect_scatsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")) {
	include_once "../includes/inc_fnct_fleupld.php"; // For uploading files 
	include_once "../database/uqry_exect_scat_mst.php";
}
if (isset($_REQUEST['edit']) && (trim($_REQUEST['edit']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
} elseif (isset($_REQUEST['hdnexect_scatid']) && (trim($_REQUEST['hdnexect_scatid']) != "") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage']) != "") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt']) != "")) {
	$id = glb_func_chkvl($_REQUEST['hdnexect_scatid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
}
$sqryexect_scat_mst = "SELECT exect_scatm_name,exect_scatm_catm_id, exect_scatm_desc, exect_scatm_sts, exect_scatm_prty,exect_catm_name from exect_scat_mst inner join exect_cat_mst on  exect_cat_mst.exect_catm_id = exect_scat_mst.exect_scatm_catm_id where exect_scatm_id = $id"; 
$srsexect_scat_mst = mysqli_query($conn, $sqryexect_scat_mst);
$cntrec = mysqli_num_rows($srsexect_scat_mst);
if ($cntrec > 0) {
	$rowsexect_scat_mst = mysqli_fetch_assoc($srsexect_scat_mst);
 $db_catmnid = $rowsexect_scat_mst['exect_scatm_catm_id']; 

} else { ?>
	<script>location.href = "<?php echo $rd_crntpgnm; ?>";</script>
	<?php
	exit();
}
?>
<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
	var rules = new Array();
	rules[0] = 'txtname:Name|required|Enter Name';
	rules[1] = 'txtname:Name|alphaspace|Name only characters and numbers';
	rules[2] = 'txtprior:Priority|required|Enter Rank';
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
		var catid = document.getElementById('lstcat').value;
		var name = document.getElementById('txtname').value;
		id = <?php echo $id; ?>;
		if (name != "") {
			var url = "chkduplicate.php?exect_scatname=" + name+ "&exect_scatcatid=" + catid + "&exect_scatid=" + id;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		}
		else {
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}
	}
	function stateChanged() {
		if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
			var temp = xmlHttp.responseText;
			// alert(temp);
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if (temp != 0) {
				document.getElementById('txtname').focus();
			}
		}
	}
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Edit Executive Sub Category Type</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Executive Sub Category Type</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtexect_scatid" id="frmedtexect_scatid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtexect_scatid', rules, 'inline');" enctype="multipart/form-data">
		<input type="hidden" name="hdnexect_scatid" value="<?php echo $id; ?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg; ?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart ?>">
		<input type="hidden" name="hdnloc" value="<?php echo $loc ?>">
		<input type="hidden" name="hdndexect_scatimg" id="hdndexect_scatimg" value="<?php echo $rowsexect_scat_mst['exect_scatm_dimgnm']; ?>">
		<!-- <input type="hidden" name="hdnmexect_scatimg" id="hdnmexect_scatimg" value="<?php echo $rowsexect_scat_mst['exect_scatm_mimgnm']; ?>"> -->
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center align-items-center">
        <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Category Name *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqryprodmncat_mst = "select 
								exect_catm_id,exect_catm_name						
							from 
								exect_cat_mst 
							where	 
								exect_catm_sts = 'a'
							order by
							   exect_catm_name";
								$srsprodcat_mst1 = mysqli_query($conn, $sqryprodmncat_mst);
								$cnt_prodmncat = mysqli_num_rows($srsprodcat_mst1);
								?>
								<select name="lstcat" id="lstcat" class="form-control" onchange="get_admsn_dtls();">
									<option value="">--Select Main Category--</option>
									<?php
									if ($cnt_prodmncat > 0) {
										while ($rowsprodmncat_mst = mysqli_fetch_assoc($srsprodcat_mst1)) {
											$mncatid = $rowsprodmncat_mst['exect_catm_id'];
											$mncatname = $rowsprodmncat_mst['exect_catm_name'];
											?>
											<option value="<?php echo $mncatid; ?>" <?php if ($db_catmnid == $mncatid) echo 'selected'; ?>><?php echo $mncatname; ?></option>
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
									class="form-control" value="<?php echo $rowsexect_scat_mst['exect_scatm_name']; ?>">
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
									class="form-control"><?php echo $rowsexect_scat_mst['exect_scatm_desc']; ?></textarea>
							</div>
						</div>
					</div>
					<!-- <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Image</label>
							</div>
							<div class="col-sm-9">
								<div class="custom-file">
									<input name="fledexect_scatimg" type="file" class="form-control" id="fledexect_scatimg">
								</div>
								<?php
								$exect_scatimgnm = $rowsexect_scat_mst['exect_scatm_dimgnm'];
								$exect_scatimgpath = $gexect_scat_fldnm . $exect_scatimgnm;
								if (($exect_scatimgnm != "") && file_exists($exect_scatimgpath)) {
									echo "<img src='$exect_scatimgpath' width='50pixel' height='50pixel'>";
								} else {
									echo "Image not available";
								}
								?>
							</div>
						</div>
					</div> -->
					<!-- <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Mobile Image</label>
							</div>
							<div class="col-sm-9">
								<div class="custom-file">
									<input name="flemexect_scatimg" type="file" class="form-control" id="flemexect_scatimg">
								</div>
								<?php
								$exect_scatmimgnm = $rowsexect_scat_mst['exect_scatm_mimgnm'];
								$exect_scatmimgpath = $gexect_scat_fldnm . $exect_scatmimgnm;
								if (($exect_scatmimgnm != "") && file_exists($exect_scatmimgpath)) {
									echo "<img src='$exect_scatmimgpath' width='50pixel' height='50pixel'>";
								} else {
									echo "Image not available";
								}
								?>
							</div>
						</div>
					</div> -->
					<!-- <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Link</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtlnk" id="txtlnk" size="45" maxlength="250" class="form-control"
									value="<?php echo $rowsexect_scat_mst['exect_scatm_lnk']; ?>">
							</div>
						</div>
					</div> -->
					<!-- <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>TextAlign</label>
							</div>
							<div class="col-sm-9">
								<select name="txtalin" id="txtalin" class="form-control">
									<option value="L" <?php if ($rowsexect_scat_mst['exect_scatm_text'] == 'L')
										echo 'selected'; ?>>Left</option>
									<option value="R" <?php if ($rowsexect_scat_mst['exect_scatm_text'] == 'R')
										echo 'selected'; ?>>Right</option>
									<option value="C" <?php if ($rowsexect_scat_mst['exect_scatm_text'] == 'C')
										echo 'selected'; ?>>Center</option>
								</select>

							</div>
						</div>
					</div> -->
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtprior" id="txtprior" class="form-control" size="4" maxlength="3"
									value="<?php echo $rowsexect_scat_mst['exect_scatm_prty']; ?>">
								<span id="errorsDiv_txtprior"></span>
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
									<option value="a" <?php if ($rowsexect_scat_mst['exect_scatm_sts'] == 'a')
										echo 'selected'; ?>>Active</option>
									<option value="i" <?php if ($rowsexect_scat_mst['exect_scatm_sts'] == 'i')
										echo 'selected'; ?>>Inactive</option>
								</select>

							</div>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary" name="btneexect_scatsbmt" id="btneexect_scatsbmt" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="btn btn-primary" name="btnbrndreset" value="Clear" id="btnbrndreset">
						&nbsp;&nbsp;&nbsp;
						<input type="button" name="btnBack" value="Back" class="btn btn-primary"
							onClick="location.href='<?php echo $rd_crntpgnm; ?>'">
					</p>
				</div>
			</div>
		</div>
	</form>
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>