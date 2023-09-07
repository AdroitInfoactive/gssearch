<?php
 
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth;
global $ses_admin;
	if(isset($_POST['btneuserssbmt']) && (trim($_POST['btneuserssbmt']) != "") &&
  isset($_POST['edtpdctid']) && (trim($_POST['edtpdctid']) != "") && 	
	   isset($_POST['txtname'])  &&  (trim($_POST['txtname']) != "")&& 	
	   isset($_POST['hdnpwd'])  &&  (trim($_POST['txtname']) != ""))
	  {	
      
	   
	$id 	  	= glb_func_chkvl($_POST['edtpdctid']);
	$name     	= glb_func_chkvl($_POST['txtname']);
  $type 		= glb_func_chkvl($_REQUEST['txttyp']);
		$prior    	= glb_func_chkvl($_POST['txtprty']);
		if ($_POST['hdnpwd'] !='' && $_POST['txtpwd'] !='' && ($_POST['hdnpwd'] != $_POST['txtpwd']))
		{
			$pwd = md5(glb_func_chkvl($_POST['txtpwd']));
		}
		else
		{
			$pwd = glb_func_chkvl($_POST['hdnpwd']);
		}
       
		$sts      	= glb_func_chkvl($_POST['lststs']);
		$optn 		= glb_func_chkvl($_REQUEST['optn']);
		$val        = glb_func_chkvl($_REQUEST['txtsrchval']);

		$ctdstyp	= glb_func_chkvl($_REQUEST['lstdstyp']);
		$chk 		= glb_func_chkvl($_REQUEST['chkexact']);
		$curdt      = date('Y-m-d h:i:s');
		$cntstart   = glb_func_chkvl($_POST['hdncnt']);	
		
		$rd_vwpgnm   = "view_detail_users.php";
		
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
    lgnm_uid 
		                  from 
                      lgn_mst
					      where 
                lgnm_uid='$name' and 
                lgnm_id != $id"; 
		$srsprodcat_mst = mysqli_query($conn,$sqryprodcat_mst);
		$rows_cnt       = mysqli_num_rows($srsprodcat_mst);
		if($rows_cnt > 0){
		?>
		    <script type="text/javascript">
			location.href="<?php echo $rd_vwpgnm;?>?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>
		<?php
		}
		else{
			 $uqryprodcat_mst= "update lgn_mst set 
       lgnm_uid='$name',
       lgnm_pwd='$pwd',
       lgnm_sts='$sts',
       lgnm_crtdon ='$curdt',
       lgnm_crtdby='$ses_admin'"; 
			//  if(isset($_FILES['flebnrimg']['tmp_name']) && ($_FILES['flebnrimg']['tmp_name'] != "")){							
			// 	$bimgval = funcUpldImg('flebnrimg','bimg');
			// 	if($bimgval != ""){
			// 		$bimgary    = explode(":",$bimgval,2);
			// 		$bdest 		= $bimgary[0];					
			// 		$bsource 	= $bimgary[1];					
			// 	}						
			// 		$uqryprodcat_mst .= ",lgnm_bnrimg='$bdest'";
			// }
			// else{			
			// 	if(isset($_POST['chkbximg']) && ($_POST['chkbximg'] != "")){
			// 		$delimgnm   = glb_func_chkvl($_POST['chkbximg']);	
			// 		$delimgpth  = $a_mnlnks_bnrfldnm.$delimgnm;								
			// 		if(isset($delimgnm) && file_exists($delimgpth)){
			// 			unlink($delimgpth);											
			// 			$uqryprodcat_mst .= ",lgnm_bnrimg=''";
			// 		}					
			// 	}				
			// }
			$uqryprodcat_mst .= "where lgnm_id=$id";
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