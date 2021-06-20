<link rel="stylesheet" href="<?= base_url()?>assets/css/user-profile-main.css">

<div style="height:110px"></div>
<div class="body-wrapper container">
	<section class="userprofile-wrapper col-md-8">
		<?php 

			$dob = @$personal_details[0]->dob;
			$address = @$personal_details[0]->address;
		 	$city = @$personal_details[0]->city;
		 	$country = @$personal_details[0]->country;
		 	$gender = @$personal_details[0]->gender;
		 	$about_me = @$personal_details[0]->about_me;
		 	$ph_number_1 = @$personal_details[0]->ph_number_1;
		 	$ph_number_2 = @$personal_details[0]->ph_number_2;
		 	$marital_status_id = @$personal_details[0]->marital_status_id;
		 	$notes = @$personal_details[0]->notes;
		 	$state = @$personal_details[0]->state;

		 	$edu_institute = @$education[0]->institute;
		 	$edu_course = @$education[0]->course;
		 	$edu_feild_of_study = @$education[0]->major_field_of_study;
		 	$edu_from = @$education[0]->from;
		 	$edu_to = @$education[0]->to;


		 	$job_designation = @$jobs[0]->designation;
		 	$job_company = @$jobs[0]->company;
			$job_from = @$jobs[0]->from;
			$job_description = @$jobs[0]->description;
			$job_to = @$jobs[0]->to;

		 	$add_skill = null;

		 	$project_name = @$projects[0]->project_name;
		 	$project_from = @$projects[0]->from;
		 	$project_to = @$projects[0]->to;
		 	$project_details = @$projects[0]->project_details;
		 	$skills_used = @$projects[0]->skills_used;

		?>
            <!-- showing message when password is updated and you can close it-->
		       <?php if($this->session->flashdata('message')){?>
				  <div style="text-align:center; " class="alert alert-success alert-dismissible " role="alert">
			          <button type="button" class="close green-bkgd btn" data-dismiss="alert" aria-label="Close">
					  Congratulations! Your Password Is Updated Successfully
			           <span aria-hidden="true">&times;</span>
			          </button> 
			     </div>
				<?php } ?>

		<div class="row details-overview card">
			<div class="image col-xs-4"><img src="<?=base_url()?>profile_pictures/<?php echo $profile_picture; ?>" class="img-responsive img-circle" alt=""></div>			
			<div class="main-details col-xs-8">
				<h2 class="name"><?php echo @$personal_details[0]->name?></h2>
				<!-- date of birth starts -->
				<?php if($dob){ ?>

					<!-- calculates the age -->
					<?php 
						$date = new DateTime($dob);
						$now = new DateTime();
						$interval = $now->diff($date);
						$age = $interval->y;
					?>
					<p class="age"><?php echo $age ?> Years Old</p>
				<?php } ?>
				<!-- date of birth ends -->
				<p class="current-work">
					<!-- current work starts -->
					<?php if($jobs){ ?>
						<p class="current-work"><?php echo $job_designation ." at ".$job_company ?></p>
					<?php } ?>
					<!-- current work ends -->
				</p>
				<?php if($address){?>
					<p class="current-city"><?php $address?></p>
				<?php }else{ ?>
					<p class="current-city"><?php echo $city.", ".$country ?></p>
				<?php } ?><div class="button-wrapper">
					<!-- <button class="btn purple-bkgd"><i class="fa fa-envelope"></i>Send a Message</button> -->
					<a href="<?= base_url()?>userProfile/edit"><button class="btn purple-bkgd"><i class="fa fa-pencil-square-o"></i>Edit Profile</button></a>	
				</div>
			</div> 
		</div>

		<div class="row education card user-detail">
			<h2><i class="fa fa-graduation-cap"></i> Education</h2>
			<hr>
			<?php foreach ($education as $edu) {
			?>
				<div class="education-block row">
					<div class="col-xs-10 edu-detail">
						<h3><?php echo $edu->institute ?></h3>
						<p><?php echo $edu->course ?>, <?php echo $edu->major_field_of_study ?></p>
						<?php if ($edu->to == "0000-00-00") {
							echo "<p>Currently Studying</p>";
						}else{ ?>
						<p><?php echo date("Y",strtotime($edu->from)); ?> to <?php echo date("Y",strtotime($edu->to)); ?></p>
						<?php } ?>
					</div>
				</div>
			<?php
			} ?>
		</div>
		
		<div class="row work card user-detail">
			<h2><i class="fa fa-briefcase"></i> Work</h2>
			<hr>

			<?php foreach ($jobs as $job) {
			?>
				<div class="work-block row">
					<div class="col-xs-10 work-detail">
						<h3><?php echo $job->company ?></h3>
						<p><?php echo $job->designation ?></p>
						<?php if ($job->to == "0000-00-00") {
							echo "<p>Currently Working</p>";
						}else{ ?>
						<p><?php echo date("M Y",strtotime($job->from)); ?> to <?php echo date("M Y",strtotime($job->to)); ?></p>
						
						<?php } 
							if($job->description) {?><p><?php echo $job->description ?></p><?php } ?>
					</div>
				</div>
			<?php
			} ?>
		</div>

		<div class="row skills card user-detail">
			<h2><i class="fa fa-compass"></i> Skills and Endorsements</h2>
			<hr>
			
			<div class="user-skill-wrapper">
				<?php foreach ($skills as $skill) {
				?>
					<div class="user-skill"><?php echo $skill->skill ?></div>
				<?php } ?>
			</div>
		</div>
		
		<div class="row projects card user-detail">
			<h2><i class="fa fa-file-text-o"></i> Projects</h2>
			<hr>

			<div class="projects-wrapper">
				<?php foreach ($projects as $project) {?>
				<div class="project">
					<h3><?php echo $project->project_name ?></h3>
					<p class="duration"><?php echo date("M Y",strtotime($project->from)); ?> to 
					<?php if ($project->to == "0000-00-00") {
						echo "present";
					}else{
						echo date("M Y",strtotime($project->to));
					}?></p>
					<?php if($project->project_details) {?><p class="details"><?php echo $project->project_details ?></p><?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<section class="col-md-4"> 
		<?php include 'includes/sidebar.php'; ?>
	</section>
</div>
