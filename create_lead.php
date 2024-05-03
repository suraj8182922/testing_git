<?php
include_once('config.php');
include_once('header.php');
include_once('sidebar.php');
if(!isset($_SESSION['username']))
{
	header('Location:index.php');
}
?>
<style>
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #fff;
    opacity: 1;
}	
	
#email2{
		display:none;
	}
</style>
<script>
function myFunction() {
  var input = document.getElementById('customer_name');

  var capitalizedWords =
    input
      .value
      .split(' ')
      .map(function(word) {
        return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
      })
      .join(' ');
  
  input.value = capitalizedWords;
}	
	function myFunction2() {
  var input = document.getElementById('lead_company_name');

  var capitalizedWords =
    input
      .value
      .split(' ')
      .map(function(word) {
        return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
      })
      .join(' ');
  
  input.value = capitalizedWords;
}	
function isAlpha(keyCode)

{

return ((keyCode >= 65 && keyCode <= 90) || keyCode == 8 || keyCode == 32 || keyCode == 190)

}	
	function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }
function addemail() {
	document.getElementById("email2").style.display = "block";
	}
	function addname() {
	document.getElementById("email2").style.display = "block";
	}
</script>
<script>$('.datepicker').datepicker()</script>
<script src="ckeditor.js"></script>
	<script src="sample.js"></script> 

      <!-- Left side column. contains the logo and sidebar -->


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <section class="content-header">
			<h1>
				 <i class="fa fa-pencil-square-o"></i>&nbsp;Add New Lead 
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
							<center><h3 class="box-title">Enter Leads Details</h3></center>
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

								$lead_date = trim($_POST['lead_date']);
								$lead_source = trim($_POST['lead_source']);
								$lead_type = trim($_POST['lead_type']);
								$lead_company_name = trim($_POST['lead_company_name']);
								$salutations = trim($_POST['salutations']);
								$customer_name = trim($_POST['customer_name']);
								$email_id = trim($_POST['email_id']);
								$email_id2 = trim($_POST['email_id2']);
								$country_code = trim($_POST['country_code']);
								$contact_no = trim($_POST['contact_no']);
								$contact_no1 = trim($_POST['contact_no1']);
								$address = trim($_POST['address']);
								$lead_stage = trim($_POST['lead_stage']);
								$site_name = trim($_POST['site_name']);
								$site_address = trim($_POST['site_address']);
								$activity_by = trim($_POST['activity_by']);
								
								/*$new_customer_name = $salutations." ".$customer_name;
								$new_contact_no = "+".$country_code." ".$contact_no;*/
								
								$array_date1 = explode("-", $lead_date);
								$new_lead_date = date("Y-m-d h:i:s");
								
								$sql = "SELECT * from  tbl_lead_stage where stage_name = '$lead_stage'";
								$result = $mysqli->query($sql);
								$row = mysqli_fetch_array($result);
								$stage_lead = $row['stage_id'];
																								
								if($lead_date == "")
								{
									$error = "Please Select Lead Date.";
								}
								else if($lead_type == "")
								{
									$error = "Please Select Lead Type.";
								}
								else if($lead_company_name == "")
								{
									$error = "Please Enter Company Name.";
								}
								else if($salutations == "")
								{
									$error = "Please Select salutations.";
								}
								else if($customer_name == "")
								{
									$error = "Please Enter Customer Name.";
								}
								else if (preg_match("/^[a-zA-Z. -]+$/", $customer_name)===0)
								{
									$error = "Customer Name Must be character.";
								}
								/*else if($email_id == "")
								{
									$error = "Please Enter Email Id.";

								}
								else if(!filter_var($email_id, FILTER_VALIDATE_EMAIL))
								{
									$error = "Invalid email format.";

								}*/
								else if($country_code == "")
								{
									$error = "Please select Country Code.";

								}
								else if($contact_no == "")
								{
									$error = "Please Enter Contact Number.";

								}
								/*else if (!preg_match('/^[0-9]{3}[0-9]{3}[0-9]{4}$/', $contact_no))
								{
									$error = "Invalid Contact Number.";
								}*/
								else if (!preg_match('/^\d{10}$/', $contact_no))
								{
									$error = "Invalid Contact Number.";
								}
								else if($address == "")
								{
									$error = "Please Enter Address.";
								}
								else if($site_name == "")
								{
									$error = "Please Enter Site Name.";
								}
								else if($site_address == "")
								{
									$error = "Please Enter Site Address.";
								}
								
								if($error == "")
								{									
									   $sql = "INSERT INTO `tbl_new_leads`(`lead_date`,`activity_by`,`lead_source`, `lead_type`, `lead_company_name`, `salutations`,`customer_name`, `email_id`, `email_id2`,`country_code`,`contact_no`, `contact_no1`,`address`, `site_name`, `site_address`, `lead_stage`) VALUES ('$new_lead_date','$activity_by','$lead_source','$lead_type','$lead_company_name','$salutations','$customer_name','$email_id','$email_id2','$country_code','$contact_no','$contact_no1','$address','$site_name','$site_address','$stage_lead')";
											
									$mysqli->query($sql);
									$last_insert_id = $mysqli->insert_id;
									
									if($lead_type=="New Installation")
									{
								$mail_body = "We are pleased to Welcome you as a customer of Phoenix Elevator.<br>We feel honored that you have chosen us to fill Elevator product needs and we are eager to be of service.<br><br><b style='color:green;'>We will send Quotation shortly.</b>";
									
									$to = $email_id;

									$subject = "Welcome To Phoenix Elevator.";

									$headers .= "From: Phoenix Elevator";

									$headers .= "Reply-To: ". strip_tags('info@onlinenes.com') . "\r\n";

									$headers .= "MIME-Version: 1.0\r\n";
									$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

									$message = '<html><body>';
									$message .= "<br>";
									$message .= "<b>Dear ".$customer_name .", </b>.";
									$message .= "<br>";
									$message .= "<br>";
									$message .= "<b>".$mail_body." </b>";
									$message .= "<br>";
									$message .= "<br>";
									$message .= "<br>";
									$message .= "<br>";
									$message .= "<br>";
									$message .= "<br>";
									$message .= "<p style='font-size:16px;'>Thank You.<br>Best Regards,<br>Sales Department<br>PHOENIX ELEVATOR INDIA PVT. LTD.</p>";				
										
					//		$message .= '<img src="http://forcetechnologies.in/starforce/dist/img/force_logo.jpg" alt="Website Change Request" />';
									$message .= "<p style='font-size:16px; color:blue ;'>T: +91-85520-15252 | +91-77670-04270 <br>info@phoenixelevator.in , www.phoenixelevator.in </p>";
									$message .= "<b style='font-size:18px;'>Follow us on  Facebook  / twitter / LinkedIn <br>";
									$message .= "<p style='font-size:16px;'><u> Lifting Performance and Quality to greater heights</u><br>IF ANY QUERY OR DIFFICULTY IN THIS EMAIL SO FEEL FREE TO CONTACT US</p>";
									$message .= "<br>";
									
									$message .= "</body></html>";
									 
									require 'mail_files/PHPMailerAutoload.php';
									$mail = new PHPMailer;
									$mail->setFrom('info@onlinenes.com', 'Phoenix Elevator');
									$mail->addAddress($email_id);   // Add a recipient
									$mail->isHTML(true);  // Set email format to HTML
									 $mail->Subject = $subject;
									 $mail->Body    = $message;
								//	 $mail->AddEmbeddedImage('force_logo.jpg', 'logoimg', 'force_logo.jpg');
									// $mail->AddAttachment("uploads/broucher.pdf");
										//echo $message;
										//die();
//require("class.phpmailer.php");
//$mail = new PHPMailer();
//$mail->IsSMTP();
//$mail->Host = "phoenixelevators.in";
//$mail->SMTPAuth = true;
//$mail->Port = 587;
//$mail->Username = "info@phoenixelevators.in";
//$mail->Password = "info@admin";
//$mail->From = "info@phoenixelevators.in";
//$mail->FromName = "Phoenix Elevator";
//$mail->AddAddress($email_id);
//$mail->IsHTML(true);
//$mail->Subject = $subject;
//$mail->Body    = $message;
//$mail->AddAttachment("uploads/broucher.pdf");										
									
	
										
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
//echo "Message could not be sent. <p>";
//echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}	
									else
									{
									?>
									<script type="text/javascript">
										alert("Enquiry Added Successfully ");
										var newLocation = "<?php echo 'lead_list.php' ?> ";
										window.location = newLocation;   
									</script>
									<?php
									}
									}
									else
									{
									$cust_name = $salutations." ".$customer_name;
									$mail_body = "<b style='color:black;>We are pleased to Welcome you as a customer of Phoenix Elevator.<br>We feel honored that you have chosen us to fill Elevator product needs and we are eager to be of service.</b><br><br><b style='color:green;'>We will send Quotation shortly.</b>";
									
									$to = $email_id;

									$subject = "Welcome To Phoenix Elevator.";

									$headers .= "From: Phoenix Elevator";

									$headers .= "Reply-To: ". strip_tags('info@onlinenes.com') . "\r\n";

									$headers .= "MIME-Version: 1.0\r\n";
									$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

									$message = '<html><body>';
									$message .= "<br>";
									$message .= "<b>Dear ".$cust_name.", </b>.";
									$message .= "<br>";
									$message .= "<br>";
									$message .= "<b>".$mail_body." </b>";
									$message .= "<br>";
									$message .= "<br>";
									$message .= "<br>";
									$message .= "<p style='font-size:16px; color:black ;'>Thank You.<br>Best Regards,<br>Sales Department<br>PHOENIX ELEVATOR INDIA PVT. LTD.</p>";				
										
								//	$message .= '<img src="http://forcetechnologies.in/starforce/dist/img/force_logo.jpg" alt="Website Change Request" />';
									$message .= "<p style='font-size:16px; color:blue ;'>T: +91-85520-15252 | +91-77670-04270 <br>info@phoenixelevator.in , www.phoenixelevator.in </p>";
									$message .= "<b style='font-size:18px; color:black ;'>Follow us on  Facebook  / twitter / LinkedIn <br>";
									$message .= "<p style='font-size:16px; color:black ;'><u> Lifting Performance and Quality to greater heights</u><br>IF ANY QUERY OR DIFFICULTY IN THIS EMAIL SO FEEL FREE TO CONTACT US</p>";
									$message .= "<br>";
									
									$message .= "</body></html>";
									
	require 'mail_files/PHPMailerAutoload.php';
									$mail = new PHPMailer;
									$mail->setFrom('info@onlinenes.com', 'Phoenix Elevator');
									$mail->addAddress($email_id);   // Add a recipient
									$mail->isHTML(true);  // Set email format to HTML
									 $mail->Subject = $subject;
									 $mail->Body    = $message;
								//	 $mail->AddEmbeddedImage('force_logo.jpg', 'logoimg', 'force_logo.jpg');
									 
									// $mail->AddAttachment("uploads/broucher.pdf");
										//echo $message;
										//die();
								//	echo $message;
								//		die();

									if(!$mail->send())
									{
										$error1 = "Mail Not Sent.";
									}	
									?>
									<script type="text/javascript">
										alert("Lead Added Successfully ");
										var newLocation = "<?php echo 'lead_list.php'?> ";
										window.location = newLocation;   
									</script>
									<?php
									}
								}	
							}	
						?>
					  
					   <div class="box-body">
						   <div class="col-sm-12">
							  <center><h5 style="color:red; text-align:center;"><?php if(isset($error)) echo $error;?></h5></center>
							   <br>
						   		<?php
									$sql = "SELECT * from  tbl_body_member 	where 1";
									$result = $mysqli->query($sql);
									$row = mysqli_fetch_array($result);
								?>
							   
							   <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
								   
									   <div class="col-sm-6">
										   <div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Lead Date<b class="color"> *</b></label>
												<div class="col-sm-7">
													<input type="text" readonly class="form-control" data-validation="required" id="lead_date" name="lead_date" value="<?php if(isset($_POST['lead_date']) && $_POST['lead_date'] !="") { echo $_POST['lead_date'];}?>"><img src="dist/img/calendericon.png" id="dob_img">
													<input type="hidden" readonly class="form-control" id="lead_stage" name="lead_stage" value="Contact">	
												</div>
											</div>
										   
								 <div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Select Executive<b class="color">*</b></label>
												<div class="col-sm-7">
													<select class="form-control" data-validation="required" id="activity_by" name="activity_by" style="float:left;">
														<option value="">Please Select</option>
														<?php
															$sql2 = "SELECT * from  tbl_employee where active = '1'";
															$result2 = $mysqli->query($sql2);
															while($row2 = mysqli_fetch_array($result2))
															{
														?>
														<option <?php if(isset($_POST['activity_by']) and $_POST['activity_by']== $row2['employee_name']) echo "selected"?> value="<?php echo $row2['employee_name'];?>"><?php echo $row2['employee_name'];?></option>
														<?php
															}	
														?>
													</select>
												</div>
											</div>		   
										   
										   
										   
										   <div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Lead Source</label>
												<div class="col-sm-7">
													<select class="form-control" name="lead_source" style="float:left;">
														<option value="">Please Select</option>
														<option <?php if(isset($_POST['lead_source']) and $_POST['lead_source']== "Indiamart") echo "selected"?> value="Indiamart">Indiamart</option>
														<option <?php if(isset($_POST['lead_source']) and $_POST['lead_source']== "Justdial") echo "selected"?>value="Justdial">Justdial</option>
														<option <?php if(isset($_POST['lead_source']) and $_POST['lead_source']== "Referance") echo "selected"?>value="Referance">Referance</option>
													</select>
												</div>
											</div>
										   
										   <div class="form-group">
												<label class="col-sm-4 control-label">Lead Type<b class="color"> *</b></label>
												<div class="col-sm-7">
													<select class="form-control" data-validation="required" name="lead_type" style="float:left;">
														<option value="">Please Select</option>
														<option <?php if(isset($_POST['lead_type']) and $_POST['lead_type']== "New Installation") echo "selected"?> value="New Installation">New Installation</option>
														<option <?php if(isset($_POST['lead_type']) and $_POST['lead_type']== "AMC") echo "selected"?>value="AMC">AMC</option>
													</select>
												</div>
											</div>
										   
											<div class="form-group">
												<label class="col-sm-4 control-label">Customer Name<b class="color"> *</b></label>
												<div class="col-sm-2 for_country_code">
													<select class="form-control for_select" data-validation="required" name="salutations">
														<option value="">Select</option>
														<option <?php if(isset($_POST['salutations']) and $_POST['salutations']== "Mr.") echo "selected"?> value=" Mr." selected>Mr.</option>
														<option <?php if(isset($_POST['salutations']) and $_POST['salutations']== "Mrs.") echo "selected"?>value="Mrs.">Mrs.</option>
														<option <?php if(isset($_POST['salutations']) and $_POST['salutations']== "Miss") echo "selected"?> value="Miss">Miss.</option>
														<option <?php if(isset($_POST['salutations']) and $_POST['salutations']== "Ms.") echo "selected"?>value="Ms.">Ms.</option>
														<option <?php if(isset($_POST['salutations']) and $_POST['salutations']== "Dr.") echo "selected"?>value="Dr.">Dr.</option>
														<option <?php if(isset($_POST['salutations']) and $_POST['salutations']== "Prof.") echo "selected"?> value="Prof.">Prof.</option>
														<option <?php if(isset($_POST['salutations']) and $_POST['salutations']== "Rev.") echo "selected"?>value="Rev.">Rev.</option>
														<option <?php if(isset($_POST['salutations']) and $_POST['salutations']== "Other") echo "selected"?> value="Other">Other</option>
													</select>	
												</div>
												<div class="col-sm-6 for_country_code1">
													<input type="text" class="form-control" data-validation="required" id="customer_name" name="customer_name" onkeyup="myFunction()" onkeydown = "return isAlpha(event.keyCode);" value="<?php if(isset($_POST['customer_name']) && $_POST['customer_name'] !="") { echo $_POST['customer_name'];}?>">	
												</div>
												
											</div>
												
										   <div class="form-group">
												<label class="col-sm-4 control-label">Company/Society Name<b class="color">*</b></label>
												<div class="col-sm-7">
													<input type="text" class="form-control" data-validation="required" id="lead_company_name" name="lead_company_name" onkeyup="myFunction2()" value="<?php if(isset($_POST['lead_company_name']) && $_POST['lead_company_name'] !="") { echo $_POST['lead_company_name'];}?>">	
												</div>
											</div>
										   
										   <div class="form-group">
												<label class="col-sm-6 control-label">Site Name same as Company Name</label>
												<div class="col-sm-6">
													<input type="radio" class="" onclick="tax_check()" id="check"  name="checks" value="yes"> Yes	
													<input type="radio" class="" onclick="tax_check_n()" id="check"  name="checks" value="no"> No	
												</div>
											</div>
										   
										   <div class="form-group">
												<label class="col-sm-4 control-label">Site Name<b class="color"> *</b></label>
												<div class="col-sm-7">
													<input type="text" class="form-control" data-validation="required" id="site_name" name="site_name" value="<?php if(isset($_POST['site_name']) && $_POST['site_name'] !="") { echo $_POST['site_name'];}?>" >	
												</div>
											</div>
										   
										</div> 

										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-sm-4 control-label">Email Id 1</label>
												<div class="col-sm-6" style="padding-right:0px;">
													<input type="text" class="form-control" data-validation="email required" id="email_id" name="email_id" value="<?php if(isset($_POST['email_id']) && $_POST['email_id'] !="") { echo $_POST['email_id'];}?>" >	
												</div>
											   <div class="col-sm-1" style="padding-left:0px;">
													<a class="btn btn-info" onclick="addemail()"  id="addemail" style="float:left;" type="button" >Add</a>
												</div>
											</div>
										   <div class="form-group" id="email2">
												<label class="col-sm-4 control-label">Email Id 2</label>
												<div class="col-sm-6" style="padding-right:0px;">
													<input type="text" class="form-control" data-validation="required" id="email_id2" name="email_id2" value="<?php if(isset($_POST['email_id2']) && $_POST['email_id2'] !="") { echo $_POST['email_id2'];}?>" >	
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Contact No.<b class="color"> *</b></label>
												<div class="col-sm-3 for_country_code">
													<select class="form-control" data-validation="required" name="country_code">
														<option value="">Select</option>
														<option data-countryCode="IN" value="+91" selected>India (+91)</option>
														<optgroup label="Other countries">
															<option data-countryCode="GB" value="+44">UK (+44)</option>
															<option data-countryCode="US" value="+1">USA (+1)</option>
															<option data-countryCode="DZ" value="+213">Algeria (+213)</option>
															<option data-countryCode="AD" value="+376">Andorra (+376)</option>
															<option data-countryCode="AO" value="+244">Angola (+244)</option>
															<option data-countryCode="AI" value="+1264">Anguilla (+1264)</option>
															<option data-countryCode="AG" value="+1268">Antigua (+1268)</option>
															<option data-countryCode="AG" value="+1268">Barbuda (+1268)</option>
															<option data-countryCode="AR" value="+54">Argentina (+54)</option>
															<option data-countryCode="AM" value="+374">Armenia (+374)</option>
															<option data-countryCode="AW" value="+297">Aruba (+297)</option>
															<option data-countryCode="AU" value="+61">Australia (+61)</option>
															<option data-countryCode="AT" value="+43">Austria (+43)</option>
															<option data-countryCode="AZ" value="+994">Azerbaijan (+994)</option>
															<option data-countryCode="BS" value="+1242">Bahamas (+1242)</option>
															<option data-countryCode="BH" value="+973">Bahrain (+973)</option>
															<option data-countryCode="BD" value="+880">Bangladesh (+880)</option>
															<option data-countryCode="BB" value="+1246">Barbados (+1246)</option>
															<option data-countryCode="BY" value="+375">Belarus (+375)</option>
															<option data-countryCode="BE" value="+32">Belgium (+32)</option>
															<option data-countryCode="BZ" value="+501">Belize (+501)</option>
															<option data-countryCode="BJ" value="+229">Benin (+229)</option>
															<option data-countryCode="BM" value="+1441">Bermuda (+1441)</option>
															<option data-countryCode="BT" value="+975">Bhutan (+975)</option>
															<option data-countryCode="BO" value="+591">Bolivia (+591)</option>
															<option data-countryCode="BA" value="+387">Bosnia Herzegovina (+387)</option>
															<option data-countryCode="BW" value="+267">Botswana (+267)</option>
															<option data-countryCode="BR" value="+55">Brazil (+55)</option>
															<option data-countryCode="BN" value="+673">Brunei (+673)</option>
															<option data-countryCode="BG" value="+359">Bulgaria (+359)</option>
															<option data-countryCode="BF" value="+226">Burkina Faso (+226)</option>
															<option data-countryCode="BI" value="+257">Burundi (+257)</option>
															<option data-countryCode="KH" value="+855">Cambodia (+855)</option>
															<option data-countryCode="CM" value="+237">Cameroon (+237)</option>
															<option data-countryCode="CA" value="+1">Canada (+1)</option>
															<option data-countryCode="CV" value="+238">Cape Verde Islands (+238)</option>
															<option data-countryCode="KY" value="+1345">Cayman Islands (+1345)</option>
															<option data-countryCode="CF" value="+236">Central African Republic (+236)</option>
															<option data-countryCode="CL" value="+56">Chile (+56)</option>
															<option data-countryCode="CN" value="+86">China (+86)</option>
															<option data-countryCode="CO" value="+57">Colombia (+57)</option>
															<option data-countryCode="KM" value="+269">Comoros (+269)</option>
															<option data-countryCode="CG" value="+242">Congo (+242)</option>
															<option data-countryCode="CK" value="+682">Cook Islands (+682)</option>
															<option data-countryCode="CR" value="+506">Costa Rica (+506)</option>
															<option data-countryCode="HR" value="+385">Croatia (+385)</option>
															<option data-countryCode="CU" value="+53">Cuba (+53)</option>
															<option data-countryCode="CY" value="+90392">Cyprus North (+90392)</option>
															<option data-countryCode="CY" value="+357">Cyprus South (+357)</option>
															<option data-countryCode="CZ" value="+42">Czech Republic (+42)</option>
															<option data-countryCode="DK" value="+45">Denmark (+45)</option>
															<option data-countryCode="DJ" value="+253">Djibouti (+253)</option>
															<option data-countryCode="DM" value="+1809">Dominica (+1809)</option>
															<option data-countryCode="DO" value="+1809">Dominican Republic (+1809)</option>
															<option data-countryCode="EC" value="+593">Ecuador (+593)</option>
															<option data-countryCode="EG" value="+20">Egypt (+20)</option>
															<option data-countryCode="SV" value="+503">El Salvador (+503)</option>
															<option data-countryCode="GQ" value="+240">Equatorial Guinea (+240)</option>
															<option data-countryCode="ER" value="+291">Eritrea (+291)</option>
															<option data-countryCode="EE" value="+372">Estonia (+372)</option>
															<option data-countryCode="ET" value="+251">Ethiopia (+251)</option>
															<option data-countryCode="FK" value="+500">Falkland Islands (+500)</option>
															<option data-countryCode="FO" value="+298">Faroe Islands (+298)</option>
															<option data-countryCode="FJ" value="+679">Fiji (+679)</option>
															<option data-countryCode="FI" value="+358">Finland (+358)</option>
															<option data-countryCode="FR" value="+33">France (+33)</option>
															<option data-countryCode="GF" value="+594">French Guiana (+594)</option>
															<option data-countryCode="PF" value="+689">French Polynesia (+689)</option>
															<option data-countryCode="GA" value="+241">Gabon (+241)</option>
															<option data-countryCode="GM" value="+220">Gambia (+220)</option>
															<option data-countryCode="GE" value="+7880">Georgia (+7880)</option>
															<option data-countryCode="DE" value="+49">Germany (+49)</option>
															<option data-countryCode="GH" value="+233">Ghana (+233)</option>
															<option data-countryCode="GI" value="+350">Gibraltar (+350)</option>
															<option data-countryCode="GR" value="+30">Greece (+30)</option>
															<option data-countryCode="GL" value="+299">Greenland (+299)</option>
															<option data-countryCode="GD" value="+1473">Grenada (+1473)</option>
															<option data-countryCode="GP" value="+590">Guadeloupe (+590)</option>
															<option data-countryCode="GU" value="+671">Guam (+671)</option>
															<option data-countryCode="GT" value="+502">Guatemala (+502)</option>
															<option data-countryCode="GN" value="+224">Guinea (+224)</option>
															<option data-countryCode="GW" value="+245">Guinea - Bissau (+245)</option>
															<option data-countryCode="GY" value="+592">Guyana (+592)</option>
															<option data-countryCode="HT" value="+509">Haiti (+509)</option>
															<option data-countryCode="HN" value="+504">Honduras (+504)</option>
															<option data-countryCode="HK" value="+852">Hong Kong (+852)</option>
															<option data-countryCode="HU" value="+36">Hungary (+36)</option>
															<option data-countryCode="IS" value="+354">Iceland (+354)</option>
															<option data-countryCode="ID" value="+62">Indonesia (+62)</option>
															<option data-countryCode="IR" value="+98">Iran (+98)</option>
															<option data-countryCode="IQ" value="+964">Iraq (+964)</option>
															<option data-countryCode="IE" value="+353">Ireland (+353)</option>
															<option data-countryCode="IL" value="+972">Israel (+972)</option>
															<option data-countryCode="IT" value="+39">Italy (+39)</option>
															<option data-countryCode="JM" value="+1876">Jamaica (+1876)</option>
															<option data-countryCode="JP" value="+81">Japan (+81)</option>
															<option data-countryCode="JO" value="+962">Jordan (+962)</option>
															<option data-countryCode="KZ" value="+7">Kazakhstan (+7)</option>
															<option data-countryCode="KE" value="+254">Kenya (+254)</option>
															<option data-countryCode="KI" value="+686">Kiribati (+686)</option>
															<option data-countryCode="KP" value="+850">Korea North (+850)</option>
															<option data-countryCode="KR" value="+82">Korea South (+82)</option>
															<option data-countryCode="KW" value="+965">Kuwait (+965)</option>
															<option data-countryCode="KG" value="+996">Kyrgyzstan (+996)</option>
															<option data-countryCode="LA" value="+856">Laos (+856)</option>
															<option data-countryCode="LV" value="+371">Latvia (+371)</option>
															<option data-countryCode="LB" value="+961">Lebanon (+961)</option>
															<option data-countryCode="LS" value="+266">Lesotho (+266)</option>
															<option data-countryCode="LR" value="+231">Liberia (+231)</option>
															<option data-countryCode="LY" value="+218">Libya (+218)</option>
															<option data-countryCode="LI" value="+417">Liechtenstein (+417)</option>
															<option data-countryCode="LT" value="+370">Lithuania (+370)</option>
															<option data-countryCode="LU" value="+352">Luxembourg (+352)</option>
															<option data-countryCode="MO" value="+853">Macao (+853)</option>
															<option data-countryCode="MK" value="+389">Macedonia (+389)</option>
															<option data-countryCode="MG" value="+261">Madagascar (+261)</option>
															<option data-countryCode="MW" value="+265">Malawi (+265)</option>
															<option data-countryCode="MY" value="+60">Malaysia (+60)</option>
															<option data-countryCode="MV" value="+960">Maldives (+960)</option>
															<option data-countryCode="ML" value="+223">Mali (+223)</option>
															<option data-countryCode="MT" value="+356">Malta (+356)</option>
															<option data-countryCode="MH" value="+692">Marshall Islands (+692)</option>
															<option data-countryCode="MQ" value="+596">Martinique (+596)</option>
															<option data-countryCode="MR" value="+222">Mauritania (+222)</option>
															<option data-countryCode="YT" value="+269">Mayotte (+269)</option>
															<option data-countryCode="MX" value="+52">Mexico (+52)</option>
															<option data-countryCode="FM" value="+691">Micronesia (+691)</option>
															<option data-countryCode="MD" value="+373">Moldova (+373)</option>
															<option data-countryCode="MC" value="+377">Monaco (+377)</option>
															<option data-countryCode="MN" value="+976">Mongolia (+976)</option>
															<option data-countryCode="MS" value="+1664">Montserrat (+1664)</option>
															<option data-countryCode="MA" value="+212">Morocco (+212)</option>
															<option data-countryCode="MZ" value="+258">Mozambique (+258)</option>
															<option data-countryCode="MN" value="+95">Myanmar (+95)</option>
															<option data-countryCode="NA" value="+264">Namibia (+264)</option>
															<option data-countryCode="NR" value="+674">Nauru (+674)</option>
															<option data-countryCode="NP" value="+977">Nepal (+977)</option>
															<option data-countryCode="NL" value="+31">Netherlands (+31)</option>
															<option data-countryCode="NC" value="+687">New Caledonia (+687)</option>
															<option data-countryCode="NZ" value="+64">New Zealand (+64)</option>
															<option data-countryCode="NI" value="+505">Nicaragua (+505)</option>
															<option data-countryCode="NE" value="+227">Niger (+227)</option>
															<option data-countryCode="NG" value="+234">Nigeria (+234)</option>
															<option data-countryCode="NU" value="+683">Niue (+683)</option>
															<option data-countryCode="NF" value="+672">Norfolk Islands (+672)</option>
															<option data-countryCode="NP" value="+670">Northern Marianas (+670)</option>
															<option data-countryCode="NO" value="+47">Norway (+47)</option>
															<option data-countryCode="OM" value="+968">Oman (+968)</option>
															<option data-countryCode="PW" value="+680">Palau (+680)</option>
															<option data-countryCode="PA" value="+507">Panama (+507)</option>
															<option data-countryCode="PG" value="+675">Papua New Guinea (+675)</option>
															<option data-countryCode="PY" value="+595">Paraguay (+595)</option>
															<option data-countryCode="PE" value="+51">Peru (+51)</option>
															<option data-countryCode="PH" value="+63">Philippines (+63)</option>
															<option data-countryCode="PL" value="+48">Poland (+48)</option>
															<option data-countryCode="PT" value="+351">Portugal (+351)</option>
															<option data-countryCode="PR" value="+1787">Puerto Rico (+1787)</option>
															<option data-countryCode="QA" value="+974">Qatar (+974)</option>
															<option data-countryCode="RE" value="+262">Reunion (+262)</option>
															<option data-countryCode="RO" value="+40">Romania (+40)</option>
															<option data-countryCode="RU" value="+7">Russia (+7)</option>
															<option data-countryCode="RW" value="+250">Rwanda (+250)</option>
															<option data-countryCode="SM" value="+378">San Marino (+378)</option>
															<option data-countryCode="ST" value="+239">Sao Tome &amp; Principe (+239)</option>
															<option data-countryCode="SA" value="+966">Saudi Arabia (+966)</option>
															<option data-countryCode="SN" value="+221">Senegal (+221)</option>
															<option data-countryCode="CS" value="+381">Serbia (+381)</option>
															<option data-countryCode="SC" value="+248">Seychelles (+248)</option>
															<option data-countryCode="SL" value="+232">Sierra Leone (+232)</option>
															<option data-countryCode="SG" value="+65">Singapore (+65)</option>
															<option data-countryCode="SK" value="+421">Slovak Republic (+421)</option>
															<option data-countryCode="SI" value="+386">Slovenia (+386)</option>
															<option data-countryCode="SB" value="+677">Solomon Islands (+677)</option>
															<option data-countryCode="SO" value="+252">Somalia (+252)</option>
															<option data-countryCode="ZA" value="+27">South Africa (+27)</option>
															<option data-countryCode="ES" value="+34">Spain (+34)</option>
															<option data-countryCode="LK" value="+94">Sri Lanka (+94)</option>
															<option data-countryCode="SH" value="+290">St. Helena (+290)</option>
															<option data-countryCode="KN" value="+1869">St. Kitts (+1869)</option>
															<option data-countryCode="SC" value="+1758">St. Lucia (+1758)</option>
															<option data-countryCode="SD" value="+249">Sudan (+249)</option>
															<option data-countryCode="SR" value="+597">Suriname (+597)</option>
															<option data-countryCode="SZ" value="+268">Swaziland (+268)</option>
															<option data-countryCode="SE" value="+46">Sweden (+46)</option>
															<option data-countryCode="CH" value="+41">Switzerland (+41)</option>
															<option data-countryCode="SI" value="+963">Syria (+963)</option>
															<option data-countryCode="TW" value="+886">Taiwan (+886)</option>
															<option data-countryCode="TJ" value="+7">Tajikstan (+7)</option>
															<option data-countryCode="TH" value="+66">Thailand (+66)</option>
															<option data-countryCode="TG" value="+228">Togo (+228)</option>
															<option data-countryCode="TO" value="+676">Tonga (+676)</option>
															<option data-countryCode="TT" value="+1868">Trinidad &amp; Tobago (+1868)</option>
															<option data-countryCode="TN" value="+216">Tunisia (+216)</option>
															<option data-countryCode="TR" value="+90">Turkey (+90)</option>
															<option data-countryCode="TM" value="+7">Turkmenistan (+7)</option>
															<option data-countryCode="TM" value="+993">Turkmenistan (+993)</option>
															<option data-countryCode="TC" value="+1649">Turks &amp; Caicos Islands (+1649)</option>
															<option data-countryCode="TV" value="+688">Tuvalu (+688)</option>
															<option data-countryCode="UG" value="+256">Uganda (+256)</option>
															<!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
															<option data-countryCode="UA" value="+380">Ukraine (+380)</option>
															<option data-countryCode="AE" value="+971">United Arab Emirates (+971)</option>
															<option data-countryCode="UY" value="+598">Uruguay (+598)</option>
															<!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
															<option data-countryCode="UZ" value="+7">Uzbekistan (+7)</option>
															<option data-countryCode="VU" value="+678">Vanuatu (+678)</option>
															<option data-countryCode="VA" value="+379">Vatican City (+379)</option>
															<option data-countryCode="VE" value="+58">Venezuela (+58)</option>
															<option data-countryCode="VN" value="+84">Vietnam (+84)</option>
															<option data-countryCode="VG" value="+84">Virgin Islands - British (+1284)</option>
															<option data-countryCode="VI" value="+84">Virgin Islands - US (+1340)</option>
															<option data-countryCode="WF" value="+681">Wallis &amp; Futuna (+681)</option>
															<option data-countryCode="YE" value="+969">Yemen (North)(+969)</option>
															<option data-countryCode="YE" value="+967">Yemen (South)(+967)</option>
															<option data-countryCode="ZM" value="+260">Zambia (+260)</option>
															<option data-countryCode="ZW" value="+263">Zimbabwe (+263)</option>
														</optgroup>
													</select>
												</div>
												<div class="col-sm-5 for_country_code1">
													<input type="text" data-validation="required number length" data-validation-length="10" maxlength="10" class="form-control" id="contact_no" name="contact_no" onkeypress="javascript:return isNumber(event)" value="<?php if(isset($_POST['contact_no']) && $_POST['contact_no'] !="") { echo $_POST['contact_no'];}?>">	
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Landline No.<b class="color"> *</b></label>
												<div class="col-sm-7" style="padding-right:0px;">
													<input type="text" class="form-control" id="contact_no1" name="contact_no1" value="<?php if(isset($_POST['contact_no1']) && $_POST['contact_no1'] !="") { echo $_POST['contact_no1'];}?>" >	
												</div>
											   
											</div>
											
											<div class="form-group">
												<label class="col-sm-4 control-label">Company Address<b class="color"> *</b></label>
												<div class="col-sm-7">
													<textarea class="form-control" data-validation="required" id="address" name="address" rows=3 placeholder="Company Address"><?php if(isset($_POST['address']) && $_POST['address'] !="") { echo $_POST['address'];}?></textarea>
												</div>
											</div>
											
											 <div class="form-group">
												<label class="col-sm-7 control-label">Site Address same as Company Address</label>
												<div class="col-sm-5">
													<input type="radio" class="" onclick="add_check()" id="add"  name="add_chk" value="yes"> Yes	
													<input type="radio" class="" onclick="add_check_n()" id="add"  name="add_chk" value="no"> No	
												</div>
											</div>
																																				
											<div class="form-group"> 
												<label class="col-sm-4 control-label">Site Address<b class="color"> *</b></label>
												<div class="col-sm-7">
													<textarea class="form-control" data-validation="required" id="site_address"  name="site_address" rows=3 placeholder="Site Address"><?php if(isset($_POST['site_address']) && $_POST['site_address'] !="") { echo $_POST['site_address'];}?></textarea>
												</div>
											</div>
											
											<!--<div class="form-group">
												<label class="col-sm-4 control-label">Lead Stage</label>
												<div class="col-sm-7">
													<select class="form-control" name="lead_stage" style="float:left;">
														<option value="">Please Select</option>
														<?php
															$sql = "SELECT * from  tbl_lead_stage";
															$result = $mysqli->query($sql);
															while($row = mysqli_fetch_array($result))
															{
														?>
																
														<option <?php if(isset($_POST['lead_stage']) and $_POST['lead_stage']== $row['stage_id']) echo "selected"?> value="<?php echo $row['stage_id'];?>"><?php echo $row['stage_name'];?></option>
														<?php 
															}	
														?>
													</select>
												</div>
											</div>-->
																						
										</div>
								   		<div class="form-group">
											<br>
											 <div class="col-sm-12">
													<center>
														<input type="submit" value="Submit" name="submit1" class="btn btn-info">
														<a href="welcome.php" class="btn btn-danger ">Cancel</a>
													</center>
											 </div>
										</div>
								   	<b class="color"><u style="color:#000;">Note</u> : Fields marked with * are Mandatory</b>
								   </form>
							   </div>
						   </div><!-- /.box-body -->					 
					 </div><!-- /.box -->
				</div>						   
            </div><!-- /.row -->
        </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?php
include_once('footer.php');
?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
	  $( function() {
		  var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
		$( "#lead_date" ).datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			startDate: today,
			autoclose: true
		});
		   $('#lead_date').datepicker('setDate', today);
	  } );
	$('#dob_img').click(function(){
      $('#lead_date').datepicker('show');
    });
	
	function tax_check()
	{
		var lead_company_name = $( "#lead_company_name" ).val();
		var check = $( "#check" ).val();
		if(check=='yes')
		{
			$("#site_name").val(lead_company_name);
		}		
	};
	function tax_check_n()
	{
		var check = $( "#check" ).val();
		var site_name = "";
		$("#site_name").val(site_name);
	};
	
	function add_check()
	{
		var address = $( "#address" ).val();
		var add = $( "#add" ).val();
		if(add=='yes')
		{
			$("#site_address").val(address);
		}		
	};
	function add_check_n()
	{
		var add = $( "#add" ).val();
		var site_address = "";
		$("#site_address").val(site_address);
	};
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate({

  });
</script> 