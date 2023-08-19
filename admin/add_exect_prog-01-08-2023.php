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
<script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>
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
      var url = "chkduplicate.php?exect_progname=" + name + "&exect_progcatid=" + catid + "&exect_progscatid=" + scatid;
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
  function get_exec_scat()
  {
    var execcatval = $("#lstexect_cat").val();
  	$.ajax({
  		type: "POST",
  		url: "../includes/inc_getStsk.php",
  		data:'execcatval='+execcatval,
  		success: function(data){
  			// alert(data)
  			$("#lstexect_scat").html(data);
  		}
  	});
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
      <form name="frmaddexecprog" id="frmaddexecprog" method="post" action="<?php $_SERVER['PHP_SELF']; ?>"
        enctype="multipart/form-data" onSubmit="return performCheck('frmaddexecprog', rules, 'inline');">
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
            <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Image</label>
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input name="fledexect_progimg" type="file" class="form-control" id="fledexect_progimg" maxlength="250">
                  </div>
                </div>
              </div>
            </div>
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
              <input type="Submit" class="btn btn-primary" name="btnexect_progsbmt" id="btnexect_progsbmt"
                value="Submit">
              &nbsp;&nbsp;&nbsp;
              <input type="reset" class="btn btn-primary" name="btnexect_progreset" value="Clear"
                id="btnexect_progreset">
              &nbsp;&nbsp;&nbsp;
              <input type="button" name="btnBack" value="Back" class="btn btn-primary"
                onClick="location.href='<?php echo $rd_crntpgnm; ?>'">
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