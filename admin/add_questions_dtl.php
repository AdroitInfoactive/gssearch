<?php
include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation

$pagemncat = "Setup";
$pagecat = "Product Group";
$pagenm = "Add Questions";
/*****header link********/
global $gmsg;

if (isset($_POST['btnquestionssbmt']) && (trim($_POST['btnquestionssbmt']) != "") && isset($_POST['lastexamnm']) && (trim($_POST['lastexamnm']) != "") && isset($_POST['lstyear']) && (trim($_POST['lstyear']) != "")) {
  $examid    	= glb_func_chkvl($_POST['lastexamnm']); 
  $yearid     	= glb_func_chkvl($_POST['lstyear']);
}

  $sqryexam_mst = "SELECT prodmnexmsm_name   from  prodmnexms_mst
  where 
   prodmnexmsm_id ='$examid'"; 
$srsprodexam_mst = mysqli_query($conn,$sqryexam_mst);
$rows_cnt = mysqli_num_rows($srsprodexam_mst);
if ($rows_cnt >0 ){
	$rowsexam_mst = mysqli_fetch_assoc($srsprodexam_mst);
  $db_mnexamnm = $rowsexam_mst['prodmnexmsm_name']; 
}

 $sqryyear_mst = "SELECT yearsm_name   from  years_mst
where 
 yearsm_id ='$yearid'"; 
$srsprodyear_mst = mysqli_query($conn,$sqryyear_mst);
$rows_cnt = mysqli_num_rows($srsprodyear_mst);
if ($rows_cnt >0 ){
$rowsyear_mst = mysqli_fetch_assoc($srsprodyear_mst);
$db_mnyearnm = $rowsyear_mst['yearsm_name']; 
}

?>
<script language="javaScript" type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">


	var rules = new Array();
	rules[0] = 'txtque:Question|required|Enter Question*';
	rules[1] = 'txtopt1:Option 1|required|Enter Option 1*';
	rules[2] = 'txtopt2:Option 2|required|Enter Option 2*';
	rules[3] = 'txtopt3:Option 3|required|Enter Option 3*';
	rules[4] = 'txtopt4:Option 4|required|Enter Option 4*';
	rules[5] = 'txtexplan:Explanation|required|Please fill Explanation field*';
	rules[6] = 'txtprty:Rank|required|Enter Rank';
	rules[7] = 'addcrtans:Correct Answer|required|Select Correct Answer';
	rules[8] = 'lst_topic: Topic|required|Select Topics*';
	// rules[9] = 'lst_subtopic: Sub Topic|required|Select SubTopics*';
	function setfocus() {
		document.getElementById('txtque').focus();
	}
	function add_ques(mod){  

				var code,size,prc;
				var typ='a';
				addnm = document.getElementById('txtaddnm').value;
				addprc = document.getElementById('txtaddprc').value;
				var dtlsparams ="addnm="+addnm+"&addprc="+addprc+"&actntyp="+typ+"&sno=";
				var prcurl ="getaddinvc_details.php";
				xmlHttp=GetXmlHttpObject(stchngcat_additem);
				xmlHttp.open("POST",prcurl,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.setRequestHeader("Content-length",dtlsparams.length);
				xmlHttp.setRequestHeader("Connection", "close");		
				xmlHttp.send(dtlsparams);
			}

</script>
<script>
	function get_admsn_dtls() {
		// var topicval = $("#lst_topic").val();
		var topicsname = document.getElementById('lst_topic').value;
		if (topicsname != "") {
      var url = "../includes/inc_getStsk.php?topicval=" + topicsname;
      xmlHttp = GetXmlHttpObject(stateChanged);
      xmlHttp.open("GET", url, true);
      xmlHttp.send(null);
    }
  }

  function stateChanged() {
		// debugger
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
      var temp = xmlHttp.responseText;
      if (temp != "") {
        document.getElementById('lst_subtopic').innerHTML = temp;
      }
    }
  }
</script>

