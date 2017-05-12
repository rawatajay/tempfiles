<!-- start: CSS REQUIRED FOR THIS PAGE ONLY  -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/frontend/plugins/bootstrap-social-buttons/social-buttons-3.css">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY  -->

<section class="wrapper padding50">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="center">Choose a new password</h1>								
				<hr>
			</div>
		</div>
		<div class="row">		
			<div class="col-md-offset-3 col-md-6 jh-form">
				<div id="message"><?php echo $this->session->flashdata('msg'); ?></div>	
				<!-- BEGIN FORM-->				
				<form role="form" method="post" id="jhsetpasswordform" class="horizontal-form margin-bottom-40" action="<?php echo base_url('user/setpassword/'.$code);?>">					
					<div class="form-group">
						<label class="control-label">
							Password <span class="symbol required"></span>
						</label>
						<input type="password" placeholder="Password" class="form-control" id="password" name="password">
						
					</div>
					<div class="form-group">
						<label class="control-label">
							Confirm Password <span class="symbol required"></span>
						</label>
						<input type="password" placeholder="Confirm Password" class="form-control" id="password_again" name="password_again">
						
					</div>															
					<button class="btn btn-main-color btn-block" type="submit">
						Submit <i class="fa fa-arrow-circle-right"></i>
					</button>					
				</form>
				<!-- END FORM-->
			</div>		
		</div>
	</div>
</section>