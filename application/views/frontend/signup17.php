<!-- start: CSS REQUIRED FOR THIS PAGE ONLY  -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/frontend/plugins/bootstrap-social-buttons/social-buttons-3.css">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY  -->

<section class="wrapper padding50">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="center"> Create job seeker account</h1>	
				<p class="center">
						Culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus.
					</p>			
				<hr>
			</div>
		</div>

		<div class="row">		
			<div class="col-md-offset-1 col-md-6 jh-form">
				<!-- BEGIN FORM-->			
				<div id="message"><?php echo $this->session->flashdata('msg'); ?></div>		
				<form role="form" id="jhsignupform" method="post" class="horizontal-form margin-bottom-40" action="<?php echo base_url('user/signup');?>">
					<div class="form-group">
						<label class="control-label">
							First Name <span class="symbol required"></span>
						</label>
						<input type="text" placeholder="First Name" value="<?php echo $firstname;?>" class="form-control" id="firstname" name="firstname">
					</div>
					<div class="form-group">
						<label class="control-label">
							Last Name <span class="symbol required"></span>
						</label>
						<input type="text" placeholder="Last Name" class="form-control" value="<?php echo $last_name;?>" id="lastname" name="lastname">
					</div>
					<div class="form-group">
						<label class="control-label">
							Email <span class="symbol required"></span>
						</label>
						<input type="text" placeholder="Email" class="form-control" value="<?php echo $email;?>" id="email" name="email">
					</div>
					<div class="form-group">
						<label class="control-label">
							Phone <span class="symbol required"></span>
						</label>
						<input type="text" placeholder="Phone" class="form-control"  id="phone" value="<?php echo $phone;?>" name="phone">
					</div>
					<div class="form-group">
						<label class="control-label">
							Password <span class="symbol required"></span>
						</label>
						<input type="password" placeholder="Password" class="form-control" id="password" name="password">
					</div>
					<div class="form-group">
						<label class="control-label">
							Confirm Password  <span class="symbol required"></span>
						</label>
						<input type="password" placeholder="Confirm Password" class="form-control" id="password_again" name="password_again">
					</div>							
					<button class="btn btn-main-color" type="submit" >
						Sign Up <i class="fa fa-arrow-circle-right"></i>
					</button>
					<a class="text-muted right" href="<?php echo base_url()?>signin"><span>Already have account ?  Click Here</span></a>
					<?php 
						if(!empty($facebookid)){?>
						<input type="hidden" value="<?php echo $facebookid ?>" name="fid">
						<input type="hidden" value="<?php echo $profile_pic ?>" name="fpic">
					<?php }	?>											
				</form>
				<!-- END FORM-->
			</div>
			
			<div class="col-md-offset-1 col-md-4">
				<aside class="sidebar">
					<h5 class="col-md-9 top">Register here to get your profile job.</h5>	
					<img class="img-thumbnail" src="<?php echo base_url('assets/frontend/images/Searching.jpg') ?>" />
				</aside>
			</div>
		</div>
	</div>
</section>