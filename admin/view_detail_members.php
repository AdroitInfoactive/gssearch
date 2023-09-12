<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns;//Making paging validation
include_once $inc_fldr_pth;//Making paging validation
/***************************************************************
Programm : view_detail_main_category.php	
Purpose : For Viewing Main Category Details
Created By : Bharath
Created On : 30/10/2013
Modified By : 
Modified On :
Purpose : 
Company : Adroit
************************************************************/
/*****header link********/
$pagemncat = "Setup";	
$pagecat = "Members";
$pagenm = "Members";
/*****header link********/
global $id,$pg,$cntstart,$msg,$loc,$rd_crntpgnm,$rd_edtpgnm,$clspn_val;
global $id,$pg,$countstart;
$rd_crntpgnm = "view_all_members.php";
$rd_edtpgnm  = "edit_all_Members.php";
$clspn_val   = "4";
if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}
$sqryprodcat_mst="SELECT 
			mbrm_name,mbrm_emailid,mbrm_pwd,mbrm_mobile,mbrm_ipadrs, 
			if(mbrm_sts = 'a','Active','Inactive') as mbrm_sts
		from 
			mbr_mst
      where 
      mbrm_id=$id"; 
		$srsprodcat_mst  = mysqli_query($conn,$sqryprodcat_mst);
		$cntrecprodcat_mst = mysqli_num_rows($srsprodcat_mst);
		if($cntrecprodcat_mst  > 0){
			$rowsprodcat_mst = mysqli_fetch_assoc($srsprodcat_mst);
			$db_mbrname		 = $rowsprodcat_mst['mbrm_name'];
			$db_mbrid		 = ($rowsprodcat_mst['mbrm_emailid']);
      $db_mbrpwd		 = $rowsprodcat_mst['mbrm_pwd'];
      $db_mobil		 = $rowsprodcat_mst['mbrm_mobile'];
      $db_ipadrs		 = $rowsprodcat_mst['mbrm_ipadrs'];
			$db_mbrsts		 = $rowsprodcat_mst['mbrm_sts'];
		}
$loc= "&val=$srchval";
if($chk !='')
{
	$loc .="&chk=y";
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
	
?>
<script language="javascript">
	function update1() //for update download details
	{
		document.frmedtmbr.action="<?php echo $rd_edtpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";
		document.frmedtmbr.submit();
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
					<h1 class="m-0 text-dark">View Details Members</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Details Members</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtmbr" id="frmedtmbr" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedtmbr', rules, 'inline');">
		<input type="hidden" name="edtpdctid" value="<?php echo $id;?>">
		<input type="hidden" name="pg" value="<?php echo $pg;?>">
		<input type="hidden" name="cntstart" value="<?php echo $countstart?>">
		<input type="hidden" name="chkexact" id="chkexact" value="<?php echo $chk;?>">
		<input type="hidden" name="txtsrchval" id="txtsrchval" value="<?php echo $val;?>">
		<?php
		if($msg !='')
		{
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
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label"> Name</label>
							<div class="col-sm-8">
								<?php echo $db_mbrname;?>
							</div>
						</div>
            <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label"> Email ID </label>
							<div class="col-sm-8">
								<?php echo $db_mbrid;?>
							</div>
						</div>
            <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Mobile No</label>
							<div class="col-sm-8">
								<?php echo $db_mobil;?>
							</div>
						</div> 
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status </label>
							<div class="col-sm-8">
								<?php echo $db_mbrsts;?>
							</div>
						</div>
            <br>
            <div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label"><strong>Subscription Details :-</strong></label>
						</div>
            <div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
										<tr bgcolor="#FFFFFF">
											<td width="1%"  align="Left" ><strong>S.No.</strong></td>
											<td width="15%" align="center" ><strong>Subscription Amount</strong></td>
                      <td width="15%" align="center" ><strong>From Date</strong></td>
                      <td width="15%" align="center" ><strong>To Date</strong></td>
										</tr>
                    <?php
                      $sqrysubscrib_mst ="SELECT  mbrd_sbcr_id,mbrd_sbcr_mbrm_id,mbrd_sbcr_amt_id,mbrd_sbcr_paidon,mbrd_sbcr_endon
                    from  
										mbr_sbcr_dtl
										where 
										mbrd_sbcr_mbrm_id= $id";		
										$srssubscrib_mst = mysqli_query($conn, $sqrysubscrib_mst);
										$cnt_recs = mysqli_num_rows($srssubscrib_mst);
										$cnt = $offset;
										if ($cnt_recs > 0) {
										while ($srowsubscrib_mst = mysqli_fetch_assoc($srssubscrib_mst)) {
										
											// inner join subscrptn_amt_mst on subscrptn_amt_mst.subscrptnm_amt_id = mbr_sbcr_dtl.mbrd_sbcr_amt_id                   

											$cnt += 1;
											$pgval_srch	= $pgnum . $loc;
									 		$db_subamtid		= $srowsubscrib_mst['mbrd_sbcr_amt_id'];

											$db_amtpaidon		= $srowsubscrib_mst['mbrd_sbcr_paidon'];
											$db_amtendon		= $srowsubscrib_mst['mbrd_sbcr_endon'];
											$sqrysubscribamt_mst = "SELECT subscrptnm_amt_name,subscrptnm_amt_sts,subscrptnm_amt_id from subscrptn_amt_mst where subscrptnm_amt_id = '$db_subamtid'";
											$srsubscribamt_mst = mysqli_query($conn, $sqrysubscribamt_mst);
											while($subscrib_mst = mysqli_fetch_assoc($srsubscribamt_mst)){
												$db_subamt		= $subscrib_mst['subscrptnm_amt_name'];
									?> 
                        <tr <?php if ($cnt % 2 == 0) {
                          echo "";
                        } else {
                          echo "";
                        } ?>>
                        <td><?php echo $cnt; ?></td>
                        <td align="center"><?php echo $db_subamt;?></td>
                        <td align="center"><?php echo $db_amtpaidon; ?></td>
                        <td align="center"><?php echo $db_amtendon; ?></td>
                        </tr>
                    <?php
								}}
							} else {
								$msg = "<font color=red>No Records In Database</font>";
							}
							?>
									</table>
								</div>
						<p class="text-center">
							<!-- <input type="Submit" class="btn btn-primary btn-cst" name="frmedtmbr" id="frmedtmbr" value="Edit" 
						 onclick="update1()"> -->
						 &nbsp;&nbsp;&nbsp;
						 <!-- <input type="reset" class="btn btn-primary btn-cst" name="btnprodcatreset" value="Clear" id="btnprodcatreset">
						 &nbsp;&nbsp;&nbsp; -->
						 <input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst" onclick="location.href='<?php echo $rd_crntpgnm;?>'">
						</p>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
<?php include_once "../includes/inc_adm_footer.php";?>