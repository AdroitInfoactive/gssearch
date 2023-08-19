<?php
include_once '../includes/inc_nocache.php'; // Clearing the cache information
include_once "../includes/inc_adm_session.php"; //checking for session	
if (
    isset($_POST['btnedtexams']) && (trim($_POST['btnedtexams']) != "") &&
    // isset($_POST['txtname']) && (trim($_POST['txtname'])!= "") && 	
    // isset($_POST['lstprdctcat']) && (trim($_POST['lstprdctcat'])!= "")&& 	
    // isset($_POST['hdnfle']) && (trim($_POST['hdnfle']) != "") &&
    isset($_POST['hdnbrndid']) && (trim($_POST['hdnbrndid']) != "")
)

//isset($_FILES['fleexam']) && (trim($_FILES['fleexam'])!= ""))
{
    $id           = glb_func_chkvl($_POST['hdnbrndid']);
    $name         = glb_func_chkvl($_POST['txtname']);
    $desc         = glb_func_chkvl($_POST['txtdesc']);
    
    $prior       = glb_func_chkvl($_POST['txtprior']);
    $hdnfle     = glb_func_chkvl($_POST['hdnfle']);
    $desc         = glb_func_chkvl($_POST['txtdesc']);
    $sts          = glb_func_chkvl($_POST['lststs']);
    $dt         = date('Y-m-d h:i:s');
    $emp         = $_SESSION['admin'];
    $pg         = glb_func_chkvl($_REQUEST['pg']);
    $countstart = glb_func_chkvl($_REQUEST['countstart']);
    $val        = glb_func_chkvl($_REQUEST['val']);
    $optn       = glb_func_chkvl($_REQUEST['optn']);

    if (isset($_REQUEST['chk']) && trim($_REQUEST['chk']) == 'y') {
        $ck = "&chk=y";
    }
    if (($val != "") && ($optn != "")) {
        $srchval = "&optn=" . $optn . "&val=" . $val . $ck;
    }
    $sqryexam_typ = "SELECT exam_name
			            from   exam_typ
						where  exam_name='$name' and	exam_id!=$id";
    $srsexam_typ = mysqli_query($conn, $sqryexam_typ);
    $rowsexam_typ         = mysqli_num_rows($srsexam_typ);
    if ($rowsexam_typ < 1) {
        $uqryexam_typ = "update exam_typ set 
				          exam_name='$name',
						  exam_desc='$desc',
						 
						  exam_sts='$sts',
						  exam_prty='$prior',
						  exam_mdfdon='$dt',
						  exam_mdfdby='$emp'";


        /*------------------------------------Update File----------------------------*/
        // if (isset($_FILES['fleexam']['tmp_name']) && ($_FILES['fleexam']['tmp_name'] != "")) {
        //     $examfleval = funcUpldImg('fleexam', 'fledwn');
        //     if ($examfleval != "") {
        //         $examfleval = explode(":", $examfleval, 2);
        //         $dest         = $examfleval[0];
        //         $evntsource     = $examfleval[1];
        //     }
        //     if (($evntsource != 'none') && ($evntsource != '') && ($dest != "")) {
        //         $evntflpath      = $exams_fldnm . $hdnfle;
        //         if (($hdnfle != '') && file_exists($evntflpath)) {
        //             unlink($evntflpath);
        //         }
        //         move_uploaded_file($evntsource, $exams_fldnm . $id . "-" . $dest);
        //         $uqryexam_typ .= ",exam_flenm='$dest'";
        //     }
        // }
        if (isset($_FILES['fleexam']['tmp_name']) && ($_FILES['fleexam']['tmp_name'] != "")) {
            $simgval = funcUpldImg('fleexam', 'fledwn');
            if ($simgval != "") {
                $simgary    = explode(":", $simgval, 2);
                $dest         = $simgary[0];
                $source     = $simgary[1];
            }
            if (($source != 'none') && ($source != '') && ($dest != "")) {
                $simgpth      = $exams_fldnm . $simgnm;

                if (($simgnm != '') && file_exists($simgpth)) {
                    unlink($simgpth);
                }
                move_uploaded_file($source, $exams_fldnm . $dest);
                $uqryexam_typ .= ",exam_flenm='$dest'";
            }
        }
        $uqryexam_typ .= " where exam_id=$id";


        // echo  $uqryexam_typ;
        // exit;
        $ursexam_typ = mysqli_query($conn, $uqryexam_typ);

        if ($ursexam_typ == true) {
?>
            <script>
                location.href = "view_exam_type_details.php?vw=<?php echo $id; ?>&sts=y&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart ?>";
            </script>

        <?php
        } else {
        ?>
            <script>
                location.href = "view_exam_type.php?sts=n&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $srchval; ?>";
            </script>
        <?php
        }
        ?>

    <?php
    } else {
    ?>
        <script>
            location.href = "view_exam_types.php?sts=d&pg=<?php echo $pg; ?>&countstart=<?php echo $countstart . $srchval; ?>";
        </script>
<?php
    }
}
?>