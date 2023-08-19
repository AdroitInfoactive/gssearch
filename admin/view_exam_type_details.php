<?php

include_once '../includes/inc_config.php'; //Making paging validation	
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_detail_product_subcategory.php	
Purpose : For Viewing sub category Details
Created By : Bharath
Created On :	21-01-2022
Modified By : 
Modified On :
Purpose : 
Company : Adroit
 ************************************************************/
global $id, $pg, $countstart;
$rd_crntpgnm = "view_exam_type.php";
$rd_edtpgnm = "edit_exam_type.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Setup";
$pagecat = "exam_type";
$pagenm = "Exam Type";
/*****header link********/
if (isset($_REQUEST['vw']) && (trim($_REQUEST['vw']) != "") && isset($_REQUEST['pg']) && (trim($_REQUEST['pg']) != "") && isset($_REQUEST['countstart']) && (trim($_REQUEST['countstart']) != "")) {
    $id = glb_func_chkvl($_REQUEST['vw']);
    $pg = glb_func_chkvl($_REQUEST['pg']);
    $countstart = glb_func_chkvl($_REQUEST['countstart']);
    $srchval = glb_func_chkvl($_REQUEST['val']);
}
$sqryprodscat_mst = "SELECT 
exam_name,exam_id,exam_desc,exam_prty,
exam_sts,exam_flenm 
from  exam_typ where exam_id=$id";
$srsprodscat_mst  = mysqli_query($conn, $sqryprodscat_mst);
$rowsprodscat_mst = mysqli_fetch_assoc($srsprodscat_mst);

// $db_scattype     = $rowsprodscat_mst['prodscatm_typ']; //type
$loc = "&val=$srchval";
if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")) {
    $msg = "<font color=red>Record updated successfully</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")) {
    $msg = "<font color=red>Record not updated</font>";
} elseif (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")) {
    $msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
}
?>
<script language="javascript">
    function update1() //for update download details
    {
        document.frmedtbrnd.action = "<?php echo $rd_edtpgnm; ?>?edit=<?php echo $id; ?>&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $loc; ?>";
        document.frmedtbrnd.submit();
    }
</script>
<?php include_once $inc_adm_hdr; ?>
<section class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View  Exam Type</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View  Exam Type</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <form name="frmedtbrnd" id="frmedtbrnd" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onSubmit="return performCheck('frmedtbrnd', rules, 'inline');">
        <input type="hidden" name="hdnprodscatid" value="<?php echo $id; ?>">
        <input type="hidden" name="hdnpage" value="<?php echo $pg; ?>">
        <input type="hidden" name="hdncnt" value="<?php echo $countstart ?>">
        <?php
        if ($msg != '') {
            echo "<center><tr bgcolor='#FFFFFF'>
				<td colspan='4' bgcolor='#F3F3F3' align='center'><strong>$msg</strong></td> 
			 </tr></center>";
        }
        ?>
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-12">

                      
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Exam Type Name</label>
                            <div class="col-sm-8">
                                <?php echo $rowsprodscat_mst['exam_name']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <?php echo $rowsprodscat_mst['exam_desc']; ?>
                            </div>
                        </div>


                       
                        <!-- <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">File Name</label>
                            <div class="col-sm-8">
                                <?php
                                $imgnm = $rowsprodscat_mst['exam_flenm'];
                                $imgpath = $exams_fldnm . $imgnm;
                                if (($imgnm != "") && file_exists($imgpath)) {
                                    echo "<img src='$imgpath' width='80pixel' height='80pixel'><br>";
                                } else {
                                    echo "Image not available";
                                }
                                ?>
                            </div>
                        </div> -->
                    


                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Priority</label>
                            <div class="col-sm-8">
                                <?php echo $rowsprodscat_mst['exam_prty']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <?php  if($rowsprodscat_mst['exam_sts']=='a'){echo "Active";}else{echo "Inactive";}; ?>
                            </div>
                        </div>
                        <p class="text-center">
                            <input type="Submit" class="btn btn-primary btn-cst" name="btnedtbrnd" id="btnedtbrnd" value="Edit" onclick="update1();">
                            &nbsp;&nbsp;&nbsp;
                            <input type="button" name="btnBack" value="Back" class="btn btn-primary btn-cst" onclick="location.href='<?php echo $rd_crntpgnm; ?>?<?php echo $loc; ?>'">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>