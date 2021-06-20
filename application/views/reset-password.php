<link rel="stylesheet" href="<?=base_url()?>assets/css/login.css">
	<div style="height:120px"></div>
	<div class="container">
		<div class="login-page-content">
			<div class="col-md-5">
				<div class="login card">  
					<?php if (@$invalid_link) { ?>
						<p style="color: red">This link seems to be expired or invalid.</p>
						<p>Please <a href="<?php echo base_url() ?>forgot-password">Click here</a> to generate a new password reset link.</p>
					<?php }elseif (@$password_change_success) { ?>
						<h3 style="color: green">Congratulations! Password reset successful.</h3>
						<p>Please <a href="<?php echo base_url() ?>login">Click here</a> to login with your new password!</p>
					<?php }elseif (@$password_change_failed) { ?>
						<h3 style="color: green">Sorry! Password reset was not successful.</h3>
						<p>Please <a href="<?php echo base_url() ?>login">Click here</a> to login.!</p>
					<?php } else{ ?>
						<?php if (isset($password) && @$password){?> 
						<?php 	echo '<p style="color:red">'.$password."</p>"?>
						<?php } else{?>
						
						<p class="text-center">Please enter a new password</p>
						
						<?php } ?>
						<hr>
						
						<div class="login-form-wrapper">
							<form method="post" accept-charset="utf-8" action="<?php echo base_url()."reset-password/".$pin ?>?email=<?php echo $email?>">
								<?php echo '<p style="color:red">'.form_error('email').'</p>' ?>
								<div class="item">
									<label for="password">New Password</label>
									<input type="password" name="password" required>
								</div>
								<div class="item">
									<label for="cpassword">Confirm password</label>
									<input type="password" name="cpassword" required>
								</div>
								<div class="item submit-button">
									<button class="btn purple-bkgd" type="submit">Continue</button>
								</div>
							<?php echo form_close(); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>