<?php
$pagetitle = "View All Categories";
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_Courses_category.php	
Purpose : For Viewing all Categories
Created By : Bharath
Created On : 20-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
 ************************************************************/
global $msg, $loc, $rowsprpg, $dispmsg, $disppg;
$clspn_val = "8";
$rd_adpgnm = "add_Courses_category.php";
$rd_edtpgnm = "edit_Courses_category.php";
$rd_crntpgnm = "view_Courses.php";
$rd_vwpgnm = "view_detail_courses_category.php";
$loc = "";
/*****header link********/
$pagemncat = "Regular Courses";
$pagecat = "Courses";
$pagenm = "Courses";
/*****header link********/
if (isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts']) != "")) {
	$dchkval = substr($_POST['hdnchksts'], 1);
	$id = glb_func_chkvl($dchkval);

	$updtsts = funcUpdtAllRecSts('cours_mst', 'coursm_id', $id, 'coursm_sts');
	if ($updtsts == 'y') {
		$msg = "<font color=red>Record updated successfully</font>";
	} elseif ($updtsts == 'n') {
		$msg = "<font color=red>Record not updated</font>";
	}
}
if (($_POST['hdnchkval'] != "") && isset($_REQUEST['hdnchkval'])) {
	$dchkval = substr($_POST['hdnchkval'], 1);
	$did = glb_func_chkvl($dchkval);
	$del = explode(',', $did);
	$count = sizeof($del);
	$smlimg = array();
	$smlimgpth = array();
	for ($i = 0; $i < $count; $i++) {
		$sqrycrs_mst = "SELECT Coursm_img from cours_mst where Coursm_id=$del[$i]";
		$srscrs_mst = mysqli_query($conn, $sqrycrs_mst);
		$cntreccrs_mst = mysqli_num_rows($srscrs_mst);
		while ($srowcrs_mst = mysqli_fetch_assoc($srscrs_mst)) {
			$smlimg[$i] = glb_func_chkvl($srowcrs_mst['Coursm_img']);
			$smlimgpth[$i] = $gcrs_fldnm . $smlimg[$i];
			for ($j = 0; $j < $cntreccrs_mst; $j++) {
				if (($smlimg[$i] != "") && file_exists($smlimgpth[$i])) {
					unlink($smlimgpth[$i]);
				}
			}
		}
	}
	$delsts = funcDelAllRec($conn, 'cours_mst', 'coursm_id', $did);
	if ($delsts == 'y') {
		$msg = "<font color=red>Record deleted successfully</font>";
	} elseif ($delsts == 'n') {
		$msg = "<font color=red>Record can't be deleted(child records exist)</font>";
	}
}
if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) != '')) {
	if ($_REQUEST['sts'] == 'y') {
		$msg = "<font color=red>Record updated successfully</font>";
	} elseif ($_REQUEST['sts'] == 'n') {
		$msg = "<font color=red>Record not updated</font>";
	} elseif ($_REQUEST['sts'] == 'd') {
		$msg = "<font color=red>Duplicate Record Exists & Record Not updated</font>";
	}
}
$rowsprpg = 20; //maximum rows per page
include_once "../includes/inc_paging1.php"; //Includes pagination
include_once 'script.php'; ?>
<script language="javascript">
	function addnew() {
		document.frmCoursescat.action = "<?php echo $rd_adpgnm; ?>";
		document.frmCoursescat.submit();
	}

	function chng() {
		var div1 = document.getElementById("div1");
		var div2 = document.getElementById("div2");
		if (document.frmCoursescat.lstsrchby.value == 'n') {
			div1.style.display = "block";
			div2.style.display = "none";
		} else if (document.frmCoursescat.lstsrchby.value == 't') {
			div1.style.display = "none";
			div2.style.display = "block";
		}
	}

	function onload() {
		<?php
		if (isset($_POST['lstsrchby']) && $_POST['lstsrchby'] == 'n') { ?>
			div1.style.display = "block";
			div2.style.display = "none";
			<?php
		} elseif (isset($_POST['lstsrchby']) && $_POST['lstsrchby'] == 't') { ?>
			div1.style.display = "none";
			div2.style.display = "block";
			<?php
		}
		?>
	}

	function srch() {
		var urlval = "";
		if ((document.frmCoursescat.lstprodmcat.value == "") && (document.frmCoursescat.txtsrchval.value == "")) {
			alert("Select Search Criteria");
			document.frmCoursescat.lstprodmcat.focus();
			return false;
		}
		var lstprodmcat = document.frmCoursescat.lstprodmcat.value;
		var txtsrchval = document.frmCoursescat.txtsrchval.value;
		if (lstprodmcat != '') {
			if (urlval == "") {
				urlval += "lstprodmcat=" + lstprodmcat;
			} else {
				urlval += "&lstprodmcat=" + lstprodmcat;
			}
		}
		if (txtsrchval != '') {
			if (urlval == "") {
				urlval += "txtsrchval=" + txtsrchval;
			} else {
				urlval += "&txtsrchval=" + txtsrchval;
			}
		}
		if (document.frmCoursescat.chkexact.checked == true) {
			document.frmCoursescat.action = "<?php echo $rd_crntpgnm; ?>?" + urlval + "&chk=y";
			document.frmCoursescat.submit();
		} else {
			document.frmCoursescat.action = "<?php echo $rd_crntpgnm; ?>?" + urlval;
			document.frmCoursescat.submit();
		}
	}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
