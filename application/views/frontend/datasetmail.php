<div class="page-content">
    <style>
     .thumbnails li img{
                width: 100px;
            }
       </style>     
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-push-2 col-md-12">
                      <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 

                <div class="container-fluid"> 
                    
                    <div class="text-block text-block-typical sendApplybtn">
                                           
                                          
                        <a href="<?php echo base_url()  ?>user/dataset/detail/<?php echo $rowID ?>" > <span class="col-lg-2 col-lg-push-10  btn btn-rounded btn-inline btn-success pull-right"><i class="fa fa-mail-reply" aria-hidden="true"></i> Go back  </span></a>

                 </div>
                     
                    <section class="box-typical">

                        <header class="box-typical-header profile_header">
                            <div class="tbl-row">
                                <div class="tbl-cell tbl-cell-title">
                                    <h3> Step Two User Mail</h3>
                                </div>
                            </div>
                        </header>
                        <article class="">

                            <div class=" card-block text-block-typical box-typical steps-numeric-block">
                                       
                            <div class="steps-numeric-header">
                                            <div class="steps-numeric-header-in">
                                                    <ul>
                                                            <li ><div class="item"><span class="num">1</span>View Dataset</div></li>
                                                            <li class="active"><div class="item"><span class="num">2</span>Create Mail</div></li>
                                                            <li><div class="item"><span class="num">3</span>Preview Mail</div></li>
                                                           
                                                    </ul>
                                            </div>
                                    </div>   
                                <!--						<div class="col-xl-12">-->
                                <div class="row ">
                                    <div class="col-md-12">
                                        
					
                                    
                                        
                                    <?php if(!empty($jobseeker->resumeURL)){ ?> 
                                     <form  method="post"  id="mailform" action="<?php echo base_url(); ?>user/dataset/getpreviewmail" enctype="multipart/form-data">   
                                        
                                        <div class="col-md-9">  
                                                
                                            
                                           <div class=" col-lg-12"> 
                                                   
                                                <fieldset class="form-group">
                                                    <label class="form-label">Total Companies: <?php echo ($company_data)?count($company_data):0 ; ?></label>

                                                </fieldset>
                                            </div> 	
					
                                       	


                                            <div class=" col-lg-12"> 
                                                <fieldset class="form-group">
                                                    <label class="form-label ">  Subject</label>

                                                    <input type="text" class="form-control" id="mail_subject" name="mail_subject" value="" placeholder="Mail Subject"/>

                                                </fieldset>
                                            </div>       

                                            <div class=" col-lg-12"> 
                                                <fieldset class="form-group">
                                                    <label class="form-label ">  Message</label>
<!--                                                      <textarea rows='10'  id="messageData"  name="messageData" class="ckeditor"> Type your message here.</textarea>-->
                                                    
                                                    <div class="summernote-theme-5">
                                                        <textarea rows='10'  id="messageData"  name="messageData" class="summernote"> Type your message here.</textarea>
                                                    </div>
                                                </fieldset>
                                            </div>  
                                                              
                                            <div class="col-lg-12">
                                                <fieldset class="form-group">
                                                    <label class="form-label">Resume </label>
                                                    <select id="image-picker"  name="attachImg">        
                                        <?php  
                                                           $resumedata = explode(',',$jobseeker->resumeURL);
                                                                foreach ($resumedata as $key => $value) {
   
                                                                 $path_info = pathinfo($value);

                                                                   $ext=  $path_info['extension'];
                                                                ?>    
                                                                 <a href="<?php echo $value; ?>" target="_blank"> 
                                                                     <?php if($ext =="pdf"){ ?>
                                                                     <img src=" <?php echo base_url() ?>assets/admin/img/pdf.jpg" width="50" height="50" />
                                                                     <?php }else{ ?>
                                                                      <img src=" <?php echo base_url() ?>assets/admin/img/docs.png" width="50" height="50" />
                                                                     <?php } ?>
                                                                 </a>  
                                                        
                                                        
                                                         <?php if($ext =="pdf"){ 
                                                             $src = base_url()."assets/admin/img/imgpdf.jpg";
                                                                    }else{ 
                                                                   $src= base_url()."assets/admin/img/imgdoc.png";
                                                                   } 
                                                          ?>         
                                                         <option data-img-src="<?php echo $src; ?>" value="<?php echo $value; ?>">  Page 1  </option>        
                                                               <?php } ?>
                                                    </select>
                                                          
                                                    
                                                </fieldset>
                                            </div>  
                                        </div>
                                          <div class="col-md-3">    
                                             <div class=" col-lg-10"> 
                                                <fieldset class="form-group">
                                                    <label class="form-label">Mail Template</label>


                                                   
                                                    <select id="mailID" onselect="ajaxmaildata()"  name="mailID"   >
<!--							   <option value="">-- Select Mail template --</option>							  -->
							 <?php 
                                                    foreach ($mail_templates as $mailtpl) { ?>
								<option  data-img-src="<?php echo base_url() ?>assets/admin/img/tmpImg.png" value="<?php echo $mailtpl['id']?>"><?php echo ucwords($mailtpl['name'])?></option>
							<?php }?>							
						</select>
                                                 
                                                </fieldset>
                                            </div> 
                                           </div>     
                                         
                                            <input type="hidden" name="rowID" value="<?php echo $rowID ?>"/>
                                             <input type="hidden" name="company_count_data" value="<?php echo ($company_data)?count($company_data):0 ; ?>"/>
                                            <input type="hidden" name="attach_data" value="<?php echo $jobseeker->resumeURL; ?>"/>

                                          <div class="col-lg-10">
                                            <button type="submit" class="btn btn-inline btn-primary ">Mail Preview</button>   
                                        </div> 
                                        </form>  
                                       
                                    <?php }else{  ?>
                                      <div class="add-customers-screen tbl" style="height: 240px;">
					<div class="add-customers-screen-in">
						<div class="add-customers-screen-user">
							<i class="font-icon font-icon-user"></i>
						</div>
						<h2>Your Resume not Available.  </h2>						
					 </div>
				       </div>
                                    <?php } ?>    
                                      
                                        
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

					
