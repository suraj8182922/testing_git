<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$ard_type_id = $_GET['ard_type_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_ard` where id = '$ard_type_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'add_ard_type.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
