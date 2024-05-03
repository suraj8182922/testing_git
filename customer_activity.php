<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
if(!isset($_SESSION['username']))
{
	header('Location:index.php');
}
$customer_id1 = $_GET['customer_id'];
$cust_todo_id = $_GET['cust_todo_id'];
$user = $_GET['user'];
?>
<style>
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #fff;
    opacity: 1;
}	
</style>
<script>$('.datepicker').datepicker()</script>
<script src="ckeditor.js"></script>
	<script src="sample.js"></script> 

      <!-- Left side column. contains the logo and sidebar -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <section class="content-header">
			<h1>
				 <i class="fa fa-pencil-square-o"></i>&nbsp;Create Customer Activity  
			</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
				<div class="col-md-12">
					 <!-- Horizontal Form -->
					 <div class="box box-info">
						  <div class="box-header with-border forpghdr">
							<center><h3 class="box-title">Enter Customer Activity</h3></center>
						  </div><!-- /.box-header -->
					  	<!-- form start -->
						<?php

							function generatePassword($length = 5)
							{
								$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
								$count = mb_strlen($chars);

								for ($i = 0, $code = ''; $i < $length; $i++)
									{
										$index = rand(0, $count - 1);
										$code .= mb_substr($chars, $index, 1);
									}
								return $code;
							}
							if(isset($_POST['submit1']))
							{

								$error = "";	
								$customer_id = $_POST['customer_id'];
								$activity_title = trim($_POST['activity_title']);
								$feedback = trim($_POST['feedback']);
								$activity_by = $_POST['activity_by'];
								$activity_date = $_POST['activity_date'];
								$hour = $_POST['hour'];
								$minutes = $_POST['minutes'];	
								
								$acivity_time = $hour. " : " .$minutes;
								
								$array_date1 = explode("-", $activity_date);
								$new_activity_date= $array_date1[2]."-".$array_date1[1]."-".$array_date1[0];
								
								//lead_id activity_title activity_type actvity_date hour minutes

								if($customer_id == "")
								{
									$error = "Please Select Customer";

								}
								else if($activity_title == "")
								{
									$error = "Please Enter Acivity Title";

								}
								else if($feedback == "")
								{
									$error = "Please Enter Feedback";

								}
								else if($activity_by == "")
								{
									$error = "Please select Acivity done by";

								}
								else if($activity_date == "")
								{
									$error = "Please Select Acivity Date";

								}
								else if($hour == "")
								{
									$error = "Please Select Time";

								}
								else if($minutes == "")
								{
									$error = "Please Select Time";

								}

								if($error == "")
								{
									$sql = "INSERT INTO `tbl_customer_activity`(`customer_id`, `activity_title`, `feedback`, `activity_by`, `activity_date`, `activity_time`) VALUES ('$customer_id','$activity_title','$feedback','30','$new_activity_date','$acivity_time')";
									
									$mysqli->query($sql);	
									
									 $last_insert_id = $mysqli->insert_id;
									//$lead_id1 = $_GET['lead_id'];
									//$todo_id = $_GET['todo_id'];
									
									if(isset($_GET['customer_id']) && isset($_GET['cust_todo_id']))
									{
										$customer_id1 = $_GET['customer_id'];
										$cust_todo_id = $_GET['cust_todo_id'];
										
										$sql9 = "UPDATE `tbl_customer_todo` SET `activity_id`='$last_insert_id' WHERE cust_todo_id = '$cust_todo_id' and customer_id = '$customer_id1'";
										$mysqli->query($sql9);
										
									}

									?>
									<script type="text/javascript">
										alert("Customer Activity Added Successfully ");
										var newLocation = "<?php echo  'customer_activity_list.php' ?> ";
										window.location = newLocation;   
									</script>
									<?php
								}	
							}	
						?>
					  
					   <div class="box-body">
						   <div class="col-sm-12">
							   <center><h5 style="color:red"><?php if(isset($error)) echo $error;?></h5></center>
							   <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
									   <div class="col-sm-6">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Select Customer<b class="color">*</b></label>
												<div class="col-sm-7">
													<select class="form-control" name="customer_id" style="float:left;">
														<option value="">Please Select</option>
														<?php
														if($customer_id1 == 0 )
														{
														?>
														<option value="Other" selected>Other</option>
														<?php
															$sql = "SELECT * from  tbl_customer";
															$result = $mysqli->query($sql);
															while($row = mysqli_fetch_array($result))
															{
																$customer_id = $row['customer_id'];														
														?>														
														<option  value="<?php echo $customer_id;?>"><?php echo $row['customer_name'];?></option>
														<?php
															}	
														}
														else
														{
															?>
														<option value="Other">Other</option>
														<?php
															$sql = "SELECT * from  tbl_customer";
															$result = $mysqli->query($sql);
															while($row = mysqli_fetch_array($result))
															{
																$customer_id = $row['customer_id'];														
														?>														
														<option <?php if($customer_id1 == $row['customer_id']) echo "selected"?> value="<?php echo $customer_id;?>"><?php echo $row['customer_name'];?></option>
														<?php
															}	
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Activity Title<b class="color">*</b></label>
												<div class="col-sm-7">
													<input type="text" class="form-control" id="activity_title" name="activity_title" value="<?php if(isset($_POST['activity_title']) && $_POST['activity_title'] !="") { echo $_POST['activity_title'];}?>">	
												</div>
											</div>
										   	 <div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Feedback<b class="color">*</b></label>
												<div class="col-sm-7">
													<input type="text" class="form-control" id="feedback" name="feedback" value="<?php if(isset($_POST['feedback']) && $_POST['feedback'] !="") { echo $_POST['feedback'];}?>">	
												</div>
											</div>
										</div> 

										<div class="col-sm-6">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Activity By<b class="color">*</b></label>
												<div class="col-sm-7">
													<select class="form-control" name="activity_by" style="float:left;">
														<option value="">Please Select</option>
														<?php
															$sql2 = "SELECT * from  tbl_employee where active = '1'";
															$result2 = $mysqli->query($sql2);
															while($row2 = mysqli_fetch_array($result2))
															{
														?>
														<option <?php if($user == $row2['employee_id']) echo "selected"?> value="<?php echo $row2['employee_id'];?>"><?php echo $row2['employee_name'];?></option>
														<?php
															}	
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Activity Date<b class="color">*</b></label>
												<div class="col-sm-7">
													<input type="text" readonly class="form-control" id="activity_date" name="activity_date" value="<?php if(isset($_POST['activity_date']) && $_POST['activity_date'] !="") { echo $_POST['activity_date'];}?>"><img src="dist/img/calendericon.png" id="dob_img">	
												</div>
											</div>
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Activity Time<b class="color">*</b></label>
												<div class="col-sm-7">
													<select class="form-control" name="hour" style="width:45%; float:left;">
														<option value="">Hour</option>
														<?php
															for($i=0; $i<=23;$i++)
															{
															?>
																<option value="<?php if($i <= 9) echo "0".$i; else echo $i;?>">
																<?php if($i <= 9) echo "0".$i; else echo $i;?>
																</option>
																<?php
															}
														?>
													</select>
													<select class="form-control" name="minutes" style="width:55%; float:left;">
														<option value="">Minutes</option>
														<?php
															for($i=0; $i<=59;$i++)
															{
															?>
																<option value="<?php if($i <= 9) echo "0".$i; else echo $i;?>">
																<?php if($i <= 9) echo "0".$i; else echo $i;?>
																</option>
																<?php
															}
														?>
													</select>
												</div>
											</div>
											
										</div>
								   
										<div class="form-group">
											 <div class="col-sm-offset-5 col-sm-12">
												<div class="checkbox">
													<label>
														<input type="submit" value="Submit" name="submit1" class="btn btn-info">
														<a href="welcome.php" class="btn btn-danger ">Cancel</a>
													</label>
												</div>
											 </div>
										</div>
								   <b class="color"><u style="color:#000;">Note</u> : Fields marked with * are Mandatory</b>
								   </form>
							   </div>
						   </div><!-- /.box-body -->					 
					 </div><!-- /.box -->
				</div>						   
            </div><!-- /.row -->
       <script>
	//initSample();
	CKEDITOR.replace( 'editor',
    {
        width : "100%",
        height : "150px",
    }
	).setData('');

	CKEDITOR.replace( 'editor1',
	{
		width : "100%",
		height : "150px",
	}
	).setData('');
</script>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php
include_once('footer.php');
?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
	  $( function() {
		$( "#activity_date" ).datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true
		});
		
	  } );
	$('#dob_img').click(function(){
      $('#activity_date').datepicker('show');
    });
</script>