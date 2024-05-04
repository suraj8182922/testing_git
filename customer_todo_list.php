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
			<h1>Customer To Do List</h1>
		</div>
		<div class="col-sm-3 " style="float: right;">
			<label>
				<a href="customer_todo.php" class="btn btn-info pull-right">Add New To Do </a>
			</label>
		</div>
	</section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border forpghdr">
						<center><h3 class="box-title">CMy segment</h3></center>
					</div>
					<form action="" method="POST"class="form-horizontal">
						<div class="box-body">
							<table class="table table-bordered">
								<tr class="forlistview">
									<th>Sr.No.</th>
									<th>To Do Date</th>
									<th>To Do Time</th>
									<th>Customer Name</th>
									<th>Customer Site</th>
									<th>Executive Name</th>
									<th>To Do Purpose</th>
									<th>Venue</th>
									<th>Activity</th>
									<th>Delete</th>
								</tr>
								<?php

									$username = $_SESSION['username'];

									 $sql2 = "SELECT * from  tbl_employee where username = '$username' and active = '1'";
									$result2 = $mysqli->query($sql2);
									$row2 = mysqli_fetch_array($result2);
									$emp_id = $row2['employee_id'];
									$cur_time = date('H:i:s');
									$today_date = date("Y-m-d");
									$tomarrow_date = date('Y-m-d', strtotime($today_date . ' +1 day'));
									$yesterday_date = date('Y-m-d', strtotime($today_date . ' -1 day'));

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
										
									 	
								   $sql = "SELECT * from  tbl_customer_todo $user_query ORDER BY todo_date ASC $limit";
										$result = $mysqli->query($sql);
										while($row = mysqli_fetch_array($result))
										{
											$cust_todo_id = $row['cust_todo_id'];
											$todo_date = $row['todo_date'];
											$user = $row['user'];
											$customer_id = $row['customer_id'];
											$customer_site_id = $row['customer_site_id'];
											$activity_id = $row['activity_id'];
										    $time = $row['time'];
											
											if($activity_id != 'NULL' and $todo_date < $today_date)
											{
												$lstclr = 'done';
											}
											else if($activity_id = 'null' and $todo_date < $today_date)
											{
												$lstclr = 'notdone';
											}
											else if($activity_id != 'NULL' and $todo_date == $today_date and $time > $cur_time)
											{
												$lstclr = 'curdone1';
											}
											else if($activity_id = 'null' and $todo_date = $today_date and $time > $cur_time)
											{
												$lstclr = 'pendone1';
											}
											else if($activity_id != 'NULL' and $todo_date == $today_date and $time < $cur_time)
											{
												$lstclr = 'done1';
											}
											else if($activity_id = 'null' and $todo_date = $today_date and $time < $cur_time)
											{
												$lstclr = 'notdone1';
											}
											else if($activity_id = 'null' and $todo_date > $today_date)
											{
												$lstclr = 'pending';
											}
											?>
											<tr>
												<td class="<?php echo $lstclr?>"><?php echo $i;?></td>
												<td class="<?php echo $lstclr?>"><?php echo format_date($todo_date);?></td>
												<td class="<?php echo $lstclr?>"><?php echo $row['time'];?></td>
												<td class="<?php echo $lstclr?>">
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
												<td class="<?php echo $lstclr?>">
													<?php
														if($row['customer_id'] == 0)
														{
															echo "Other";
														}
														else
														{
														echo site_detail($customer_site_id);
														}
													?>
												</td>
												<td class="<?php echo $lstclr?>"><?php echo sales_executive($user);?></td>
												<td class="<?php echo $lstclr?>"><?php echo $row['purpose'];?></td>
												<td class="<?php echo $lstclr?>"><?php echo $row['venue'];?></td>
												
												<td>
													<?php
													/*if($activity_id == '0' and $todo_date >= $today_date)
													{
														?>
														<a href="lead_activity.php?lead_id=<?php echo $lead_id?>&todo_id=<?php echo $todo_id?>" class="btn btn-info forview" data-toggle="modal tooltip" title="Add Activity"><i class="fa fa-edit"></i></a>
													<?php
													}
													if($activity_id == '0' and $todo_date < $today_date and $time < $cur_time)
													{
														echo "Missed Todo";
													}
													if($activity_id != '0')
													{
														echo "Done";
													}*/
											
													if($activity_id != 'NULL' and $todo_date < $today_date)
													{
														echo "Done";
													}
													else if($activity_id == 'NULL' and $todo_date > $today_date)
													{
														echo "Missed Todo";
													}
													else if($activity_id !== 'NULL' and $todo_date == $today_date and $time > $cur_time)
													{
														echo "Done";
													}
													else if($activity_id == 'NULL' and $todo_date == $today_date and $time > $cur_time)
													{
														?>
														<a href="customer_activity.php?customer_id=<?php echo $row['customer_id']?>&cust_todo_id=<?php echo $cust_todo_id?>" class="btn btn-info forview" data-toggle="modal tooltip" title="Add Activity"><i class="fa fa-edit"></i></a>
													<?php
													}
													else if($activity_id != 'NULL' and $todo_date == $today_date and $time < $cur_time)
													{
														echo "Done";
													}
													else if($activity_id == 'NULL' and $todo_date == $today_date and $time > $cur_time)
													{
														echo "Missed Todo";
													}
													else if($activity_id == 'null' and $todo_date > $today_date)
													{
														?>
														<a href="customer_activity.php?customer_id=<?php echo $row['customer_id']?>&cust_todo_id=<?php echo $cust_todo_id?>" class="btn btn-info forview" data-toggle="modal tooltip" title="Add Activity"><i class="fa fa-edit"></i></a>
													<?php
													}
											
											
													?>
													
												</td>
												<td>
												<center><a href="delete_cust_todo.php?cust_todo_id=<?php echo $row['cust_todo_id']?>" class="btn btn-danger forview" data-toggle="modal tooltip" title="Delete Todo"><i class="fa fa-edit"></i></a></center>
											</td>
											</tr>
											<?php
											$i++;	
										}	
									
								?>
								
							  </table>
							<b class="done"><i class="fa fa-circle" aria-hidden="true"> Activity Done</i> </b>&nbsp;
							<b class="notdone"><i class="fa fa-circle" aria-hidden="true"> Missed Activity</i></b>&nbsp;
							<b class="pendone1"><i class="fa fa-circle" aria-hidden="true"> Pending Activity</i></b>
							<br>
							<br>
							<?php 	
								$sql = "SELECT COUNT(cust_todo_id) FROM tbl_customer_todo"; 
								$rs_result = $mysqli->query($sql); 
								$row = mysqli_fetch_row($rs_result); 
								$total_records = $row[0]; 
								$total_pages = ceil($total_records / 10); 

								if($page>1)
								{
									echo "<a href='customer_todo_list.php?page=".($page-1)."'class='buttonpn1'>PREVIOUS</a>";
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
									echo "<a href='customer_todo_list.php?page=".$i."'class='$for_cls'>".$i."</a> ";
								}; 
								if($page != $total_pages)
								{
									echo "<a href='customer_todo_list.php?page=".($page+1)."' class='buttonpn2'>Next</a>";
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