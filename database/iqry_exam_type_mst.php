<?php
//echo "hi";exit;
include_once '../includes/inc_nocache.php';      //Clearing the cache information
include_once '../includes/inc_adm_session.php';  //checking for session
include_once '../includes/inc_usr_functions.php'; //Making database Connection
include_once '../includes/inc_folder_path.php';

if (isset($_POST['btnaddexams']) && (trim($_POST['btnaddexams']) != "")) {
    //isset($_POST['txtname']) && (trim($_POST['txtname'])!= "") && 	
    //isset($_POST['lstprdctcat']) && (trim($_POST['lstprdctcat'])!= "")&& 	
    // isset($_FILES['fleexam']) && (trim($_FILES['fleexam'])!= ""))
    //{

    // $prod_id        = glb_func_chkvl($_POST['lstprdctcat']);
    $dt                = date("Y-m-d h:i:s"); //date 
    $user             = $_SESSION['sesadmin']; //session of user			   
    $name           = glb_func_chkvl($_POST['txtname']);
    $desc           = glb_func_chkvl($_POST['txtdesc']);
    $prior          = glb_func_chkvl($_POST['txtprior']);
    $sts            = glb_func_chkvl($_POST['lststs']);
    $sqryexam_typ = "SELECT exam_name
			                 from   exam_typ
						     where exam_name='$name'";
    $srsexam_typ = mysqli_query($conn, $sqryexam_typ);
    $cntrec        = mysqli_num_rows($srsexam_typ);
    if ($cntrec < 1) {

        //**********************IMAGE UPLOADING START*******************************//
        if (isset($_FILES['fleexam']['tmp_name']) && ($_FILES['fleexam']['tmp_name'] != "")) {
            $examfleval = funcUpldImg('fleexam', 'fle');
            if ($examfleval != "") {
                $examfleval = explode(":", $examfleval, 2);
                $dest          = $examfleval[0];
                $source      = $examfleval[1];
            }
        }
        /***************Big Image Upload End ********************/
        $iqryexam_typ = "INSERT into exam_typ(
						                  exam_name,exam_desc,exam_flenm,
										  exam_sts,exam_prty,exam_crtdon,exam_crtdby)
										  values('$name','$desc','$dest', 
										  '$sts','$prior','$dt','$user')";
        $rsexam_typ   = mysqli_query($conn, $iqryexam_typ);


        //}//If Image Name is Set
        if ($rsexam_typ == true) {
            $pgimgd_pgcntsd_id     = mysqli_insert_id();
            if (($source != 'none') && ($source != '') && ($dest != "")) {
                $dest = $pgimgd_pgcntsd_id . $dest;
                move_uploaded_file($source, $exams_fldnm . $dest);
            }

            $gmsg = 'Record Saved Successfully ';
        } else {
            $gmsg = 'Record Not Saved(Try Again)';
        }
    } else {
        $gmsg = 'Duplicate Record(Record Not Saved)';
    } //Not A Duplicate Record Check


}
