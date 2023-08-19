<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***********************************************************
Programm : edit_product_category.php	
Package : 
Purpose : For Edit Vehicle Product Category
Created By : Bharath
Created On : 20-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
 ************************************************************/
global $id, $pg, $countstart;
$rd_vwpgnm = "view_detail_product_category.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Product Group";
$pagenm = "Category";
/*****header link********/
if (isset($_POST['btneprodcatsbmt']) && (trim($_POST['btneprodcatsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")) {
	include_once "../includes/inc_fnct_fleupld.php";
	include_once "../database/uqry_prodcat_mst.php";
}
if (isset($_REQUEST['edit']) && (trim($_REQUEST['edit']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$imgid      = glb_func_chkvl($_REQUEST['imgid']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
} elseif (isset($_REQUEST['hdnprodcatid']) && (trim($_REQUEST['hdnprodcatid']) != "") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage']) != "") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt']) != "")) {
	$id = glb_func_chkvl($_REQUEST['hdnprodcatid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}
$sqryprodcat_mst = "SELECT 
								prodcatm_name,prodcatm_desc,prodcatm_seotitle,prodcatm_seodesc,
								prodcatm_seohone,prodcatm_seohtwo,prodcatm_seokywrd,prodcatm_prty,
								 prodcatm_sts,
								prodcatm_typ,prodcatm_dsplytyp,prodcatm_bnrimg,prodcatm_prodmnlnksm_id,
								prodmnlnksm_name,prodmnlnksm_id,prodcatm_icn,prodcatm_admtyp,prodcatm_gnrtdfrm
							from 
								prodcat_mst
						inner join prodmnlnks_mst
						on		prodmnlnks_mst.prodmnlnksm_id=prodcat_mst.prodcatm_prodmnlnksm_id
							where 
								prodcatm_id='$id'";
$srsprodcat_mst = mysqli_query($conn, $sqryprodcat_mst);
$cntrecprodcat_mst = mysqli_num_rows($srsprodcat_mst);
if ($cntrecprodcat_mst > 0) {
	$rowsprodcat_mst = mysqli_fetch_assoc($srsprodcat_mst);
	$db_mnlnksid = $rowsprodcat_mst['prodmnlnksm_id'];
	$db_mnlnksnm = $rowsprodcat_mst['prodmnlnksm_name'];
	$db_catmnlnksid = $rowsprodcat_mst['prodcatm_prodmnlnksm_id'];
	$db_catname = $rowsprodcat_mst['prodcatm_name'];
	$db_catdesc = stripslashes($rowsprodcat_mst['prodcatm_desc']);
	$db_cattyp = $rowsprodcat_mst['prodcatm_typ'];
	$db_dsplytyp = $rowsprodcat_mst['prodcatm_dsplytyp'];
	$db_catseottl = $rowsprodcat_mst['prodcatm_seotitle'];
	$db_catseodesc = $rowsprodcat_mst['prodcatm_seodesc'];
	$db_catseokywrd = $rowsprodcat_mst['prodcatm_seokywrd'];
	$db_catseohone = $rowsprodcat_mst['prodcatm_seohone'];
	$db_catseohtwo = $rowsprodcat_mst['prodcatm_seohtwo'];
	$db_catprty = $rowsprodcat_mst['prodcatm_prty'];
	$db_catsts = $rowsprodcat_mst['prodcatm_sts'];
	$db_gnrtdfrm = $rowsprodcat_mst['prodcatm_gnrtdfrm'];
}
if(isset($_REQUEST['imgid']) && (trim($_REQUEST['imgid']) != "") && 	
isset($_REQUEST['edit']) && (trim($_REQUEST['edit']) != "") ){

$imgid      = glb_func_chkvl($_REQUEST['imgid']);
$pgdtlid    = glb_func_chkvl($_REQUEST['edit']);	   
$pg         = glb_func_chkvl($_REQUEST['pg']);
$cntstart   = glb_func_chkvl($_REQUEST['cntstart']);
$sqryprodmcatd_dtl="SELECT 
			prodmcatd_img
	 from 
	 prodmcat_dtl
	 where
			prodmcatd_Catm_id='$pgdtlid'  and
			prodmcatd_id = '$imgid'";				 				 				 				 			
$srsprodmcatd_dtl     = mysqli_query($conn,$sqryprodmcatd_dtl);
$srowprodmcatd_dtl    = mysqli_fetch_assoc($srsprodmcatd_dtl);		     			   				
$smlimg[$i]      = glb_func_chkvl($srowprodmcatd_dtl['prodmcatd_img']);
$smlimgpth[$i]   = $u_cat_bnrfldnm.$smlimg[$i];
$delimgsts = funcDelAllRec($conn,'prodmcat_dtl','prodmcatd_id',$imgid);
if($delimgsts == 'y'  ){
if(($smlimg[$i] != "") && file_exists($smlimgpth[$i]))
{
unlink($smlimgpth[$i]);
}			
}
}
?><?php
$loc = "&val=$srchval";
$pagetitle = "Edit Category";
?>
<!-- <link href="froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="froala-editor/js/froala_editor.pkgd.min.js"></script> -->
<script language="javaScript" type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
	var rules = new Array();
	rules[0] = 'lstcat:Category|required|Select Main Link';
	rules[1] = 'txtname:Name|required|Enter Category Name';
	rules[2] = 'txtprty:Priority|required|Enter Rank';
	rules[3] = 'txtprty:Priority|numeric|Enter Only Numbers';

	function setfocus() {
		document.getElementById('txtname').focus();
	}
</script>
<?php
include_once('script.php');
include_once('../includes/inc_fnct_ajax_validation.php');
?>
<script language="javascript" type="text/javascript">
	function funcChkDupName() {
		var name;
		name = document.getElementById('txtname').value;
		var prodmcatid = document.getElementById('lstcat').value;
		id = <?php echo $id; ?>;
		if (name != "" && prodmcatid != "" && id != "") {
			var url = "chkduplicate.php?prodcatname=" + name + "&prodmcatid=" + prodmcatid + "&prodcatid=" + id;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		} else {
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}
	}

	function stateChanged() {
		if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
			var temp = xmlHttp.responseText;
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if (temp != 0) {
				document.getElementById('txtname').focus();
			}
		}
	}
	function get_admsn_dtls() {
		var slctdtyp = $("#lstcat").val();
		$.ajax({
			type: "POST",
			url: "../includes/inc_getStsk.php",
			data: 'adm_typ=' + slctdtyp,
			success: function (data) {
				// alert(data)
				$("#admtyp").html(data);
			}
		});
	}
	function get_cntnt()
	{
		var gnrttyp = $("#lstcntnttyp").val();
		$.ajax({
			type: "POST",
			url: "../includes/inc_getStsk.php",
			data: 'gnrttyp=' + gnrttyp,
			success: function (data) {
				// alert(data)
				// $("#admtyp").html(data);
				// $("#txtdesc").val(data);
				// CKEDITOR.instances['txtdesc'].setData("")
				CKEDITOR.instances['txtdesc'].setData(data)
			}
		});
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
					<h1 class="m-0 text-dark">Edit Category</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Category</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtprodcatid" id="frmedtprodcatid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		enctype="multipart/form-data" onSubmit="return performCheck('frmedtprodcatid', rules, 'inline');">
		<input type="hidden" name="hdnprodcatid" value="<?php echo $id; ?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg; ?>">
		<input type="hidden" name="hdnval" value="<?php echo $srchval; ?>">
		<input type="hidden" name="hdnchk" value="<?php echo $chk; ?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart ?>">
		<input type="hidden" name="hdnbgimg" id="hdnbgimg" value="<?php echo $rowsprodcat_mst['prodcatm_bnrimg']; ?>">
		<input type="hidden" name="hdnsmlimg" id="hdnsmlimg" value="<?php echo $rowsprodscat_mst['prodcatm_icn']; ?>">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Main Links *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqryprodmncat_mst = "select 
								prodmnlnksm_id,prodmnlnksm_name						
							from 
								prodmnlnks_mst 
							where	 
								prodmnlnksm_sts = 'a'
							order by
							   prodmnlnksm_name";
								$srsprodcat_mst1 = mysqli_query($conn, $sqryprodmncat_mst);
								$cnt_prodmncat = mysqli_num_rows($srsprodcat_mst1);
								?>
								<select name="lstcat" id="lstcat" class="form-control" onchange="get_admsn_dtls();">
									<option value="">--Select Main Category--</option>
									<?php
									if ($cnt_prodmncat > 0) {
										while ($rowsprodmncat_mst = mysqli_fetch_assoc($srsprodcat_mst1)) {
											$mncatid = $rowsprodmncat_mst['prodmnlnksm_id'];
											$mncatname = $rowsprodmncat_mst['prodmnlnksm_name'];
											?>
											<option value="<?php echo $mncatid; ?>" <?php if ($db_catmnlnksid == $mncatid) echo 'selected'; ?>><?php echo $mncatname; ?></option>
											<?php
										}
									}
									?>
								</select>
								<span id="errorsDiv_lstcat"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Category Name *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()"
									class="form-control" value="<?php echo $db_catname; ?>">
								<span id="errorsDiv_txtname"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Generate Content</label>
							</div>
							<div class="col-sm-9">
								<select name="lstcntnttyp" id="lstcntnttyp" class="form-control" onchange="get_cntnt();">
									<option value="">--Generate from--</option>
									<option value="b" <?php if ($db_gnrtdfrm == "b") echo 'selected'; ?>>Board of Directors</option>
									<option value="m" <?php if ($db_gnrtdfrm == "m") echo 'selected'; ?>>Ministry of Tourism</option>
									<?php
									$db_gnrtdfrm_exp = explode("-", $db_gnrtdfrm);
									$db_gnrtdfrm = $db_gnrtdfrm_exp[1];
									$sqry_grd_mst = "SELECT grad_typm_id, grad_typm_name from grad_typ_mst where grad_typm_sts='a' order by grad_typm_prty asc";
									$rs_grd_mst = mysqli_query($conn, $sqry_grd_mst);
									$cnt_grd = mysqli_num_rows($rs_grd_mst);
									while ($rows_grd_mst = mysqli_fetch_assoc($rs_grd_mst)) {
										$grad_typm_id = $rows_grd_mst['grad_typm_id'];
										$grad_typm_name = $rows_grd_mst['grad_typm_name'];
										?>
										<option value="g-<?php echo $grad_typm_id; ?>"<?php if ($db_gnrtdfrm == $grad_typm_id)
												 echo 'selected'; ?>><?php echo $grad_typm_name; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtdesc" cols="60" rows="3" id="txtdesc"
									class="form-control"><?php echo $db_catdesc; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Baner Image</label>
							</div>
							<div class="col-sm-9">
								<div class="custom-file">
									<input name="flebnrimg" type="file" class="form-control" id="flebnrimg">
								</div>
								<?php
								$imgnm = $rowsprodcat_mst['prodcatm_bnrimg'];
								$imgpath = $a_cat_bnrfldnm . $imgnm;
								if (($imgnm != "") && file_exists($imgpath)) {
									echo "<img src='$imgpath' width='80pixel' height='80pixel'><br><input type='checkbox' name='chkbximg' id='chkbximg' value='$imgpath'>Remove Image";
								} else {
									echo "N.A.";
								}
								?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Title</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseotitle" id="txtseotitle" size="45" maxlength="250" class="form-control"
									value="<?php echo $db_catseottl; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Description</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseodesc" rows="3" cols="60" id="txtseodesc"
									class="form-control"><?php echo $db_catseodesc; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO Keyword</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtseokywrd" rows="3" cols="60" id="txtseokywrd"
									class="form-control"><?php echo $db_catseokywrd; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H1 </label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh1" id="txtseoh1" size="45" maxlength="250" class="form-control"
									value="<?php echo $db_catseohone; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>SEO H2 </label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtseoh2" id="txtseoh2" size="45" maxlength="250" class="form-control"
									value="<?php echo $db_catseohtwo; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9">
								<input type="text" name="txtprty" id="txtprty" class="form-control" size="4" maxlength="3"
									value="<?php echo $db_catprty; ?>">
								<span id="errorsDiv_txtprty"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Status</label>
							</div>
							<div class="col-sm-9">
								<select name="lststs" id="lststs" class="form-control">
									<option value="a" <?php if ($db_catsts == 'a')
										echo 'selected'; ?>>Active</option>
									<option value="i" <?php if ($db_catsts == 'i')
										echo 'selected'; ?>>Inactive</option>
								</select>
							</div>
						</div>
					</div>

					<div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
										<tr bgcolor="#FFFFFF">
											<td width="1%"  align="center" ><strong>S.No.</strong></td>
											<td width="10%" align="center" ><strong>Name</strong></td>
											<td width="10%" align="center" ><strong>Content</strong></td>
											<td width="35%"  align="center" ><strong>File</strong></td>
											<td width="10%"  align="center" ><strong>Priority</strong></td>
											<td width="10%"  align="center" ><strong>Status</strong></td>
											<td width="10%"  align="center" ><strong>Remove</strong></td>
										</tr>
									</table>
								</div> 
								<?php
							$sqryimg_dtl="SELECT  prodmcatd_id,prodmcatd_name,prodmcatd_cntnt,prodmcatd_cntnt,prodmcatd_catm_id,prodmcatd_Fle,prodmcatd_prty,prodmcatd_sts
							 from
							 prodmcat_dtl
							 where 
							 prodmcatd_catm_id ='$id' 
							 order by 
							 prodmcatd_id"; 
							 $srsimg_dtl	= mysqli_query($conn,$sqryimg_dtl); 	
							 $cntprodmcat_dtl  = mysqli_num_rows($srsimg_dtl);
							 $nfiles = "";
							 if($cntprodmcat_dtl> 0 ){
								?>
								<?php				
								while($rowsprodmcatd_mdtl=mysqli_fetch_assoc($srsimg_dtl)){				
									$prodmcatdid 	  = $rowsprodmcatd_mdtl['prodmcatd_id'];
									$db_prodmcatnm   = $rowsprodmcatd_mdtl['prodmcatd_name'];
									// $arytitle     = explode("-",$db_prodmcatnm);
									$db_evntcntnt  = $rowsprodmcatd_mdtl['prodmcatd_cntnt'];
									$db_prodmcatfle  = $rowsprodmcatd_mdtl['prodmcatd_Fle']; 
									$db_prodmcatprty = $rowsprodmcatd_mdtl['prodmcatd_prty'];
									$db_prodmcatsts  = $rowsprodmcatd_mdtl['prodmcatd_sts'];
									$flenm = $db_prodmcatfle;					
									$flepath = $a_cat_bnrfldnm.$flenm; 
									$nfiles+=1;
									$clrnm = "";
									if($cnt%2==0){
										$clrnm = "bgcolor='#f1f6fd'";
									}
									else{
										$clrnm = "bgcolor='#f1f6fd'";
									}
									?>
									<div class="table-responsive">
										<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered" >
											<table width="100%" border="0" cellspacing="3" cellpadding="3">
												<tr bgcolor="#FFFFFF">
													<input type="hidden" name="hdnpgdid<?php echo $nfiles?>" class="select" value="<?php echo $prodmcatdid;?>">
													<td width='5%'><?php echo  $nfiles;?></td>
													<td width="10%"  align="center">
														<input type="text" name="txtphtname<?php echo $nfiles?>" id="txtphtname<?php echo $nfiles?>" placeholder="Name" class="form-control" size="15" value='<?php echo $db_prodmcatnm?>'><br>
														<span id="errorsDiv_txtphtname" style="color:#FF0000"></span>
													</td>
													<td width="10%"  align="center">
														<input type="text" name="txtphtcntnt<?php echo $nfiles?>" id="txtphtcntnt<?php echo $nfiles?>" placeholder="Content" class="form-control" size="15" value='<?php echo  $db_evntcntnt?>'><br>
														<span id="errorsDiv_txtphtcntnt" style="color:#FF0000"></span>
													</td>
													<td width="35%"  align="center" >
														<input type="file" name="flesmlimg<?php echo $nfiles?>"class="form-control" id="flesmlimg" ><br/>
													</td>
													<td bgcolor="#f1f6fd"  align="left" width='10%'>
														<?php						   
														if($flenm !=""){ 
															echo "<a href='$flepath' target='_blank'> View</a>";
														}
														else{
															echo "No File";
														}
														?>
														<span id="errorsDiv_flesmlimg" style="color:#FF0000"></span>
													</td>
													<td width="10%"  align="center">
														<input type="text" name="txtphtprior<?php echo $nfiles?>" id="txtphtprior" class="form-control" value="<?php echo $db_prodmcatprty;?>" size="4" maxlength="3">
														<br>
														<span id="errorsDiv_txtphtprior" style="color:#FF0000"></span>
													</td>
													<td width="10%" align="center" >
														<select name="lstphtsts<?php echo $nfiles?>" id="lstphtsts<?php echo $nfiles?>" class="form-control">
														<option value="a" <?php if($db_prodmcatsts =='a') echo 'selected'; ?>>Active</option>
														<option value="i" <?php if($db_prodmcatsts =='i') echo 'selected'; ?>>Inactive</option>
													</select>
												</td>
												<td width='10%' align="center">
												<input type="button"  name="btnrmv"  value="REMOVE"  onclick="rmvimg('<?php echo $prodmcatdid; ?>')"></td>
												</tr>
												<?php
												}
											}
											else{
												echo "<tr bgcolor='#FFFFFF'><td colspan='7' align='center' bgcolor='#f1f6fd'>File not available</td></tr>";
											}
											?>
											</table>
										</table>
										<input type="hidden" name="hdntotcntrl" value="<?php echo $nfiles;?>">
										<div id="myDiv">
											<table width="100%" cellspacing='2' cellpadding='3'>
												<tr>
													<td align="center">
														<input name="btnadd" type="button" onClick="expand()" value="Add Another Row" class="btn btn-primary mb-3">
													</td>
												</tr>
											</table>
										</div>
									</div>
									<p class="text-center">
										<input type="Submit" class="btn btn-primary btn-cst" name="btneprodcatsbmt" id="btneprodcatsbmt"
										value="Submit">
										&nbsp;&nbsp;&nbsp;
										<input type="reset" class="btn btn-primary btn-cst" name="btnprodcatreset" value="Clear"
										id="btnprodcatreset">
										&nbsp;&nbsp;&nbsp;
										<input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst"
										onclick="location.href='<?php echo $rd_vwpgnm; ?>?vw=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>'">
									</p>
								</div>
							</div>
						</div>
					</form>
				</section>
				<?php include_once "../includes/inc_adm_footer.php"; ?>
				<script language="javascript" type="text/javascript">
					var nfiles ="<?php echo $nfiles;?>";
	   function expand () {	   		
			nfiles ++;
			var htmlTxt = '<?php
					echo "<table width=100%  border=0 cellspacing=1 cellpadding=1 >"; 
					echo "<tr>";
					echo "<td align=left width=5%>";
					echo "<span class=buylinks> ' + nfiles + '</span></td>";
					echo "<td  width=27% >";
					echo "<input type=text name=txtphtname' + nfiles + ' id=txtphtname' + nfiles + ' class=form-control size=10><br>";
					echo "<td  width=27% >";
					echo "<input type=text name=txtphtcntnt' + nfiles + ' id=txtphtcntnt' + nfiles + ' class=form-control size=10><br>";
					echo "<td align=left width=30% colspan=2>";
					echo "<input type=file name=flesmlimg' + nfiles + ' id=flesmlimg' + nfiles + ' class=form-control><br>";
					echo "<td align=center width=20%>";
					echo "<input type=text name=txtphtprior' + nfiles + ' id=txtphtprior' + nfiles + ' class=form-control size=4 maxlength=3>";
					echo "</td>"; 
					echo "<td  width=20% align=right colspan=2>";
					echo "<select name=lstphtsts' + nfiles + ' id=lstphtsts' + nfiles + ' class=form-control>";
					echo "<option value=a>Active</option>";
					echo "<option value=i>Inactive</option>";
					echo "</select>";
					echo "</td></tr></table><br>";			
				?>';			
            var Cntnt = document.getElementById ("myDiv");			
			if (document.createRange) {//all browsers, except IE before version 9 				
			 var rangeObj = document.createRange ();
			 	Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
				document.frmedtprodcatid.hdntotcntrl.value = nfiles;	
               if (rangeObj.createContextualFragment) { // all browsers, except IE	
			   		 	//var documentFragment = rangeObj.createContextualFragment (htmlTxt);
                 	 	//Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla						 				
				}
                else{//Internet Explorer from version 9
                 	Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
				}
			}			
			else{//Internet Explorer before version 9
                Cntnt.insertAdjacentHTML ("BeforeBegin", htmlTxt);
			}
			document.frmedtprodcatid.hdntotcntrl.value = nfiles;
        }	
	
				function rmvimg(imgid){
			var img_id;
			img_id = imgid;
			if(img_id !=''){
				var r=window.confirm("Do You Want to Remove ");
				if (r==true){						
					 x="You pressed OK!";
				  }
				else
				  {
					  return false;
				  }	
        	}
			document.frmedtprodcatid.action="edit_product_category.php?edit=<?php echo $id;?>&imgid="+img_id+"&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>" 
			document.frmedtprodcatid.submit();	
		}
					CKEDITOR.replace('txtdesc');
					// var editor = new FroalaEditor('#txtdesc');
					</script>