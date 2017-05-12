<div class="page-content">
    
                
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2>
							<div class="col-md-4">
							<?php echo $page_name?>
							</div>
							 
							
							  <div class="col-md-4">
							  	<span id="_totalCompany" <?php  if($datasetDetail->datasetCount =="0" || empty($datasetDetail->datasetCount)){?>style="display: none" <?php } ?>   class="text-muted  ">Total Companies 
							  		<span class="label countsCompany label-custom label-pill label-danger"><?php echo $datasetDetail->datasetCount ;?></span>
							  	</span>
							  </div>

							  <div class="col-md-4 ">
							  	<button  id="_getCompanyCountClick" class="btn btn-primary btn btn-rounded pull-right">Get Company Counts</button>
							  </div>
							
							</h2>							
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
						<label class="form-label" for="country">Status</label>	
						<select id="datasetstatus"  class="form-control" name="status"    data-validation="[NOTEMPTY]"
							   data-validation-message="Select 1 option">
							   <option value="">-- Select status --</option>
							   <option <?php if($datasetDetail->status =="1") echo "selected"?> value="1">Active</option>
							   <option <?php if($datasetDetail->status =="2") echo "selected"?> value="2">Inactive</option>
						</select>
					</fieldset>
                    
                                        <fieldset class="form-group col-md-6">
                                            
						<label class="form-label" for="companyage">Company Age</label>	
						<select name="companyAge" class="form-control select2" id="companyAge"   data-validation="[NOTEMPTY]"
							   data-validation-message="Select 1 founded year">
							   <option value="">-- Select Option --</option>
                                                           <?php for($val=1 ; $val <=11 ;$val++ ){  
                                                                           ?>
                                                             <option  <?php if($datasetDetail->companyAge ==$val) echo 'selected'; ?> value="<?php echo $val; ?>"><?php if($val==11) echo '10+' ;else echo $val; ?></option>
                                                           <?php } ?>
						</select>
                                        </fieldset>
                    
                    
                                          <fieldset class="form-group col-md-6">
						<label class="form-label" for="funcArea">Industry</label>	

						<select name="funcArea" class="select2" id="funcArea"   data-validation="[NOTEMPTY]"
							   data-validation-message="Select atleast 1 option">
							   <option value="">-- Select Option --</option>							  
							<?php if($funtionalArealist){ foreach($funtionalArealist as $fv){?>
                                                           
								<option <?php if($datasetDetail->functionalID ==$fv['functionalID']) echo 'selected'; ?>  value="<?php echo $fv['functionalID']?>"><?php echo ucwords($fv['functionalName'])?></option>
							<?php }}?>							
						</select>					
					</fieldset>
                                        <fieldset class="form-group col-md-6">
                                      	<label class="form-label" for="employee range">Employee Range</label>	
                                       <select name="emprange[]"  class="select2"  multiple id="emprange"  data-validation="[NOTEMPTY]"
							   data-validation-message="Select atleast 1 option">
							   <option value="">-- Select Option --</option>
							   
                                                   <?php  if($rangelist){ foreach($rangelist as $range){
                                                           $datarange =explode(',',$datasetDetail->empRange) ;  
                                                         
                                                       ?>
                                                    <option <?php  if(in_array($range['emprangeID'],$datarange)) echo 'selected'; ?> value="<?php echo $range['emprangeID']?>"><?php echo ucwords($range['rangeValue'])?></option> 
                                                                                                              
							<?php }}?>      
                                                            
                                                         
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
						
					</fieldset>
                    
                                        <fieldset class="form-group col-md-6">
						<label class="form-label" for="description">Description</label>				
						<textarea rows="5" name="description" class="form-control" placeholder="Description" data-validation="[NOTEMPTY]"><?php echo $datasetDetail->description?></textarea>
					</fieldset>								


					<input type="hidden" id="datacount" name="datacount" value="<?php echo ($datasetDetail->datasetCount)?$datasetDetail->datasetCount:''; ?>"/>
					<?php if(!empty($datasetDetail->datasetId)){?>
					<input type="hidden" id="_dID" name="_dID" value="<?php echo $datasetDetail->datasetId?>"/>
					<input type="hidden" id="_conID" name="_conID" value="<?php echo $datasetDetail->country?>"/>
					<input type="hidden" id="_stID" name="_stID" value="<?php echo $datasetDetail->state?>"/>
					<input type="hidden" id="_ciID" name="_ciID" value="<?php echo $datasetDetail->city?>"/>	
                                         
					<button type="button" onclick="dataset_save('update')"  class="btn  btn-info swal-btn-success">Save changes</button>			
					<?php } else {?>
				 	<button type="button" onclick="dataset_save('add')"  class="btn btn-rounded btn-info swal-btn-success">Save changes</button>			
					<?php }?> 
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