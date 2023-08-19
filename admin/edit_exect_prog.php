<?php
error_reporting(0);
	include_once "../includes/inc_nocache.php"; // Clearing the cache information
	include_once "../includes/inc_adm_session.php";//checking for session
	include_once "../includes/inc_connection.php";//Making database Connection
	include_once '../includes/inc_config.php';
	include_once '../includes/inc_usr_functions.php';//Use function for validation and more 
	include_once '../includes/inc_folder_path.php';//Folder Paths	
	include_once 'searchpopcalendar.php';	
	/***************************************************************/  
	//Programm 	  : edit_event.php
	//Package 	  : APVC	 
	//Purpose 	  : Updating new events 
	//Created By  :Lokesh palagani
	//Created On  :	26-06-2023
	//Modified By : 
	//Modified On : 
	//Company 	  : Adroit
	/************************************************************/
	global $id,$pg,$countstart;
    $rd_vwpgnm = "view_detail_exect_prog.php";
    $rd_crntpgnm = "view_all_exect_prog.php";
/*****header link********/
$pagemncat = "Executive Programs";
$pagecat = "Executive Programs";
$pagenm = "Executive Programs";
/*****header link********/
	if(isset($_POST['btnedtexect_prog']) && (trim($_POST['btnedtexect_prog']) != "") && 	
	   isset($_POST['txtname']) && ($_POST['txtname'] != "") && 
       isset($_POST['txtdesc']) && ($_POST['txtdesc'] != "") && 
	   isset($_POST['txtprior']) && ($_POST['txtprior'] != "") && 
	   isset($_POST['hdnexect_progid']) && ($_POST['hdnexect_progid'] != "")){	

		include_once '../includes/inc_fnct_fleupld.php'; // For uploading files	
    include_once "../database/uqry_exect_prog_mst.php";
	}
	if(isset($_REQUEST['edit']) && $_REQUEST['edit']!=""
	&& isset($_REQUEST['pg']) && $_REQUEST['pg']!=""
	&& isset($_REQUEST['countstart']) && $_REQUEST['countstart']!="")
	{
		$id 	  = glb_func_chkvl($_REQUEST['edit']);
		$pg 	  = glb_func_chkvl($_REQUEST['pg']);
		$cntstart = glb_func_chkvl($_REQUEST['countstart']);
		$value    = glb_func_chkvl($_REQUEST['val']);
		$opt 	  = glb_func_chkvl($_REQUEST['optn']);
		$ck 	  = glb_func_chkvl($_REQUEST['chk']);	
	}
	else if(isset($_REQUEST['hdnexect_progid']) && $_REQUEST['hdnexect_progid']!=""
	&& isset($_REQUEST['hdnpage']) && $_REQUEST['hdnpage']!=""
	&& isset($_REQUEST['hdncnt']) && $_REQUEST['hdncnt']!="")
	{
		$id 	  = glb_func_chkvl($_REQUEST['hdnexect_progid']);
		$pg 	  = glb_func_chkvl($_REQUEST['hdnpage']);
		$cntstart = glb_func_chkvl($_REQUEST['hdncnt']);
		$value    = glb_func_chkvl($_REQUEST['hdnval']);
		$opt 	  = glb_func_chkvl($_REQUEST['hdnoptn']);
		$ck 	  = glb_func_chkvl($_REQUEST['hdnchk']);
	}
   $sqryexect_prog_mst="SELECT exect_progm_id,exect_progm_name,exect_progm_desc,exect_progm_sdesc,exect_progm_durtn,exect_progm_img,exect_progm_brochimg,exect_progm_frmdt,exect_progm_todt,exect_progm_fees,exect_progm_frmat,exect_progm_sts,exect_progm_prty, exect_catm_name,exect_scatm_name,exect_progm_catm_id,exect_progm_scatm_id from exect_prog_mst
  inner join exect_cat_mst on		exect_cat_mst.exect_catm_id=exect_prog_mst.exect_progm_catm_id
  inner join exect_scat_mst on		exect_scat_mst.exect_scatm_id=exect_prog_mst.exect_progm_scatm_id
   where 
   exect_progm_id=$id"; 
	$srsexect_prog_mst  = mysqli_query($conn,$sqryexect_prog_mst);
	$rowsexect_prog_mst = mysqli_fetch_assoc($srsexect_prog_mst);
  $catid1 = $rowsexect_prog_mst['exect_progm_catm_id']
	// $ev_typ=$rowsexect_prog_mst['exect_progm_typ'];
	// if(isset($_REQUEST['imgid']) && (trim($_REQUEST['imgid']) != "") && 	
	// 	   isset($_REQUEST['edit']) && (trim($_REQUEST['edit']) != "") ){
		   
	// 		$imgid      = glb_func_chkvl($_REQUEST['imgid']);
	// 		$pgdtlid    = glb_func_chkvl($_REQUEST['edit']);	   
	// 		$pg         = glb_func_chkvl($_REQUEST['pg']);
	// 		$cntstart   = glb_func_chkvl($_REQUEST['cntstart']);
	// 		$sqryprog_currm_dtl="SELECT 
	// 							  prog_currm_img
	// 						 from 
	// 							  exect_progimg_dtl
	// 						 where
	// 							  prog_currm_exect_progm_id='$pgdtlid'  and
	// 							  prog_currm_id = '$imgid'";				 				 				 				 			
	// 		 $srsprog_currm_dtl     = mysqli_query($conn,$sqryprog_currm_dtl);
	// 		 $srowprog_currm_dtl    = mysqli_fetch_assoc($srsprog_currm_dtl);		     			   				
	// 		 $smlimg[$i]      = glb_func_chkvl($srowprog_currm_dtl['prog_currm_img']);
	// 		 $smlimgpth[$i]   = $u_imgexect_prog_fldnm.$smlimg[$i];
	// 		 $delimgsts = funcDelAllRec($conn,'exect_progimg_dtl','prog_currm_id',$imgid);
	// 		 if($delimgsts == 'y'  ){
	// 			 if(($smlimg[$i] != "") && file_exists($smlimgpth[$i])) {
	// 					unlink($smlimgpth[$i]);
	// 			 }			
	// 		}
	// 	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="yav-style.css" type="text/css" rel="stylesheet">
