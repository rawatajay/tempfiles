	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-9 col-lg-push-3 col-md-12">
                                    
                                       <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>user/sendrefferalMail">
                                    <section class="box-typical">
                                        <header class="box-typical-header-sm"><?php //echo $page_name; ?></header>
                                        <article class="profile-info-item">

                                            <div class="text-block text-block-typical">
                                                <div class="col-xl-12">
                                                    <div class="row">
                                                    <header class="section-header">
				               <div class="tbl">
					           <div class="tbl-row">
                                                    <div class="tbl-cell">
                                                      <div class="col-lg-12"> 
                                                        <div class="col-lg-8 form-group">
                                                            <input type="text" name="friend_email" class="form-control" placeholder="Enter email" />
                                                        </div> 
                                                        <div class="col-lg-2 form-group">
                                                       <a href="https://accounts.google.com/o/oauth2/auth?client_id=<?php print $clientid;?>&redirect_uri=<?php print $redirecturi; ?>&scope=https://www.google.com/m8/feeds/&response_type=code"> 
                                                             <button type="button" data-style="contract" class="btn ladda-button  btn-info"><i class="fa fa-google-plus"></i> Invite Friends </button>
                                                          </a>           
                                                        </div>    
                                                                                                          
                                                        <?php // if(isset($friend_list)){ ?>
                                                        <button    type="submit" class="btn btn-rounded  btn-inline pull-right">Send Mail</button> 
                                                        <?php // } ?> 
                                                      </div>   
                                                     </div>
                                                    </div>
                                                  </div>
                                               </header>
                                                    </div><!--.row-->
                                                </div>
                                            </div>
                                        </article><!--.profile-info-item-->
                                    </section><!--.box-typical-->
                                    
                                    
                                <section class="card">
                                        
				<div class="card-block block-typical">     
                                    
                                      <?php if(isset($friend_list)){ ?>
                                          
                                        
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>         
                                                            <th>S.No</th>

                                                            <th>Email</th>
                                                            <th>Status</th>
                                                            <th >	
                                                                    <input type="checkbox" class="checkAll"/> Check all
                                                            </th>
	                           
	                          
							</tr>
						</thead>
						<tfoot>
							<tr>
                                                            <th>S.No</th>

                                                            <th>Email</th>
                                                            <th>Status</th>
                                                            <th >	
                                                                <input type="checkbox"  class="checkAll"/> Check all
                                                             </th>
							</tr>
						</tfoot>
                                                  
						<tbody>	
                                             
                                           
						<?php  
                                                    
                                                       foreach($friend_list as $key=> $data) {     ?> 				
							<tr>
                                                        <td><?php echo $key+ 1; ?></td>
                                                        <td ><?php echo $data['email']; ?></td>
                                                        <td >
                                                         <?php $status = $data['status']; 
                                                         if($status==2){ echo '<label class="label label-success">Approved</label>'; }
                                                        else if($status==1){echo '<label class="label label-warning">Pending</label>'; }
                                                        else{{echo '<label class="label label-danger">Not Send</label>'; } } 
                                                        ?></td>
                                                        
                                                        <td > 	
                                                         
                                                                   <input type="checkbox" <?php if($status > 0)echo 'disabled'; ?>  class="checkSingle" name='referal[]' value="<?php echo $data['email']; ?>">
                                                                 
						
                                                        </td>	

						</tr>
						<?php }?>
						</tbody>
                                               
					         </table>
                                        
                                     
                                      <?php }     if(!empty($red_data)){   ?>
                                          
                                          <div class="" style="height: 75px;">
<!--					<div class="add-customers-screen-in">-->
<!--						<div class="add-customers-screen-user">
							<i class="fa fa-user-plus"></i>
						</div>-->
						<h2> Invited Friends</h2>						
<!--					</div>-->
				        </div>
                              
                                          
                                        
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>         
                                                            <th>S.No</th>

                                                            <th>Email</th>
                                                            <th>Status</th>
                                                            
	                          
							</tr>
						</thead>
						<tfoot>
							<tr>
                                                            <th>S.No</th>

                                                            <th>Email</th>
                                                            <th>Status</th>
                                                          
							</tr>
						</tfoot>
                                                  
						<tbody>	
                                             
                                           
						<?php  
                                                    
                                                       foreach($red_data as $key=> $data) {     ?> 				
							<tr>
                                                        <td><?php echo $key+ 1; ?></td>
                                                        <td ><?php echo $data['refertoEmail']; ?></td>
                                                        <td >
                                                         <?php $status = $data['status']; 
                                                         if($status==2){ echo '<label class="label label-success">Approved</label>'; }
                                                        else if($status==1){echo '<label class="label label-warning">Pending</label>'; }
                                                        else{{echo '<label class="label label-danger">Not Send</label>'; } } 
                                                        ?></td>
                                                        
                                                       

						</tr>
						<?php }?>
						</tbody>
                                               
					         </table>
                                        
                                     
                                      <?php }else{    ?>
                                          
                                          <div class="add-customers-screen tbl" style="height: 240px;">
					<div class="add-customers-screen-in">
						<div class="add-customers-screen-user">
							<i class="fa fa-user-plus"></i>
						</div>
						<h2> Invited friends</h2>						
					</div>
				        </div>
                                <?php      }  ?>	 
                                              
                                </div>
                        </section>
                    </form>
				</div><!--.col- -->

				<?php include_once("common/jobseekerSidebar.php") ?>
				<?php //include_once("common/jobseekerLeftSidebar.php") ?>
			
			</div><!--.row-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->
        
        