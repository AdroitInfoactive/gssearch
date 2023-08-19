<?php
error_reporting(0);
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_connection.php';//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more 
	include_once '../includes/inc_config.php';
	include_once '../includes/inc_folder_path.php';		

	/***************************************************************/
	//Programm 	  : edit_pagecontain.php	 
	//Created By  : 
	//Created On  :	
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/	
	global $id,$pg,$cntstart,$loc,$rd_crntpgnm;
	
	 $rd_crntpgnm = "view_all_pagecontain.php";
	 $rd_vwpgnm   = "view_pagecontain_detail.php";
	 $rd_edtpgnm  = "edit_pagecontain.php";
	 $clspn_val   = "4";
	 
	if(isset($_POST['btnedtphcntn']) && (trim($_POST['btnedtphcntn']) != "") && 	
	   isset($_POST['txtname']) && (trim($_POST['txtname']) != "") &&
	   isset($_POST['lstcat1']) && (trim($_POST['lstcat1']) != "") &&
	   isset($_REQUEST['edtpgcntid']) && (trim($_REQUEST['edtpgcntid'])!= "")){
	    $arycatone     = glb_func_chkvl($_POST['lstcat1']);
		$chkdept     =explode('-',$arycatone);
		$rqst_lstdept     = glb_func_chkvl($_POST['lstdept']);
		//if((($chkdept[1]=='d') && ($rqst_lstdept !='')) || ($chkdept[1]=='g') || ($chkdept[1]=='n')){
		
			include_once "../includes/inc_fnct_fleupld.php"; // For uploading files	
			include_once "../database/uqry_pgcnts_dtl.php";
		//}
	}
	if(isset($_REQUEST['edtpgcntid']) && trim($_REQUEST['edtpgcntid'])!="" &&
	   isset($_REQUEST['pg']) && trim($_REQUEST['pg'])!="" &&
	   isset($_REQUEST['cntstart']) && trim($_REQUEST['cntstart'])!=""){
		$id 	  = glb_func_chkvl($_REQUEST['edtpgcntid']);
		$pg 	  = glb_func_chkvl($_REQUEST['pg']);
		$cntstart = glb_func_chkvl($_REQUEST['cntstart']);
		$optn 	  = glb_func_chkvl($_REQUEST['optn']);
		$val 	  = glb_func_chkvl($_REQUEST['txtsrchval']);
		$lstctone = glb_func_chkvl($_REQUEST['lstcatone']);
		$lstcttwo = glb_func_chkvl($_REQUEST['lstcattwo']);
		$lstdpt   = glb_func_chkvl($_REQUEST['lstdept']);
		$chk	  = glb_func_chkvl($_REQUEST['chkexact']);
				
		if($optn !="" && $val != ""){
			$loc = "&optn=".$optn."&txtsrchval=".$val;	
		}
		if($chk == "y"){
			$loc .= "&chkexact=".$chk;
		}
		if($optn !="" && $lstctone != ""){
			$loc = "&optn=".$optn."&lstcatone=".$lstctone;			
		}
		if($optn !="" && $lstcttwo != ""){
			$loc = "&optn=".$optn."&lstcattwo=".$lstcttwo;			
		}
		if($optn !="" && $lstdpt != ""){
			$loc = "&optn=".$optn."&lstdept=".$lstdpt;			
		}
	
		$sqrypgcnts_dtl="select 
							pgcntsd_id,pgcntsd_name,pgcntsd_desc,pgcntsd_lnk,
							pgcntsd_prodcatm_id,pgcntsd_fle,pgcntsd_prodscatm_id,pgcntsd_typ,
							pgcntsd_sts,pgcntsd_prty,prodcatm_name,prodscatm_name,
							pgcntsd_seotitle,pgcntsd_seodesc,pgcntsd_seokywrd,pgcntsd_seohone,
							pgcntsd_seohtwo,pgcntsd_deptm_id,pgcntsd_bnrimg
						 from 
							vw_pgcnts_prodcat_prodscat_mst					  							
						 where 
							pgcntsd_id=$id";
		$srspgcnts_dtl  = mysqli_query($conn,$sqrypgcnts_dtl);
		$cntrec_pgcnts = mysqli_num_rows($srspgcnts_dtl);
		if($cntrec_pgcnts  > 0){
		$rowspgcnts_dtl 	  = mysqli_fetch_assoc($srspgcnts_dtl);
			$db_pgscatid	  = $rowspgcnts_dtl['pgcntsd_prodscatm_id'];
			$db_catname		  = $rowspgcnts_dtl['prodcatm_name'];
			$db_scatname	  = $rowspgcnts_dtl['prodscatm_name'];
			$db_pgcntname	  = $rowspgcnts_dtl['pgcntsd_name'];
			$db_pgcntdesc	  = stripslashes($rowspgcnts_dtl['pgcntsd_desc']);
			$db_pgcntlnk	  = $rowspgcnts_dtl['pgcntsd_lnk'];
			$db_pgcntfl		  = $rowspgcnts_dtl['pgcntsd_fle'];
			$db_pgcntseottl	  = trim($rowspgcnts_dtl['pgcntsd_seotitle']);
			$db_pgcntseodesc  = trim($rowspgcnts_dtl['pgcntsd_seodesc']);
			$db_pgcntseokywrd = trim($rowspgcnts_dtl['pgcntsd_seokywrd']);
			$db_pgcntseohone  = trim($rowspgcnts_dtl['pgcntsd_seohone']);
			$db_pgcntseohtwo  = trim($rowspgcnts_dtl['pgcntsd_seohtwo']);
			$db_pgcntprty	  = $rowspgcnts_dtl['pgcntsd_prty'];
			$db_pgcntsts	  = $rowspgcnts_dtl['pgcntsd_sts'];
			$db_pgcntsdype     = $rowspgcnts_dtl['pgcntsd_typ'];
		}
		else{
			header("Location:".$rd_crntpgnm);
			exit();
		}
		
		if(isset($_REQUEST['imgid']) && (trim($_REQUEST['imgid']) != "") && 	
		   isset($_REQUEST['edtpgcntid']) && (trim($_REQUEST['edtpgcntid']) != "") ){
		   
			$imgid      = glb_func_chkvl($_REQUEST['imgid']);
			$pgdtlid    = glb_func_chkvl($_REQUEST['edtpgcntid']);	   
			$pg         = glb_func_chkvl($_REQUEST['pg']);
			$cntstart   = glb_func_chkvl($_REQUEST['cntstart']);
			$sqrypgimgd_dtl="select 
								  pgimgd_img
							 from 
								  pgimg_dtl
							 where
								  pgimgd_pgcntsd_id='$pgdtlid'  and
								  pgimgd_id = '$imgid'";				 				 				 				 			
			 $srspgimgd_dtl     = mysqli_query($conn,$sqrypgimgd_dtl);
			 $srowpgimgd_dtl    = mysqli_fetch_assoc($srspgimgd_dtl);		     			   				
			 $smlimg[$i]      = glb_func_chkvl($srowpgimgd_dtl['pgimgd_img']);
			 $smlimgpth[$i]   = $a_phtgalspath.$smlimg[$i];
			 $delimgsts = funcDelAllRec($conn,'pgimg_dtl','pgimgd_id',$imgid);
			 if($delimgsts == 'y'  ){
				 if(($smlimg[$i] != "") && file_exists($smlimgpth[$i])) {
						unlink($smlimgpth[$i]);
				 }			
			}
		}
	}
	else{
		header("Location:".$rd_crntpgnm);
		exit();
	}
	
	$rqst_stp      	= $rqst_arymdl[1];
	$rqst_stp_attn     = explode("::",$rqst_stp);
	$rqst_stp_chk      	= $rqst_arymdl[0];
	$rqst_stp_attn_chk     = explode("::",$rqst_stp_chk);
	if($rqst_stp_attn_chk[0] =='2'){
		$rqst_stp      	= $rqst_arymdl[0];
		$rqst_stp_attn     = explode("::",$rqst_stp);
	}
	
	$sesvalary = explode(",",$_SESSION['sesmod']);
	if(!in_array(2,$sesvalary) || ($rqst_stp_attn[1]=='1') || ($rqst_stp_attn[1]=='2')){
	 	if($ses_admtyp !='a'){
			header("Location:main.php");
			exit();
		}
	}
	
	$rqst_stp      	= $rqst_arymdl[1];
	$rqst_stp_attn     = explode("::",$rqst_stp);
	$rqst_stp_chk      	= $rqst_arymdl[0];
	$rqst_stp_attn_chk     = explode("::",$rqst_stp_chk);
	if($rqst_stp_attn_chk[0] =='2'){
		$rqst_stp      	= $rqst_arymdl[0];
		$rqst_stp_attn     = explode("::",$rqst_stp);
	}
	$sesvalary = explode(",",$_SESSION['sesmod']);
	if(!in_array(2,$sesvalary) || ($rqst_stp_attn[1]=='1')){
	 	if($ses_admtyp !='a'){
			header("Location:main.php");
			exit();
		}
	}	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $pgtl;?></title>
	<script language="javascript" src="../includes/yav.js"></script>
    <script language="javaScript" type="text/javascript" src="js/ckeditor.js"></script>    
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
		var rules=new Array();
		rules[1]='lstcat1:Categoryone Name|required|Select Category name';
    	rules[4]='txtname:Name|required|Enter name';
    	rules[5]='txtprty:Rank|required|Enter Rank';
		rules[6]='txtprty:Rank|numeric|Enter Only Numbers';
		/*function chkDept(){
			var deptsts = (document.getElementById('lstdept').disabled);
			var catoneid = (document.getElementById('lstcat1').value);
			cat_ary 	= Array();
			cat_ary	 	= catoneid.split("-");	
			if(cat_ary[1] =='d'){
				rules[3]='lstdept:Department Name|required|Select Department';
				document.getElementById('lstdept').disabled=false;
				
			}
			else{
				document.getElementById('lstdept').disabled=true;
				document.getElementById('lstdept').value="";
				document.getElementById("errorsDiv_lstdept").innerHTML = "";
			}
			return false;
		}*/
	</script>
	<?php
		include_once ('script.php');
		include_once "../includes/inc_fnct_ajax_validation.php"; //Includes ajax validations				
	?>	
	<script language="javascript">	
		function setfocus(){
			document.getElementById('txtname').focus();
		}
	</script>
