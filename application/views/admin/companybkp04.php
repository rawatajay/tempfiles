<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2><?php echo $page_name?></h2>							
						</div>
					</div>
				</div>
			</header>
			<section class="card card-inversed">
				<div class="card-block">
            	<div id="formError" style="display: none" class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
            		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<span id="errMsg"></span>
				</div>
				
                <form id="companyform"  method="POST" action="<?php echo base_url()?>admin/company/add">
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="companyName">Company Name</label>				
						<input name="companyName"
							   type="text"
							   value="<?php echo $companyDetail->companyName?>"
							   placeholder="Company Name" 
							   class="form-control"
							   data-validation="[NAME]"
							   data-validation-message="Enter valid Company Name ">						
					</fieldset>	
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="contactName">Contact Name</label>				
						<input name="contactName"
							   type="text"
							   value="<?php echo $companyDetail->primarycontactname?>"
							   placeholder="Contact Name" 
							   class="form-control"
							   data-validation="[NAME]"
							   data-validation-message="Enter valid Contact Name "
							   >
					</fieldset>
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="contactEmail">Contact Email</label>				
						<input name="contactEmail"
							   type="text"
							   value="<?php echo $companyDetail->primaryEmail?>"
							   placeholder="Contact Email" 
							   class="form-control"
							   data-validation="[EMAIL]"
							   data-validation-message="Enter valid Contact Email ">						
					</fieldset>										
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="funArea">Functional Area</label>	

						<select name="funArea" class="select2"   data-validation="[NOTEMPTY]"
							   data-validation-message="Select atleast 1 option">
							   <option value="">-- Select Option --</option>							  
							<?php if($funtionalArealist){ foreach($funtionalArealist as $fv){?>
								<option <?php if($companyDetail->companyFunctionalId ==  $fv['functionalID']) echo "selected"?> value="<?php echo $fv['functionalID']?>"><?php echo ucwords($fv['funationalName'])?></option>
							<?php }}?>							
						</select>					
					</fieldset>
					<fieldset class="form-group col-md-6">
						
						<label class="form-label" for="website">Website</label>				
						<input name="website"
							   type="text"
							   value="<?php echo $companyDetail->website?>"
							   placeholder="Website" 
							   class="form-control"
							   data-validation="[URL]">						
					</fieldset>
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="title">Contact Number</label>				
						<input name="contactNumber"
							   type="text"
							   value="<?php echo $companyDetail->contactnumbers?>"
							   class="form-control"
							   data-validation="[NUMERIC,L>=6, L<=18]">						
					</fieldset>
					<fieldset class="form-group col-md-12">
						<label class="form-label" for="Address">Address</label>				
						<textarea rows="1" name="address" class="form-control" placeholder="Address" data-validation="[NOTEMPTY]"><?php echo $companyDetail->address?></textarea>
					</fieldset>
					
					<fieldset class="form-group col-md-12">
						<div class="col-md-4">
						<label class="form-label" for="country">Country</label>	
						<select id="countrydata" onchange="_getState(this.value)" class="form-control" name="country"    data-validation="[NOTEMPTY]"
							   data-validation-message="Select 1 country">
							   <option value="">-- Select country --</option>							  
							<?php if($countrylist){ foreach($countrylist as $cv){?>
								<option <?php if($companyDetail->country ==  $cv['id']) echo "selected"?> value="<?php echo $cv['id']?>"><?php echo ucwords($cv['name'])?></option>
							<?php }}?>							
						</select>
						</div>
						<div class="col-md-4">
						<label class="form-label" for="statedata">State</label>	
						<select name="state" onchange="_getCity(this.value)" id="statedata" class="form-control"   data-validation="[NOTEMPTY]"
							   data-validation-message="Select 1 state">
							   <option value="">-- Select Option --</option>							  
						</select>
						</div>
						<div class="col-md-4">
						<label class="form-label" for="city">City</label>	
						<select name="city" class="form-control select2" id="citydata"   data-validation="[NOTEMPTY]"
							   data-validation-message="Select 1 city">
							   <option value="">-- Select Option --</option>
						</select>
						</div>		
					</fieldset>
					<fieldset class="form-group col-md-12">
						
						<label class="form-label" for="signup_v1-status">Logo</label>
						<span class="btn btn-rounded btn-file">
                        	<span>Choose file</span>
                     		<input type="file" name="profilepic">
                        </span>
                        <span> Max Image size 500 KB.</span>   
                        <?php if(!empty($companyDetail->logo))  { ?>	
                         <div  id="companyUploadedLogo" >
							<div class="profile-card">
	                        	<div class="profile-card-photo">
									<img  src="<?php echo base_url().'uploads/companyLogo/'.$companyDetail->logo; ?>" alt="">
									<input type="hidden" name="_imgval" id="_imgval" value=""/>
								</div>
							</div>
                        </div> 
                       <?php } ?>						
					</fieldset>	
							
					
					
					<fieldset class="form-group col-md-6">						
							<label class="form-label" id="companyform-status">
								Status 
							</label>
							<div class="radio">
								<input id="s1"
									   name="status"
									   <?php if($companyDetail->status == "1" || $companyDetail->status == "") echo "checked"?>
									    
									   data-validation="[NOTEMPTY]"
									   data-validation-group="companyform-status"
									   data-validation-message="You must select a status"
									   type="radio"
									   value="1">
								<label for="s1">Active</label>
								<input id="s2"
										<?php if($companyDetail->status == "2") echo "checked"?>
									   name="status"
									   data-validation-group="companyform-status"
									   type="radio"
									   value="2">
								<label for="s2">Inactive</label>
							</div>												
					</fieldset>
					<?php if(!empty($companyDetail->companyID)){?>
					<input type="hidden" id="_cID" name="_id" value="<?php echo $companyDetail->companyID?>"/>
					<input type="hidden" id="_conID" name="_conID" value="<?php echo $companyDetail->country?>"/>
					<input type="hidden" id="_stID" name="_stID" value="<?php echo $companyDetail->state?>"/>
					<input type="hidden" id="_ciID" name="_ciID" value="<?php echo $companyDetail->city?>"/>	
					<button type="button" onclick="company_save('update')"  class="btn  btn-info swal-btn-success">Save changes</button>			
					<? } else {?>
				 	<button type="button" onclick="company_save('add')"  class="btn btn-rounded btn-info swal-btn-success">Save changes</button>			
					<? }?> 
				</form>
				</div>
			</section>
			
		</div><!--.container-fluid-->
</div><!--.page-content-->

<style type="text/css">
.modal-body{
  height: 500px;
  overflow-y: auto;
}
</style>



