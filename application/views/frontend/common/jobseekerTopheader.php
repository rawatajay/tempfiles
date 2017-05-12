<header class="site-header">
	    <div class="container-fluid">
	        <a href="#" class="site-logo">
	            <img class="hidden-md-down" src="<?php echo base_url()?>assets/admin/img/login-box.png" alt="">JOB HUNTER
	            <img class="hidden-lg-up" src="<?php echo base_url()?>assets/admin/img/login-box.png" alt="">
	        </a>
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
                
                
                
	        <div class="site-header-content">
	            <div class="site-header-content-in ">
	               <div class="site-header-shown">
	                  
	                    <div class="dropdown user-menu">

	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                        <?php if(!$this->session->all_userdata()['profilePic']) {?>
	                            <img src="<?php echo base_url()?>assets/admin/img/avatar-2-64.png" alt="">
	                        <?php } else{ ?>
	                        	<img src="<?php echo $this->session->all_userdata()['profilePic']?>" alt="">
	                        <?php }?>    
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="<?php echo base_url('myaccount'); ?>"><span class="font-icon glyphicon glyphicon-user"></span>Hi , <?php print_r($this->session->all_userdata()['fname']) ?></a>

	                            <a class="dropdown-item" onclick ="document.location.href = '<?php echo base_url('user/logout'); ?>';" href="javascript:;"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
	                        </div>
	                    </div>
	
	                </div> 
	
	              <div class="mobile-menu-right-overlay"></div>
	              	
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->
          
      <?php if($page_name!='user_email'){ ?>
        
       <ul class="main-nav nav nav-inline">
		<li class="nav-item"> 
            <a class="nav-link <?php   if($page_slug==="myaccount"){ echo 'active';} ?>" id="dashboard" href="<?php echo base_url() ?>myaccount"><span><i class="font-icon font-icon-dashboard"></i> </span>Dashboard</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php   if($page_slug==="profile"){ echo 'active';} ?> " id="profile" href="<?php echo base_url() ?>user/profile_view"> <span > <i class="font-icon font-icon-user"> </i></span> Profile</a>
		</li>
		<li class="nav-item">
                         
			<a class="nav-link  <?php   if($page_slug==="Datasetlist"){ echo 'active';} ?>" id="dataset" href="<?php echo base_url() ?>user/datasetList"> <span ><i class="font-icon font-icon-widget"></i></span> Dataset</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?php   if($page_slug==="Companylist"){ echo 'active';} ?>" id="company" href="<?php echo base_url() ?>user/companylist"> <span > <i class="font-icon font-icon-build"></i></span> Company</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?php   if($page_slug==="UserDatasetList"){ echo 'active';} ?>" id="tracking" href="<?php echo base_url() ?>user/userDatasetlistData"><span ><i class="font-icon font-icon-notebook"> </i></span> Tracking</a>
		</li>
                <li class="nav-item">
			<a class="nav-link  <?php   if($page_slug==="transaction_history"){ echo 'active';} ?>" href="<?php echo base_url() ?>user/payu_TransactionHistory"><span ><i class="font-icon font-icon-list-square"> </i></span> Transaction History</a>
		</li>
                
                <li class="nav-item">
			<a class="nav-link  <?php   if($page_slug==="payment_page"){ echo 'active';} ?>" href="<?php echo base_url() ?>user/userPaymentPage"><span ><i class="fa fa-rupee"> </i> </span>Recharge</a>
		</li>
		<li class="nav-item">

			<a class="nav-link" href="<?php echo base_url(); ?>user/getsocialsitesData"><span><i class="fa fa-user-plus"></i> </span> Invite Friend</a>
		</li>
		
		
		<li class="nav-item ">
			<a class="nav-link <?php if($page_slug==="question"){ echo 'active';} ?>" href="<?php echo base_url(); ?>user/getquestionData"><span><i class="fa fa-question-circle"></i> </span>Questions</a>
		</li>
              
	</ul>   
      <?php } ?>   
	
	