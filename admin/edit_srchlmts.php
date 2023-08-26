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
Modified On : btnesrchlmtssbmtedtpdctid
Purpose : 
Company : Adroit
************************************************************/
//global $id,$pg,$$countstart;
global $id,$pg,$countstart,$loc,$rd_crntpgnm;
$rd_vwpgnm = "view_srchlmts.php";
$rd_crntpgnm="view_srchlmts.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Product Group";
$pagenm = "Search";
/*****header link********/
if(
isset($_POST['btnesrchlmtssbmt']) && (trim($_POST['btnesrchlmtssbmt']) != "") &&
isset($_POST['edtpdctid']) && (trim($_POST['edtpdctid']) != "") && 
isset($_POST['txtprty']) && (trim($_POST['txtprty']) != ""))
{
  
	include_once "../includes/inc_fnct_fleupld.php";
	include_once "../database/uqry_srchlmts_mst.php";
  
}

if(isset($_REQUEST['edtpdctid']) && trim($_REQUEST['edtpdctid'])!="" && 
isset($_REQUEST['pg']) && trim($_REQUEST['pg'])!="" &&
 isset($_REQUEST['countstart']) && trim($_REQUEST['countstart'])!="")
 {
   
	
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
		
	
  $sqryprodcat_mst = "select 
								srchlmt_name,srchlmt_count,srchlmt_prty,
								srchlmt_sts 
							from 
								srchlmts_mst
							where 
								srchlmt_id='$id'"; 
                                // echo "here";exit;
		$srsprodcat_mst  = mysqli_query($conn,$sqryprodcat_mst);
		$cntrecprodcat_mst = mysqli_num_rows($srsprodcat_mst);
		if($cntrecprodcat_mst  > 0){
			$rowsprodcat_mst = mysqli_fetch_assoc($srsprodcat_mst);
			$db_catname		 = $rowsprodcat_mst['srchlmt_name'];
			$db_catdesc		 = stripslashes($rowsprodcat_mst['srchlmt_count']);
		
			$db_catprty		 = $rowsprodcat_mst['srchlmt_prty'];
			 $db_catsts		 = $rowsprodcat_mst['srchlmt_sts'];
		}
		else{
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
 	rules[0]='txtname:Name|required|Enter Main Link Name';
 	rules[1]='txtprty:Priority|required|Enter Rank';
	rules[2]='txtprty:Priority|numeric|Enter Only Numbers';
    rules[3]='txtcount:Priority|numeric|Enter Only Numbers';
    rules[4]='txtcount:Priority|required|Enter Search Limitation Count';
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
			var url = "chkduplicate.php?srchlmtsname="+name+"&prodmncatid="+id;
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
					<h1 class="m-0 text-dark">Edit Search Limitations <Link:mf></Link:mf></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Search Limitations</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtsrchlmts" id="frmedtsrchlmts" method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" onSubmit="return performCheck('frmedtsrchlmts', rules, 'inline');">
		<input type="hidden" name="edtpdctid" value="<?php echo $id;?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		<input type="hidden" name="hdnval" value="<?php echo $srchval;?>">
		<input type="hidden" name="hdnchk" value="<?php echo $chk;?>">
		<input type="hidden" name="hdnloc" value="<?php echo $loc?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart?>">		
	
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Name *</label>
							</div>
							<div class="col-sm-9">
								<input name="txtname" disabled type="text" id="txtname" size="45" maxlength="40" class="form-control" value="<?php echo $db_catname;?>">
								<span id="errorsDiv_txtname"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Count *</label>
							</div>
							<div class="col-sm-9"> 
                            <input name="txtcount" type="text" id="txtcount" size="45" maxlength="40"  class="form-control" value="<?php echo $db_catdesc;?>">
                            <span id="errorsDiv_txtcount"></span>
								
							</div>
						</div>
					</div>

					
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Rank *</label>
							</div>
							<div class="col-sm-9"> 
								<input type="text" name="txtprty" id="txtprty" class="form-control" size="4" maxlength="3" value="<?php echo $db_catprty;?>">
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
									<option value="a"<?php if($db_catsts=='a') echo 'selected';?>>Active</option>
									<option value="i"<?php if($db_catsts=='i') echo 'selected';?>>Inactive</option>
								</select>
							</div>
						</div>
					</div>
					<p class="text-center">
						<input type="Submit" class="btn btn-primary btn-cst" name="btnesrchlmtssbmt" id="btnesrchlmtssbmt" value="Submit">
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
	// CKEDITOR.replace('txtcount');
</script>