<footer>
	<div class="container footer-wrapper">
		<div class="col-md-3 col-sm-6 col-xs-12 column">
			
			<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/gec_nit_raipur" data-widget-id="728530787000160256">Tweets by @gec_nit_raipur</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 column">
			<div class="fb-page" data-href="https://www.facebook.com/Alumni-Association-of-GEC-NIT-Raipur-409422002456155/" data-tabs="timeline" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"></div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 column">
			<!-- <h3>Social</h3>
			<ul>
				<a href="https://www.facebook.com/Gec-Nit-Raipur-Alumni-409422002456155"><li>Facebook</li></a>
				<a href="https://www.linkedin.com/in/gec-nit-raipur-alumni-association-018596b5"><li>LinkedIn</li></a>
				<a href="http://www.nitrr.ac.in/"><li>NIT Raipur</li></a>
			</ul>
			 -->
			<h3>Help</h3>
			<ul>
				<a href=""><li>Feedback</li></a>
				<a href=""><li>Report a Problem</li></a>
				<a href=""><li>Invite your Friends</li></a>
				<a href=""><li>Share this Page</li></a>
				<a href="https://www.facebook.com/groups/265449566804365"><li>Join Official Facebook Group</li></a>
				
			</ul>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12 column">
			<h3>Contact Us</h3>
			
			<address style="font-style: normal;">
        Alumni Association of GEC-NIT Raipur <br>  
        National Institute of Technology, Raipur<br>
        G.E. Road, Raipur<br>
        Chhatisgarh - 492010<br>
        India
        <br>
        <br>
        <i class="fa fa-envelope"></i><a style="font-style: italic;" href="mailto:secretary@gecnitrralumni.org">secretary@gecnitrralumni.org</a> <br>
        <i class="fa fa-phone"></i><a style="font-style: italic;">+91 771 225 3819</a> <br>
      </address>
		</div>
	</div>
	<p class="copyright-info">&copy; Alumni Association GEC-NIT Raipur <?php echo date('Y') ?></p>
</footer>

<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.tinycarousel.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/owl.carousel.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.toast.min.js"></script>
<script src="<?=base_url()?>assets/js/main.js"></script>
<script src="<?=base_url()?>assets/js/homepage.js"></script>
<script src="<?=base_url()?>assets/js/register.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>


<?php if ($this->session->userdata('logged_in') || $this->session->userdata('logged_in_admin')) {
	 //if the user is logged in 
  if ($this->session->userdata('access_level') == 0) {
    // email not verified
    ?>
    <script>
    	$toast_msg = "<i class='fa fa-exclamation-circle'></i> You need to verify your email before you can have complete access. Please check your email for the verification link.</a>";
    </script>
    <?php
  }
  else if ($this->session->userdata('access_level') == 1) {
    // email verified but not approved by admin
    ?>
    <script>
    	$toast_msg = "<i class='fa fa-exclamation-circle'></i> Your registration is under consideration by the admin. It may take upto 24hrs for the approval.</a>";
    </script>
    <?php
  }?>
	<script>
	    $.toast({
	      text : $toast_msg,
	      hideAfter : false,
	      bgColor : '#D24242',              // Background color
	      textColor : '#eee',            // text color
	    });
	</script>
  <?php
}else{
  ?>
  
  <script>
  /*  $.toast({
      text : "<i class='fa fa-exclamation-circle'></i> Alumni need to reset passwords the first time they login on new website <a href='/forgot-password'>CLICK HERE</a>",
      hideAfter : false,
      bgColor : '#D24242',              // Background color for toast
      textColor : '#eee',            // text color
    }); */
  </script>
  <?php
}
?>
</body>
</html>

