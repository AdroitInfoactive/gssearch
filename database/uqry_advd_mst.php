<?php
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation
include_once $inc_fldr_pth; //Making paging validation
if(isset($_POST['btneadvdsbmt']) && (trim($_POST['btneadvdsbmt']) != "") && isset($_POST['txtname']) && (trim($_POST['txtname']) != "") && isset($_POST['txtprior']) && (trim($_POST['txtprior']) != ""))
{
	$id = glb_func_chkvl($_POST['hdnadvdid']);
	$name = glb_func_chkvl($_POST['txtname']);
	$prior = glb_func_chkvl($_POST['txtprior']);
	$desc = addslashes(trim($_POST['txtdesc']));
	$link = glb_func_chkvl($_POST['txtlnk']);
	$pg = glb_func_chkvl($_REQUEST['hdnpage']);
	$countstart = glb_func_chkvl($_REQUEST['hdncnt']);
	$sts = glb_func_chkvl($_POST['lststs']);
	// $align = glb_func_chkvl($_POST['txtalin']);
	$hdndadvdimg = glb_func_chkvl($_REQUEST['hdndadvdimg']);
	$hdnmadvdimg = glb_func_chkvl($_REQUEST['hdnmadvdimg']);
	$srchval = addslashes(trim($_POST['hdnloc']));
	$curdt = date('Y-m-d h:i:s');
	$sqryadvd_mst = "SELECT advdm_name from advd_mst where advdm_name = '$name' and advdm_id != $id";
	$srsadvd_mst = mysqli_query($conn,$sqryadvd_mst);
	$cntadvdm = mysqli_num_rows($srsadvd_mst);
	if($cntadvdm < 1)
	{
		$uqryadvd_mst="UPDATE advd_mst set advdm_name = '$name', advdm_desc = '$desc', advdm_lnk = '$link', advdm_sts = '$sts', advdm_prty = '$prior', advdm_mdfdon = '$curdt', advdm_mdfdby = '$ses_admin'";
		if(isset($_FILES['fledadvdimg']['tmp_name']) && ($_FILES['fledadvdimg']['tmp_name']!=""))
		{
			$brndmigval = funcUpldImg('fledadvdimg','dadvdimg');
			if($brndmigval != "")
			{
				$advdimgary = explode(":",$brndmigval,2);
				$advddest = $advdimgary[0];					
				$advdsource = $advdimgary[1];	
			}							
			$uqryadvd_mst .= ", advdm_dimgnm = '$advddest'";
 		}
		$uqryadvd_mst .= " where advdm_id = '$id'";
		$ursadvd_mst = mysqli_query($conn,$uqryadvd_mst);
		if($ursadvd_mst == true)
		{
			if(($advdsource!='none') && ($advdsource!='') && ($advddest != ""))
			{
				$smlimgpth = $gadvd_fldnm.$hdndadvdimg;
				if(($hdndadvdimg != '') && file_exists($smlimgpth))
				{
					unlink($smlimgpth);
				}
				move_uploaded_file($advdsource,$gadvd_fldnm.$advddest);
			}
			?>
			<script>location.href="view_all_advertisement.php?vw=<?php echo $id;?>&sts=y&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
		else
		{ ?>
			<script>location.href="view_all_advertisement.php?vw=<?php echo $id;?>&sts=n&pg=<?php echo $pg;?>&countstart=<?php echo $countstart.$srchval;?>";</script>
			<?php
		}
	}
	else
	{ ?>
		<script>location.href="view_all_advertisement.php?vw=<?php echo $id;?>&sts=d&pg=<?php echo $pg;?>&countstart=<?php echo $countstart;?>";
		</script>
		<?php
	}
}
?>