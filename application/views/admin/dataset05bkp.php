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
				
                <form id="datasetform"  method="POST" action="<?php echo base_url()?>admin/dataset/add">
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="title">Title</label>				
						<input name="title"
							   type="text"
							   value="<?php echo $datasetDetail->title?>"
							   placeholder="Title" 
							   class="form-control"
							   data-validation="[NAME]"
							   data-validation-message="Enter valid Title ">						
					</fieldset>	
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="mktgmessage">Marketting Message</label>				
						<input name="mktgmessage"
							   type="text"
							   value="<?php echo $datasetDetail->markettingMessage?>"
							   placeholder="Marketting Message" 
							   class="form-control"
							   data-validation="[NAME]"
							   data-validation-message="Enter valid Marketting Message "
							   >
					</fieldset>
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="price">Price</label>				
						<input name="price"
							   type="text"
							   value="<?php echo $datasetDetail->price?>"
							   placeholder="Price" 
							   class="form-control"
							   data-validation="[NUMERIC]"
							   data-validation-message="Enter valid Price "
							   >
					</fieldset>
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="discount">Discount</label>				
						<input name="discount"
							   type="text"
							   value="<?php echo $datasetDetail->discount?>"
							   placeholder="Discount" 
							   class="form-control"
							   data-validation="[NUMERIC]"
							   data-validation-message="Enter valid Discount "
							   >
					</fieldset>
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="description">Description</label>				
						<textarea rows="1" name="description" class="form-control" placeholder="Description" data-validation="[NOTEMPTY]"><?php echo $datasetDetail->description?></textarea>
					</fieldset>								
					<fieldset class="form-group col-md-6">						
						<label class="form-label" for="country">Status</label>	
						<select id="datasetstatus"  class="form-control" name="status"    data-validation="[NOTEMPTY]"
							   data-validation-message="Select 1 option">
							   <option value="">-- Select status --</option>
							   <option <?php if($datasetDetail->status =="1") echo "selected"?> value="1">Active</option>
							   <option <?php if($datasetDetail->status =="2") echo "selected"?> value="2">Inactive</option>
						</select>
					</fieldset>
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="country">Country</label>	
						<select id="countrydata" onchange="_getState(this.value)" class="form-control" name="country"    data-validation="[NOTEMPTY]"
							   data-validation-message="Select 1 country">
							   <option value="">-- Select country --</option>							  
							<?php if($countrylist){ foreach($countrylist as $cv){?>
								<option <?php if($datasetDetail->country ==  $cv['id']) echo "selected"?> value="<?php echo $cv['id']?>"><?php echo ucwords($cv['name'])?></option>
							<?php }}?>							
						</select>
					</fieldset>

					<fieldset class="form-group col-md-6">
						<label class="form-label" for="statedata">State</label>	
							<select name="state" onchange="_getCity(this.value)" id="statedata" class="form-control"   data-validation="[NOTEMPTY]"
							   data-validation-message="Select 1 state">
							   <option value="">-- Select Option --</option>							  
							</select>
					</fieldset>
					<fieldset class="form-group col-md-6">
						<label class="form-label" for="city">City</label>	
						<select name="city[]" class="select2"  multiple id="citydata"   data-validation="[NOTEMPTY]"
							   data-validation-message="Select 1 city">
							   <option value="">-- Select Option --</option>
						</select>
						<h5 id="_totCompany"  <?php if($totalcompaies){?>style="display: none" <?php } ?>><small  class="text-muted">Total Companies <span class="label counterCompany label-custom label-pill label-danger">$data['totalcompaies']</span><?php echo $totalcompaies?></small></h5>
					</fieldset>


					
					<?php if(!empty($datasetDetail->datasetId)){?>
					<input type="hidden" id="_dID" name="_dID" value="<?php echo $datasetDetail->datasetId?>"/>
					<input type="hidden" id="_conID" name="_conID" value="<?php echo $datasetDetail->country?>"/>
					<input type="hidden" id="_stID" name="_stID" value="<?php echo $datasetDetail->state?>"/>
					<input type="hidden" id="_ciID" name="_ciID" value="<?php echo $datasetDetail->city?>"/>	
					<button type="button" onclick="dataset_save('update')"  class="btn  btn-info swal-btn-success">Save changes</button>			
					<? } else {?>
				 	<button type="button" onclick="dataset_save('add')"  class="btn btn-rounded btn-info swal-btn-success">Save changes</button>			
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



