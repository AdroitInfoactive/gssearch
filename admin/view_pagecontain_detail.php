<?php
error_reporting(0);
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_connection.php';//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once '../includes/inc_config.php';
	include_once '../includes/inc_folder_path.php';		

	/***************************************************************/
	//Programm 	  : view_pagecontain_detail.php	
	//Package 	  : 
	//Purpose 	  : View pagecontain details
	//Created By  : Mallikarjuna
	//Created On  :	
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$cntstart,$msg,$loc,$rd_crntpgnm,$rd_edtpgnm,$clspn_val;	
	$rd_crntpgnm = "view_all_pagecontain.php";
	$rd_edtpgnm  = "edit_pagecontain.php";
	$clspn_val   = "3";
	 
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
								pgcntsd_sts,pgcntsd_prty,prodcatm_name,prodscatm_name,
								pgcntsd_fle,pgcntsd_typ,pgcntsd_seotitle,pgcntsd_seodesc,
								pgcntsd_seokywrd,pgcntsd_seohone,pgcntsd_seohtwo,deptm_name,
								pgcntsd_bnrimg
					  	 from 
								vw_pgcnts_prodcat_prodscat_mst
	                  	 where 
								pgcntsd_id=$id";	
	 	$srspgcnts_dtl = mysqli_query($conn,$sqrypgcnts_dtl);
		$cntrec_pgcnts = mysqli_num_rows($srspgcnts_dtl);
		if($cntrec_pgcnts  > 0){
	 	$rowspgcnts_dtl 	 = mysqli_fetch_assoc($srspgcnts_dtl);
		    $db_deptname	 = $rowspgcnts_dtl['deptm_name'];	
			$db_catname		 = $rowspgcnts_dtl['prodcatm_name'];
			$db_scatname	 = $rowspgcnts_dtl['prodscatm_name'];
			$db_pgcntname	 = $rowspgcnts_dtl['pgcntsd_name'];
			$db_pgcntdesc	 = stripslashes($rowspgcnts_dtl['pgcntsd_desc']);
			$db_pgcntlnk	 = $rowspgcnts_dtl['pgcntsd_lnk'];
			$db_pgcntfl		 = $rowspgcnts_dtl['pgcntsd_fle'];
			$db_pgcntseottl	 = $rowspgcnts_dtl['pgcntsd_seotitle'];
			$db_pgcntseodesc = $rowspgcnts_dtl['pgcntsd_seodesc'];
			$db_pgcntseokywrd= $rowspgcnts_dtl['pgcntsd_seokywrd'];
			$db_pgcntseohone = $rowspgcnts_dtl['pgcntsd_seohone'];
			$db_pgcntseohtwo = $rowspgcnts_dtl['pgcntsd_seohtwo'];
			$db_pgcntprty	 = $rowspgcnts_dtl['pgcntsd_prty'];
			$db_pgcntsts	 = $rowspgcnts_dtl['pgcntsd_sts'];
			$db_pgcntstype   = $rowspgcnts_dtl['pgcntsd_typ'];
		}
		else{
			header("Location:".$rd_crntpgnm);
			exit();
		}
	}
	else{
		header("Location:".$rd_crntpgnm);
		exit();
	}	
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) != "")){	
		$stsval = trim($_REQUEST['sts']);
		if($stsval == 'y'){
			$msg = "<font color=red>Record updated successfully</font>";
		}
		elseif($stsval == 'n'){
			$msg = "<font color=red>Record not updated (Try Again)</font>";
		}
		elseif($stsval == 'd'){
			$msg = "<font color=red>Duplicate Record Name Exists & Record Not updated</font>";
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/yav-style.css" type="text/css" rel="stylesheet">
<title><?php echo $pgtl; ?></title>	
	<?php include_once ('script.php');?>	
	<script language="javascript" type="text/javascript">
		function update(){
			frmedtpgcntn.action="<?php echo $rd_edtpgnm;?>?edtpgcntid=<?php echo $id;?>&pg=<?php echo $pg;?>&cntstart=<?php echo $cntstart.$loc;?>"
			frmedtpgcntn.submit();
		}
	</script>
</head>
<body>
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
		<span class="maintitles">View Pagecontent Details </span><br>
          <br>
          <table width="95%"  border="0" cellspacing="1" cellpadding="8" align='center'>
		  <form name="frmedtpgcntn" id="frmedtpgcntn" method="post" action="<?php $_SERVER['SCRIPT_FILENAME'];?>" onSubmit="return performCheck('frmedtpgcntn', rules, 'inline');" enctype="multipart/form-data">
		  <input type="hidden" name="edtpgcntid" id="edtpgcntid" value="<?php echo $id;?>">
		  <input type="hidden" name="pg" id="pg" value="<?php echo $pg;?>">
		  <input type="hidden" name="cntstart" id="cntstart" value="<?php echo $cntstart;?>">
		  <input type="hidden" name="optn" id="optn" value="<?php echo $optn;?>">
		  <input type="hidden" name="txtsrchval" id="txtsrchval" value="<?php echo $val;?>">
		  <input type="hidden" name="lstcatone" id="lstcatone" value="<?php echo $lstctone;?>">
		  <input type="hidden" name="lstcattwo" id="lstcattwo" value="<?php echo $lstcttwo;?>">
		   <input type="hidden" name="lstdept" id="lstdept" value="<?php echo $lstdpt;?>">
		 <input type="hidden" name="hdnsimg" value="<?php echo $rowspgcnts_dtl['prodimgd_img'];?>">
		 
		  <?php
			if($msg != "")
			{
			echo "<tr bgcolor='#FFFFFF'><td bgcolor='#f1f6fd' colspan='$clspn_val' align='center'>$msg</td></tr>";
			}
			?>
		  	  <tr bgcolor="#f1f6fd">
                      <td width="30%" bgcolor="#f1f6fd"> <strong>Category</strong> </td>
					  <td width="2%" bgcolor="#f1f6fd" align="center"><strong>:</strong></td>
                      <td width="68%" bgcolor="#f1f6fd"><?php	echo $db_catname;?>                      </td>
               </tr>
			   <tr bgcolor="#f1f6fd">
                       <td width="30%" bgcolor="#f1f6fd"> <strong>Subcategory</strong> </td>
					   <td width="2%" bgcolor="#f1f6fd" align="center"><strong>:</strong></td>
                       <td width="68%" bgcolor="#f1f6fd"><?php echo $db_scatname;?>                       </td>
                </tr>
				<?php /*?> <tr bgcolor="#f1f6fd">
                      <td width="30%" bgcolor="#f1f6fd"> <strong>Department</strong> </td>
					  <td width="2%" bgcolor="#f1f6fd" align="center"><strong>:</strong></td>
                      <td width="68%" bgcolor="#f1f6fd"><?php	echo $db_deptname;?>                      </td>
               </tr><?php */?>
				<tr bgcolor="#f1f6fd">
						<td width="30%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>Name</strong></td> 
						<td width="2%" bgcolor="#f1f6fd" align="center"><strong>:</strong></td> 
				  <td width="68%" align="left" valign="middle" bgcolor="#f1f6fd"><?php echo $db_pgcntname;?>				  </td>
				</tr>
               <tr bgcolor="#FFFFFF">
						<td bgcolor="#f1f6fd" valign="top" colspan="<?php echo $clspn_val;?>"><strong>Description</strong></td>
				</tr>
				<tr>
						<td bgcolor="#f1f6fd" colspan="<?php echo $clspn_val;?>"><?php echo $db_pgcntdesc;?></td>
				</tr>
				<tr bgcolor="#FFFFFF">
						<td width="30%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>Link</strong></td> 
						<td width="2%" bgcolor="#f1f6fd" align="center"><strong>:</strong></td> 
						<td width="68%" align="left" valign="middle" bgcolor="#f1f6fd" colspan="2">
						  <?php echo $db_pgcntlnk;?>				  </td>
				</tr>
				<tr bgcolor="#f1f6fd">
                  <td width="16%" bgcolor="#f1f6fd" align="left" valign="top"><strong>Banner Images</strong></td>
                  <td width="2%" bgcolor="#f1f6fd" align="center" valign="top"><strong>:</strong></td>
                  <td width="82%" bgcolor="#f1f6fd" align="left" valign="top">
				  <?php
					$imgnm   = $rowspgcnts_dtl['pgcntsd_bnrimg'];
					$imgpath = $a_pgcnt_bnrfldnm.$imgnm;
					if(($imgnm !="") && file_exists($imgpath)){
						echo "<img src='$imgpath' width='80pixel' height='80pixel'>";					
					}
					else{
						echo "N.A.";						 			  
					}
					?>		
				</td>
				</tr>
				<tr> 
					<td width="30%" align="left" valign="top" bgcolor="#f1f6fd"><strong>File</strong></td>
					<td width="2%" align="center" valign="top" bgcolor="#f1f6fd"><strong>:</strong></td>
					<td width="68%" align="left" valign="middle" bgcolor="#f1f6fd">
					 <?php
					$evntflnm 	 = $db_pgcntfl;
					    $evntflpath  = $gevnt_fldnm.$id."-".$evntflnm;
						if(($evntflnm !="") && file_exists($evntflpath)){
						echo $evntflnm ;
						}
					  	else{
						 echo "Files not available";
					  	}
					?>				</td>													
			 </tr>
				<tr bgcolor="#f1f6fd">
					  <td bgcolor="#f1f6fd"> <strong>Type</strong>  </td>
					  <td bgcolor="#f1f6fd"><strong>:</strong></td>
					  <td bgcolor="#f1f6fd"><?php echo funcDsplyCattwoTyp($db_pgcntstype);?></td>
			    </tr>
				<tr bgcolor="#f1f6fd">
                	<td width="30%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>SEO Title</strong> </td>
					<td width="2%" bgcolor="#f1f6fd" align="center"><strong>:</strong></td> 
                 	<td width="68%" align="left" valign="middle" bgcolor="#f1f6fd"><?php echo $db_pgcntseottl;?>					</td>                 	
				</tr>
				<tr bgcolor="#f1f6fd">
                	<td width="30%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>SEO Description</strong> </td>
					<td width="2%" bgcolor="#f1f6fd" align="center"><strong>:</strong></td> 
                 	<td width="68%" align="left" valign="middle" bgcolor="#f1f6fd"><?php echo $db_pgcntseodesc;?>					</td>
                 	
				</tr>
				<tr bgcolor="#f1f6fd">
                	<td width="30%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>SEO Keyword</strong> </td>
					<td width="2%" bgcolor="#f1f6fd" align="center"><strong>:</strong></td> 
                 	<td width="68%" align="left" valign="middle" bgcolor="#f1f6fd" colspan="2">
						<?php echo $db_pgcntseokywrd;?>					</td>                 	
				</tr>
				<tr bgcolor="#f1f6fd">
				   <td valign="top" bgcolor="#f1f6fd"><strong>SEO H1</strong></td>
				   <td align="center" valign="top" bgcolor="#f1f6fd"><strong>:</strong></td>
				   <td colspan="2" align="left" valign="middle" bgcolor="#f1f6fd"><?php echo $db_pgcntseohone;?>
				   </td>
			    </tr>
				   <tr bgcolor="#f1f6fd">
				   <td valign="top" bgcolor="#f1f6fd"><strong>SEO H2</strong></td>
				   <td align="center" valign="top" bgcolor="#f1f6fd"><strong>:</strong></td>
				   <td colspan="2" align="left" valign="middle" bgcolor="#f1f6fd"><?php echo $db_pgcntseohtwo;?>
				   </td>
	   			</tr>
			    <tr bgcolor="#f1f6fd">
                        <td width="30%"	bgcolor="#f1f6fd"> <strong>Rank</strong> </td>
						<td width="2%" bgcolor="#f1f6fd" align="center"><strong>:</strong></td>
						<td width="68%" bgcolor="#f1f6fd"><?php echo $db_pgcntprty;?>						</td>
				</tr>
				<tr bgcolor="#f1f6fd">
						<td width="30%" height="19" valign="middle" bgcolor="#f1f6fd"><strong>Status</strong></td>
						<td width="2%" bgcolor="#f1f6fd" align="center"><strong>:</strong></td>
						<td  width="68%" align="left" valign="middle" bgcolor="#f1f6fd"><?php echo funcDispSts($db_pgcntsts);?>						</td>
				</tr>
			<tr bgcolor="#FFFFFF">
				<td colspan="4">
				<table width="100%" border="0" cellspacing="1" cellpadding="3">
				<tr>
                <td width="5%"  bgcolor="#f1f6fd"><strong>SL.No.</strong></td>
                <td width="20%" bgcolor="#f1f6fd"><strong>Name</strong></td>
                <td width="20%" bgcolor="#f1f6fd"><strong>Designation</strong></td>
				<td width="20%" bgcolor="#f1f6fd" align='center'><strong>Image</strong></td>
				<td width="20%" bgcolor="#f1f6fd"><strong>Rank</strong></td>
				<td width="20%"  bgcolor="#f1f6fd"><strong>Status</strong></td>
			  </tr>
			  <?php
			  $sqryimg_dtl="select 
								  pgimgd_name,pgimgd_desig,pgimgd_pgcntsd_id,pgimgd_img,pgimgd_prty,
								  if(pgimgd_sts = 'a', 'Active','Inactive') as pgimgd_sts
							 from 
								  pgimg_dtl
							 where 
								  pgimgd_pgcntsd_id ='$id' 
							 order by 
								  pgimgd_id";
	               $srsimg_dtl	= mysqli_query($conn,$sqryimg_dtl);		
		           $cntpgimg_dtl  = mysqli_num_rows($srsimg_dtl);
			  	$cnt = $offset;
				if($cntpgimg_dtl> 0 ){				
			  	while($rowpgimg_dtl	  = mysqli_fetch_assoc($srsimg_dtl)){	
						$db_pgimgnm   = $rowpgimg_dtl['pgimgd_name'];
						$arytitle     = explode("-",$db_pgimgnm);
						$db_pgimgimg  = $rowpgimg_dtl['pgimgd_img'];
						$db_pgimgprty = $rowpgimg_dtl['pgimgd_prty'];
						$db_pgimgsts  = $rowpgimg_dtl['pgimgd_sts'];
						$db_pgimgdesig  = $rowpgimg_dtl['pgimgd_desig'];
							
					$cnt+=1;
					$clrnm = "";
					if($cnt%2==0){
						$clrnm = "bgcolor='#f1f6fd'";
					}
					else{
						$clrnm = "bgcolor='#f1f6fd'";
					}
			  ?>
               <tr>
                <td bgcolor="#f1f6fd"><?php echo $cnt; ?></td>				
				<td bgcolor="#f1f6fd"><?php echo $arytitle[1]; ?></td>
                <td bgcolor="#f1f6fd"><?php echo $db_pgimgdesig; ?></td>
                <td bgcolor="#f1f6fd" align='center'>
				<?php
					$imgnm   = $db_pgimgimg;
					$imgpath = $a_phtgalspath.$imgnm;					
				  if(($imgnm !="") && file_exists($imgpath)){
					 echo "<img src='$imgpath' width='80pixel' height='80pixel'>";
				  }
				  else{
					 echo "Image not available";
				  }
				?>
				</td>				
				<td bgcolor="#f1f6fd"><?php echo $db_pgimgprty; ?></td>				
				<td bgcolor="#f1f6fd"><?php echo $db_pgimgsts;?></td>
			  </tr>
			  <?php
			  	}
			}
			else{
				echo "<tr bgcolor='#FFFFFF'>
							<td colspan='5' bgcolor='#f1f6fd' align='center'>Image not available</td>
						</tr>";
			}
			  ?>
			  </table>
				</td>
				
				</tr>
                <tr bgcolor="#FFFFFF">
				<td colspan="5">
				<table width="100%" border="0" cellspacing="1" cellpadding="3">
                <tr>
                <td width="5%"  bgcolor="#f1f6fd"><strong>SL.No.</strong></td>
                <td width="10%" bgcolor="#f1f6fd"><strong>Name</strong></td>
				<td width="45%" bgcolor="#f1f6fd" align='center' ><strong>Video</strong></td>
				<td width="20%" bgcolor="#f1f6fd" ><strong>Rank</strong></td>
				<td width="10%"  bgcolor="#f1f6fd"><strong>Status</strong></td>
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
			  	$nfiles = "";
				if($cntpgvdo_dtl> 0 ){
				?>
				<?php				
			  	while($rowspgvdod_mdtl=mysqli_fetch_assoc($srsvdo_dtl))
				{
					$pgvdodid = $rowspgvdod_mdtl['pgvdod_id'];
					$vdonm = $rowspgvdod_mdtl['pgvdod_vdo'];
					$vdopath = $a_phtgalspath.$vdonm;
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
								<tr bgcolor="#FFFFFF">
								<td bgcolor="#f1f6fd" width='5%'><?php echo  $nfiles;?></td>
								<td bgcolor="#f1f6fd" width='10%' align='left'>
								<?php $arytitle = explode("-",$rowspgvdod_mdtl['pgvdod_name']);?><?php echo $arytitle[1]?>
						</td>
								<td bgcolor="#f1f6fd"  align="center" width='45%'>
								<?php echo $vdonm; ?>
								</td>
								<td bgcolor="#f1f6fd" width='20%' >
							 <?php echo $rowspgvdod_mdtl['pgvdod_prty'];?></td>
						
								<td  valign="middle" bgcolor="#f1f6fd" width='10%' ><?php echo funcDispSts($rowspgvdod_mdtl['pgvdod_sts'])?>					
								</td>
							</table>
						</td>			
					</tr>
			  <?php
			  	}
				}
				else{
					echo "<tr bgcolor='#FFFFFF'><td colspan='7' align='center' bgcolor='#f1f6fd'>Videos not available</td></tr>";
				}
				?>
				</table>
				</td>
				</tr>
				<tr valign="middle" bgcolor="#FFFFFF">
						<td colspan="<?php echo $clspn_val;?>" align="center" bgcolor="#f1f6fd">
						<?php
					if(($rqst_stp_attn[1]=='3') || ($rqst_stp_attn[1]=='4') || $ses_admtyp =='a'){
				?>
						<input type="Submit" class="textfeild"  name="btnedtphcntn" id="btnedtphcntn" value="Edit" onClick="update();">
						<?php
						}
						?>
						&nbsp;&nbsp;&nbsp;
						<input type="button"  name="btnBack" value="Back" class="textfeild" onclick="location.href='<?php echo $rd_crntpgnm;?>?pg=<?php echo $pg;?>&cntstart=<?php echo $cntstart.$loc;?>'">
						</td>
				</tr>
			  </form> </table>
       </td>
     </tr>
    </table></td>
  </tr>
</table>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>