<script language="javascript" type="text/javascript">
	function funcChkDupName(){
		<?php /*?>var pgcntid= <?php echo $id ;?>;
		var pagcntnname;
		pagcntnname = document.getElementById('txtname').value;
		catid = document.getElementById('lstcatone').value;
		if(pagcntnname != ""){
			var url = "chkvalidname.php?pagcntnname="+name+"&catid="+catid+"&pgcntid="+id;
			xmlHttp	= GetXmlHttpObject(funcpgcnthnstatChngd);
			xmlHttp.open("GET", url , true);
			xmlHttp.send(null);
		}<?php */?>
		var pagcntnname,pgcntid,catname;
			pgcntid= <?php echo $id ;?>;
			catname = document.getElementById('lstcat1').value;	
			scatname = document.getElementById('lstcat2').value;	
			pagcntnname = document.getElementById('txtname').value;	
			deptidval	= "";
			if(document.getElementById('lstdept').disabled == false){
				deptidval	= document.getElementById('lstdept').value;
			}										
			if((pagcntnname != "") && (pgcntid != "") && (catname !="")){
				var url = "chkduplicate.php?pagcntnname="+pagcntnname+"&pgcntid="+pgcntid+"&catname="+catname+"&scatname="+scatname+"&deptid="+deptidval;
				xmlHttp	= GetXmlHttpObject(funcpgcnthnstatChngd);
				xmlHttp.open("GET", url , true);
				xmlHttp.send(null);				
			}
		else{
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}	
	 }
	function funcpgcnthnstatChngd(){ 
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 	
			var temp=xmlHttp.responseText;
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if(temp!=0){
			//alert(temp);
			document.getElementById('txtname').focus();
			}		
		}
	}
	function rmvimg(imgid){
			var img_id;
			img_id = imgid;
			if(img_id !=''){
				var r=window.confirm("Do You Want to Remove Image");
				if (r==true){						
					 x="You pressed OK!";
				  }
				else
				  {
					  return false;
				  }	
        	}
			document.frmedtpgcntn.action="<?php echo $rd_edtpgnm;?>?edtpgcntid=<?php echo $id;?>&imgid="+img_id+"&pg=<?php echo $pg;?>&cntstart=<?php echo $cntstart.$loc;?>" 
			document.frmedtpgcntn.submit();	
		}
	function funcRmvOptn(prmtrCntrlnm){			
		if(prmtrCntrlnm!= ''){			
			var lstCntrlNm, optnLngth;
			lstCntrlNm = prmtrCntrlnm;
			optnLngth = document.getElementById(lstCntrlNm).options.length;
			for(incrmnt = optnLngth-1; incrmnt > 0; incrmnt--){
				document.getElementById(lstCntrlNm).options.remove(incrmnt);
			}
		}
	}	
	function funcAddOptn(prmtrCntrlnm,prmtrOptn){
		tempary 	= Array();
		tempary	 	= prmtrOptn.split(",");						
		cntrlary  	= 0;
		var id 	  	= "";
		var name  	= "";
		var selstr 	= "";
		var optn   	= "";	
		for(var inc = 0; inc < (tempary.length); inc++){
			cntryary 	= tempary[inc].split(":");
			id 		 	= cntryary[0];
			name 	 	= cntryary[1];
			//optn 	 	= document.createElement("OPTION");					
			//optn.value 	= id;					
			//optn.text 	= name;
			//var newopt	= new Option(name,id);
			hdnprodscatid  = document.getElementById('hdnprodscatid').value;
			var newopt=new Option(name,id);
			if(id==hdnprodscatid)
		    {
			  newopt.selected="selected";
			}
			document.getElementById(prmtrCntrlnm).options[inc+1] = newopt;
		}		
	}		
	function funcDspScat(){      
	  var catid;
		catid = document.getElementById('lstcat1').value;
			
		if(catid!=""){
			var url = "../includes/inc_getScat.php?selprodcatid="+catid;
			xmlHttp	=  GetXmlHttpObject(funscatval);
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
			
			
		}
		else{
			funcRmvOptn('lstcat2');				
		}
	}	
	function funscatval(){ 	
		if(xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 								
			funcRmvOptn('lstcat2');							
			var temp = xmlHttp.responseText;
			
			if(temp != ""){			
				funcAddOptn('lstcat2',temp);																														
			}		
		}
	}	
