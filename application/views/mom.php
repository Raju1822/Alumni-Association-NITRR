  	<link rel="stylesheet" href="<?=base_url()?>assets/css/minutesofmeeting.css">

	<div style="height:120px"></div>

	<div class="container body-wrapper">
		<section class="posts-display-page col-md-8">
			<h2 class="text-center">Minutes Of Meeting</h2>

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
			
			$data1=$this->db->query('SELECT * FROM main_content where `content_category_id`=1 order by content_date desc');
			$data=$this->db->query("SELECT * FROM `main_content` where `content_category_id`=1 order by `content_date` desc LIMIT $sind,8 ");
			$tabrec=$data1->num_rows();
			foreach ($data->result() as $row)
			{		
			echo '<div class="posts-wrapper">
				<div class="post col-md-12">
					<h3>';
					echo substr($row->main_content_name,0,100);
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
				$pind=$sind-$totrec;
				echo "&nbsp;<a href = '".base_url()."minutesofmeeting/Mompage/$pind' aria-label='Previous'>";
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
					echo "<a href = '".base_url()."/minutesofmeeting/Mompage/$index' ><li style='color:white;background-color:black'>". $pn."</li></a>";
				}
				else 	echo "<a href = '".base_url()."/minutesofmeeting/Mompage/$index'><li>". $pn."</li></a>";
			
			}
			if($nind<$tabrec)
			{
				echo "&nbsp;<a href = '".base_url()."/minutesofmeeting/Mompage/$nind' aria-label='Next'>";
					echo '<li><span aria-hidden="true">&raquo;</span></li> </a>';		
			}
	?>
			
			
			</ul>
		</section>
		<section class="col-md-4">
			<?php require_once("includes/sidebar.php"); ?>
		</section>
	</div>