<title><?php echo $pgtl; ?></title>
	<script language="javascript" src="../includes/yav.js"></script>
	<script language="javascript" src="../includes/yav-config.js"></script>	
	<script language="javascript" type="text/javascript">
      get_ckeditor();
    	var rules=new Array();
    	rules[0]='txtname:Event Name|required|Enter name';
		rules[1]='txtdesc:Event Description|required|Enter Description';
    	rules[2]='txtprior:Priority|required|Enter Priority';
		rules[3]='txtprior:Priority|numeric|Enter Only Numbers';
		//rules[4]='txtcity:City|required|Enter City';
		rules[4]='txtstdate:Start Date|required|Enter Start Date';
	//	rules[6]='txtnvets:Vets|required|Enter No. of Vets/Batches';
	</script>
  <script language="javaScript" type="text/javascript" src="js/ckeditor/ckeditor.js"></script>

	<?php
  
		include_once "../includes/inc_fnct_ajax_validation.php"; //Includes ajax validations				
	?>	
<script language="javascript" type="text/javascript">
	function funcChkDupName() {
		debugger;
		var name = document.getElementById('txtname').value;
		var prodmncatid = document.getElementById('lstprodmcat').value;
		var prodcatid = document.getElementById('lstprodcat').value;
		id = <?php echo $id; ?>;
		if (prodmncatid != "" && prodcatid != "" && name != "" && id != "") {
			var url = "chkduplicate.php?exectprogmname=" + name + "&prodmncatid=" + prodmncatid + "&prodcatid=" + prodcatid + "&subcatid=" + id;
			xmlHttp = GetXmlHttpObject(stateChanged);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		} else {
			document.getElementById('errorsDiv_lstprodmcat').innerHTML = "";
			document.getElementById('errorsDiv_lstprodcat').innerHTML = "";
			document.getElementById('errorsDiv_txtname').innerHTML = "";
		}
	}

	function stateChanged() {
		if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
			var temp = xmlHttp.responseText;
			//alert(temp);
			document.getElementById("errorsDiv_txtname").innerHTML = temp;
			if (temp != 0) {
				document.getElementById('txtname').focus();
			}
		}
	}
  function get_exec_scat() {
    debugger
    var execcatval = $("#lstexect_cat").val();
    $.ajax({
      type: "POST",
      url: "../includes/inc_getStsk.php",
      data: 'execcatval=' + execcatval,
      success: function(data) {
        // alert(data)
        $("#lstexect_scat").html(data);
      }
    });
  }
</script>
	<?php 
		include_once ('script.php');
		//include_once ('searchpopcalendar.php');		
	?>
</head>
<body >
<?php 
	include_once '../includes/inc_adm_header.php';
	include_once '../includes/inc_adm_leftlinks.php';?>