</script>
</head>
<body >
<?php 
	include_once('../includes/inc_adm_header.php');
	include_once ('../includes/inc_adm_leftlinks.php');
?>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0" class="leftlinks_bdr">
      <tr>
        <td width="7" height="30" valign="top">
		</td>
        <td width="700" height="325" rowspan="2" valign="top" background="images/content_topbg.gif" bgcolor="#FFFFFF"
		  style="background-position:top; background-repeat:repeat-x; ">
		<span class="maintitles">Edit Pagecontents</span><br>
          <br>
          
		  <form name="frmedtpgcntn" id="frmedtpgcntn" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return performCheck('frmedtpgcntn', rules, 'inline');" enctype="multipart/form-data">
		  <table width="95%"  border="0" cellspacing="1" cellpadding="3" align='center'>
		  <input type="hidden" name="edtpgcntid" id="edtpgcntid" value="<?php echo $id;?>">
		  <input type="hidden" name="pg" id="pg" value="<?php echo $pg;?>">
		  <input type="hidden" name="cntstart" id="cntstart" value="<?php echo $cntstart;?>">
		  <input type="hidden" name="optn" id="optn" value="<?php echo $optn;?>">
		  <input type="hidden" name="txtsrchval" id="txtsrchval" value="<?php echo $val;?>">
		  <input type="hidden" name="lstcatone" id="lstcatone" value="<?php echo $lstctone;?>">
		  <input type="hidden" name="lstcattwo" id="lstcattwo" value="<?php echo $lstcttwo;?>">
		  <input type="hidden" name="hdnlstdept" id="hdnlstdept" value="<?php echo $lstdpt;?>">
		  <input type="hidden" name="hdnprodscatid" id="hdnprodscatid" value="<?php echo $db_pgscatid;?>">
		  <input type="hidden" name="hdnevntnm" id="hdnevntnm" value="<?php echo $db_pgcntfl?>">
		  <input type="hidden" name="hdnbgimg" id="hdnbgimg" value="<?php echo $rowspgcnts_dtl['pgcntsd_bnrimg'];?>">
		 		<input type="hidden" name="lstchkdept" id="lstchkdept">  
                
                	   <input type="hidden" name="hdnprodscatid" id="hdnprodscatid" value="<?php echo $rowspgcnts_dtl['pgcntsd_prodcatm_id']; ?>">
              <input type="hidden" name="hdnprodfnscatid" id="hdnprodfnscatid" value="<?php echo $rowspgcnts_dtl['pgcntsd_prodscatm_id']; ?>"> 
              
                 
				<tr bgcolor="#FFFFFF">
                       <td bgcolor="#f1f6fd"> <strong>Category</strong> </td>
					   <td bgcolor="#f1f6fd"><strong>:</strong></td>
                       <td bgcolor="#f1f6fd">
					   <select name="lstcat1" id="lstcat1" onchange="funcDspScat(),chkDept();" style="width:240px">
                              <option value="">--Category--</option>
                              <?php
								 $sqrycatone_mst = "select 
														prodcatm_id,prodcatm_name,prodcatm_typ
													from 
														prodcat_mst
													where 
														prodcatm_sts='a'";
								if($ses_admtyp =='u'){
									$sqrycatone_mst .=" and prodcatm_typ='d'";
								} 
								$sqrycatone_mst .=" order by prodcatm_name";								
								$srscatone_mst= mysqli_query($conn,$sqrycatone_mst) or die(mysqli_error());
								while($rowscatone_mst = mysqli_fetch_assoc($srscatone_mst))
								{
									$dbprodcat_typ 	= $rowscatone_mst['prodcatm_typ'];
								?>
                              <option value="<?php echo $rowscatone_mst['prodcatm_id']?>-<?php echo $dbprodcat_typ;?>"
								<?php if(isset($_POST['lstcat1']) && (trim($_POST['lstcat1'])!="")){
										echo 'selected';
									  }
									  elseif($rowscatone_mst['prodcatm_id'] ==  $rowspgcnts_dtl['pgcntsd_prodcatm_id']){
										echo 'selected';							  
									  }					
								?>> <?php echo $rowscatone_mst['prodcatm_name']?></option>
							<?php
							}
							?>
						</select>
				  </td>
                   <td bgcolor="#f1f6fd" style="color:#FF0000"><span id="errorsDiv_lstcat1"></span></td>
                </tr>
				<tr bgcolor="#FFFFFF">
                      <td bgcolor="#f1f6fd"> <strong>Subcategory</strong> </td>
					  <td bgcolor="#f1f6fd"><strong>:</strong></td>
                      <td bgcolor="#f1f6fd">
						 <select name="lstcat2" id="lstcat2" style="width:200px" >
			  			
                                  <?php
								  
								echo $scatids = $rowspgcnts_dtl['pgcntsd_prodscatm_id'];
								 $sqryscatone_mst = "select 
							   		prodscatm_id,prodscatm_name
								from 
									vw_prodcat_prodscat_mst
													where 
														prodscatm_id='$scatids'";
								
															
								$srsscatone_mst= mysqli_query($conn,$sqryscatone_mst) or die(mysqli_error());
								while($rowsscatone_mst = mysqli_fetch_assoc($srsscatone_mst))
								{
									
								?>
                              <option value="<?php echo $rowsscatone_mst['prodscatm_id']?>"
								<?php
						if($rowsscatone_mst['prodscatm_id'] ==  $rowspgcnts_dtl['pgcntsd_prodscatm_id']){
										echo 'selected';							  
									  }					
								?>> <?php echo $rowsscatone_mst['prodscatm_name']?></option>
							<?php
							}
							?>
                            
		   				 </select>	
					 </td>
					 <td bgcolor="#f1f6fd" style="color:#FF0000"><span id="errorsDiv_lstcat2"></span></td>
                </tr>
				<input type="hidden" name='lstdept' id='lstdept'>
				<?php /*?><tr bgcolor="#FFFFFF">
                       <td bgcolor="#f1f6fd"> <strong>Department</strong> </td>
					   <td bgcolor="#f1f6fd"><strong>:</strong></td>
                       <td bgcolor="#f1f6fd">
					   <select name="lstdept" id="lstdept" style="width:240px" >
                              <option value="">--Department--</option>
                              <?php
							  
								  $sqrydept_mst = "select 
														deptm_id,deptm_name
													from 
														dept_mst
													where 
														deptm_sts='a'"; 
									if($ses_admtyp =='u'){
										$sqrydept_dtl ="select 
															deptd_deptm_id
														from
															lgn_mst
															inner join dept_dtl on lgnm_id  = deptd_lgnm_id
															inner join dept_mst on deptm_id   = deptd_deptm_id 	
														where
															deptd_lgnm_id ='$ses_adminid'";
											
										$srrsdept_dtl = mysqli_query($conn,$sqrydept_dtl);
										$cntrec_deptdtl = mysqli_num_rows($srrsdept_dtl);
										if($cntrec_deptdtl > 0){
											$srodept_drl = mysqli_fetch_assoc($srrsdept_dtl);
											$deptid = $srodept_drl['deptd_deptm_id'];
											$sqrydept_mst .=" and deptm_id = $deptid";
										}
									}
									$sqrydept_mst .=" order by deptm_name";								
								 $srsdept_mst= mysqli_query($conn,$sqrydept_mst) or die(mysqli_error());								
								 while($rowsdept_mst = mysqli_fetch_assoc($srsdept_mst)){ 
					   			 $slctd="";
								 if($rowsdept_mst['deptm_id'] ==  $rowspgcnts_dtl['pgcntsd_deptm_id']){
										 $slctd="selected";
								}
					    
								?>
        						 <option value="<?php echo $rowsdept_mst['deptm_id']; ?>" <?php echo $slctd;  ?>><?php echo $rowsdept_mst['deptm_name']; ?></option>
								<?php
								 }
								 ?>					 
					</select>
				  </td>
                   <td bgcolor="#f1f6fd" style="color:#FF0000"><div id="errorsDiv_lstdept"></div></td>
                </tr><?php */?>
				<tr bgcolor="#FFFFFF">
                <td width="17%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>Name</strong></td> 
				<td width="2%" bgcolor="#f1f6fd"><strong>:</strong></td> 
                <td width="51%" align="left" valign="middle" bgcolor="#f1f6fd">
					<input name="txtname" type="text" class="select" id="txtname" size="45" maxlength="240" value="<?php echo $db_pgcntname;?>" onBlur="funcChkDupName()"></td>
				<td width="30%" bgcolor="#f1f6fd" style="color:#FF0000"><span id="errorsDiv_txtname"></span></td>
			    </tr>
               <tr bgcolor="#FFFFFF">
				<td align="left" valign="top" bgcolor="#f1f6fd"><strong>Description</strong></td>
				<td width="2%" bgcolor="#f1f6fd" colspan="<?php echo $clspn_val -1;?>"><strong>:</strong></td> 
				</tr>
				<tr bgcolor="#FFFFFF">
                 	<td width="40%" colspan="<?php echo $clspn_val;?>" align="left" valign="top" bgcolor="#f1f6fd" >
						<textarea name="txtdesc" rows="6" cols="40" class="" id="txtdesc"><?php echo $db_pgcntdesc;?></textarea>
				    </td>
               </tr>
			   <tr bgcolor="#FFFFFF">
                <td width="17%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>Link</strong></td> 
				<td width="2%" bgcolor="#f1f6fd"><strong>:</strong></td> 
                <td width="51%" align="left" valign="middle" bgcolor="#f1f6fd">
					<input name="txtlnk" type="text" class="select" id="txtlnk" size="45" maxlength="240" value="<?php echo $db_pgcntlnk;?>"></td>
				<td width="30%" bgcolor="#f1f6fd" style="color:#FF0000"></td>
			    </tr>
				<tr bgcolor="#f1f6fd">
					<td width="23%" align="left" valign="top" bgcolor="#f1f6fd"><strong>Banner Image</strong></td>
                	<td width="2%" bgcolor="#f1f6fd" align="left" valign="top"><strong>:</strong></td>
                	<td width="30%" align="left" valign="top" bgcolor="#f1f6fd">
                 		 <input type="file" class="select" id="flebnrimg" name="flebnrimg">				
                 	</td>	
					<td width="82%" bgcolor="#f1f6fd" align="left" valign="top">
				  <?php
					$imgnm   = $rowspgcnts_dtl['pgcntsd_bnrimg'];
					$imgpath = $a_pgcnt_bnrfldnm.$imgnm;
					if(($imgnm !="") && file_exists($imgpath)){
						echo "<img src='$imgpath' width='80pixel' height='80pixel'><br><input type='checkbox' name='chkbximg' id='chkbximg' value='$imgpath'>Remove Iamge";					
					}
					else{
						echo "N.A.";						 			  
					}
					?>		
				</td>	 	
                </tr> 	
				<tr> 
					<td width="21%" align="left" valign="top" bgcolor="#f1f6fd"><strong>File</strong></td>
					<td width="2%" align="center" valign="top" bgcolor="#f1f6fd">:</td>
					<td width="38%" align="left" valign="middle" bgcolor="#f1f6fd">
					<input type="file" name="evntfle"  class="select" id="evntfle"></td>
					<td width="44%" bgcolor="#f1f6fd" colspan="<?php echo $clspn_val-2;?>">
					<?php
					  $evntflnm 	= $db_pgcntfl;
					  $evntflpath 	= $gevnt_fldnm.$id."-".$evntflnm;
					 if(($evntflnm !="") && file_exists($evntflpath)){
						echo "$evntflnm<br><input type='checkbox' name='chkbxfle' id='chkbxfle' value='$evntflnm'>
							  Remove File";						
					  }
					  else{
						 echo "File not available";
					  }
					 
					?>	
					</td>
															
			 </tr>
			 <tr bgcolor="#f1f6fd">
                	<td width="23%" align="left" valign="top" bgcolor="#f1f6fd"><strong>Type</strong> </td>
					<td width="2%" bgcolor="#f1f6fd" align="left" valign="top"><strong>:</strong></td> 
                 	<td width="30%" align="left" valign="top" bgcolor="#f1f6fd" colspan="<?php echo $clspn_val-2;?>">
						<select name="lsttyp" id="lsttyp">
							<option value="1"<?php if($db_pgcntsdype=='1') echo 'selected';?>>Page Content</option>
						 	<option value="2"<?php if($db_pgcntsdype=='2') echo 'selected';?>>Photo Gallery</option>	
							<option value="3"<?php if($db_pgcntsdype=='3') echo 'selected';?>>Video Gallery</option>						
						</select>
					</td>					
				</tr>
				<tr bgcolor="#FFFFFF">
                	<td width="13%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>SEO Title</strong></td>
					<td width="2%" bgcolor="#f1f6fd"><strong>:</strong></td> 
                 	<td width="42%" align="left" valign="middle" bgcolor="#f1f6fd" colspan="<?php echo $clspn_val-2;?>">
						<input name="txtseotitle" type="text" class="select" id="txtseotitle" size="45" maxlength="240" value="<?php echo $db_pgcntseottl;?>">
					</td>
                </tr>
				<tr bgcolor="#FFFFFF">
                	<td width="13%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>SEO Description</strong> </td>
					<td width="2%" bgcolor="#f1f6fd"><strong>:</strong></td> 
                 	<td width="42%" align="left" valign="middle" bgcolor="#f1f6fd" colspan="<?php echo $clspn_val-2;?>"><textarea name="txtseodesc" id="txtseodesc" cols="44" rows="6" class="select"><?php echo $db_pgcntseodesc;?></textarea>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
                	<td width="13%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>SEO Keyword</strong> </td>
					<td width="2%" bgcolor="#f1f6fd"><strong>:</strong></td> 
                 	<td width="42%" align="left" valign="middle" bgcolor="#f1f6fd" colspan="<?php echo $clspn_val-2;?>"><textarea name="txtseokywrd" id="txtseokywrd" cols="44" rows="6" class="select"><?php echo $db_pgcntseokywrd;?></textarea>
					</td>
                 	
				</tr>
				<tr bgcolor="#FFFFFF">
				   <td valign="top" bgcolor="#f1f6fd"><strong>SEO H1</strong></td>
				   <td align="center" valign="top" bgcolor="#f1f6fd"><strong>:</strong></td>
				   <td colspan="<?php echo $clspn_val-2;?>" align="left" valign="middle" bgcolor="#f1f6fd"><textarea name="txtseohone" id="txtseohtwo" cols="44" rows="6" class="select"><?php echo $db_pgcntseohone;?></textarea></td>
			    </tr>
				   <tr bgcolor="#FFFFFF">
				   <td valign="top" bgcolor="#f1f6fd"><strong>SEO H2</strong></td>
				   <td align="center" valign="top" bgcolor="#f1f6fd"><strong>:</strong></td>
				   <td colspan="<?php echo $clspn_val-2;?>" align="left" valign="middle" bgcolor="#f1f6fd"><textarea name="txtseohtwo" cols="44" rows="6"  id="txtseoh2"><?php echo $db_pgcntseohtwo;?></textarea></td>
	   			</tr>
			   <tr bgcolor="#FFFFFF">
                    <td bgcolor="#f1f6fd"> <strong>Rank</strong> </td>
					<td bgcolor="#f1f6fd"><strong>:</strong></td>
                    <td bgcolor="#f1f6fd"><input type="text" name="txtprty" id="txtprty" class="select" size="4" maxlength="3" value="<?php echo $db_pgcntprty;?>"></td>
					<td bgcolor="#f1f6fd" style="color:#FF0000"><span id="errorsDiv_txtprty"></span></td>
                </tr>
				<tr bgcolor="#FFFFFF">
					<td width="17%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>Status</strong></td>
					<td bgcolor="#f1f6fd"><strong>:</strong></td>	
					<td width="51%" align="left" valign="middle" bgcolor="#f1f6fd" colspan="<?php echo $clspn_val-2;?>">
						<select name="lststs" id="lststs">
							<option value="a"<?php if($db_pgcntsts=='a') echo 'selected';?>>Active</option>
							<option value="i"<?php if($db_pgcntsts=='i') echo 'selected';?>>Inactive</option>
					   </select>
				  </td>
				</tr>	
				<tr bgcolor="#FFFFFF">
				<td colspan="5">
				<table width="100%" border="0" cellspacing="1" cellpadding="3">
			<tr>
                <td width="5%"  bgcolor="#f1f6fd"><strong>SL.No.</strong></td>
                <td width="10%" bgcolor="#f1f6fd"><strong>Name</strong></td>
                <td width="10%" bgcolor="#f1f6fd"><strong>Designation</strong></td>
				<td width="45%" bgcolor="#f1f6fd" align='center' colspan='2'><strong>Image</strong></td>
				<td width="20%" bgcolor="#f1f6fd" ><strong>Rank</strong></td>
				<td width="10%"  bgcolor="#f1f6fd"><strong>Status</strong></td>
				<td width="10%"  bgcolor="#f1f6fd"><strong>Remove</strong></td>
			  </tr>
				<?php
			  	$sqryimg_dtl="select 
								pgimgd_id,pgimgd_name,pgimgd_desig,pgimgd_pgcntsd_id,pgimgd_img,
								pgimgd_prty,pgimgd_sts
							 from 
								  pgimg_dtl
							 where 
								 pgimgd_pgcntsd_id ='$id' 
							 order by 
								 pgimgd_id";
	            $srsimg_dtl	= mysqli_query($conn,$sqryimg_dtl);		
		        $cntpgimg_dtl  = mysqli_num_rows($srsimg_dtl);
			  	$nfiles = "";
				if($cntpgimg_dtl> 0 ){
				?>
				<?php				
			  	while($rowspgimgd_mdtl=mysqli_fetch_assoc($srsimg_dtl)){				
					$pgimgdid 	  = $rowspgimgd_mdtl['pgimgd_id'];
					$db_pgimgnm   = $rowspgimgd_mdtl['pgimgd_name'];
					$arytitle     = explode("-",$db_pgimgnm);
					$db_pgimgimg  = $rowspgimgd_mdtl['pgimgd_img'];
					$db_pgimgprty = $rowspgimgd_mdtl['pgimgd_prty'];
					$db_pgimgsts  = $rowspgimgd_mdtl['pgimgd_sts'];
					$db_pgimgdesig  = $rowspgimgd_mdtl['pgimgd_desig'];
					
					$imgnm = $db_pgimgimg;					
					$imgpath = $a_phtgalspath.$imgnm;
					$nfiles+=1;
					$clrnm = "";
					if($cnt%2==0){
						$clrnm = "bgcolor='#f1f6fd'";
					}
					else{
						$clrnm = "bgcolor='#f1f6fd'";
					}
			  ?>
			  <tr bgcolor="#FFFFFF">
						<td colspan="7" align="center" bgcolor="#f1f6fd">
							<table width="100%" border="0" cellspacing="1" cellpadding="1">								
							<input type="hidden" name="hdnpgdid<?php echo $nfiles?>" class="select" value="<?php echo $pgimgdid;?>">
								<tr bgcolor="#FFFFFF">
								<td bgcolor="#f1f6fd" width='5%'><?php echo  $nfiles;?></td>
								<td bgcolor="#f1f6fd" width='10%' align='center'>
								<input type="text" name="txtphtname1<?php echo $nfiles?>" id="txtphtname1<?php echo $nfiles?>" value='<?php echo  $arytitle[1]?>' class="select" size="10">
						</td>
                        <td bgcolor="#f1f6fd" width='10%' align='center'>
								<input type="text" name="txtphtdesig<?php echo $nfiles?>" id="txtphtdesig<?php echo $nfiles?>" value='<?php echo  $db_pgimgdesig;?>' class="select" size="10">
						</td>
								<td bgcolor="#f1f6fd"  align="right" width='35%'><input type="file" name="flesmlimg<?php echo $nfiles?>" class="select" id="flesmlimg" >
								</td>
								<td bgcolor="#f1f6fd"  align="left" width='10%'>
								<?php						   
									  if(($imgnm !="") && file_exists($imgpath)){
											 echo "<img src='$imgpath' width='30pixel' height='30pixel'>";
									  }
									  else{
										 echo "No Image";
									  }
								  ?>
								
								<span id="errorsDiv_flesmlimg1"></span></td>
								<td bgcolor="#f1f6fd" width='20%' >
							   <input type="text" name="txtphtprior<?php echo $nfiles?>" id="txtphtprior1" class="select" value="<?php echo $db_pgimgprty;?>" size="4" maxlength="3"><span id="errorsDiv_txtphtprior1"></span></td>
						
								<td  valign="middle" bgcolor="#f1f6fd" width='10%' >					
								<select name="lstphtsts<?php echo $nfiles?>" id="lstphtsts<?php echo $nfiles?>">
									<option value="a" <?php if($db_pgimgsts =='a') echo 'selected'; ?>>Active</option>
									<option value="i" <?php if($db_pgimgsts =='i') echo 'selected'; ?>>Inactive</option>
								</select></td>
								<td bgcolor="#f1f6fd" width='10%'><input type="button"  name="btnrmv" 
								 value="REMOVE"  onClick="rmvimg('<?php echo $pgimgdid; ?>')"></td>
							</table>
						</td>			
					</tr>
			  <?php
			  	}
				}
				else{
					echo "<tr bgcolor='#FFFFFF'><td colspan='7' align='center' bgcolor='#f1f6fd'>Image not available</td></tr>";
				}
				?>
					<tr bgcolor="#FFFFFF">
					<td colspan="6" align="center" bgcolor="#f1f6fd">
					<?php echo $str_tab; ?>
						<div id="myDiv">						
						  <table width="100%">						  
						    <input type="hidden" name="hdntotcntrl" id="hdntotcntrl" value="<?php echo $nfiles;?>">				  
							<tr>
								<td align="center">
								<input name="btnadd" type="button" onClick="expand()" value="Add Another Image" class="subtitles">												                                </td>
							</tr>
							<tr>
								<td align="center">
								<span id="errorsDiv_hdntotcntrl"></span></td>
							</tr>
						</table>
						</div>
					</td>
					<td align="center" bgcolor="#f1f6fd"></td>
				</tr>
				</table>
				</td>
				</tr>
                <tr bgcolor="#FFFFFF">
				<td colspan="5">
				<table width="100%" border="0" cellspacing="1" cellpadding="3">
			<tr>
                <td width="5%"  bgcolor="#f1f6fd"><strong>SL.No.</strong></td>
                <td width="10%" bgcolor="#f1f6fd"><strong>Name</strong></td>
				<td width="45%" bgcolor="#f1f6fd" align='center'><strong>Video</strong></td>
				<td width="20%" bgcolor="#f1f6fd" align='center'><strong>Rank</strong></td>
				<td width="10%"  bgcolor="#f1f6fd"><strong>Status</strong></td>
				<td width="10%"  bgcolor="#f1f6fd"><strong>Remove</strong></td>
			  </tr>
				<?php
			  	$sqryvdo_dtl="select 
								pgvdod_id,pgvdod_name,pgvdod_pgcntsd_id,pgvdod_vdo,
								pgvdod_prty,pgvdod_sts
							 from 
								  pgvdo_dtl
							 where 
								 pgvdod_pgcntsd_id ='$id' 
							 order by 
								 pgvdod_id";
	            $srsvdo_dtl	= mysqli_query($conn,$sqryvdo_dtl);		
		        $cntpgvdo_dtl  = mysqli_num_rows($srsvdo_dtl);
			  	$nfiles_vdo = "";
				if($cntpgvdo_dtl> 0 ){
				?>
				<?php				
			  	while($rowspgvdod_mdtl=mysqli_fetch_assoc($srsvdo_dtl)){
					$pgvdodid = $rowspgvdod_mdtl['pgvdod_id'];
					$vdonm = $rowspgvdod_mdtl['pgvdod_vdo'];
					//$vdopath = $a_phtgalspath.$vdonm;
					$nfiles_vdo+=1;
					$clrnm = "";
					if($cnt%2==0){
						$clrnm = "bgcolor='#f1f6fd'";
					}
					else{
						$clrnm = "bgcolor='#f1f6fd'";
					}
			  ?>
			  <tr bgcolor="#FFFFFF">
						<td colspan="7" align="center" bgcolor="#f1f6fd">
							<table width="100%" border="0" cellspacing="1" cellpadding="1">								
							<input type="hidden" name="hdnpgvdoid<?php echo $nfiles_vdo?>" class="select" value="<?php echo $pgvdodid;?>">
							<input type="hidden" name="hdnpgdvdo<?php echo $nfiles_vdo?>" class="select" value="<?php echo $vdonm;?>">
							
								<tr bgcolor="#FFFFFF">
								<td bgcolor="#f1f6fd" width='5%'><?php echo  $nfiles_vdo;?></td>
								<td bgcolor="#f1f6fd" width='10%' align='center'>
								<?php $arytitle = explode("-",$rowspgvdod_mdtl['pgvdod_name']);?>
								<input type="text" name="txtvdoname1<?php echo $nfiles_vdo?>" id="txtvdoname1<?php echo $nfiles_vdo?>" value='<?php echo  $arytitle[1]?>' class="select" size="10">
						</td>
								<td bgcolor="#f1f6fd"  align="right" width='35%'>
								<textarea name="txtvdo<?php echo $nfiles_vdo?>" cols="30" rows="3"  id="txtvdo<?php echo $nfiles_vdo?>"><?php echo $vdonm ?></textarea>
								</td>
								<td bgcolor="#f1f6fd" width='20%' align='center'>
							   <input type="text" name="txtvdoprior<?php echo $nfiles_vdo?>" id="txtvdoprior1" class="select" value="<?php echo $rowspgvdod_mdtl['pgvdod_prty'];?>" size="4" maxlength="3"><span id="errorsDiv_txtvdoprior1"></span></td>
						
								<td  valign="middle" bgcolor="#f1f6fd" width='10%' >					
								<select name="lstvdosts<?php echo $nfiles_vdo?>" id="lstvdosts<?php echo $nfiles_vdo?>">
									<option value="a" <?php if($rowspgvdod_mdtl['pgvdod_sts']=='a') echo 'selected'; ?>>Active</option>
									<option value="i" <?php if($rowspgvdod_mdtl['pgvdod_sts']=='i') echo 'selected'; ?>>Inactive</option>
								</select></td>
								<td bgcolor="#f1f6fd" width='10%'><input type="button"  name="btnrmv" 
								 value="REMOVE"  onClick="rmvvdo('<?php echo $pgvdodid; ?>')"></td>
							</table>
						</td>			
					</tr>
			  <?php
			  	}
				}
				else{
					echo "<tr bgcolor='#FFFFFF'><td colspan='6' align='center' bgcolor='#f1f6fd'>Videos not available</td></tr>";
				}
				?>
					<tr bgcolor="#FFFFFF">
					<td colspan="5" align="center" bgcolor="#f1f6fd">					
						<div id="myDivVdo">						
						  <table width="100%">						  
						    <input type="hidden" name="hdntotcntrlvdo" id="hdntotcntrlvdo" value="<?php echo $nfiles_vdo;?>">					  
							<tr>
								<td align="center">
								<input name="btnadd" type="button" onClick="expandVdo()" value="Add Another Vedio" class="subtitles">												                                </td>
							</tr>
							<tr>
								<td align="center">
								<span id="errorsDiv_hdntotcntrl"></span></td>
							</tr>
						</table>
						</div>
					</td>
					<td align="center" bgcolor="#f1f6fd"></td>
				</tr>
				</table>
				</td>
				</tr>
				</tr>
					  <tr valign="middle" bgcolor="#FFFFFF">
						<td colspan="<?php echo $clspn_val?>" align="center" bgcolor="#f1f6fd">
							<input type="Submit" class="textfeild"  name="btnedtphcntn" id="btnedtphcntn" value="Update">
							&nbsp;&nbsp;&nbsp;
							<input type="reset" class="textfeild"  name="btnecatrst" value="Reset" id="btnecatrst">
							&nbsp;&nbsp;&nbsp;
						    <input type="button"  name="btnBack" value="Back" class="textfeild" onclick="location.href='<?php echo $rd_vwpgnm;?>?edtpgcntid=<?php echo $id;?>&pg=<?php echo $pg."&cntstart=".$cntstart.$loc;?>'">
					    </td>
					 </tr>
			  </table> </form>
       </td>
     </tr>
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>

