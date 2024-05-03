<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
include_once('functions.php');
?>

<style>
	.done,.done1,.curdone1
	{
	 color:#00A65A;
	}
	.notdone,.notdone1
	{
	color:#DD4B39;
	}
	.pendone1,.pending
	{
	color:#F39C12;
	}

</style>
<div class="content-wrapper">
	<section class="content-header">
	  <h1>
		Customer Payment Status
	  </h1>
	</section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<center><h3 class="box-title">Pending Document Customer List</h3></center>
					</div>
					<form action="" method="POST"class="form-horizontal">
						<div class="box-body">
							<table class="table table-bordered">
							  <tr class="forlistview">
								<th>Sr.no</th>
								<th>Site </th>
								<th>Customer </th>
								<th>Job_Amount</th>
								<th>Paid</th>
								<th>Balance </th>
							  </tr>
							  <?php

								if (isset($_GET["page"])) 
								{ 
									 $page  = $_GET["page"];
								} 
								else 
								{ 
									 $page=1; 
								}; 
								 $start_from = ($page-1) * 10; 

								$i = 1;

								if($page >= 2)
								$i = (($page-1) *10) +1;

								if (isset($_POST["submit1"])) 
								{ 
									$limit  = "";
								} 
								else 
								{ 
									$limit = "LIMIT $start_from, 10"; 
								}

								$sql1 = "SELECT `tbl_job`.customer_id AS `customer_id1`,`tbl_job`.site_id AS `site_id1`,`tbl_job`.job_id AS `job_id`,`tbl_job`.job_amount AS job_amount,SUM(tbl_job_payment.amount_paid) AS amount_paid1,
			(CASE 
				WHEN `tbl_job`.job_amount - SUM(tbl_job_payment.amount_paid) >= '1' THEN `tbl_job`.job_amount - SUM(tbl_job_payment.amount_paid)
				ELSE `tbl_job`.job_amount
			END) AS balance_amt
		FROM `tbl_job` LEFT JOIN tbl_job_payment ON tbl_job.job_id = `tbl_job_payment`.job_id GROUP BY tbl_job.`job_id` ORDER BY balance_amt asc $limit";
						
							$result1 = $mysqli->query($sql1);
							$count1 = mysqli_num_rows($result1);
							while($row1 = mysqli_fetch_array($result1))
							{
								$job_id = $row1['job_id'];
								$amount_paid = $row1['amount_paid1'];
								$job_amount = $row1['job_amount'];
								$balance_amt = $row1['balance_amt'];
								$customer_id = $row1['customer_id1'];
								$site_id = $row1['site_id1'];
								$job_no = $row1['job_no'];
								$sql2 = "SELECT * from  tbl_job where job_no = '$job_no'";
								$result2 = $mysqli->query($sql2);
								$row2 = mysqli_fetch_array($result2);

								$sql5 = "SELECT * from tbl_customer where customer_id = '$customer_id'";
								$result5 = $mysqli->query($sql5);
								$row5 = mysqli_fetch_array($result5);
								$customer_id = $row5['customer_id'];
								$customer = $row5['customer_name'];
								$cust_mob = $row5['contact_number'];

								$sql6 = "SELECT * from tbl_site where customer_id = '$customer_id'";
								$result6 = $mysqli->query($sql6);
								$row6 = mysqli_fetch_array($result6);
								$site_name = $row6['site_name'];
								$site_id = $row6['site_id'];
					  		?>
						  	<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $site_name;?></td>
								<td><?php echo $customer;?></td>
								<td><?php echo $job_amount;?></td>
								<td>
								<?php 
									if($amount_paid == "")
									{
									echo "0";
									}
									else
									{
										echo $amount_paid;
									}
								?>
								 </td>
								<td><?php echo $balance_amt;?></td>
						  	</tr>
						  <?php
							 $i++;
							}
						  ?>
					   	</table>
						<br>
						<?php 	
							$sql = "SELECT COUNT(tbl_job.job_id) AS job_id,
			(CASE 
				WHEN `tbl_job`.job_amount - SUM(tbl_job_payment.amount_paid) >= '1' THEN `tbl_job`.job_amount - SUM(tbl_job_payment.amount_paid)
				ELSE `tbl_job`.job_amount
			END) AS balance_amt
		FROM `tbl_job` LEFT JOIN tbl_job_payment ON tbl_job.job_id = `tbl_job_payment`.job_id GROUP BY tbl_job.`job_id` ORDER BY balance_amt asc $limit";   
							$rs_result = $mysqli->query($sql); 
							$row = mysqli_fetch_row($rs_result); 
							$total_records = $row[0]; 
							$total_pages = ceil($total_records / 10); 

							if($page>1)
							{
								echo "<a href='customer_payment_status.php?page=".($page-1)."'class='buttonpn1'>PREVIOUS</a>";
							}
							for ($i=1; $i<=$total_pages; $i++) 
							{ 
								if(empty($_GET['page'])? '1' : $_GET['page'])
								{
									 $pg_no = empty($_GET['page'])? '1' : $_GET['page'] ;
									 $class = ($i==$pg_no)? 'current' : '';
									 $for_cls = $class." buttonpn";
								}
								else
								{
									$for_cls = "buttonpn";
								}
								echo "<a href='customer_payment_status.php?page=".$i."'class='$for_cls'>".$i."</a> ";
							}; 
							if($page != $total_pages)
							{
								echo "<a href='customer_payment_status.php?page=".($page+1)."' class='buttonpn2'>Next</a>";
							}
							echo "</br>";
							echo "<p><hr></p>\n";

						?>
						</div>
					</form>
				</div>
			</div>
		</div>
    </section>
</div>
<?php
	include_once('footer.php');
?>