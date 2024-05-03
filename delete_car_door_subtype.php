<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$car_subtype_id = $_GET['car_subtype_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_car_door_subtype` where id='$car_subtype_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'car_door_subtype.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
