<?php
error_reporting(0);
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once "../includes/inc_adm_session.php"; //checking for session
include_once "../includes/inc_connection.php"; //Making database Connection
include_once "../includes/inc_usr_functions.php"; //checking for session
include_once '../includes/inc_config.php';       //Making paging validation
include_once '../includes/inc_folder_path.php'; //Floder Path	
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
$pagemncat = "Questions";
$pagecat = "";
$pagenm = "Questions";
/*****header link********/
global $gmsg;
if (isset($_POST['btnquestionssbmt']) && (trim($_POST['btnquestionssbmt']) != "") && isset($_POST['lastexamnm']) && (trim($_POST['lastexamnm']) != "") && isset($_POST['lstyear']) && (trim($_POST['lstyear']) != "")) 
{

	include_once "../includes/inc_fnct_fleupld.php"; // For uploading files 
	include_once "../database/iqry_addques_mst.php";

}
$rd_crntpgnm = "view_questions.php";

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
	rules[10] = 'lastexamnm:Category|required|Select Exam';
  rules[14] = 'lstyear:Category|required|Select  years';
	rules[11] = 'txtque:Name|required|Enter Sub years';
	// rules[12] = 'txtprty:Priority|required|Enter Rank';
	// rules[13] = 'txtprty:Priority|numeric|Enter Only Numbers';

	rules[0] = 'txtque:Question|required|Enter Question*';
	rules[1] = 'txtopt1:Option 1|required|Enter Option 1*';
	rules[2] = 'txtopt2:Option 2|required|Enter Option 2*';
	rules[3] = 'txtopt3:Option 3|required|Enter Option 3*';
	rules[4] = 'txtopt4:Option 4|required|Enter Option 4*';
	// rules[5] = 'txtexplan:Explanation|required|Please fill Explanation field*';
	rules[6] = 'txtprty:Rank|required|Enter Rank';
	rules[7] = 'addcrtans:Correct Answer|required|Select Correct Answer';
	rules[8] = 'lst_topic: Topic|required|Select Topics*';
	// rules[9] = 'lst_subtopic: Sub Topic|required|Select SubTopics*';


	function setfocus() {
		document.getElementById('txtque').focus();
	}
