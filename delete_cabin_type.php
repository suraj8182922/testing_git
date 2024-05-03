<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$cabin_type_id = $_GET['cabin_type_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_cabin_type` where id = '$cabin_type_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'add_cabin_type.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
