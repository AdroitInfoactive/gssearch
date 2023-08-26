<?php
session_start();
/* if ((!isset($_SESSION['sesmbrid']) || ($_SESSION['sesmbrid'] == "")) && (!isset($_SESSION['sesmbremail']) || ($_SESSION['sesmbremail'] == ""))) {
	?>
	<script type="text/javascript">
		location.href = "<?php echo $rtpth; ?>home";
	</script>
	<?php
	exit();
} else {
	$membremail = $_SESSION['sesmbremail'];
	$membrname = $_SESSION['sesmbrname'];
	$membrid = $_SESSION['sesmbrid'];
} */
if (isset($_SESSION['sesmbrid']) && ($_SESSION['sesmbrid'] != ""))
{
	$membrid = $_SESSION['sesmbrid'];
	$membrname = $_SESSION['sesmbrname'];
	$membremail = $_SESSION['sesmbremail'];
	$membrsubsts = $_SESSION['sesssubsts'];
	$sess_uid = session_id();
	$sqry_sess_chk = "SELECT mbr_lgntrckm_lgnsts from mbr_lgntrck_mst where mbr_lgntrckm_sesid = '$sess_uid' and mbr_lgntrckm_lgnm_id = '$membrid' order by mbr_lgntrckm_crtdon desc";
	$srssess_chk = mysqli_query($conn, $sqry_sess_chk);
	$cntsess_chk = mysqli_num_rows($srssess_chk);
	if ($cntsess_chk > 0)
	{
		$srowsess_chk = mysqli_fetch_assoc($srssess_chk);
		$membr_lgntrckm_lgnsts = $srowsess_chk['mbr_lgntrckm_lgnsts'];
		if ($membr_lgntrckm_lgnsts == 'i')
		{
			session_destroy();
			?>
			<script type="text/javascript">
				alert("Your Session has been logged out. Beacuse another login attempt.");
				location.href = "<?php echo $rtpth; ?>home";
			</script>
			<?php
			exit();
		}
	}
}
?>