</script>
<?php
include_once('script.php');
include_once('../includes/inc_fnct_ajax_validation.php');
?>
<script language="javascript" type="text/javascript">
	function funcChkDupName()
	{
		// var name = document.getElementById('txtque').value;//name for sub category
		var name = encodeURI(CKEDITOR.instances.txtque.getData());
		var exammnid = document.getElementById('lastexamnm').value;//maincat link id
		var exmsctid = document.getElementById('lst_exmsubcat').value;//year id
		var exmtypid = document.getElementById('lst_exmtype').value;//year id
		var yearmnid = document.getElementById('lstyear').value;//year id
		if(name != "")
		{
			var url = "chkduplicate.php?addquesname="+name+"&exammnid="+exammnid+"&yearmnid="+yearmnid+"&exmsctid="+exmsctid+"&exmtypid="+exmtypid;
			xmlHttp	= GetXmlHttpObject(stateChanged1);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		}
		else
		{
			document.getElementById('errorsDiv_lstyear').innerHTML="";
			document.getElementById('errorsDiv_lastexamnm').innerHTML="";
			document.getElementById('errorsDiv_txtque').innerHTML = "";
		}	
	}
	function stateChanged1()
	{ 	
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{
			var temp=xmlHttp.responseText;		
			document.getElementById("errorsDiv_txtque").innerHTML = temp;
			if(temp!=0)
			{
				document.getElementById('txtque').focus();
			}
		}
	}

	function funcscat() {
		// var topicval = $("#lst_topic").val();
		var lastexamnm = document.getElementById('lastexamnm').value;
		if (lastexamnm != "") {
      var url = "../includes/inc_getStsk.php?lastexamnm=" + lastexamnm;
      xmlHttp = GetXmlHttpObject(scatchnge);
      xmlHttp.open("GET", url, true);
      xmlHttp.send(null);
    }
  }
	
  function scatchnge() {
		// debugger
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
      var temp = xmlHttp.responseText;
      if (temp != "") {
        document.getElementById('lst_exmsubcat').innerHTML = temp;
      }
    }
  }

	

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
<?php include_once $inc_adm_hdr; ?>
<section class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Add Questions</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Add Questions</li>
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
									<label>Exams Category *</label>
								</div>
								<div class="col-sm-9">
									<?php
									$sqryprodmncat_mst = "SELECT 
									prodmnexmsm_id,prodmnexmsm_name						
								from 
									 prodmnexms_mst 
								where	 
									 prodmnexmsm_sts = 'a'
								 order by
									prodmnexmsm_name";
									$rsprodmncat_mst = mysqli_query($conn, $sqryprodmncat_mst);
									$cnt_prodmncat = mysqli_num_rows($rsprodmncat_mst);
									?>
									<select name="lastexamnm" id="lastexamnm" class="form-control" onchange="funcscat()">
										<option value="">--Select Exam Category--</option>
										<?php
										if ($cnt_prodmncat > 0) {
											while ($rowsprodmncat_mst = mysqli_fetch_assoc($rsprodmncat_mst)) {
												$catid = $rowsprodmncat_mst['prodmnexmsm_id'];
												$catname = $rowsprodmncat_mst['prodmnexmsm_name'];
												?>
												<option value="<?php echo $catid; ?>"><?php echo $catname; ?></option>
												<?php
											}
										}
										?>
									</select>
									<span id="errorsDiv_lastexamnm"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label> Exam Subcategory *</label>
                </div>
                <div class="col-sm-9">
                  <select name="lst_exmsubcat" id="lst_exmsubcat" class="form-control" onchange="funcexmtype()" >
                  </select>
                  <span id="errorsDiv_lst_exmsubcat"></span>
                </div>
              </div>
            </div>
						<div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label> Exam Type * </label>
                </div>
                <div class="col-sm-9">
								<?php
									$sqryexmtyp_mst = "SELECT 
									exam_id,exam_name						
								from 
								exam_typ 
								where	 
								exam_sts = 'a'
								 order by
								 exam_name";
									$rsexmcat_mst = mysqli_query($conn, $sqryexmtyp_mst);
									$cnt_exmtyp = mysqli_num_rows($rsexmcat_mst);
									?>
                  <select name="lst_exmtype" id="lst_exmtype" class="form-control"  >
                	<option value="">--Select Exam Type --</option>
										<?php
										if ($cnt_exmtyp > 0) {
											while ($rowexmtype_mst = mysqli_fetch_assoc($rsexmcat_mst)) {
												$exmid = $rowexmtype_mst['exam_id'];
												$exmname = $rowexmtype_mst['exam_name'];
												?>
												<option value="<?php echo $exmid; ?>"><?php echo $exmname; ?></option>
												<?php
											}
										}
										?>  
								</select>
                  <span id="errorsDiv_lst_exmtype"></span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Years *</label>
								</div>
								<div class="col-sm-9">
									<?php
									$sqryprodmncat_mst = "SELECT 
									yearsm_id,yearsm_name						
								from 
									 years_mst 
								where	 
									 yearsm_sts = 'a'
								 order by
									yearsm_name desc";
									$rsprodmncat_mst = mysqli_query($conn, $sqryprodmncat_mst);
									$cnt_prodmncat = mysqli_num_rows($rsprodmncat_mst);
									?>
									<select name="lstyear" id="lstyear" class="form-control" onchange="funcChkDupName()">
										<option value="">--Select Year--</option>
										<?php
										if ($cnt_prodmncat > 0) {
											while ($rowsprodmncat_mst = mysqli_fetch_assoc($rsprodmncat_mst)) {
												$catid = $rowsprodmncat_mst['yearsm_id'];
												$catname = $rowsprodmncat_mst['yearsm_name'];
												?>
												<option value="<?php echo $catid; ?>"><?php echo $catname; ?></option>
												<?php
											}
										}
										?>
									</select>
									<span id="errorsDiv_lstyear"></span>
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
                  <label> Sub Topic </label>
                </div>
                <div class="col-sm-9">
                  <select name="lst_subtopic" id="lst_subtopic" class="form-control" >
                  </select>
                  <span id="errorsDiv_lst_subtopic"></span>
                </div>
              </div>
            </div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Tags</label>
								</div>
								<div class="col-sm-9">
									<textarea name="txttag" id="txttag" rows="3" cols="60" id="txtseodesc" class="form-control"></textarea>
								</div>
							</div>
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
							<input type="Submit" class="btn btn-primary" name="btnquestionssbmt" id="btnquestionssbmt" value="Submit">
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
	// CKEDITOR.replace('txtdesc');
	CKEDITOR.replace('txtque');
	CKEDITOR.replace('txtopt1');
CKEDITOR.replace('txtopt2');
CKEDITOR.replace('txtopt3');
CKEDITOR.replace('txtopt4');
CKEDITOR.replace('txtexplan');
</script>