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
                                
                                     <form  method="POST" action="<?php echo base_url(); ?>admin/saveQuestion" enctype="multipart/form-data" >   
                                         <input type="hidden" name="questionID" value="<?php echo ($question_data->questionID)?$question_data->questionID:''; ?>" >
                                       
                                                
                                                
                                          <div class="col-lg-10">
                                           <fieldset class="form-group ">
                                            <label class="form-label ">  Question</label>

                                            <input type="text" class="form-control" id="question_data" name="question_data" value="<?php  echo ($question_data->questionText)?$question_data->questionText:'';  ?>" placeholder="Enter Question"/>

                                             </fieldset>  
                                            </div>
                                               
                                        

                                       <div class=" col-lg-10"> 
                                          <fieldset class="form-group">
                                              <label class="form-label "> Answer</label>

                                                  <textarea rows='4'   name="answer_data" class="form-control"><?php  echo  ($question_data->answerText) ?$question_data->answerText : '';?></textarea>

                                          </fieldset>
                                      </div>
                                        <div class=" col-lg-10"> 
                                                <fieldset class="form-group">
                                                   
                                                    <div class="checkbox-bird">
								<input type="checkbox" id="check-bird-9" <?php  echo ($question_data->status)?'checked':''; ?> name="status" />
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