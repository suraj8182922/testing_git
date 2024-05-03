<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
if(!isset($_SESSION['username']))
{
	header('Location:index.php');
}
$customer_id = $_GET['customer_id'];
						
$sql = "DELETE FROM `tbl_customer` WHERE customer_id = '$customer_id'";

$mysqli->query($sql);	

?>
<script type="text/javascript">
alert("Customer Deleted Successfully");
var newLocation = "<?php echo  'customer_list.php' ?> ";
window.location = newLocation;   
</script>

					  
					   