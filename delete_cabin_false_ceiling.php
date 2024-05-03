<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$ceiling_id= $_GET['ceiling_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_cabin_ceiling` where ceiling_id = '$ceiling_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'add_cabin_false_ceiling.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
