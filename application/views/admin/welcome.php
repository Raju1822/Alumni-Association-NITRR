  	<link rel="stylesheet" href="<?=base_url()?>assets/css/admin-welcome.css">

	<div style="height:120px"></div>

	<div class="container body-wrapper">
		<section class="posts-display-page admin-panel-wrapper">
			
			<ul class="nav nav-pills">
			  <li role="presentation" class="dropdown">
			    <a class="dropdown-toggle purple-bkgd white-text" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			      Users <span class="caret"></span> <span class="badge"><?php echo $pending_users ?></span>
			    </a>
			    <ul class="dropdown-menu">
					<li><a href="<?=base_url()?>admin/pendingapprovals/users">Pending Approvals</a></li>
					<!-- 
					<li><a href="<?=base_url()?>">View all Users</a></li>
					<li><a href="<?=base_url()?>">Modify Users</a></li>
					<li><a href="<?=base_url()?>">Block Users</a></li> -->
			    </ul>
			  </li>
			  <li role="presentation" class="dropdown">
			    <a class="dropdown-toggle purple-bkgd white-text" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			      Events <span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
					<li><a href="<?=base_url()?>events/createevent">Create New Event</a></li>
					<li><a href="<?=base_url()?>events">Modify an Event</a></li>
					<li><a href="<?=base_url()?>events">Delete an Event</a></li>
			    </ul>
			  </li>
			  <li role="presentation" class="dropdown">
			    <a class="dropdown-toggle purple-bkgd white-text" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			      Minutes <span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu">
					<li><a href="<?=base_url()?>Minutesofmeeting/createMom">Create New</a></li>
					<li><a href="<?=base_url()?>Minutesofmeeting">Modify</a></li>
					<li><a href="<?=base_url()?>Minutesofmeeting">Delete</a></li>
			    </ul>
			  </li>
			  <li role="presentation" class="dropdown">
			    <a class="dropdown-toggle purple-bkgd white-text" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			      Discussions <span class="caret"></span> <span class="badge"><?php echo $pending_discussions ?></span>
			    </a>
			    <ul class="dropdown-menu">
					<li><a href="<?=base_url()?>admin/pendingapprovals/discussions">Pending Approvals</a></li>
					<li><a href="<?=base_url()?>discussions">Create New Discussion</a></li>
					<li><a href="<?=base_url()?>discussions">Modify a Discussion</a></li>
			    </ul>
			  </li>
			  <li role="presentation" class="dropdown">
			    <a class="dropdown-toggle purple-bkgd white-text" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			      Chapters <span class="caret"></span> <span class="badge"><?php echo $pending_chapters ?></span>
			    </a>
			    <ul class="dropdown-menu">
					<li><a href="<?=base_url()?>admin/pendingapprovals/chapters">Pending Approvals</a></li>
					<li><a href="<?=base_url()?>chapters">Create New Chapter</a></li>
					<li><a href="<?=base_url()?>chapters">Modify a Chapter</a></li>
			    </ul>
			  </li>
			  <li role="presentation" class="dropdown">
			    <a class="dropdown-toggle purple-bkgd white-text" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			      Student Forum <span class="caret"></span> <span class="badge"><?php echo $pending_student_forum ?></span>
			    </a>
			    <ul class="dropdown-menu">
					<li><a href="<?=base_url()?>admin/pendingapprovals/student-forum">Pending Approvals</a></li>
					<li><a href="<?=base_url()?>studentforum">Create New Post</a></li>
					<li><a href="<?=base_url()?>studentforum">Modify Forum Post</a></li>
			    </ul>
			  </li>
			</ul>
			
			
			<div class="admin-page-wrapper">
				<div class="row">
					<div class="col-md-6">
						<div class="card admin-card">
							<h3>Users</h3>
							<hr>
							<p>Registered Users: <?php echo $registered_users; ?></p>
							<p>Verified Users: <?php echo $registered_users - $pending_users; ?></p>
							<p>Pending Verifications: <?php echo "$pending_users"; ?></p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card admin-card">
							<h3>Discussions</h3>
							<hr>
							<p>Total Discussions : <?php echo $total_discussions; ?></p>
							<p>Verified Discussions: <?php echo $total_discussions - $pending_discussions; ?></p>
							<p>Pending Verifications: <?php echo "$pending_discussions"; ?></p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card admin-card">
							<h3>Chapters</h3>
							<hr>
							<p>Total Discussions :<?php echo "$total_chapters"; ?></p>
							<p>Verified Discussions: <?php echo $total_chapters - $pending_chapters; ?></p>
							<p>Pending Verifications:<?php echo "$pending_chapters"; ?></p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card admin-card">
							<h3>Student Forum</h3>
							<hr>
							<p>Total Discussions :<?php echo "$total_student_forum"; ?></p>
							<p>Verified Discussions: <?php echo $total_student_forum - $pending_student_forum; ?></p>
							<p>Pending Verifications:<?php echo $pending_student_forum; ?></p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>