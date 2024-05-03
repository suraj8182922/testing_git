<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$control_panel_type_id= $_GET['control_panel_type_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_control_panel_type` where id = '$control_panel_type_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'control_panel_type.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
