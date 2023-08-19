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
$pagemncat = "Setup";
$pagecat = "Product Group";
$pagenm = "subtopics";
/*****header link********/
global $id, $pg, $countstart;
$rd_crntpgnm = "view_subtopics.php";
$rd_edtpgnm = "edit_subtopics.php";
$clspn_val = "4";
if (isset($_REQUEST['vw']) && (trim($_REQUEST['vw']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}

$sqrysubtopics_mst = "SELECT 
subtopicsm_name,subtopicsm_desc,subtopicsm_seotitle,subtopicsm_seodesc,
subtopicsm_seohone,subtopicsm_seohtwo,subtopicsm_seokywrd,subtopicsm_prty, 
if(subtopicsm_sts = 'a', 'Active','Inactive') as subtopicsm_sts,
subtopicsm_topicsm_id,topicsm_name,subtopicsm_admtyp
from 
subtopics_mst
inner join 	topics_mst
on		topics_mst.topicsm_id=subtopics_mst.subtopicsm_topicsm_id
where 
subtopicsm_id=$id"; 
$srssubtopics_mst = mysqli_query($conn, $sqrysubtopics_mst);
$cntrecsubtopics_mst = mysqli_num_rows($srssubtopics_mst);
if ($cntrecsubtopics_mst > 0) {
	$rowssubtopics_mst = mysqli_fetch_assoc($srssubtopics_mst);
	$db_mnlnksnm = $rowssubtopics_mst['topicsm_name'];
	$db_catname = $rowssubtopics_mst['subtopicsm_name'];
	$db_gnrtdfrm = $rowssubtopics_mst['subtopicsm_gnrtdfrm'];
	$db_catdesc = stripslashes($rowssubtopics_mst['subtopicsm_desc']);
	$db_cattyp = $rowssubtopics_mst['subtopicsm_typ'];
	$db_dsplytyp = $rowssubtopics_mst['subtopicsm_dsplytyp'];
	$db_catseottl = $rowssubtopics_mst['subtopicsm_seotitle'];
	$db_catseodesc = $rowssubtopics_mst['subtopicsm_seodesc'];
	$db_catseokywrd = $rowssubtopics_mst['subtopicsm_seokywrd'];
	$db_catseohone = $rowssubtopics_mst['subtopicsm_seohone'];
	$db_catseohtwo = $rowssubtopics_mst['subtopicsm_seohtwo'];
	$db_catprty = $rowssubtopics_mst['subtopicsm_prty'];
	$db_catsts = $rowssubtopics_mst['subtopicsm_sts'];
	$db_typ = $rowssubtopics_mst['subtopicsm_admtyp'];
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
		document.frmedtsubtopics.action = "<?php echo $rd_edtpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		document.frmedtsubtopics.submit();
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
					<h1 class="m-0 text-dark">View Sub Topics</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Sub Topics</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtsubtopics" id="frmedtsubtopics" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtsubtopics', rules, 'inline');">
		<input type="hidden" name="hdnsubtopicsid" value="<?php echo $id; ?>">
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
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Main Topics </label>
							<div class="col-sm-8">
								<?php echo $db_mnlnksnm; ?>
							</div>
						</div>
						<?php if ($db_mnlnksnm == 'Admissions' || $db_mnlnksnm == 'Departments') {
							?>
							<div class="form-group row">
								<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Type </label>
								<div class="col-sm-8">
									<?php echo $db_typ; ?>
								</div>
							</div>
							<?php
						} ?>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Sub Topic Name </label>
							<div class="col-sm-8">
								<?php echo $db_catname; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Description</label>
							<div class="col-sm-8">
								<?php echo $db_catdesc; ?>
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
			  </table>
				</td>
      </tr>
      <p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtsubtopics" id="frmedtsubtopics" value="Edit"
								onclick="update1()">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary btn-cst" name="btnsubtopicsreset" value="Clear"
								id="btnsubtopicsreset">
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