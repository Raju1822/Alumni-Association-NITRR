  	<link rel="stylesheet" href="<?=base_url()?>assets/css/admin-welcome.css">

	<div style="height:120px"></div>

	<div class="container body-wrapper">
		<section class="posts-display-page admin-panel-wrapper">
			<!-- <ul class="nav nav-pills">
			  <li role="presentation" class="dropdown">
			    <a class="dropdown-toggle purple-bkgd white-text" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			      Users <span class="caret"></span> <span class="badge"><?php echo $pending_users_count ?></span>
			    </a>
			    <ul class="dropdown-menu">
					<li><a href="<?=base_url()?>admin/pendingapprovals/users">Pending Approvals</a></li> 
					<li><a href="<?=base_url()?>">View all Users</a></li>
					<li><a href="<?=base_url()?>">Modify Users</a></li>
					<li><a href="<?=base_url()?>">Block Users</a></li>
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
			</ul> -->
			
			<div class="admin-page-wrapper">
				<h2 class="text-center">View and Edit Users</h2>

				<div class="search-box col-md-8 col-sm-12">
					<form class="form-horizontal" role="form">
						<div class="form-group col-md-9">
							<label class="sr-only" for="search-text"></label>
							<input type="text" class="form-control" id="search-text" placeholder="Search using name, email, phone no etc.">
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn purple-bkgd">Submit</button>						
						</div>
					</form>
				</div>
				<!-- results wrapper -->
				<div class="results-wrapper">
					
					<div class="results">
						<table class="table table-hover" width="100%">
							<thead>
								<tr>
									<th>User Id</th>
									<th>Name</th>
									<th>Email</th>
									<th>State</th>
									<th>City</th>
									<th>Passing Year</th>
									<th>Passing Year</th>
									<th>Degree</th>
									<th>Branch</th>
									<th>Branch</th>
									<th>Phone</th>
									<!-- email a password reset link -->
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="11">No results</td>
								</tr>
							</tbody>
						</table>
					</div>

				<!-- lower pagination -->
				<!-- <ul class="pagination">
				    <a href="<?=base_url()?>Admin/pendingapprovals/users/1" aria-label="Previous"><li><span aria-hidden="true">&laquo;</span></li>
				    </a>
				    
				    <?php for ($i=1; $i < $total_pages; $i++) { 
					    echo "<a href=\"".base_url()."admin/pendingapprovals/users/$i\"><li>$i</li></a>";									    	
				    } ?>

				    <a href="<?= base_url() ?>Admin/pendingapprovals/users/<?php echo floor($total_pages) ?>" aria-label="Next"><li><span aria-hidden="true">&raquo;</span></li>
				    </a>
				</ul> -->
				<!-- lower pagination ends -->
			</div>
			<!-- results end -->	
			</div>
		</section>
	</div>