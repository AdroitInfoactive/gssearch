<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_product_category.php	
Purpose : For Viewing Category Details
Created By : Bharath
Created On : 30/10/2013
Modified By : 
Modified On :
Purpose : 
Company : Adroit
 ************************************************************/
/*****header link********/
$pagemncat = "Regular Courses";
$pagecat = "Courses";
$pagenm = "Courses";
/*****header link********/
global $id, $pg, $countstart;
$rd_crntpgnm = "view_Courses.php";
$rd_edtpgnm = "edit_Courses_category.php";
$clspn_val = "4";
if (isset($_REQUEST['vw']) && (trim($_REQUEST['vw']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}

$sqrycours_mst = "SELECT Coursm_typ,Coursm_name,Coursm_abot_desc,Coursm_career_desc,Coursm_elig_desc,Coursm_seotitle, Coursm_seodesc, Coursm_seohone,Coursm_seohtwo,Coursm_seokywrd,Coursm_prty,grad_typm_name, if(Coursm_sts = 'a', 'Active','Inactive') as Coursm_sts, Coursm_typ,Coursm_img  from cours_mst inner join grad_typ_mst on grad_typ_mst.grad_typm_id = cours_mst.coursm_typ where coursm_id=$id";
$srscours_mst = mysqli_query($conn, $sqrycours_mst);
$cntreccours_mst = mysqli_num_rows($srscours_mst);
if ($cntreccours_mst > 0) {
	$rowscours_mst = mysqli_fetch_assoc($srscours_mst);
	$db_mnlnksnm = $rowscours_mst['grad_typm_name'];
	$db_courstyp = $rowscours_mst['Coursm_typ'];
	$db_catname = $rowscours_mst['Coursm_name'];
	$db_catdesc = stripslashes($rowscours_mst['Coursm_abot_desc']);
	$db_catdesc2 = stripslashes($rowscours_mst['Coursm_career_desc']);
	$db_catdesc3 = stripslashes($rowscours_mst['Coursm_elig_desc']);
	$db_catseottl = $rowscours_mst['Coursm_seotitle'];
	$db_catseodesc = $rowscours_mst['Coursm_seodesc'];
	$db_catseokywrd = $rowscours_mst['Coursm_seokywrd'];
	$db_catseohone = $rowscours_mst['Coursm_seohone'];
	$db_catseohtwo = $rowscours_mst['Coursm_seohtwo'];
	$db_catprty = $rowscours_mst['Coursm_prty'];
	$db_catsts = $rowscours_mst['Coursm_sts'];
	$db_catimg = $rowscours_mst['Coursm_img'];
}
$loc = "&val=$srchval";
if ($chk != '') {
	$loc .= "&chk=y";
}
if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) {
	$msg = "<font color=red>Record updated successfully</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")) {
	$msg = "<font color=red>Record not updated</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")) {
	$msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
}
?>
<script language="javascript">
	function update1() //for update download details
	{
		document.frmedtCours.action = "<?php echo $rd_edtpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		document.frmedtCours.submit();
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
					<h1 class="m-0 text-dark">View Course</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Course</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtCours" id="frmedtCours" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtCours', rules, 'inline');">
		<input type="hidden" name="hdnCoursid" value="<?php echo $id; ?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg; ?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart ?>">
		<?php
		if ($msg != '') {
			echo "<center><tr bgcolor='#FFFFFF'>
				<td colspan='4' bgcolor='#F3F3F3' align='center'><strong>$msg</strong></td>
			</tr></center>";
		}
		?>
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Graduation Type</label>
							<div class="col-sm-8">
								<?php echo $db_mnlnksnm; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Course Name </label>
							<div class="col-sm-8">
								<?php echo $db_catname; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">About the Course</label>
							<div class="col-sm-8">
								<?php echo $db_catdesc; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Career Opportunities</label>
							<div class="col-sm-8">
								<?php echo $db_catdesc2; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Eligibility</label>
							<div class="col-sm-8">
								<?php echo $db_catdesc3; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Image</label>
							<div class="col-sm-8">
								<?php
								$crsimgnm = $db_catimg;
								$crsimgpath = $gcrs_fldnm . $crsimgnm;
								if (($crsimgnm != "") && file_exists($crsimgpath)) {
									echo "<img src='$crsimgpath' width='100pixel' height='100pixel'>";
								} else {
									echo "Image not available";
								}
								?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO Title </label>
							<div class="col-sm-8">
								<?php echo $db_catseottl; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label"> SEO Description</label>
							<div class="col-sm-8">
								<?php echo $db_catseodesc; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label"> SEO Keyword</label>
							<div class="col-sm-8">
								<?php echo $db_catseokywrd; ?>
							</div>
						</div>

						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H1 </label>
							<div class="col-sm-8">
								<?php echo $db_catseohone; ?>
							</div>
						</div>

						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">SEO H2 </label>
							<div class="col-sm-8">
								<?php echo $db_catseohtwo; ?>
							</div>
						</div>

						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Rank</label>
							<div class="col-sm-8">
								<?php echo $db_catprty; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status </label>
							<div class="col-sm-8">
								<?php echo $db_catsts; ?>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtCours" id="frmedtCours" value="Edit"
								onclick="update1()">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary btn-cst" name="btnCoursreset" value="Clear" id="btnCoursreset">
							&nbsp;&nbsp;&nbsp;
							<input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst"
								onclick="location.href='<?php echo $rd_crntpgnm; ?>?<?php echo $loc; ?>'">
						</p>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>