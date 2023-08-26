<?php

include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth;
global $ses_admin;

if(
    isset($_POST['btnesrchlmtssbmt']) && (trim($_POST['btnesrchlmtssbmt']) != "") &&
    isset($_POST['edtpdctid']) && (trim($_POST['edtpdctid']) != "") && 
    isset($_POST['txtprty']) && (trim($_POST['txtprty']) != ""))
	  {	
        
	   
		$id 	  	= glb_func_chkvl($_POST['edtpdctid']);
		$name     	= glb_func_chkvl($_POST['txtname']);
		$prior    	= glb_func_chkvl($_POST['txtprty']);
		$desc     	= addslashes(trim($_POST['txtcount']));
		
	    $pg			= glb_func_chkvl($_REQUEST['pg']);
       
		$sts      	= glb_func_chkvl($_POST['lststs']);
		$optn 		= glb_func_chkvl($_REQUEST['optn']);
		$val        = glb_func_chkvl($_REQUEST['txtsrchval']);
		$vltyp 		= glb_func_chkvl($_REQUEST['lsttyp']);
		$ctdstyp	= glb_func_chkvl($_REQUEST['lstdstyp']);
		$chk 		= glb_func_chkvl($_REQUEST['chkexact']);
		$curdt      = date('Y-m-d h:i:s');
		$cntstart   = glb_func_chkvl($_POST['hdncnt']);	
		
		$rd_vwpgnm   = "view_srchlmts.php";
		
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
		
			 $uqryprodcat_mst= "UPDATE srchlmts_mst set 
								
								srchlmt_sts='$sts',
								srchlmt_count='$desc', 
								srchlmt_prty ='$prior',
								srchlmt_mdfdon ='$curdt',
								srchlmt_mdfdby='$ses_admin'";
			
			$uqryprodcat_mst .= "where srchlmt_id=$id";
			$ursprodmncat_mst = mysqli_query($conn,$uqryprodcat_mst);
			if($ursprodmncat_mst==true){
                $gmsg = "Record Update successfully";	
			?>
			  <script type="text/javascript">
              
				location.href="<?php echo $rd_vwpgnm;?>?edtpdctid=<?php echo $id;?>&pg=<?php echo $pg;?>&sts=y&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>
              
			<?php
              
			}
			else{
                $gmsg = "Record Not Updated";	
			?>
			  <script type="text/javascript">
			  location.href="<?php echo $rd_vwpgnm;?>?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?><?php echo $srchval;?>";</script>		
		<?php
			}
		
	}
	?>