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
$pagecat = "Product Group";
$pagenm = "users";
/*****header link********/
global $id,$pg,$cntstart,$msg,$loc,$rd_crntpgnm,$rd_edtpgnm,$clspn_val;
global $id,$pg,$countstart;
$rd_crntpgnm = "view_users.php";
$rd_edtpgnm = "edit_users.php";
$clspn_val = "4";
if(isset($_REQUEST['vw']) && (trim($_REQUEST['vw'])!="") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
{
	$id = glb_func_chkvl($_REQUEST['vw']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}
// $sqryprodmncat_mst="SELECT prodmn_catm_id, prodmn_catm_name, prodmn_catm_desc, prodmn_catm_smlimg, prodmn_catm_bnrimg, prodmn_catm_seotitle, prodmn_catm_seodesc, prodmn_catm_seokywrd, prodmn_catm_seohonetitle, prodmn_catm_seohonedesc, prodmn_catm_seohtwotitle, prodmn_catm_seohtwodesc, prodmn_catm_sts, prodmn_catm_prty, prodmn_catm_hmprty FROM prodmcat_mst WHERE prodmn_catm_id = $id";
// $srsprodmncat_mst = mysqli_query($conn,$sqryprodmncat_mst);
// $rowsprodmncat_mst = mysqli_fetch_assoc($srsprodmncat_mst);

$sqryprodcat_mst="SELECT *, if(lgnm_sts = 'a', 'Active','Inactive') as lgnm_sts, lgnm_typ FROM lgn_mst  WHERE lgnm_id=$id";

		$srsprodcat_mst  = mysqli_query($conn,$sqryprodcat_mst);
		$cntrecprodcat_mst = mysqli_num_rows($srsprodcat_mst);
		if($cntrecprodcat_mst  > 0){
			$rowsprodcat_mst = mysqli_fetch_assoc($srsprodcat_mst);
			$db_usrname		 = $rowsprodcat_mst['lgnm_uid'];
			$db_usrtyp		 = $rowsprodcat_mst['lgnm_typ'];
			$db_usrsts		 = $rowsprodcat_mst['lgnm_sts'];
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
    debugger
		document.frmedtusers.action="edit_users.php?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>";
		document.frmedtusers.submit();
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
					<h1 class="m-0 text-dark">View Users</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">View Users</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtusers" id="frmedtusers" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedtusers', rules, 'inline');">
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
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
							<div class="col-sm-8">
								<?php echo $db_usrname;?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Type</label>
							<div class="col-sm-8">
              <?php 
														if($db_usrtyp == "a")
														{
															echo "Admin";
														}
														if ($db_usrtyp == "u") {
															echo "user";
														}
														?>
							</div>
						</div>
						<div class="form-group row">
							<label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status </label>
							<div class="col-sm-8">
								<?php echo $db_usrsts;?>
							</div>
						</div>
						<p class="text-center">
							<input type="Submit" class="btn btn-primary btn-cst" name="frmedtusers" id="frmedtusers" value="Edit" 
						 onclick="update1()">
						 &nbsp;&nbsp;&nbsp;
						 <!-- <input type="reset" class="btn btn-primary btn-cst" name="btnprodcatreset" value="Clear" id="btnprodcatreset">
						 &nbsp;&nbsp;&nbsp; -->
						 <input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst" onclick="location.href='<?php echo $rd_crntpgnm;?>?<?php echo $loc;?>'">
						</p>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>
<?php include_once "../includes/inc_adm_footer.php";?>