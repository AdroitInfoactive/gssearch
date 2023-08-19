<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/**********************************************************
Programm : add_banner.php 
Purpose : For add Vehicle Brand Details
Created By : Bharath
Created On : 25-12-2021
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/
/*****header link********/
$pagemncat = "Executive Programs";
$pagecat = "Executive Sub Category";
$pagenm = "Executive Sub Category";
/*****header link********/
global $gmsg;
if (isset($_POST['btnexect_scatsbmt']) && (trim($_POST['btnexect_scatsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")) {
	include_once "../includes/inc_fnct_fleupld.php"; // For uploading files 
	include_once "../database/iqry_exect_scat_mst.php";
}
$rd_crntpgnm = "view_all_exect_scat.php";
$clspn_val = "4";
?>
<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
	var rules = new Array();
	rules[0] = 'txtname:Name|required|Enter Name';
	// rules[1]='txtname:Name|alphaspace|Name only characters and numbers';
	rules[1] = 'txtprior:Priority|required|Enter Rank';
	rules[2] = 'txtprior:Priority|numeric|Enter Only Numbers';
  rules[3] = 'lstexect_cat:catName|required|Enter Category Name ';
	// rules[3] = 'lstcat:Select|required|Select One';
	// rules[3] = 'txtalin:Alignment|required|Select The Text Alignment';
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
		
		var catid = document.getElementById('lstexect_cat').value;
		var name = document.getElementById('txtname').value;
		if (name != "" && catid != "") {
			var url = "chkduplicate.php?exect_scatname=" + name+ "&exect_scatcatid=" + catid;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		}
		else {
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
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Add Executive Sub Category Type</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Add Executive Sub Category Type</li>
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
		<div class="card-exect_scaty p-0">
			<form name="frmaddvehbrnd" id="frmaddvehbrnd" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
				enctype="multipart/form-data" onSubmit="return performCheck('frmaddvehbrnd', rules, 'inline');">
				<div class="col-md-12">
					<div class="row justify-content-center align-items-center">
          <div class="col-md-12">
            <div class="row mb-2 mt-2">
              <div class="col-sm-3">
                <label>Executive Category *</label>
              </div>
              <div class="col-sm-9">
                <?php
                $sqryprodmncat_mst = "SELECT 
                exect_catm_id,exect_catm_name
                from 
                exect_cat_mst 
                where
                exect_catm_sts = 'a'
                order by
                exect_catm_name";
                $rsprodmncat_mst = mysqli_query($conn, $sqryprodmncat_mst);
                $cnt_prodmncat = mysqli_num_rows($rsprodmncat_mst);
                ?>
                <select name="lstexect_cat" id="lstexect_cat" class="form-control" onchange="get_admsn_dtls();">
                <option value="">--Select Main Category--</option>
                <?php
                if ($cnt_prodmncat > 0) {
                  while ($rowsprodmncat_mst = mysqli_fetch_assoc($rsprodmncat_mst)) {
                    $catid = $rowsprodmncat_mst['exect_catm_id'];
                    $catname = $rowsprodmncat_mst['exect_catm_name']; 
                    ?>
                    <option value="<?php echo $catid; ?>"><?php echo $catname; ?></option>
                    <?php
                    }
                  }
                  ?>
                  </select>
                  <span id="errorsDiv_lstexect_cat"></span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Name *</label>
								</div>
								<div class="col-sm-9">
									<input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()"
										class="form-control">
									<span id="errorsDiv_txtname"></span>
								</div>
							</div>
						</div>
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
						<!-- <div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Image</label>
								</div>
								<div class="col-sm-9">
									<div class="custom-file">
										<input name="fledexect_scatimg" type="file" class="form-control" id="fledexect_scatimg" maxlength="250">
									</div>
								</div>
							</div>
						</div> -->
						<!-- <div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Mobile Image</label>
								</div>
								<div class="col-sm-9">
									<div class="custom-file">
										<input name="flemexect_scatimg" type="file" class="form-control" id="flemexect_scatimg" maxlength="250">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Link</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtlnk" id="txtlnk" size="45" maxlength="250" class="form-control">
								</div>
							</div>
						</div> -->
						<!-- <div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>TextAlign</label>
								</div>
								<div class="col-sm-9">
									<select name="txtalin" id="txtalin" class="form-control">
										<option value="L" selected>Left</option>
										<option value="R">Right</option>
										<option value="C">Center</option>
									</select>
								</div>
							</div>
						</div> -->
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Rank *</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="txtprior" id="txtprior" class="form-control" size="4" maxlength="3">
									<span id="errorsDiv_txtprior"></span>
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
						<p class="text-center">
							<input type="Submit" class="btn btn-primary" name="btnexect_scatsbmt" id="btnexect_scatsbmt" value="Submit">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary" name="btnexect_scatreset" value="Clear" id="btnexect_scatreset">
							&nbsp;&nbsp;&nbsp;
							<input type="button" name="btnBack" value="Back" class="btn btn-primary"
								onClick="location.href='<?php echo $rd_crntpgnm; ?>'">
						</p>
					</div>
				</div>
			</form>
		</div>
		<!-- /.card-exect_scaty -->
	</div>
	<!-- /.card -->
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtdesc');
</script>