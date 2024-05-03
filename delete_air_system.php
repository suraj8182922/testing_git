<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$air_system_id= $_GET['air_system_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_air_system` where air_system_id = '$air_system_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'add_air_system.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
