<!-- start: HEADER -->
<header class="single-menu">
	<div role="navigation" class="navbar navbar-default navbar-fixed-top">
		<!-- start: TOP NAVIGATION CONTAINER -->
		<div class="container">
			<div class="navbar-header">
				<!-- start: RESPONSIVE MENU TOGGLER -->
				<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- end: RESPONSIVE MENU TOGGLER -->
				<!-- start: LOGO -->
				<a class="navbar-brand" href="<?php echo base_url(); ?>">
					JOB<i class="fa fa-briefcase"></i><span style="color:#EF6C00">HUNTER</span>
				</a>
				<!-- end: LOGO -->
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li <?php if($this->uri->segment(1) == "") echo "class='active'"; ?> >
						<a href="<?php echo base_url(); ?>">
							Home
						</a>
					</li>
					<li <?php if($this->uri->segment(1) == "aboutus") echo "class='active'"; ?>>
						<a href="<?php echo base_url();?>aboutus">
							About Us
						</a>
					</li>					
					<li <?php if($this->uri->segment(1) == "blog") echo "class='active'"; ?>>
						<a href="<?php echo base_url();?>blog">
							Blog
						</a>
					</li>
					<li <?php if($this->uri->segment(1) == "contact") echo "class='active'"; ?>>
						<a href="<?php echo base_url();?>contact">
							Contact Us
						</a>
					</li>
					<?php echo "asdad".$this->session->all_userdata()['userType'] ; if(!empty($this->session->all_userdata()['userId']) && $this->session->all_userdata()['userType'] != '1'){?>
					<li <?php if($this->uri->segment(1) == "signup") echo "class='active'"; ?>>
						Welcome, <?php echo $this->session->all_userdata()['fname'].' '.$this->session->all_userdata()['lname']?> Singh
					</li>
					<li <?php if($this->uri->segment(1) == "signin") echo "class='active'"; ?>>
						<a href="<?php echo base_url('user/logout'); ?>">
							Logout
						</a>
					</li>
					<? }else{?>
					<li <?php if($this->uri->segment(1) == "signup") echo "class='active'"; ?>>
						<a href="<?php echo base_url();?>signup">
							Sign Up
						</a>
					</li>
					<li <?php if($this->uri->segment(1) == "signin") echo "class='active'"; ?>>
						<a href="<?php echo base_url();?>signin">
							Login
						</a>
					</li>
					<?php }?>
									
				</ul>
			</div>
		</div>
		<!-- end: TOP NAVIGATION CONTAINER -->
	</div>
</header>
<!-- end: HEADER -->