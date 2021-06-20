<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/img/favicon.png" />
  	<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.css">
  	<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.toast.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	
	<title>GEC-NIT Raipur Alumni Association</title>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=base_url()?>">
				<img src="<?=base_url()?>assets/img/logo.png" alt="gec-nit raipur alumni association logo">
				<p>Alumni Association <br/>	GEC - NIT Raipur</p>
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<div class="upper-row">
				
				<div class="login-wrapper col-md-3">
				<?php 
					if ($this->session->userdata('logged_in') || $this->session->userdata('logged_in_admin') ) {
				?>
					<div class="btn-group pull-right">
					  <button type="button" class="btn purple-bkgd"><?php echo $this->session->userdata('full_user_name') ?></button>
					  <button type="button" class="btn purple-bkgd dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span class="caret"></span>
					    <span class="sr-only">Open Profile Options</span>
					  </button>
					  <ul class="dropdown-menu">
					  	<?php if ($this->session->userdata('logged_in_admin')) { ?>
							<li><a href="<?php echo base_url();?>admin" ><i class="fa fa-dashboard"></i> Admin Panel</a></li>
					  	<?php
					  	} ?>
						<li><a href="<?php echo base_url();?>userProfile" ><i class="fa fa-user"></i> My Profile</a></li>
						<li><a href="<?php echo base_url();?>userProfile/edit" ><i class="fa fa-pencil"></i> Edit Profile</a></li>
						<li><a href="<?php echo base_url();?>updatepassword" ><i class="fa fa-key"></i> Change Password</a></li>
					    <li role="separator" class="divider"></li>
					    <li><a href="<?php echo base_url();?>login/logout"><i class="fa fa-lock"></i> Logout</a></li>
					    
					  </ul>
					</div>

				<?php
					}else{
				 ?>
					<a href="<?php echo base_url();?>login" class="btn purple-bkgd"><i class="fa fa-user"></i>Login</a>
					<a href="<?php echo base_url();?>register" class="btn purple-bkgd"><i class="fa fa-user-plus"></i>Register Online</a>
				<?php 
					}
				 ?>
				</div>

				<div class="search-form-wrapper col-md-6">
					<a href="<?= base_url()?>advanced-search">Advanced</a>

					<form class="navbar-form" method="post" action="<?php echo base_url();?>AdvancedSearch/search" role="search">
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Search for people..">
						</div>
						<button type="submit" class="btn purple-bkgd"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo base_url();?>">Home</a></li>
				<li><a href="<?php echo base_url();?>aboutUs">About Us</a></li>
				<li><a href="<?php echo base_url();?>chapters">Chapters</a></li>
				<li><a href="<?php echo base_url();?>StudentForum">Student Forum</a></li>
				<li><a href="<?php echo base_url();?>discussions">Discussion</a></li>
				<li><a href="<?php echo base_url();?>news">Latest News</a></li>
				<li><a href="<?php echo base_url();?>events">Events</a></li>
				<li><a href="<?php echo base_url();?>GivingBack">Giving Back</a></li>
				<!-- <li><a href="<?php echo base_url();?>gallery">Gallery</a></li> -->
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=941923539164317";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				
			</ul>
			
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

	