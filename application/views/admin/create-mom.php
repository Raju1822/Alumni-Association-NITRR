<link rel="stylesheet" href="<?=base_url()?>assets/css/discussion.css">  
<link href="<?= base_url() ?>assets/css/summernote.css" rel="stylesheet">
	<div style="height:120px"></div>
	<div class="container body-wrapper">
		<section class="posts-dispaly-page col-md-12">
			<h2 class="text-center">Submit Minutes of Meeting</h2>
			<div class="new-post col-xs-12">
				<form action="<?= base_url() ?>">
				<p class="post-form-error red-text"></p>
				<div class="col-xs-12">
					<input type="text" placeholder="Title" id="post-title" required autocomplete="off">
					<div id="textinput"><p></p></div>
					<input type="date" id="post-date" required>
				</div>
				<div class="col-md-12 post-options">
					<button onclick="submitMinutes(event)" name="upload" class="btn purple-bkgd">Post</button>				
				</div>
				</form>
			</div>
		</section>
		<section id="result"></section>
	</div>