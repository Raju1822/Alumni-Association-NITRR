  	<link rel="stylesheet" href="<?=base_url()?>assets/css/events.css">

	<div style="height:110px"></div>
	<div class="body-wrapper container">
		<section class="col-md-8 events-page-wrapper">
			<div class="upcoming-events-wrapper col-md-12">

				<?php
				$tday=date("Y-m-d",time());
				$data1=$this->db->query('SELECT * FROM main_content where `content_category_id`=3 and content_date> ? order by content_date desc' ,array($tday));

				if (!$data1->result()) {
					echo "<p class='text-center'>No Upcoming events!</p>";
				}else{
				?>
				<h2 class="text-center">Upcoming Events</h2>
				<?php

					foreach ($data1->result() as $row)
					{
						$date=date_create("$row->content_date");
						echo '<div class="col-md-6">
						<a href="'.base_url().'/Events/view/'.$row->main_content_id.'"><div class="event">
							<div class="date-block col-xs-3">
								<p class="text-center date">'.date_format($date,"D,d").'</p>
								<p class="text-center">'.date_format($date,"M").'</p>
								<p class="text-center">'.date_format($date,"Y").'</p>
							</div>

							<div class="details col-xs-9">
								<h3>'.$row->main_content_name.'</h3>
								<p class="description">'.substr(strip_tags($row->content_text),0,40).'</p>
							</div></div>
						</a>
							</div>';
					}
				}
				?>
			</div>
			<div class="past-events-wrapper col-md-12">
				<h2 class="text-center">Past Events</h2>
					<?php
					$data2=$this->db->query('SELECT * FROM main_content where `content_category_id`=3 and content_date < ? order by content_date desc limit 0,10' ,array($tday));
					if ($data2->result()) {
						
					
						foreach ($data2->result() as $row)
						{
							$date=date_create("$row->content_date");
							echo '<div class="col-md-6"><a href="'.base_url().'Events/view/'.$row->main_content_id.'"><div class="event">
								<div class="date-block col-xs-3">
									<p class="text-center date">'.date_format($date,"D,d").'</p>
									<p class="text-center">'.date_format($date,"M").'</p>
									<p class="text-center">'.date_format($date,"Y").'</p>
								</div>

								<div class="details col-xs-9">
									<h3>'.$row->main_content_name.'</h3>
									<p class="description">'.substr(strip_tags($row->content_text),0,40).'</p>

								</div>
							</div></a></div>';
						}
					}
					?>
			</div>
		</section>
		<section class="col-md-4">
			<?php require_once("includes/sidebar.php"); ?>
		</section>
	</div>