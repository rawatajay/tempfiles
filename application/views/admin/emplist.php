<div class="page-content">
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
            <section class="box-typical" ng-controller="empModifyController">
                <header class="box-typical-header-sm"><br/> </header>
                <article class="profile-info-item">
                    <div class="text-block text-block-typical">                       
                       
            			<div class="col-xl-12">
            			<div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
                    	<table id="registerdemployeelist" class="display table table-striped table-bordered" cellspacing="0" width="100%" >
							<thead>
								<tr>
									<th>Empid</th>
									<th>Name</th>
									<th>DOJ</th>
									<th>Address</th>
									<th>DOB</th>
									<th>Email</th>
									<th>Contact</th>
									<th>Gender</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Empid</th>
									<th>Name</th>
									<th>DOJ</th>
									<th>Address</th>
									<th>DOB</th>
									<th>Email</th>
									<th>Contact</th>
									<th>Gender</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php foreach($users as $val) {									
									$status = ($val['isActive'] == true) ? 'success' : 'warning';
									$statustype = ($val['isActive'] == true) ? 'Active' : 'Inactive';
									$isAccountCreated = ($val['isActive'] == false)
								 ?>
								<tr>
									<td><?php echo $val['empId']?></td>
									<td><?php echo ucwords($val['name'])?></td>
									<td><?php echo $val['dateOfJoining']?></td>
									<td><?php echo $val['address']?></td>
									<td><?php echo $val['dateOfBirth']?></td>
									<td><?php echo $val['email']?></td>
									<td><?php echo $val['contact']?></td>
									<td><?php echo ucwords($val['gender'])?></td>
									<td><span class="label label-<?php echo $status; ?>"><?php echo $statustype; ?></span></td>
									<td>
										<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
											<button data-toggle="tooltip" data-original-title="Edit" type="button" class="btn btn-primary-outline" onclick="window.location.href='<?php echo base_url('admin/edit_employee/').'/'.encrypt_decrypt('encrypt',$val['userID'])?>'">
											<i class="fa fa-edit"></i></button>
											<?php if($val['isActive'] == true) { ?>

											<button data-toggle="tooltip" data-original-title="Change Status" type="button" class="btn btn-danger-outline delete-employee
" ng-click="changeStatusEmployee('inactive','<?php echo encrypt_decrypt('encrypt',$val['userID'])?>')"><i class="fa fa-ban"></i></button>
											<?php } else { ?> 
											<button data-toggle="tooltip" data-original-title="Change Status" type="button" class="btn btn-success-outline delete-employee
" ng-click="changeStatusEmployee('active','<?php echo encrypt_decrypt('encrypt',$val['userID'])?>')"><i class="fa fa-user"></i></button>
											<?php } ?>											
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
                        </div>
                    </div>
                </article><!--.profile-info-item-->
            </section><!--.box-typical-->
        </div><!--.row-->   
    </div><!--.container-fluid-->
</div><!--.page-content-->
        
    
 