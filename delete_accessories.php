<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$accessories_id= $_GET['accessories_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_accessories` where accessories_id = '$accessories_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'add_accessories_detail.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
