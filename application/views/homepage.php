
	<link rel="stylesheet" href="<?=base_url()?>assets/css/homepage.css">
  	<link rel="stylesheet" href="<?=base_url()?>assets/css/owl.carousel.css">
	
	<div style="height:110px"></div> <!-- offset -->
	<!-- fullwidth banner  -->
	<div class="body-wrapper container row">
	<!-- <marquee style="color:red">Alumni Association of GEC NIT Raipur invites all alumni for <a href="<?php echo base_url(); ?>Global_Alumni_Meet_PD-F-1.PDF">Global Alumni Meet, 2017 on 24th Dec, 2017.</a></marquee> -->
	<marquee style="color:red">Welcome to Alumni Association of GEC NIT Raipur official website.</a></marquee>
	<!-- <marquee style="color:red">Alumni Association of GECNIT Raipur is pleased to invite for Annual Alumni Day 2018 and AGM on 23rd December 2018 at NIT Raipur campus. <a target="_blank" href="<?php echo base_url(); ?>assets/files/AGM.pdf">For details please click here</a> and to register for <a target="_blank" href="<?php echo base_url(); ?>GivingBack/donate?alumni-meet=true">Annual Alumni Day 2018 please click here</a></marquee> -->
	<section class="col-md-8">
    	<div class="col-md-12">
		    <div class="fullwidth-banner-wrapper">
		      <div class="image-slider">
				<div id="banner-slider" class="owl-carousel image-slider">

				  <div class="item"><img src="<?= base_url()?>assets/img/bg2.jpg"></div>
				  <div class="item"><img src="<?= base_url()?>assets/img/bg1.jpg"></div>
				</div>
			  </div>
		    </div>
		</div>

		<div class="row main-buttons text-center">
			<a href="<?php echo base_url() ?>student-educational-fund" class="btn btn-large purple-bkgd pull-left">STUDENT EDUCATIONAL ASSISTANCE FUND</a>
			<a style="padding: 12px 45px;" href="<?php echo base_url() ?>golden-tower" class="btn btn-large purple-bkgd pull-right">GEC NIT GOLDEN TOWER FUND</a>
			<br><br><br>
		</div>

    <!-- /.fullwidthbanner -->

	<!-- about us -->
		
		<div class="col-md-12 about-us">
			<h2 class="text-center">Alumni Association GEC-NIT Raipur</h2>
			<h3 class="justified">Vision Document</h3>
			<p>To make efforts for:</p>
			<ul style="padding:5px 20px" class="justify">
				<li>Consolidation of alumni base</li>
				<li>Establishing continuous and effective communication among the alumni community</li>
				<li>Preparing and kick starting the long term programs for growth and welfare of Institute, Students and The Alumni.</li>
			</ul>
			<p>To achieve this vision the working plan has the following elements:</p>
			<ol style="padding:5px 20px" class="justify">
				<li>Recognition and active involvement of various local chapters.</li>
				<li>To have close interactions with alumni to devise and implement programs to improve employability of the students. Also to mentor students for entrepreneurship.</li>
				<li>Continuation of lectures from eminent speakers under “Manthan”.</li>
				<li>Celebrate Annual Alumni Day along with Silver Jubilee Reunion and Golden Jubilee Reunion of the respective batches.</li>
				<li>Coordinate with Alumni who are holding key positions for sponsorship of various state-of-art laboratory and research facility.</li>
			</ol>
		</div>

		<!--./ about us -->
	</section>

	<section class="col-md-4">
		<!-- <a href="<?php echo base_url(); ?>election-notification-2019-21.pdf" target="_blank">
			<div class="col-md-12 sidebar-minutes">
				<div class="Yslider-header"><p class="text-center"><b>Executive Committee Election Notification for 2019-21</b></p></div>
			</div>
		</a> -->
		<a href="<?php echo base_url(); ?>golden-tower-booking" target="_blank">
			<div class="col-md-12 sidebar-minutes">
				<div class="Yslider-header"><p class="text-center"><b>Golden Tower Guest House Booking</b></p></div>
			</div>
		</a>
		<!-- <a href="<?php echo base_url(); ?>GivingBack/donate?helping-hands=true" target="_blank">
			<div class="col-md-12 sidebar-minutes">
				<div class="Yslider-header"><p class="text-center"><b>Helping Hands Fund (Mohar Singh 1992/Electrical Engineering)</b></p></div>
			</div>
		</a>


		<a href="<?php echo base_url(); ?>GivingBack/donate?alumni-meet=true">
			<div class="col-md-12 sidebar-minutes">
				<div class="Yslider-header"><p class="text-center"><b>Global Alumni Meet 2017 Registration</b></p></div>
			</div>
		</a> -->
		<a href="<?php echo base_url(); ?>activity-report">
			<div class="col-md-12 sidebar-minutes">
				<div class="Yslider-header"><p class="text-center"><b>Alumni Association Activity Report</b></p></div>
			</div>
		</a>

		
		<div class="col-md-12 sidebar-news">
					<div class="Yslider-header"><h2><i class="fa fa-birthday-cake"></i>Today's Birthdays</h2></div>
					<div id="news" class="Yslider">
						<div class="viewport col-xs-12">
							<ul class="overview">
							<?php
							foreach ($birthdays as $birthday)
							{
								if ($birthday['degree_ug']) {
									$branch = $birthday['branch_ug'];
									$batch = $birthday['ug_passing_year'];
								}else{
									$branch = $birthday['branch_pg'];
									$batch = $birthday['pg_passing_year'];
								}

								echo '<li>
									<div class="Yslider-element">
										<div class="date-block col-xs-2">
											<i style="margin-top:30px" class="fa fa-birthday-cake"></i>
										</div>
										<div class="details col-xs-10">
											<h3 style="margin:10px 0 5px 0"><a target="_blank" href="'.base_url().'viewprofile/user/'.$birthday['user_id'].'">'.$birthday['name'].'</a></h3>
											<p style="margin:5px 0 5px 0">'.$batch.' Batch</p>
											<p style="margin:5px 0 5px 0">'.$branch.'</p>
											<p style="margin:5px 0 5px 0">'.$birthday['city'].', '.$birthday['state'].'</p>
										</div>
									</div>
								</li>
								</li>';
							}
							?>
							</ul>
						</div>
						
					</div>
				</div>
		<?php require_once("includes/sidebar.php"); ?>
	</section>
	</div>

