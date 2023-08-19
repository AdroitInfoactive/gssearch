<?php
//error_reporting(0);
include_once '../includes/inc_config.php';       //Making paging validation	
include_once '../includes/inc_nocache.php';         //Clearing the cache information
include_once "../includes/inc_adm_session.php";     //checking for session
include_once "../includes/inc_connection.php";      //Making database Connection
include_once "../includes/inc_usr_functions.php";   //Include user functions
include_once "../includes/inc_folder_path.php";		
include_once "../includes/inc_config.php";	
/***************************************************************/
//Programm 	  : add_products.php	
//Purpose 	  : For adding new Products


//Modified By : Lokesh palagani
//Modified On : 07-04-2023
//Company 	  : Adroit
/************************************************************/
/*****header link********/

$pagemncat = "Setup";
$pagecat = "Product Group";
$pagenm = "Question Bulk Upload";
/*****header link********/
global $gmsg,$sts,$lin;		 
$rd_crntpgnm = "view_questions.php";
$clspn_val   = "4";
$sts = $_REQUEST['sts'];
$lin = $_REQUEST['lin'];

global $gmsg;	
if(isset($_POST['clmsbmt']) && (trim($_POST['clmsbmt'])!= "") && 	
isset($_FILES['fleblkupld'])  && (trim($_FILES['fleblkupld']['name']) != "")){
include_once '../includes/inc_fnct_fleupld.php';
include_once '../database/iqry_qns_mst_bulk.php';
}


?>

<?php   
include_once $inc_adm_hdr;

?>


<section class="content">
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0 text-dark">Add Bulk Questions</h1>
</div><!-- /.col -->
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Add Bulk Questions </li>
</ol>
</div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- Default box -->
<div class="card">
<div class="card-header">
<?php /*?><h2 class="card-title h1">View All Category</h2><?php */?>



<div class="alert alert-warning alert-dismissible fade show" role="alert" id="updid" style="display:none">
<strong>Updated Successfully !</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>		<div class="alert alert-info alert-dismissible fade show" role="alert" id="sucid" style="display:none">
<strong>Added Successfully !</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<?php
if($sts == "y"){
echo "<div class='alert alert-info'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Products Added Successfully</div>";						
}else if($sts == "n"){
echo "<div class='alert alert-info'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Error record not saved. Line Number $lin</div>";						



}else if($sts == "d"){
echo "<div class='alert alert-info'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Products Not  Added Duplicate Code Exists  Line Number $lin</div>";						



}	
?>

<div class="card-body p-0">
<form name="frmaddprodcat" id="frmaddprodcat" method="post" action="<?php $_SERVER['PHP_SELF'];?>" 
enctype="multipart/form-data" onSubmit="return performCheck('frmaddprodcat', rules, 'inline');" >
<div class="col-md-12">

<div class="row justify-content-center align-items-center">

<div class="col-md-12">
<p align="right" ><a href="sample_import.xlsm" download="sample_import.xlsm">Download Sample Excel File</a></p>
<div class="row mb-2 mt-2">
<div class="col-sm-3"> <label>1 File (Upload only xls file)*</label> </div>
<div class="col-sm-6"><input type="file" class="form-control" id="fleblkupld" name="fleblkupld" required class="form-control">

<span id="errorsDiv_txtname"></span></div>
<div class="col-sm-3"> 
<p class="text-center"> <input type="Submit" class="btn btn-primary"  name="clmsbmt" id="clmsbmt" value="Submit">
&nbsp;&nbsp;&nbsp;
<input type="reset" class="btn btn-primary"  name="btnprodcatreset" value="Clear" id="btnprodcatreset">
&nbsp;&nbsp;&nbsp;
<input type="button"  name="btnBack" value="Back" class="btn btn-primary" onClick="location.href='<?php echo $rd_crntpgnm ;?>'"></p></div>

    

  

</div>

</form></div>
<!-- /.card-body -->

<!-- <div class="card-body p-0">
<form name="frmaddprodcat1" id="frmaddprodcat1" method="post" action="<?php $_SERVER['PHP_SELF'];?>" 
enctype="multipart/form-data" onSubmit="return performCheck('frmaddprodcat1', rules, 'inline');" >
<div class="col-md-12">

<div class="row justify-content-center align-items-center">

<div class="col-md-12"><div class="row mb-2 mt-2">
<div class="col-sm-3"> <label>2 File (Upload only xls file)*</label> </div>
<div class="col-sm-6"><input type="file" class="form-control" id="fleblkupld1" name="fleblkupld1" required class="form-control">

<span id="errorsDiv_txtname"></span></div>
<div class="col-sm-3"> 
<p class="text-center"> <input type="Submit" class="btn btn-primary"  name="clmsbmt1" id="clmsbmt1" value="Submit">
&nbsp;&nbsp;&nbsp;
<input type="reset" class="btn btn-primary"  name="btnprodcatreset" value="Clear" id="btnprodcatreset">
&nbsp;&nbsp;&nbsp;
<input type="button"  name="btnBack" value="Back" class="btn btn-primary" onClick="location.href='<?php echo $rd_crntpgnm ;?>'"></p></div>

</div>

</form></div> -->


</div>
<!-- /.card -->

</section>
<?php include_once "../includes/inc_adm_footer.php";?>