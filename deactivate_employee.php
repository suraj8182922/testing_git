<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
if(!isset($_SESSION['username']))
{
	header('Location:index.php');
}
$employee_id = $_GET['employee_id'];

$sql = "UPDATE `tbl_employee` SET `active`='0' WHERE employee_id = '$employee_id'";
									
$mysqli->query($sql);	

?>
<script type="text/javascript">
	alert("Employee Status Updated Successfully ");
	var newLocation = "<?php echo  'employee_list.php' ?> ";
	window.location = newLocation;   
</script>
