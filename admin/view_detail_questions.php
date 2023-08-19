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
$pagenm = "Add Questions";
/*****header link********/
global $id, $pg, $countstart;
$rd_crntpgnm = "view_questions.php";
$rd_edtpgnm = "edit_questions.php";
$clspn_val = "4";
if (isset($_REQUEST['vw']) && (trim($_REQUEST['vw']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}

 $sqryaddques_mst = "SELECT 
addquesm_qnm,addquesm_prty,addquesm_optn1,addquesm_optn2,addquesm_optn3,addquesm_optn4,addquesm_crtans,addquesm_expln,
if(addquesm_sts = 'a', 'Active','Inactive') as addquesm_sts,
addquesm_prodmnexmsm_id,prodmnexmsm_name,addquesm_yearsm_id,yearsm_name,addquesm_topicsm_id,topicsm_name,addquesm_subtopicsm_id,subtopicsm_name
from 
addques_mst
inner join 	prodmnexms_mst
on		prodmnexms_mst.prodmnexmsm_id=addques_mst.addquesm_prodmnexmsm_id
inner join 	years_mst
on		years_mst.yearsm_id=addques_mst.addquesm_yearsm_id
inner join 	topics_mst
on		topics_mst.topicsm_id=addques_mst.addquesm_topicsm_id
inner join 	subtopics_mst
on		subtopics_mst.subtopicsm_id=addques_mst.addquesm_subtopicsm_id
where 
addquesm_id=$id"; 
$srsaddques_mst = mysqli_query($conn, $sqryaddques_mst);
$cntrecaddques_mst = mysqli_num_rows($srsaddques_mst);
if ($cntrecaddques_mst > 0) {
	$rowsaddques_mst = mysqli_fetch_assoc($srsaddques_mst);
	$db_exmsmnm = $rowsaddques_mst['prodmnexmsm_name'];
	$db_yearsm = $rowsaddques_mst['yearsm_name'];
	$db_qnm = strip_tags(html_entity_decode($rowsaddques_mst['addquesm_qnm']));
	$db_optn1 = strip_tags(html_entity_decode($rowsaddques_mst['addquesm_optn1']));
  $db_optn2 = strip_tags(html_entity_decode($rowsaddques_mst['addquesm_optn2']));
  $db_optn3 = strip_tags(html_entity_decode($rowsaddques_mst['addquesm_optn3']));
  $db_optn4 = strip_tags(html_entity_decode($rowsaddques_mst['addquesm_optn4']));
  $db_crtans = $rowsaddques_mst['addquesm_crtans'];
  $db_expln = strip_tags(html_entity_decode($rowsaddques_mst['addquesm_expln']));
  $db_topic = $rowsaddques_mst['topicsm_name'];
  $db_subtopic = $rowsaddques_mst['subtopicsm_name'];
	// $db_cattyp = $rowsaddques_mst['addquesm_typ'];
	// $db_dsplytyp = $rowsaddques_mst['addquesm_dsplytyp'];
	// $db_catseottl = $rowsaddques_mst['addquesm_seotitle'];
	// $db_catseodesc = $rowsaddques_mst['addquesm_seodesc'];
	// $db_catseokywrd = $rowsaddques_mst['addquesm_seokywrd'];
	// $db_catseohone = $rowsaddques_mst['addquesm_seohone'];
	// $db_catseohtwo = $rowsaddques_mst['addquesm_seohtwo'];
	$db_catprty = $rowsaddques_mst['addquesm_prty'];
	$db_catsts = $rowsaddques_mst['addquesm_sts'];
	$db_typ = $rowsaddques_mst['addquesm_admtyp'];
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
		document.frmedtaddques.action = "<?php echo $rd_edtpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
		document.frmedtaddques.submit();
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
					<h1 class="m-0 text-dark">View Question Details</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Question Details</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtaddques" id="frmedtaddques" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		onSubmit="return performCheck('frmedtaddques', rules, 'inline');">
		<input type="hidden" name="hdnaddquesid" value="<?php echo $id; ?>">
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
                    <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Exam </label>
                    <div class="col-sm-8">
                      <?php echo $db_exmsmnm; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Year  </label>
							<div class="col-sm-8">
								<?php echo $db_yearsm; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Question </label>
							<div class="col-sm-8">
								<?php echo $db_qnm; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Options1</label>
							<div class="col-sm-8">
								<?php echo $db_optn1; ?>
							</div>
						</div> 
            <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Options2</label>
							<div class="col-sm-8">
								<?php echo $db_optn2; ?>
							</div>
						</div>
            <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Options3</label>
							<div class="col-sm-8">
								<?php echo $db_optn3; ?>
							</div>
						</div>
            <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Options4</label>
							<div class="col-sm-8">
								<?php echo $db_optn4; ?>
							</div>
						</div>
            <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Correct Answer</label>
							<div class="col-sm-8">
                <?php 
                if($db_crtans == "1"){
                  $crtans = "Option 1";
                }
                if($db_crtans == "2"){
                  $crtans = "Option 2";
                }
                if($db_crtans == "3"){
                  $crtans = "Option 3";
                }
                if($db_crtans == "4"){
                  $crtans = "Option 4";
                }
                echo $crtans; 
                ?>
							</div>
						</div>
            <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Explanation</label>
							<div class="col-sm-8">
								<?php echo $db_expln; ?>
							</div>
						</div>
            <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Topic</label>
							<div class="col-sm-8">
								<?php echo $db_topic; ?>
							</div>
						</div>
            <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Sub Topic</label>
							<div class="col-sm-8">
								<?php echo $db_subtopic; ?>
							</div>
						</div>
						<!-- <div class="form-group row">
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
						</div> -->

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
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtaddques" id="frmedtaddques" value="Edit"
								onclick="update1()">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary btn-cst" name="btnaddquesreset" value="Clear"
								id="btnaddquesreset">
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