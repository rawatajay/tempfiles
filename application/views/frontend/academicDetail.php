	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 col-lg-push-3 col-md-12">
					<section class="box-typical">
						<header class="box-typical-header-sm">Academic Detail</header>
						<article class="profile-info-item">
							
							<div class="text-block text-block-typical">
								<div class="col-xl-12">
	               					<div class="row m-t-lg">
                                                                        <div class="col-md-12">
                                                                        <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
                                                                       
                                                                                <form class="formvalidate"  method="POST" action="<?php echo base_url()?>user/editAcademicDetail" enctype="multipart/form-data">
                                                                                        <div class="form-group">
                                                                                                <label class="form-label" for="highschool">High School</label>
                                                                                                <div class="form-control-wrapper col-md-6">
                                                                                                        <input id="highSchoolPercentage"
                                                                                                                   class="form-control"
                                                                                                                   placeholder ="Percentage"
                                                                                                                   name="highSchoolPercentage"
                                                                                                                   type="text" data-validation="[NOTEMPTY]"
                                                                                                                   data-validation-message="$ is required."  value="<?php echo $academicDetail->highSchoolPercentage?>" >
                                                                                                </div>
                                                                                                <div class="form-control-wrapper col-md-6">
                                                                                                        <input id="highSchoolcollege_univ"
                                                                                                                   class="form-control"
                                                                                                                   value="<?php echo $academicDetail->intermediatePercentage ?>"
                                                                                                                   placeholder ="Board/College"
                                                                                                                   name="highSchoolcollege_univ"
                                                                                                                   type="text" data-validation="[NOTEMPTY]" 
                                                                                                                   data-validation-message="$ is required."       >
                                                                                                </div>													
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                                <label class="form-label" for="inter">Intermediate</label>
                                                                                                <div class="form-control-wrapper col-md-6">
                                                                                                        <input id="interPercentage"
                                                                                                                   class="form-control"
                                                                                                                  
                                                                                                                   placeholder ="Percentage"
                                                                                                                   name="interPercentage"
                                                                                                                   type="text" data-validation="[NOTEMPTY]"  
                                                                                                                   data-validation-message="$ is required."  value="<?php echo $academicDetail->intermediatePercentage ?>" >
                                                                                                </div>
                                                                                                <div class="form-control-wrapper col-md-6">
                                                                                                        <input id="intercollege_univ"
                                                                                                                   class="form-control"
                                                                                                                   placeholder ="Board/College"
                                                                                                                   name="intercollege_univ"
                                                                                                                   type="text" data-validation="[NOTEMPTY]"  value="<?php echo $academicDetail->interBoardCollege; ?>"
                                                                                                                   data-validation-message="$ is required.">
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                                <label class="form-label" for="graduaction">Graduation</label>
                                                                                                <div class="form-control-wrapper col-md-6">
                                                                                                        <input id="graduactionPercentage"
                                                                                                                   class="form-control"
                                                                                                                   
                                                                                                                   placeholder ="Percentage"
                                                                                                                   name="graduactionPercentage"  value="<?php echo $academicDetail->graduationPercentage ; ?>"
                                                                                                                   type="text"
                                                                                                                   >
                                                                                                </div>
                                                                                                <div class="form-control-wrapper col-md-6">
                                                                                                        <input id="graduactioncollege_univ"
                                                                                                                   class="form-control"
                                                                                                                   placeholder ="Board/College"
                                                                                                                   name="graduactioncollege_univ"  value="<?php echo $academicDetail->graduateUniversityCollege ; ?>"
                                                                                                                   type="text" >
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                                <label class="form-label" for="postgraduaction">Post Graduation</label>
                                                                                                <div class="form-control-wrapper col-md-6">
                                                                                                        <input id="postgraduactionPercentage"
                                                                                                                   class="form-control"
                                                                                                                  
                                                                                                                   placeholder ="Percentage"
                                                                                                                   name="postgraduactionPercentage"   value="<?php echo $academicDetail->postGraduationPercentage; ?>"
                                                                                                                   type="text"
                                                                                                                   >
                                                                                                </div>
                                                                                                <div class="form-control-wrapper col-md-6">
                                                                                                        <input id="postgraduactioncollege_univ"
                                                                                                                   class="form-control"
                                                                                                                   placeholder ="Board/College"
                                                                                                                   name="postgraduactioncollege_univ" value="<?php echo $academicDetail->pgUniversityCollege; ?>"
                                                                                                                   type="text" >
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                                <label class="form-label" for="otherCertification">Other Certification</label>
                                                                                                <div class="form-control-wrapper col-md-12">
                                                                                                        <input id="postgraduactionPercentage"
                                                                                                                   class="form-control"
                                                                                                                  
                                                                                                                   placeholder ="other Certification"  value="<?php echo $academicDetail->otherCertification; ?>"
                                                                                                                   name="otherCertification"
                                                                                                                   type="text"
                                                                                                                   >
                                                                                                </div>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                                <div class="form-control-wrapper col-md-12">
                                                                                                <br>
                                                                                                        <button type="submit" class="btn ">Update</button>
                                                                                                </div>
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