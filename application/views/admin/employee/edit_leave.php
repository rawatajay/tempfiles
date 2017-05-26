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
            <section class="box-typical" ng-controller="LeaveController" ng-init="getleavedata()">
                <header class="box-typical-header-sm"><br/> </header>
                <article class="profile-info-item">
                    <div class="text-block text-block-typical">
                        <div class="col-xl-12">
                    		<div class="row m-t-lg">								
								<div class="col-md-6">
									<div class="alert alert-danger alert-no-border" style="display:none"><p></p></div>
								 	
            						<div class="alert alert-success" style="display:none"><p></p></div>
									<form id="leaveform" name="form-signup_v1" method="POST"  >
										<div class="form-group">
											<label class="form-label" for="signup_v1-leavestartdate">Leave Start Date</label>
											<div class="form-control-wrapper">
												<input id="leavestartdate" ng-model="tempEmpData.leavestartdate" class="form-control" name="leavestartdate" type="text" />
											</div>
										</div>
										<div class="form-group">
											<label class="form-label"  for="signup_v1-leaveenddate">Leave End Date</label>
											<div class="form-control-wrapper">
												<input id="leaveenddate" ng-model="tempEmpData.leaveenddate" class="form-control" name="leaveenddate" type="text" />
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="signup_v1-leaveTypes">Leave Types</label>
											<div class="form-control-wrapper">
												<select class="form-control" ng-model="tempEmpData.leaveTypes" name="leaveTypes" id="leaveTypes">
												<option value="">--- Select an option ---</option>
												<option ng-selected= "{{value.id == tempEmpData.leaveType}}" ng-repeat="value in leaveTypes"  value="{{value.id}}">{{value.value}}     
												</option>
												</select> 

											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="emergencyContactNumber">Emergency Contact Number</label>
											<div class="form-control-wrapper">
												<input id="emergencyContactNumber"
													   class="form-control" name="emergencyContactNumber" type="text"  ng-model="tempEmpData.emergencyContactNumber" />
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="reason">Reason</label>
											<div class="form-control-wrapper">
												<textarea id="reason" class="form-control" name="reason" ng-model="tempEmpData.reason"></textarea>		
											</div>
										</div>
										<div class="form-group">
											<button type="button" ng-click="applyleave('update')" class="btn applyleave-btn">Update Leave</button>
										</div>
									</form>
								</div>
							</div><!--.row-->
                        </div>
                    </div>
                </article><!--.profile-info-item-->
            </section><!--.box-typical-->
        </div><!--.row-->   
    </div><!--.container-fluid-->
</div><!--.page-content-->
        
        
 