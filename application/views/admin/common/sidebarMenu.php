<div class="mobile-menu-left-overlay"></div>
	<nav class="side-menu">
	    <div class="side-menu-avatar">
	        <div class="avatar-preview avatar-preview-100">
	            <img src="<?php echo ($this->session->userdata('profilePic'))?$this->session->userdata('profilePic'):base_url().'assets/admin/img/avatar-2-64.png'; ?>" alt="">
	        </div>
	    </div>
	    <ul class="side-menu-list"> 
	        <li class="grey with-sub <?php if($page_slug == "dashboard") echo "opened"?>">
	            <a href="<?php echo base_url($home_url)?>">
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Dashboard</span>
	            </a>	            
	        </li>
	        <li class="  with-sub <?php if($page_slug == "leave-apply") echo "opened"?>" >	           
	            <span>
	                <i class="font-icon glyphicon glyphicon-user"></i>
	                <span class="lbl">Employee Leave</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo base_url('employee/leave_apply')?>"><span class="lbl">Apply Leave</span></a></li>
	            </ul>
	            <ul>
	                <li><a href="<?php echo base_url('employee/my_leave')?>"><span class="lbl">My Leave</span></a></li>
	            </ul>	             
	        </li>
	        <li class="grey with-sub <?php if($page_slug == "attandance") echo "opened"?>">
	            <a href="<?php echo base_url('employee/getMyAttendance')?>">
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">My Attandance</span>
	            </a>	            
	        </li>

	       <?php /* <li class="red  with-sub <?php if($page_slug == "user_jobseeker") echo "opened"?>" >	           
	            <span>
	                <i class="font-icon glyphicon glyphicon-user"></i>
	                <span class="lbl">Users</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo base_url('admin/jobseekerlist')?>"><span class="lbl">Jobseeker</span></a></li>	                
	            </ul>
	        </li>
	        <li class="grey  <?php if($page_slug == "jobtype") echo "opened"?>">
	            <a href="<?php echo base_url('admin/jobtypelist')?>">
	                <i class="font-icon font-icon-post"></i>
	                <span class="lbl">Job Type</span>
	            </a>	            
	        </li>
	        <li class="grey  <?php if($page_slug == "funtionaltype") echo "opened"?>">
	            <a href="<?php echo base_url('admin/functionalAreaList')?>">
	                <i class="font-icon font-icon-archive"></i>
	                <span class="lbl">Functional Area</span>
	            </a>	            
	        </li>
	        <li class="grey  <?php if($page_slug == "company") echo "opened"?>">
	            <a href="<?php echo base_url('admin/companylist')?>">
	                <i class="font-icon font-icon-build"></i>
	                <span class="lbl">Company</span>
	            </a>	            
	        </li>
	        <li class="grey  <?php if($page_slug == "dataset") echo "opened"?>">
	            <a href="<?php echo base_url('admin/datasetlist')?>">
	                <i class="font-icon font-icon-burger"></i>
	                <span class="lbl">Dataset</span>
	            </a>	            
	        </li>
            <li class="grey  <?php if($page_slug == "template") echo "opened"?>">
	            <a href="<?php echo base_url('admin/template')?>">
	                <i class="font-icon font-icon-burger"></i>
	                <span class="lbl">Template</span>
	            </a>	            
	        </li>
            <li class="grey  <?php if($page_name == "transaction_history") echo "opened"?>">
	            <a href="<?php echo base_url('admin/payu_TransactionHistory')?>">
	                <i class="font-icon font-icon-burger"></i>
	                <span class="lbl">Transaction</span>
	            </a>	            
	        </li>
            <li class="grey  <?php if($page_slug == "blog") echo "opened"?>">
	            <a href="<?php echo base_url('admin/blog')?>">
	                <i class="font-icon font-icon-page"></i>
	                <span class="lbl">Blog</span>
	            </a>	            
	        </li>
            <li class="grey  <?php if($page_slug == "testimonial") echo "opened"?>">
	            <a href="<?php echo base_url('admin/testimonial')?>">
	                <i class="font-icon font-icon-archive"></i>
	                <span class="lbl">Testimonial</span>
	            </a>	            
	        </li>
            <li class="grey  <?php if($page_slug == "question") echo "opened"?>">
	            <a href="<?php echo base_url('admin/question')?>">
	                <i class="font-icon font-icon-question"></i>
	                <span class="lbl">Question</span>
	            </a>	            
	        </li> */ ?>
	    </section>
	</nav><!--.side-menu-->