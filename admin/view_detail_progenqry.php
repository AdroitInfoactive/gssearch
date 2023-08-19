<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_progenqry.php	
Purpose : For Viewing progenqry Details
Created By : Bharath
Created On :	27-12-2021
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id, $pg, $countstart;
$rd_crntpgnm = "view_all_progenqry_mst.php";
// $rd_edtpgnm = "edit_progenqry.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Enquiries";
$pagecat = "Program Enquiries";
$pagenm = "Program Enquiries";
/*****header link********/
if (isset($_REQUEST['vw']) && (trim($_REQUEST['vw']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
}
$sqryprogenqry_mst = "SELECT progenqrym_id, progenqrym_code,progenqrym_name,progenqrym_crtdon,progenqrym_emailid,progenqrym_phn,progenqrym_progid,exect_progm_name,exect_catm_name,exect_scatm_name,progenqrym_cmnts,progenqrym_crtdby
from progenqry_mst 
left join exect_prog_mst on progenqrym_progid = exect_progm_id
left join exect_cat_mst on exect_progm_catm_id = exect_catm_id
left join exect_scat_mst on exect_progm_scatm_id = exect_scatm_id
where progenqrym_id = $id";
$srsprogenqry_mst = mysqli_query($conn, $sqryprogenqry_mst);
$rowsprogenqry_mst = mysqli_fetch_assoc($srsprogenqry_mst);
$progid = $rowsprogenqry_mst['progenqrym_progid'];
$progname = $rowsprogenqry_mst['exect_progm_name'];
$progcatname = $rowsprogenqry_mst['exect_catm_name'];
$progscatname = $rowsprogenqry_mst['exect_scatm_name'];
$loc = "&val=$srchval";
// $db_catname = $sqryprogenqry_mst['mot_progenqrym_selt'];
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
		document.frmedtprogenqryid.action = "<?php echo $rd_edtpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		document.frmedtprogenqryid.submit();
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
	<form name="frmedtprogenqryid" id="frmedtprogenqryid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtprogenqryid', rules, 'inline');">
		<input type="hidden" name="hdnprogenqryid" value="<?php echo $id; ?>">
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
				<div class="card-progenqryy">
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
								<div class="col-sm-8">
									<?php echo $rowsprogenqry_mst['progenqrym_name']; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Code</label>
								<div class="col-sm-8">
									<?php echo $rowsprogenqry_mst['progenqrym_code']; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Date</label>
								<div class="col-sm-8">
									<?php echo $rowsprogenqry_mst['progenqrym_crtdon']; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Email</label>
								<div class="col-sm-8">
									<?php echo $rowsprogenqry_mst['progenqrym_emailid']; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Phone No</label>
								<div class="col-sm-8">
									<?php echo $rowsprogenqry_mst['progenqrym_phn']; ?>
								</div>
							</div>
							<!-- <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Subject</label>
							<div class="col-sm-8">
								<?php echo $rowsprogenqry_mst['progenqrym_sbjt']; ?>
							</div>
						</div> -->
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Comments</label>
								<div class="col-sm-8">
									<?php echo $rowsprogenqry_mst['progenqrym_cmnts']; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Program Name</label>
								<div class="col-sm-8">
									<?php
									if ($progid != '0') {
										echo $progcatname . ' - ' . $progscatname . ' - ' . $progname;
									} else {
										echo "others";
									}
									?>
								</div>
							</div>
							<!-- <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Program catName</label>
							<div class="col-sm-8">
								<?php echo $rowsprogenqry_mst['exect_catm_name']; ?>
							</div>
						</div> -->
							<p class="text-center">
								<!-- <input type="Submit" class="btn btn-primary btn-cst" name="frmedtprogenqryid" id="frmedtprogenqryid" value="Edit"
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