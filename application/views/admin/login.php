	<link rel="stylesheet" href="<?=base_url()?>assets/css/login.css">

	<div style="height:120px"></div>
	<section class="container login-page-wrapper">

		<div class="login-page-content">
			<p class="login-page-title text-center">Please login to contiue</p>
			<div class="col-md-5">
				<div class="login card">  
					
					<?php 
						if (isset($login_error) && @$login_error){
							echo '<p style="color:red">'.$login_error."</p>";
						} else{
							echo '<p>Login with your email address</p>';
						 } 
					?>
					<hr>
					<div class="login-form-wrapper">
						<?php echo form_open('Admin/validateCredentials'); ?>
							<?php echo '<p style="color:red">'.form_error('email').'</p>' ?>
							<div class="item">
								<label for="email">Email ID</label>
								<input type="email" name="email">
							</div>
							
							<div class="item">
								<label for="password">Password</label>
								<input type="password" name="password">
								
							</div>
							<div class="item submit-button">
								<button class="btn purple-bkgd" type="submit">Sign In</button>
							</div>

						<?php echo form_close(); ?>
					</div>
				</div>
			</div>

			<!-- <div class="col-md-7">
				<div class="signup card">
					<p>Login faster with Facebook/LinkedIn </p>
					<hr>
					<a href="#">
						<div class="col-sm-6">
							<div class="facebook text-center login-button">
								<i class="fa fa-facebook"></i>Sign In with Facebook
							</div>
						</div>
					</a>

					<a href="#">
						<div class="col-sm-6">
							<div class="linkedin text-center login-button">
								<i class="fa fa-linkedin"></i>Sign In with LinkedIn
							</div>
						</div>
					</a>

					<hr class="small-hr">
					
					<p class="text-center login-message">Don't worry we will never post to your wall without your permission.</p>

				</div>
			</div>
		</div> -->
		
	</section>

	