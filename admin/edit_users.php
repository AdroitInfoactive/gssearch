<?php

error_reporting(0);
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***********************************************************
Programm : edit_main_category.php	
Package : 
Purpose : For Edit Main Category
Created By : Bharath
Created On : 20-01-2022
Modified By : 
Modified On : btneuserssbmtedtpdctid
Purpose : 
Company : Adroit
************************************************************/
//global $id,$pg,$$countstart;
global $id,$pg,$countstart,$loc,$rd_crntpgnm;
$rd_vwpgnm = "view_users.php";
$rd_crntpgnm="view_users.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "users";
$pagenm = "users";
/*****header link********/
if(isset($_POST['btneuserssbmt']) && (trim($_POST['btneuserssbmt']) != "") &&
isset($_REQUEST['edtpdctid']) && trim($_REQUEST['edtpdctid'])!="" && 
isset($_POST['txtname']) && (trim($_POST['txtname']) != ""))
{

	include_once "../includes/inc_fnct_fleupld.php";
	include_once "../database/uqry_users_mst.php";
}

if(isset($_REQUEST['edtpdctid']) && trim($_REQUEST['edtpdctid'])!="" && 
isset($_REQUEST['pg']) && trim($_REQUEST['pg'])!="" &&
 isset($_REQUEST['countstart']) && trim($_REQUEST['countstart'])!="")
 {
	// echo "here";exit;	
	
// 	$id = glb_func_chkvl($_REQUEST['edit']);
// 	$pg = glb_func_chkvl($_REQUEST['pg']);
// 	$$countstart = glb_func_chkvl($_REQUEST['$countstart']);
// 	$srchval = glb_func_chkvl($_REQUEST['val']);
// }
// elseif(isset($_REQUEST['edtpdctid']) && (trim($_REQUEST['edtpdctid'])!="") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage'])!="") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart'])!=""))
// {
	// $id = glb_func_chkvl($_REQUEST['edtpdctid']);
	// $pg = glb_func_chkvl($_REQUEST['hdnpage']);
	// $$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	//$chk = glb_func_chkvl($_REQUEST['chk']);
	   $id = glb_func_chkvl($_REQUEST['edtpdctid']); 
	  	$pg         = glb_func_chkvl($_REQUEST['pg']); 
		$countstart	= glb_func_chkvl($_REQUEST['countstart']);
		//echo "here".$countstart;exit;
		$optn 		= glb_func_chkvl($_REQUEST['optn']);
	    $val  		= glb_func_chkvl($_REQUEST['txtsrchval']); 
		$vltyp 		= glb_func_chkvl($_REQUEST['lsttyp']);
		$ctdstyp	= glb_func_chkvl($_REQUEST['lstdstyp']);
		$chk  		= glb_func_chkvl($_REQUEST['chkexact']); 
		
		// if($optn != "" && $val != ""){
		// $loc = "&optn=".$optn."&txtsrchval=".$val;	
		// if($chk == "y"){
		// 	$loc .= "&chkexact=".$chk;
		// }
		// }
		// if($optn != "" && $vltyp != ""){
		// 	$loc = "&optn=".$optn."&lsttyp=".$vltyp;	
		// }
		// if($optn != "" && $ctdstyp != ""){
		// 	$loc = "&optn=".$optn."&lstdstyp=".$ctdstyp;	
		// }

// $sqryprodmncat_mst="SELECT prodmn_catm_id, prodmn_catm_name, prodmn_catm_desc, prodmn_catm_smlimg, prodmn_catm_bnrimg, prodmn_catm_seotitle, prodmn_catm_seodesc, prodmn_catm_seokywrd, prodmn_catm_seohonetitle, prodmn_catm_seohonedesc, prodmn_catm_seohtwotitle, prodmn_catm_seohtwodesc, prodmn_catm_sts, prodmn_catm_prty, prodmn_catm_hmprty FROM prodmcat_mst WHERE prodmn_catm_id = $id";
// $srsprodmncat_mst  = mysqli_query($conn,$sqryprodmncat_mst);
// $rowsprodmncat_mst = mysqli_fetch_assoc($srsprodmncat_mst);
     $sqryprodcat_mst = "select 
     lgnm_uid,lgnm_pwd,lgnm_typ,
     lgnm_sts 
							from 
              lgn_mst
							where 
              lgnm_id='$id'"; 
		$srsprodcat_mst  = mysqli_query($conn,$sqryprodcat_mst);
		$cntrecprodcat_mst = mysqli_num_rows($srsprodcat_mst);
		if($cntrecprodcat_mst  > 0){
			$rowsprodcat_mst = mysqli_fetch_assoc($srsprodcat_mst);
			$db_usrname		 = $rowsprodcat_mst['lgnm_uid'];
      $db_usrpwd		 = $rowsprodcat_mst['lgnm_pwd'];
			$db_usrprty		 = $rowsprodcat_mst['lgnm_typ'];
			 $db_usrsts		 = $rowsprodcat_mst['lgnm_sts'];
		}
		else{
      // echo"here1";exit;
			header("Location:".$rd_vwpgnm);
			exit();
		}
 }
	// else{
	// 		header("location:".$rd_vwpgnm);
	// 		exit();
	// 	}


