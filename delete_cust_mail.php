<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
if(!isset($_SESSION['username']))
{
	header('Location:index.php');
}
$customer_mail_id = $_GET['customer_mail_id'];
						
$sql = "DELETE FROM `tbl_customer_activity` WHERE customer_mail_id = '$customer_mail_id'";

$mysqli->query($sql);	

?>
<script type="text/javascript">
alert("Customer Mail Deleted Successfully");
var newLocation = "<?php echo  'tbl_customer_mail.php' ?> ";
window.location = newLocation;   
</script>

					  
					   