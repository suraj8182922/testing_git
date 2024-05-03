<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$tbl_control_panel_make_id= $_GET['tbl_control_panel_make_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_control_panel_make` where tbl_control_panel_make_id = '$tbl_control_panel_make_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'control_panel_make.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
