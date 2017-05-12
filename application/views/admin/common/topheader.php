<header class="site-header">
    <div class="container-fluid">
        <a href="<?php echo base_url($home_url)?>" class="site-logo">
         	<img class="hidden-md-down" src="<?php echo base_url()?>assets/admin/img/trivialworks.png" alt=""> 
         	<img class="hidden-lg-up" src="<?php echo base_url()?>assets/admin/img/login-box.png" alt="">       	            
        </a>
        <button class="hamburger hamburger--htla">
            <span>toggle menu</span>
        </button>
        <div class="site-header-content">
            <div class="site-header-content-in">
                <div class="site-header-shown">
                    <div class="dropdown user-menu">
                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo base_url()?>assets/admin/img/avatar-2-64.png" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                        	<a class="dropdown-item" href="javascript:;">Welcome, <?php echo $this->session->all_userdata()['fname']?></a>
                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-user"></span>Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo base_url('logout'); ?>"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
                        </div>
                    </div>
                </div><!--.site-header-shown-->               
            </div><!--site-header-content-in-->
        </div><!--.site-header-content-->
    </div><!--.container-fluid-->
</header><!--.site-header-->