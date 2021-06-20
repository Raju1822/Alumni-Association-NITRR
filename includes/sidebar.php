<div class="notifications-wrapper">
				
				<div class="col-md-12 sidebar-news">
					<div class="Yslider-header"><h2><i class="fa fa-newspaper-o"></i>Latest News</h2></div>
					<div id="news" class="Yslider">
						<!-- <div class="controls">
							<a class="buttons prev col-xs-2" href="#"><i class="fa fa-chevron-left"></i></a>
							<a class="buttons next col-xs-2" href="#"><i class="fa fa-chevron-right"></i></a>
						</div> -->
						<div class="viewport col-xs-12">
							<ul class="overview">
							<?php
							$query=$this->db->query("SELECT `main_content_id`,`content_date`,`main_content_name`,`content_text` FROM `main_content` WHERE `main_content_name` like 'News %'  order by `content_date` DESC LIMIT 0,5 ");
							
							foreach ($query->result_array() as $row)
							{
								echo '<li>
									<a href="'.base_url().'events/view/'.$row['main_content_id'].'">
									<div class="Yslider-element">
										<div class="date-block col-xs-2">
                                            <p>'.date("d",strtotime($row['content_date'])).'</p>
											<p>'.date("M",strtotime($row['content_date'])).'</p>
											<p>'.date("Y",strtotime($row['content_date'])).'</p>
										</div>

										<div class="details col-xs-8">
											<h3>'.substr($row['main_content_name'],5,strlen($row['main_content_name'])).'</h3>
										</div>

										<div class="details-arrow col-xs-2">
											<i class="fa fa-3x fa-angle-right"></i>
										</div>
									</div></a>
								</li>
								</li>';
							}
							?>
							</ul>
						</div>
						
					</div>
				</div>
				<div class="col-sm-12 sidebar-events">
					<div class="Yslider-header"><h2><i class="fa fa-calendar"></i>Events</h2></div>
					<div id="events" class="Yslider">
						<!-- <div class="controls">
							<a class="buttons prev col-xs-2" href="#"><i class="fa fa-chevron-left"></i></a>
							<a class="buttons next col-xs-2" href="#"><i class="fa fa-chevron-right"></i></a>
						</div> -->
						<div class="viewport events col-xs-12">
							<ul class="overview">
							<?php
							$query=$this->db->query("SELECT `main_content_id`,`content_date`,`main_content_name`,`content_text` FROM `main_content` WHERE `main_content_name` like 'Events %'  order by `content_date` DESC LIMIT 0,5");
							
							foreach ($query->result_array() as $row)
							{
								echo'<li>
									<a href="'.base_url().'Events/view/'.$row['main_content_id'].'">
									<div class="Yslider-element">
										<div class="date-block col-xs-2">
											<p>'.date("d",strtotime($row['content_date'])).'</p>
											<p>'.date("M",strtotime($row['content_date'])).'</p>
											<p>'.date("Y",strtotime($row['content_date'])).'</p>
										</div>

										<div class="details col-xs-8">
											<h3>'.substr($row['main_content_name'],7,strlen($row['main_content_name'])).'</h3>
											
											<!--<div class="venue"><span>Venue:</span></div>-->
										</div>

										<div class="details-arrow col-xs-2">
											<i class="fa fa-3x fa-angle-right"></i>
										</div>
									</div>
									</a>
								</li>';
							}
                             ?>							
							</ul>
						</div>
						
					</div>
				</div>
				<a href=<?php echo "'".base_url().'Minutesofmeeting'."'";?>>
				<div class="col-md-12 sidebar-minutes">
					<div class="Yslider-header"><h2><i class="fa fa-users"></i>Minutes of meeting</h2></div>
				</div></a>
				</div>
				</div>
				
				</div>
			</div>