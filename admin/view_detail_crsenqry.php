<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_crsenqry.php	
Purpose : For Viewing crsenqry Details
Created By : Bharath
Created On :	27-12-2021
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id, $pg, $countstart;
$rd_crntpgnm = "view_all_crsenqry_mst.php";
// $rd_edtpgnm = "edit_crsenqry.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Enquiries";
$pagecat = "Course Enquiries";
$pagenm = "Course Enquiries";
/*****header link********/
if (isset($_REQUEST['vw']) && (trim($_REQUEST['vw']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
}
$sqrycrsenqry_mst = "SELECT crsenqrym_id, crsenqrym_code,crsenqrym_name,crsenqrym_crtdon,crsenqrym_emailid,crsenqrym_phn,crsenqrym_sbjt,crsenqrym_cmnts,crsenqrym_grad_typ,grad_typm_name,coursm_name,crsenqrym_crsnm,crsenqrym_crtdby
from crsenqry_mst
left join cours_mst on cours_mst.Coursm_id=crsenqry_mst.crsenqrym_crsnm
left join grad_typ_mst on grad_typ_mst.grad_typm_id=cours_mst.Coursm_typ 
where crsenqrym_id = $id";
$srscrsenqry_mst = mysqli_query($conn, $sqrycrsenqry_mst);
$rowscrsenqry_mst = mysqli_fetch_assoc($srscrsenqry_mst);
$crsid = $rowscrsenqry_mst['crsenqrym_crsnm'];
$crsnm = $rowscrsenqry_mst['coursm_name'];
$grad_typ_nm = $rowscrsenqry_mst['grad_typm_name'];
$loc = "&val=$srchval";
// $db_catname = $sqrycrsenqry_mst['mot_crsenqrym_selt'];
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
		document.frmedtcrsenqryid.action = "<?php echo $rd_edtpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		document.frmedtcrsenqryid.submit();
	}
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View Courses Enquiries</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Courses Enquiries</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtcrsenqryid" id="frmedtcrsenqryid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtcrsenqryid', rules, 'inline');">
		<input type="hidden" name="hdncrsenqryid" value="<?php echo $id; ?>">
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
				<div class="card-crsenqryy">
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
								<div class="col-sm-8">
									<?php echo $rowscrsenqry_mst['crsenqrym_name']; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Code</label>
								<div class="col-sm-8">
									<?php echo $rowscrsenqry_mst['crsenqrym_code']; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Date</label>
								<div class="col-sm-8">
									<?php echo $rowscrsenqry_mst['crsenqrym_crtdon']; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Email</label>
								<div class="col-sm-8">
									<?php echo $rowscrsenqry_mst['crsenqrym_emailid']; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Phone No</label>
								<div class="col-sm-8">
									<?php echo $rowscrsenqry_mst['crsenqrym_phn']; ?>
								</div>
							</div>
							<!--  <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Subject</label>
							<div class="col-sm-8">
								<?php echo $rowscrsenqry_mst['crsenqrym_sbjt']; ?>
							</div>
						</div> -->
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Comments</label>
								<div class="col-sm-8">
									<?php echo $rowscrsenqry_mst['crsenqrym_cmnts']; ?>
								</div>
							</div>
							<?php
							if ($crsid != '0') { ?>
								<div class="form-group row">
									<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Graduation Type</label>
									<div class="col-sm-8">
										<?php echo $rowscrsenqry_mst['grad_typm_name']; ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Course Name</label>
									<div class="col-sm-8">
										<?php echo $rowscrsenqry_mst['coursm_name']; ?>
									</div>
								</div>
								<?php
							}
							else { ?>
							<div class="form-group row">
									<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Enquiry Type</label>
									<div class="col-sm-8">
										<?php echo "Others"; ?>
									</div>
								</div>
								<?php
							}
							?>
							<p class="text-center">
								<!-- <input type="Submit" class="btn btn-primary btn-cst" name="frmedtcrsenqryid" id="frmedtcrsenqryid" value="Edit"
								onclick="update1();">
							&nbsp;&nbsp;&nbsp; -->
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