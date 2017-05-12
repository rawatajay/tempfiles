	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 col-lg-push-3 col-md-12">
					<section class="box-typical">
						<header class="box-typical-header-sm">Edit Profile</header>
						<article class="profile-info-item">
							
							<div class="text-block text-block-typical">
								<div class="col-xl-12">
	               					<div class="row m-t-lg">
										<div class="col-md-12">
										<div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
											<form class="formvalidate"  method="POST" action="<?php echo base_url()?>user/updateProfile" enctype="multipart/form-data">
												<div class="form-group">
													<label class="form-label" for="firstname">First Name</label>
													<div class="form-control-wrapper">
														<input id="firstname"
															   class="form-control"
															   value="<?php echo $this->session->all_userdata()['fname'];?>"
															   name="firstname"
															   type="text" data-validation="[MIXED]"
															   data-validation-message="$ is required.">
													</div>
												</div>
												<div class="form-group">
													<label class="form-label" for="lastname">Last Name</label>
													<div class="form-control-wrapper">
														<input id="lastname"
															   value="<?php echo $this->session->all_userdata()['lname'];?>"
															   class="form-control"
															   name="lastname"
															   type="text" data-validation="[MIXED]"
															   data-validation-message="$ is required.">
													</div>
												</div>
												<div class="form-group">
													<label class="form-label" for="email">Email</label>
													<div class="form-control-wrapper">
														<input id="email"
															   class="form-control"
															   name="email"
															   value="<?php echo $this->session->all_userdata()['email'];?>"
															   type="text"
															   data-validation="[EMAIL]">
													</div>
												</div>
												<div class="form-group">
													<label class="form-label" for="profilepic">Profile Pic</label>
													<div class="form-control-wrapper">
														<input id="profilepic"
															   name="profilepic"
															   type="file" >
													</div>
												</div>
												<div class="form-group">
													<button type="submit" class="btn">Update</button>
												</div>
											</form>
										</div>					
									</div><!--.row-->
	            				</div>
							</div>
						</article><!--.profile-info-item-->
					</section><!--.box-typical-->

				
				
				</div><!--.col- -->

				<?php include_once("common/jobseekerSidebar.php") ?>
				<?php include_once("common/jobseekerLeftSidebar.php") ?>
			
			</div><!--.row-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->