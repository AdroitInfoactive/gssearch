<?php
$pagetitle = "View All Exams";
error_reporting(0);
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_main_category.php	
Purpose : For Viewing all Main Categories
Created By : Bharath
Created On : 20-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
 ************************************************************/
global $msg, $loc, $rowsprpg, $dispmsg, $disppg, $offset;
$clspn_val = "5";
$rd_adpgnm = "add_subscription_amt.php";
$rd_edtpgnm = "";
$rd_crntpgnm = "view_subscription_amt.php";
$rd_vwpgnm = "";
$loc = "";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Product Group";
$pagenm = "Subscription";
/*****header link********/
if (isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts']) != "") || isset($_POST['hdnallval']) && (trim($_POST['hdnallval']) != "")) {
	$dchkval = substr($_POST['hdnchksts'], 1);
	$id = glb_func_chkvl($dchkval);
	$chkallval	= glb_func_chkvl($_POST['hdnallval']);
	$updtsts = funcUpdtAllRecSts('subscrptn_amt_mst', 'subscrptnm_amt_id', $id, 'subscrptnm_amt_sts');
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
	for ($i = 0; $i < $count; $i++) {
		$sqryprodcat_mst = "select 
								subscrptnm_amt_bnrimg	
						  from 
								subscrptn_amt_mst
						  where
								subscrptnm_amt_id=$del[$i]";
		$srsprodcat_mst     = mysqli_query($conn, $sqryprodcat_mst);
		$cntrec_prodcat	 = mysqli_num_rows($srsprodcat_mst);
		if ($cntrec_prodcat > 0) {
			$srowprodcat_mst = mysqli_fetch_assoc($srsprodcat_mst);
			$bnrimg[$i]      = glb_func_chkvl($srowprodcat_mst['subscrptnm_amt_bnrimg']);
			$bnrimgpth[$i]   = $a_mnlnks_bnrfldnm . $bnrimg[$i];
		}
	}
	$delsts = funcDelAllRec($conn,'subscrptn_amt_mst', 'subscrptnm_amt_id', $did);
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
if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) {
	$msg = "<font color=red>Record updated successfully</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")) {
	$msg = "<font color=red>Record not updated</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")) {
	$msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
}
$rowsprpg = 20; //maximum rows per page
include_once "../includes/inc_paging1.php"; //Includes pagination
include_once 'script.php'; ?>
<script language="javascript">
	function addnew() {
		document.frmaddsubscrptn_amt.action = "<?php echo $rd_adpgnm; ?>";
		document.frmaddsubscrptn_amt.submit();
	}

	function chng() {
		var div1 = document.getElementById("div1");
		var div2 = document.getElementById("div2");
		if (document.frmaddsubscrptn_amt.lstsrchby.value == 'n') {
			div1.style.display = "block";
			div2.style.display = "none";
		} else if (document.frmaddsubscrptn_amt.lstsrchby.value == 't') {
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

		if (document.frmaddsubscrptn_amt.txtsrchval.value == "") {
			alert("Please Enter Amount");
			document.frmaddsubscrptn_amt.txtsrchval.focus();
			return false;
		}
		var val = document.frmaddsubscrptn_amt.txtsrchval.value;
		if (document.frmaddsubscrptn_amt.chkexact.checked == true) {
			document.frmaddsubscrptn_amt.action = "<?php echo $rd_crntpgnm; ?>?val=" + val + "&chk=y";
			document.frmaddsubscrptn_amt.submit();
		} else {
			document.frmaddsubscrptn_amt.action = "<?php echo $rd_crntpgnm; ?>?val=" + val;
			document.frmaddsubscrptn_amt.submit();
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
					<h1 class="m-0 text-dark">View All Subscription Amount</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View All Subscription Amount</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- Default box -->
	<div class="card">
	
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
			<form method="post" action="<?php $_SERVER['SCRIPT_NAME']; ?>" name="frmaddsubscrptn_amt" id="frmaddsubscrptn_amt">
				<input type="hidden" name="hdnchkval" id="hdnchkval">
				<input type="hidden" name="hdnchksts" id="hdnchksts">
				<input type="hidden" name="hdnallval" id="hdnallval">
				<div class="col-md-12">
					<div class="row justify-content-left align-items-center">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="txtsrchval"></label>
								<div id="div1" style="display:block">
									<input type="text" name="txtsrchval" class="form-control" value="<?php if (isset($_POST['txtsrchval']) && ($_POST['txtsrchval'] != "")) {
																											echo $_POST['txtsrchval'];
																										} elseif (isset($_REQUEST['val']) && ($_REQUEST['val'] != "")) {
																											echo $_REQUEST['val'];
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
								<td colspan="<?php echo $clspn_val-3; ?>">&nbsp;</td>
								<td align="center">
									<input name="btnsts" id="btnsts" type="button" value="Status" class="btn btn-xs btn-primary" onClick="updatests('hdnchksts','frmaddsubscrptn_amt','chksts')">
								</td>
								<td align="center">
									<input name="btndel" id="btndel" type="button" value="Delete" class="btn btn-xs btn-primary" onClick="deleteall('hdnchkval','frmaddsubscrptn_amt','chkdlt');">
								</td>
							</tr>
							<tr>
								<td width="7%" align="left"><strong>SL.No.</strong></td>
								<td width="21%" align="left"><strong>Amount</strong></td>
							
								<!-- <td width="9%" align="center"><strong>Rank</strong></td> -->
								<!-- <td width="6%" align="center"><strong>Edit</strong></td> -->
								<td width="7%" align="center"><strong>
										<input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes" onClick="Check(document.frmaddsubscrptn_amt.chksts,'Check_ctr','hdnallval')"></strong>
								</td>
								<td width="7%" align="center"><strong>
										<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmaddsubscrptn_amt.chkdlt,'Check_dctr')"></strong>
								</td>
							</tr>
							<?php
							$sqryprodmcat_mst1 = "select 
									  	subscrptnm_amt_id,subscrptnm_amt_name,subscrptnm_amt_sts,subscrptnm_amt_prty				       		
							       from 
								   		subscrptn_amt_mst"; 
							if (isset($_REQUEST['val']) && $_REQUEST['val'] != "") {
								$val = glb_func_chkvl($_REQUEST['val']);
								if (isset($_REQUEST['chk']) && $_REQUEST['chk'] == 'y') {
									$loc = "&val=" . $val . "&chk=y";
									$sqryprodmcat_mst1 .= " where subscrptnm_amt_name='$val'";
								} else {
									$loc = "&val=" . $val;
									$sqryprodmcat_mst1 .= " where subscrptnm_amt_name like '%$val%'";
								}
							}
							$sqryprodmcat_mst = $sqryprodmcat_mst1 . " order by subscrptnm_amt_sts asc limit $offset,$rowsprpg";
							$srsprodmcat_mst = mysqli_query($conn, $sqryprodmcat_mst);
							$cnt_recs = mysqli_num_rows($srsprodmcat_mst);
							$cnt = $offset;
							if ($cnt_recs > 0) {
								while ($srowprodcat_mst = mysqli_fetch_assoc($srsprodmcat_mst)) {
									$cnt += 1;
									$pgval_srch	= $pgnum . $loc;
									$db_catid	= $srowprodcat_mst['subscrptnm_amt_id'];
									$db_catname	= $srowprodcat_mst['subscrptnm_amt_name'];
									// $db_dplytyp	= $srowprodcat_mst['subscrptnm_amt_dsplytyp'];
									$db_sts		= $srowprodcat_mst['subscrptnm_amt_sts'];
									$db_prty	= $srowprodcat_mst['subscrptnm_amt_prty'];
									//$db_mncatimg = $srowprodmcat_mst['prodmn_catm_smlimg'];
									//$db_mncatbnrimg = $srowprodcat_mst['prodmn_catm_bnrimg'];
                  ?> 
                  <tr <?php if ($cnt % 2 == 0) {
                    echo "";
                  } else {
                    echo "";
                  } ?>>
                  <td><?php echo $cnt; ?></td>
                  <td>
                    <a href="<?php echo $rd_vwpgnm; ?>?vw=<?php echo $db_catid; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>" class="links"><?php echo $db_catname; ?></a>
                  </td>
                  
                  <td align="center">
                    <input type="checkbox" name="chksts" id="chksts" value="<?php echo $db_catid; ?>" <?php if ($db_sts == 'a') {
                      echo "checked";
                    } ?> onClick="addchkval(<?php echo $db_catid; ?>,'hdnchksts','frmaddsubscrptn_amt','chksts');">
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
								<td colspan="<?php echo $clspn_val-3; ?>">&nbsp;</td>
								<td width="7%" align="center" valign="bottom">
									<input name="btnsts" id="btnsts" type="button" value="Status" onClick="updatests('hdnchksts','frmaddsubscrptn_amt','chksts')" class="btn btn-xs btn-primary">
								</td>
								<td width="7%" align="center" valign="bottom">
									<input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmaddsubscrptn_amt','chkdlt');" class="btn btn-xs btn-primary">
								</td>
							</tr>
							<?php
							$disppg = funcDispPag($conn, 'links', $loc, $sqryprodmcat_mst1, $rowsprpg, $cntstart, $pgnum);
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