<?php
include_once '../includes/inc_config.php'; //Making paging validation 
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_all_banner.php
Purpose : For Viewing Home page banners
Created By : Bharath
Created On : 05-01-2022
Modified By : 
Modified On :
Company : Adroit
************************************************************/
global $msg,$loc,$rowsprpg,$dispmsg,$disppg;
$clspn_val = "6";
// $rd_adpgnm = "add_progenqry.php";
// $rd_edtpgnm = "edit_progenqry.php";
$rd_crntpgnm = "view_all_progenqry.php";
$rd_vwpgnm = "view_detail_progenqry.php";
$loc = "";
/*****header link********/
$pagemncat = "Enquiries";
$pagecat = "Program Enquiries";
$pagenm = "Program Enquiries";
/*****header link********/
if(isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts'])!="") || isset($_POST['hdnallval']) && (trim($_POST['hdnallval'])!=""))
{
	$dchkval = substr($_POST['hdnchksts'],1);
	$id = glb_func_chkvl($dchkval);
	$chkallval = glb_func_chkvl($_POST['hdnallval']);				
	$updtsts = funcUpdtAllRecSts('progenqry_mst','progenqrym_id',$id,'progenqrym_sts',$chkallval);
	if($updtsts == 'y')
	{
		$msg = "<font color=red>Record updated successfully</font>";
	}
	elseif($updtsts == 'n')
	{
		$msg = "<font color=red>Record not updated</font>";
	}
}	
if(($_POST['hdnchkval']!="") && isset($_REQUEST['hdnchkval']))
{
	$dchkval = substr($_POST['hdnchkval'],1);
	$did = glb_func_chkvl($dchkval);
	$del = explode(',',$did);
	$delsts = funcDelAllRec($conn,'progenqry_mst','progenqrym_id',$did);
	if($delsts == 'y' )
	{
		$msg = "<font color=red>Record deleted successfully</font>";
	}
	elseif($delsts == 'n')
	{
		$msg = "<font color=red>Record can't be deleted(child records exist)</font>";
	}
}
if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))
{
	$msg = "<font color=red>Record updated successfully</font>";
}
elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n"))
{
	$msg = "<font color=red>Record not updated</font>";
}
elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d"))
{
	$msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
}
$rowsprpg = 20;//maximum rows per page
include_once '../includes/inc_paging1.php';//Includes pagination
$sqryprogenqry_mst1 = "SELECT progenqrym_id, progenqrym_code,progenqrym_name,progenqrym_crtdon from progenqry_mst"; 
if(isset($_REQUEST['txtname']) && (trim($_REQUEST['txtname'])!=""))
{
	$txtname = glb_func_chkvl($_REQUEST['txtname']);
	$loc .= "&txtname=".$txtname;
	if(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
	{
		$sqryprogenqry_mst2.=" where progenqrym_name ='$txtname'";
	}
	else
	{
		$sqryprogenqry_mst2.=" where progenqrym_name like '%$txtname%'";
	}
}
$sqryprogenqry_mst1 = $sqryprogenqry_mst1.$sqryprogenqry_mst2;
$sqryprogenqry_mst = $sqryprogenqry_mst1." order by progenqrym_crtdon desc limit $offset, $rowsprpg";
//echo $sqryprogenqry_mst; exit;
$srsprogenqry_mst = mysqli_query($conn,$sqryprogenqry_mst);
$cnt_recs = mysqli_num_rows($srsprogenqry_mst);
include_once 'script.php';
?>
<script language="javascript">
	function addnew()
	{
		document.frmprogenqrymst.action = "<?php echo $rd_adpgnm; ?>";
		document.frmprogenqrymst.submit();
	}
	function srch()
	{
		//alert("");
		var urlval="";
		if((document.frmprogenqrymst.txtname.value==""))
		{
			alert("Select Search Criteria");
			document.frmprogenqrymst.txtname.focus();
			return false;
		}
		var txtname = document.frmprogenqrymst.txtname.value;
		if(txtname !='')
		{
			if(urlval == "")
			{
				urlval +="txtname="+txtname;
			}
			else
			{
				urlval +="&txtname="+txtname;
			}
		}
		if(document.frmprogenqrymst.chkexact.checked==true)
		{
			document.frmprogenqrymst.action="<?php echo $rd_crntpgnm; ?>?"+urlval+"&chk=y";
			document.frmprogenqrymst.submit();
		}
		else
		{
			document.frmprogenqrymst.action="<?php echo $rd_crntpgnm; ?>?"+urlval;
			document.frmprogenqrymst.submit();
		}
		return true;
	}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
<link href="docstyle.css" rel="stylesheet" type="text/css">
<progenqryy>
	<?php include_once $inc_adm_hdr; ?>
	<section class="content">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">View All Courses Enquiries</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">View All Courses Enquiries</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- Default box -->
		<div class="card">
			<?php if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))
			{ ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert" id="delids">
					<strong>Deleted Successfully !</strong>
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
			<div class="card-progenqryy p-0">
				<form method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" name="frmprogenqrymst" id="frmprogenqrymst">
					<input type="hidden" name="hdnchkval" id="hdnchkval">
					<input type="hidden" name="hdnchksts" id="hdnchksts">
					<input type="hidden" name="hdnallval" id="hdnallval">
					<div class="col-md-12">
						<div class="row justify-content-left align-items-center mt-3">
							<div class="col-sm-7">
								<div class="form-group">
									<div class="col-8">
										<div class="row">
											<div class="col-10">
												<input type="text" name="txtname" placeholder="Search by name" id="txtname" class="form-control"  value="<?php if(isset($_REQUEST['txtname']) && $_REQUEST['txtname']!=""){echo $_REQUEST['txtname'];}?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">Exact
									<input type="checkbox" name="chkexact" value="1" <?php if(isset($_POST['chkexact']) && ($_POST['chkexact']==1)){echo 'checked';}elseif(isset($_REQUEST['chk']) && ($_REQUEST['chk']=='y')){echo 'checked';}?>>
									&nbsp;&nbsp;&nbsp;
									<input type="submit" value="Search" class="btn btn-primary" name="btnsbmt" onClick="srch();">
									<a href="<?php echo $rd_crntpgnm; ?>" class="btn btn-primary">Refresh</a>
									<!-- <button type="submit" class="btn btn-primary" onClick="addnew();">+ Add</button> -->
								</div>
							</div>
						</div>
					</div>
					<div class="card-progenqryy p-0">
						<div class="table-responsive">
							<table width="100%" border="0" cellpadding="3" cellspacing="1" class="table table-striped projects">
								<tr>
									<td colspan="<?php echo $clspn_val-2;?>" align='center'><?php echo $msg;?></td>

									<td width="7%" align="right" valign="bottom">
										<div align="center">
											<input name="btndel" id="btndel" type="button" class="btn btn-xs btn-primary" value="Delete" onClick="deleteall('hdnchkval','frmprogenqrymst','chkdlt');">
										</div>
									</td>
								</tr>
								<tr>
									<td width="8%" class="td_bg"><strong>SL.No.</strong></td>
                  <td width="28%" class="td_bg"><strong>Code</strong></td>
									<td width="28%" class="td_bg"><strong>Name</strong></td>
                  <td width="28%" class="td_bg"><strong>Date</strong></td>
                  <!-- <td width="28%" class="td_bg"><strong>Date</strong></td> -->
									<td width="7%" class="td_bg" align="center"><strong>
									<input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes" onClick="Check(document.frmprogenqrymst.chkdlt,'Check_dctr')"></strong></td>
								</tr>
								<?php
								$cnt = $offset;
								if($cnt_recs > 0)
								{
									while($srowprogenqry_mst=mysqli_fetch_assoc($srsprogenqry_mst))
									{
										$cnt+=1;
										$pgval_srch = $pgnum.$loc;
									 $db_subid = $srowprogenqry_mst['progenqrym_id'];
                    $db_code = $srowprogenqry_mst['progenqrym_code'];
										$db_subname = $srowprogenqry_mst['progenqrym_name'];
                    $db_crtdon = $srowprogenqry_mst['progenqrym_crtdon'];
                    // $db_subid = $srowprogenqry_mst['progenqrym_date'];
										?>
										<tr <?php if($cnt%2==0){echo "";}else{echo "";}?>>
											<td><?php echo $cnt;?></td>
											
											<td>
												<a href="<?php echo $rd_vwpgnm;?>?vw=<?php echo $db_subid;?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="links"><?php echo $db_code;?></a>
											</td>
                      
                      <td align="left"><?php echo $db_subname;?></td> 
                      <td align="left"><?php echo $db_crtdon;?></td> 
                      <td align="center">
												<input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $db_subid;?>">
											</td>
										</tr>
										<?php
									}
								}
								else
								{
									$msg="<font color=red>No Records In Database</font>";
								}
								?>
								<tr>
									<td colspan="<?php echo $clspn_val-2;?>">&nbsp;</td>
									<td width="7%" align="right" valign="bottom">
										<div align="center">
											<input name="btndel" id="btndel" type="button" value="Delete" onClick="deleteall('hdnchkval','frmprogenqrymst','chkdlt');" class="btn btn-xs btn-primary">
										</div>
									</td>
								</tr>
								<?php    
								$disppg = funcDispPag($conn,'links',$loc,$sqryprogenqry_mst1,$rowsprpg,$cntstart,$pgnum);     
								$colspanval = $clspn_val+2;            
								if($disppg != "")
								{
									$disppg = "<br><tr><td colspan='$colspanval' align='center' >$disppg</td></tr>";
									echo $disppg;
								}
								if($msg != "")
								{
									$dispmsg = "<tr><td colspan='$colspanval' align='center' >$msg</td></tr>";
									echo $dispmsg;
								}
								?>
							</table>
						</div>
					</div>
				</form>
			</div>
			<!-- /.card-progenqryy -->
		</div>
		<!-- /.card -->
	</section>
</progenqryy>
<?php include_once "../includes/inc_adm_footer.php"; ?>