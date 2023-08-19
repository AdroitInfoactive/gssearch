<?php
error_reporting(0);
	include_once "../includes/inc_nocache.php"; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once '../includes/inc_config.php';
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more 
	include_once "../includes/inc_folder_path.php"; 
	/***************************************************************/  
	//Programm 	  : edit_event.php
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$cntstart,$val;
	$rd_crntpgnm = "view_all_exect_prog.php";
$rd_edtpgnm = "edit_exect_prog.php";
$clspn_val = "4";
/*****header link********/
$pagemncat = "Executive Programs";
$pagecat = "Executive Programs";
$pagenm = "Executive Programs";
/*****header link********/
	if(isset($_REQUEST['vw']) && $_REQUEST['vw']!=""
	&& isset($_REQUEST['pg']) && $_REQUEST['pg']!=""
	&& isset($_REQUEST['countstart']) && $_REQUEST['countstart']!=""){
		$id = glb_func_chkvl($_REQUEST['vw']);
		$pg = glb_func_chkvl($_REQUEST['pg']);
		$cntstart = glb_func_chkvl($_REQUEST['countstart']);
	}
	else if(isset($_REQUEST['hdnexect_progid']) && $_REQUEST['hdnexect_progid']!=""
	&& isset($_REQUEST['hdnpage']) && $_REQUEST['hdnpage']!=""
	&& isset($_REQUEST['hdncnt']) && $_REQUEST['hdncnt']!=""){
		$id = glb_func_chkvl($_REQUEST['hdnexect_progid']);
		$pg = glb_func_chkvl($_REQUEST['hdnpage']);
		$cntstart = glb_func_chkvl($_REQUEST['hdncnt']);
	}
	if(isset($_REQUEST['edit']) && $_REQUEST['edit']!=""){
		$val    = glb_func_chkvl($_REQUEST['val']);
		$opt 	= glb_func_chkvl($_REQUEST['optn']);
		$ck 	= glb_func_chkvl($_REQUEST['chk']);		
	}
  
	 $sqryexect_prog_mst="SELECT 
						exect_progm_name,exect_progm_id,exect_catm_name,exect_scatm_name,exect_progm_desc,exect_progm_sdesc,exect_progm_durtn,exect_progm_img,exect_progm_brochimg,
						exect_progm_frmdt,exect_progm_todt,exect_progm_fees,exect_progm_frmat,exect_progm_prty,
						exect_progm_sts
				    from 
						exect_prog_mst
            inner join exect_cat_mst on		exect_cat_mst.exect_catm_id=exect_prog_mst.exect_progm_catm_id
               inner join exect_scat_mst on		exect_scat_mst.exect_scatm_id=exect_prog_mst.exect_progm_scatm_id
	         where
           exect_progm_id=$id"  ;   
	$srsexect_prog_mst  = mysqli_query($conn,$sqryexect_prog_mst);
	$rowsexect_prog_mst = mysqli_fetch_assoc($srsexect_prog_mst);
  //  $evn_typ= $rowsexect_prog_mst['exect_progm_typ'];
	if(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "y")){
		$msg = "<font color=red>Record updated successfully</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "n")){
		$msg = "<font color=red>Record not updated</font>";
	}
	elseif(isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) == "d")){
	    $msg = "<font color=red>Duplicate Recored Name Exists & Record Not updated</font>";
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<title><?php echo $pgtl; ?></title>
	

</head>
<body>
<?php 
	include_once '../includes/inc_adm_header.php';
	include_once '../includes/inc_adm_leftlinks.php';?>
<section class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">View Executive Programs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View Executive Programs</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
		  <form name="frmedtexect_prog" id="frmedtexect_prog" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="" enctype="multipart/form-data">
		  <input type="hidden" name="hdnexect_progid" value="<?php echo $id;?>">
		  <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		  <input type="hidden" name="hdncnt" value="<?php echo $cntstart?>">
		  <input type="hidden" name="hdnval" value="<?php echo $val;?>">
		  <input type="hidden" name="hdnopt" value="<?php echo $opt;?>">
		  <input type="hidden" name="hdnchk" value="<?php echo $ck;?>">
		  <!--<input type="hidden" name="hdnsimg" value="">-->
		  <input type="hidden" name="hdnexect_prognm" id="hdnexect_prognm" value="<?php echo $rowsexect_prog_mst['exect_progm_fle']?>">
			<?php
			 if ($msg != '') {
                echo "<center><tr bgcolor='#FFFFFF'>
                    <td colspan='4' bgcolor='#F3F3F3' align='center'><strong>$msg</strong></td> 
                 </tr></center>";
            }
			?>	
             <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                    <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <?php echo $rowsexect_prog_mst['exect_catm_name']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">sub Category</label>
                            <div class="col-sm-8">
                                <?php echo $rowsexect_prog_mst['exect_scatm_name']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <?php echo $rowsexect_prog_mst['exect_progm_name']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Image</label>
                            <div class="col-sm-8">
                                <?php echo $rowsexect_prog_mst['exect_progm_img']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Boucher</label>
                            <div class="col-sm-8">
                                <?php echo $rowsexect_prog_mst['exect_progm_brochimg']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">From Date</label>
                            <div class="col-sm-8">
                                <?php echo $rowsexect_prog_mst['exect_progm_frmdt']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">To Date</label>
                            <div class="col-sm-8">
                                <?php echo $rowsexect_prog_mst['exect_progm_todt']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Fees</label>
                            <div class="col-sm-8">
                                <?php echo $rowsexect_prog_mst['exect_progm_fees']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Format</label>
                            <div class="col-sm-8">
                                <?php echo $rowsexect_prog_mst['exect_progm_frmat']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Duration</label>
                            <div class="col-sm-8">
                                <?php echo stripslashes($rowsexect_prog_mst['exect_progm_durtn']);?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Short Description</label>
                            <div class="col-sm-8">
                                <?php echo stripslashes($rowsexect_prog_mst['exect_progm_sdesc']);?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Overview</label>
                            <div class="col-sm-8">
                                <?php echo stripslashes($rowsexect_prog_mst['exect_progm_desc']);?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Priority </label>
                            <div class="col-sm-8">
                           <?php echo $rowsexect_prog_mst['exect_progm_prty'];?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-md-2 col-form-label">Status </label>
                            <div class="col-sm-8">
                            <?php if($rowsexect_prog_mst['exect_progm_sts']=='a') echo 'Active';?>
					<?php if($rowsexect_prog_mst['exect_progm_sts']=='i') echo 'Inactive';?>
                            </div>
                        </div>
                 <tr bgcolor="#FFFFFF">
				<td colspan="4">
          <table width="100%"  border="0" cellspacing="1" cellpadding="3">
          <td width="10%"  bgcolor=""><strong>Curriculum :-</strong></td>
          <tr>
                <td width="5%"  bgcolor="#f1f6fd"><strong>SL.No.</strong></td>
                <td width="40%" bgcolor="#f1f6fd"><strong>Name</strong></td>
				<td width="20%" bgcolor="#f1f6fd" align='left'><strong>Description</strong></td>
				<td width="20%" bgcolor="#f1f6fd"><strong>Rank</strong></td>
				<td width="20%"  bgcolor="#f1f6fd"><strong>Status</strong></td>
			  </tr>
			  <?php
			  $sqrycurr_dtl="SELECT 
								  prog_currm_name,prog_currm_prty,prog_currm_desc,
								  if(prog_currm_sts = 'a', 'Active','Inactive') as prog_currm_sts
                  from 
                  prog_curr_mst
                  where
                  prog_currm_prog_id ='$id'
                  order by
                  prog_currm_id"; 
	               $srscurr_dtl	= mysqli_query($conn,$sqrycurr_dtl);		
		             $cntexect_progcurr_dtl  = mysqli_num_rows($srscurr_dtl); 
			  	$cnt = $offset;
				if($cntexect_progcurr_dtl> 0 ){				
			  	while($rowexect_progcurr_dtl	  = mysqli_fetch_assoc($srscurr_dtl)){	
						$db_exect_progcurrnm   = $rowexect_progcurr_dtl['prog_currm_name']; 
						$db_exect_progcurrdesc  = $rowexect_progcurr_dtl['prog_currm_desc'];
						$db_exect_progcurrprty = $rowexect_progcurr_dtl['prog_currm_prty'];
						$db_exect_progcurrsts  = $rowexect_progcurr_dtl['prog_currm_sts'];
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
				<td bgcolor="#f1f6fd"><?php echo $db_exect_progcurrnm; ?></td>
				<td bgcolor="#f1f6fd"><?php echo $db_exect_progcurrdesc; ?></td>
				<td bgcolor="#f1f6fd"><?php echo $db_exect_progcurrprty; ?></td>				
				<td bgcolor="#f1f6fd"><?php echo $db_exect_progcurrsts;?></td>
			  </tr>
			  <?php
			  	}
			}

			  ?>
			  </table>
				</td>

				</tr>
        <br>
        <tr bgcolor="#FFFFFF">
				<td colspan="4">
				<table width="100%" border="0" cellspacing="1" cellpadding="3">
        <td width="10%"  bgcolor=""><strong>Faculty :-</strong></td>
				<tr>
                <td width="5%"  bgcolor="#f1f6fd"><strong>SL.No.</strong></td>
                <td width="40%" bgcolor="#f1f6fd"><strong>Name</strong></td>
                <td width="20%" bgcolor="#f1f6fd" align='left'><strong>Description</strong></td>
				<td width="20%" bgcolor="#f1f6fd" align='center'><strong>Image</strong></td>
				<td width="20%" bgcolor="#f1f6fd"><strong>Rank</strong></td>
				<td width="20%"  bgcolor="#f1f6fd"><strong>Status</strong></td>
			  </tr>
			  <?php
			  $sqryfac_dtl="SELECT 
								  prog_facm_name,prog_facm_desc,prog_facm_img,prog_facm_prty,
								  if(prog_facm_sts = 'a', 'Active','Inactive') as prog_facm_sts
							 from 
               prog_fac_mst
							 where 
               prog_facm_prog_id ='$id' 
							 order by 
								  prog_facm_id"; 
	               $srsfac_dtl	= mysqli_query($conn,$sqryfac_dtl);		
		           $cntevntfac_dtl  = mysqli_num_rows($srsfac_dtl);
			  	$cnt = $offset;
				if($cntevntfac_dtl > 0 ){				
			  	while($rowevntfac_dtl	  = mysqli_fetch_assoc($srsfac_dtl)){	
						$db_evntfacnm   = $rowevntfac_dtl['prog_facm_name'];
            $db_evntfacdesc  = $rowevntfac_dtl['prog_facm_desc'];
						$db_evntfacimg  = $rowevntfac_dtl['prog_facm_img'];
						$db_evntfacprty = $rowevntfac_dtl['prog_facm_prty'];
						$db_evntfacsts  = $rowevntfac_dtl['prog_facm_sts'];
							
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
				<td bgcolor="#f1f6fd"><?php echo $db_evntfacnm; ?></td>
        <td bgcolor="#f1f6fd"><?php echo $db_evntfacdesc  ?></td>
                <td bgcolor="#f1f6fd" align='center'>
				<?php
					$facimgnm   = $db_evntfacimg;
					$facimgpath = $a_exec_prog.$facimgnm;					
				  if(($facimgnm !="") && file_exists($facimgpath)){
					 echo "<img src='$facimgpath' width='80pixel' height='80pixel'>";
				  }
				  else{
					 echo "Image not available";
				  }
				?>
				</td>				
				<td bgcolor="#f1f6fd"><?php echo $db_evntfacprty; ?></td>				
				<td bgcolor="#f1f6fd"><?php echo $db_evntfacsts;?></td>
			  </tr>
			  <?php
			  	}
			}
			else{
				echo "<tr bgcolor='#FFFFFF'>
							<td colspan='5' bgcolor='#f1f6fd' align='center'>Image not available1</td>
						</tr>";
			}
			  ?>
			  </table>
				</td>
				
				</tr>
        <br>  
        <tr bgcolor="#FFFFFF">
<td colspan="4">
  <table width="100%"  border="0" cellspacing="1" cellpadding="3">
  <td width="10%"  bgcolor=""><strong>Participant Stories:-</strong></td>
  <tr>
        <td width="5%"  bgcolor="#f1f6fd"><strong>SL.No.</strong></td>
        <td width="40%" bgcolor="#f1f6fd"><strong>Name</strong></td>
<td width="20%" bgcolor="#f1f6fd" align='left'><strong>link</strong></td>
<td width="20%" bgcolor="#f1f6fd"><strong>Rank</strong></td>
<td width="20%"  bgcolor="#f1f6fd"><strong>Status</strong></td>
</tr>
<?php
  $sqryps_dtl="SELECT 
          prog_psm_name,prog_psm_prty,prog_psm_lnk,
          if(prog_psm_sts = 'a', 'Active','Inactive') as prog_psm_sts
          from 
          prog_ps_mst
          where
          prog_psm_prog_id ='$id'
          order by
          prog_psm_id";  
         $srsps_dtl	= mysqli_query($conn,$sqryps_dtl);		
         $cntexect_progps_dtl  = mysqli_num_rows($srsps_dtl); 
  $cnt = $offset;
if($cntexect_progps_dtl> 0 ){				
  while($rowexect_progps_dtl	  = mysqli_fetch_assoc($srsps_dtl)){	
    $db_exect_progpsnm   = $rowexect_progps_dtl['prog_psm_name']; 
    $db_exect_progpslnk  = $rowexect_progps_dtl['prog_psm_lnk'];
    $db_exect_progpsprty = $rowexect_progps_dtl['prog_psm_prty'];
    $db_exect_progpssts  = $rowexect_progps_dtl['prog_psm_sts'];
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
<td bgcolor="#f1f6fd"><?php echo $db_exect_progpsnm; ?></td>
<td bgcolor="#f1f6fd"><?php echo $db_exect_progpslnk; ?></td>  
<td bgcolor="#f1f6fd"><?php echo $db_exect_progpsprty; ?></td>				
<td bgcolor="#f1f6fd"><?php echo $db_exect_progpssts;?></td>
</tr>
<?php
  }
}

?>
</table>
</td>

</tr>
                        <p class="text-center">
					<input type="button" class="btn btn-primary btn-cst"  name="btnedtexect_prog" id="btnedtexect_prog" value="Edit" onclick="location.href='edit_exect_prog.php?edit=<?php echo $rowsexect_prog_mst['exect_progm_id'];?>&pg=<?php echo $pg."&countstart=".$cntstart;?>&val=<?php echo $val;?>&optn=<?php echo $opt;?>&chk=<?php echo $ck;?>'">
                    &nbsp;&nbsp;&nbsp;
					<input type="button"  name="btnBack" value="Back"class="btn btn-primary btn-cst" onclick="location.href='view_all_exect_prog.php?pg=<?php echo $pg;?>&countstart=<?php echo $cntstart;?>&optn=<?php echo $opt;?>&val=<?php echo $val;?>&chk=<?php echo $ck;?>'">
                    </p>
                    </div>
                </div></div></div>
		</form>
</section>
<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>