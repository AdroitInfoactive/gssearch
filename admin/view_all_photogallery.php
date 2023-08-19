<?php
	include_once '../includes/inc_nocache.php'; // Clearing the cache information
	include_once '../includes/inc_adm_session.php';//checking for session
	include_once '../includes/inc_connection.php';//Making database Connection
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more	
	include_once '../includes/inc_paging_functions.php';//Making paging validation
	include_once  "../includes/inc_config.php";
	/***************************************************************/
	//Programm 	  : photogallery.php	
	//Package 	  : ICAI
	//Purpose 	  : For Viewing New photogallery 
	//Created By  : Lakshmi
	//Created On  :	10/11/2010
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/
	global $msg,$loc,$rowsprpg,$dispmsg,$disppg,$a_phtgalspath;
    /*****header link********/
$pagemncat = "Gallery";
$pagecat = "Photos";
$pagenm = "Photos";
/*****header link********/
    $clspn_val = "7";
$rd_adpgnm = "add_photogallery.php";
$rd_edtpgnm = "edit_photogallery.php";
$rd_crntpgnm = "view_all_photogallery.php";
$rd_vwpgnm = "view_detail_photogallery.php";
$loc = "";
		if(($_POST['hidchksts']!="") && isset($_REQUEST['hidchksts'])){
		$dchkval = substr($_POST['hidchksts'],1);
		$id  	 = glb_func_chkvl($dchkval);
		$updtsts = funcUpdtAllRecSts('pht_dtl','phtd_id',$id,'phtd_sts');		
		if($updtsts == 'y'){
			$msg = "<font color=red>Record updated successfully</font>";
		}
		elseif($updtsts == 'n'){
			$msg = "<font color=red>Record not updated</font>";
		}
	}	
	if(($_POST['hidchkval']!="") && isset($_REQUEST['hidchkval'])){
		    $dchkval  = substr($_POST['hidchkval'],1);
			$did 	  = glb_func_chkvl($dchkval);	
			$del      = explode(',',$did) ;
			$count    = sizeof($del);
			$simg     = array();
			$bimg     = array();
			$simgpth  = array();
		    $bimgpth  = array();
			for($i=0;$i<$count;$i++){	
			     $sqryprod_mst="SELECT 
			                       phtm_simg
					            from 
					               pht_mst
					            where
					              phtm_phtd_id=$del[$i]";
			     $srsprod_mst=mysqli_query($conn,$sqryprod_mst);
			     $srowprod_mst=mysqli_fetch_assoc($srsprod_mst);		     			   				
		         $simg[$i]    = glb_func_chkvl($srowprod_mst['phtm_simg']);
		         //$bimg[$i]    = glb_func_chkvl($srowprod_mst['phtm_bimgnm']);				
		         $simgpth[$i] = $a_phtgalspath.$simg[$i];
		         //$bimgpth[$i] = $bgimgfldnm.$bimg[$i];
		     }
			$delsts = funcDelAllRec($conn,'pht_dtl','phtd_id',$did);							   
		    if($delsts == 'y'){
			  for($i=0;$i<$count;$i++){			         
		         if(($simg[$i] != "")){
				    unlink($simgpth[$i]);
			     }
			     /*if(($bimg[$i] != "") && file_exists($bimgpth[$i])){
				   unlink($bimgpth[$i]);
			     }*/
			  } 
			  $gmsg = "<font color='red'>Records deleted successfully</font>";
		    }
		    elseif($delsts == 'n'){
			   $gmsg = "<font color='red'>Record can't be deleted(child records exist)</font>";
		    }
		}	
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) != "")
	&& isset($_REQUEST['id']) && (trim($_REQUEST['id']) != ""))
	{
		$sts = glb_func_chkvl($_REQUEST['sts']);
		$id  = glb_func_chkvl($_REQUEST['id']);		
		$updtsts = funcUpdtRecSts('pht_dtl','phtd_id',$id,'phtd_sts',$sts);		
		if($updtsts == 'y')
		{
			$msg = "<font color=red>Record updated successfully</font>";
		}
		elseif($updtsts == 'n')
		{
			$msg = "<font color=red>Record not updated</font>";
		}		
	}	
	
	if(isset($_REQUEST['did']) && (trim($_REQUEST['did']) != ""))	
	{
		$did 	= glb_func_chkvl($_REQUEST['did']);	
		$simg   = glb_func_chkvl($_REQUEST['simg']);
		//$bimg   = glb_func_chkvl($_REQUEST['bimg']);
		$simgpth = $fldnm.$simg;
		//$bimgpth = $a_phtgalspath.$bimg;
		$delsts = funcDelRec($conn,'pht_dtl','phtd_id',$did);		
		if($delsts == 'y')
		{
		   if(($simg != "") && file_exists($simgpth))
			{
				unlink($simgpth);
			}
			if(($bimg != "") && file_exists($bimgpth))
			{
				unlink($bimgpth);
			}
			$msg = "<font color=red>Record deleted successfully</font>";
		}
		elseif($delsts == 'n')
		{
			$msg = "<font color=red>Record can't be deleted(child records exist)</font>";
		}
	}	
	
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y"))	
	{
			$msg = "<font color=red>Record updated successfully</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n"))
	{
			$msg = "<font color=red>Record not updated</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d"))
	{
			$msg = "<font color=red>Dupilicate name Record not updated</font>";
	}
    $rowsprpg  = 20;//maximum rows per page
	include_once '../includes/inc_paging1.php';//Includes pagination	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title> <?php echo $pgtl;?></title>