<?php
include_once $inc_adm_hdr;
//include_once $inc_adm_lftlnk;
?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">View All Courses</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View All Courses</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- Default box -->
	<div class="card">
		<?php if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) { ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert" id="delids">
				<strong>Deleted Successfully!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php
		}
		?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert" id="updid" style="display:none">
			<strong>Updated Successfully !</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="alert alert-info alert-dismissible fade show" role="alert" id="sucid" style="display:none">
			<strong>Added Successfully !</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="card-body p-0">
			<form method="post" action="<?php $_SERVER['SCRIPT_NAME']; ?>" name="frmCoursescat" id="frmCoursescat">
				<input type="hidden" name="hdnchkval" id="hdnchkval">
				<input type="hidden" name="hdnchksts" id="hdnchksts">
				<input type="hidden" name="hdnallval" id="hdnallval">
				<div class="col-md-12">
					<div class="row justify-content-left align-items-center">
						<div class="col-sm-3">
							<div class="form-group">
								<?php
								$sqryprodmcat_mst = "SELECT grad_typm_id,grad_typm_name from grad_typ_mst where grad_typm_sts = 'a' order by grad_typm_name";
								$srsprodmcat_mst = mysqli_query($conn, $sqryprodmcat_mst);
								$cnt_prodmcat = mysqli_num_rows($srsprodmcat_mst);
								?>
								<select name="lstprodmcat" id="lstprodmcat" class="form-control">
									<option value="">--Select Graduation Type--</option>
									<?php
									if ($cnt_prodmcat > 0) {
										while ($rowsprodmcat_mst = mysqli_fetch_assoc($srsprodmcat_mst)) {
											$prodmnlnksm_id = $rowsprodmcat_mst['grad_typm_id'];
											$prodmnlnksm_name = $rowsprodmcat_mst['grad_typm_name'];
											?>
											<option value="<?php echo $prodmnlnksm_id; ?>" <?php if (isset($_REQUEST['lstprodmcat']) && trim($_REQUEST['lstprodmcat']) == $prodmnlnksm_id) {
													 echo 'selected';
												 } ?>><?php echo $prodmnlnksm_name; ?></option>
									<?php
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label for="txtsrchval"></label>
								<div id="div1" style="display:block">
									<input type="text" name="txtsrchval" class="form-control" value="<?php if (isset($_POST['txtsrchval']) && ($_POST['txtsrchval'] != "")) {
										echo $_POST['txtsrchval'];
									} elseif (isset($_REQUEST['val']) && ($_REQUEST['txtsrchval'] != "")) {
										echo $_REQUEST['txtsrchval'];
									} ?>" placeholder="Search By Name">
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">Exact
								<input type="checkbox" name="chkexact" value="1" <?php if (isset($_POST['chkexact']) && ($_POST['chkexact'] == 1)) {
									echo 'checked';
								} elseif (isset($_REQUEST['chk']) && ($_REQUEST['chk'] == 'y')) {
									echo 'checked';
								} ?>>
								&nbsp;&nbsp;&nbsp;
								<input name="button" type="button" class="btn btn-primary" onClick="srch()" value="Search">
								<a href="<?php echo $rd_crntpgnm; ?>" class="btn btn-primary">Refresh</a>
								<button type="submit" class="btn btn-primary" onClick="addnew();">+ Add</button>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table width="100%" border="0" cellpadding="3" cellspacing="1" class="table table-striped projects">
							<tr>
								<td colspan="<?php echo $clspn_val - 2; ?>">&nbsp;</td>
								<td align="center">
									<input name="btnsts" id="btnsts" type="button" value="Status" class="btn btn-xs btn-primary"
										onClick="updatests('hdnchksts','frmCoursescat','chksts')">
								</td>
								<td align="center">
									<input name="btndel" id="btndel" type="button" value="Delete" class="btn btn-xs btn-primary"
										onClick="deleteall('hdnchkval','frmCoursescat','chkdlt');">
								</td>
							</tr>
							<tr>
								<td width="7%"><strong>SL.No.</strong></td>
								<td width="20%" class="td_bg"><strong>Name</strong></td>
								<td width="8%"><strong>Graduation Type</strong></td>
								<td width="8%"><strong>Image</strong></td>
								<td width="9%" align="center"><strong>Rank</strong></td>
								<td width="6%" align="center"><strong>Edit</strong></td>
								<td width="7%" align="center"><strong>
										<input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes"
											onClick="Check(document.frmCoursescat.chksts,'Check_ctr','hdnallval')"></strong>
								</td>
								<td width="7%" align="center"><strong>
										<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes"
											onClick="Check(document.frmCoursescat.chkdlt,'Check_dctr')"></strong>
								</td>
							</tr>
							<?php
							$sqrycours_mst1 = "SELECT coursm_typ,coursm_id,coursm_name,coursm_prty, grad_typm_name,coursm_sts,Coursm_img from cours_mst inner join grad_typ_mst on grad_typ_mst.grad_typm_id=cours_mst.coursm_typ";
							if (isset($_REQUEST['lstprodmcat']) && (trim($_REQUEST['lstprodmcat']) != "")) {
								$lstprodmcat = glb_func_chkvl($_REQUEST['lstprodmcat']);
								$loc .= "&lstprodmcat=" . $lstprodmcat;
								if (isset($_REQUEST['chk']) && (trim($_REQUEST['chk']) == 'y')) {
									$sqrycours_mst1 .= " and Coursm_typ = '$lstprodmcat'";
								} else {
									$sqrycours_mst1 .= " and Coursm_typ like '%$lstprodmcat%'";
								}
							}
							if (isset($_REQUEST['txtsrchval']) && (trim($_REQUEST['txtsrchval']) != "")) {
								$txtsrchval = glb_func_chkvl($_REQUEST['txtsrchval']);
								$loc .= "&txtsrchval=" . $txtsrchval;
								if (isset($_REQUEST['chk']) && (trim($_REQUEST['chk']) == 'y')) {
									$sqrycours_mst1 .= " and coursm_name ='$txtsrchval'";
								} else {
									$sqrycours_mst1 .= " and coursm_name like '%$txtsrchval%'";
								}
							}
							$sqrycours_mst = $sqrycours_mst1 . " order by coursm_name asc limit $offset,$rowsprpg";
							$srscours_mst = mysqli_query($conn, $sqrycours_mst);
							$cnt_recs = mysqli_num_rows($srscours_mst);
							$cnt = $offset;
							if ($cnt_recs > 0) {
								while ($srowcours_mst = mysqli_fetch_assoc($srscours_mst)) {
									$cnt += 1;
									$pgval_srch = $pgnum . $loc;
									$db_catid = $srowcours_mst['coursm_id'];
									$db_courstyp = $srowcours_mst['coursm_typ'];
									$db_catname = $srowcours_mst['coursm_name'];
									$db_mncatname = $srowcours_mst['grad_typm_name'];
									$db_prty = $srowcours_mst['coursm_prty'];
									$db_cattyp = $srowcours_mst['coursm_typ'];
									$db_dplytyp = $srowcours_mst['coursm_dsplytyp'];
									$db_sts = $srowcours_mst['coursm_sts'];
									$db_hmprty = $srowcours_mst['coursm_hmprty'];
									$db_crsimg = $srowcours_mst['Coursm_img'];
									?>
									<tr <?php if ($cnt % 2 == 0) {
										echo "";
									} else {
										echo "";
									} ?>>
										<td>
											<?php echo $cnt; ?>
										</td>
										<td>
											<a href="<?php echo $rd_vwpgnm; ?>?vw=<?php echo $db_catid; ?>&pg=<?php echo  $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>" class="links"><?php echo $db_catname; ?></a>
										</td>
										<td>
											<?php echo $db_mncatname; ?>
										</td>
										<td align="center">
											<?php
											$imgnm = $db_crsimg;
											$imgpath = $gcrs_fldnm . $imgnm;
											if (($imgnm != "") && file_exists($imgpath)) {
												echo "<img src='$imgpath' width='50pixel' height='50pixel'>";
											} else {
												echo "NA";
											}
											?>
										</td>
										<td align="center">
											<?php echo $db_prty; ?>
										</td>
										<td align="center">
											<a href="<?php echo $rd_edtpgnm; ?>?edit=<?php echo $db_catid; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>"
												class="orongelinks">Edit</a>
										</td>
										<td align="center">
											<input type="checkbox" name="chksts" id="chksts" value="<?php echo $db_catid; ?>" <?php if ($db_sts == 'a') {
													 echo "checked";
												 } ?> onClick="addchkval(<?php echo $db_catid; ?>,'hdnchksts','frmCoursescat','chksts');">
										</td>
										<td align="center">
											<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $db_catid; ?>">
										</td>
									</tr>
									<?php
								}
							} else {
								$msg = "<font color=red>No Records In Database</font>";
							}
							?>
							<tr>
								<td colspan="<?php echo $clspn_val - 2; ?>">&nbsp;</td>
								<td width="7%" align="center" valign="bottom">
									<input name="btnsts" id="btnsts" type="button" value="Status"
										onClick="updatests('hdnchksts','frmCoursescat','chksts')" class="btn btn-xs btn-primary">
								</td>
								<td width="7%" align="center" valign="bottom">
									<input name="btndel" id="btndel" type="button" value="Delete"
										onClick="deleteall('hdnchkval','frmCoursescat','chkdlt');" class="btn btn-xs btn-primary">
								</td>
							</tr>
							<?php
							$disppg = funcDispPag($conn, 'links', $loc, $sqrycours_mst1, $rowsprpg, $cntstart, $pgnum);
							$colspanval = $clspn_val + 2;
							if ($disppg != "") {
								$disppg = "<br><tr><td colspan='$colspanval' align='center' >$disppg</td></tr>";
								echo $disppg;
							}
							if ($msg != "") {
								$dispmsg = "<tr><td colspan='$colspanval' align='center' >$msg</td></tr>";
								echo $dispmsg;
							}
							?>
						</table>
					</div>
				</div>
			</form>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>