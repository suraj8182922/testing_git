<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
include_once('functions.php');
?>
<style>
	.tt-hint,.site_name {
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
			<h1>Customer Site List</h1>
		</div>
		<div class="col-sm-3 " style="float: right;">
			<label>
				<a href="add_customer_site.php" class="btn btn-info pull-right">Add Customer Site</a>
			</label>
		</div>
	</section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border forpghdr">
						<center><h3 class="box-title">Customer Site List</h3></center>
					</div>
					<form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
						<br>
						<!--<h5><b style="color:#3c763d; padding-left:20px;"><u>Search By</u>  - </b></h5>-->
						<div class="col-sm-12">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Site Name</label>
								<div class="col-sm-3">
									<input type="text" class="col-sm-6 form-control site_name" id="site_name" name="site_name" value="">
									<input type="hidden" class="col-sm-6 form-control" id="site_id" name="site_id" value="">
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
									$site_query = "";
									$site_id = trim($_POST['site_id']);
									$site_name = trim($_POST['site_name']);

									if($site_name == "")
									{
										$error = "Please Enter Site Name.";

									}
									if($error == "")
									{

										if(isset($_POST['site_name']) and trim($_POST['site_name']) != "")
										{
											$str = $_POST['site_name'];
											$site_name1 =explode(",",$str);
											$site_id = $site_name1[0];
											$site_query = "where site_id = '$site_id'";
										}
										else
										{
											$site_query = "where 1";									
										}
										?>
										<div class="col-sm-12">
											<a style="font-size:20px; float:right;" href="customer_site_list.php"><i class="fa fa-reply"></i> Back To List</a>
											<br>
											<br>
										</div>
										<?php
									}

								}

							?>
							
								<h5 style="color:red">
									<?php if(isset($error)) echo $error;?>
								</h5>
							
							<table class="table table-bordered" id="customer_site">
								<tr class="forlistview">
									<th>Sr.No.</th>
									<th>Customer Name<i class="fa fa-filter button-filter" style="float:right;"></i></th>
									<th>Site Name</th>
									<th>Address</th>
									<th>Status</th>
									<th>Delete</th>
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

									$sql = "SELECT * from  tbl_site $site_query LIMIT $start_from, 10";
									$result = $mysqli->query($sql);
									while($row = mysqli_fetch_array($result))
									{
										$customer_id = $row['customer_id'];
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo customer_name($customer_id);?></td>
											<td><?php echo $row['site_name']?></td>
											<td><?php echo $row['site_address']?></td>
											<td>Update</td>
											<td>
												<center><a href="delete_site.php?site_id=<?php echo $row['site_id']?>" class="btn btn-danger forview" data-toggle="modal tooltip" title="Delete Site"><i class="fa fa-edit"></i></a></center>
											</td>
										</tr>
										<?php
										$i++;	
									}	
								?>
								
							  </table>
							<?php 	
								$sql = "SELECT COUNT(site_id)  FROM tbl_site $site_query"; 
								$rs_result = $mysqli->query($sql); 
								$row = mysqli_fetch_row($rs_result); 
								$total_records = $row[0]; 
								$total_pages = ceil($total_records / 10); 

								if($page>1)
								{
									echo "<a href='customer_site_list.php?page=".($page-1)."'class='buttonpn1'>PREVIOUS</a>";
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
									echo "<a href='customer_site_list.php?page=".$i."'class='$for_cls'>".$i."</a> ";
									//echo "<a href='customer_site_list.php?page=".$i."'class='buttonpn'>".$i."</a> ";
								}; 
								if($page != $total_pages)
								{
									echo "<a href='customer_site_list.php?page=".($page+1)."' class='buttonpn2'>Next</a>";
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
			 $('input.site_name').typeahead({
                name: 'site_name',
                remote: 'get_site_list.php?query=%QUERY'

            });

		});
		 $(function() {

	         // Initialize table
	         $("#customer_site").dynamicTable({
	            fillParent : false,
	            showCounter: true
	         });

	         // Define columns
	         var myColumns = [{  // Hidden Identifier column
	                             name       : "Identifier",
	                             type       : "number",
	                             visible    : false
	                          },{// Searchable text column
	                             name       : "Name",
	                             type       : "string",
	                             visible    : true,
	                             filterType : "search",
	                             width      : 200
	                          },{// Date column with date filter
	                             name       : "Birth Date",
	                             type       : "date",
	                             visible    : true,
	                             format     : "d-MMM-YYYY",
	                             filterType : "dateRange",
	                             cssClass   : function (aColumn, aValue, aDisplayValue) {
	                                return aValue != null  ? "has-birth-date" : null
	                             }
	                          },{// Limited values with default picklist filter
	                             name       : "Country",
	                             type       : "string",
	                             visible    : true,
	                          },{
	                             name       : "State",
	                             type       : "string",
	                             visible    : true,
	                          },{
	                             name       : "Note",
	                             type       : "string",
	                             visible    : true,
	                             editor     : $("<div/>").dynamicTableEditor({
	                                editHandler: function(aData, aContext) {
	                                   $("#save-data").html("Saving note: <strong>" + aData + "</strong>");
	                                }
	                             })
	                          },{
	                             name       : "Language",
	                             type       : "string",
	                             visible    : true,
	                          }];
	         $("#sample-grid").dynamicTable("data", myData, myColumns);

	         // Add event listeners:
	         $("#sample-grid").on("rowSelect", function(aEvent) {
	            $("#selected-data").html("You selected <strong>" + aEvent.row[1] + "</strong>");
	         });

	         // Add event listeners:
	         $("#sample-grid").on("rowDoubleClick", function(aEvent) {
	            $("#selected-data").html("You <em>double-clicked</em> <strong>" + aEvent.row[1] + "</strong>");
	         });

	         $("#clear-all-button").click(function() {
	            $("#sample-grid").dynamicTable("clearAllFilters");
	         })

	      });
</script>