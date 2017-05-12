<div class="page-content">
    <style>
     .thumbnails li img{
                width: 100px;
            }
       </style>     
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-push-2 col-md-12">
                     

                <div class="container-fluid"> 
                      <div class="text-block text-block-typical sendApplybtn">
                                           
                                          
                        <a href="<?php echo base_url()  ?>/user/dataset/mail/<?php echo $rowID ?>" > <span class="col-lg-2 col-lg-push-10  btn btn-rounded btn-inline btn-success pull-right"><i class="fa fa-mail-reply" aria-hidden="true"></i> Go back  </span></a>

                 </div>
                   
                    <section class="box-typical">
                      
                        <header class="box-typical-header profile_header">
                            <div class="tbl-row">
                                <div class="tbl-cell tbl-cell-title">
                                    <h3> Mail Preview</h3> 
                                </div>
                            </div>
                        </header>
                        <article class="">

                             <div class=" card-block text-block-typical box-typical steps-numeric-block">
                                       
                            <div class="steps-numeric-header">
                                            <div class="steps-numeric-header-in">
                                                    <ul>
                                                            <li ><div class="item"><span class="num">1</span>View Dataset</div></li>
                                                            <li ><div class="item"><span class="num">2</span>Create Mail</div></li>
                                                            <li class="active"><div class="item"><span class="num">3</span>Preview Mail</div></li>
                                                            
                                                    </ul>
                                            </div>
                                    </div>   
                                <div class="row ">
                                    <div class="col-md-12">
                                        
					
                                    
                                        
                                  
                                     <form  method="post"  id="mailform" action="<?php echo base_url(); ?>user/dataset/sendmail" enctype="multipart/form-data">   
                                        
                                        <div class="col-md-9">  
                                                
                                            
                                           <div class=" col-lg-12"> 
                                                   
                                                <fieldset class="form-group">
                                                    <label class="form-label"><b>Total Companies:</b> <?php echo ($company_count)?$company_count:0 ; ?></label>

                                                </fieldset>
                                            </div> 	
					
                                       	

                                            <div class=" col-lg-12"> 
                                                <fieldset class="form-group">
                                                    <label class="form-label ">  Message</label>
<!--                                                  <textarea rows='10'  id="messageData" class="summernote" name="messageData" > <?php // echo $messageData;  ?></textarea> -->
                                                    
                                                 
                                                        
                                                        <?php  echo $messageData;  ?>
                                                      
                                                  
                                                </fieldset>
                                            </div>  
                                                              
                                           
                                        </div>
                                           
                                         
                                            <input type="hidden" name="rowID" value="<?php echo $rowID; ?>"/>
                                            <input type="hidden" name="attachImg" value="<?php echo $attach_Data; ?>"/>
                                             <input type="hidden" name="mailID" value="<?php echo $mailID; ?>"/>
                                             <input type="hidden" name="messageData" value='<?php echo htmlspecialchars($messageData); ?>'/>
                                            <input type="hidden" name="mail_subject" value="<?php echo $subject; ?>"/>

                                           <div class="col-lg-12">
                                               <button type="submit" class="btn btn-inline btn-primary " >Send Mail</button> 
  
                                        </div> 
                                        </form>  
                                       
                                
                                        
                                    </div><!--.row-->
                                </div>
                                
                               
                            </div>
                        </article><!--.profile-info-item-->

                    </section><!--.box-typical-->


                </div>


            </div>   

                <?php //  include_once("common/jobseekerSidebar.php") ?>
            
        </div>
    </div><!--.container-fluid-->
</div><!--.page-content-->

                                   

<div class="modal fade bd-example-modal-lg"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
   <div class="modal-dialog modal-lg">
           <div class="modal-content">
                   <div class="modal-header">
                           <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                                   <i class="font-icon-close-2"></i>
                           </button>
                           <h4 class="modal-title" id="myModalLabel">Mail Template</h4>
                   </div>
                   <div class="modal-body pre-mail">
                         <?php echo "Select your mail template"; ?>
                   </div>
                   <div class="modal-footer">
                        	<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
				<button type="button" onclick="sendingMailData();" class="btn btn-rounded btn-primary">Send</button>
                   </div>
           </div>
   </div>
</div><!--.modal-->

					
