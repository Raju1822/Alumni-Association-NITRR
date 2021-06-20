<link rel="stylesheet" href="<?=base_url()?>assets/css/login.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<div style="height:120px"></div>
	<section class="container login-page-wrapper">

		<div class="login-page-content">
			
			<p class="login-page-title text-center">Update Password</p>	
			<div class="col-md-5">
				<div class="login card">  
				   <?php if($this->session->flashdata('message')){?>
                    <div style="color:red" class="alert alert-failure">      
                     <?php echo $this->session->flashdata('message')?>
                    </div>
                   <?php } ?>

				   <script>
                          $(document).ready(function(){
                                $('[data-toggle="popover"]').popover();   
                         });
                  </script>
                  <style>
					   .popover{
                         color:purple;
                         text-align:center;
                       }
				 </style>
	
			    <div style="color:red">	<?php echo validation_errors(); ?> </div>
					<?php  echo form_open('updatepassword/validation_password'); ?>
					  <div class="login-form-wrapper">
							<div class="item">
								<label for="password">Old Password</label>
								<input type="password" name="old_password" class="form-control" required data-toggle="popover" data-trigger="focus hover" data-placement="top" data-content="This Field Contain Your Current Password Fill It carefully" >
							</div>
							
							<div class="item">
								<label for="password">New Password</label>
								<input type="password" name="new_password" class="form-control" required data-toggle="popover"  data-trigger="focus hover" data-placement="top" data-content="Type new password.The minimum lenght should be 8 character. for strong password you can use Alphabate , characters '! @ # $ % ^ & *' and Numeric values">
							</div>

                            <div class="item">
								<label for="password">Confirm New Password</label>
								<input type="password" name="confirm_new_password" class="form-control" required data-toggle="popover" data-trigger="focus hover" data-placement="top" data-content="Type confirm new password it should be simillar to new password ">
							</div>

							<div class="item submit-button">
								<button class="btn purple-bkgd" type="submit">Continue</button>
							</div>
					  </div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
		
	</section>