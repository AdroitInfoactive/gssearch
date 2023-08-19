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
$rd_vwpgnm = "view_detail_questions.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "Product Group";
$pagenm = "addques";
/*****header link********/
if (isset($_POST['btneaddquessbmt']) && (trim($_POST['btneaddquessbmt']) != "") && isset($_POST['txtque']) && (trim($_POST['txtque']) != "") && isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")) {
	include_once "../includes/inc_fnct_fleupld.php";
	include_once "../database/uqry_addques_mst.php";
}
if (isset($_REQUEST['edit']) && (trim($_REQUEST['edit']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
	$id = glb_func_chkvl($_REQUEST['edit']);
	$pg = glb_func_chkvl($_REQUEST['pg']);
	$imgid      = glb_func_chkvl($_REQUEST['imgid']);
	$countstart = glb_func_chkvl($_REQUEST['countstart']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
} elseif (isset($_REQUEST['hdnaddquesid']) && (trim($_REQUEST['hdnaddquesid']) != "") && isset($_REQUEST['hdnpage']) && (trim($_REQUEST['hdnpage']) != "") && isset($_REQUEST['hdncnt']) && (trim($_REQUEST['hdncnt']) != "")) {
	$id = glb_func_chkvl($_REQUEST['hdnaddquesid']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$srchval = glb_func_chkvl($_REQUEST['val']);
	$chk = glb_func_chkvl($_REQUEST['chk']);
}
echo  $sqryaddques_mst = "SELECT addquesm_qnm,addquesm_optn1,addquesm_optn2,addquesm_optn3,addquesm_optn4,addquesm_crtans,addquesm_expln,addquesm_prty, addquesm_sts, addquesm_prodmnexmsm_id, prodmnexmsm_name,addquesm_yearsm_id,yearsm_name,addquesm_topicsm_id,topicsm_name,addquesm_subtopicsm_id,subtopicsm_name from
 addques_mst 
inner join prodmnexms_mst on prodmnexms_mst.prodmnexmsm_id=addques_mst.addquesm_prodmnexmsm_id 
inner join 	years_mst on years_mst.yearsm_id=addques_mst.addquesm_yearsm_id
inner join 	topics_mst on	topics_mst.topicsm_id=addques_mst.addquesm_topicsm_id
left join 	subtopics_mst on subtopics_mst.subtopicsm_id=addques_mst.addquesm_subtopicsm_id
where addquesm_id='$id'" ;
$srsaddques_mst = mysqli_query($conn, $sqryaddques_mst);
$cntrecaddques_mst = mysqli_num_rows($srsaddques_mst);
if ($cntrecaddques_mst > 0) {
	$rowsaddques_mst = mysqli_fetch_assoc($srsaddques_mst);
	$db_mnlnksid = $rowsaddques_mst['prodmnexmsm_id'];
	$db_mnlnksnm = $rowsaddques_mst['prodmnexmsm_name'];
	$db_catmnlnksid = $rowsaddques_mst['addquesm_prodmnexmsm_id'];
  $db_yearid = $rowsaddques_mst['addquesm_yearsm_id'];
  $db_yearsmid = $rowsaddques_mst['yearsm_name'];
	$db_catname = $rowsaddques_mst['addquesm_name'];
	$db_qnmdesc = stripslashes($rowsaddques_mst['addquesm_qnm']);
  $db_optn1 = stripslashes($rowsaddques_mst['addquesm_optn1']);
  $db_optn2 = stripslashes($rowsaddques_mst['addquesm_optn2']);
  $db_optn3 = stripslashes($rowsaddques_mst['addquesm_optn3']);
  $db_optn4 = stripslashes($rowsaddques_mst['addquesm_optn4']);
  $db_crtans = $rowsaddques_mst['addquesm_crtans'];
  $db_explan = $rowsaddques_mst['addquesm_expln'];
  $db_topicid = $rowsaddques_mst['addquesm_topicsm_id'];
  $db_topicnm = $rowsaddques_mst['topicsm_name'];
  $db_subtopicmnm = $rowsaddques_mst['subtopicsm_name'];
	$db_subtopicid = $rowsaddques_mst['subtopicsm_id'];
	// $db_catseottl = $rowsaddques_mst['addquesm_seotitle'];
	// $db_catseodesc = $rowsaddques_mst['addquesm_seodesc'];
	// $db_catseokywrd = $rowsaddques_mst['addquesm_seokywrd'];
	// $db_catseohone = $rowsaddques_mst['addquesm_seohone'];
	// $db_catseohtwo = $rowsaddques_mst['addquesm_seohtwo'];
	$db_catprty = $rowsaddques_mst['addquesm_prty'];
	$db_catsts = $rowsaddques_mst['addquesm_sts'];

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
	rules[0] = 'txtque:Question|required|Enter Question*';
	rules[1] = 'txtopt1:Option 1|required|Enter Option 1*';
	rules[2] = 'txtopt2:Option 2|required|Enter Option 2*';
	rules[3] = 'txtopt3:Option 3|required|Enter Option 3*';
	rules[4] = 'txtopt4:Option 4|required|Enter Option 4*';
	rules[5] = 'txtexplan:Explanation|required|Please fill Explanation field*';
	rules[6] = 'txtprty:Rank|required|Enter Rank';
	rules[7] = 'addcrtans:Correct Answer|required|Select Correct Answer';
	rules[8] = 'lst_topic: Topic|required|Select Topics*';
	rules[9] = 'lst_subtopic: Sub Topic|required|Select SubTopics*';

	function setfocus() {
		document.getElementById('txtname').focus();
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
		var name =encodeURI( CKEDITOR.instances.txtque.getData());
		var exammnid = document.getElementById('lastexamnm').value;//main link id
		var yearmnid = document.getElementById('lstyear').value;//category id
		id = <?php echo $id; ?>;
		if(name != "")
		{
			var url = "chkduplicate.php?addquesname="+name+"&exammnid="+exammnid+"&yearmnid="+yearmnid+"&qusid="+id;
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
			// alert(temp);
			document.getElementById("errorsDiv_txtque").innerHTML = temp;
		
			if(temp!=0)
			{
				document.getElementById('txtque').focus();
			}
		}
	}
	function get_adtopic_dtls() {
		// var topicval = $("#lst_topic").val();
		var topicsname = document.getElementById('lsttopic').value;
		if (topicsname != "") {
      var url = "../includes/inc_getStsk.php?topicval=" + topicsname;
      xmlHttp = GetXmlHttpObject(stateChanged2);
      xmlHttp.open("GET", url, true);
      xmlHttp.send(null);
    }
  }
	
  function stateChanged2() {
		// debugger
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
      var temp = xmlHttp.responseText;
      if (temp != "") {
        document.getElementById('lstsubtopic').innerHTML = temp;
      }
    }
  }
	function get_admsn_dtls() {
		var slctdtyp = $("#lastexamnm").val();
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
					<h1 class="m-0 text-dark">Edit Questions</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Edit Questions</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<form name="frmedtaddquesid" id="frmedtaddquesid" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
		enctype="multipart/form-data" onSubmit="return performCheck('frmedtaddquesid', rules, 'inline');">
		<input type="hidden" name="hdnaddquesid" value="<?php echo $id; ?>">
		<input type="hidden" name="hdnpage" value="<?php echo $pg; ?>">
		<input type="hidden" name="hdnval" value="<?php echo $srchval; ?>">
		<input type="hidden" name="hdnchk" value="<?php echo $chk; ?>">
		<input type="hidden" name="hdncnt" value="<?php echo $countstart ?>">
		<input type="hidden" name="hdnbgimg" id="hdnbgimg" value="<?php echo $rowsaddques_mst['addquesm_bnrimg']; ?>">
		<input type="hidden" name="hdnsmlimg" id="hdnsmlimg" value="<?php echo $rowsprodscat_mst['addquesm_icn']; ?>">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-center">
				<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Question</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtque" cols="60" rows="3" id="txtque"
									class="form-control"><?php echo $db_qnmdesc; ?></textarea>
                  <span id="errorsDiv_txtque"></span>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Exams *</label>
							</div>
							<div class="col-sm-9">
								<?php
								$sqryprodmncat_mst = "select 
								prodmnexmsm_id,prodmnexmsm_name						
							from 
								prodmnexms_mst 
							where	 
								prodmnexmsm_sts = 'a'
							order by
							   prodmnexmsm_name";
								$srsaddques_mst1 = mysqli_query($conn, $sqryprodmncat_mst);
								$cnt_prodmncat = mysqli_num_rows($srsaddques_mst1);
								?>
								<select name="lastexamnm" id="lastexamnm" class="form-control" onchange="get_admsn_dtls();">
									<option value="">--Select Exams--</option>
									<?php
									if ($cnt_prodmncat > 0) {
										while ($rowsprodmncat_mst = mysqli_fetch_assoc($srsaddques_mst1)) {
											$mncatid = $rowsprodmncat_mst['prodmnexmsm_id'];
											$mncatname = $rowsprodmncat_mst['prodmnexmsm_name'];
											?>
											<option value="<?php echo $mncatid; ?>" <?php if ($db_catmnlnksid == $mncatid) echo 'selected'; ?>><?php echo $mncatname; ?></option>
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
									yearsm_name";
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
												<option value="<?php echo $catid; ?>"<?php if ($db_yearid== $catid) echo 'selected'; ?>><?php echo $catname; ?></option>
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
								<label>Option 1</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtopt1" cols="60" rows="3" id="txtopt1"
									class="form-control"><?php echo $db_optn1; ?></textarea>
							</div>
						</div>
					</div>
          <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Option 2</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtopt2" cols="60" rows="3" id="txtopt2"
									class="form-control"><?php echo $db_optn2; ?></textarea>
							</div>
						</div>
					</div>
          <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Option 3</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtopt3" cols="60" rows="3" id="txtopt3"
									class="form-control"><?php echo $db_optn3; ?></textarea>
							</div>
						</div>
					</div>
          <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Option 4</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtopt4" cols="60" rows="3" id="txtopt4"
									class="form-control"><?php echo $db_optn4; ?></textarea>
							</div>
						</div>
					</div>
          <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Correct Answer</label>
							</div>
							<div class="col-sm-9">
              <select name="lstcrtans" id="lstcrtans" class="form-control">
							<option value="" <?php if($db_crtans =='') echo 'selected';?>>--Select--</option>
							<option value="1" <?php if($db_crtans =='1') echo 'selected';?>>Option 1</option>
							<option value="2" <?php if($db_crtans =='2') echo 'selected';?>>Option 2</option>
              <option value="3" <?php if($db_crtans =='3') echo 'selected';?>>Option 3</option>
              <option value="4" <?php if($db_crtans =='4') echo 'selected';?>>Option 4</option>
								</select>
							</div>
						</div>
					</div>
          <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Explanation *</label>
							</div>
							<div class="col-sm-9">
								<textarea name="txtexplan" cols="60" rows="3" id="txtexplan"
									class="form-control"><?php echo $db_explan; ?></textarea>
							</div>
						</div>
					</div>
          <div class="col-md-12">
						<div class="row mb-2 mt-2">

              <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Topic *</label>
							</div>
							<div class="col-sm-9">
								<?php
								 $sqrytopics_mst = "select 
								topicsm_id,topicsm_name						
							from 
								topics_mst 
							where	 
								topicsm_sts = 'a'
							order by
							   topicsm_name";
								$srstopics_mst = mysqli_query($conn, $sqrytopics_mst);
								$cnt_topics = mysqli_num_rows($srstopics_mst);
								?>
								<select name="lsttopic" id="lsttopic" class="form-control" onchange="get_adtopic_dtls();">
									<option value="">--Select Exams--</option>
									<?php
									if ($cnt_topics > 0) { 
                    while ($rowstopics_mst = mysqli_fetch_assoc($srstopics_mst)) {
											$topicsid = $rowstopics_mst['topicsm_id'];
											 $topicsname = $rowstopics_mst['topicsm_name']; 
											?>
											<option value="<?php echo $topicsid; ?>" <?php if ($db_topicid == $topicsid) echo 'selected'; ?>><?php echo $topicsname; ?></option>
											<?php
										}
									}
									?>
								</select>
								<span id="errorsDiv_lsttopic"></span>
							</div>
						</div>
					</div>
          <div class="col-md-12">
						<div class="row mb-2 mt-2">
							<div class="col-sm-3">
								<label>Sub Topic *</label>
							</div>
							<?php
							 	$sqrysubtopic_mst = "SELECT subtopicsm_id,subtopicsm_name from subtopics_mst where subtopicsm_sts = 'a' and subtopicsm_topicsm_id = $db_topicid group by subtopicsm_id order by subtopicsm_prty asc";
								 $srssubtopics_mst = mysqli_query($conn, $sqrysubtopic_mst);
								 $cnt_subtopics = mysqli_num_rows($srssubtopics_mst);
								?>
							<div class="col-sm-9">
							<select name="lstsubtopic" id="lstsubtopic" class="form-control" >
									<!-- <option value="">--Select sub topic--</option> -->
									<?php
									if ($cnt_subtopics > 0) { 
										while ($rowssubtopics_mst = mysqli_fetch_assoc($srssubtopics_mst)) {
											$subtopicsid = $rowssubtopics_mst['subtopicsm_id'];
											 $subtopicsname = $rowssubtopics_mst['subtopicsm_name']; 
											?>
											<option value="<?php echo $subtopicsid; ?>" <?php if ($db_topicid == $subtopicsid) echo 'selected'; ?>><?php echo $subtopicsname; ?></option>
											<?php
										}
									}?>
									<!-- <option value="<?php echo $db_subtopicid; ?>"><?php echo $db_subtopicmnm?></option> -->
							</select>
								<span id="errorsDiv_lstsubtopic"></span>
								<!-- <?php echo $db_subtopicmnm; ?> -->
							</div>
						</div>
					</div>
					<!-- <div class="col-md-12">
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
					</div> -->
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
        </div>
      </div>
									<p class="text-center">
										<input type="Submit" class="btn btn-primary btn-cst" name="btneaddquessbmt" id="btneaddquessbmt"
										value="Submit">
										&nbsp;&nbsp;&nbsp;
										<input type="reset" class="btn btn-primary btn-cst" name="btnaddquesreset" value="Clear"
										id="btnaddquesreset">
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
	// CKEDITOR.replace('txtdesc');
	CKEDITOR.replace('txtque');
	CKEDITOR.replace('txtopt1');
CKEDITOR.replace('txtopt2');
CKEDITOR.replace('txtopt3');
CKEDITOR.replace('txtopt4');
CKEDITOR.replace('txtexplan');
</script>