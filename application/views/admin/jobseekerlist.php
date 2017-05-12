<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>Jobseeker</h2>							
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<?php if(!empty($jobseekerList)){?>
					<table id="example" class="display table table-bordered jhtable" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>S.No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Status</th>
							<th>Action</th>							
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>S.No</th>
							<th>Name</th>
							<th>Email</th>
							<th>Status</th>
							<th>Action</th>	
						</tr>
						</tfoot>
						<tbody>	
						<?php $ctr=1; foreach($jobseekerList as $data) {?>					
						<tr>
							<td><?php echo $ctr;?></td>
							<td><?php echo ucwords($data['firstName']).' '.ucwords($data['lastName'])?></td>
							<td><?php echo $data['email']?></td>
							<td>
								<?php if($data['isActive'] == '1') {?>
									<span class="label label-pill label-success">Active</span></td>
								<?php }else if($data['isActive'] == '0'){?>
									<span class="label label-pill label-warning">Inactive</span></td>
								<?php }?>
							<td>
								<button onclick="editjobseeker(<?php echo $data['userID']?>)"  class="btn btn-inline btn-primary btn-sm ladda-button" data-style="expand-right" data-size="s"><span class="ladda-label glyphicon glyphicon-pencil"></span><span class="ladda-spinner"></span></button>
								<button onclick="deletejobseeker(<?php echo $data['userID']?>)" class="btn btn-inline btn-danger btn-sm ladda-button" data-style="expand-right" data-size="s"><span class="ladda-label glyphicon glyphicon-trash"></span><span class="ladda-spinner"></span></button>
							</td>							
						</tr>
						<?php  $ctr++;}?>
						</tbody>
					</table>
					<?php }else { ?>
					<div class="add-customers-screen tbl" style="height: 240px;">
					<div class="add-customers-screen-in">
						<div class="add-customers-screen-user">
							<i class="font-icon font-icon-user"></i>
						</div>
						<h2>Your Jobseeker list is empty</h2>						
					</div>
				</div>
					<?php }?>
				</div>
			</section>
			
		</div><!--.container-fluid-->
</div><!--.page-content-->

<div class="modal fade bd-example-modal-sm" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
            	<div id="formError" class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<span id="errMsg"></span>
				</div>
                <form id="jobseekerlist" name="form-signin_v2" method="POST">
					<fieldset class="form-group">	
						<label class="form-label" for="signup_v1-firstName">First Name</label>				
						<input name="firstName"
							   type="text"
							   class="form-control"
							   data-validation="[NOTEMPTY]">
					</fieldset>
					<fieldset class="form-group">
						<label class="form-label" for="signup_v1-lastName">Last Name</label>
						<input name="lastName"
							   type="text"
							   class="form-control"
							   data-validation="[NOTEMPTY]">
					</fieldset>
					<fieldset class="form-group">	
						<label class="form-label" for="signup_v1-email">Email</label>					
						<input name="email"
							   type="text"
							   readonly="readonly" 
							   class="form-control"
							   data-validation="[NOTEMPTY]">
					</fieldset>
					<fieldset class="form-group">	
						<label class="form-label" for="signup_v1-email">Phone</label>					
						<input name="phone"
							   type="text"
							   readonly="readonly" 							    
							   class="form-control"
							   data-validation="[NOTEMPTY]">
					</fieldset>
					<fieldset class="form-group">	
						<label class="form-label" for="signup_v1-status">Status</label>
						<div class="radio">
							<input type="radio" name="status" id="s1" value="0" >
							<label for="s1">Inactive </label>
							<input type="radio" name="status" id="s2" value="1" >
							<label for="s2">Active </label>
						</div>																
					</fieldset>		
					<input type="hidden" name="_id"/>			
				</form>
            </div>
            <div class="modal-footer">

            	<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="btnSave" onclick="jksave()" class="btn btn-rounded btn-primary swal-btn-success">Save changes</button>                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



