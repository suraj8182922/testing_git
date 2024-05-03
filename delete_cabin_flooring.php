<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$flooring_id= $_GET['flooring_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_cabin_flooring` where flooring_id = '$flooring_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'add_cabin_flooring.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
