<?php	
    include_once  "../includes/inc_nocache.php"; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_usr_functions.php";//Use function for validation and more
	global $ses_admin;
	if(isset($_POST['btnyearssbmt']) && (trim($_POST['btnyearssbmt']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && 
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != "")){
	   
		$name     	= glb_func_chkvl($_POST['txtname']);
		$desc     	= addslashes(trim($_POST['txtdesc']));
		$prior    	= glb_func_chkvl($_POST['txtprty']);
		// $cattyp    	= glb_func_chkvl($_POST['lstcattyp']);
		// $disptyp    = glb_func_chkvl($_POST['lstdsplytyp']);
		$seotitle   = glb_func_chkvl($_POST['txtseotitle']);
		$seodesc  	= glb_func_chkvl($_POST['txtseodesc']);
		$seokywrd   = glb_func_chkvl($_POST['txtseokywrd']);
		$seoh1 		= glb_func_chkvl($_POST['txtseoh1']);
		$seoh2 		= glb_func_chkvl($_POST['txtseoh2']);
		$sts      	= $_POST['lststs'];
		$dt       	= date('Y-m-d h:i:s');
		
	  	$sqryprodcat_mst = "select 
								yearsm_name 
					      	from 
						    	years_mst
					      	where 
						  		 yearsm_name ='$name'"; 
		$srsprodcat_mst = mysqli_query($conn,$sqryprodcat_mst);
			$cntrec_cat     = mysqli_num_rows($srsprodcat_mst);
		if($cntrec_cat < 1){
			// if(isset($_FILES['flebnrimg']['tmp_name']) && ($_FILES['flebnrimg']['tmp_name'] != "")){					
			// 	$bimgval = funcUpldImg('flebnrimg','bimg');
			// 	if($bimgval != ""){
			// 		$bimgary    = explode(":",$bimgval,2);
			// 		$bdest 		= $bimgary[0];					
			// 		$bsource 	= $bimgary[1];					
			// 	}						
			// }	
			  $iqryprodcat_mst="insert into years_mst(
						      yearsm_name,yearsm_desc,
							  yearsm_seotitle,yearsm_seodesc,
							  yearsm_seokywrd,
							  yearsm_seohone,yearsm_seohtwo,yearsm_sts,yearsm_prty,
							  yearsm_crtdon,yearsm_crtdby)values(							  
						      '$name','$desc','$seotitle','$seodesc','$seokywrd',
							  '$seoh1','$seoh2','$sts','$prior',
							  '$dt','$ses_admin')";	
							  //echo 	$iqryprodcat_mst;exit;	
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