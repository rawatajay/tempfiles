<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2><?php echo $page_name?>
							<button style="float: right" onclick="add_form()" type="button" class="btn btn-rounded btn-inline">Add <?php echo $page_name?></button>
							</h2>							
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
					<?php if(!empty($jobtypeList)){?>
					<table id="datalist" class="display table table-bordered jhtable" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>S.No</th>
							<th>Title</th>							
							<th>Status</th>
							<th>Action</th>							
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>S.No</th>
							<th>Title</th>							
							<th>Status</th>
							<th>Action</th>	
						</tr>
						</tfoot>
						<tbody>	
						<?php $ctr=1; foreach($jobtypeList as $data) {?>					
						<tr>
							<td><?php echo $ctr;?></td>
							<td><?php echo ucwords($data['type'])?></td>							
							<td>
								<?php if($data['status'] == '1') {?>
									<span class="label label-pill label-success">Active</span></td>
								<? }else if($data['status'] == '2'){?>
									<span class="label label-pill label-warning">Inactive</span></td>
								<? }?>
							<td>
								<button onclick="editType(<?php echo $data['jobtypeID']?>)"  class="btn btn-inline btn-primary btn-sm ladda-button" data-style="expand-right" data-size="s"><span class="ladda-label glyphicon glyphicon-pencil"></span><span class="ladda-spinner"></span></button>
								<button onclick="deleteType(<?php echo $data['jobtypeID']?>)" class="btn btn-inline btn-danger btn-sm ladda-button" data-style="expand-right" data-size="s"><span class="ladda-label glyphicon glyphicon-trash"></span><span class="ladda-spinner"></span></button>
							</td>							
						</tr>
						<? $ctr++;}?>
						</tbody>
					</table>
					<? }else {?>
					<div class="add-customers-screen tbl" style="height: 240px;">
					<div class="add-customers-screen-in">
						<div class="add-customers-screen-user">
							<i class="font-icon font-icon-user"></i>
						</div>
						<h2>Your <?php echo $page_name?> list is empty</h2>						
					</div>
				</div>
					<? }?>
				</div>
			</section>
			
		</div><!--.container-fluid-->
</div><!--.page-content-->

<div class="modal fade bd-example-modal-sm" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Edit User</h3>
            </div>
            <div class="modal-body form">
            	<div id="formError" class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">

					<span id="errMsg"></span>
				</div>
                <form id="companyform" name="form-signin_v2" method="POST">
					<fieldset class="form-group">	
						<label class="form-label" for="companyName">Comapny Name</label>				
						<input name="companyName"
							   type="text"
							   placeholder="Company Name" 
							   class="form-control"
							   data-validation="[NOTEMPTY]">
					</fieldset>					
					<fieldset class="form-group">	
						<label class="form-label" for="signup_v1-status">Company Description</label>
						<textarea rows="2" name="companyDescription" class="form-control" placeholder="Company Description"></textarea>
					</fieldset>	
					
					<fieldset class="form-group">	
						<label class="form-label" for="contactName">Contact Name</label>				
						<input name="contactName"
							   type="text"
							   placeholder="Contact Name" 
							   class="form-control"
							   data-validation="[NOTEMPTY]">
					</fieldset>	
					<fieldset class="form-group">	
						<label class="form-label" for="anothercontactName">Another Contact Name</label>				
						<input name="anothercontactName"
							   type="text"
							   placeholder="Another Contact Name" 
							   class="form-control"
							   data-validation="[NOTEMPTY]">
					</fieldset>
					<fieldset class="form-group">	
						<label class="form-label" for="contactName">Contact Email</label>				
						<input name="contactEmail"
							   type="text"
							   placeholder="Contact Email" 
							   class="form-control"
							   data-validation="[NOTEMPTY]">
					</fieldset>	
					<fieldset class="form-group">	
						<label class="form-label" for="website">Website</label>				
						<input name="website"
							   type="text"
							   placeholder="Website" 
							   class="form-control"
							   data-validation="[NOTEMPTY]">
					</fieldset>	
					<fieldset class="form-group">	
						<label class="form-label" for="website">Address</label>				
						<textarea rows="2" name="Address" class="form-control" placeholder="Address"></textarea>
					</fieldset>	
					<fieldset class="form-group">	
						<label class="form-label" for="signup_v1-status">Status</label>
						<div class="radio">
							<input type="radio" name="status" id="s1" value="2" >
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
				<button type="button" id="btnSave" onclick="save()" class="btn btn-rounded btn-primary swal-btn-success">Save changes</button>                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



