<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth;
global $ses_admin;
	if(isset($_POST['btneyearssbmt']) && (trim($_POST['btneyearssbmt']) != "") && 	
	   isset($_POST['txtname'])  &&  (trim($_POST['txtname']) != "") && 
	   isset($_POST['edtpdctid']) && (trim($_POST['edtpdctid']) != "") && 
	   isset($_POST['txtprty']) && (trim($_POST['txtprty']) != ""))
	  {	
	   
		$id 	  	= glb_func_chkvl($_POST['edtpdctid']);
		$name     	= glb_func_chkvl($_POST['txtname']);
		$prior    	= glb_func_chkvl($_POST['txtprty']);
		$desc     	= addslashes(trim($_POST['txtdesc']));
		// $hdnbgimg	= glb_func_chkvl($_POST['hdnbgimg']);
		// $cattyp    	= glb_func_chkvl($_POST['lstcattyp']);
		// $disptyp  	= glb_func_chkvl($_POST['lstdsplytyp']);
		$title    	= glb_func_chkvl($_POST['txtseotitle']);
		$seodesc  	= glb_func_chkvl($_POST['txtseodesc']);
		$key      	= glb_func_chkvl($_POST['txtseokywrd']);
		$seoh1 	  	= glb_func_chkvl($_POST['txtseoh1']);
		$seoh2 	  	= glb_func_chkvl($_POST['txtseoh2']);
	    $pg			= glb_func_chkvl($_REQUEST['pg']);
       
		$sts      	= glb_func_chkvl($_POST['lststs']);
		$optn 		= glb_func_chkvl($_REQUEST['optn']);
		$val        = glb_func_chkvl($_REQUEST['txtsrchval']);
		$vltyp 		= glb_func_chkvl($_REQUEST['lsttyp']);
		$ctdstyp	= glb_func_chkvl($_REQUEST['lstdstyp']);
		$chk 		= glb_func_chkvl($_REQUEST['chkexact']);
		$curdt      = date('Y-m-d h:i:s');
		$cntstart   = glb_func_chkvl($_POST['hdncnt']);	
		
		$rd_vwpgnm   = "view_years.php";
		
		if(isset($_REQUEST['chkexact']) && $_REQUEST['chkexact']=='y'){
		  $chk="&chkexact=y";
		}
		if($optn != "" && $val != ""){
			$srchval= "&txtsrchval=".$val.$chk;
		}
		if($optn != "" && $vltyp != ""){
			$srchval = "&optn=".$optn."&lsttyp=".$vltyp;	
		}
		if($optn != "" && $ctdstyp != ""){
			$srchval = "&optn=".$optn."&lstdstyp=".$ctdstyp;	
		}
		$sqryprodcat_mst="select 
								yearsm_name 
		                  from 
						  		years_mst
					      where 
						  		yearsm_name='$name' and 
						   		yearsm_id != $id";
		$srsprodcat_mst = mysqli_query($conn,$sqryprodcat_mst);
		$rows_cnt       = mysqli_num_rows($srsprodcat_mst);
		if($rows_cnt > 0){
		?>
		    <script type="text/javascript">
			location.href="<?php echo $rd_vwpgnm;?>?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>
		<?php
		}
		else{
			 $uqryprodcat_mst= "update years_mst set 
								yearsm_name='$name',
								yearsm_sts='$sts',
								yearsm_desc='$desc', 
								yearsm_seotitle='$title',
								yearsm_seodesc='$seodesc',
								yearsm_seokywrd='$key',
								yearsm_seohone='$seoh1',
								yearsm_seohtwo='$seoh2',
								yearsm_prty ='$prior',
								yearsm_mdfdon ='$curdt',
								yearsm_mdfdby='$ses_admin'";
			//  if(isset($_FILES['flebnrimg']['tmp_name']) && ($_FILES['flebnrimg']['tmp_name'] != "")){							
			// 	$bimgval = funcUpldImg('flebnrimg','bimg');
			// 	if($bimgval != ""){
			// 		$bimgary    = explode(":",$bimgval,2);
			// 		$bdest 		= $bimgary[0];					
			// 		$bsource 	= $bimgary[1];					
			// 	}						
			// 		$uqryprodcat_mst .= ",yearsm_bnrimg='$bdest'";
			// }
			// else{			
			// 	if(isset($_POST['chkbximg']) && ($_POST['chkbximg'] != "")){
			// 		$delimgnm   = glb_func_chkvl($_POST['chkbximg']);	
			// 		$delimgpth  = $a_mnlnks_bnrfldnm.$delimgnm;								
			// 		if(isset($delimgnm) && file_exists($delimgpth)){
			// 			unlink($delimgpth);											
			// 			$uqryprodcat_mst .= ",yearsm_bnrimg=''";
			// 		}					
			// 	}				
			// }
			$uqryprodcat_mst .= "where yearsm_id=$id";
			$ursprodmncat_mst = mysqli_query($conn,$uqryprodcat_mst);
			if($ursprodmncat_mst==true){
				if(($bsource!='none') && ($bsource!='') && ($bdest != "")){ 
					$bgimgpth      = $a_mnlnks_bnrfldnm.$hdnbgimg;
					if(($hdnbgimg != '') && file_exists($bgimgpth)){
						unlink($bgimgpth);
					}
					move_uploaded_file($bsource,$a_mnlnks_bnrfldnm.$bdest);	
				}	
			?>
			  <script type="text/javascript">
				location.href="<?php echo $rd_vwpgnm;?>?vw=<?php echo $id;?>&pg=<?php echo $pg;?>&sts=y&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>
			<?php
			}
			else{
			?>
			  <script type="text/javascript">
			  location.href="<?php echo $rd_vwpgnm;?>?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>		
		<?php
			}
		}
	}
	?>