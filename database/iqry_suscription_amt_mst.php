<?php	
    include_once  "../includes/inc_nocache.php"; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more
	global $ses_admin;
	if(isset($_POST['btnsubscrptn_amtsbmt']) && (trim($_POST['btnsubscrptn_amtsbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "")){
	   
		$name     	= glb_func_chkvl($_POST['txtname']);
		
		$prior    	= 1;
	
		$sts      	= $_POST['lststs'];
		$dt       	= date('Y-m-d h:i:s');
		
	  	// $sqryprodcat_mst = "select 
		// 						subscrptnm_amt_name 
		// 			      	from 
		// 				    	subscrptn_amt_mst
		// 			      	where 
		// 				  		 subscrptnm_amt_name ='$name'"; 
		// $srsprodcat_mst = mysqli_query($conn,$sqryprodcat_mst);
		// 	$cntrec_cat     = mysqli_num_rows($srsprodcat_mst);
		// if($cntrec_cat < 1){
		
			  $iqryprodcat_mst="insert into subscrptn_amt_mst(
						      subscrptnm_amt_name,subscrptnm_amt_sts,subscrptnm_amt_prty,
							  subscrptnm_amt_crtdon,subscrptnm_amt_crtdby)values(							  
						      '$name','$sts','$prior',
							  '$dt','$ses_admin')";	
							  //echo 	$iqryprodcat_mst;exit;	
			$irsprodcat_mst= mysqli_query($conn,$iqryprodcat_mst);
            $new_id=mysqli_insert_id($conn);
			if($irsprodcat_mst==true){
$uqry="UPDATE subscrptn_amt_mst set subscrptnm_amt_sts='i' where subscrptnm_amt_id!='$new_id'";
mysqli_query($conn,$uqry);
		
				}
				$gmsg = "Record saved successfully";
			// }

			// else{
			// 	$gmsg = "Record not saved";
			// }
		}

		else{						
			$gmsg = "Duplicate name. Record not saved";
		}
	// }
?>