<?php 
include_once('script.php');
include_once('../includes/inc_fnct_ajax_validation.php');
include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Add Questions Details</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Add Questions Details</li>
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
		 <h3 align="center" class= "text-danger">Adding Questions To <?php echo $db_mnexamnm." - ".$db_mnyearnm; ?></h3>
			<form name="frmaddprodcat" id="frmaddprodcat" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
				enctype="multipart/form-data" >
				<!-- onSubmit="return performCheck('frmaddprodcat', rules, 'inline');" -->
				<div class="col-md-12">
					<div class="row justify-content-center align-items-center">
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Question *</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtque" cols="60" rows="3" id="txtque" class="form-control"></textarea>
								<span id="errorsDiv_txtque"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>option 1 </label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtopt1" cols="60" rows="3" id="txtopt1" class="form-control"></textarea>
								<span id="errorsDiv_txtopt1"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>option 2 </label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtopt2" cols="60" rows="3" id="txtopt2" class="form-control"></textarea>
								<span id="errorsDiv_txtopt2"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>option 3 </label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtopt3" cols="60" rows="3" id="txtopt3" class="form-control"></textarea>
								<span id="errorsDiv_txtopt3"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>option 4 </label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtopt4" cols="60" rows="3" id="txtopt4" class="form-control"></textarea>
								<span id="errorsDiv_txtopt4"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Correct Answer*</label>
								</div>
								<div class="col-sm-9">
								<select name="addcrtans" id="addcrtans" class="form-control" onchange="disptype()">
								<option value="" selected>--Select Correct Option--</option>
								<option value="1">option 1</option>
								<option value="2">option 2</option>
								<option value="3">option 3</option>
								<option value="4">option 4</option>
							</select>
							<span id="errorsDiv_addcrtans"></span>
						</div>
					</div>
				</div>
				<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Explanation *</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtexplan" cols="60" rows="3" id="txtexplan" class="form-control"></textarea>
								<span id="errorsDiv_txtexplan"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Topics *</label>
								</div>
								<div class="col-sm-9">
									<?php
									$sqryprodmncat_mst = "SELECT 
									topicsm_id,topicsm_name						
								from 
									 topics_mst 
								where	 
									 topicsm_sts = 'a'
								 order by
									topicsm_name";
									$rsprodmncat_mst = mysqli_query($conn, $sqryprodmncat_mst);
									$cnt_prodmncat = mysqli_num_rows($rsprodmncat_mst);
									?>
									<select name="lst_topic" id="lst_topic" class="form-control" onchange="get_admsn_dtls();">
										<option value="">--Select Main Topics--</option>
										<?php
										if ($cnt_prodmncat > 0) {
											while ($rowsprodmncat_mst = mysqli_fetch_assoc($rsprodmncat_mst)) {
												$catid = $rowsprodmncat_mst['topicsm_id'];
												$catname = $rowsprodmncat_mst['topicsm_name'];
												?>
												<option value="<?php echo $catid; ?>"><?php echo $catname; ?></option>
												<?php
											}
										}
										?>
									</select>
									<span id="errorsDiv_lst_topic"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label> Sub Topic *</label>
                </div>
                <div class="col-sm-9">
                  <select name="lst_subtopic" id="lst_subtopic" class="form-control">
                  </select>
                  <span id="errorsDiv_lst_subtopic"></span>
                </div>
              </div>
            </div>
						<div id="admtyp" class="col-md-12">
						</div>
						<!-- <div id="admtyp" class="col-md-12">
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
						</div> -->

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
							<p class="text-center">
						<input name='' id='' type='button'class="btn btn-primary" value='ADD'  onClick="return performCheck('frmaddprodcat', rules, 'inline'), add_ques()" >
						&nbsp;&nbsp;&nbsp;
						</p>
						<br><br>
						</div>

						<p class="text-center">
							<input type="Submit" class="btn btn-primary" name="btnsubtopicssbmt" id="btnsubtopicssbmt" value="Submit">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="btn btn-primary" name="btnprodcatreset" value="Clear" id="btnprodcatreset">
							&nbsp;&nbsp;&nbsp;
							<input type="button" name="btnBack" value="Back" class="btn btn-primary"
								onClick="location.href='<?php echo $rd_crntpgnm;?>'">
						</p>
					</div>
				</div>
			</form>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</section>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtque');
	CKEDITOR.replace('txtopt1');
CKEDITOR.replace('txtopt2');
CKEDITOR.replace('txtopt3');
CKEDITOR.replace('txtopt4');
CKEDITOR.replace('txtexplan');
</script>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtopt1');
	// var editor = new FroalaEditor('#txtopt1');
</script>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtopt2');
	// var editor = new FroalaEditor('#txtopt2');
</script>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtopt3');
	// var editor = new FroalaEditor('#txtopt3');
</script>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtopt4');
	// var editor = new FroalaEditor('#txtopt4');
</script>
<script language="javascript" type="text/javascript">
	CKEDITOR.replace('txtexplan');
	// var editor = new FroalaEditor('#txtexplan');txtexplan
</script>

