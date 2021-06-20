	<link rel="stylesheet" href="<?=base_url()?>assets/css/register.css">

	<div style="height:120px"></div>
	<section class="container register-page-wrapper">

		<div class="register-content">
			<h2 class="text-center">Register Now</h2>
			<p class="text-center">Your friends are already here!</p>

			<p class="text-center greet-text"><span>Hi!</span><br> Tell us a bit more about yourself. This information will help us to serve you better. </p>
			
			<div class="row">
				<div class="col-md-1"></div>
				<div class="registration-form col-md-10">
					<?php echo form_open('register/registerValidation') ?>
						<?php echo validation_errors(); ?>
						<div class="item col-sm-12 user-type-wrapper">
							<label for="user-type">Are you a Student or Alumni?</label>
							  <input type="radio" name="user-type" value="8" checked> Student
							  <input type="radio" name="user-type" value="2">Alumni
							  <br><p style="color:red"><?php echo date("Y"); ?> batch students are requested to register as Alumni.</p>
						</div>
						<div class="item col-sm-6">
							<label for="first-name">First Name</label>
							<input type="text" name="first-name" required value="<?php echo set_value('first-name') ?>">
							<input type="hidden" value="<?=base_url()?>" id="base-url">
						</div>

						<div class="item col-sm-6">
							<label for="last-name">Last Name</label>		
							<input type="text" name="last-name" required value="<?php echo set_value('last-name') ?>">
						</div>

						<div class="item col-sm-12">
							<label for="email">Email ID</label>		
							<input type="email" name="email" required placeholder="Please enter your personal email-id" value="<?php echo set_value('email') ?>">
						</div>

						<div class="item col-sm-6">
							<label for="mobile-no">MOBILE NO</label>		
							<input type="tel" name="mobile-no" required value="<?php echo set_value('mobile-no') ?>">
						</div>

						<div class="item col-sm-6">
							<label for="city">CITY</label>		
							<input type="text" name="city" required value="<?php echo set_value('city') ?>">
						</div>

						<div class="item col-sm-6">
							<label for="country">COUNTRY</label>		
							<input type="text" name="country" required value="<?php echo set_value('country') ?>">
						</div>

						<div class="item col-sm-6">
							<label for="passing-year">PASSING YEAR</label>		
							<select name="passing-year">
								<script>
								  var myDate = new Date();
								  var year = myDate.getFullYear();
								  for(var i = 1956; i < year+5; i++){
									  document.write('<option value="'+i+'">'+i+'</option>');
								  }
							    </script>
							</select>
						</div>

						<div class="item col-sm-6">
							<label for="degree-type">DEGREE TYPE</label>		
							<select name="degree-type" id="degree-type">
								<option value="">Select</option>
								<option value="ug">UG</option>
								<option value="pg">PG</option>
								<option value="phd">PHD</option>
							</select>
						</div>
						
						<div class="item col-sm-6">
							<label for="degree">DEGREE</label>		
							<select name="degree" id="degree">
								<option value="">Select</option>
							
							</select>
						</div>

						<div class="item col-sm-12">
							<label for="branch">branch</label>		
							<select name="branch" id="branch">
								<option value="">Select</option>
								
							</select>
						</div>

						<div class="item col-sm-12">
							<label for="company">Profession / Placement Status (With Designation)</label>		
							<input type="text" name="company" placeholder="Name of Organization, Designation / Unplaced" required value="<?php echo set_value('company') ?>">
						</div>

						<div class="item col-sm-6">
							<label for="password">Enter a password</label>		
							<input type="password" name="password" required>
						</div>

						<div class="item col-sm-6">
							<label for="repeat-password">Repeat password</label>		
							<input type="password" name="rpassword" required>
						</div>
						<div class="item terms-of-condition col-sm-12 text-center">
							<div class="g-recaptcha" data-sitekey="6LeHbRwTAAAAADj6636k44U0ffrNZXlZrSeJ4DFo"></div>
						</div>

						<div class="item terms-of-condition col-sm-12 text-center">
							<input type="checkbox" name="terms-and-condition" value="1"> I agree to <a href="#">Terms and Conditions</a>
						</div>
						
						<div class="item submit-button col-sm-12 text-center">
							<button class="btn purple-bkgd" type="submit">Sign Up</button>
						</div>
					<?php echo form_close() ?>
				</div>
				<div class="col-md-1"></div>
			</div>

		</div>
	</section>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
