  	<link rel="stylesheet" href="<?=base_url()?>assets/css/admin-welcome.css">

	<div style="height:120px"></div>

	<div class="container body-wrapper">
		<section class="posts-display-page admin-panel-wrapper">
			<ul class="nav nav-pills">
			  <li role="presentation" class="dropdown">
			    <a class="dropdown-toggle purple-bkgd white-text" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			      Users <span class="caret"></span> <span class="badge"><?php echo $pending_users_count ?></span>
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
			<!-- results wrapper -->
			<div class="results-wrapper">
				<h2 class="text-center">Pending User Apporvals</h2>
				<div class="results col-md-12">
					<table class="table table-hover" width="100%">
						<tbody>
							<thead>
								<tr>
									<td>User Id</td>
									<td>Name</td>
									<td>Email</td>
									<td>Batch</td>
									<td>Branch</td>
									<td>Action</td>
								</tr>
							</thead>
					<?php foreach ($pending_users as $pending_user) { ?>						
						<tr>
							<td><?php echo $pending_user->user_id ?></td>
							<td><a href="<?=base_url()?>viewprofile/user/<?php echo $pending_user->user_id ?>"><?php echo $pending_user->name ?></a></td>
							<td <?php if(!$pending_user->email_verification_status){echo "style='background-color:#FF8E8E;'";} ?>><?php echo $pending_user->email ?></td>
							<td><?php echo $pending_user->passing_year ?></td>
							<td><?php echo $pending_user->branch ?></td>
							<td id="approve_<?php echo $pending_user->user_id; ?>">
								<a onclick="approve_user('<?=base_url()?>admin/verifyuser/<?php echo $pending_user->user_id; ?>/approve', '<?php echo $pending_user->user_id; ?>')" class="btn green-bkgd"><i class="fa fa-check"></i></a>
								<a onclick="decline_user('<?=base_url()?>admin/verifyuser/<?php echo $pending_user->user_id; ?>/decline', '<?php echo $pending_user->user_id; ?>')" class="btn red-bkgd"><i class="fa fa-close"></i></a>
							</td>
						</tr>
					<?php } ?>
						</tbody>
					</table>
				</div>

				<!-- lower pagination -->
				<ul class="pagination">
				    <a href="<?=base_url()?>Admin/pendingapprovals/users/1" aria-label="Previous"><li><span aria-hidden="true">&laquo;</span></li>
				    </a>
				    
				    <?php for ($i=1; $i < $total_pages; $i++) { 
					    echo "<a href=\"".base_url()."admin/pendingapprovals/users/$i\"><li>$i</li></a>";									    	
				    } ?>

				    <a href="<?= base_url() ?>Admin/pendingapprovals/users/<?php echo floor($total_pages) ?>" aria-label="Next"><li><span aria-hidden="true">&raquo;</span></li>
				    </a>
				</ul>
				<!-- lower pagination ends -->

			</div>
			<!-- results end -->	
			</div>
		</section>
	</div>


	<script>
		function approve_user(url, user_id){
			$.get( 
				url, 
				function(data) {
			  		if (data) {
			  			$('#approve_'+user_id).html('Apporved!');
			  		}else{
			  			alert("Verification Falied!");
			  		}		
			});
		}

		function decline_user(url, user_id){
			$.get( 
				url, 
				function(data) {
			  		if (data) {
			  			$('#approve_'+user_id).html('Declined!');
			  		}else{
			  			alert("Rejection Falied!");
			  		}
			  		
			});
		}
	</script>