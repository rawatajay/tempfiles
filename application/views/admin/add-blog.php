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
                                
                                     <form  method="POST" action="<?php echo base_url(); ?>admin/saveBlog" enctype="multipart/form-data" >   
                                         <input type="hidden" name="blogID" value="<?php echo ($blog_data->blogID)?$blog_data->blogID:''; ?>"
                                            <div class=" col-lg-10"> 
                                                <fieldset class="form-group">
                                                    <label class="form-label ">  Blog Title</label>

                                                    <input type="text" class="form-control" id="blogTitle" name="blogTitle" value="<?php  echo ($blog_data->blogHead)?$blog_data->blogHead:'';  ?>" placeholder="Blog Title"/>

                                                </fieldset>
                                            </div>       

                                            

                                       <div class=" col-lg-10"> 
                                          <fieldset class="form-group">
                                              <label class="form-label "> Blog Content</label>

                                                  <textarea rows='10'   name="blogContent" class="ckeditor"><?php  echo  ($blog_data->blogText) ?$blog_data->blogText : '';?></textarea>

                                          </fieldset>
                                      </div>
                                       <div class=" col-lg-10"> 
                                            <fieldset class="form-group">

                                            <div class="col-md-6">
                                                <label class="form-label " for="blogpic">Blog Image</label>  
                                                <span class="btn btn-rounded btn-file ">
                                                    <span>Choose file</span>
                                                    <input class="fileUpload "  id="blogpic" name="blogPic" type="file" />
                                                </span> 
                                                <a href="javascript:void(0);" class="btn fileupload-exists btn-light-grey disabled"  data-dismiss="fileupload">
															<i class="fa fa-times"></i> Remove
														</a>
                                            </div>   
                                            <div class="col-md-6">
                                                <?php $image = ($blog_data->blogImage)?$blog_data->blogImage:'http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image';  ?>
                                                <div id="image-holder" class="profile-card-photo img_border thumbnails pull-right" style=" border:#CCC solid 5px; width: 160px; height: 160px;"><img src="<?php echo $image; ?>" width="150" height="150" alt="">
                                                </div>
                                            </div>    
                                         </fieldset>
                                       </div>
                                        <div class=" col-lg-10"> 
                                                <fieldset class="form-group">
                                                   
                                                    <div class="checkbox-bird">
								<input type="checkbox" id="check-bird-9" <?php  echo ($blog_data->status)?'checked':''; ?> name="status" />
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