<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_exect_cat.php	
Purpose : For Viewing exect_cat Details
Created By : Bharath
Created On :	27-12-2021
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id, $pg, $countstart;
$rd_crntpgnm = "view_all_exect_cat.php";
$rd_edtpgnm = "edit_exect_cat.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Executive Programs";
$pagecat = "Executive Category";
$pagenm = "Executive Category";
/*****header link********/
if (isset($_REQUEST['vw']) && (trim($_REQUEST['vw']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
}
$sqryexect_cat_mst = "SELECT exect_catm_name,exect_catm_img,exect_catm_desc, if(exect_catm_sts = 'a', 'Active','Inactive') as exect_catm_sts, exect_catm_prty
	from exect_cat_mst where exect_catm_id = $id"; 
$srsexect_cat_mst = mysqli_query($conn, $sqryexect_cat_mst);
$rowsexect_cat_mst = mysqli_fetch_assoc($srsexect_cat_mst);
$loc = "&val=$srchval";
// $db_catname = $sqryexect_cat_mst['mot_exect_catm_selt'];
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
		document.frmedtexect_catid.action = "<?php echo $rd_edtpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		document.frmedtexect_catid.submit();
	}
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View Executive Category Type</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Executive Category Type</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtexect_catid" id="frmedtexect_catid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtexect_catid', rules, 'inline');">
		<input type="hidden" name="hdnexect_catid" value="<?php echo $id; ?>">
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
			<div class="card-exect_caty">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
							<div class="col-sm-8">
								<?php echo $rowsexect_cat_mst['exect_catm_name']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Image</label>
							<div class="col-sm-8">
							<?php
								$exectcatimgnm = $rowsexect_cat_mst['exect_catm_img'];
								$exectcatimgpath = $a_exec_prog . $exectcatimgnm;
								if (($exectcatimgnm != "") && file_exists($exectcatimgpath)) {
									echo "<img src='$exectcatimgpath' width='100pixel' height='100pixel'>";
								} else {
									echo "Image not available";
								}
								?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Description</label>
							<div class="col-sm-8">
								<?php echo $rowsexect_cat_mst['exect_catm_desc']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Rank</label>
							<div class="col-sm-8">
								<?php echo $rowsexect_cat_mst['exect_catm_prty']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status</label>
							<div class="col-sm-8">
								<?php echo $rowsexect_cat_mst['exect_catm_sts']; ?>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtexect_catid" id="frmedtexect_catid" value="Edit"
								onclick="update1();">
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