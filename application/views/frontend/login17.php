<!-- start: CSS REQUIRED FOR THIS PAGE ONLY  -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/frontend/plugins/bootstrap-social-buttons/social-buttons-3.css">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY  -->

<section class="wrapper padding50">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="center"> Sign In to job seeker account</h1>	
				<p class="center">
						Culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus.
					</p>			
				<hr>
			</div>
		</div>
		<div class="row">		
			<div class="col-md-offset-3 col-md-6 jh-form">
				<div id="message"><?php echo $this->session->flashdata('msg'); ?></div>	
				<!-- BEGIN FORM-->
				<a href="<?php echo $login_url ?>"> <button class="btn btn-facebook">
					<i class="fa fa-facebook"></i>
					| Sign In with Facebook
				</button></a>
				
				<hr>
				<form role="form" method="post" id="jhloginform" class="horizontal-form margin-bottom-40" action="<?php echo base_url('user/login');?>">					
					<div class="form-group">
						<label class="control-label">
							Email <span class="symbol required"></span>
						</label>
						<input type="text" placeholder="Email" class="form-control" id="email" name="email">
					</div>
					<div class="form-group">
						<label class="control-label">
							Password <span class="symbol required"></span>
						</label>
						<input type="password" placeholder="Password" class="form-control" id="password" name="password">
					</div>										
					<button class="btn btn-main-color btn-block" type="submit">
						Sign In <i class="fa fa-arrow-circle-right"></i>
					</button>
					<p><a href="<?php echo base_url('forgot-password') ?>"><span>Forgot Password ? Click Here</span></a>
					<a class="text-muted right" href="<?php echo base_url()?>signup"><span>Does't have account ? Click here.</span></a>
					</p>
				</form>
				<!-- END FORM-->
			</div>		
		</div>
	</div>
</section>