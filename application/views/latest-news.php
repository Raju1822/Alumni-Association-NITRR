  	<link rel="stylesheet" href="<?=base_url()?>assets/css/latest-news.css">

	<div style="height:120px"></div>

	<div class="container body-wrapper">
		<section class="posts-display-page col-md-8">
			<h2 class="text-center">Latest News</h2>
			
			<div class="new-post col-xs-12">
				<?php echo form_open_multipart('News/doupload');?>
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
			
			$perpage=8;

			$data1=$this->db->query('SELECT * FROM main_content where `content_category_id`=2 and `status`=1 order by content_date desc');
			$data=$this->db->query("SELECT * FROM `main_content` where `content_category_id`=2 and `status`=1 order by `content_date` desc LIMIT $sind,8 ");
			$tabrec=$data1->num_rows();
			
			foreach ($data->result() as $row)
			{	

			echo '<div class="posts-wrapper">
				<div class="post col-md-12">
					<h3>';
					echo substr($row->main_content_name,4,100);
					echo'</h3><p>';
					echo substr(strip_tags($row->content_text),0,170)."....";
					echo "<a href = '".base_url()."events/view/";echo $row->main_content_id; echo "'>Continue Reading</a>";
					echo'</p>
					<div class="details col-md-12">
						<div class="date detail"><i class="fa fa-clock-o"></i>';
						$date=date_create("$row->content_date");
						echo date_format($date,"d M Y");
						echo '</div>
					</div>
				</div>
			</div>';
			}
			echo '<ul class="pagination">';
			if($sind!=0)
			{
				$pind=$sind-$perpage;
				echo "&nbsp;<a href = '".base_url()."/News/NewsPage/$pind' aria-label='Previous'>";
					echo '<li><span aria-hidden="true">&laquo;</span></li> </a>';	
			}
			$nind=$sind+$perpage;
			
			$x=$tabrec/$perpage;
			$x=intval($x);
			$x=$x*$perpage;	
			?>
			<?php
			$pages=$tabrec/$perpage;
			for($i=0;$i<$pages;$i++)
			{
				$pn = $i+1;
				$index=$i*$perpage;
				if($index==$sind)
				{
					echo "<a href = '".base_url()."/News/NewsPage/$index' ><li style='color:white;background-color:black'>". $pn."</li></a>";
				}
				else 	echo "<a href = '".base_url()."/News/NewsPage/$index'><li>". $pn."</li></a>";
			
			}
			if($nind<$tabrec)
			{
				echo "&nbsp;<a href = '".base_url()."/News/NewsPage/$nind' aria-label='Next'>";
					echo '<li><span aria-hidden="true">&raquo;</span></li> </a>';		
			}
	?>
			
			
			</ul>
		</section>
		<section class="col-md-4">
			<?php require_once("includes/sidebar.php"); ?>
		</section>
	</div>
