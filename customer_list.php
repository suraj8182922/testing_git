<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
include_once('functions.php');
?> <!-- Content Wrapper. Contains page content -->
<style>
	.grid-form1 {
		background: rgb(255, 255, 255) none repeat scroll 0 0;
		border: 1px solid rgb(235, 239, 246);
		border-radius: 4px;
		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
		margin-bottom: 1em;
		padding: 1em;
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
<script>
$(document).ready(function() {
    $("a[rel='tooltip']").tooltip({'placement': 'right'});
});
</script>
<div class="content-wrapper">
	<section class="content-header foradd">
	  <div class="col-sm-3 " style="float:left;">
			<h1>Customer List</h1>
		</div>
		<div class="col-sm-3 " style="float: right;">
			<label>
				<a href="add_customer.php" class="btn btn-info pull-right">Add New Customer </a>
			</label>
		</div>
	</section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border forpghdr">
						<center><h3 class="box-title">Customer List</h3></center>
					</div>
					<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
						<br>
						<!--<h5><b style="color:#3c763d; padding-left:20px;"><u>Search By</u>  - </b></h5>-->
						<div class="col-sm-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Customer Name</label>
								<div class="col-sm-3">
									<input type="text" class="col-sm-6 form-control customer_name" id="customer_name" name="customer_name" value="">
									
									<input type="hidden" class="col-sm-6 form-control" id="customer_id" name="customer_id" value="">
								</div>
								<div class="col-sm-3">
									<div class="">
										<label>
											<input type="submit" value="Search" name="submit1" class="btn btn-info pull-right">
										</label>
									</div>
								 </div>
							</div>
						</div>
				   </form>
					
					<div class="box-body">
						<?php
						if(isset($_POST['submit1']))
						{
							
							$error = "";	
							$customer_query = "";
							$customer_name = trim($_POST['customer_name']);
							$customer_id = trim($_POST['customer_id']);
							
							if($customer_name == "")
							{
								$error = "Please Enter Customer.";

							}
							if($error == "")
							{
								
								if(isset($_POST['customer_name']) and trim($_POST['customer_name']) != "")
								{
									$customer_name = $_POST['customer_name'];	
									$customer_query = "where customer_name = '$customer_name' and active = '1'";
								}
								else
								{
									$customer_query = "where active = 1";									
								}
								?>
								<div class="col-sm-12">
									<a style="font-size:20px; float:right;" href="customer_list.php"><i class="fa fa-reply"></i> Back To List</a>
									<br>
									<br>
								</div>
								<?php
							}
							
						}
						else
						{
							$customer_query = "where active = 1";
						}

						?>
						<h5 style="color:red">
							<?php if(isset($error)) echo $error;?>
						</h5>						
						<table class="table table-bordered" id="customer_list">
							<tr class="forlistview">
								<th>Sr.No.</th>
								<th>Site Name</th>
								<th>Customer Name<i class="fa fa-filter button-filter" style="float:right;"></i></th>
								<th>Contact No.</th>
								<th>Email Id<i class="fa fa-filter button-filter" style="float:right;"></i></th>
								<th style="width:20%;">Address<i class="fa fa-filter button-filter" style="float:right;"></i></th>
								<th>Status</th>
								<th>View Site</th>
								<!--<th>View Jobs</th>-->
								<th>Edit/Delete</th>
								<th>Action</th>
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
								$sql = "SELECT * from  tbl_customer $customer_query ORDER BY customer_name LIMIT $start_from, 10";
								$result = $mysqli->query($sql);
								while($row = mysqli_fetch_array($result))
								{
									 $customer_id1 = $row['customer_id']; 
								//echo	$customer_id1 = $row['site_id']; 
									?>
									<tr>
										<td><?php echo $i;?></td>
										<?php
								
													// $j = 1;
													 $sql9 = "SELECT * from  tbl_site  where customer_id= '$customer_id1'";
													 $result9 = $mysqli->query($sql9);
													 $row9 = mysqli_fetch_array($result9);
												?>
										
										<td><?php echo $row9['site_name']?></td>
										<td><?php echo $row['customer_name']?></td>
										<td><?php echo $row['contact_number']?></td>
										<td><?php echo $row['email_id']?></td>
										<td><?php echo $row['address']?></td>
										<td>
											<?php
											if($row['active'] == '1')
											{
											?>
												<b style="color:green;">Active</b>
											<?php
											}
											else
											{
											?>
												<b style="color:red;">Deactive</b>
											<?php
											}
											?>
										</td>
										<td>
										<a href="#" rel="tooltip" title="View Site Detail" data-original-title="Hi"><button type="button" class="btn btn-info forview" data-toggle="modal"  data-target="#viewsitedetail<?php echo $i;?>"><i class="fa fa-list"></i></button></a> 
										</td>

										<!--<td><a href="jobs_by_customer.php?customer_id=<?php echo $row['customer_id']?>" class="btn btn-info forview" data-toggle="modal tooltip" title="View Jobs"><i class="fa fa-list"></i></a></td>-->

										<td>
											<center><a href="edit_customer.php?customer_id=<?php echo $row['customer_id']?>" class="btn btn-info forview" data-toggle="modal tooltip" title="Edit Customer"><i class="fa fa-edit"></i></a>
											<a href="delete_customer.php?customer_id=<?php echo $row['customer_id']?>" class="btn btn-danger forview" data-toggle="modal tooltip" title="Delete Customer"><i class="fa fa-edit"></i></a></center>
										</td>

										<td>
											<?php
											if($row['active'] == '1')
											{
											?>
												<a href="deactivate_customer.php?customer_id=<?php echo $row['customer_id']?>" class="btn btn-danger forview" data-toggle="modal tooltip" title="Deactivate Customer"><i class="fa fa-edit"></i></a>
											<?php
											}
											else
											{
											?>
												<a href="activate_customer.php?customer_id=<?php echo $row['customer_id']?>" class="btn btn-success forview" data-toggle="modal tooltip" title="Activate Customer"><i class="fa fa-edit"></i></a>
											<?php
											}
											?>
										</td>

										<!--<td><a href="deactivate_customer.php?customer_id=<?php echo $row['customer_id']?>" class="btn btn-info">Deactive</a></td>-->

									</tr>
									<?php
									$i++;	
								}	
							?>

						  </table>
						  <br>
						  <?php 	
							$sql = "SELECT COUNT(customer_id) FROM tbl_customer $customer_query "; 
							$rs_result = $mysqli->query($sql); 
							$row = mysqli_fetch_row($rs_result); 
							$total_records = $row[0]; 
							$total_pages = ceil($total_records / 10); 

							
							if($page>1)
							{
								//echo "<a href='customer_list.php?page=1'class='buttonpn1'>FIRST</a>";
								echo "<a href='customer_list.php?page=".($page-1)."'class='buttonpn1'>PREVIOUS</a>";
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
								echo "<a href='customer_list.php?page=".$i."'class='$for_cls'>".$i."</a> ";
								//echo "<a href='customer_list.php?page=".$i."'class='buttonpn'>".$i."</a> ";
							}; 
							if($page != $total_pages)
							{
								echo "<a href='customer_list.php?page=".($page+1)."' class='buttonpn2'>NEXT</a>";
								//echo "<a href='customer_list.php?page=".($total_pages)."' class='buttonpn2'>LAST</a>";
							}
							
							echo "</br>";
							echo "<p><hr></p>\n";

						?>
					</div>
						<?php
							$i = 1;
					      	$sql5 = "SELECT * from  tbl_customer where active = 1 ORDER BY customer_name LIMIT $start_from, 10";
							$result5 = $mysqli->query($sql5);	
							while($row5 = mysqli_fetch_array($result5))
							{
								$customer_id1 = $row5['customer_id']; 
								
								/*$sql4 = "SELECT * from  tbl_site  where customer_id = '$customer_id';";
								$result4 = $mysqli->query($sql4);
								$row4 = mysqli_fetch_array($result4);
								$site_name = $row4['site_name'];
								$site_address = $row4['site_address'];*/
						?>	
							<div class="modal fade" id="viewsitedetail<?php echo $i?>" role="dialog">
								<div class="grid-form1" style="left:25%; right:12%; top:12%; position: absolute;">
									<div class="modal-footer" style="float:right; padding-top:25px;">
										<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
									</div>
									
									<center><h3 id="forms-example" style="background:#3c8dbc; color:#fff;padding:10px;" class="">Site Detail For <?php echo customer_name($customer_id); ?></h3></center>
										<div class="col-sm-12">
											<table class="table table-bordered">
												<tbody>
												
												<tr style="background:#c3c3c3;">
													<td style="width:25%;"><b>Sr.No</b></td>
													<td style="width:25%;"><b>Site Name</b></td>
													<td style="width:25%;"><b>Address</b></td>
												</tr>
												<?php
								
													 $j = 1;
													 $sql3 = "SELECT * from  tbl_site  where customer_id= '$customer_id1'";
													 $result3 = $mysqli->query($sql3);
													 while($row3 = mysqli_fetch_array($result3))
													 {
												?>
												<tr>
													<td><b><?php echo $j;?></b></td>
													<td align="" valign="top"><?php echo $row3['site_name'];?></td >
													<td align="" valign="top"><?php echo $row3['site_address'];?></td >
												</tr>
													<?php
														$j++;	
													}	
													?>
												</tbody>
											</table>
										</div>
									<!--<div class="modal-footer" style="float:right;">
										<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></button>
									</div>-->
							</div>
					</div>
					<?php	
						$i++;
						}
					?>
						<!--<div class="box-footer">
							<center>
								<input type="submit" class="btn btn-info" id="inputPassword3" name="submit" value="Submit">
							</center>
						</div>-->
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
<script src="dist/js/autocomplate.js"></script>
<script>
		$(function() {
			 $('input.customer_name').typeahead({
                name: 'customer_name',
                remote: 'get_customer_list.php?query=%QUERY'

            });

		});
				
			
				$('#customer_list ').ddTableFilter();
				
			
			
		
	    
</script>