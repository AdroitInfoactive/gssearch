<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_exect_scat.php	
Purpose : For Viewing exect_scat Details
Created By : Bharath
Created On :	27-12-2021
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id, $pg, $countstart;
$rd_crntpgnm = "view_all_exect_scat.php";
$rd_edtpgnm = "edit_exect_scat.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Executive Programs";
$pagecat = "Executive Sub Category";
$pagenm = "Executive Sub Category";
/*****header link********/
if (isset($_REQUEST['vw']) && (trim($_REQUEST['vw']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
}
 $sqryexect_scat_mst = "SELECT exect_scatm_name,exect_scatm_catm_id, exect_scatm_desc, if(exect_scatm_sts = 'a', 'Active','Inactive') as exect_scatm_sts,exect_catm_name, exect_scatm_prty
	from exect_scat_mst
  inner join 	exect_cat_mst
on		exect_cat_mst.exect_catm_id=exect_scat_mst.exect_scatm_catm_id
 where exect_scatm_id = $id"; 
$srsexect_scat_mst = mysqli_query($conn, $sqryexect_scat_mst);
$rowsexect_scat_mst = mysqli_fetch_assoc($srsexect_scat_mst);
$loc = "&val=$srchval";
// $db_catname = $sqryexect_scat_mst['mot_exect_scatm_selt'];
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
		document.frmedtexect_scatid.action = "<?php echo $rd_edtpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		document.frmedtexect_scatid.submit();
	}
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View Executive Sub Category Type</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Executive Sub Category Type</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtexect_scatid" id="frmedtexect_scatid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtexect_scatid', rules, 'inline');">
		<input type="hidden" name="hdnexect_scatid" value="<?php echo $id; ?>">
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
			<div class="card-exect_scaty">
				<div class="row justify-content-center">
					<div class="col-md-12">
          <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Category Type</label>
							<div class="col-sm-8">
								<?php echo $rowsexect_scat_mst['exect_catm_name']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
							<div class="col-sm-8">
								<?php echo $rowsexect_scat_mst['exect_scatm_name']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Description</label>
							<div class="col-sm-8">
								<?php echo $rowsexect_scat_mst['exect_scatm_desc']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Rank</label>
							<div class="col-sm-8">
								<?php echo $rowsexect_scat_mst['exect_scatm_prty']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status</label>
							<div class="col-sm-8">
								<?php echo $rowsexect_scat_mst['exect_scatm_sts']; ?>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtexect_scatid" id="frmedtexect_scatid" value="Edit"
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