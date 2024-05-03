<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
if(!isset($_SESSION['username']))
{
	header('Location:index.php');
}
?>
<script>$('.datepicker').datepicker()</script>
<script src="ckeditor.js"></script>
	<script src="sample.js"></script> 

      <!-- Left side column. contains the logo and sidebar -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <section class="content-header">
			<h1>
				 <i class="fa fa-pencil-square-o"></i>&nbsp;Create To Do  
			</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
				<div class="col-md-12">
					 <!-- Horizontal Form -->
					 <div class="box box-info">
						 <!-- <div class="box-header with-border" style="background: #00c0ef none repeat scroll 0 0;">
							<center><h3 class="box-title">Create To Do</h3></center>
						  </div>--><!-- /.box-header -->
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
                                $role_id = $row2['role_id'];
                                 $role = emp_role($role_id);
								$lead_id = $_POST['lead_id'];
								$user = $_POST['user'];
								$purpose = trim($_POST['purpose']);
								$todo_date = $_POST['todo_date'];
								$hour = $_POST['hour'];
								$minutes = $_POST['minutes'];
								$venue = trim($_POST['venue']);
								
								$time = $hour. ":" .$minutes.":00";
								
								$array_date1 = explode("-", $todo_date);
								$new_todo_date = $array_date1[2]."-".$array_date1[1]."-".$array_date1[0];

								if($lead_id == "")
								{
									$error = "Please Select Lead.";

								}
								else if($user == "")
								{
									$error = "Please Select User.";

								}
								else if($purpose == "")
								{
									$error = "Please enter Purpose";

								}
								else if($todo_date == "")
								{
									$error = "Please Select To Do Date";

								}
								else if($hour == "")
								{
									$error = "Please Select Hour";

								}
								else if($minutes == "")
								{
									$error = "Please Select Minutes";

								}
								else if($venue == "")
								{
									$error = "Please Select enter venue.";

								}

								if($error == "")
								{
									$sql = "INSERT INTO `tbl_todo`(`lead_id`, `user`, `purpose`, `todo_date`, `time`, `venue`) VALUES ('$lead_id','$user','$purpose','$new_todo_date','$time','$venue')";
									
									$mysqli->query($sql);	

									?>
									<script type="text/javascript">
										alert("To Do Added Successfully ");
										var newLocation = "<?php echo 'todo_list.php' ?> ";
										window.location = newLocation;   
									</script>
									<?php
								}	
							}	
						?>
					  
					   <div class="box-body">
						   <div class="col-sm-12">
							   <center><h5 style="color:red; text-align:center;"><?php if(isset($error)) echo $error;?></h5></center>
						   		<?php
									$sql = "SELECT * from  tbl_body_member 	where 1";
									$result = $mysqli->query($sql);
									$row = mysqli_fetch_array($result);
								?>
							   <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
									   <div class="col-sm-6">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Select Lead<b class="color">*</b></label>
												<div class="col-sm-7">
													<select class="form-control" data-validation="required" name="lead_id" style="float:left;">
														<option value="">Please Select</option>
														<?php
															$sql = "SELECT * from  tbl_new_leads";
															$result = $mysqli->query($sql);
															while($row = mysqli_fetch_array($result))
															{
																$lead_id = $row['lead_id'];														
														?>														
														<option <?php if(isset($_POST['lead_id']) and $_POST['lead_id']== $row['lead_id']) echo "selected"?> value="<?php echo $lead_id;?>"><?php echo $row['lead_company_name'];?></option>
														<?php
															}	
														?>
													</select>
												</div>
											</div>
										   <div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Select Executive<b class="color">*</b></label>
												<div class="col-sm-7">
													<select class="form-control" data-validation="required" name="user" style="float:left;">
														<option value="">Please Select</option>
														<?php
															$sql2 = "SELECT * from  tbl_employee where active = '1'";
															$result2 = $mysqli->query($sql2);
															while($row2 = mysqli_fetch_array($result2))
															{
														?>
														<option <?php if(isset($_POST['user']) and $_POST['user']== $row2['employee_id']) echo "selected"?> value="<?php echo $row2['employee_id'];?>"><?php echo $row2['employee_name'];?></option>
														<?php
															}	
														?>
													</select>
												</div>
											</div>
										   	 <div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Purpose<b class="color">*</b></label>
												<div class="col-sm-7">
													<input type="text" class="form-control" data-validation="required" id="purpose" name="purpose" value="<?php if(isset($_POST['purpose']) && $_POST['purpose'] !="") { echo $_POST['purpose'];}?>">	
												</div>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Date<b class="color">*</b></label>
												<div class="col-sm-7">
													<input type="text" class="form-control" data-validation="required" id="todo_date" name="todo_date"  value="<?php if(isset($_POST['todo_date']) && $_POST['todo_date'] !="") { echo $_POST['todo_date'];}?>"><img src="dist/img/calendericon.png" id="dob_img">	
												</div>
											</div>
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Time<b class="color">*</b></label>
												<div class="col-sm-7">
													<select class="form-control" data-validation="required" name="hour" style="width:45%; float:left;">
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
													<select class="form-control" data-validation="required" name="minutes" style="width:55%; float:left;">
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
											 <div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Venue<b class="color">*</b></label>
												<div class="col-sm-7">
													<input type="text" class="form-control" data-validation="required" id="venue" name="venue" value="<?php if(isset($_POST['venue']) && $_POST['venue'] !="") { echo $_POST['venue'];}?>">	
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
		$( "#todo_date" ).datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true
		});
		
	  } );
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate({

  });
</script> 