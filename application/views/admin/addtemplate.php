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
                                      <?php  if(empty($tempData)) {
                                          
                                          $act=base_url()."admin/createtemplate";
                                      }else{  $act=base_url()."admin/updateTemplate/".$tempData->id; }  ?>
                                        <form  method="POST"  id="tempform" action="<?php  echo $act; ?>" >   
                                            
                                            <div class=" col-lg-10"> 
                                                <fieldset class="form-group">
                                                    <label class="form-label ">  Template Name</label>

                                                    <input type="text" class="form-control" id="templateName" name="templateName" value="<?php echo ($tempData->name)?$tempData->name:'';  ?>" placeholder="Template Name"/>

                                                </fieldset>
                                            </div>       

<!--                                           <div class=" col-lg-10"> 
                                                <fieldset class="form-group">
                                                    <label class="form-label ">  Template</label>
                                                    <div class="summernote-theme-5">
                                                        <textarea rows='10'   name="templateData" class="summernote"><?php //  echo  ($tempData->content) ? stripslashes($tempData->content) : '';?></textarea>
                                                    </div>
                                                </fieldset>
                                            </div>-->
                                            
                                            
                                            
                                              <div class=" col-lg-10"> 
                                                <fieldset class="form-group">
                                                    <label class="form-label ">  Template</label>
                                                  
                                                        <textarea rows='10'   name="templateData" class="ckeditor"><?php  echo  ($tempData->content) ?$tempData->content : '';?></textarea>
                                                    
                                                </fieldset>
                                            </div>
                                            

                                             <div class=" col-lg-10"> 
                                                <fieldset class="form-group">
                                                   
                                                    <div class="checkbox-bird">
								<input type="checkbox" id="check-bird-9" <?php  echo ($tempData->status)?'checked':''; ?> name="status" />
								<label for="check-bird-9">Status</label>
							</div>
                                                </fieldset>
                                            </div>  
                                            <input type="hidden" name="tempID" value="<?php echo ($tempData->id)?($tempData->id):''; ?>" />   
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
