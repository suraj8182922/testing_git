<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
if(!isset($_SESSION['username']))
{
	header('Location:index.php');
}
$activity_id = $_GET['activity_id'];
						
$sql = "DELETE FROM `tbl_customer_activity` WHERE activity_id = '$activity_id'";

$mysqli->query($sql);	

?>
<script type="text/javascript">
alert("Customer Activity Deleted Successfully");
var newLocation = "<?php echo  'customer_activity_list.php' ?> ";
window.location = newLocation;   
</script>

					  
					   