<?php include_once 'script.php';?>
	<script language="javascript">
	function addnew()
	{
		document.frmphtgal.action="add_photogallery.php";
		document.frmphtgal.submit();
	}
	function chng()
	{
		var div1=document.getElementById("div1");
		var div2=document.getElementById("div2");
		if(document.frmphtgal.lstsrchby.value=='p')
		{
			div1.style.display="block";
			div2.style.display="none";

		}
		else if(document.frmphtgal.lstsrchby.value=='c')
		{
			div1.style.display="none";
			div2.style.display="block";
		}
	}
	function validate()
	{
		if(document.frmphtgal.lstsrchby.value=="")
		{
			alert("Please Select Search Criteria");
			document.frmphtgal.lstsrchby.focus();
			return false;
		}
		if(document.frmphtgal.lstsrchby.value=="p")
		{
			if(document.frmphtgal.txtsrchval.value=="")
			{
				alert("Please Enter Key Word");
				document.frmphtgal.txtsrchval.focus();
				return false;
			}
		}
		if(document.frmphtgal.lstsrchby.value=="c")
		{
			if(document.frmphtgal.lstphtcat.value=="")
			{
				alert("Please Select Category");
				document.frmphtgal.lstphtcat.focus();
				return false;
			}
		}
		var optn = document.frmphtgal.lstsrchby.value;
		if(optn =='p')
		{
			var val = document.frmphtgal.txtsrchval.value;
			if(document.frmphtgal.chkexact.checked==true)
			{
				document.frmphtgal.action="photogallery.php?optn=p&val="+val+"&chk=y";
				document.frmphtgal.submit();
			}
			else
			{
				document.frmphtgal.action="photogallery.php?optn=p&val="+val;
				document.frmphtgal.submit();
			}
		}
		else if(optn =='c')
		{
			var val = document.frmphtgal.lstphtcat.value;
				document.frmphtgal.action="photogallery.php?optn=c&val="+val;
				document.frmphtgal.submit();
		}
		return true;
	}
	function onload()
	{
		 //document.getElementById('txtsrchval').focus();
		 <?php
		 if(isset($_POST['lstsrchby']) && $_POST['lstsrchby']=='p')
		 {
		 ?>
				div1.style.display="block";
				div2.style.display="none";
		 <?php
		 }
		 else if(isset($_POST['lstsrchby']) && $_POST['lstsrchby']=='c')
		 {
		 ?>
				div1.style.display="none";
				div2.style.display="block";
		 <?php
		 }
		 ?>
	}
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
</head>
<body onLoad="onload();">
<?php include_once ('../includes/inc_adm_header.php');
include_once ('../includes/inc_adm_leftlinks.php');?>
<table width="977"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" class="admcnt_bdr"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="700" height="325" valign="top" bgcolor="#FFFFFF" 
		class="contentpadding" style="background-position:top; background-repeat:repeat-x; ">
          <span class="maintitles">Photogallery</span><br>
            <form method="POST" action="" name="frmphtgal" id="frmphtgal" onSubmit="return validate()">
			<input type="hidden" name="hidchkval" id="hidchkval">
			<input type="hidden" name="hidchksts" id="hidchksts">
            <input type="hidden" name="hdnallval" id="hdnallval">
			<table width="100%"  border="0" cellspacing="0" cellpadding="5">
              <tr>
			  	<td width="91%"><table width="100%">
                  <tr>
                    <td width="14%"><strong>Search By : </strong></td>
                    <td width="24%"><select name="lstsrchby" onChange="chng()" style="width:140px">
                        <option value="">--Select--</option>
                        <option value="p"<?php if(isset($_REQUEST['lstsrchby']) && trim($_REQUEST['lstsrchby'])=='p'){echo 'selected';}else if(isset($_REQUEST['optn']) && trim($_REQUEST['optn'])=='p'){echo 'selected';}?>>Photo Name</option>
                        <option value="c"<?php if(isset($_REQUEST['lstsrchby']) && trim($_REQUEST['lstsrchby'])=='c'){echo 'selected';}else if(isset($_REQUEST['optn']) && trim($_REQUEST['optn'])=='c'){echo 'selected';}?>>Category</option>
                    </select></td>
                    <td width="40%">
						<div id="div1" <?php if(!isset($_REQUEST['optn']) || (trim($_REQUEST['optn']) == "p") || (trim($_REQUEST['optn']) == "")) 
						{echo "style=\"display:block\"";}else{echo "style=\"display:none\"";}?>>
                        <input type="text" name="txtsrchval" 
							  value="<?php if(isset($_POST['txtsrchval']) && trim($_POST['txtsrchval'])!="")
							  			  {
										  	echo $_POST['txtsrchval'];
										  }
										  else if(isset($_REQUEST['val']) && (trim($_REQUEST['val'])!="") && 
										  		  isset($_REQUEST['optn']) && (trim($_REQUEST['optn'])== "p"))
										  {
										  	echo $_REQUEST['val'];
										  }
									?>" id="txtsrchval">
						<strong>Exact</strong>
                        <input type="checkbox" name="chkexact" value="1"<?php 						  
						  	if(isset($_POST['chkexact']) && (trim($_POST['chkexact'])==1)) 
							{
								echo 'checked';
							}
							elseif(isset($_REQUEST['chk']) && (trim($_REQUEST['chk'])=='y'))
							{
								echo 'checked';							
							}						  						  
						  ?>>
                      </div>
                        <div id="div2" <?php if(isset($_REQUEST['optn']) && (trim($_REQUEST['optn']) == "c")) 
						{echo "style=\"display:block\"";}else{echo "style=\"display:none\"";}?>>
                          <select name="lstphtcat" id="lstphtcat"> 
                            <option value="">--Select--</option>
                            <?php
							 $sqryphtcat_mst="select phtcatm_id,phtcatm_name
											  from phtcat_mst
											  where phtcatm_sts='a'";
												//order by phtcatm_prty
							 $stsphtcat_mst = mysqli_query($conn,$sqryphtcat_mst);
							 while($rowsphtcat_mst=mysqli_fetch_assoc($stsphtcat_mst))
							 {
							 ?>
			<option value="<?php echo $rowsphtcat_mst['phtcatm_id'];?>"<?php if(isset($_POST['lstphtcat']) && trim($_POST['lstphtcat'])==$rowsphtcat_mst['phtcatm_id']){echo 'selected';}else if(isset($_REQUEST['val']) && trim($_REQUEST['val'])==$rowsphtcat_mst['phtcatm_id']){echo 'selected';}?>><?php echo $rowsphtcat_mst['phtcatm_name'];?></option>
									<?php
							 }
					 ?>
                          </select>
                      </div></td>
                    <td width="22%"><input type="submit" value="Search" name="btnsbmt">
                      <a href="photogallery.php" class="orongelinks">Refresh</a></td>
                  </tr>
                </table></td>
			  	<td width="9%" align="right">
				<input name="btn" type="button" class="textfeild" value="&laquo; Add" onClick="addnew()">
				</td>
              </tr>
            </table>
        <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#D8D7D7">
			   <tr>
			    <td bgcolor="#FFFFFF" colspan="6" align="center"></td>				
                <td width="10%" align="center" valign="bottom" bgcolor="#FFFFFF">
					<input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hidchksts','frmphtgal','chksts')">
				</td>
                <td width="10%" align="center" valign="bottom" bgcolor="#FFFFFF" >
					<input name="btndel" id="btndel" type="button"  value="Delete" onClick="deleteall('hidchkval','frmphtgal','chkdlt');" >
				</td>
              </tr>
              <tr>
                <td width="7%" background="images/bg_table_top.gif"><strong>S.No.</strong></td>
                <?php /*?><td width="24%" background="images/bg_table_top.gif"><strong>Name</strong></td><?php */?>
				<td width="70%" background="images/bg_table_top.gif"><strong>Category</strong></td>
				<?php /*?><td width="38%" background="images/bg_table_top.gif"><strong>Photo</strong></td><?php */?>
                <td width="8%" background="images/bg_table_top.gif" align="center"><strong>Priority</strong></td>
                <!--<td width="9%" background="images/bg_table_top.gif" align="center"><strong>Status</strong></td>-->
                <td width="10%" background="images/bg_table_top.gif" align="center" colspan="3"><strong>Edit</strong></td>
                <!--<td width="9%" background="images/bg_table_top.gif" align="center"><strong>Delete</strong></td>-->
                <td width="10%" background="images/bg_table_top.gif" class="tableheadings" align="center"><strong>
				  <input type="checkbox" name="Check_ctr"  id="Check_ctr" value="yes"onClick="Check(document.frmphtgal.chksts,'Check_ctr')"></strong></td>
				<td width="10%" background="images/bg_table_top.gif" class="tableheadings" align="center"><strong>
				<input type="checkbox" name="Check_dctr"  id="Check_dctr" value="yes" onClick="Check(document.frmphtgal.chkdlt,'Check_dctr')"><b></b> 
				</strong>
				</td>
              </tr>
			  <?php
				$sqryphtgal_dtl1="select 
									 phtd_id,phtd_name,phtd_rank,phtd_sts,
									 phtcatm_id,phtcatm_name,phtd_phtcatm_id
				                  from 
							   		 pht_dtl
									inner join  
				phtcat_mst on phtcat_mst.phtcatm_id = pht_dtl.phtd_phtcatm_id";
				if(isset($_REQUEST['optn']) && trim($_REQUEST['optn'])=='p'
				&& isset($_REQUEST['val']) && trim($_REQUEST['val'])!="")
				{
					$val = glb_func_chkvl($_REQUEST['val']);
					if(isset($_REQUEST['chk']) && trim($_REQUEST['chk'])=='y')
					{
					  $loc = "&optn=p&val=".$val."&chk=y";
					  $sqryphtgal_dtl1.=" and phtd_name='$val'";
					}
					elseif(!isset($_REQUEST['chk']) || trim($_REQUEST['chk'])!='y')
					{
						$loc = "&optn=p&val=".$val;
						$sqryphtgal_dtl1.=" and phtd_name like '%$val%'";
					}
				}
				else if(isset($_REQUEST['optn']) && trim($_REQUEST['optn'])=='c'
				&& isset($_REQUEST['val']) && trim($_REQUEST['val'])!="")
				{
					$val = glb_func_chkvl($_REQUEST['val']);
					$loc = "&optn=c&val=".$val;
					$sqryphtgal_dtl1.=" and phtm_phtd_id = '$val'";
				}
   			    $sqryphtgal_dtl = $sqryphtgal_dtl1." group by phtd_name asc";
				$srsphtgal_dtl =mysqli_query($conn,$sqryphtgal_dtl) or die(mysqli_error());
			  	$cnt = 0;
				while($srowphtgal_dtl=mysqli_fetch_assoc($srsphtgal_dtl))
				{
					$cnt+=1;
			   ?>
              <tr <?php if($cnt%2==0){echo "bgcolor='f9f8f8'";}else{echo "bgcolor='#F2F1F1'";}?>>
                <td><?php echo $cnt;?></td>
                
				<td>
                <a href="view_photo.php?vw=<?php echo $srowphtgal_dtl['phtd_id'];?>&pg=<?php echo $pgnum;?>&countstart=<?php echo $cntstart.$loc;?>" class="links"><?php echo $srowphtgal_dtl['phtd_name'];?></a>
				</td>
				
				
                <td align="center"><?php echo $srowphtgal_dtl['phtd_rank'];?></td>
               
                <!--<td align="center">
				<a href="photogallery.php?sts=<?php echo $srowphtgal_dtl['phtd_sts'];?>&id=<?php echo $srowphtgal_dtl['phtd_id'];?>&pg=<?php echo $pgnum.$loc;?>"  class="orongelinks"><?php echo funcDispSts($srowphtgal_dtl['phtd_sts']);?></a>
				</td>-->
				
				<td align="center" colspan="3">
				<a href="edit_photo.php?vw=<?php echo $srowphtgal_dtl['phtd_id'];?>&pg=<?php echo $pgnum;?>" class="orongelinks">Edit</a></td>
				
                <!--<td align="center">
				<a href="photogallery.php?did=<?php echo $srowphtgal_dtl['phtd_id'];?>&simg=<?php echo $srowphtgal_dtl['phtm_simgnm'];?>&bimg=<?php echo  $srowphtgal_dtl['phtm_bimgnm']; ?>" class="orongelinks" onClick="return confirm('Are You Sure?')">Delete</a></td>-->
                <td align="center">
                  <input type="checkbox" name="chksts"  id="chksts" value="<?php echo $srowphtgal_dtl['phtd_id'];?>" <?php if($srowphtgal_dtl['phtd_sts'] =='a') { echo "checked";}?> onClick="addchkval(<?php echo $srowphtgal_dtl['phtd_id'];?>,'hidchksts','frmvwprods','chksts');">
				</td>
                <td align="center">
                  <input type="checkbox" name="chkdlt"  id="chkdlt" value="<?php echo $srowphtgal_dtl['phtd_id'];?>">
				</td>
              </tr>
			  <?php
			  	}				
				$disppg = funcDispPag('links',$loc,$sqryphtgal_dtl1,$rowsprpg,$cntstart,$pgnum,$conn);	
				if($disppg != "")
				{	
					$disppg = "<br><tr><td colspan='8' align='center' bgcolor='#F2F1F1'>$disppg</td></tr>";
					echo $disppg;
				}				
				if($msg != "")
				{
					$dispmsg = "<tr><td colspan='8' align='center' bgcolor='#F2F1F1'>$msg</td></tr>";
					echo $dispmsg;				
				}				
			  ?>
			   <tr>
			    <td bgcolor="#FFFFFF" colspan="6" align="center"></td>				
                <td width="10%" align="center" valign="bottom" bgcolor="#FFFFFF">
					<input name="btnsts" id="btnsts" type="button"  value="Status" onClick="updatests('hidchksts','frmphtgal','chksts')">
				</td>
                <td width="10%" align="center" valign="bottom" bgcolor="#FFFFFF" >
					<input name="btndel" id="btndel" type="button"  value="Delete" onClick="deleteall('hidchkval','frmphtgal','chkdlt');" >
				</td>
              </tr>			  
       </form><br>
			</table>
          </td>
        <td width="6" valign="top"></td>
      </tr>
    </table></td>
  </tr>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>