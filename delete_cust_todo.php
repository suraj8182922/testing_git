<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
if(!isset($_SESSION['username']))
{
	header('Location:index.php');
}
$cust_todo_id = $_GET['cust_todo_id'];
						
$sql = "DELETE FROM `tbl_customer_todo` WHERE cust_todo_id = '$cust_todo_id'";

$mysqli->query($sql);	

?>
<script type="text/javascript">
alert("Customer Todo Deleted Successfully");
var newLocation = "<?php echo  'customer_todo_list.php' ?> ";
window.location = newLocation;   
</script>

					  
					   