<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$drive_capacity_id= $_GET['drive_capacity_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_drive_capacity` where drive_capacity_id = '$drive_capacity_id'";
	$mysqli->query($sql);
?>
<script>

	</script>
<?php
include_once('footer.php');
?>
