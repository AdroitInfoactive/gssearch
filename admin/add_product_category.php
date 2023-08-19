<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***********************************************************
Programm : add_category.php	
Package : 
Purpose : For add category
Created By : Bharath
Created On :	20-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
 ************************************************************/
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Product Group";
$pagenm = "Category";
/*****header link********/
global $gmsg;
if (isset($_POST['btnprodcatsbmt']) && (trim($_POST['btnprodcatsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")) {
	include_once "../includes/inc_fnct_fleupld.php";
	include_once "../database/iqry_prodcat_mst.php";
}
$rd_crntpgnm = "view_product_category.php";
$clspn_val = "4";
?>
<!-- <link href="froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="froala-editor/js/froala_editor.pkgd.min.js"></script> -->
<script language="javaScript" type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
	var rules = new Array();
	rules[0] = 'lstprodcat:Category|required|Select Main Category';
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
		var name = document.getElementById('txtname').value;
		var ad_typ = document.getElementById('admtyp').value;

		var prodmcatid = document.getElementById('lstprodcat').value;
		if ((name != "") && (prodmcatid != "")) {
			var url = "chkduplicate.php?prodcatname=" + name + "&prodmcatid=" + prodmcatid;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		} else {
			document.getElementById('errorsDiv_lstprodcat').innerHTML = "";
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
		var slctdtyp = $("#lstprodcat").val();
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
		/********************Multiple Image Upload********************************/
		var nfiles=1;
		  function expand()
		  {
		  	nfiles++;
		  	var htmlTxt = '<?php
		  	echo "<table border=0 cellpadding=3 cellspacing=1 width=100%>";
		  	echo "<tr >";
		  	echo "<td colspan=3 height=2 bgcolor=#f0f0f0 valign=middle></td>";
		  	echo "</tr>";
		  	echo "<tr>";
		  	echo "<td colspan=3 height=4 valign=middle></td>";
		  	echo "</tr>";
		  	echo "</table><br>";
		  	echo "<table border=0 cellpadding=0 cellspacing=1 width=100%>";
		  	echo "<tr>";
		  	echo "<td align=center width=5%> ' + nfiles + '</td>";
		  	echo "<td align=center width=15%>";
		  	echo "<input type=text name=txtphtname' + nfiles + ' id=txtphtname' + nfiles + ' class=form-control size=15 placeholder=Name>";
		  	echo "</td>";
				echo "<td align=center width=15%>";
		  	echo "<input type=text name=txtphtcntnt' + nfiles + ' id=txtphtcntnt' + nfiles + ' class=form-control size=15 placeholder=Content>";
		  	echo "</td>";
		  	echo "<td align=center width=30%>";
		  	echo "<input type=file name=flesimg' + nfiles + ' id=flesimg' + nfiles + ' class=form-control><br>";
		  	echo "</td>";
		  
		  	echo "<td align=center width=10%>";
		  	echo "<input type=text name=txtphtprior' + nfiles + ' id=txtphtprior' + nfiles + ' class=form-control size=5 maxlength=3 placeholder=Priority>";
		  	echo "</td>";
		  	echo "<td align=center width=10%>";
		  	echo "<select name=lstphtsts' + nfiles + ' id=lstphtsts' + nfiles + ' class=form-control>";
		  	echo "<option value=a>Active</option>";
		  	echo "<option value=i>Inactive</option>";
		  	echo "</select>";
		  	echo "</td></tr></table><br>";
		  	?>';
		  	var Cntnt = document.getElementById ("myDiv");
		  	if (document.createRange)
		  	{
		  		//all browsers, except IE before version 9
		  		var rangeObj = document.createRange();
		  		Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
		  		document.frmaddprodcat.hdntotcntrl.value = nfiles;
		  		if (rangeObj.createContextualFragment)
		  		{
		  			// all browsers, except IE
		  			//var documentFragment = rangeObj.createContextualFragment (htmlTxt);
		  			//Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla
		  		}
		  		else
		  		{
		  			//Internet Explorer from version 9
		  			Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
		  		}
		  	}
		  	else
		  	{
		  		//Internet Explorer before version 9
		  		Cntnt.insertAdjacentHTML ("BeforeBegin", htmlTxt);
		  	}
		  	document.getElementById('hdntotcntrl').value = nfiles;
		  	//document.frmprod.hdntotcntrl.value = nfiles;
		  }
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Add Category</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Add Category</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- Default box -->
	<div class="card">
		<?php
		if ($gmsg != "") {
			echo "<center><div class='col-12'>
			<font face='Arial' size='2' color = 'red'>$gmsg</font>
			</div></center>";
		}
		if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) { ?>
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
		<div class="card-body p-0">
			<form name="frmaddprodcat" id="frmaddprodcat" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
				enctype="multipart/form-data" onSubmit="return performCheck('frmaddprodcat', rules, 'inline');">
				<div class="col-md-12">
					<div class="row justify-content-center align-items-center">
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Main Link *</label>
								</div>
								<div class="col-sm-9">
									<?php
									$sqryprodmncat_mst = "SELECT 
									prodmnlnksm_id,prodmnlnksm_name						
								from 
									 prodmnlnks_mst 
								where	 
									 prodmnlnksm_sts = 'a'
								 order by
									prodmnlnksm_name";
									$rsprodmncat_mst = mysqli_query($conn, $sqryprodmncat_mst);
									$cnt_prodmncat = mysqli_num_rows($rsprodmncat_mst);
									?>
									<select name="lstprodcat" id="lstprodcat" class="form-control" onchange="get_admsn_dtls();">
										<option value="">--Select Main Links--</option>
										<?php
										if ($cnt_prodmncat > 0) {
											while ($rowsprodmncat_mst = mysqli_fetch_assoc($rsprodmncat_mst)) {
												$catid = $rowsprodmncat_mst['prodmnlnksm_id'];
												$catname = $rowsprodmncat_mst['prodmnlnksm_name'];
												?>
												<option value="<?php echo $catid; ?>"><?php echo $catname; ?></option>
												<?php
											}
										}
										?>
									</select>
									<span id="errorsDiv_lstprodcat"></span>
								</div>
							</div>
						</div>
						<div id="admtyp" class="col-md-12">
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Category Name *</label>
								</div>
								<div class="col-sm-9">
									<input name="txtname" type="text" id="txtname" size="45" maxlength="40" class="form-control" onBlur="funcChkDupName()">
									
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
										<option value="b">Board of Directors</option>
										<option value="m">Ministry of Tourism</option>
										<?php
										$sqry_grd_mst = "SELECT grad_typm_id, grad_typm_name from grad_typ_mst where grad_typm_sts='a' order by grad_typm_prty asc";
										$rs_grd_mst = mysqli_query($conn, $sqry_grd_mst);
										$cnt_grd = mysqli_num_rows($rs_grd_mst);
										while ($rows_grd_mst = mysqli_fetch_assoc($rs_grd_mst))
										{
											$grad_typm_id = $rows_grd_mst['grad_typm_id'];
											$grad_typm_name = $rows_grd_mst['grad_typm_name'];
											?>
											<option value="g-<?php echo $grad_typm_id; ?>"><?php echo $grad_typm_name; ?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<!-- <div id="gnrtd_cntnt"></div> -->
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Description</label>
								</div>
								<div class="col-sm-9">
									<textarea name="txtdesc" cols="60" rows="3" id="txtdesc" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Banner Image</label>
								</div>
								<div class="col-sm-9">
									<div class="custom-file">
										<input name="flebnrimg" type="file" class="form-control" id="flebnrimg" maxlength="250">
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Icon </label>
								</div>
								<div class="col-sm-9">
									<div class="custom-file">
										<input name="icnimg" type="file" class="form-control" id="icnimg" maxlength="250">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Type</label>
								</div>
								<div class="col-sm-9">
									<select name="lstcattyp" id="lstcattyp" class="form-control">
										<option value="g" selected>General</option>
										<option value="d">Department</option>
										<option value="n">News</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Display Type</label>
								</div>
								<div class="col-sm-9">
									<select name="lstdsplytyp" id="lstdsplytyp" class="form-control">
										<option value="1">General</option>
										<option value="2">Tabular</option>
									</select>
								</div>
							</div>
						</div> -->
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO Title</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtseotitle" id="txtseotitle" size="45" maxlength="250" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO Description</label>
								</div>
								<div class="col-sm-9">
									<textarea name="txtseodesc" rows="3" cols="60" id="txtseodesc" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO Keyword</label>
								</div>
								<div class="col-sm-9">
									<textarea name="txtseokywrd" rows="3" cols="60" id="txtseokywrd" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO H1 Title</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtseoh1" id="txtseoh1" size="45" maxlength="250" class="form-control">
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>SEO H2 Title</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtseoh2" id="txtseoh2" size="45" maxlength="250" class="form-control">
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Rank *</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtprty" id="txtprty" class="form-control" size="4" maxlength="3">
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
										<option value="a" selected>Active</option>
										<option value="i">Inactive</option>
									</select>
								</div>
							</div>
						</div>
						<div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
										<tr bgcolor="#FFFFFF">
											<td width="1%"  align="Left" ><strong>S.No.</strong></td>
											<td width="15%" align="Left" ><strong>Name</strong></td>
											<td width="15%" align="Left" ><strong>content</strong></td>
											<td width="30%"  align="Left" ><strong>File</strong></td>
												<td width="10%"  align="center" ><strong>Priority</strong></td>
											<td width="10%"  align="center" ><strong>Status</strong></td>
										</tr>
									</table>
								</div>
								<div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered" >
										<table width="100%" border="0" cellspacing="3" cellpadding="3">
											<tr bgcolor="#FFFFFF">
												<td width="5%" align="center">1</td>
												<td width="15%"  align="center">
													<input type="text" name="txtphtname1" id="txtphtname1" placeholder="Name" class="form-control" size="15"><br>
													<span id="errorsDiv_txtphtname1" style="color:#FF0000"></span>
												</td>
												<td width="15%"  align="center">
													<input type="text" name="txtphtcntnt1" id="txtphtcntnt1" placeholder="content" class="form-control" size="15"><br>
													<span id="errorsDiv_txtphtcntnt1" style="color:#FF0000"></span>
												</td>
												<td width="30%"  align="center" >
													<input type="file" name="flesimg1" class="form-control" id="flesimg1"><br/>
													<span id="errorsDiv_flesimg1" style="color:#FF0000"></span>
												</td>
												<td width="10%"  align="center">
													<input type="text" name="txtphtprior1" id="txtphtprior1" class="form-control" placeholder="Priority" size="5" maxlength="3"><br>
													<span id="errorsDiv_txtphtprior1" style="color:#FF0000"></span>
												</td>
												<td width="10%" align="center" >					
													<select name="lstphtsts1" id="lstphtsts1" class="form-control">
														<option value="a" selected>Active</option>
														<option value="i">Inactive</option>
													</select>
												</td>
											</tr>
										</table>
									</table>
									<input type="hidden" name="hdntotcntrl" value="1">
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
							<input type="Submit" class="btn btn-primary" name="btnprodcatsbmt" id="btnprodcatsbmt" value="Submit">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary" name="btnprodcatreset" value="Clear" id="btnprodcatreset">
							&nbsp;&nbsp;&nbsp;
							<input type="button" name="btnBack" value="Back" class="btn btn-primary"
								onClick="location.href='<?php echo $rd_crntpgnm; ?>'">
						</p>
					</div>
				</div>
			</form>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
	// var editor = new FroalaEditor('#txtdesc');
</script>