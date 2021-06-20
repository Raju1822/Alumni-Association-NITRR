<link rel="stylesheet" href="<?=base_url()?>assets/css/login.css">
	<div style="height:120px"></div>
	<div class="container">
		
		<hr>
		<?php 
			if ($email) {
		?>
			<h3>Don't Worry!</h3>
			<p>Please check your email. A password reset link was sent to <b><?php echo $email; ?></b>. Please follow the instructions in the email to reset your password!</p>
		<?php		
			}else{
		?>	
			<h3>Error!</h3>
			<p>An error occured. Please try again later.</p>
		<?php
			}
		?>
		
	</div>