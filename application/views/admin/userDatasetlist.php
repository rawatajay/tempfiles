         <div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2><?php echo $page_name?>
								
							</h2>							
						</div>
					</div>
				</div>
					</div>
				</div>
			</header>
                    <section class="card card-inversed">
                        <div class="card-block">   
                            <?php if(!empty($datasetlist)){?>
					<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>         
								<th>S.No</th> <th >User</th>
				   <th>Dataset Title</th>
	                          
	                            <th >Total Companies</th>	                                                       
	                            <th >Total Downloaded</th>
                                     <th >Total Profileview</th>   
                                       <th >SendON</th>
	                           
	                           
	                          
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>S.No</th>
                                                                  <th >User</th>
								<th>Dataset Title</th>
                                                                  
                                                                    <th >Total Companies</th>	                                                       
                                                                    <th >Total Downloaded</th>
                                                                     <th >Total Profileview</th>    
                                                                       <th >SendON</th>
                                                                    
									
							</tr>
						</tfoot>
						<tbody>	
						<?php foreach($datasetlist as  $ctr => $data) {      ?> 				
						<tr>
                                                        <td><?php echo  $ctr + 1; ?></td>
                                                       <td ><?php echo $data['username']; ?></td>
                                                        <td ><?php echo $data['title']; ?></td>
                                                        <td ><?php echo $data['counter']; ?></td>
                                                                    
                                                        <td ><?php echo $data['isdownLoaded']; ?></td>	
                                                        <td ><?php echo $data['isopencounter']; ?></td>    
                                                        <td ><?php echo date('d-m-Y',strtotime($data['createdAt'])); ?></td>  
                                                     	

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
                                        <h2>Your <?php echo $page_name; ?>  is empty</h2>						
					</div>
				        </div>
                                        <?php }?>
                        </div>
                    </section>
		</div><!--.container-fluid-->
</div><!--.page-content-->


		