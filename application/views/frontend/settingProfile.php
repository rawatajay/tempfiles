<style>
    .pading-three{ padding: 15px;}
</style>	

<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 col-lg-push-3 col-md-12">
					<section class="box-typical">
						<header class="box-typical-header-sm">Setting Profile</header>
						<article class="profile-info-item">
							
							<div class="text-block text-block-typical">
								<div class="col-xl-12">
	               					<div class="row m-t-lg">                    
                                                                <div class="col-md-12">
                                                                <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
                                                                       
                                                                      <form class="formvalidate"  method="POST" action="<?php echo base_url()?>user/editSettingProfile" enctype="multipart/form-data">
                                                                       
                                                                            <div class="form-group pading-three">
                                                                         
                                                                                <div class="form-control-wrapper col-md-6">
                                                                                    
                                                                                    <label class="form-label " for="Resume">Resume</label>
                                                                                     
                                                                                </div>
                                                                               <div class="form-control-wrapper  col-md-6">
                                                                                  <span class="btn btn-rounded  btn-info btn-file">
                                                                                        <span>Choose file</span>
                                                                                        <input type="file" name="resume" >
                                                                                    </span>
                                                                               </div>
                                                                            
                                                                      
                                                                              </div>
                                                                          
                                                                          <div class="form-group pading-three">
                                                                         
                                                                                <div class="form-control-wrapper col-md-6">
                                                                                    <label class="form-label" for="highschool">High School Mark Sheet</label>
                                                                                     
                                                                                </div>
                                                                               <div class="form-control-wrapper col-md-6">
                                                                                  <span class="btn btn-rounded  btn-file">
                                                                                        <span>Choose file</span>
                                                                                        <input type="file" name="hsmarksheet" >
                                                                                    </span>
                                                                               </div>
                                                                            
                                                                      
                                                                        </div>
                                                                        <div class="form-group pading-three">
                                                                            
                                                                            
                                                                             <div class=" col-md-6">
                                                                                    <label class="form-label" for="Intermediate">Intermediate Mark Sheet</label>
                                                                                      
                                                                                </div>
                                                                                <div class=" col-md-6 ">
                                                                                      <span class="btn btn-rounded btn-file">
                                                                                            <span>Choose file</span>
                                                                                            <input type="file" name="intmarksheet" >
                                                                                        </span>
                                                                                   </div>
                                                                            
                                                                           </div>
                                                                       
                                                                           <div class="form-group pading-three">
                                                                                 <div class="col-md-6">
                                                                                    <label class="form-label" for="other certification">Other Certification</label>
                                                                                     
                                                                                </div>
                                                                                   <div class=" col-md-6">
                                                                                      <span class="btn btn-rounded btn-file">
                                                                                            <span>Choose file</span>
                                                                                            <input type="file" name="otherCertificate" >
                                                                                        </span>
                                                                                   </div>	
                                                                           </div>
                                                                     
                                                                           <div class="form-group pading-three">
                                                                               
                                                                                <div class="form-control-wrapper col-md-6">
                                                                                   
                                                                                     <label class="form-label " for="postgraduaction">Notify By</label>
                                                                                    </div>    
                                                                            
                                                                                <div class="form-control-wrapper col-md-6">
                                                                                 <div class="checkbox-bird col-md-4 green">
								                   <input type="checkbox" name="notifyByEmail" id="check-bird-9" <?php if($settingProfile->notifyByEmail)echo 'checked';  ?>  />
								                        
                                                                                   <label for="check-bird-9">Email</label> </div>
                                                                                    
                                                                                     <div class="checkbox-bird col-md-4 green">
								                   <input type="checkbox" name="notifyBySMS" id="check-bird-111"  <?php if($settingProfile->notifyBySMS)echo 'checked';  ?> />
								                        <label for="check-bird-111">SMS</label> </div>
                                                                                    
                                                                                      <div class="checkbox-bird col-md-4 green">
								                   <input type="checkbox" name="notifyByCall" id="check-bird-999" <?php if($settingProfile->notifyByCall)echo 'checked';  ?>  />
								                        <label for="check-bird-999">Call</label> </div>
                                                                                </div>
                                                                        </div>
                                                                           <div class="form-group row_padding">
                                                                               
                                                                                <div class="form-control-wrapper col-md-6">
                                                                                     <label class="form-label" for="Available for Interview">Available For Interview</label>
                                                                                        
                                                                                </div>
                                                                                <div class="form-control-wrapper col-md-6">
                                                                                 <div class="radio col-md-4 ">
                                                                                    <input type="radio" name="optionsRadios" id="radio-1" <?php if(isset($settingProfile->isAvailableF2F)&& $settingProfile->isAvailableF2F ==TRUE ) echo 'checked';  ?> value="1">
                                                                                        <label for="radio-1">Yes </label>
                                                                               </div>
                                                                                <div class="radio col-md-4">
                                                                                        <input type="radio" name="optionsRadios" id="radio-2" <?php if(isset($settingProfile->isAvailableF2F)&& $settingProfile->isAvailableF2F ==FALSE ) echo 'checked';  ?>  value="0">
                                                                                        <label for="radio-2">No</label>
                                                                                </div>
                                                                                </div>
                                                                        </div>
                                                                          
                                                                    

                                                                    <div class="form-group row_padding">
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
        
       