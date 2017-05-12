<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2><?php echo $page_name?>
							 <a href="<?php echo base_url()?>admin/exportcompany" ><button style="float: right"  type="button" class="btn btn-rounded btn-inline"><i class="fa fa-download"></i> Export <?php echo $page_name?></button></a>
							 <a href="<?php echo base_url()?>admin/importcompany" ><button style="float: right"  type="button" class="btn btn-rounded btn-inline"><i class="fa fa-upload"></i> Import <?php echo $page_name?></button></a>
							 <a href="<?php echo base_url()?>admin/company" ><button style="float: right"  type="button" class="btn btn-rounded btn-inline">Add <?php echo $page_name?></button></a>
							</h2>							
						</div>
					</div>
				</div>
			</header>
			<section class="card">
				<div class="card-block">
                                    
                                   
					<?php if(!empty($companylist)){?>
					<table id="datalist" class="display table table-bordered jhtable" cellspacing="0" width="100%">
						<thead>
							<tr>         
                                    <th>S.No</th>
                                    <th>Company Name</th>
	                            <th >Contact Name</th>
	                            <th >Company Email</th>	                                                       
	                            <th >Contact Number</th>
                                     <th >Industry</th>
                                     <th >Country</th>
	                            <th >State</th>	                                                       
	                            <th >City</th>
	                            <th >Status</th>
	                            <th >Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>S.No</th>
									<th >Company Name</th>
									<th>Contact Name</th>
									<th>Company Email</th>									
									<th>Contact Number</th>
                                                                         <th >Industry</th>
                                                                        <th >Country</th>
                                                                       <th >State</th>	                                                       
                                                                       <th >City</th>
									<th >Status</th>
									<th >Action</th>
							</tr>
						</tfoot>
						<tbody>	
						<?php $ctr=1; foreach($companylist as $data) {      ?> 				
							<tr>
                                <td><?php echo $ctr; ?></td>
                                <td ><?php echo $data['companyName']; ?></td>
                                <td ><?php echo $data['primarycontactname']; ?></td>
                                <td ><?php echo $data['primaryEmail']; ?></td>                 
                                <td ><?php echo $data['contactnumbers']; ?></td>	
                                <td ><?php echo $data['functionalName']; ?></td>
                                <td ><?php echo $data['countryName']; ?></td>
                                <td ><?php echo $data['stateName']; ?></td>                 
                                <td ><?php echo $data['cityName']; ?></td>	
                                <?php if($data['status'] == '1') {?>
								<td>	<span class="label label-pill label-success">Active</span></td>
								<?php }else if($data['status'] == '2'){?>
								<td>	<span class="label label-pill label-warning">Inactive</span></td>
								<?php }?>
							<td>
								<!-- <button onclick="company_edit(<?php echo $data['companyID']; ?>)"  class="btn btn-inline btn-primary btn-sm ladda-button" data-style="expand-right" data-size="s"><span class="ladda-label glyphicon glyphicon-pencil"></span><span class="ladda-spinner"></span></button> -->
								<a href="<?php echo base_url() ."admin/company/edit/". $data['companyID']?>"><button  class="btn btn-inline btn-primary btn-sm ladda-button" data-style="expand-right" data-size="s"><span class="ladda-label glyphicon glyphicon-pencil"></span><span class="ladda-spinner"></span></button></a>
								<button onclick="company_delete(<?php echo $data['companyID']; ?>)" class="btn btn-inline btn-danger btn-sm ladda-button" data-style="expand-right" data-size="s"><span class="ladda-label glyphicon glyphicon-trash"></span><span class="ladda-spinner"></span></button>
							</td>							
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
						<div class="col-md-6">
						<label class="form-label" for="companyName">Comapny Name</label>				
						<input name="companyName"
							   type="text"
							   placeholder="Company Name" 
							   class="form-control"
							   data-validation="[NOTEMPTY]">
						</div>
						<div class="col-md-6">
						<label class="form-label" for="signup_v1-status">Company Description</label>
						<textarea rows="1" name="description" class="form-control" placeholder="Company Description"></textarea>
						</div>
					</fieldset>				
					
					
					<fieldset class="form-group">
						<div class="col-md-6">	
						<label class="form-label" for="contactName">Contact Name</label>				
						<input name="contactName"
							   type="text"
							   placeholder="Contact Name" 
							   class="form-control"
							   data-validation="[NOTEMPTY]">
						</div>
						<div class="col-md-6">
						<label class="form-label" for="contactEmail">Contact Email</label>				
						<input name="contactEmail"
							   type="text"
							   placeholder="Contact Email" 
							   class="form-control"
							   data-validation="[NOTEMPTY]">
						</div>
					</fieldset>										
					<fieldset class="form-group">
						<div class="col-md-6">
						<label class="form-label" for="funArea">Functional Area</label>	

						<select name="funArea[]" class="select2" multiple="multiple">
							<?php if($funtionalArealist){ foreach($funtionalArealist as $fv){?>
								<option value="<?php echo $fv['functionalID']?>"><?php echo ucwords($fv['funationalName'])?></option>
							<?php }}?>							
						</select>
						</div>
						<div class="col-md-6">
						<label class="form-label" for="website">Website</label>				
						<input name="website"
							   type="text"
							   placeholder="Website" 
							   class="form-control"
							   data-validation="[NOTEMPTY]">
						</div>
					</fieldset>
					<fieldset class="form-group">	
						<div class="col-md-6">
						<label class="form-label" for="title">Contact Number</label>				
						<input name="contactNumber"
							   type="text"
							   class="form-control"
							   data-validation="[NOTEMPTY]">
						</div>
						<div class="col-md-6">
						<label class="form-label" for="Address">Address</label>				
						<textarea rows="1" name="address" class="form-control" placeholder="Address"></textarea>
						</div>
					</fieldset>
					
					<fieldset class="form-group">
						<div class="col-md-6">	
						<label class="form-label" for="signup_v1-status">Status</label>
						<div class="radio">
							<input type="radio" name="status" id="s1" value="2" >
							<label for="s1">Inactive </label>
							<input type="radio" name="status" id="s2" value="1" >
							<label for="s2">Active </label>
						</div>
						</div>	
						<div class="col-md-6">
						<label class="form-label" for="signup_v1-status">Logo</label>
						<span class="btn btn-rounded btn-file">
                        	<span>Choose file</span>
                     		<input type="file" name="profilepic" multiple>
                        </span>
                        <span> Max Image size 500 KB.</span>
                        </div>															
					</fieldset>	
					<fieldset class="form-group">	
						
                        <div  id="companyUploadedLogo" style="display: none;">
							<div class="profile-card class="col-md-6"">
	                        	<div class="profile-card-photo">
									<img  src="" alt="">
									<input type="hidden" name="_imgval" id="_imgval" value=""/>
								</div>
							</div>
                        </div>
					</fieldset>	                  
					<input type="hidden" name="_id"/>			
				</form>
            </div>
            <div class="modal-footer">

            	<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="btnSave" onclick="company_save()" class="btn btn-rounded btn-primary swal-btn-success">Save changes</button>                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<style type="text/css">
.modal-body{
  height: 500px;
  overflow-y: auto;
}
</style>



