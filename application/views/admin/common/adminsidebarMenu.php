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
	        <li class="grey  with-sub <?php if($page_slug == "manage-employee") echo "opened"?>" >	           
	            <span>
	                <i class="font-icon glyphicon glyphicon-user"></i>
	                <span class="lbl">Manage Employee</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo base_url('admin/register_employee')?>"><span class="lbl">Register Employee</span></a></li>	                
	                <!-- <li><a href="<?php echo base_url('admin/create_account')?>"><span class="lbl">Create Employee Account</span></a></li>	 -->                
	                <li><a href="<?php echo base_url('admin/employee_list')?>"><span class="lbl">Employee List</span></a></li>	                
	            </ul>
	        </li>
	        <li class="grey with-sub <?php if($page_slug == "emp-leave") echo "opened"?>">
	            <a href="<?php echo base_url('admin/emp_leave')?>">
	                <i class="font-icon font-icon-users"></i>
	                <span class="lbl">Employee Leaves</span>
	            </a>	            
	        </li>
	        <li class="grey  with-sub <?php if($page_slug == "attandance") echo "opened"?>" >	           
	            <span>
	                <i class="font-icon glyphicon glyphicon-calendar"></i>
	                <span class="lbl">Manage Attandance</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo base_url('admin/upload_attendence_sheet')?>"><span class="lbl">Upload Sheet</span></a></li>	
	                <li><a href="<?php echo base_url('admin/getAllEmployeeAttendance')?>"><span class="lbl">Employee Attendance</span></a></li>                
	                	                
	            </ul>
	        </li>
	      <?php /*  <li class="grey  <?php if($page_slug == "jobtype") echo "opened"?>">
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