<section class="content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Executive Programs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Executive Programs</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

          
		  <form name="frmedtexect_prog" id="frmedtexect_prog" method="post" action="<?php $_SERVER['PHP_SELF'];?>" onSubmit="return performCheck('frmedtexect_prog', rules, 'inline');" enctype="multipart/form-data">
		  <input type="hidden" name="hdnexect_progid" value="<?php echo $id;?>">
		  <input type="hidden" name="hdnpage" value="<?php echo $pg;?>">
		  <input type="hidden" name="hdncnt" value="<?php echo $countstart?>">
		  <input type="hidden" name="hdnsimg" id="hdnsimg" value="<?php echo $rowsexect_prog_mst['exect_progm_img'];?>">
      <input type="hidden" name="hdnbroch" id="hdnbroch" value="<?php echo $rowsexect_prog_mst['exect_progm_brochimg'];?>">
		  <input type="hidden" name="hdnexect_prognm" id="hdnexect_prognm" value="<?php echo $rowsexect_prog_mst['exect_progm_fle']?>">
		 
          <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <div class="row mb-2 mt-2">
                      <div class="col-sm-3">
                        <label>Category *</label>
                      </div>
                      <div class="col-sm-9">
                        <?php
                        $sqryexect_cat_mst = "SELECT 
                        exect_catm_id,exect_catm_name
                        from
                        exect_cat_mst
                        where	
                        exect_catm_sts = 'a'
                        order by
                        exect_catm_name";
                        $rsexect_cat_mst = mysqli_query($conn, $sqryexect_cat_mst);
                        $cnt_exect_cat = mysqli_num_rows($rsexect_cat_mst);
                        ?>
                        <select name="lstexect_cat" id="lstexect_cat" class="form-control" onchange="get_exec_scat();">
                        <option value="">--Select Main Category--</option>
                        <?php
                        if ($cnt_exect_cat > 0) {
                          while ($rowsexect_cat_mst = mysqli_fetch_assoc($rsexect_cat_mst)) {
                             $exectcatid = $rowsexect_cat_mst['exect_catm_id']; 
                             $exectcatname = $rowsexect_cat_mst['exect_catm_name'];
                             ?>
                             <option value="<?php echo $exectcatid; ?>" <?php if ($rowsexect_prog_mst['exect_progm_catm_id'] == $exectcatid) echo 'selected';  ?>><?php echo $exectcatname; ?></option>
                             <?php
                             }
                            }
                            ?>
                            </select>
                            <span id="errorsDiv_lstprodcat"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="row mb-2 mt-2">
                           <div class="col-sm-3">
                            <label>Sub Category *</label>
                          </div>
                          <div class="col-sm-9">
                            <?php
                            $sqryexect_scat_mst = "SELECT 
                            exect_scatm_id,exect_scatm_name
                            from
                            exect_scat_mst
                            where	
                            exect_scatm_sts = 'a' and exect_scatm_catm_id= $catid1
                            order by
                            exect_scatm_name"; 
                            $rsexect_scat_mst = mysqli_query($conn, $sqryexect_scat_mst);
                            $cnt_exect_scat = mysqli_num_rows($rsexect_scat_mst);
                            ?>
                            <select name="lstexect_scat" id="lstexect_scat" class="form-control">
                            <option value="">--Select Sub Category--</option>
                            <?php
                            if ($cnt_exect_scat > 0) {
                              while ($rowsexect_scat_mst = mysqli_fetch_assoc($rsexect_scat_mst)) {
                                $exectscatid = $rowsexect_scat_mst['exect_scatm_id']; 
                                $exectscatname = $rowsexect_scat_mst['exect_scatm_name']; 
                                ?>
                                <option value="<?php echo $exectscatid; ?>" <?php if ($rowsexect_prog_mst['exect_progm_scatm_id'] == $exectscatid) echo 'selected';  ?>><?php echo $exectscatname; ?></option>
                                <?php
                                }
                                }
                                ?>
                                </select>
                                <span id="errorsDiv_lstprodcat"></span>
                              </div>
                            </div>
                          </div>                      
                    <div class="col-md-12">
                        <div class="row mb-2 mt-2">
                            <div class="col-sm-3">
                                <label>Name *</label>
                            </div>
                            <div class="col-sm-9">
                            <input name="txtname" type="text" value="<?php echo $rowsexect_prog_mst['exect_progm_name'];?>" class="form-control"  id="txtname" size="45" maxlength="240" 
						 onBlur="funcChkDupName()">
                                <span id="errorsDiv_txtname"></span>	
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                      <div class="row mb-2 mt-2">
                        <div class="col-sm-3">
                          <label>Image</label>
                        </div>
                        <div class="col-sm-9">
                          <div class="custom-file">
                            <input name="fledexect_progimg" type="file" class="form-control" id="fledexect_progimg">
                          </div>
                          <?php
                          $exect_progimgnm = $rowsexect_prog_mst['exect_progm_img'];
                          $exect_progimgpath = $a_exec_prog . $exect_progimgnm;
                          if (($exect_progimgnm != "") && file_exists($exect_progimgpath)) {
                            echo "<img src='$exect_progimgpath' width='60pixel' height='60pixel'><br><input type='checkbox' name='chkbximg' id='chkbximg' value='$exect_progimgpath'>Remove Image";
                            // echo "<img src='$exect_progimgpath' width='50pixel' height='50pixel'>";
                          } else {
                            echo "N.A";
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="row mb-2 mt-2">
                        <div class="col-sm-3">
                          <label>Brochure</label>
                        </div>
                        <div class="col-sm-9">
                          <div class="custom-file">
                            <input name="fledexect_brocher" type="file" class="form-control" id="fledexect_brocher">
                          </div>
                          <?php
                          $exect_progbrochnm = $rowsexect_prog_mst['exect_progm_brochimg'];
                          $exect_progbrochpath = $a_exec_prog . $exect_progbrochnm;
                          if (($exect_progbrochnm != "") && file_exists($exect_progimgpath)) {
                            echo "<img src='$exect_progbrochpath' width='60pixel' height='60pixel'><br><input type='checkbox' name='chkbximg' id='chkbximg' value='$exect_progbrochpath'>Remove Image";
                            // echo "<img src='$exect_progimgpath' width='50pixel' height='50pixel'>";
                          } else {
                            echo "N.A";
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="row mb-2 mt-2">
                        <div class="col-sm-3">
                          <label>From Date</label>
                        </div>
                        <div class="col-sm-9">
                                        <input type="date" name="fledexect_frmdt" id="fledexect_frmdt" value="<?php echo $rowsexect_prog_mst['exect_progm_frmdt'];?>"class="form-control" >
                          <span id="errorsDiv_fledexect_frmdt"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="row mb-2 mt-2">
                        <div class="col-sm-3">
                          <label>To Date</label>
                        </div>
                        <div class="col-sm-9">
                                        <input type="date" name="fledexect_todt" id="fledexect_todt" value="<?php echo $rowsexect_prog_mst['exect_progm_todt'];?>"class="form-control" >
                          <span id="errorsDiv_fledexect_todt"></span>
                        </div>
                      </div>
                    </div> 
                    <div class="col-md-12">
                      <div class="row mb-2 mt-2">
                        <div class="col-sm-3">
                          <label>Fees</label>
                        </div>
                        <div class="col-sm-9">
                                        <input type="text" name="fledexect_fees" id="fledexect_fees" value="<?php echo $rowsexect_prog_mst['exect_progm_fees'];?>"class="form-control" >
                          <span id="errorsDiv_fledexect_fees"></span>
                        </div>
                      </div>
                    </div>                  
                    <div class="col-md-12">
                      <div class="row mb-2 mt-2">
                        <div class="col-sm-3">
                          <label>Duration</label>
                        </div>
                        <div class="col-sm-9">
                                        <input type="text" name="textexect_durtion" id="textexect_durtion" value="<?php echo $rowsexect_prog_mst['exect_progm_durtn'];?>"class="form-control" >
                          <span id="errorsDiv_textexect_durtion"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="row mb-2 mt-2">
                        <div class="col-sm-3">
                          <label>Format</label>
                        </div>
                        <div class="col-sm-9">
                                        <input type="text" name="fledexect_frmt" id="fledexect_frmt" value="<?php echo $rowsexect_prog_mst['exect_progm_frmat'];?>"class="form-control" >
                          <span id="errorsDiv_fledexect_frmt"></span>
                        </div>
                      </div>
                    </div>  
                    <div class="col-md-12">
                        <div class="row mb-2 mt-2">
                            <div class="col-sm-3">
                                <label>Short Description </label>
                            </div>
                            <div class="col-sm-9">
                            <textarea name="txtsdesc" cols="60" rows="5" class="form-control"  id="txtsdesc" ><?php echo stripslashes($rowsexect_prog_mst['exect_progm_sdesc']);?></textarea>
                                <span id="errorsDiv_txtsdesc"></span>	
                            </div>
                        </div>
                    </div>                  
                    <div class="col-md-12">
                        <div class="row mb-2 mt-2">
                            <div class="col-sm-3">
                                <label>Overview </label>
                            </div>
                            <div class="col-sm-9">
                            <textarea name="txtdesc" cols="60" rows="5" class="form-control"  id="txtdesc" ><?php echo stripslashes($rowsexect_prog_mst['exect_progm_desc']);?></textarea>
                                <span id="errorsDiv_txtdesc"></span>	
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Rank *</label>
								</div>
								<div class="col-sm-9">
                                <input type="text" name="txtprior" id="txtprior" value="<?php echo $rowsexect_prog_mst['exect_progm_prty'];?>"class="form-control" >
									<span id="errorsDiv_txtprior"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Status</label>
								</div>
								<div class="col-sm-9">
									<select name="lststs" id="lststs" class="form-control">
                                    <option value="a"<?php if($rowsexect_prog_mst['exect_progm_sts']=='a') echo 'selected';?>>Active</option>
						<option value="i"<?php if($rowsexect_prog_mst['exect_progm_sts']=='i') echo 'selected';?>>Inactive</option>
									</select>

								</div>
							</div>
						</div> -->
            <div class="table-responsive">
              <div class="col-sm-3">
                <label>Curriculm:-</label>
              </div>
              <table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
                <tr bgcolor="#FFFFFF">
                  <td width="1%"  align="center" ><strong>S.No.</strong></td>
                  <td width="10%" align="center" ><strong>Name</strong></td>
                  <td width="10%" align="center" ><strong>Description</strong></td>
                  <td width="10%"  align="center" ><strong>Priority</strong></td>
                  <td width="10%"  align="center" ><strong>Status</strong></td>
                  <td width="10%"  align="center" ><strong>Remove</strong></td>
                </tr>
              </table>
            </div> 
            <?php
            $sqryimg_dtl="SELECT 
            prog_currm_id,prog_currm_name,prog_currm_desc,prog_currm_prog_id,
            prog_currm_prty,prog_currm_sts
            from 
             prog_curr_mst
             where 
             prog_currm_prog_id ='$id' 
             order by 
             prog_currm_id";
             $srsimg_dtl	= mysqli_query($conn,$sqryimg_dtl);	
             $cntexect_progimg_dtl  = mysqli_num_rows($srsimg_dtl);
			  	$nfiles = "";
				if($cntexect_progimg_dtl> 0 ){
				?>
				<?php				
			  	while($rowsprog_currm_mdtl=mysqli_fetch_assoc($srsimg_dtl)){				
					$prog_currmid 	  = $rowsprog_currm_mdtl['prog_currm_id'];
					$db_exect_progimgnm   = $rowsprog_currm_mdtl['prog_currm_name'];
					// $arytitle     = explode("-",$db_exect_progimgnm);
          $db_exect_progimgdesc   = $rowsprog_currm_mdtl['prog_currm_desc'];
				  $db_exect_progimgprty = $rowsprog_currm_mdtl['prog_currm_prty']; 
					$db_exect_progimgsts  = $rowsprog_currm_mdtl['prog_currm_sts'];
					
					// $imgnm = $db_exect_progimgimg;					
					// $imgpath = $imgexect_prog_fldnm.$imgnm;
					$nfiles+=1; 
					$clrnm = "";
					if($cnt%2==0){
						$clrnm = "bgcolor='#f1f6fd'";
					}
					else{
						$clrnm = "bgcolor='#f1f6fd'";
					}
			  ?>
<div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered" >
										<table width="100%" border="0" cellspacing="3" cellpadding="3">
											<tr bgcolor="#FFFFFF">
                                            <input type="hidden" name="hdnpgdid<?php echo $nfiles?>" class="select" value="<?php echo $prog_currmid;?>">
                                            <td width='5%'><?php echo  $nfiles;?></td>
												
												<td width="15%"  align="center">
													<input type="text" name="txtcurrname<?php echo $nfiles?>" id="txtcurrname<?php echo $nfiles?>" placeholder="Name" class="form-control" size="15" value='<?php echo  $db_exect_progimgnm?>'><br>
													<span id="errorsDiv_txtcurrname" style="color:#FF0000"></span>
												</td>
                        <td width="15%"  align="center">
													<input type="text" name="txtcurrdesc<?php echo $nfiles?>" id="txtcurrdesc<?php echo $nfiles?>" placeholder="Name" class="form-control" size="15" value='<?php echo  $db_exect_progimgdesc?>'><br>
													<span id="errorsDiv_txtcurrdesc" style="color:#FF0000"></span>
												</td> 
												<td width="10%"  align="center">
													<input type="text" name="txtcurrprior" id="txtcurrprior" class="form-control" value="<?php echo $db_exect_progimgprty;?>"size="15"><br>
													<span id="errorsDiv_txtcurrprior" style="color:#FF0000"></span>
												</td>
												<td width="10%" align="center" >					
													<select name="lstcurrsts<?php echo $nfiles?>" id="lstcurrsts<?php echo $nfiles?>" class="form-control">
													<option value="a" <?php if($db_exect_progimgsts =='a') echo 'selected'; ?>>Active</option>
									<option value="i" <?php if($db_exect_progimgsts =='i') echo 'selected'; ?>>Inactive</option>
													</select>
												</td>
												<td width='10%' align="center">
													<!-- <input type="button" name="test" value="test" onclick="test_fnc();"> -->
												<input type="button"  name="btnrmv"  value="REMOVE"  onclick="rmvimg('<?php echo $prog_currmid; ?>')"></td>

											</tr>
											<?php
			  	}
				}

				?>
										</table>
									</table>
									<input type="hidden" id="hdntotcntrl"  name="hdntotcntrl" value="<?php echo $nfiles;?>">
									<div id="myDiv">
										<table width="100%" cellspacing='2' cellpadding='3'>
											<tr>
												<td align="center">
													<input name="btnadd" type="button" onClick="expand_curr()" value="Add Another Curriculum" class="btn btn-primary mb-3">
												</td>
											</tr>
											
										</table>
									</div>
								</div>
                <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Faculty :-</label>
                </div>
              </div>
            </div>
            
            <div class="table-responsive">
							<table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
								<tr bgcolor="#FFFFFF">
									<td width="5%" align="center"><strong>SL.No.</strong></td>
									<td width="15%" align="left"><strong>Name</strong></td>
                  <td width="25%" align="left"><strong>Description</strong></td>
									<td width="25%" align="left"><strong>Image</strong></td>
									<td width="10%" align="left"><strong>Rank</strong></td>
									<td width="10%" align="center"><strong>Status</strong></td>
                  <td width="10%"  align="center" ><strong>Remove</strong></td>
								</tr>
							</table>
						</div>
            <?php
                  $sqryfac_dtl="SELECT 
                  prog_facm_id,prog_facm_name,prog_facm_desc,prog_facm_img,prog_facm_prog_id,
                  prog_facm_prty,prog_facm_sts
                  from 
                  prog_fac_mst
                  where 
                  prog_facm_prog_id ='$id' 
                  order by 
                  prog_facm_id";
                  $srsfac_dtl	= mysqli_query($conn,$sqryfac_dtl);	
                  $cntexect_progfac_dtl  = mysqli_num_rows($srsfac_dtl);
                  $nfiles = "";
                  if($cntexect_progfac_dtl> 0 ){
                  ?>
                  <?php				
                  while($rowsprog_facm_mdtl=mysqli_fetch_assoc($srsfac_dtl)){				
                  $prog_facmid 	  = $rowsprog_facm_mdtl['prog_facm_id'];
                  $db_exect_progfacnm   = $rowsprog_facm_mdtl['prog_facm_name'];
                  // $arytitle     = explode("-",$db_exect_progfacnm);
                  $db_exect_progfacimg   = $rowsprog_facm_mdtl['prog_facm_img']; 
                  $db_exect_progfacdesc   = $rowsprog_facm_mdtl['prog_facm_desc']; 
                  $db_exect_progfacprty = $rowsprog_facm_mdtl['prog_facm_prty'];
                  $db_exect_progfacsts  = $rowsprog_facm_mdtl['prog_facm_sts'];
                  $imgnm = $db_exect_progfacimg;					
                  $imgpath = $a_exec_prog.$imgnm;
                  $facfiles+=1;
                  $clrnm = "";
                  if($cnt%2==0){
                    $clrnm = "bgcolor='#f1f6fd'";
                  }
                  else{
                    $clrnm = "bgcolor='#f1f6fd'";
                  }

                  // $facnm = $db_exect_progfacfac;					
                  // $facpath = $facexect_prog_fldnm.$facnm;
                  $nfiles+=1; 
                  $clrnm = "";
                  if($cnt%2==0){
                  $clrnm = "bgcolor='#f1f6fd'";
                  }
                  else{
                  $clrnm = "bgcolor='#f1f6fd'";
                  }
                  ?>

						<div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered" >
										<table width="100%" border="0" cellspacing="3" cellpadding="3">
											<tr bgcolor="#FFFFFF">
											<td width="5%" align="center"><?php echo $facfiles?></td>
												<td width="15%"  align="center">
													<input type="text" name="txtfacname<?php echo $facfiles?>" id="txtfacname<?php echo $facfiles?>" placeholder="Name" class="form-control" size="15" value='<?php echo  $db_exect_progfacnm?>'><br>
													<span id="errorsDiv_txtfacname1" style="color:#FF0000"></span>
												</td>
                        <td width="25%" align="center">
                      <textarea name="txtfacdesc<?php echo $facfiles?>" cols="35" rows="3" id="txtfacdesc<?php echo $facfiles?>" 
                      size="15"  ><?php echo   $db_exect_progfacdesc ?></textarea>
                      <span id="errorsDiv_txtfacdesc" style="color:#FF0000"></span>
                    </td>
												<td width="25%"  align="center">
													<input type="file" name="flefacsimg<?php echo $facfiles?>" id="flefacsimg" class="form-control" size="15"><br>
                          <?php						   
									  if(($imgnm !="") && file_exists($imgpath)){
											 echo "<img src='$imgpath' width='30pixel' height='30pixel'>";
									  }
									  else{
										 echo "No Image";
									  }
								  ?>
													<span id="errorsDiv_flefacsimg1" style="color:#FF0000"></span>
												</td>
												<td width="10%"  align="center">
													<input type="text" name="txtfacprior" id="txtfacprior" class="form-control" value="<?php echo $db_exect_progfacprty;?>"size="15"><br>
													<span id="errorsDiv_txtfacprior1" style="color:#FF0000"></span>
												</td>
												<td width="10%" align="center" >					
													<select name="lstfacsts" id="lstfacsts" class="form-control">
                          <option value="a" <?php if($db_exect_progfacsts =='a') echo 'selected'; ?>>Active</option>
														<option value="i"<?php if($db_exect_progfacsts =='i') echo 'selected'; ?>>Inactive</option>
													</select>
												</td>
                        <td width='10%' align="center">
													<!-- <input type="button" name="test" value="test" onclick="test_fnc();"> -->
												<input type="button"  name="btnfacrmv"  value="REMOVE"  onclick="rmvfac('<?php echo $prog_facmid; ?>')"></td>
                    
											</tr>
                      <?php
                        }}?>
										</table>
									</table>
                  <div id="myDiv2">
										<table width="100%" cellspacing='2' cellpadding='3'>
											<tr>
												<td align="center">
													<input name="btnadd2" type="button" onClick="expand_fac()" value="Add Another Faculty" class="btn btn-primary mb-3">
												</td>
											</tr>
										</table>
									</div>
							</div>
                              
								<input type="hidden" id="hdntotcntrl2" name="hdntotcntrl2" value="<?php echo $facfiles?>">

              <div class="col-md-12">
              <div class="row mb-2 mt-2">
                <div class="col-sm-3">
                  <label>Participant Stories :-</label>
                </div>
              </div>
            </div>
            <div class="table-responsive">
							<table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
								<tr bgcolor="#FFFFFF">
									<td width="5%" align="center"><strong>SL.No.</strong></td>
									<td width="15%" align="left"><strong>Name</strong></td>
                  <td width="20%" align="left"><strong>Link</strong></td>
									<td width="10%" align="left"><strong>Rank</strong></td>
									<td width="10%" align="center"><strong>Status</strong></td>
                  <td width="10%"  align="center" ><strong>Remove</strong></td>
								</tr>
							</table>
						</div>
                  <?php
                    $sqryps_dtl="SELECT 
                    prog_psm_id,prog_psm_name,prog_psm_lnk,prog_psm_prog_id,
                    prog_psm_prty,prog_psm_sts
                    from 
                    prog_ps_mst
                    where 
                    prog_psm_prog_id ='$id' 
                    order by 
                    prog_psm_id";
                    $srsps_dtl	= mysqli_query($conn,$sqryps_dtl);	
                    $cntexect_progps_dtl  = mysqli_num_rows($srsps_dtl);
                    $psfiles = "";
                    if($cntexect_progps_dtl> 0 ){
                    ?>
                    <?php				
                    while($rowsprog_psm_mdtl=mysqli_fetch_assoc($srsps_dtl)){				
                    $prog_psmid 	  = $rowsprog_psm_mdtl['prog_psm_id'];
                    $db_exect_progpsnm   = $rowsprog_psm_mdtl['prog_psm_name'];
                    // $arytitle     = explode("-",$db_exect_progpsnm);
                    $db_exect_progpslnk   = $rowsprog_psm_mdtl['prog_psm_lnk'];
                    $db_exect_progpsprty = $rowsprog_psm_mdtl['prog_psm_prty']; 
                    $db_exect_progpssts  = $rowsprog_psm_mdtl['prog_psm_sts'];

                    // $psnm = $db_exect_progpsps;					
                    // $pspath = $psexect_prog_fldnm.$psnm;
                    $psfiles+=1; 
                    $clrnm = "";
                    if($cnt%2==0){
                    $clrnm = "bgcolor='#f1f6fd'";
                    }
                    else{
                    $clrnm = "bgcolor='#f1f6fd'";
                    }
                  ?>
            <div class="table-responsive">
									<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered" >
										<table width="100%" border="0" cellspacing="3" cellpadding="3">
											<tr bgcolor="#FFFFFF">
											<td width="5%" align="center"><?php echo $psfiles?></td>
												<td width="15%"  align="center">
													<input type="text" name="txtpsname<?php echo $facfiles?>" id="txtpsname<?php echo $facfiles?>" placeholder="Name" class="form-control" size="15" value='<?php echo  $db_exect_progpsnm?>'><br>
													<span id="errorsDiv_txtpsname" style="color:#FF0000"></span>
												</td>
                        <td width="20%" align="center">
                        <input type="text" name="txtpslink<?php echo $facfiles?>" cols="60" rows="3" id="txtpslink<?php echo $facfiles?>" class="form-control" value='<?php echo  $db_exect_progpslnk?>'><br>
                      <span id="errorsDiv_txtpslink" style="color:#FF0000"></span>
                    </td>
                    <td width="10%"  align="center">
													<input type="text" name="txtpsprior<?php echo $facfiles?>" id="txtpsprior<?php echo $facfiles?>" class="form-control" size="15" value='<?php echo  $db_exect_progpsprty?>'><br>
													<span id="errorsDiv_txtpsprior" style="color:#FF0000"></span>
												</td>
												<td width="10%" align="center" >					
													<select name="lstpssts<?php echo $facfiles?>" id="lstpssts<?php echo $facfiles?>" class="form-control">
														<option value="a" <?php if($db_exect_progpssts =='a') echo 'selected'; ?>>Active</option>
														<option value="i"<?php if($db_exect_progpssts =='i') echo 'selected'; ?>>Inactive</option>
													</select>
												</td>
                        <td width='10%' align="center">
													<!-- <input type="button" name="test" value="test" onclick="test_fnc();"> -->
												<input type="button"  name="btnpsrmv"  value="REMOVE"  onclick="rmvps('<?php echo $prog_psmid; ?>')"></td>
											</tr>
                      <?php
                      }}?>
										</table>
									</table>
                  <div id="myDiv3">
										<table width="100%" cellspacing='2' cellpadding='3'>
											<tr>
												<td align="center">
													<input name="btnadd3" type="button" onClick="expand_ps()" value="Add Another Participant Stories" class="btn btn-primary mb-3">
												</td>
											</tr>
										</table>
									</div>
							</div>
								<input type="hidden" id="hdntotcntrl3" name="hdntotcntrl3" value="<?php echo $psfiles?>">
                <div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Rank *</label>
								</div>
								<div class="col-sm-9">
                                <input type="text" name="txtprior" id="txtprior" value="<?php echo $rowsexect_prog_mst['exect_progm_prty'];?>"class="form-control" >
									<span id="errorsDiv_txtprior"></span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row mb-2 mt-2">
								<div class="col-sm-3">
									<label>Status</label>
								</div>
								<div class="col-sm-9">
									<select name="lststs" id="lststs" class="form-control">
                                    <option value="a"<?php if($rowsexect_prog_mst['exect_progm_sts']=='a') echo 'selected';?>>Active</option>
						<option value="i"<?php if($rowsexect_prog_mst['exect_progm_sts']=='i') echo 'selected';?>>Inactive</option>
									</select>

								</div>
							</div>
						</div>

								<p class="text-center">
                        <input type="Submit" class="btn btn-primary btn-cst" name="btnedtexect_prog" id="btnedtexect_prog" value="Submit">
                        &nbsp;&nbsp;&nbsp;
                        <input type="reset" class="btn btn-primary btn-cst" name="btnecatrst" value="Clear" id="btnecatrst">
                        &nbsp;&nbsp;&nbsp;
												<?php
						$val = $_REQUEST['val'];
					?>
                        <input type="button" name="btnBack" value="Back" class="btn btn-primary" onClick="location.href='<?php echo $rd_crntpgnm; ?>'">
												<!-- <input type="button"  name="btnBack" value="Back" class="textfeild" onclick="location.href='events.php?pg=<?php echo $pg."&countstart=".$cntstart;?>&val=<?php echo $value;?>&optn=<?php echo $opt;?>&chk=<?php echo $ck;?>'"> -->
                    </p>

			 
								</div></div></div>
		  </form>
</section>

<?php include_once "../includes/inc_adm_footer.php";?>
</body>
</html>
 <script language="JavaScript" type="text/javascript" src="js/ckeditor.js"></script>	
<script language="javascript" type="text/javascript">
  var nfiles  ="<?php echo $nfiles;?>";

function expand_curr() {
  debugger
  nfiles++;
  var htmlTxt = '<?php
  echo "<table border=\'0\' cellpadding=\'1\' cellspacing=\'1\' width=\'100%\'>";
  echo "<tr>";
  echo "<td align=\'center\' width=\'5%\'> ' + nfiles + '</td>";

  echo "<td align=\'left\' width=\'15%\'>";
  echo "<input type=text name=txtcurrname' + nfiles + ' id=txtcurrname' + nfiles + ' class=form-control size=\'10\'></td>";

  echo "<td align=\'left\' width=\'35%\'>";
  echo "<textarea name=txtcurrdesc' + nfiles + ' id=txtcurrdesc' + nfiles + ' class=form-control cols=\'60\' rows=\'3\'></textarea></td>";

  echo "<td align=\'left\' width=\'5%\'>";
  echo "<input type=\'text\' name=txtcurrprior' + nfiles + ' id=txtcurrprior' + nfiles + ' class=form-control size=5 maxlength=3>";
  echo "</td>";

  echo "<td  width=20% align=right colspan=2>";
  echo "<select name=lstcurrsts' + nfiles + ' id=lstcurrsts' + nfiles + ' class=form-control>";
  echo "<option value=a>Active</option>";
  echo "<option value=i>Inactive</option>";
  echo "</select>";
  echo "</td></tr></table><br>";
  ?>';
var Cntnt = document.getElementById("myDiv");

if (document.createRange) { //all browsers, except IE before version 9 

  var rangeObj = document.createRange();
  Cntnt.insertAdjacentHTML('BeforeBegin', htmlTxt);
  // document.frmedtexect_prog.hdntotcntrl.value = nfiles;
  if (rangeObj.createContextualFragment) { // all browsers, except IE	
    //var documentFragment = rangeObj.createContextualFragment (htmlTxt);
    //Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla	

  } else { //Internet Explorer from version 9
    Cntnt.insertAdjacentHTML('BeforeBegin', htmlTxt);
  }
} else { //Internet Explorer before version 9
  Cntnt.insertAdjacentHTML("BeforeBegin", htmlTxt);
}
document.getElementById('hdntotcntrl').value = nfiles;
get_ckeditor();
//document.frmpgcntn.hdntotcntrl.value = nfiles;
}	
var facfiles = "<?php echo $facfiles;?>";

function expand_fac() {
  facfiles++;
  var htmlTxt = '<?php
  echo "<table border=\'0\' cellpadding=\'1\' cellspacing=\'1\' width=\'100%\'>";
  echo "<tr>";
  echo "<td align=\'center\' width=\'5%\'> ' + facfiles + '</td>";
  echo "<td align=\'left\' width=\'15%\'>";
  echo "<input type=text name=txtfacname' + facfiles + ' id=txtfacname' + facfiles + ' class=form-control size=\'10\'>";
  echo "<td align=\'left\' width=\'25%\'>";
  echo "<textarea name=txtfacdesc' + facfiles + ' id=txtfacdesc' + facfiles + ' class=form-control cols=\'35\' rows=\'3\'></textarea></td>";

  echo "<td align=\'left\' width=\'25%\'>";
  echo "<input type=file name=flefacsimg' + facfiles + ' id=flefacsimg' + facfiles + ' class=form-control><br>";
  echo "</td>";


  echo "<td align=\'left\' width=\'10%\'>";
  echo "<input type=\'text\' name=txtfacprior' + facfiles + ' id=txtfacprior' + facfiles + ' class=form-control size=5 maxlength=3>";
  echo "</td>";

  echo "<td align=center width=\'10%\'>";
  echo "<select name=lstfacsts' + facfiles + ' id=lstfacsts' + facfiles + ' class=form-control>";
  echo "<option value=a>Active</option>";
  echo "<option value=i>Inactive</option>";
  echo "</select>";
  echo "</td></tr></table>";
  ?>';
var Cntnt1 = document.getElementById("myDiv2");

if (document.createRange) { //all browsers, except IE before version 9 

  var rangeObj = document.createRange();
  Cntnt1.insertAdjacentHTML('BeforeBegin', htmlTxt);
  if (rangeObj.createContextualFragment) { // all browsers, except IE	
    //var documentFragment = rangeObj.createContextualFragment (htmlTxt);
    //Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla	

  } else { //Internet Explorer from version 9
    Cntnt1.insertAdjacentHTML('BeforeBegin', htmlTxt);
  }
} else { //Internet Explorer before version 9
  Cntnt1.insertAdjacentHTML("BeforeBegin", htmlTxt);
}
document.getElementById('hdntotcntrl2').value = facfiles;
// document.frmedtexect_prog.hdntotcntr2.value = facfiles;
}
var psfiles = "<?php echo $psfiles;?>";

function expand_ps() {
  psfiles++;
  var htmlTxt = '<?php
  echo "<table border=\'0\' cellpadding=\'1\' cellspacing=\'1\' width=\'100%\'>";
  echo "<tr>";
  echo "<td align=\'center\' width=\'5%\'> ' + psfiles + '</td>";
  echo "<td align=\'left\' width=\'15%\'>";
  echo "<input type=text name=txtpsname' + psfiles + ' id=txtpsname' + psfiles + ' class=form-control size=\'10\'>";

  echo "<td align=\'left\' width=\'20%\'>";
  echo "<input type=text name=txtpslink' + psfiles + ' id=txtpslink' + psfiles + ' class=form-control size=\'10\'>";



  echo "<td align=\'left\' width=\'10%\'>";
  echo "<input type=\'text\' name=txtpsprior' + psfiles + ' id=txtpsprior' + psfiles + ' class=form-control size=5 maxlength=3>";
  echo "</td>";

  echo "<td align=center width=\'10%\'>";
  echo "<select name=lstpssts' + psfiles + ' id=lstpssts' + psfiles + ' class=form-control>";
  echo "<option value=a>Active</option>";
  echo "<option value=i>Inactive</option>";
  echo "</select>";
  echo "</td></tr></table>";
  ?>';

var Cntnt3 = document.getElementById("myDiv3");

if (document.createRange) { //all browsers, except IE before version 9 

  var rangeObj = document.createRange();
  Cntnt3.insertAdjacentHTML('BeforeBegin', htmlTxt);
  if (rangeObj.createContextualFragment) { // all browsers, except IE	
    //var documentFragment = rangeObj.createContextualFragment (htmlTxt);
    //Cntnt.insertBefore (documentFragment, Cntnt.firstChild);	//Mozilla	

  } else { //Internet Explorer from version 9
    Cntnt3.insertAdjacentHTML('BeforeBegin', htmlTxt);
  }
} else { //Internet Explorer before version 9
  Cntnt3.insertAdjacentHTML("BeforeBegin", htmlTxt);
}
document.getElementById('hdntotcntrl3').value = psfiles;
// document.frmedtexect_prog.hdntotcntr3.value = psfiles;
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
			document.frmedtexect_prog.action="edit_exect_prog.php?edit=<?php echo $id;?>&imgid="+img_id+"&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>" 
			document.frmedtexect_prog.submit();	
		}
    function rmvfac(facid){
			var fac_id;
			fac_id = facid;
			if(fac_id !=''){
				var r=window.confirm("Do You Want to Remove Image");
				if (r==true){						
					 x="You pressed OK!";
				  }
				else
				  {
					  return false;
				  }	
        	}
			document.frmedtexect_prog.action="edit_exect_prog.php?edit=<?php echo $id;?>&facid="+fac_id+"&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>" 
			document.frmedtexect_prog.submit();	
		}
    function rmvps(psid){
			var ps_id;
			ps_id = psid;
			if(ps_id !=''){
				var r=window.confirm("Do You Want to Remove Image");
				if (r==true){						
					 x="You pressed OK!";
				  }
				else
				  {
					  return false;
				  }	
        	}
			document.frmedtexect_prog.action="edit_exect_prog.php?edit=<?php echo $id;?>&psid="+ps_id+"&pg=<?php echo $pg;?>&countstart=<?php echo $cntstart.$loc;?>" 
			document.frmedtexect_prog.submit();	
		}
	CKEDITOR.replace('txtdesc');
	
</script>

<script language="javascript" type="text/javascript">
  CKEDITOR.replace('txtcurrdesc1');
  function get_ckeditor()
  {
    var cnt_desc = document.getElementById("hdntotcntrl").value;
    for (let i = 1; i <= cnt_desc; i++) {
      CKEDITOR.replace('txtcurrdesc'+i);
    }
  }
</script>
