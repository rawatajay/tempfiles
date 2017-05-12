
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-lg-push-3 ">
              
                <div class="container-fluid"> 
                    
                      <section class="box-typical ">
                           <div id="message"><?php  echo $this->session->flashdata('msg'); ?></div> 
                         <div class="box-typical-header card-block ">  
                              
                                      <form class="formvalidate"  method="POST" action="<?php echo base_url() ?>user/questionData" enctype="multipart/form-data">
                                       
                                        <div class="form-group">
                                            <label class="form-label" for="question">Question (Create your query below ..)</label>
                                            <div class="form-control-wrapper">
                                                <input type="text" id="question_data"   class="form-control"
                                                       name="question_data" placeholder="Enter your question" />                                            </div>
                                        </div>
                                       

                                        <div class="form-group">
                                            <button type="submit" class="btn pull-right">Save</button>
                                        </div>
                                    </form>
                                 </div>             
                            
                           
                    </section>
                    <section class="box-typical">
                        <header class="box-typical-header profile_header">
                            <div class="tbl-row">
                                <div class="tbl-cell tbl-cell-title">
                                    <h3><?php echo $page_name; ?></h3>
                                </div>
                            </div>
                        </header>
                    </section>  
                    
                    
                        <section class="box-typical box-typical-dashboard">
	                    <header class="box-typical-header">
	                        <div class="tbl-row">
	                            <div class="tbl-cell tbl-cell-title">
	                                <h3>User Query</h3>
	                            </div>
	                           
	                        </div>
	                    </header>
	                    <div class="box-typical-body">
                                
                             
                        <?php
                                 if (!empty($ques_data)) {
                            foreach ($ques_data as $data){  
                           ?>    
	                        <article class="comment-item">
	                            <div class="user-card-row">
	                                <div class="tbl-row">
	                                    <div class="tbl-cell ">
	                                       <?php echo $data['questionText']; ?>
	                                    </div>
	                                  
	                                    <div class="tbl-cell tbl-cell-date">
                                                <span class="semibold"><i class="fa fa-calendar"></i> <?php echo date('l jS F Y H:i:s', strtotime($data['createdOn'])); ?></span>
	                                       
	                                    </div>
	                                </div>
	                            </div>
	                           
                                        
	                            <div class="comment-item-meta">
	                                <a href="#" class="star">
	                                    <i class="font-icon font-icon-star"> </i>
	                                </a>
	                                <a href="#">
	                                    <i class="font-icon font-icon-re"> <?php if($data['status']==1) echo "Pending"; else echo "Replied"  ?> </i>
	                                </a>
	                             
	                            </div>
                                        <div class="user-card-row">
	                                <div class="tbl-row">
	                                    <div class="tbl-cell ">
	                                     <?php echo $data['adminResponse']; ?>
	                                    </div>
                                           
	                                  
	                                    <div class="tbl-cell tbl-cell-date">
	                                        <span class="semibold"><?php if($data['respondedOn']!="0000-00-00 00:00:00") echo  date('l jS F Y H:i:s', strtotime($data['respondedOn'])); ?> </span>
	                                        
	                                    </div>
	                                </div>
	                            </div>
	                        </article>
                                
	                         <?php }
                            } else {
                                ?> 

                              <section class="box-typical">
                                <div class="add-customers-screen tbl" style="height: 240px;">
                                    <div class="add-customers-screen-in">
                                        <div class="add-customers-screen-user">
                                            <i class="font-icon font-icon-user"></i>
                                        </div>
                                        <h2> <?php echo $page_name; ?>  is empty</h2>						
                                    </div>
                                </div>
                             </section>
                        <?php }    ?>
	                    </div><!--.box-typical-body-->
	                </section><!--.box-typical-dashboard-->
                         
                 

                </div>



            </div>      
     
            
          <?php  include_once("common/jobseekerSidebar.php") ?>

        </div>
    </div><!--.container-fluid-->
</div><!--.page-content-->