?>




<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
 	var rules=new Array();
   rules[0]='txtname:Name|required|Enter Username';
    	rules[1]='txtpwd:Password|required|Enter Password';
    	rules[2]='txtcnfpwd:Confirm Password|equal|$txtpwd|Passwords donot match';
    	rules[3]='txtcnfpwd:Password|required|Enter Confirm Password';
    	rules[4]='lststs:Store|required|Select Store';
    	rules[5]='txttyp:Type|required|Select Type';
	function setfocus()
	{
		document.getElementById('txtname').focus();
	}
</script>
<?php 
include_once ('script.php');
include_once ('../includes/inc_fnct_ajax_validation.php');	
?>
<script language="javascript" type="text/javascript">
	function funcChkDupName()
	{
		var name;
		name = document.getElementById('txtname').value;
		id 	 = <?php echo $id;?>;
		if((name != "") && (id != ""))
		{
			var url = "chkduplicate.php?usrnm="+name+"&usrid="+id;
			xmlHttp	= GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}	
	}
	function stateChanged()
	{ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{ 	
			var temp=xmlHttp.responseText;
    
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if(temp!=0)
			{
				document.getElementById('txtname').focus();
			}
		}
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
					<h1 class="m-0 text-dark">Edit Users<Link:mf></Link:mf></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Users</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtusers" id="frmedtusers" method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" onSubmit="return performCheck('frmedtusers', rules, 'inline');">
		<input type="hidden" name="edtpdctid" id="edtpdctid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdnval" value="<?php echo $srchval;?>">
		<input type="hidden" name="hdnchk" value="<?php echo $chk;?>">
		<input type="hidden" name="hdnloc" value="<?php echo $loc?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
	
		<!-- <input type="hidden" name="hdnsmlimg" value="<?php echo $rowsprodmncat_mst['prodmn_catm_smlimg'];?>">
		<input type="hidden" name="hdnbnrimg" value="<?php echo $rowsprodmncat_mst['prodmn_catm_bnrimg'];?>"> -->
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
        <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Type *</label>
							</div>
							<div class="col-sm-9">
								<select name="txttyp" type="text" id="txttyp"  class="form-control">
					                    <option value="" <?php if($db_usrprty =='') echo 'selected';?>>--Select--</option>
					                    <option value="u" <?php if($db_usrprty =='u') echo 'selected';?>>User</option>
					                    <option value="a" <?php if($db_usrprty =='a') echo 'selected';?>>Admin</option>
					                  </select>
								<span id="errorsDiv_txttyp"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Users *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" class="form-control" value="<?php echo $db_usrname;?>">
								<span id="errorsDiv_txtname"></span>
							</div>
						</div>
					</div>
          <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Password *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtpwd" type="password" id="txtpwd" size="45" maxlength="40"  class="form-control" value="<?php echo $db_usrpwd;?>">
								<span id="errorsDiv_txtpwd"></span>
							</div>
						</div>
					</div>
          <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Confirm Password *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtcnfpwd" type="password" id="txtcnfpwd" size="45" maxlength="40"  class="form-control" value="<?php echo $db_usrpwd;?>">
								<span id="errorsDiv_txtcnfpwd"></span>
							</div>
						</div>
					</div>
          <input name="hdnpwd" type="hidden" id="hdnpwd" value="<?php echo $rowsprodcat_mst['lgnm_pwd'];?>">	
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Status</label>
							</div>
							<div class="col-sm-9">
								<select name="lststs" id="lststs" class="form-control">
									<option value="a"<?php if($db_catsts=='a') echo 'selected';?>>Active</option>
									<option value="i"<?php if($db_catsts=='i') echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary btn-cst" name="btneuserssbmt" id="btneuserssbmt" value="Submit">
						&nbsp;&nbsp;&nbsp;
						<input type="reset" class="btn btn-primary btn-cst" name="btnprodcatreset" value="Clear" id="btnprodcatreset">
						&nbsp;&nbsp;&nbsp;
						<input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst" onclick="location.href='<?php echo $rd_vwpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$loc;?>'">
						
						
					</p>
				</div>
			</div>
		</div>
	</form>
</section>
<?php include_once "../includes/inc_adm_footer.php";?>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>