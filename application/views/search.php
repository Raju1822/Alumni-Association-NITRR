  	<link rel="stylesheet" href="<?=base_url()?>assets/css/search.css">

	<div style="height:120px"></div>
	<section class="container search-page-wrapper">
		<?php echo form_open('search/searchResult'); ?>
			<div class="search-box">
				<input type="text" name="search" required placeholder="Search by name or email">
			</div>
			<div class="search-button">
				<button type="submit" class="btn purple-bkgd"><i class="fa fa-search"></i></button>
			</div>
		<?php echo form_close(); ?>

		<?php if (validation_errors()): ?>
			<div class="errors"><?php echo validation_errors(); ?></div>
		<?php endif ?>
		

		<?php if (isset($users) && $users) {?>
			<h3>You Searched for "<?php echo $this->input->post('search'); ?>"</h3>
			
			<table class="table">
				<tr><th>Name</th><th>email</th><th>City</th></tr>
				
				<?php foreach($users as $user):?>
				<tr>
				<td><?php echo $user->name ?></td>
				<td><?php echo $user->email ?></td>
				<td><?php echo $user->city ?></td>
				</tr>
				<?php endforeach;?>
			</table>

		<?php
		}else if(isset($users) && !$users){ ?>
			
			<h3>Sorry, No results found for "<?php echo $this->input->post('search'); ?>"</h3>
		
		<?php } ?>

	</section>

	