<link rel="stylesheet" href="<?=base_url()?>assets/css/login.css">
	<div style="height:120px"></div>
	<div class="container">
		<div class="login-page-content">
			<div class="col-md-5">
				<div class="login card">  
					
					<?php if (isset($reset_error) && @$reset_error){?> 
					<?php 	echo '<p style="color:red">'.$reset_error."</p>"?>
					<?php } else{?>
					
					<p class="text-center">Enter your registered email address to reset your password</p>
					
					<?php } ?>
					<hr>
					
					<div class="login-form-wrapper">
						<?php echo form_open('check-forgot-password'); ?>
							<?php echo '<p style="color:red">'.form_error('email').'</p>' ?>
							<div class="item">
								<label for="email">Email ID</label>
								<input type="email" name="email" required>
							</div>
							<div class="item submit-button">
								<button class="btn purple-bkgd" type="submit">Continue</button>
							</div>
						<?php echo form_close(); ?>
					</div>

					<div class="new-user">
						<p>New User? <a href="<?=base_url()?>register">Create Account</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>