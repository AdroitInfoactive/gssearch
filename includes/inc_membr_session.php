<?php
// session_start();
if ((!isset($_SESSION['sesmbrid']) || ($_SESSION['sesmbrid'] == "")) && (!isset($_SESSION['sesmbremail']) || ($_SESSION['sesmbremail'] == ""))) {
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
}
?>