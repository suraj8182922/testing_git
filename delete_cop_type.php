<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$cop_type_id = $_GET['cop_type_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_cop` where id = '$cop_type_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'add_cop_type.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
