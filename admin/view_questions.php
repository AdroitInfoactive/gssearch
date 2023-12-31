<?php
$pagetitle = "View All Questions";
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_product_addques.php	
Purpose : For Viewing all Categories
Created By : Bharath
Created On : 20-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
 ************************************************************/
global $msg, $loc, $rowsprpg, $dispmsg, $disppg;
$clspn_val = "6";
$rd_adpgnm = "add_questions.php";
$rd_edtpgnm = "edit_questions.php";
$rd_crntpgnm = "view_questions.php";
$rd_vwpgnm = "view_detail_questions.php";
$loc = "";
/*****header link********/
$pagemncat = "Questions";
$pagecat = "";
$pagenm = "Questions";
/*****header link********/
if (isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts']) != "")) {
	$dchkval = substr($_POST['hdnchksts'], 1);
	$id = glb_func_chkvl($dchkval);

	$updtsts = funcUpdtAllRecSts('addques_mst', 'addquesm_id', $id, 'addquesm_sts');
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
	$bnrimg = array();
	$bnrimgpth = array();
	for ($i = 0; $i < $count; $i++) {
		$sqryaddques_mst = "select 
									addquesm_bnrimg
								from 
									addques_mst
								where
									addquesm_id=$del[$i]";
		$srsaddques_mst = mysqli_query($conn, $sqryaddques_mst);
		$cntrec_addques = mysqli_num_rows($srsaddques_mst);
		if ($cntrec_addques > 0) {
			$srowaddques_mst = mysqli_fetch_assoc($srsaddques_mst);
			$bnrimg[$i] = glb_func_chkvl($srowaddques_mst['addquesm_bnrimg']);
			$bnrimgpth[$i] = $a_cat_bnrfldnm . $bnrimg[$i];
		}
	}
	$delsts = funcDelAllRec($conn, 'addques_mst', 'addquesm_id', $did);
	$delsts = funcDelAllRec($conn, 'prodmcat_dtl', 'prodmcatd_catm_id', $did);
	if ($delsts == 'y') {
		for ($i = 0; $i < $count; $i++) {
			if (($bnrimg[$i] != "") && file_exists($bnrimgpth[$i])) {
				unlink($bnrimgpth[$i]);
			}
		}
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
		document.frmproductcat.action = "<?php echo $rd_adpgnm; ?>";
		document.frmproductcat.submit();
	}

	function chng() {
		var div1 = document.getElementById("div1");
		var div2 = document.getElementById("div2");
		if (document.frmproductcat.lstsrchby.value == 'n') {
			div1.style.display = "block";
			div2.style.display = "none";
		} else if (document.frmproductcat.lstsrchby.value == 't') {
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
		if ((document.frmproductcat.lstprodmcat.value == "") && (document.frmproductcat.txtsrchval.value == "")) {
			alert("Select Search Criteria");
			document.frmproductcat.lstprodmcat.focus();
			return false;
		}
		var lstprodmcat = document.frmproductcat.lstprodmcat.value;
		var txtsrchval = document.frmproductcat.txtsrchval.value;
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
		if (document.frmproductcat.chkexact.checked == true) {
			document.frmproductcat.action = "<?php echo $rd_crntpgnm; ?>?" + urlval + "&chk=y";
			document.frmproductcat.submit();
		} else {
			document.frmproductcat.action = "<?php echo $rd_crntpgnm; ?>?" + urlval;
			document.frmproductcat.submit();
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
					<h1 class="m-0 text-dark">View All Questions</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View All Questions</li>
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
			<form method="post" action="<?php $_SERVER['SCRIPT_NAME']; ?>" name="frmproductcat" id="frmproductcat">
				<input type="hidden" name="hdnchkval" id="hdnchkval">
				<input type="hidden" name="hdnchksts" id="hdnchksts">
				<input type="hidden" name="hdnallval" id="hdnallval">
				<div class="col-md-12">
					<div class="row justify-content-left align-items-center">
						<div class="col-sm-3">
							<div class="form-group">
								<?php
								$sqryprodmcat_mst = "select 
							topicsm_id,topicsm_name						
								from 
								 topics_mst 
									where	 
							 topicsm_sts = 'a'
						 order by
							topicsm_name";
								$srsprodmcat_mst = mysqli_query($conn, $sqryprodmcat_mst);
								$cnt_prodmcat = mysqli_num_rows($srsprodmcat_mst);
								?>
								<select name="lstprodmcat" class="form-control">
									<option value="">--Select Main Topics--</option>
									<?php
									if ($cnt_prodmcat > 0) {
										while ($rowsprodmcat_mst = mysqli_fetch_assoc($srsprodmcat_mst)) {
											$topicsm_id = $rowsprodmcat_mst['topicsm_id'];
											$topicsm_name = $rowsprodmcat_mst['topicsm_name'];
											?>
											<option value="<?php echo $topicsm_id; ?>" <?php if (isset($_REQUEST['lstprodmcat']) && trim($_REQUEST['lstprodmcat']) == $topicsm_id) {
													 echo 'selected';
												 } ?>><?php echo $topicsm_name; ?>
											</option>
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
								<td colspan="<?php echo $clspn_val; ?>">&nbsp;</td>
								<td align="center">
									<input name="btnsts" id="btnsts" type="button" value="Status" class="btn btn-xs btn-primary"
										onClick="updatests('hdnchksts','frmproductcat','chksts')">
								</td>
								<td align="center">
									<input name="btndel" id="btndel" type="button" value="Delete" class="btn btn-xs btn-primary"
										onClick="deleteall('hdnchkval','frmproductcat','chkdlt');">
								</td>
							</tr>
							<tr>
								<td width="7%"><strong>SL.No.</strong></td>
								<td width="21%"><strong>Question</strong></td>
								<td width="21%"><strong>Exam</strong></td>
								<td width="15%" class="td_bg"><strong>Year</strong></td>
								<td width="9%" align="center"><strong>Rank</strong></td>
								<td width="6%" align="center"><strong>Edit</strong></td>
								<td width="7%" align="center"><strong>
										<input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes"
											onClick="Check(document.frmproductcat.chksts,'Check_ctr','hdnallval')"></strong>
								</td>
								<td width="7%" align="center"><strong>
										<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes"
											onClick="Check(document.frmproductcat.chkdlt,'Check_dctr')"></strong>
								</td>
							</tr>
							<?php
							$sqryaddques_mst1 = "SELECT 
						addquesm_id,addquesm_qnm,addquesm_sts,addquesm_prty,
						addquesm_prodmnexmsm_id,addquesm_yearsm_id,prodmnexmsm_name,yearsm_name					       		
						from 
					   addques_mst
						inner join prodmnexms_mst
						on		prodmnexms_mst.prodmnexmsm_id=addques_mst.addquesm_prodmnexmsm_id
            inner join years_mst
            on		years_mst.yearsm_id=addques_mst.addquesm_yearsm_id";
							// echo "here".$sqryaddques_mst1 ;
							if (isset($_REQUEST['lstprodmcat']) && (trim($_REQUEST['lstprodmcat']) != "")) {
								$lstprodmcat = glb_func_chkvl($_REQUEST['lstprodmcat']);
								$loc .= "&lstprodmcat=" . $lstprodmcat;
								if (isset($_REQUEST['chk']) && (trim($_REQUEST['chk']) == 'y')) {
									$sqryaddques_mst1 .= " and addquesm_prodmnexmsm_id = '$lstprodmcat'";
								} else {
									$sqryaddques_mst1 .= " and addquesm_prodmnexmsm_id like '%$lstprodmcat%'";
								}
							}
							if (isset($_REQUEST['txtsrchval']) && (trim($_REQUEST['txtsrchval']) != "")) {
								$txtsrchval = glb_func_chkvl($_REQUEST['txtsrchval']);
								$loc .= "&txtsrchval=" . $txtsrchval;
								if (isset($_REQUEST['chk']) && (trim($_REQUEST['chk']) == 'y')) {
									$sqryaddques_mst1 .= " and addquesm_qnm ='$txtsrchval'";
								} else {
									$sqryaddques_mst1 .= " and addquesm_qnm like '%$txtsrchval%'";
								}
							}
							$sqryaddques_mst = $sqryaddques_mst1 . " order by addquesm_qnm asc limit $offset,$rowsprpg";
							$srsaddques_mst = mysqli_query($conn, $sqryaddques_mst);
							$cnt_recs = mysqli_num_rows($srsaddques_mst);
							$cnt = $offset;
							if ($cnt_recs > 0) {
								while ($srowaddques_mst = mysqli_fetch_assoc($srsaddques_mst)) {
									$cnt += 1;
									$pgval_srch = $pgnum . $loc;
									$db_catid = $srowaddques_mst['addquesm_id'];
									$db_qunname = strip_tags(html_entity_decode($srowaddques_mst['addquesm_qnm']));
								
									$db_exmsmname = $srowaddques_mst['prodmnexmsm_name'];
									$db_yearsname = $srowaddques_mst['yearsm_name'];
									$db_prty = $srowaddques_mst['addquesm_prty'];
									$db_sts = $srowaddques_mst['addquesm_sts'];
									$db_hmprty = $srowaddques_mst['addquesm_hmprty'];
									//$db_catimg = $srowaddques_mst['addquesm_smlimg'];
									//$db_catbnrimg = $srowaddques_mst['addquesm_bnrimg'];
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
											<a href="<?php echo $rd_vwpgnm; ?>?vw=<?php echo $db_catid; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>"
												class="links">	<?php echo substr($db_qunname, 0, 100); ?>..</a>
										</td>
										<td>
											<?php echo $db_exmsmname; ?>
										</td>
										<td>
											<?php echo $db_yearsname; ?>
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
												 } ?> onClick="addchkval(<?php echo $db_catid; ?>,'hdnchksts','frmproductcat','chksts');">
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
								<td colspan="<?php echo $clspn_val; ?>">&nbsp;</td>
								<td width="7%" align="center" valign="bottom">
									<input name="btnsts" id="btnsts" type="button" value="Status"
										onClick="updatests('hdnchksts','frmproductcat','chksts')" class="btn btn-xs btn-primary">
								</td>
								<td width="7%" align="center" valign="bottom">
									<input name="btndel" id="btndel" type="button" value="Delete"
										onClick="deleteall('hdnchkval','frmproductcat','chkdlt');" class="btn btn-xs btn-primary">
								</td>
							</tr>
							<?php
							$disppg = funcDispPag($conn, 'links', $loc, $sqryaddques_mst1, $rowsprpg, $cntstart, $pgnum);
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