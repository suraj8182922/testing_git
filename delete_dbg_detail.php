<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$dbg_id= $_GET['dbg_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_dbg_calculation` where dbg_id = '$dbg_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'add_dbg_detail.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
