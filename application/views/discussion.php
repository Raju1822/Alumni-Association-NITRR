  	<link rel="stylesheet" href="<?=base_url()?>assets/css/discussion.css">
	<div style="height:120px"></div>
	<div class="container body-wrapper">
		<section class="posts-dispaly-page col-md-8">
			<h2 class="text-center">Discussions</h2>

			<div class="new-post col-xs-12">
				<?php echo form_open_multipart('Discussions/doupload');?>
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
			if(isset($ind))
			{
				$sind=$ind;
			}	
			else
			{
				$sind=0;
			}

			$totrec=8;
			$data1=$this->db->query('SELECT * FROM discussions where `discussion_id`= `parent_discussion_id` and `type_id`=1 and status = 1 order by `date` desc');
			$data=$this->db->query("SELECT * FROM `discussions` where `discussion_id`= `parent_discussion_id` and `type_id`=1 and status = 1 order by `date` desc LIMIT $sind,8 ");
			$tabrec=$data1->num_rows();

			foreach ($data->result() as $row)
			{
				$disid=$row->discussion_id;
				$count=$this->db->query("select * from discussions where `parent_discussion_id`=$disid");
				$countlikes=$this->db->query("select * from discussion_likes where `discussion_id`=$disid");
				$cntlikes=$countlikes->num_rows();
				$noofcomments = $count->num_rows();
				$noofcomments--;
				$countviews=$this->db->query("select * from discussion_views where `discussion_id`=$disid");
				$cntviews=$countviews->num_rows();
				$liketext = ($cntlikes == 1) ? 'Like' : 'Likes';
				$commenttext = ($noofcomments == 1) ? 'Comment' : 'Comments';
				echo '<div class="posts-wrapper">
				<div class="post col-md-12">
					<h3>';
					echo substr($row->discussion_name,0,100);
					echo'</h3><p>';
					echo substr(strip_tags($row->discussion_content),0,170)."...";
					echo "<a href = '".base_url()."/Discussions/view/";echo $row->discussion_id; echo "'>Continue Reading</a>";
					echo'</p>
					<div class="details col-md-12">
						<div class="views detail "><i class="fa fa-eye"></i>'.$cntviews.' Views</div>
						<div class="comments detail"><i class="fa fa-comments-o"></i>'.($noofcomments).' '.$commenttext.'</div>
						<!-- Liked for a liked post-->
						<div class="likes detail" ><i class="fa fa-thumbs-o-up" onclick="update_like(';
						echo $row->discussion_id;echo ')"></i>'.$cntlikes.' '.$liketext.'</div>
						<div class="date detail"><i class="fa fa-clock-o"></i>';
						$date=date_create("$row->date");
						echo date_format($date,"d M Y");
						echo '</div>
					</div>
				</div>
			</div>';
			}
			echo '<ul class="pagination">';
			if($sind!=0)
			{
				$pind=$sind-$totrec;
				echo "&nbsp;<a href = '".base_url()."Discussions/view/$pind' aria-label='Previous'>";
					echo '<li><span aria-hidden="true">&laquo;</span></li> </a>';	
			}
			$nind=$sind+$totrec;
			
			$x=$tabrec/$totrec;
			$x=intval($x);
			$x=$x*$totrec;	
			?>
			<?php
			$pages=$tabrec/$totrec;
			for($i=0;$i<$pages;$i++)
			{
				$pn = $i+1;
				$index=$i*$totrec;
				if($index==$sind)
				{
					echo "<a href = '".base_url()."Discussions/view/$index' ><li style='color:white;background-color:black'>". $pn."</li></a>";
				}
				else 	echo "<a href = '".base_url()."Discussions/view/$index'><li>". $pn."</li></a>";
			
			}
			if($nind<$tabrec)
			{
				echo "&nbsp;<a href = '".base_url()."Discussions/view/$nind' aria-label='Next'>";
					echo '<li><span aria-hidden="true">&raquo;</span></li> </a>';		
			}
	?>
	</section>
		<section class="col-md-4">
			<?php require_once("includes/sidebar.php"); ?>
		</section>
	</div>
<script src="<?=base_url()?>assets/js/update_likes.js"></script>
	