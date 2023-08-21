<?php
session_start();
include_once "includes/inc_config.php"; //checking for session	
include_once $inc_usr_nocache; // Clearing the cache information	
// include_once $inc_mbr_sess; //checking for session	
//*****************************************//
//Program     	: logout.php
//Purpose     	: User Logout Page
//Created By  	: Mallikarjuna
//Created On    : 17-12-2012
//Modified By 	: 
//Modified On 	: 	
//Company     	: Adroit 	 
//*****************************************//		
session_unset();
session_destroy();
//header("location:".$rtpth."signin");
?>
<script type="text/javascript">
	location.href = "<?php echo $rtpth; ?>home";
</script>
<?php
exit();
?>