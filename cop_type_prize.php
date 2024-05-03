<?php 
include_once('config.php');
//print_r($_POST);
$lift_type = $_POST['lift_type'];
$floors_designations = $_POST['floors_designations'];
$cop_type = $_POST['cop_type'];
$cop_types = "SELECT * FROM tbl_cop where operator_type='$lift_type' and id='$cop_type'";
$result_cop_type = $mysqli->query($cop_types);
$row_cop_type = mysqli_fetch_array($result_cop_type);
$cop_prize = $row_cop_type['prize'];
echo trim(json_encode($cop_prize),'"');
?>