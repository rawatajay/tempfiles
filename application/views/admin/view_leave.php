<div class="page-content" >
    <div class="container-fluid">
    	<header class="section-header">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3><?php echo $page_name; ?></h3>
					</div>
				</div>
			</div>
		</header>
        <div class="row">
            <section class="box-typical"  >
                <header class="box-typical-header-sm"><br/> </header>
                <article class="profile-info-item">
                    <div class="text-block text-block-typical">
                        <div class="col-xl-12">
                    		<div class="row m-t-lg">	

								<div class="col-md-12">
								<div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
									<section class="box-typical" ng-controller="StatusleaveController">

										<?php if($leavedetails['status'] == 'pending'){ ?>
										<header class="box-typical-header">
											<div class="tbl-row">												
												<div class="tbl-cell tbl-cell-action-bordered">
													<button ng-click="changeStatusEmployee('accept','<?php echo encrypt_decrypt('encrypt',$leavedetails['leaveid'])?>')" data-toggle="tooltip" data-original-title="Approve Leave" type="button" class="action-btn"><i class="font-icon font-icon-ok"></i></button>
												</div>
												<div class="tbl-cell tbl-cell-action-bordered">
													<button ng-click="changeStatusEmployee('reject','<?php echo encrypt_decrypt('encrypt',$leavedetails['leaveid'])?>')" data-toggle="tooltip" data-original-title="Reject Leave" type="button" class="action-btn"><i class="font-icon font-icon-del"></i></button>
												</div>												
											</div>
										</header>
										<?php } ?>
										<div class="box-typical-body">
											<div class="table-responsive">
												<table id="table-edit" class="table table-bordered table-hover">
																<thead>
																
																<tbody>
																	<tr>
																		<td><b>Name</b></td>
																		<td><?php echo $leavedetails['name']?></td>											
																	</tr>
																	<tr>
																		<td><b>Employee Id</b></td>
																		<td><?php echo $leavedetails['employeeId']?></td>											
																	</tr>
																	<tr>
																		<td><b>Designation</b></td>
																		<td><?php echo $leavedetails['desinationName']?></td>											
																	</tr>
																	<tr>
																		<td><b>Department</b></td>
																		<td><?php echo $leavedetails['departmentName']?></td>											
																	</tr>
																	<tr>
																		<td><b>Leave Start Date</b></td>
																		<td><?php echo $leavedetails['startDate']?></td>											
																	</tr>
																	<tr>
																		<td><b>Leave End Date</b></td>
																		<td><?php echo $leavedetails['endDate']?></td>											
																	</tr>
																	<tr>
																		<td><b>Leave Type</b></td>
																		<td><?php 

																			if($leavedetails['leaveType'] == '1')
																				$leaveType = 'Casual';
																			else if($leavedetails['leaveType'] == '2')
																				$leaveType = 'Medical';
																			else if($leavedetails['leaveType'] == '3')
																				$leaveType = 'Earned';?>
																			<?php echo $leaveType ?> Leave
																		</td>											
																	</tr>
																	<tr>
																		<td><b>Status</b></td>
																		<td><?php 
																			if($leavedetails['status'] == 'pending') 
																				$statuslabel = 'warning';
																			else if($leavedetails['status'] == 'denied')
																				$statuslabel = 'danger';
																			else 
																				$statuslabel = 'success';
																			?>
																			<span class="label label-<?php echo $statuslabel; ?>"><?php echo ucwords($leavedetails['status']); ?></span>
																		</td>											
																	</tr>
																	<tr>
																		<td><b>Emergency Contact Number</b></td>
																		<td><?php echo $leavedetails['emergencyContactNumber']?></td>											
																	</tr>
																	<tr>
																		<td><b> Reason</b></td>
																		<td><?php echo $leavedetails['reason']?></td>											
																	</tr>
																</tbody>
															</table>
											</div>
										</div><!--.box-typical-body-->
									</section><!--.box-typical-->									
								</div>
							</div><!--.row-->
                        </div>
                    </div>
                </article><!--.profile-info-item-->
            </section><!--.box-typical-->
        </div><!--.row-->   
    </div><!--.container-fluid-->
</div><!--.page-content-->
        
        
 