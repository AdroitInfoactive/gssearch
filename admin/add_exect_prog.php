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
$pagecat = "Executive Programs";
$pagenm = "Executive Programs";
/*****header link********/

global $gmsg;
if (isset($_POST['btnexect_progsbmt']) && (trim($_POST['btnexect_progsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != "")) {
  include_once "../includes/inc_fnct_fleupld.php"; // For uploading files 
  include_once "../database/iqry_exect_prog_mst.php";
}
$rd_crntpgnm = "view_all_exect_prog.php";
$clspn_val = "4";
?>
<script language="javaScript" type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script language="javascript" src="../includes/yav.js"></script>
<script language="javascript" src="../includes/yav-config.js"></script>
<link rel="stylesheet" type="text/css" href="../includes/yav-style1.css">
<script language="javascript" type="text/javascript">
  var rules = new Array();
  rules[0] = 'txtname:Name|required|Enter Name';
  rules[1] = 'txtprior:Priority|required|Enter Rank';
  rules[2] = 'txtprior:Priority|numeric|Enter Only Numbers';
  rules[3] = 'lstexect_cat:catName|required|Select Category Name ';
  rules[4] = 'lstexect_scat:Select|required|Select Sub Category';
  // rules[5] = 'fledexect_brocher:brocher|required|Please fill this field';


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
    var scatid = document.getElementById('lstexect_scat').value;
    var name = document.getElementById('txtname').value;
    if (name != "" && catid != "") {
      var url = "chkduplicate.php?prodscatname=" + name + "&exect_progcatid=" + catid + "&exect_progscatid=" + scatid;
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

  function get_exec_scat() {
    debugger
    var execcatval = $("#lstexect_cat").val();
    $.ajax({
      type: "POST",
      url: "../includes/inc_getStsk.php",
      data: 'execcatval=' + execcatval,
      success: function(data) {
        // alert(data)
        $("#lstexect_scat").html(data);
      }
    });
  }
  /********************Curriculam Upload********************************/

  var nfiles = 1;

  function expand_curr() {
    nfiles++;
    var htmlTxt = '<?php
    echo "<table border=\'0\' cellpadding=\'1\' cellspacing=\'1\' width=\'100%\'>";
    echo "<tr>";
    echo "<td align=\'center\' width=\'5%\'> ' + nfiles + '</td>";
    echo "<td align=\'left\' width=\'15%\'>";
    echo "<input type=text name=txtcurrname' + nfiles + ' id=txtcurrname' + nfiles + ' class=form-control size=\'10\'></td>";
    echo "<td align=\'left\' width=\'35%\'>";
    echo "<textarea name=txtcurrdesc' + nfiles + ' id=txtcurrdesc' + nfiles + ' class=form-control cols=\'60\' rows=\'3\'></textarea></td>";

    // echo "<td align=\'left\' width=\'10%\'>";
    // echo "<input type=file name=flesimg1' + nfiles + ' id=flesimg' + nfiles + ' class=form-control><br>";
    // echo "</td>";


    echo "<td align=\'left\' width=\'5%\'>";
    echo "<input type=\'text\' name=txtcurrprior' + nfiles + ' id=txtcurrprior' + nfiles + ' class=form-control size=5 maxlength=3>";
    echo "</td>";

    echo "<td align=center width=\'5%\'>";
    echo "<select name=lstcurrsts' + nfiles + ' id=lstcurrsts' + nfiles + ' class=form-control>";
    echo "<option value=a>Active</option>";
    echo "<option value=i>Inactive</option>";
    echo "</select>";
    echo "</td></tr></table>";
    ?>';
  var Cntnt = document.getElementById("myDiv");

  if (document.createRange) { //all browsers, except IE before version 9 

    var rangeObj = document.createRange();
    Cntnt.insertAdjacentHTML('BeforeBegin', htmlTxt);
    // document.frmpgcntn.hdntotcntrl.value = nfiles;
    if (rangeObj.createContextualFragment) { // all browsers, except IE	
      //var documentFragment = rangeObj.createContextualFragment (htmlTxt);
      //Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla	

    } else { //Internet Explorer from version 9
      Cntnt.insertAdjacentHTML('BeforeBegin', htmlTxt);
    }
  } else { //Internet Explorer before version 9
    Cntnt.insertAdjacentHTML("BeforeBegin", htmlTxt);
  }
  document.getElementById('hdntotcntrl').value = nfiles;
  get_ckeditor();
  //document.frmpgcntn.hdntotcntrl.value = nfiles;
}
////////////////////////////////////faculty////////////////////////////////////
var facfiles = 1;

function expand_fac() {
  facfiles++;
  var htmlTxt = '<?php
  echo "<table border=\'0\' cellpadding=\'1\' cellspacing=\'1\' width=\'100%\'>";
  echo "<tr>";
  echo "<td align=\'center\' width=\'5%\'> ' + facfiles + '</td>";
  echo "<td align=\'left\' width=\'15%\'>";
  echo "<input type=text name=txtfacname' + facfiles + ' id=txtfacname' + facfiles + ' class=form-control size=\'10\'>";
  echo "<td align=\'left\' width=\'20%\'>";
  echo "<textarea name=txtfacdesc' + facfiles + ' id=txtfacdesc' + facfiles + ' class=form-control cols=\'60\' rows=\'3\'></textarea></td>";

  echo "<td align=\'left\' width=\'25%\'>";
  echo "<input type=file name=flefacsimg' + facfiles + ' id=flefacsimg' + facfiles + ' class=form-control><br>";
  echo "</td>";


  echo "<td align=\'left\' width=\'10%\'>";
  echo "<input type=\'text\' name=txtfacprior' + facfiles + ' id=txtfacprior' + facfiles + ' class=form-control size=5 maxlength=3>";
  echo "</td>";

  echo "<td align=center width=\'10%\'>";
  echo "<select name=lstfacsts' + facfiles + ' id=lstfacsts' + facfiles + ' class=form-control>";
  echo "<option value=a>Active</option>";
  echo "<option value=i>Inactive</option>";
  echo "</select>";
  echo "</td></tr></table>";
  ?>';
var Cntnt1 = document.getElementById("myDiv2");

if (document.createRange) { //all browsers, except IE before version 9 

  var rangeObj = document.createRange();
  Cntnt1.insertAdjacentHTML('BeforeBegin', htmlTxt);
  if (rangeObj.createContextualFragment) { // all browsers, except IE	
    //var documentFragment = rangeObj.createContextualFragment (htmlTxt);
    //Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla	

  } else { //Internet Explorer from version 9
    Cntnt1.insertAdjacentHTML('BeforeBegin', htmlTxt);
  }
} else { //Internet Explorer before version 9
  Cntnt1.insertAdjacentHTML("BeforeBegin", htmlTxt);
}
document.getElementById('hdntotcntrl2').value = facfiles;
//document.frmpgcntn.hdntotcntr2.value = facfiles;
}
  /////////////////////////////////////participant Stories///////////////////////////////////////////////
var psfiles = 1;

function expand_ps() {
  psfiles++;
  var htmlTxt = '<?php
  echo "<table border=\'0\' cellpadding=\'1\' cellspacing=\'1\' width=\'100%\'>";
  echo "<tr>";
  echo "<td align=\'center\' width=\'5%\'> ' + psfiles + '</td>";
  echo "<td align=\'left\' width=\'15%\'>";
  echo "<input type=text name=txtpsname' + psfiles + ' id=txtpsname' + psfiles + ' class=form-control size=\'10\'>";

  echo "<td align=\'left\' width=\'20%\'>";
  echo "<input type=text name=txtpslink' + psfiles + ' id=txtpslink' + psfiles + ' class=form-control size=\'10\'>";



  echo "<td align=\'left\' width=\'10%\'>";
  echo "<input type=\'text\' name=txtpsprior' + psfiles + ' id=txtpsprior' + psfiles + ' class=form-control size=5 maxlength=3>";
  echo "</td>";

  echo "<td align=center width=\'10%\'>";
  echo "<select name=lstpssts' + psfiles + ' id=lstpssts' + psfiles + ' class=form-control>";
  echo "<option value=a>Active</option>";
  echo "<option value=i>Inactive</option>";
  echo "</select>";
  echo "</td></tr></table>";
  ?>';

var Cntnt3 = document.getElementById("myDiv3");

if (document.createRange) { //all browsers, except IE before version 9 

  var rangeObj = document.createRange();
  Cntnt3.insertAdjacentHTML('BeforeBegin', htmlTxt);
  if (rangeObj.createContextualFragment) { // all browsers, except IE	
    //var documentFragment = rangeObj.createContextualFragment (htmlTxt);
    //Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla	

  } else { //Internet Explorer from version 9
    Cntnt3.insertAdjacentHTML('BeforeBegin', htmlTxt);
  }
} else { //Internet Explorer before version 9
  Cntnt3.insertAdjacentHTML("BeforeBegin", htmlTxt);
}
document.getElementById('hdntotcntrl3').value = psfiles;
//document.frmpgcntn.hdntotcntr2.value = psfiles;
}
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add Executive Programs</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Executive Programs</li>
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
    <div class="card-exect_progy p-0">
      <form name="frmaddexecprog" id="frmaddexecprog" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" onSubmit="return performCheck('frmaddexecprog', rules, 'inline');">
        <div class="col-md-12">
          <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Executive Category *</label>
                </div>
                <div class="col-sm-9">
                  <?php
                  $sqryprodmncat_mst = "SELECT exect_catm_id,exect_catm_name from exect_cat_mst where exect_catm_sts = 'a' order by exect_catm_name";
                  $rsprodmncat_mst = mysqli_query($conn, $sqryprodmncat_mst);
                  $cnt_prodmncat = mysqli_num_rows($rsprodmncat_mst);
                  ?>
                  <select name="lstexect_cat" id="lstexect_cat" class="form-control" onchange="get_exec_scat();">
                    <option value="">--Select Executive Category--</option>
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
                  <label>Executive Sub Category *</label>
                </div>
                <div class="col-sm-9">
                  <select name="lstexect_scat" id="lstexect_scat" class="form-control">
                  </select>
                  <span id="errorsDiv_lstexect_scat"></span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Name *</label>
                </div>
                <div class="col-sm-9">
                  <input name="txtname" type="text" id="txtname" size="45" maxlength="40" onBlur="funcChkDupName()" class="form-control">
                  <span id="errorsDiv_txtname"></span>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Image</label>
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input name="fledexect_progimg" type="file" class="form-control" id="fledexect_progimg">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Brochure</label>
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input name="fledexect_brocher" type="file" class="form-control" id="fledexect_brocher">
                    <span id="errorsDiv_fledexect_brocher"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>From Date</label>
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input name="fledexect_frmdt" type="date" class="form-control" id="fledexect_frmdt" maxlength="250">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>To Date</label>
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input name="fledexect_todt" type="date" class="form-control" id="fledexect_todt" maxlength="250">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Duration</label>
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input name="textexect_durtion" type="text" class="form-control" id="textexect_durtion" maxlength="250">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Fees</label>
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input name="fledexect_fees" type="text" class="form-control" id="fledexect_fees" maxlength="250">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Format</label>
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input name="fledexect_frmt" type="text" class="form-control" id="fledexect_frmt" maxlength="250">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Short Description</label>
                </div>
                <div class="col-sm-9">
                  <textarea name="txtsdesc" cols="60" rows="3" id="txtsdesc" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Overview</label>
                </div>
                <div class="col-sm-9">
                  <textarea name="txtdesc" cols="60" rows="3" id="txtdesc" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Curriculum :-</label>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
                <tr bgcolor="#FFFFFF">
                  <td width="5%" align="center"><strong>SL.No.</strong></td>
                  <td width="15%" align="left"><strong>Name</strong></td>
                  <td width="35%" align="left"><strong>Description</strong></td>
                  <td width="5%" align="left"><strong>Rank</strong></td>
                  <td width="5%" align="center"><strong>Status</strong></td>
                </tr>
              </table>
            </div>

            <div class="table-responsive">
              <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
                <table width="100%" border="0" cellspacing="3" cellpadding="3">
                  <tr bgcolor="#FFFFFF">
                    <td width="5%" align="center">1</td>
                    <td width="15%" align="center">
                      <input type="text" name="txtcurrname1" id="txtcurrname1" placeholder="Name" class="form-control" size="15"><br>
                      <span id="errorsDiv_txtcurrname1" style="color:#FF0000"></span>
                    </td>
                    <td width="35%" align="center">
                      <textarea name="txtcurrdesc1" cols="60" rows="3" id="txtcurrdesc1" class="form-control"></textarea>
                      <span id="errorsDiv_txtcurrdesc1" style="color:#FF0000"></span>
                    </td>
                    
                    <td width="5%" align="center">
                      <input type="text" name="txtcurrprior1" id="txtcurrprior1" class="form-control" size="15"><br>
                      <span id="errorsDiv_txtcurrprior1" style="color:#FF0000"></span>
                    </td>
                    <td width="5%" align="center">
                      <select name="lstcurrsts1" id="lstcurrsts1" class="form-control">
                        <option value="a" selected>Active</option>
                        <option value="i">Inactive</option>
                      </select>
                    </td>
                  </tr>
                </table>
              </table>
              <div id="myDiv">
                <table width="100%" cellspacing='2' cellpadding='3'>
                  <tr>
                    <td align="center">
                      <input name="btnadd" type="button" onClick="expand_curr()" value="Add Another Curriculum" class="btn btn-primary mb-3">
                    </td>
                  </tr>
                </table>
              </div>
              <input type="hidden" id="hdntotcntrl" name="hdntotcntrl" value="1">
            </div>
            
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Faculty :-</label>
                </div>
              </div>
            </div>
            <div class="table-responsive">
							<table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
								<tr bgcolor="#FFFFFF">
									<td width="5%" align="center"><strong>SL.No.</strong></td>
									<td width="15%" align="left"><strong>Name</strong></td>
                  <td width="20%" align="left"><strong>Description</strong></td>
									<td width="25%" align="left"><strong>Image</strong></td>
									<td width="10%" align="left"><strong>Rank</strong></td>
									<td width="10%" align="center"><strong>Status</strong></td>
								</tr>
							</table>
						</div>
						<div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered" >
										<table width="100%" border="0" cellspacing="3" cellpadding="3">
											<tr bgcolor="#FFFFFF">
											<td width="5%" align="center">1</td>
												<td width="15%"  align="center">
													<input type="text" name="txtfacname1" id="txtfacname1" placeholder="Name" class="form-control" size="15"><br>
													<span id="errorsDiv_txtfacname1" style="color:#FF0000"></span>
												</td>
                        <td width="20%" align="center">
                      <textarea name="txtfacdesc1" cols="60" rows="3" id="txtfacdesc1" class="form-control"></textarea>
                      <span id="errorsDiv_txtfacdesc1" style="color:#FF0000"></span>
                    </td>
												<td width="25%"  align="center">
													<input type="file" name="flefacsimg1" id="flefacsimg1" class="form-control" size="15"><br>
													<span id="errorsDiv_flefacsimg1" style="color:#FF0000"></span>
												</td>
												<td width="10%"  align="center">
													<input type="text" name="txtfacprior1" id="txtfacprior1" class="form-control" size="15"><br>
													<span id="errorsDiv_txtfacprior1" style="color:#FF0000"></span>
												</td>
												<td width="10%" align="center" >					
													<select name="lstfacsts1" id="lstfacsts1" class="form-control">
														<option value="a" selected>Active</option>
														<option value="i">Inactive</option>
													</select>
												</td>
											</tr>
										</table>
									</table>
                  <div id="myDiv2">
										<table width="100%" cellspacing='2' cellpadding='3'>
											<tr>
												<td align="center">
													<input name="btnadd2" type="button" onClick="expand_fac()" value="Add Another Faculty" class="btn btn-primary mb-3">
												</td>
											</tr>
										</table>
									</div>
							</div>
								<input type="hidden" id="hdntotcntrl2" name="hdntotcntrl2" value="1">

                <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Participant Stories :-</label>
                </div>
              </div>
            </div>
            <div class="table-responsive">
							<table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
								<tr bgcolor="#FFFFFF">
									<td width="5%" align="center"><strong>SL.No.</strong></td>
									<td width="15%" align="left"><strong>Name</strong></td>
                  <td width="20%" align="left"><strong>Link</strong></td>
									<td width="10%" align="left"><strong>Rank</strong></td>
									<td width="10%" align="center"><strong>Status</strong></td>
								</tr>
							</table>
						</div>
            <div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered" >
										<table width="100%" border="0" cellspacing="3" cellpadding="3">
											<tr bgcolor="#FFFFFF">
											<td width="5%" align="center">1</td>
												<td width="15%"  align="center">
													<input type="text" name="txtpsname1" id="txtpsname1" placeholder="Name" class="form-control" size="15"><br>
													<span id="errorsDiv_txtpsname1" style="color:#FF0000"></span>
												</td>
                        <td width="20%" align="center">
                        <input type="text" name="txtpslink1" cols="60" rows="3" id="txtpslink1" class="form-control"><br>
                      <span id="errorsDiv_txtpslink1" style="color:#FF0000"></span>
                    </td>
                    <td width="10%"  align="center">
													<input type="text" name="txtpsprior1" id="txtpsprior1" class="form-control" size="15"><br>
													<span id="errorsDiv_txtpsprior1" style="color:#FF0000"></span>
												</td>
												<td width="10%" align="center" >					
													<select name="lstpssts1" id="lstpssts1" class="form-control">
														<option value="a" selected>Active</option>
														<option value="i">Inactive</option>
													</select>
												</td>
											</tr>
										</table>
									</table>
                  <div id="myDiv3">
										<table width="100%" cellspacing='2' cellpadding='3'>
											<tr>
												<td align="center">
													<input name="btnadd3" type="button" onClick="expand_ps()" value="Add Another Participant Stories" class="btn btn-primary mb-3">
												</td>
											</tr>
										</table>
									</div>
							</div>
								<input type="hidden" id="hdntotcntrl3" name="hdntotcntrl3" value="1">
                
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
              <input type="Submit" class="btn btn-primary" name="btnexect_progsbmt" id="btnexect_progsbmt" value="Submit">
              &nbsp;&nbsp;&nbsp;
              <input type="reset" class="btn btn-primary" name="btnexect_progreset" value="Clear" id="btnexect_progreset">
              &nbsp;&nbsp;&nbsp;
              <input type="button" name="btnBack" value="Back" class="btn btn-primary" onClick="location.href='<?php echo $rd_crntpgnm; ?>'">
            </p>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-exect_progy -->
  </div>
  <!-- /.card -->
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>
<script language="javascript" type="text/javascript">
  CKEDITOR.replace('txtdesc');
</script>
<script language="javascript" type="text/javascript">
  CKEDITOR.replace('txtcurrdesc1');
  function get_ckeditor()
  {
    var cnt_desc = document.getElementById("hdntotcntrl").value;
    for (let i = 1; i <= cnt_desc; i++) {
      CKEDITOR.replace('txtcurrdesc'+i);
    }
  }
</script>