</html>


<script language="javascript" type="text/javascript">
/********************Multiple Image Upload********************************/
	  var nfiles ="<?php echo $nfiles;?>";
	   function expand () {	   		
			nfiles ++;
            var htmlTxt = '<?php
					echo "<table width=100%  border=0 cellspacing=1 cellpadding=1 >"; 
					echo "<tr>";
					echo "<td align=left width=5%>";
					echo "<span class=buylinks> ' + nfiles + '</span></td>";
					echo "<td  width=10% >";
					echo "<input type=text name=txtphtname1' + nfiles + ' id=txtphtname1' + nfiles + ' class=select size=10></td>";
					echo "<td  width=10% >";
					echo "<input type=text name=txtphtdesig' + nfiles + ' id=txtphtdesig' + nfiles + ' class=select size=10></td>";
					echo "<td align=left width=30% colspan=2>";
					echo "<input type=file name=flesmlimg' + nfiles + ' id=flesmlimg' + nfiles + ' class=select><br>";
					echo "<td align=center width=20%>";
					echo "<input type=text name=txtphtprior' + nfiles + ' id=txtphtprior' + nfiles + ' class=select size=4 maxlength=3>";
					echo "</td>"; 
					echo "<td  width=20% align=right colspan=2>";
					echo "<select name=lstphtsts' + nfiles + ' id=lstphtsts' + nfiles + ' class=select>";
					echo "<option value=a>Active</option>";
					echo "<option value=i>Inactive</option>";
					echo "</select>";
					echo "</td></tr></table><br>";			
				?>';			
            var Cntnt = document.getElementById ("myDiv");			
			if (document.createRange) {//all browsers, except IE before version 9 				
			 var rangeObj = document.createRange ();
			 	Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
				document.frmedtpgcntn.hdntotcntrl.value = nfiles;	
               if (rangeObj.createContextualFragment) { // all browsers, except IE	
			   		 	//var documentFragment = rangeObj.createContextualFragment (htmlTxt);
                 	 	//Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla						 				
				}
                else{//Internet Explorer from version 9
                 	Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
				}
			}			
			else{//Internet Explorer before version 9
                Cntnt.insertAdjacentHTML ("BeforeBegin", htmlTxt);
			}
			document.frmedtpgcntn.hdntotcntrl.value = nfiles;
        }
		var nfiles_vdo ="<?php echo $nfiles_vdo;?>";
	   function expandVdo() {	   		
			nfiles_vdo ++;
				if(nfiles_vdo <=20){	 
				var htmlTxt = '<?php
						echo "<table width=100%  border=0 cellspacing=1 cellpadding=1 >"; 
						echo "<tr>";
						echo "<td align=left width=5%>";
						echo "<span class=buylinks> ' + nfiles_vdo + '</span></td>";
						echo "<td  width=20% >";
						echo "<input type=text name=txtvdoname1' + nfiles_vdo + ' id=txtvdoname1' + nfiles_vdo + ' class=select size=10><br>";
						echo "<td align=center width=35% >";
						echo "<textarea name=txtvdo' + nfiles_vdo + ' id=txtvdo' + nfiles_vdo + ' cols=30 rows=3></textarea><br>";
						echo "<td align=center width=20%>";
						echo "<input type=text name=txtvdoprior' + nfiles_vdo + ' id=txtvdoprior' + nfiles_vdo + ' class=select size=4 maxlength=3>";
						echo "</td>"; 
						echo "<td  width=20% align=left colspan=2>";
						echo "<select name=lstvdosts' + nfiles_vdo + ' id=lstvdosts' + nfiles_vdo + ' class=select>";
						echo "<option value=a>Active</option>";
						echo "<option value=i>Inactive</option>";
						echo "</select>";
						echo "</td></tr></table><br>";			
					?>';			
			   
			var Cntnt = document.getElementById ("myDivVdo");			
			if (document.createRange) {//all browsers, except IE before version 9 				
			 var rangeObj = document.createRange ();
				Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
				document.frmedtpgcntn.hdntotcntrlvdo.value = nfiles_vdo;	
			   if (rangeObj.createContextualFragment) { // all browsers, except IE	
						//var documentFragment = rangeObj.createContextualFragment (htmlTxt);
						//Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla	
									
				}
				else{//Internet Explorer from version 9
					Cntnt.insertAdjacentHTML('BeforeBegin' , htmlTxt);
				}
			}			
			else{//Internet Explorer before version 9
				Cntnt.insertAdjacentHTML ("BeforeBegin", htmlTxt);
			}
			document.frmedtpgcntn.hdntotcntrlvdo.value = nfiles_vdo;
		}
		else{
			alert("Maximum 20 Video's Only");
			return false;
		}
	}			
</script>
<script language="javascript" type="text/javascript">
	//generate_wysiwyg('txtdesc');
	CKEDITOR.replace('txtdesc', {
    'filebrowserImageUploadUrl': 'js/plugins/imgupload/imgupload.php'
  });
</script>