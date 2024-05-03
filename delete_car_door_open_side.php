<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$car_open_side_id = $_GET['car_open_side_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_car_door_open_type` where car_open_side_id = '$car_open_side_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'car_door_open_side.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
