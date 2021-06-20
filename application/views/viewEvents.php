  	<link rel="stylesheet" href="<?=base_url()?>assets/css/view-events.css">

	<div style="height:120px"></div>

	<div class="container body-wrapper">
		<section class="view-events col-md-8">
			<?php
			$tabrec = $data1->num_rows();
			$isAdmin = $this->session->userdata('logged_in_admin');
			foreach ($data1->result() as $row)
			{	
			?>	
				<div class="posts-wrapper">
					<div class="post col-md-12">
						<h3><?php echo $row->main_content_name ?></h3>
						<p><?php echo $row->content_text ?></p>
						<div class="details row">
							<div class="date detail col-md-6"><i class="fa fa-clock-o"></i>Event Date:
							<?php echo date('d M Y',strtotime($row->content_date))?>
						</div>
						<?php if($isAdmin){ ?>
						<div class="admin-controls col-md-6">

							<?php switch ($type) {
								case '1':
									# Minutes of meeting
									?>
									<a href="<?=base_url()?>events/deleteevent/mom/<?php echo $row->main_content_id ?>" class="btn red-bkgd"><i class="fa fa-times"></i>Delete Post</a>
									<?php
									break;
								case '2':
									# News?>
									<a href="<?=base_url()?>events/deleteevent/news/<?php echo $row->main_content_id ?>" class="btn red-bkgd"><i class="fa fa-times"></i>Delete Post</a>
									<?php
									break;
								case '3':
									# Events
									?>
									<a href="<?=base_url()?>events/deleteevent/event/<?php echo $row->main_content_id ?>" class="btn red-bkgd"><i class="fa fa-times"></i>Delete Post</a>
									<?php		
									break;
							} ?>
						</div>
						<?php } ?>
				</div>
			</div>
			<?php }	?>
			</ul>
		</section>
		<section class="col-md-4">
			<?php require_once("includes/sidebar.php"); ?>
		</section>
	</div>
