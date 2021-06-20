	<link rel="stylesheet" href="<?=base_url()?>assets/css/login.css">

	<div style="height:120px"></div>
	<section class="container login-page-wrapper">

		<div class="login-page-content">
			<?php 
				$number = $this->db->query("SELECT * from `user_main`")->num_rows(); 
			?>
			<p class="login-page-title text-center">Connect with <?php echo $number ?>+ Alumni worldwide!</p>
			<div class="col-md-5">
				<div class="login card">  
					
					<?php if (isset($login_error) && @$login_error){?> 
					<?php 	echo '<p style="color:red">'.$login_error."</p>"?>
					<?php } else{?>
					
							<p>Login with your email address</p>
					
					<?php } ?>
					<hr>
					<div class="login-form-wrapper">
						<?php echo form_open('Login/validate_credentials'); ?>
							<?php echo '<p style="color:red">'.form_error('email').'</p>' ?>
							<div class="item">
								<label for="email">Email ID</label>
								<!-- <input type="text" name="email" > -->
								<input type="email" name="email" required>
							</div>
							
							<div class="item">
								<label for="password">Password</label>
								<input type="password" name="password" required>
								
							</div>
							<div class="item submit-button">
								<button class="btn purple-bkgd" type="submit">Sign In</button>
							</div>

						<?php echo form_close(); ?>
					</div>
					<div class="new-user">
						<p>New User? <a href="<?=base_url()?>register">Create Account</a></p>
						<a href="<?php echo base_url() ?>forgot-password">Forgot Password?</a>
					</div>
				</div>
			</div>
		</div>
		
	</section>

	