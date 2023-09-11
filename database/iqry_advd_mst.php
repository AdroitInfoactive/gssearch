<?php	
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session 
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
if(isset($_POST['btnadvdsbmt']) && (trim($_POST['btnadvdsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$name = glb_func_chkvl($_POST['txtname']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$prior = glb_func_chkvl($_POST['txtprior']);
	$dadvdimg = glb_func_chkvl($_POST['fledadvdimg']);
	$madvdimg = glb_func_chkvl($_POST['flemadvdimg']);
	$link = glb_func_chkvl($_POST['txtlnk']);
	$sts = glb_func_chkvl($_POST['lststs']);
	// $align = glb_func_chkvl($_POST['txtalin']);
	$curdt = date('Y-m-d h-i-s');
	$sqryadvd_mst = "SELECT advdm_name from advd_mst where advdm_name ='$name'";
	$srsadvd_mst = mysqli_query($conn,$sqryadvd_mst);
	$rows = mysqli_num_rows($srsadvd_mst);
	if($rows < 1)
	{
		if(isset($_FILES['fledadvdimg']['tmp_name']) && ($_FILES['fledadvdimg']['tmp_name']!=""))
		{
			$dadvdimgval = funcUpldImg('fledadvdimg','dadvdimg');
			if($dadvdimgval != "")
			{
				$dadvdimgary = explode(":",$dadvdimgval,2);
				$dadvddest = $dadvdimgary[0];
				$dadvdsource = $dadvdimgary[1];
			}
		}
		  $iqryadvd_mst="INSERT into advd_mst(advdm_name, advdm_desc, advdm_prty, advdm_sts, advdm_dimgnm,advdm_crtdon, advdm_crtdby) values ('$name', '$desc','$prior', '$sts', '$dadvddest','$curdt', '$ses_admin')"; 
		$irsadvd_mst= mysqli_query($conn,$iqryadvd_mst) or die(mysqli_error($conn));
		if($irsadvd_mst==true)
		{
			if(($dadvdsource!='none') && ($dadvdsource!='') && ($dadvddest != ""))
			{ 			
				move_uploaded_file($dadvdsource,$gadvd_fldnm.$dadvddest);					
			}
			$gmsg = "Record saved successfully";
		}
		else
		{
			$gmsg = "Record not saved";
		}
	}
	else
	{		
		$gmsg = "Duplicate name. Record not saved";
	}
}
?>