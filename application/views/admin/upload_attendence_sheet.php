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
            <section class="card" >
                <div class="card-block">
            		<div class="row m-t-lg">								
						<div class="col-md-12" ng-controller="AttandanceController">
							<div class="alert alert-danger alert-no-border" style="display:none"><p></p></div>
						 	
    						<div class="alert alert-success" style="display:none"><p></p></div>
    						<div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
							<form id="leaveform" name="form-signup_v1" method="POST"  enctype="multipart/form-data">
								<div class="row">
									<div class="form-group col-md-4">
										<label class="form-label" for="signup_v1-leavestartdate">Upload csv file</label>
										<div class="fileinput fileinput-new" data-provides="fileinput">
										    <span class="btn btn-rounded btn-inline btn-info-outline btn-file ">	<span>Choose file</span>
										     	<input type="file" file-model="myFile"/>
								    		</span>
										    <span class="fileinput-filename"></span><span  class="fileinput-new"></span>
										</div>
									</div>
									<div class="form-group col-md-3">
									 	<label class="form-label" for="signup_v1-leavestartdate">Year/Month</label>
							            <div class='input-group date ' >
							                <input type='text' name="monthYear" type="text" ng-model="tempdatamonthYear" class="form-control monthYear" />
							               <!--  <span class="input-group-addon">
							                    <span class="glyphicon glyphicon-calendar">
							                    </span>
							                </span> -->
							            </div>
							        </div>
									<div class="form-group col-md-3 col-md-offset-2">
										<label class="form-label" for="signup_v1-leavestartdate">Download Sample</label>
										<div class="form-control-wrapper">
											<a  href="<?php echo base_url('assets/sample_attandancesheet.csv') ?>" class="btn btn-rounded btn-inline btn-info-outline">Download <i class="fa fa-download"></i></a>

										</div>
									</div>
									
								</div>


								<div class="form-group">
									<button type="button " ng-click="uploadattandatesheet('save')" class="btn uploadattandatesheet-btn">Upload File</button>
								</div>
							</form>
						</div>
					</div><!--.row-->
				</div>
            </section><!--.box-typical-->           
        </div><!--.row-->   
    </div><!--.container-fluid-->
</div><!--.page-content-->
        
        
 