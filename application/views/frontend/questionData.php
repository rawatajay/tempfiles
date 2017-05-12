<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-lg-push-3 ">
              
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
                   
					<section class="widget widget-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                            
                                            <?php if(!empty($ques_data)){
                                                     foreach ($ques_data as $key => $data) {  ?>
                                            
						<article class="panel">
							<div class="panel-heading" role="tab" id="heading<?php echo $key+1; ?>">
								<a data-toggle="collapse"
								   data-parent="#accordion"
								   href="#collapse<?php echo $key+1; ?>"
								   aria-expanded="false"
								   aria-controls="collapse<?php echo $key+1; ?>">
						<div class="tbl-cell">
                                                           <p class="user-card-row-location"> <?php echo $key+1; ?>: <?php echo $data['questionText']; ?> </p>
											</div>
									<i class="font-icon font-icon-arrow-down"></i>
								</a>
							</div>
							<div id="collapse<?php echo $key+1; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $key+1; ?>">
								<div class="panel-collapse-in">
									<div class="user-card-row">
										<div class="tbl-row">
										
											
										</div>
									</div>
									
									<p><?php echo $data['answerText']; ?></p>
								</div>
							</div>
						</article>
                                            
                                            <?php }   
                                                }else{  ?>
<!--                                              <section class="box-typical">-->
                                <div class="add-customers-screen tbl" style="height: 240px;">
                                    <div class="add-customers-screen-in">
                                        <div class="add-customers-screen-user">
                                            <i class="font-icon font-icon-user"></i>
                                        </div>
                                        <h2> <?php echo $page_name; ?>  is empty</h2>						
                                    </div>
                                </div>
<!--                             </section>-->
                                                
                                          <?php    }  ?>
                                      	
					</section><!--.widget-accordion-->
                    

                </div>



            </div>      
     
            
          <?php  include_once("common/jobseekerSidebar.php") ?>

        </div>
    </div><!--.container-fluid-->
</div><!--.page-content-->





