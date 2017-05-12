<div class="page-content">
		<div class="container-fluid">
			<div class="row">
                            
                         
                                
                             
				<div class="col-lg-9 col-lg-push-3 col-md-12">
 
                                      <div id="message"><?php // echo $this->session->flashdata('msg'); ?></div>  
					 <header class="section-header">
				            <div class="tbl">
					      <div class="tbl-row">
						<div class="tbl-cell">	
                                                                
                                                    <a href="<?php echo base_url(); ?>user/profile">
                                                        <button style="float: right"  type="button" class="btn btn-rounded btn-inline">Edit Profile</button>
                                                    </a>  
                                                
						</div>
					</div>
				      </div>
			           </header>
				      
                                    
                                    <section class="box-typical">
                                        <header class="box-typical-header profile_header">
					  <div class="tbl-row">
						<div class="tbl-cell tbl-cell-title">
						<h3>Personal Detail</h3>
						</div>
					   </div>
				         </header>
                                        <article class="">

                                            <div class="text-block text-block-typical">
                                                <!--						<div class="col-xl-12">-->
                                                <div class="row ">
                                                    <div class="col-md-12">
                                                      
                                                           <table id="table-edit" class="table table-bordered table-hover">
			                        	
                                                        <tbody>
                                                         <tr id="1">

                                                                 <th > First Name  </th>
                                                                 <td class="color-blue-grey-lighter "> <?php echo $this->session->all_userdata()['fname']; ?></td>
                                                                 
                                                         </tr>
                                                         <tr id="1">

                                                                 <th >Last Name  </th>
                                                                 <td class="color-blue-grey-lighter "><?php echo $this->session->all_userdata()['lname']; ?></td>
 

                                                                 </tr>
                                                                 <tr id="1">

                                                                 <th > Email</th>
                                                                 <td class="color-blue-grey-lighter "> <?php echo $this->session->all_userdata()['email']; ?></td>
 

                                                                 </tr>
                                                     
                                                        </tbody>
                                                   </table>     
                                                       
                                                     
                                                    </div>					
                                                </div><!--.row-->
                                                <!--	            				                 </div>-->
                                            </div>
                                        </article><!--.profile-info-item-->
                                        
                                    </section><!--.box-typical-->
                                    
                                       <section class="box-typical">
                                        <header class="box-typical-header profile_header">
					  <div class="tbl-row">
						<div class="tbl-cell tbl-cell-title">
							<h3>Academic Detail</h3>
						</div>
					   </div>
				         </header>
                                         <article class="">

                                            <div class="text-block text-block-typical">
                                                <div class="col-xl-12">
                                                    <div class="row  ">  
                                                        
                                                        <table id="table-edit" class="table table-bordered table-hover">
			                        	<thead>
                                                            <tr>

                                                         <th>Qualification</th>
                                                         <th>Board/University</th>

                                                         <th >
                                                           Marks(%)	
                                                         </th>
                                                         </tr>
                                                     </thead>
                                                        <tbody>
                                                         <tr id="1">

                                                                 <td class="tabledit-view-mode"> High School  </td>
                                                                 <td class="color-blue-grey-lighter ">  <?php echo $academicDetail->highSchoolBoardCollege; ?></td>
                                                                 <td class="table-icon-cell">  <?php echo $academicDetail->highSchoolPercentage; ?></td>


                                                         </tr>
                                                         <tr id="1">

                                                                 <td class="tabledit-view-mode">Intermediate  </td>
                                                                 <td class="color-blue-grey-lighter "><?php echo $academicDetail->interBoardCollege; ?></td>
                                                                 <td class="table-icon-cell">  <?php echo $academicDetail->intermediatePercentage; ?></td>

                                                                 </tr>
                                                                 <tr id="1">

                                                                 <td class="tabledit-view-mode"> Graduation</td>
                                                                 <td class="color-blue-grey-lighter "> <?php echo ($academicDetail->graduateUniversityCollege)?$academicDetail->graduateUniversityCollege:'N/A'; ?></td>
                                                                 <td class="table-icon-cell"> <?php echo ($academicDetail->graduationPercentage)?$academicDetail->graduationPercentage:'N/A'; ?></td>

                                                                 </tr>
                                                         <tr id="1">

                                                                 <td class="tabledit-view-mode">Post Graduation</td>
                                                                 <td class="color-blue-grey-lighter "><?php echo ($academicDetail->pgUniversityCollege)?$academicDetail->pgUniversityCollege:'N/A'; ?></td>
                                                                 <td class="table-icon-cell"> <?php echo ($academicDetail->postGraduationPercentage)?$academicDetail->postGraduationPercentage:'N/A'; ?></td>

                                                                 </tr>        

                                                        </tbody>
                                                   </table>      
                                                     		
                                                    </div><!--.row-->
                                                </div>
                                            </div>
                                        </article><!--.profile-info-item-->
                                    </section><!--.box-typical-->
                                    
                                       <section class="box-typical">
                                        <header class="box-typical-header profile_header">
					  <div class="tbl-row">
						<div class="tbl-cell tbl-cell-title">
							<h3>Setting Profile</h3>
						</div>
					   </div>
				         </header>
                                        <article class="">

                                            <div class="text-block text-block-typical">
                                                <div class="col-xl-12">
                                                    <div class="row  ">  
                                                        
                                                        <table id="table-edit" class="table table-bordered table-hover">
			                        	<thead>
                                                            <tr>

                                                         <th>Description</th>
                                                         <th>Available </th>

                                                         <th >
                                                           Download	
                                                         </th>
                                                         </tr>
                                                     </thead>
                                                           <tbody>
                                                         <tr id="1">

                                                                 <td class="tabledit-view-mode"> Resume </td>
                                                                 <td class="color-blue-grey-lighter ">  <?php echo ($academicDetail->resumeURL)?'<label class="label label-success"> YES</label>':'<label class="label label-danger"> N/A</label>'; ?></td>
                                                                 
                                                                 
                                                                 
                                                                 
                                                                 <td class=" center">  <?php   $resumedata = explode(',',$academicDetail->resumeURL);
                                                                foreach ($resumedata as $key => $value) {
   
                                                                 echo ($value)?'<a href="'.$value.'" target="_blank" style="margin:8px;" > <i class="fa fa-download fa-2x"></i></a>':'---'; 
                                                                 
                                                                  }
                                                                 ?></td>


                                                         </tr>
                                                         <tr id="1">

                                                                 <td class="tabledit-view-mode">High School Marksheet </td>
                                                                 <td class="color-blue-grey-lighter "> <?php echo ($academicDetail->highSchoolMarksheet)?'<label class="label label-success"> YES</label>':'<label class="label label-danger"> N/A</label>'; ?></td>
                                                                 <td class="table-icon-cell">  <?php echo ($academicDetail->highSchoolMarksheet)?'<a href="'.$academicDetail->highSchoolMarksheet.'" target="_blank" style="margin:8px;"  > <i class="fa fa-download fa-2x"></i></a>':'---'; ?></td>

                                                                 </tr>
                                                                 <tr id="1">

                                                                 <td class="tabledit-view-mode">Inter Marksheet  </td>
                                                                 <td class="color-blue-grey-lighter ">  <?php echo ($academicDetail->intermediateMarksheet)?'<label class="label label-success"> YES</label>':'<label class="label label-danger"> N/A</label>'; ?>                                                     </td>
                                                                 <td class="table-icon-cell">  <?php echo ($academicDetail->intermediateMarksheet)?'<a href="'.$academicDetail->intermediateMarksheet.'" target="_blank" style="margin:8px;"  > <i class="fa fa-download fa-2x"></i></a>':'---'; ?></td>

                                                                 </tr>
                                                         <tr id="1">

                                                                 <td class="tabledit-view-mode">Othert Certification  </td>
                                                                 <td class="color-blue-grey-lighter ">  <?php echo ($academicDetail->certification)?'<label class="label label-success"> YES</label>':'<label class="label label-danger"> N/A</label>'; ?>                                                     </td>
                                                                 <td class="table-icon-cell ">  <?php echo ($academicDetail->certification)?'<a href="'.$academicDetail->certification.'" target="_blank" style="margin:8px;"  > <i class="fa fa-download fa-2x"></i></a>':'---'; ?></td>

                                                                 </tr>        

                                                        </tbody>
                                                   </table>      
                                                     		
                                                    </div><!--.row-->
                                                </div>
                                            </div>
                                        </article><!--.profile-info-item-->
                                    </section><!--.box-typical-->

                                 </div>
                                   
                                
                                
				<?php  include_once("common/jobseekerSidebar.php") ?>
				<?php // include_once("common/jobseekerLeftSidebar.php") ?>
		          	
                        
				
				
			</div><!--.row-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->