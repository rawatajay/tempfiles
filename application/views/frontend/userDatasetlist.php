
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-lg-push-3 ">
              
                <div class="container-fluid"> 
                    
                           <div class="text-block text-block-typical sendApplybtn">


                                             <a href="<?php echo base_url()  ?>user/profile_view" > <span class="col-lg-2 col-lg-push-10  btn btn-rounded btn-inline btn-success pull-right"><i class="fa fa-mail-reply" aria-hidden="true"></i> Go back  </span></a>

                                      </div>           
                        <section class="box-typical">
                            <header class="box-typical-header profile_header">
                                <div class="tbl-row">
                                    <div class="tbl-cell tbl-cell-title">
                                        <h3><?php echo $page_name; ?></h3>
                                    </div>
                                </div>
                            </header>
                        </section>  

                           <section class="card">
                                        
				<div class="card-block">     
                                    
                                          
                                 <?php if(!empty($datasetlist)){?>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>         
								<th>S.No</th>
				   <th>Dataset Title</th>
	                          
	                            <th >Total Companies</th>	                                                       
	                            <th >Total Downloaded</th>
                                     <th >Total Profileview</th>   
                                       <th >SendON</th>
	                            <th >Action</th>
	                           
	                          
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>S.No</th>
								<th>Dataset Title</th>
                                                                  
                                                                    <th >Total Companies</th>	                                                       
                                                                    <th >Total Downloaded</th>
                                                                     <th >Total Profileview</th>    
                                                                       <th >SendON</th>
                                                                    <th >Action</th>
									
							</tr>
						</tfoot>
						<tbody>	
						<?php foreach($datasetlist as  $ctr => $data) {      ?> 				
						<tr>
                                                        <td><?php echo  $ctr + 1; ?></td>
                                                        <td ><?php echo $data['title']; ?></td>
                                                        <td ><?php echo $data['counter']; ?></td>
                                                                    
                                                        <td ><?php echo $data['isdownLoaded']; ?></td>	
                                                        <td ><?php echo $data['isopencounter']; ?></td>    
                                                        <td ><?php echo date('d-m-Y',strtotime($data['createdAt'])); ?></td>  
                                                        <td > <a href="<?php echo base_url()  ?>user/userEmailList/<?php echo $data['dtid']; ?>"class="btn btn-inline btn-primary glyphicon glyphicon-eye-open "> </a></td>	

						 </tr>
						<?php }?>
						</tbody>
					</table>
					<?php }else { ?>
					<div class="add-customers-screen tbl" style="height: 240px;">
					<div class="add-customers-screen-in">
                                        <div class="add-customers-screen-user">
                                                <i class="font-icon font-icon-user"></i>
                                        </div>
                                        <h2>Your <?php echo $page_name; ?> list is empty</h2>						
					</div>
				        </div>
                                        <?php }?>
                          
                                </div>
                        </section>
                        
                        	

                 

                </div>



            </div>      
     
            
          <?php  include_once("common/jobseekerSidebar.php") ?>



        </div>
    </div><!--.container-fluid-->
</div><!--.page-content-->





