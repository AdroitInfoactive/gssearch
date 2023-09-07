<?php	
// echo"here"; exit;
    include_once  "../includes/inc_nocache.php"; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more
	global $ses_admin;
	if(isset($_POST['btnuserssbmt']) && (trim($_POST['btnuserssbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "")){
	   
		$name     	= glb_func_chkvl($_POST['txtname']);
		$pwd     	  = md5(glb_func_chkvl($_POST['txtpwd']));
    $type     	= glb_func_chkvl($_POST['txttyp']);
		// $prior    	= glb_func_chkvl($_POST['txtprty']);
		$sts      	= $_POST['lststs'];
    $curdt = date('Y-m-d h-i-s');
		  
	  	$sqryprodcat_mst = "SELECT lgnm_uid FROM lgn_mst WHERE lgnm_uid ='$name'"; 
		  $srsprodcat_mst = mysqli_query($conn,$sqryprodcat_mst); 
			 $cntrec_cat     = mysqli_num_rows($srsprodcat_mst);
		if($cntrec_cat < 1){
			   $iqryprodcat_mst="INSERT INTO lgn_mst(lgnm_uid, lgnm_pwd, lgnm_typ, lgnm_sts, lgnm_crtdon, lgnm_crtdby) VALUES ('$name', '$pwd', '$type', '$sts', '$curdt', '$ses_admin')";
							//  echo 	$iqryprodcat_mst;exit;	
			$irsprodcat_mst= mysqli_query($conn,$iqryprodcat_mst);
			// if($irsprodcat_mst==true){
			// 	if(($bsource!='none') && ($bsource!='') && ($bdest != "")){ 
			// 		echo move_uploaded_file($bsource,$a_mnlnks_bnrfldnm.$bdest);
			// 	}
				$gmsg = "Record saved successfully";
			}
			else{
				$gmsg = "Record not saved";
			}
		}
		else{						
			$gmsg = "Duplicate name. Record not saved";
		}
	// }
?>