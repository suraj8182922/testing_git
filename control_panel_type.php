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
				 <i class="fa fa-pencil-square-o"></i>&nbsp;Add Control Panel Type
			</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
				<div class="col-md-12">
					 <!-- Horizontal Form -->
					 <div class="box box-info">
						  <!--<div class="box-header with-border forpghdr">
							<center><h3 class="box-title">Add Control Panel Type Detail</h3></center>
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
								
								if($_POST['operator_type']=='Manual'){
									$_POST['operator_type']=1;
								}
								else{
									$_POST['operator_type']=2;
								}
								if($_POST['machine_mode']=='Geared'){
									$_POST['machine_mode']=1;
								}
								else{
									$_POST['machine_mode']=2;
								}
							
								$error = "";	
								$person_capacity=$_POST['person_capacity'];
								$control_panel_type = trim($_POST['control_panel_type']);
								$prize = trim($_POST['prize']);
								$machine_mode=trim($_POST['machine_mode']);
								$operator_type=trim($_POST['operator_type']);
								
								if($control_panel_type == "")
								{
									$error = "Please Enter control panel type.";

								}
								
								if($error == "")
								{
									$sql = "INSERT INTO `tbl_control_panel_type`(`control_panel_type`,`material_type`,`operator_type`,`prize`,`passenger`) VALUES ('$control_panel_type','$machine_mode','$operator_type','$prize','$person_capacity')";
																	
									$mysqli->query($sql);	

									?>
									<script type="text/javascript">
										alert("Added Successfully ");
										var newLocation = "<?php echo  'control_panel_type.php' ?> ";
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
								   <div class="col-sm-3">
								   </div>
								   <div class="col-sm-6">
								   <div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Operator Type<b class="color">*</b></label>
												<div class="col-sm-6">
													<select class="form-control" data-validation="required" id="operator_type" name="operator_type" style="float:left;">
														<option value="">Please Select</option>
														<?php
															$sql2 = "SELECT * from  tbl_operator_elevator";
															$result2 = $mysqli->query($sql2);
														
															while($row2 = mysqli_fetch_array($result2))
														{
																
														?>
														<option <?php if(isset($_POST['operator_type']) and $_POST['operator_type']== $row2['name']) echo "selected"?> value="<?php echo $row2['name'];?>"><?php echo $row2['name'];?></option>
														<?php
															}	
														?>
													</select>
												</div>
											</div>		   
								   <div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Machine mode<b class="color">*</b></label>
												<div class="col-sm-6">
													<select class="form-control" data-validation="required" id="machine_mode" name="machine_mode" style="float:left;">
														<option value="">Please Select</option>
														<?php
															$sql2 = "SELECT * from  tbl_material_mode";
															$result2 = $mysqli->query($sql2);
															while($row2 = mysqli_fetch_array($result2))
															{
														?>
														<option <?php if(isset($_POST['machine_mode']) and $_POST['machine_mode']== $row2['name']) echo "selected"?> value="<?php echo $row2['name'];?>"><?php echo $row2['name'];?></option>
														<?php
															}	
														?>
													</select>
												</div>
											</div>		 
																	   
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label">Control Panel Type<b class="color">*</b></label>
											<div class="col-sm-6">
												<input type="text" autofocus="autofocus" class="form-control" id="control_panel_type" name="control_panel_type" placeholder="Control Panel Type" >	
											</div>
										</div>
									   <div class="form-group">
												<label for="" class="col-sm-4 control-label">Capacity Type<b class="color">*</b></label>
												<div class="col-sm-6">
													<input type="radio" class="" id="capacity1" onclick="in_person()"  data-validation="required" name="capacity_term" value="in_person">Persons	
													<input type="radio" class="" id="capacity1" onclick="in_kg()" data-validation="required" name="capacity_term" value="in_kg" >Kg	
												</div>
											</div>
									   <div class="form-group" id="persons">
												<label for="" class="col-sm-4 control-label">Select Persons<b class="color">*</b></label>
												<div class="col-sm-6">
													<!--<input type="text" class="form-control" id="capacity" name="capacity" value="<?php if(isset($_POST['capacity']) && $_POST['capacity'] !="") { echo $_POST['capacity'];}?>">	-->
													<select class="form-control" data-validation="required" name="person_capacity" id="person_capacity"  onchange="get_det()" style="padding: 6px 0px;">
														<option value="">Select</option>
														<?php
															$persons=array(4,6,8,10,13,15,20);
															for($i=0; $i<=23;$i++)
															{ 
																if(in_array($i,$persons)){
														
																$total_pesonskg = 68 * $i;
																//$capacity = $person_capacity." Persons/".$total_pesonskg." Kg. ";
															?>
																<option value="<?php if($i <= 9) echo "0".$i." Persons/".$total_pesonskg." Kg. "; else echo $i ." Persons/".$total_pesonskg." Kg. ";?>">
																	
																
																<?php if($i <= 9) echo "0".$i." Persons/".$total_pesonskg." Kg. "; else echo $i." Persons/".$total_pesonskg." Kg. " ;?>
																</option>
																<?php
															}
															}
														?>
													</select>
													
												</div>
												</div>
												<div class="form-group" id="kg" style="display:none">
												<label for="" class="col-sm-4 control-label">Enter KG<b class="color">*</b></label>
												<div class="col-sm-6">
													<!--<input type="text" class="form-control" id="kg_capacity" name="kg_capacity" value="<?php if(isset($_POST['kg_capacity']) && $_POST['kg_capacity'] !="") { echo $_POST['kg_capacity'];}?>">	-->
													<select class="form-control" data-validation="required" name="kg_capacity" style="float:left;">
														<option value="">Please Select</option>
														<option <?php if($capacity=='100') echo "selected"?> value="100">100 Kg</option>
														<option <?php if($capacity=='150') echo "selected"?> value="150">150 Kg</option>
														<option <?php if($capacity=='200') echo "selected"?> value="200">200 Kg</option>
														<option <?php if($capacity=='250') echo "selected"?> value="250">250 Kg</option>
														<option <?php if($capacity=='300') echo "selected"?> value="300">300 Kg</option>
														<option <?php if($capacity=='500') echo "selected"?> value="500">500 Kg</option>
														<option <?php if($capacity=='750') echo "selected"?> value="750">750 Kg</option>
														<option <?php if($capacity=='1000') echo "selected"?> value="1000">1000 Kg</option>
														<option <?php if($capacity=='1500') echo "selected"?> value="1500">1500 Kg</option>
														<option <?php if($capacity=='2000') echo "selected"?> value="2000">2000 Kg</option>
														<option <?php if($capacity=='2500') echo "selected"?> value="2500">2500 Kg</option>
														<option <?php if($capacity=='3000') echo "selected"?> value="3000">3000 Kg</option>
													</select>
												</div>
											</div>
									    
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label">Prize<b class="color">*</b></label>
											<div class="col-sm-6">
												<input type="text" autofocus="autofocus" class="form-control" id="prize" name="prize" placeholder="Prize" >	
											</div>
										</div>
									   <div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label"></label>
											<div class="col-sm-6">
												<input type="submit"  value="Submit" name="submit1" class="btn btn-info">
											</div>
										</div>
									
							 </div>
						   
							   </form>
						   <div class="col-sm-12">
							   <hr class="forhr">
							   <div class="col-sm-2">
							   </div>
								<div class="col-sm-8">
									<center><h4 class="h4lift">Control Panel Type List</h4></center>
									<table class="table table-bordered" style="width:100%;">
										<tr class="forlistview">
											<th>Sr.No.</th>
											<th>Control Panel Type</th>
											<th>No.of Passenger</th>
											<th>Prize</th>
											<th>Edit</th>
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
											$sql = "SELECT * from  tbl_control_panel_type where 1 LIMIT $start_from, 10";
											$result = $mysqli->query($sql);
											while($row = mysqli_fetch_array($result))
											{
												?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo $row['control_panel_type']?></td>
													<td><?php echo $row['passenger']?></td>
													<td><?php echo $row['prize']?></td>
													<td>
														<center><a href="edit_control_panel_type.php?control_panel_type_id=<?php echo $row['id']?>" class="btn btn-info forview" data-toggle="modal tooltip" title="Edit Control Panel Type"><i class="fa fa-edit"></i></a></center>
													</td>
												     <td>
														<center><a href="delete_control_panel_type.php?control_panel_type_id=<?php echo $row['id']?>" class="btn btn-danger forview" data-toggle="modal tooltip" title="Delete Control Panel Type"><i class="fa fa-edit"></i></a></center>
													</td>
												</tr>
												<?php
												$i++;	
											}	
										?>
									  </table>
									  <br>
									  <?php 	
								$sql = "SELECT * FROM tbl_control_panel_type where 1"; 
								$rs_result = $mysqli->query($sql); 
								$row = mysqli_num_rows($rs_result); 
								$total_records = $row;  
								$total_pages = ceil($total_records / 10); 
								
								if($page>1)
								{
									echo "<a href='control_panel_type.php?page=".($page-1)."'class='buttonpn1'>PREVIOUS</a>";
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
										echo "<a href='control_panel_type.php?page=".$i."'class='$for_cls'>".$i."</a> ";
									//echo "<a href='purchase_order_list.php?page=".$i."'class='buttonpn'>".$i."</a> ";
									
								}
								if($page != $total_pages)
								{
									echo "<a href='control_panel_type.php?page=".($page+1)."' class='buttonpn2'>Next</a>";
								}
								echo "</br>";
								echo "<p><hr></p>\n";
								?>
								</div>
							   <div class="col-sm-2">
							   </div>
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