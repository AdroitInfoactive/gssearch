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
$pagenm = "Exam Subcategory";
/*****header link********/
global $id, $pg, $countstart;
$rd_crntpgnm = "view_exam_subcategory.php";
$rd_edtpgnm = "edit_exam_subcategory.php";
$clspn_val = "4";
if (isset($_REQUEST['vw']) && (trim($_REQUEST['vw']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}

$sqryexam_subcategory_mst = "SELECT 
exam_subcategorym_name,exam_subcategorym_desc,exam_subcategorym_seotitle,exam_subcategorym_seodesc,
exam_subcategorym_seohone,exam_subcategorym_seohtwo,exam_subcategorym_seokywrd,exam_subcategorym_prty, 
if(exam_subcategorym_sts = 'a', 'Active','Inactive') as exam_subcategorym_sts,
exam_subcategorym_topicsm_id,topicsm_name,exam_subcategorym_admtyp
from 
exam_subcategory_mst
inner join 	topics_mst
on		topics_mst.topicsm_id=exam_subcategory_mst.exam_subcategorym_topicsm_id
where 
exam_subcategorym_id=$id"; 
$srsexam_subcategory_mst = mysqli_query($conn, $sqryexam_subcategory_mst);
$cntrecexam_subcategory_mst = mysqli_num_rows($srsexam_subcategory_mst);
if ($cntrecexam_subcategory_mst > 0) {
	$rowsexam_subcategory_mst = mysqli_fetch_assoc($srsexam_subcategory_mst);
	$db_mnlnksnm = $rowsexam_subcategory_mst['topicsm_name'];
	$db_catname = $rowsexam_subcategory_mst['exam_subcategorym_name'];
	$db_gnrtdfrm = $rowsexam_subcategory_mst['exam_subcategorym_gnrtdfrm'];
	$db_catdesc = stripslashes($rowsexam_subcategory_mst['exam_subcategorym_desc']);
	$db_cattyp = $rowsexam_subcategory_mst['exam_subcategorym_typ'];
	$db_dsplytyp = $rowsexam_subcategory_mst['exam_subcategorym_dsplytyp'];
	$db_catseottl = $rowsexam_subcategory_mst['exam_subcategorym_seotitle'];
	$db_catseodesc = $rowsexam_subcategory_mst['exam_subcategorym_seodesc'];
	$db_catseokywrd = $rowsexam_subcategory_mst['exam_subcategorym_seokywrd'];
	$db_catseohone = $rowsexam_subcategory_mst['exam_subcategorym_seohone'];
	$db_catseohtwo = $rowsexam_subcategory_mst['exam_subcategorym_seohtwo'];
	$db_catprty = $rowsexam_subcategory_mst['exam_subcategorym_prty'];
	$db_catsts = $rowsexam_subcategory_mst['exam_subcategorym_sts'];
	$db_typ = $rowsexam_subcategory_mst['exam_subcategorym_admtyp'];
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
		document.frmedtexam_subcategory.action = "<?php echo $rd_edtpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		document.frmedtexam_subcategory.submit();
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
					<h1 class="m-0 text-dark">View Exam Subcategory</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Exam Subcategory</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtexam_subcategory" id="frmedtexam_subcategory" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtexam_subcategory', rules, 'inline');">
		<input type="hidden" name="hdnexam_subcategoryid" value="<?php echo $id; ?>">
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
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtexam_subcategory" id="frmedtexam_subcategory" value="Edit"
								onclick="update1()">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary btn-cst" name="btnexam_subcategoryreset" value="Clear"
								id="btnexam_subcategoryreset">
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