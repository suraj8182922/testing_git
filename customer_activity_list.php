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
	.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
		
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: red !important;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
	
}
	.tooltip.right {z-index: 50000;}
	
	.tt-hint,.customer_name {
            border: 1px solid #CCCCCC;
            *border-radius: 8px 8px 8px 8px;
            font-size: 15px;
            height: 36px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            *width: 400px;
			color:#000;
        }
	.tt-dropdown-menu {
            width: 220px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 2px solid #357CA5;
            border: 2px solid rgba(53,124,165);
            *border-radius: 8px 8px 8px 8px;
            font-size: 15px;
            color: #000;
            background-color: #F1F1F1;
        }

</style>
<div class="content-wrapper">
	<section class="content-header foradd">
		<div class="col-sm-3 " style="float:left;">
			<h1>Customer Acivity</h1>
		</div>
		<div class="col-sm-3 " style="float: right;">
			<label>
				<a href="customer_activity.php" class="btn btn-info pull-right">Add Customer Activity </a>
			</label>
		</div>
	</section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border forpghdr">
						<center><h3 class="box-title">Customer Acivity List</h3></center>
					</div>
					<form action="" method="POST"class="form-horizontal">
						<div class="box-body">
							<table class="table table-bordered">
								<tr class="forlistview">
									<th>Sr.No.</th>
									<th>Customer Name</th>
									<th>Activity Title</th>
									<th>Activity Feedback</th>
									<th>Activity By</th>
									<th>Activity Date</th>
									<th>Activity Time</th>
									<th>Delete Activity</th>
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
										$limit = "LIMIT $start_from, 10 $limit"; 
									}
									$sql = "SELECT * from  tbl_customer_activity where 1";
									$result = $mysqli->query($sql);
									while($row = mysqli_fetch_array($result))
									{
										$customer_id = $row['customer_id'];
										$activity_date = $row['activity_date'];
										$activity_by = $row['activity_by'];
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td>
												<?php 
													if($row['customer_id'] == 0)
													{
														echo "Other";
													}
													else
													{
													echo customer_name($customer_id);
													}
												?>
											</td>
											<td><?php echo $row['activity_title'];?></td>
											<td><?php echo $row['feedback'];?></td>
											<td><?php echo sales_executive($activity_by);?></td>
											<td><?php echo format_date($activity_date);?></td>
											<td><?php echo $row['activity_time'];?></td>
											<td>
												<center><a href="delete_cust_activity.php?activity_id=<?php echo $row['activity_id']?>" class="btn btn-danger forview" data-toggle="modal tooltip" title="Delete Activity"><i class="fa fa-edit"></i></a></center>
											</td>
										</tr>
										<?php
										$i++;	
									}	
								?>
							  </table>
							<br>
							<?php 	
								$sql = "SELECT COUNT(activity_id) FROM tbl_customer_activity"; 
								$rs_result = $mysqli->query($sql); 
								$row = mysqli_fetch_row($rs_result); 
								$total_records = $row[0]; 
								$total_pages = ceil($total_records / 10); 

								if($page>1)
								{
									echo "<a href='customer_activity_list.php?page=".($page-1)."'class='buttonpn1'>PREVIOUS</a>";
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
									echo "<a href='customer_activity_list.php?page=".$i."'class='$for_cls'>".$i."</a> ";
								}; 
								if($page != $total_pages)
								{
									echo "<a href='customer_activity_list.php?page=".($page+1)."' class='buttonpn2'>Next</a>";
								}
								echo "</br>";
								echo "<p><hr></p>\n";
							?>
						</div>
						<!--<div class="box-footer">
							<center>
								<input type="submit" class="btn btn-info" id="inputPassword3" name="submit" value="Submit">
							</center>
						</div>-->
					</form>
				</div>
			</div>
		</div>
    </section>
</div>
<?php
	include_once('footer.php');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>