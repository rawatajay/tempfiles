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
         <section class="card">
			<div class="card-block">
    			<div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
            	<table id="employeeleavelist" class="display table table-striped table-bordered" cellspacing="0" width="100%" >
					<thead>
						<tr>
							<th>Name</th>
							<th>EmpId</th>
							<th>Desg.</th>
							<th>Dpt.</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Type</th>
							<th>Status</th>
							<th>Emg. Contact</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Name</th>
							<th>EmpId</th>
							<th>Designation</th>
							<th>Department</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Type</th>
							<th>Status</th>
							<th>Emergency Contact</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php foreach($leaves as $val) {								
							

							if($val['status'] == 'pending') 
								$statuslabel = 'warning';
							else if($val['status'] == 'denied')
								$statuslabel = 'danger';
							else 
								$statuslabel = 'success';

							if($val['leaveType'] == '1')
								$leaveType = 'Casual';
							else if($val['leaveType'] == '2')
								$leaveType = 'Medical';
							else if($val['leaveType'] == '3')
								$leaveType = 'Earned';
							
						 ?>
						<tr>
							<td><?php echo $val['name']?></td>
							<td><?php echo ucwords($val['employeeId'])?></td>
							<td><?php echo $val['desinationName']?></td>
							<td><?php echo $val['departmentName']?></td>
							<td><?php echo $val['startDate']?></td>
							<td><?php echo $val['endDate']?></td>
							<td><?php echo $leaveType?></td>
							<td><span class="label label-<?php echo $statuslabel; ?>"><?php echo $val['status']; ?></span></td>
							<td><?php echo $val['emergencyContactNumber']?></td>
							
							<td> 										
								<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
									<button data-toggle="tooltip" data-original-title="View" type="button" class="btn btn-primary-outline" onclick="window.location.href='<?php echo base_url('admin/view_leave/').'/'.encrypt_decrypt('encrypt',$val['leaveid'])?>'">
									<i class="fa fa-eye"></i></button>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
            </div>
        </section>
    </div><!--.container-fluid-->
</div><!--.page-content-->
        
    
 