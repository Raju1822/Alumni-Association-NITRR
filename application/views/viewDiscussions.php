<link rel="stylesheet" href="<?=base_url()?>assets/css/view-discussions.css">

	<div style="height:120px"></div>

	<div class="container body-wrapper">
		<section class="single-post-page col-md-8">
			<?php
			$data1=$this->db->query("SELECT * FROM discussions where discussion_id=$id");
			$tabrec=$data1->num_rows();
			$isAdmin = $this->session->userdata('logged_in_admin');
			foreach ($data1->result() as $row)
			{		
				$disid=$row->discussion_id;
				$count=$this->db->query("select * from discussions where `parent_discussion_id`=$disid");
				$countlikes=$this->db->query("select * from discussion_likes where `discussion_id`=$disid");
				$cntlikes=$countlikes->num_rows();
				$noofcomments = $count->num_rows() - 1;
				$countviews=$this->db->query("select * from discussion_views where `discussion_id`=$disid");
				$cntviews=$countviews->num_rows();
			?>
		  		<div class="posts-wrapper">
					<div class="post col-md-12">
						<h3><?php echo $row->discussion_name ?></h3>
						<p><?php echo $row->discussion_content ?></p>
					<div class="details row">
						<div class="col-md-6">
							<div class="views detail "><i class="fa fa-eye"></i><?php echo $cntviews?> Views </div>
							<div class="comments detail"><i class="fa fa-comments-o"></i><?php echo $noofcomments ?> </div>
							<div class="likes detail"><i class="fa fa-thumbs-o-up"></i><?php echo $cntlikes ?> </div>
							<div class="date detail"><i class="fa fa-clock-o"></i><?php echo date('d M Y',strtotime($row->date)) ?></div>
						</div>
						<?php if($isAdmin){?>
							<div class="admin-controls col-md-6">
								<?php switch ($type) {
									case '1':
										# Discussions
										?>
										<a href="<?=base_url()?>discussions/deletediscussion/discussion/<?php echo $row->discussion_id ?>" class="btn red-bkgd"><i class="fa fa-times"></i>Delete Post</a>
										<?php
										break;
									case '2':
										# student-forum?>
										<a href="<?=base_url()?>discussions/deletediscussion/student-forum/<?php echo $row->discussion_id ?>" class="btn red-bkgd"><i class="fa fa-times"></i>Delete Post</a>
										<?php
										break;
									case '3':
										# chapterd
										?>
										<a href="<?=base_url()?>discussions/deletediscussion/chapter/<?php echo $row->discussion_id ?>" class="btn red-bkgd"><i class="fa fa-times"></i>Delete Post</a>
										<?php		
										break;
								} ?>
							</div>
						<?php } ?>
					</div>
					
				</div>
				<?php
					$cmnts=$this->db->query("select * from discussions where `parent_discussion_id`= $disid and `discussion_id` != `parent_discussion_id` order by date,discussion_id");
					echo '<div class="comments-wrapper card">';
					foreach ($cmnts->result() as $rowcmnt)
					{
						$uid=$rowcmnt->content_posted_by_user_id;
						$c=$this->db->query("select * from personal_detail where user_id=$uid");
						$name="";
						foreach($c->result() as $r)
						{
							$name=$r->name;
						}

						echo '<div class="comment col-md-12">
								<div class="name"><a href="'.base_url().'viewprofile/user/'.$uid.'">'.$name;
								echo ': </a></div>
								<div class="comment-text">'.$rowcmnt->discussion_content;
								echo '</div>
							  </div>';
					}
					echo '</div>';
				
					?>
				<div class="comment-box card">
					<?php echo form_open('Discussions/insertComment/'.$disid);?>
					<div class="col-md-10">
						<textarea name="content" class="form-control" rows="1" id="content" placeholder="Comment.." autocomplete="off" ></textarea>
					</div>
					<div class="col-md-2">
						<input type="submit" name="upload" class="btn purple-bkgd" value="Comment">
					</div>
					<?php echo form_close() ?>
				</div>

					<?php
			echo '</div>';
			}
			?>
			</ul>
		</section>
		<section class="col-md-4">
			<?php require_once("includes/sidebar.php"); ?>
		</section>
	</div>
