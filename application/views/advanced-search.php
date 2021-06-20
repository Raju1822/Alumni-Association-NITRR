<link rel="stylesheet" href="<?=base_url()?>assets/css/advanced-search.css">
<div style="height:110px"></div>
<div class="body-wrapper container">
	<div class="search-page-wrapper">
		<h2 class="text-center">Advanced Search</h2>
		
		<div class="form-wrapper col-md-10">	
			<?php echo form_open('AdvancedSearch/search') ?>
			<div class="row">
				<div class="item col-sm-12">
					<label for="name">Name</label>
					<input type="text" name="name" value="<?php echo set_value('name') ?>">
				</div>
			</div>

			<div class="row">
				<div class="item col-sm-6">
					<label for="year">Year of Passing</label>		
					<select name="year" <?php echo set_value('year') ?>>
						<option value="">Select</option>
						<script>
						  var myDate = new Date();
						  var year = myDate.getFullYear();
						  for(var i = 1958; i <= year+4; i++){
							  document.write('<option value="'+i+'">'+i+'</option>');
						  }
					    </script>
					</select>
				</div>

				<div class="item col-sm-6">
					<label for="branch">Branch</label>		
					<select name="branch" <?php echo set_value('branch') ?>>
						<option value="">Select</option>
						<?php foreach ($branches as $branch) {
						
							echo "<option value=\"$branch->branch\">$branch->branch</option>";
						 } ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="item col-sm-6">
					<label for="degree">Degree</label>		
					<select name="degree" <?php echo set_value('degree') ?>>
						<option value="">Select</option>
						<?php foreach ($degrees as $degree) {
							echo "<option value=\"$degree->degreename\">$degree->degreename</option>";
						 } ?>
					</select>
				</div>
				<div class="item col-sm-6">
					<label for="city">City</label>		
					<input type="text" name="city" placeholder="Start Typing.." value="<?php echo set_value('city') ?>">
				</div>
			</div>

			<div class="row">
				<div class="item submit-button col-sm-12 text-center">
					<button class="btn purple-bkgd" type="submit">Search</button>
				</div>
			</div>
			<?php echo form_close() ?>
		</div> <!-- Form-wrapper ends-->
		<hr>

		<?php if(@$results){ ?>

		<!-- results wrapper -->
		<div class="results-wrapper">
			<h2 class="text-center">Results</h2>
			

			<div class="results col-md-12">
				
				<?php foreach ($results as $result) { ?>

				<!-- result item -->
				<div class="result col-md-6 col-xs-12">
					<div class="image col-xs-4"><a href="#"><img class="img-responsive" src="<?= base_url()?>assets/img/user-img.png" alt=""></a></div>
					<div class="user-details col-xs-8 ">
						<h3 class="name"><a href="<?=base_url()?>Viewprofile/user/<?php echo $result->user_id ?>"><?php echo $result->name ?></a></h3>
						
						<?php 
							echo "<p class='branch'>";
							if($result->degree_ug){echo $result->degree_ug;}
							if($result->branch_ug){echo ", ".$result->branch_ug;}
							if($result->ug_passing_year){echo ", ".$result->ug_passing_year;}
							echo "</p>";
						?>
						<?php 
							echo "<p class='branch'>";
							if($result->degree_pg){echo $result->degree_pg;}
							if($result->branch_pg){echo ", ".$result->branch_pg;}
							if($result->pg_passing_year){echo ", ".$result->pg_passing_year;}
							echo "</p>";
						?>

						

					</div>
				</div>
				<!-- result item ends -->

				<?php } ?>

			</div>

			<!-- lower pagination -->
			<ul class="pagination">
			    <!-- <a href="<?=base_url()?>advancedsearch/search" aria-label="Previous"><li><span aria-hidden="true">&laquo;</span></li> -->
			    </a>
			    
			    <?php for ($i=1; $i <= $total_pages; $i++) { 
				   // echo "<a href=\"".base_url()."advancedsearch/search\"><li>$i</li></a>";									    	
			    } ?>

			    <!-- <a href="<?= base_url() ?>advancedsearch/search" aria-label="Next"><li><span aria-hidden="true">&raquo;</span></li> -->
			    <!-- </a> -->
			</ul>
			<!-- lower pagination ends -->

		</div>
		<!-- results end -->
		<?php }

		elseif(@$total_pages ===0){?>
		<div class="results-wrapper">
			<h2 class="text-center">Sorry no Results Found. Try a different search term.</h2>
		</div>
		<?php }?>
	</div>
</div>
