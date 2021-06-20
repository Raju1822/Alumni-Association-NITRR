<link rel="stylesheet" href="<?= base_url()?>assets/css/edit-user-profile.css">

<div style="height:110px"></div>
<div class="body-wrapper container">
	<section class="userprofile-wrapper col-md-8">
		<div class="row details-overview card">
			<div class="image col-xs-4">
			
				<img src="<?=base_url()?>profile_pictures/<?php echo $profile_picture; ?>" class="img-responsive img-circle" alt="">
				<p class="upload-profile-pic">
					<a href id="upload-profile"><i class="fa fa-cloud-upload"></i> Upload Profile Picture</a>
				</p>
				<?php echo  form_open_multipart('userProfile/uploadProfilePicture', array('id'=>'upload-image-form'))?>
				<input id="upload" type="file" name="file_name" style="display: none;" />
				<?php echo form_close();?>
				<?php echo @$errors['image_errors']; ?>
			
			</div>
			<div class="main-details col-xs-8">
				<?php 
					$name = @$personal_details[0]->name;
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
				 	$add_skill = null;

				 ?>
				<h2 class="name"><?php echo $name; ?></h2>
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
						<p class="current-work"><?php echo @$jobs[0]->designation ." at ".@$jobs[0]->company ?></p>
					<?php } ?>
					<!-- current work ends -->
				</p>
				<?php if($address){?>
					<p class="current-city"><?php $address?></p>
				<?php }else{ ?>
					<p class="current-city"><?php echo $city.", ".$country ?></p>
				<?php } ?>
				
				<a href="<?= base_url()?>UserProfile">Back to Profile</a>	

				
			</div> 
		</div>

		<div class="row general-details card user-detail">
			<h2><i class="fa fa-user"></i> General Details</i></h2>
			<hr>
			<?php echo form_open('UserProfile/personalDetailsValdation'); ?>
			<?php echo @$errors['personal_detail_errors'] ?>
			<div class="general-details-block row">
				<div class="col-sm-12 item">
					<div class="label-wrapper"><label for="name">Name</label></div>
					<p><?php echo $name ?></p>
					<input type="hidden" id="user-id" value="<?php echo $user_id ?>">
				</div>

				<div class="col-sm-12 item select-block">
					<div class="label-wrapper"><label for="gender">Gender</label></div>
					<div class="radio-options">
						<div class="radio-wrapper">
							<input type="radio" name="gender" <?php if($gender==="M"){ echo "checked";} ?> value="M">Male
						</div>
						<div class="radio-wrapper">
							<input type="radio" name="gender" <?php if($gender==="F"){ echo "checked";} ?> value="F">Female
						</div>
					</div>
				</div>

				<div class="col-sm-12 item select-dob">
					<div class="label-wrapper"><label for="dob">Date of Birth</label></div>
					<input type="date" name="dob" value="<?php echo date("Y-m-d",strtotime($dob)) ?>">
				</div>
				
				<div class="col-sm-12 item">
					<div class="label-wrapper"><label for="about-me">About me</label></div>
					<textarea name="about-me" required><?php echo $about_me; ?></textarea>
				</div>

				<div class="col-sm-12 item">
					<div class="label-wrapper"><label for="address">Address</label></div>
					<textarea name="address" required><?php echo $address; ?></textarea>
				</div>
				
				<div class="col-sm-12 item">
					<div class="label-wrapper"><label for="city">City</label></div>
					<input type="text" name="city" required value="<?php echo $city ?>">
				</div>

				<div class="col-sm-12 item">
					<div class="label-wrapper"><label for="city">State</label></div>
					<input type="text" name="state" required value="<?php echo $state ?>">
				</div>

				<div class="col-sm-12 item">
					<div class="label-wrapper"><label for="country">Country</label></div>
					<input type="text" name="country" required value="<?php echo $country ?>">
				</div>

				<div class="col-sm-12 item">
					<div class="label-wrapper"><label for="ph-no-1">Phone No 1</label></div>
					<input type="text" name="ph-no-1" required value="<?php echo $ph_number_1 ?>">
				</div>

				<div class="col-sm-12 item">
					<div class="label-wrapper"><label for="ph-no-2">Phone No 2</label></div>
					<input type="text" name="ph-no-2" required value="<?php echo $ph_number_2 ?>">
				</div>

				<div class="col-sm-12 item select-block">
					<div class="label-wrapper"><label for="marital-status">Marital Status</label></div>
					<div class="radio-options">
						<div class="radio-wrapper">
							<input type="radio" name="marital-status" <?php if($marital_status_id==="1"){echo "checked";} ?> value="1">Married
						</div>
						<div class="radio-wrapper">
							<input type="radio" name="marital-status" <?php if($marital_status_id==="2"){echo "checked";} ?> value="2">Single
						</div>
					</div>
				</div>

				<div class="col-sm-12 item">
					<div class="label-wrapper"><label for="notes">Notes</label></div>
					<textarea name="notes" required><?php echo $notes ?></textarea>
				</div>

				<div class="button-wrapper">
					<a href="<?= base_url()?>/userProfile">Cancel</a>
					<button class="btn purple-bkgd" type="submit">Save</button>
				</div>
				
			</div>
			<?php echo form_close() ?>

			
		</div>

		<div class="row education card user-detail">
			<h2><i class="fa fa-graduation-cap"></i> Education </i></h2>
			<hr>
			<?php echo form_open('userProfile/educationValidation'); ?>
			<?php echo @$errors['education_errors'] ?>
			<?php $edu_count = 0 ?>
			<div class="education-block row" id="education-block">
			<?php foreach ($educations as $education) {
					$edu_institute = @$education->institute;
				 	$edu_course = @$education->course;
				 	$edu_feild_of_study = @$education->major_field_of_study;
				 	$edu_from = @$education->from;
				 	$edu_to = @$education->to;
				 	$edu_count++;
			?>

				<div class="col-xs-12 edu-detail" id="edu-detail-<?php echo "$edu_count"?>">
					<a href="#!" id="delete-button" onclick="deleteElement('edu-detail-<?php echo "$edu_count"?>')" class="delete-button"><i class="fa fa-trash"></i> Delete</a>
					<div class="col-sm-12 item">
						<div class="label-wrapper"><label for="institute">Institute</label></div>
						<input type="text" name="institute[]" required value="<?php echo $edu_institute ?>">
					</div>
					<div class="col-sm-12 item">
						<div class="label-wrapper"><label for="course">Course</label></div>
						<input type="text" name="course[]" required value="<?php echo $edu_course ?>">
					</div>
					<div class="col-sm-12 item">
						<div class="label-wrapper"><label for="feild_of_study">Major Field of Study</label></div>
						<input type="text" name="feild_of_study[]" required value="<?php echo $edu_feild_of_study ?>">
					</div>
					<div class="col-sm-12 item select-edu-from">
						<div class="label-wrapper"><label for="edu_from">From</label></div>
						<input type="date" name="edu-date-from[]" value="<?php echo date("Y-m-d",strtotime($edu_from)); ?>">
					</div>
					<div class="col-sm-12 item select-edu-to">
						<div class="label-wrapper"><label for="edu_to">To</label></div>
						<input type="date" name="edu-date-to[]" value="<?php echo date("Y-m-d",strtotime($edu_to)); ?>" <?php if (!$edu_to) echo "disabled"; ?>>
						<div class="checkbox-wrapper">
                          <input type="checkbox" class="to-date-check" name="current-education[]" <?php if (!$edu_to) echo "checked"; ?>>
                          <span>Currently studying here</span>
                        </div>
					</div>
				</div>

			<?php } // for each closes?>
				
			</div>
			<div class="add-another">
				<a href="#!" id="add-button" onclick="addEducation()"><i class="fa fa-plus"></i> Add Education</a>
				<input type="hidden" id="edu_count" value="<?php echo $edu_count+1 ?>">
			</div>
			<div class="button-wrapper">
				<a href="<?= base_url()?>/userProfile">Cancel</a>
				<button class="btn purple-bkgd" type="submit">Save</button>
			</div>
			<?php echo form_close() ?>

		</div>
		
		<div class="row work card user-detail">
			<h2><i class="fa fa-briefcase"></i> Work </i></h2>
			<hr>
			
			<?php echo form_open('userProfile/jobValidation'); ?>
			<?php echo @$errors['job_errors'] ?>
			<?php $job_count = 0 ?>
			<div class="work-block row" id="work-block">
			<?php foreach ($jobs as $job) {
					$job_designation = @$job->designation;
				 	$job_company = @$job->company;
					$job_from = @$job->from;
					$job_description = @$job->description;
					$job_to = @$job->to;
					$job_count++;
			?>
			
				<div class="col-xs-12 work-detail" id="work-detail-<?php echo $job_count; ?>">
					<a href="#!" id="delete-button" onclick="deleteElement('work-detail-<?php echo $job_count; ?>')" class="delete-button"><i class="fa fa-trash"></i> Delete</a>

					<div class="col-sm-12 item">
						<div class="label-wrapper"><label for="company">Company</label></div>
						<input type="text" name="company[]" required value="<?php echo $job_company ?>">
					</div>
					<div class="col-sm-12 item">
						<div class="label-wrapper"><label for="designation">Designation</label></div>
						<input type="text" name="designation[]" required value="<?php echo $job_designation ?>">
					</div>

					<div class="col-sm-12 item">
						<div class="label-wrapper"><label for="description">Description</label></div>
						<textarea name="job-description[]"><?php echo $job_description; ?></textarea>
					</div>

					<div class="col-sm-12 item select-job-from">
						<div class="label-wrapper"><label for="job_from">From</label></div>
						<input type="date" name="job-date-from[]" value="<?php echo date("Y-m-d",strtotime($job_from)); ?>">
					</div>
					<div class="col-sm-12 item select-job-to">
						<div class="label-wrapper"><label for="job_to">To</label></div>
						<input type="date" name="job-date-to[]" value="<?php echo date("Y-m-d",strtotime($job_to)); ?>">
						<div class="checkbox-wrapper">
                          <input type="checkbox" class="to-date-check" name="current-work[]">
                          <span>Currently Working here</span>
                        </div>
					</div>
				</div>
			<?php } // for each ends ?>
			</div>

			<div class="add-another">
				<a href="#!" id="add-button" onclick="addWork()"><i class="fa fa-plus"></i> Add Work</a>
				<input type="hidden" id="job_count" value="<?php echo $job_count+1 ?>">

			</div>
			<div class="button-wrapper">
				<a href="<?= base_url()?>/userProfile">Cancel</a>
				<button class="btn purple-bkgd" type="submit">Save</button>
			</div>
			<?php echo form_close() ?>
		</div>

		<div class="row skills card user-detail">
			<h2><i class="fa fa-compass"></i> Skills</i></h2>
			<hr>
			<?php echo form_open('userProfile/skillsValidation'); ?>
			<?php echo @$errors['skill_errors'] ?>
				
			
			<div class="user-skill-wrapper" id="user-skill-wrapper">
			<?php $count_skill = 1 ?>
			<?php foreach ($skills as $skill) {
				$count_skill++;
			?>
				<div class="user-skill" id="user-skill-<?php echo $count_skill ?>">
					<span><?php echo $skill->skill ?></span>
					<input type="hidden" value="<?php echo $skill->skill ?>" id="skill-value-<?php echo $count_skill ?>">
					<a href="#!" goto="<?=base_url()?>UserProfile/deleteSkill" id="delete-skill" onclick="deleteSkill(<?php echo $count_skill ?>)"><i class="fa fa-close"></i></a>
				</div>
			<?php
				}
			?>
				<div class="col-sm-12 item add-skill">
					<div class="label-wrapper"><label for="add_skill">Add Skill</label></div>
					<input type="text" name="user-skill" id="user-skill" value="<?php echo $add_skill; ?>">
					<input type="hidden" id="no-of-skills" value="<?php echo $count_skill ?>">
				</div>
				<div class="button-wrapper">
					<button class="btn purple-bkgd">Cancel</button>
					<button class="btn purple-bkgd " type="submit">Add</button>
				</div>
			</div>
				<?php echo form_close() ?>
		</div>
		
		<div class="row projects card user-detail">
			<h2><i class="fa fa-file-text-o"></i> Projects</h2>
			<hr>

			<div class="projects-wrapper">
				<?php echo form_open('userProfile/projectsValidation'); ?>
				<?php echo @$errors['project_errors']?>
				<?php $project_count = 0 ?>
				<div class="project-block row" id="project-block">
				<?php foreach ($projects as $project) {
					$project_name = @$project->project_name;
				 	$project_from = @$project->from;
				 	$project_to = @$project->to;
				 	$project_details = @$project->project_details;
				 	$skills_used = @$project->skills_used;
				 	$project_count++;
				?>
					<div class="col-xs-12 project-detail" id="project-detail-<?php echo $project_count; ?>">
						<a href="#!" id="delete-button" onclick="deleteElement('project-detail-<?php echo $project_count; ?>')" class="delete-button"><i class="fa fa-trash"></i> Delete</a>
						<div class="col-sm-12 item">
							<div class="label-wrapper"><label for="project-name">Project Name</label></div>
							<input type="text" name="project_name[]" required value="<?php echo $project_name ?>">
						</div>
						<div class="col-sm-12 item">
							<div class="label-wrapper"><label for="project_details">Project Description</label></div>
							<textarea name="project_details[]" required><?php echo $project_details ?></textarea>
						</div>
						<div class="col-sm-12 item">
							<div class="label-wrapper"><label for="skills_used">Skills Used</label></div>
							<input type="text" name="skills_used[]" required value="<?php echo $skills_used ?>">
						</div>
						<div class="col-sm-12 item select-project-from">
							<div class="label-wrapper"><label for="project_from">From</label></div>
							<input type="date" name="project_from[]" value="<?php echo date("Y-m-d",strtotime($project_from)); ?>">
						</div>
						<div class="col-sm-12 item select-project-to">
							<div class="label-wrapper"><label for="project_to">To</label></div>
							<input type="date" name="project_to[]" value="<?php echo date("Y-m-d",strtotime($project_to));?>">
							<div class="checkbox-wrapper">
	                          <input type="checkbox" class="to-date-check" name="current-project[]">
	                          <span>Currently doing this project</span>
	                        </div>
						</div>
					</div>
				<?php } //for each closes ?>
				</div>
				<div class="add-another">
				<a href="#!" id="add-button" onclick="addProject()"><i class="fa fa-plus"></i> Add Project</a>
				<input type="hidden" id="project_count" value="<?php echo $project_count+1 ?>">

				</div>
				<div class="button-wrapper">
					<button class="btn purple-bkgd">Cancel</button>
					<button class="btn purple-bkgd" type="submit">Save</button>
				</div>
				<?php echo form_close() ?>
			</div>
		</div>
	</section>

	<section class="col-md-4"> 
		<?php include 'includes/sidebar.php'; ?>
	</section>
</div>
<!-- <script src="<?= base_url();?>/assets/js/edit-userprofile.js"></script> -->
