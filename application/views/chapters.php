  	<link rel="stylesheet" href="<?=base_url()?>assets/css/discussion.css">

	<div style="height:120px"></div>

	<div class="container body-wrapper">
		<section class="posts-dispaly-page col-md-8">
			<h2 class="text-center">Chapter Discussion</h2>
			
			<div class="new-post col-xs-12">
				<?php echo form_open_multipart('Chapters/doupload');?>
				<?php echo validation_errors(); ?>
				<div class="col-xs-12">
					<input type="text" placeholder="Title" name="title" id="title" autocomplete="off">
					<textarea name="content" class="form-control" rows="5" id="content" placeholder="Description.." autocomplete="off" ></textarea>
					<input name="userfile[]" id="userfile" type="file" multiple value="sjkdfhds" />
				</div>
				<div class="col-md-12 post-options">
					<input type="submit" name="upload" class="btn purple-bkgd" value="Post">				
				</div>
				<?php echo form_close() ?>
			</div>

			<?php
				if ($chapters) {
					
					foreach ($chapters as $chapter)
					{
						$count = $this->db->query("select * from discussions where `parent_discussion_id`= $chapter->discussion_id");
						$countlikes = $this->db->query("select * from discussion_likes where `discussion_id`= $chapter->discussion_id");
						$cntlikes = $countlikes->num_rows();
						$noofcomments = $count->num_rows();
						$liketext = ($cntlikes == 1) ? 'Like' : 'Likes';
						$commenttext = ($noofcomments == 1) ? 'Comment' : 'Comments';
						$countviews = $this->db->query("select * from discussion_views where `discussion_id`=$chapter->discussion_id");
						$cntviews = $countviews->num_rows();

					?>
					
						<div class="posts-wrapper">
							<div class="post col-md-12">
								<h3><?php echo $chapter->discussion_name?></h3>
								<p><?php echo substr(strip_tags($chapter->discussion_content),0,170)."....";?>
								<a href = "<?=base_url()?>Discussions/view/<?php echo $chapter->discussion_id; ?>">Continue Reading</a>
								</p>
								<div class="details col-md-12">
									<div class="views detail "><i class="fa fa-eye"></i><?php echo $cntviews ?> Views</div>
									<div class="comments detail"><i class="fa fa-comments-o"></i><?php echo $noofcomments." ".$commenttext?></div>
									<div class="likes detail" ><i class="fa fa-thumbs-o-up" onclick="update_like(<?php echo $chapter->discussion_id ?>)"></i><?php echo $cntlikes." ". $liketext?></div>
									<div class="date detail"><i class="fa fa-clock-o"></i><?php echo $chapter->date ?></div>
								</div>
							</div>
						</div>
					<?php } ?>
					
					<!-- lower pagination -->
					<ul class="pagination">
					    <a href="<?=base_url()?>Chapters/chapterspage/1" aria-label="Previous"><li><span aria-hidden="true">&laquo;</span></li>
					    </a>
					    
					    <?php for ($i=1; $i < $total_pages; $i++) { 
						    echo "<a href=\"".base_url()."Chapters/chapterspage/$i\"><li>$i</li></a>";									    	
					    } ?>

					    <a href="<?= base_url() ?>Chapters/chapterspage/<?php echo floor($total_pages) ?>" aria-label="Next"><li><span aria-hidden="true">&raquo;</span></li>
					    </a>
					</ul>
					<!-- lower pagination ends -->
				<?php } ?>
					
		</section>
		<section class="col-md-4">
			<?php require_once("includes/sidebar.php"); ?>
		</section>
	</div>

<script src="<?=base_url()?>assets/js/update_likes.js"></script>
