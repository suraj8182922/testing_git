<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$drive_capacity_id= $_GET['drive_capacity_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_drive_capacity` where drive_capacity_id = '$drive_capacity_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'add_drive_capacity.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
