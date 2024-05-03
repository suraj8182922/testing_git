<?php
include_once('config.php');
if(!isset($_SESSION['username']))
{
	header('Location:index.php');
}
$customer_id = $_GET['customer_id'];
$sql = "UPDATE `tbl_customer` SET `active`='0' WHERE customer_id = '$customer_id'";
									
$mysqli->query($sql);	

?>
<script type="text/javascript">
	alert("Customer Status Updated Successfully ");
	var newLocation = "<?php echo  'customer_list.php' ?> ";
	window.location = newLocation;   
</script>
<?php
?>
