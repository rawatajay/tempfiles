                    <div class="page-content">
                      <div class="container-fluid">
                        <div class="row">
                                    <div class="col-lg-9 col-lg-push-3 col-md-12">
                               <header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2><?php echo $page_name; ?></h2>
							
						</div>
					</div>
				</div>
			      </header>
                                <section class="card">
                                        
				<div class="card-block">     
                                    
                                          
                                 <?php if(!empty($companylist)){?>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>         
<!--								<th>S.No</th>-->
								<th>Company Name</th>
	                            <th >Contact Name</th>
	                            <th >Company Email</th>	                                                       
	                            <th >Contact Number</th>
                                     <th >Industry</th>                                                 
	                            <th >City</th>
	                           
	                          
							</tr>
						</thead>
						<tfoot>
							<tr>
								
									<th >Company Name</th>
									<th>Contact Name</th>
									<th>Company Email</th>									
									<th>Contact Number</th>
                                                                         <th >Industry</th>
                                                                      
                                                                       <th >City</th>
									
							</tr>
						</tfoot>
						<tbody>	
						<?php $ctr=1; foreach($companylist as $data) {      ?> 				
							<tr>
<!--                                                        <td><?php //echo $ctr; ?></td>-->
                                                        <td ><?php echo $data['companyName']; ?></td>
                                                        <td ><?php echo $data['primarycontactname']; ?></td>
                                                        <td ><?php echo $data['primaryEmail']; ?></td>                 
                                                        <td ><?php echo $data['contactnumbers']; ?></td>	
                                                        <td ><?php echo $data['functionalName']; ?></td>            
                                                        <td ><?php echo $data['cityName']; ?></td>	

						</tr>
						<?php $ctr++;}?>
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
                         <?php include_once("common/jobseekerSidebar.php") ?>
                      


         </div>
    </div><!--.container-fluid-->
</div><!--.page-content-->


<style type="text/css">
.modal-body{
  height: 500px;
  overflow-y: auto;
}
</style>



