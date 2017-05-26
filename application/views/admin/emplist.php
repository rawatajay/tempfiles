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
		    	<table id="registerdemployeelist" class="display table table-bordered dataTable dtr-inline" cellspacing="0" width="100%" >
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
							<td><?php echo ($val['gender'] == 1) ? 'Male' : 'Female';?></td>
							<td><span class="label label-<?php echo $status; ?>"><?php echo $statustype; ?></span></td>
							<td>
								<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
									<button data-toggle="tooltip" data-original-title="Edit" type="button" class="btn btn-primary-outline" onclick="window.location.href='<?php echo base_url('admin/edit_employee/').'/'.encrypt_decrypt('encrypt',$val['userID'])?>'">
									<i class="fa fa-edit"></i></button>										
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
        
    
 