<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */
?>

<?php get_sidebar('footerfull'); ?>

	<div class="wrapper wrapper-footer" id="wrapper-footer">
	    
	    <div class="container-fluid" >
	
	        <footer class="row" style="background: white;">
		        <?php if( is_single() || is_singular( 'programmes' ) ) : ?>				
				<?php endif; ?>
					<div class="col-sm-12 paddingTop30">
						<div class="">
							<div class="col-md-4 noPaddingL site-footer" role="contentinfo">
							    <a href="https://www.goforenicbc.eu/" target="_blank">
							        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/goforenicbc.gif" alt="Go for ENI CBC" class="img-fluid" style="max-width:200px;">						    
								    <div class="paddingRight30 paddingTop20">
									    <small class="">
									    	<strong>Online learning platform</strong> on Cross-Border Cooperation under the European Neighbourhood Instrument! <i class="fa fa-long-arrow-right" aria-hidden="true"></i></small>
									</div>
								</a> 
							</div>
							<div class="col-md-2"></div>
							<div class="col-md-6 noPaddingL site-footer" role="contentinfo">
								<div class="row">
								    <div class="col-xs-12 site-info marginBot30">
								        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-flag-europe.svg" alt="European Union">
								        <br><small class="text-muted">A project funded by the<br>European Union</small>
								    </div>
							    </div>							    
								<div class="row">
								    <div class="col-xs-12 site-info">
								        <a href="http://www.particip.de/" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-particip.png" alt="Particip"></a>
								        <small class="text-muted">Implemented by a<br>consortiumled by Particip</small>
								    </div>
								</div>
							</div>
						</div>							
					</div>	

	        </footer><!-- row end -->
	        
	    </div><!-- container end -->
	    
	</div><!-- wrapper end -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

<div id="newsletter-modal">
	<a class="btnclose"></a>
	<div class="d-flex justify-content-between align-items-stretch">
		<div class="leftSide p-4">
			<h4 class="col col-md-12 col-lg-11 col-xl-10">Get fresh stories<br class="hidden-xl-down"> from the field that<br class="hidden-xl-down"> challenge you to<br class="hidden-xl-down"> rethink the world.</h4>
    	</div>
		<div class="rightSide p-4 pl-5">
			<div id="no-notify" class="no-notify paddingx15 col-xl-10">
				<form action="https://sixtytwo.createsend.com/t/r/s/khhyeu/" method="post" id="newsletterForm" class="newsletter-modal-form">
					<h4 class="hidden-md-up">Get fresh stories from the field that challenge you to rethink the world.</h4>
					<div class="form-group input-group-lg">
						<label class="sr-only" for="fieldName">Name</label>
						<input type="name" class="form-control" id="fieldName" placeholder="Your name" name="cm-name" >
					</div>
					<div class="form-group input-group-lg">
						<label class="sr-only" for="fieldEmail">Your Email address</label>
						<input type="email" class="form-control" id="fieldEmail" placeholder="Enter email" name="cm-khhyeu-khhyeu">
					</div>
					<div class="form-check paddingTop10">
						<input class="form-check-input" type="checkbox" value="" id="fieldConsent" required>
						<label class="form-check-label" for="defaultCheck1">
						I would like to receive information on ENI CBC programmes and TESIM activities. View our <a href="<?php echo get_page_link(2547); ?>">privacy policy</a>
						</label>
					</div>
					<button type="submit" class="btn btn-lg btn-outline-secondary">Get <span class="hidden-md-down">ENI-CBC </span>Updates</button>
				</form>
			</div>   						
			<div id="notify-success" class="notify-msg col col-md-12 col-lg-11 col-xl-10">
		    	<h4><i class="fa fa-smile-o fa-lg fa-pull-left" aria-hidden="true"></i> <strong>Subscription succeed,</strong> You're all set to receive our newsletter.</h4>
			</div>
			<div id="notify-failed" class="notify-msg col col-md-12 col-lg-11 col-xl-10">
				<h4><i class="fa fa-meh-o fa-lg fa-pull-left" aria-hidden="true"></i> <strong>Oops,</strong> Your email seems incorrect. Please try again.</h4>
			</div>
		</div>
	</div>    
</div>


<a href="#0" class="cd-top"><i class="fa fa-angle-up"></i></a>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-85135810-1', 'auto');
  ga('send', 'pageview');
</script>

</body>

</html>
