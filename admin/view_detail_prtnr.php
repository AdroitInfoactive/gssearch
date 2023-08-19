<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_prtnr.php	
Purpose : For Viewing prtnr Details
Created By : Bharath
Created On :	27-12-2021
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
global $id, $pg, $countstart;
$rd_crntpgnm = "view_all_prtnr.php";
$rd_edtpgnm = "edit_prtnr.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Partners";
$pagenm = "Partners";
/*****header link********/
if (isset($_REQUEST['vw']) && (trim($_REQUEST['vw']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
}
$sqryprtnr_mst = "SELECT prtnrm_typ,prtnrm_name, prtnrm_desc, prtnrm_lnk, if(prtnrm_sts = 'a', 'Active','Inactive') as prtnrm_sts, prtnrm_prty, prtnrm_imgnm
	from prtnr_mst where prtnrm_id = $id";
$srsprtnr_mst = mysqli_query($conn, $sqryprtnr_mst);
$rowsprtnr_mst = mysqli_fetch_assoc($srsprtnr_mst);
$loc = "&val=$srchval";
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
		document.frmedtprtnrid.action = "<?php echo $rd_edtpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		document.frmedtprtnrid.submit();
	}
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View Partner</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Partner</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtprtnrid" id="frmedtprtnrid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtprtnrid', rules, 'inline');">
		<input type="hidden" name="hdnprtnrid" value="<?php echo $id; ?>">
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
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Type</label>
							<div class="col-sm-8">
								<?php
                if ($rowsprtnr_mst['prtnrm_typ'] == "s")
                {
                  $typ = "Strategic";
                }
                if($rowsprtnr_mst['prtnrm_typ'] == "p")
                {
                  $typ = "Placement";
                }
                echo $typ;
                ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
							<div class="col-sm-8">
								<?php echo $rowsprtnr_mst['prtnrm_name']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Description</label>
							<div class="col-sm-8">
								<?php echo $rowsprtnr_mst['prtnrm_desc']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Link</label>
							<div class="col-sm-8">
								<?php echo $rowsprtnr_mst['prtnrm_lnk']; ?>
							</div>
						</div>
						<!-- <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">TextAlign</label>
							<div class="col-sm-8">
								<?php if ($rowsprtnr_mst['prtnrm_text'] == 'L')
									echo 'Left'; ?>
								<?php if ($rowsprtnr_mst['prtnrm_text'] == 'R')
									echo 'Right'; ?>
								<?php if ($rowsprtnr_mst['prtnrm_text'] == 'C')
									echo 'Center'; ?>

							</div>
						</div> -->
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Logo</label>
							<div class="col-sm-8">
								<?php
								$prtnrimgnm = $rowsprtnr_mst['prtnrm_imgnm'];
								$prtnrimgpath = $gprtnr_fldnm . $prtnrimgnm;
								if (($prtnrimgnm != "") && file_exists($prtnrimgpath)) {
									echo "<img src='$prtnrimgpath' width='100pixel' height='100pixel'>";
								} else {
									echo "Image not available";
								}
								?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Rank</label>
							<div class="col-sm-8">
								<?php echo $rowsprtnr_mst['prtnrm_prty']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status</label>
							<div class="col-sm-8">
								<?php echo $rowsprtnr_mst['prtnrm_sts']; ?>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtprtnrid" id="frmedtprtnrid" value="Edit"
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