<!-- start: FOOTER -->
		<footer id="footer">			
			<div class="footer-copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<a class="logo" href="<?php echo base_url();?>">
								JOB <i class="fa fa-briefcase"></i> <span style="color:#EF6C00">HUNTER</span>
							</a>
						</div>
						<div class="col-md-4">
							<p>
								<?php echo COPYRIGHT ?>
							</p>
						</div>
						<div class="col-md-6">
							<nav id="sub-menu">
								<ul>
									<li>
										<a href="<?php echo base_url();?>aboutus">
											About Us
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>contact">
											Contact Us
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>terms-condition">
											Terms & Condition
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>privacy-policy">
											Privacy Policy
										</a>
									</li>									
									<li >
										<a target="_blank" href="http://www.twitter.com">
											<i class="fa fa-twitter"></i>
										</a>
									</li>
									<li class="tooltips" data-original-title="Facebook" data-placement="bottom">
										<a target="_blank" href="http://facebook.com" data-original-title="Facebook">
											<i class="fa fa-facebook"></i>
										</a>
									</li>
									<li class="tooltips" data-original-title="LinkedIn" data-placement="bottom">
										<a target="_blank" href="http://linkedin.com" data-original-title="LinkedIn">
											<i class="fa fa-linkedin"></i>
										</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<a id="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>
		<!-- end: FOOTER -->
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<script src="assets/plugins/html5shiv.js"></script>
		<script type="text/javascript" src="assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="<?php echo base_url()?>assets/frontend/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
		<!--<![endif]-->
		<script src="<?php echo base_url()?>assets/frontend/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/jquery.transit/jquery.transit.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/jquery.appear/jquery.appear.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url()?>assets/frontend/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/flex-slider/jquery.flexslider.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/stellar.js/jquery.stellar.min.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/colorbox/jquery.colorbox-min.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/select2/select2.min.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/js/index.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Index.init();
				$.stellar();
				FormWizard.init();
			});
		</script>		
		<?php if(isset($page_slug) && $page_slug == "contact" ){?>
		<!-- Start: JS used in contact page -->
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/gmaps/gmaps.js"></script>
		<!-- End: JS used in this page -->
		<script>
			jQuery(document).ready(function() {				
				Main.init();
				map = new GMaps({
					div: '#map',
					zoom: 16,
					lat: 26.844028,
					lng: 80.952803,	
								
				});
				map.addMarker({
					lat: 26.844028,
					lng: 80.952803,										
				});				
			});
		</script>
		<?php } ?>
		<?php if(isset($page_slug) && $page_slug == "jobseeker" ){?>
		<script type="text/javascript">
			$(".search-select").select2({		            
				  containerCssClass: 'tpx-select2-container',
				  dropdownCssClass: 'tpx-select2-drop select2-blue'
		    });
		</script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
		<script src="<?php echo base_url()?>assets/frontend/js/form-wizard.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){				
				$('.navbar').remove();
				$('.page-top').remove();
				$('.footer-copyright').remove();
				$('.footer').remove();								
			});
			
		</script>
		<style type="text/css">
		body {
			background-image: url('<?php echo base_url()?>assets/frontend/images/image09.png');
			padding-top: 0 !important;
		}
		</style>
		<?php }?>

	</body>
</html>