<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$car_door_id = $_GET['car_door_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_car_door_type` where car_door_id = '$car_door_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'car_door_type.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
