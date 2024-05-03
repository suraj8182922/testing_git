<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
$bracket_type_id = $_GET['bracket_type_id'];
?> 
<?php
	$sql="DELETE FROM `tbl_bracket` where id = '$bracket_type_id'";
	$mysqli->query($sql);
?>
<script>
		alert('Data Deleted successfully');
		var newLocation = "<?php echo 'add_bracket.php'; ?>";
		window.location = newLocation;
	</script>
<?php
include_once('footer.php');
?>
