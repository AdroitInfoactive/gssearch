<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**********************************************************
Programm : edit_prtnr.php 
Purpose : For Editing prtnr
Created By : Bharath
Created On : 05-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Partners";
$pagenm = "Partners";
/*****header link********/
global $id, $pg, $countstart;
$rd_vwpgnm = "view_detail_prtnr.php";
$rd_crntpgnm = "view_all_prtnr.php";
$clspn_val = "4";
if (isset($_POST['btneprtnrsbmt']) && (trim($_POST['btneprtnrsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")) {
	include_once "../includes/inc_fnct_fleupld.php"; // For uploading files 
	include_once "../database/uqry_prtnr_mst.php";
}
if (isset($_REQUEST['edit']) && (trim($_REQUEST['edit']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
} elseif (isset($_REQUEST['hdnprtnrid']) && (trim($_REQUEST['hdnprtnrid']) != "") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage']) != "") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt']) != "")) {
	$id = glb_func_chkvl($_REQUEST['hdnprtnrid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
}
$sqryprtnr_mst = "SELECT prtnrm_typ,prtnrm_name, prtnrm_desc, prtnrm_sts, prtnrm_prty, prtnrm_lnk, prtnrm_imgnm from prtnr_mst where prtnrm_id = $id";
$srsprtnr_mst = mysqli_query($conn, $sqryprtnr_mst);
$cntrec = mysqli_num_rows($srsprtnr_mst);
if ($cntrec > 0) {
	$rowsprtnr_mst = mysqli_fetch_assoc($srsprtnr_mst);
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
		var typ = document.getElementById('prtnrtyp').value;
		var name = document.getElementById('txtname').value;
		id = <?php echo $id; ?>;
		if (name != "") {
			var url = "chkduplicate.php?prtnrname=" + name+ "&typ=" + typ + "&prtnrid=" + id;
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
					<h1 class="m-0 text-dark">Edit Partner</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Partner</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtprtnrid" id="frmedtprtnrid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtprtnrid', rules, 'inline');" enctype="multipart/form-data">
		<input type="hidden" name="hdnprtnrid" value="<?php echo $id; ?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg; ?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart ?>">
		<input type="hidden" name="hdnloc" value="<?php echo $loc ?>">
		<input type="hidden" name="hdnprtnrimg" id="hdnprtnrimg" value="<?php echo $rowsprtnr_mst['prtnrm_imgnm']; ?>">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center align-items-center">
          <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Type</label>
							</div>
							<div class="col-sm-9">
								<select name="prtnrtyp" id="prtnrtyp" class="form-control">
									<option value="s" <?php if ($rowsprtnr_mst['prtnrm_typ'] == 's')
                    echo 'selected'; ?>>Strategic</option>
                  <option value="p" <?php if ($rowsprtnr_mst['prtnrm_typ'] == 'p')
                    echo 'selected'; ?>>Placement</option>
                </select>
          
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
                  class="form-control" value="<?php echo $rowsprtnr_mst['prtnrm_name']; ?>">
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
									class="form-control"><?php echo $rowsprtnr_mst['prtnrm_desc']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Logo</label>
							</div>
							<div class="col-sm-9">
								<div class="custom-file">
									<input name="fleprtnrimg" type="file" class="form-control" id="fleprtnrimg">
								</div>
								<?php
								$prtnrimgnm = $rowsprtnr_mst['prtnrm_imgnm'];
								$prtnrimgpath = $gprtnr_fldnm . $prtnrimgnm;
								if (($prtnrimgnm != "") && file_exists($prtnrimgpath)) {
									echo "<img src='$prtnrimgpath' width='50pixel' height='50pixel'>";
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
								<label>Link</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtlnk" id="txtlnk" size="45" maxlength="250" class="form-control"
									value="<?php echo $rowsprtnr_mst['prtnrm_lnk']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtprior" id="txtprior" class="form-control" size="4" maxlength="3"
									value="<?php echo $rowsprtnr_mst['prtnrm_prty']; ?>">
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
									<option value="a" <?php if ($rowsprtnr_mst['prtnrm_sts'] == 'a')
										echo 'selected'; ?>>Active</option>
									<option value="i" <?php if ($rowsprtnr_mst['prtnrm_sts'] == 'i')
										echo 'selected'; ?>>Inactive</option>
								</select>

							</div>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary" name="btneprtnrsbmt" id="btneprtnrsbmt" value="Submit">
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