<link rel="stylesheet" href="<?=base_url()?>assets/css/discussion.css">
	<div style="height:120px"></div>
	<div class="container body-wrapper">
		<section class="posts-dispaly-page col-md-8">
			<h2 class="text-center">Create Event</h2>

			<div class="new-post col-xs-12">
				<?php echo form_open('Events/createeventsubmit');?>
				<?php echo validation_errors(); ?>
				<div class="col-xs-12">
					<input type="text" placeholder="Title" name="title" id="title" required autocomplete="off">
					<textarea name="content" class="form-control" rows="5" id="content" required placeholder="Description.." autocomplete="off" ></textarea>
					<input type="date" name="date" required>
				</div>
				<div class="col-md-12 post-options">
					<input type="submit" name="upload" class="btn purple-bkgd" value="Post">				
				</div>
				<?php echo form_close() ?>
			</div>
			
	</section>
		<section class="col-md-4">
			<?php require_once("includes/sidebar.php"); ?>
		</section>
	</div>