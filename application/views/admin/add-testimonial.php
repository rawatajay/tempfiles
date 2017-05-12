         <div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2><?php echo $page_name?></h2>							
						</div>
					</div>
				</div>
			</header>
                        <section class="box-typical">
                         <div class=" card-block text-block-typical">
                                <!--						<div class="col-xl-12">-->
                                <div class="row ">
                                    <div class="col-md-12">
                                        
                                        
                                        
                                     <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
                                
                                     <form  method="POST" action="<?php echo base_url(); ?>admin/saveTestimonial" enctype="multipart/form-data" >   
                                         <input type="hidden" name="testiID" value="<?php  echo ($test_data->testmonialID)?$test_data->testmonialID:'';  ?>"/>
                                                <div class=" col-lg-10"> 
                                                <fieldset class="form-group">
                                                    <label class="form-label "> Username</label>

                                                    <input type="text" class="form-control" id="testimonialTitle" name="userName" value="<?php  echo ($test_data->userName)?$test_data->userName:'';  ?>" placeholder="Enter Title"/>

                                                </fieldset>
                                            </div>       

                                            

                                       <div class=" col-lg-10"> 
                                          <fieldset class="form-group">
                                              <label class="form-label ">Content</label>

                                                  <textarea rows='5'   name="Content" class="form-control"><?php  echo  ($test_data->testmonialDescription) ?$test_data->testmonialDescription : '';?></textarea>

                                          </fieldset>
                                      </div>
                                    
                                        <div class=" col-lg-10"> 
                                                <fieldset class="form-group">
                                                   
                                                    <div class="checkbox-bird">
								<input type="checkbox" id="check-bird-9" <?php  echo ($test_data->status)?'checked':''; ?> name="status" />
								<label for="check-bird-9">Status</label>
							</div>
                                                </fieldset>
                                            </div>          
                                        
                                              <div class="col-lg-10">
                                                  <input type="submit" class="btn btn-inline btn-primary btn-rounded pull-right" value="Save Change" name="Save" />   
                                        </div>
                                
                                           
                                        </form>  
                                      
                                      
                                        
                                    </div><!--.row-->
                                </div>
                                
                               
                            </div>
                     </section>
		</div><!--.container-fluid-->
</div><!--.page-content-->
<script>
</script>   