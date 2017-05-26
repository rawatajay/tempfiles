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
        <div class="row" ng-controller="empAddController" ng-init="getRecords()">
        	<section class="tabs-section">
				<div class="tabs-section-nav tabs-section-nav-icons">
					<div class="tbl">
						<ul class="nav" role="tablist">
							<li class="nav-item">
								<a class="nav-link personalinfotab active" href="#tabs-1-tab-1" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<i class="font-icon font-icon-users"></i>
										Personal Info
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link hrinfotab" href="#tabs-1-tab-2" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<i class="fa fa-user-secret"></i>
										HR Info
									</span>
								</a>
							</li>
							<li class="nav-item ">
								<a class="nav-link accountinfotab" href="#tabs-1-tab-3" role="tab" data-toggle="tab">
									<span class="nav-link-in">
										<i class="fa fa-lock"></i>
										Account Info
									</span>
								</a>
							</li>
						</ul>

					</div>
				</div><!--.tabs-section-nav-->

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in  active" id="tabs-1-tab-1">
						<header class="box-typical-header-sm"><br/> </header>
		                <article class="profile-info-item">
		                    <div class="text-block text-block-typical">
		                        <div class="col-xl-12">
		                    		<div class="row m-t-lg">								
										<div class="col-md-12">
										 	<div class="alert alert-danger alert-no-border" style="display:none"><p></p></div>
										 	
		            						<div class="alert alert-success alert-no-borde" style="display:none"><p></p></div>
											<form id="form-signup_v1" name="form-signup_v1" method="POST" >
												<div class="row">
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-empname">Employee Name</label>
														<div class="form-control-wrapper">
															<input id="empname" class="form-control" ng-model="tempEmpData.empname" name="empname" type="text" />
														</div>
													</div>
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-empfathername">Employee Father Name</label>
														<div class="form-control-wrapper">
															<input id="empfathername" ng-model="tempEmpData.empfathername" class="form-control" name="empfathername" type="text" />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-email">Email</label>
														<div class="form-control-wrapper">
															<input id="email" ng-model="tempEmpData.email" class="form-control" name="email" type="text" />
														</div>
													</div>
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-gender">Gender</label>
														<div class="form-control-wrapper">
															<select class="form-control" ng-model="tempEmpData.gender" name="gender" id="gender">
															    <option value="">-- Select Gender --</option>
															    <option value="1">Male</option>
															    <option value="2">Female</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-contact">Contact</label>
														<div class="form-control-wrapper">
															<input id="contact" ng-model="tempEmpData.contact" class="form-control" name="contact" type="text" />
														</div>
													</div>
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-dob">Date Of Birth</label>
														<div class="form-control-wrapper">
															<input id="dob" ng-model="tempEmpData.dob" class="form-control" name="dob" type="text" />
														</div>
													</div>
												</div>
												<div class="row">									
													<div class="form-group col-md-12">
														<label class="form-label" for="signup_v1-address">Address</label>
														<div class="form-control-wrapper">
															<textarea id="address" ng-model="tempEmpData.address" class="form-control" name="address"> </textarea>
														</div>
													</div>
													
													
													<div class="form-group col-md-6">
														<button type="button" ng-click="saveEmployee('save')" class="btn signup-personal-btn">Sign up!</button>
													</div>
												</div>
											</form>
										</div>
									</div><!--.row-->
		                        </div>
		                    </div>
		                </article><!--.profile-info-item-->

					</div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-2">
						<header class="box-typical-header-sm"><br/> </header>
		                <article class="profile-info-item">
		                    <div class="text-block text-block-typical">
		                        <div class="col-xl-12">
		                    		<div class="row m-t-lg">								
										<div class="col-md-12">
										 	<div class="alert alert-danger alert-no-border" style="display:none"><p></p></div>
										 	
		            						<div class="alert alert-success alert-no-borde" style="display:none"><p></p></div>
											<form id="form-signup_v1" name="form-signup_v1" method="POST" >
												<div class="row">
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-empid">Employee Code</label>
														<div class="form-control-wrapper">
															<input id="empid" class="form-control" ng-model="tempEmpData.empid" name="empid" type="text" />
														</div>
													</div>
													<div class="form-group col-md-6">
														<label class="form-label" ng-model="doj" for="signup_v1-doj">Date Of Joining</label>
														<div class="form-control-wrapper">
															<input id="doj" ng-model="tempEmpData.doj" class="form-control" name="doj" type="text" />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label class="form-label" for="userdepart">Employee Department</label>
														<div class="form-control-wrapper">
															<select id="userdepart"
																   class="form-control" name="userdepart" ng-model="tempEmpData.userdepart">
																<option value="">--- Please select Employee Department ---</option>
																<option ng-repeat="empDepart in departments"  value="{{empDepart.id}}" > {{empDepart.name | ucwords}}</option>
															</select>
														</div>
													</div>
													<div class="form-group col-md-6">
														<label class="form-label" for="userdesign">Employee Designation</label>
														<div class="form-control-wrapper">
															<select id="userdesign"
																   class="form-control" name="userdesign" ng-model="tempEmpData.userdesign">
																<option value="">--- Please select Employee Designation ---</option>
																<option ng-repeat="empDesg in designations"  value="{{empDesg.id}}" > {{empDesg.name | ucwords}}</option>
															</select>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-empEmergencyContactPersonName">Employee Emergency Contact Person Name</label>
														<div class="form-control-wrapper">
															<input id="empEmergencyContactPersonName" class="form-control" ng-model="tempEmpData.empEmergencyContactPersonName" name="empEmergencyContactPersonName" type="text" />
														</div>
													</div>

													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-empEmergencyContactNumber">Employee Emergency Contact No.</label>
														<div class="form-control-wrapper">
															<input id="empEmergencyContactNumber" class="form-control" ng-model="tempEmpData.empEmergencyContactNumber" name="empEmergencyContactNumber" type="text" />
														</div>
													</div>
												</div>
												<div class="row">
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-empEmergencyContactPersonRelation">Employee Emergency Contact Person Relation</label>
														<div class="form-control-wrapper">
															<input id="empEmergencyContactPersonRelation" class="form-control" ng-model="tempEmpData.empEmergencyContactPersonRelation" name="empEmergencyContactPersonRelation" type="text" />
														</div>
													</div>
												</div>
												<div class="form-group">
													<input type="hidden" ng-model="tempEmpData.primary">
													<button type="button" ng-click="updateHrInfo('save')" class="btn signup-hrinfo-btn">Update Info</button>
												</div>
											</form>
										</div>
									</div><!--.row-->
		                        </div>
		                    </div>
		                </article><!--.profile-info-item-->
					</div><!--.tab-pane-->
					<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-3">
						<header class="box-typical-header-sm"><br/> </header>
		                <article class="profile-info-item">
		                    <div class="text-block text-block-typical">
		                        <div class="col-xl-12">
		                    		<div class="row m-t-lg">								
										<div class="col-md-12">
										 	<div class="alert alert-danger alert-no-border" style="display:none"><p></p></div>
										 	
		            						<div class="alert alert-success alert-no-borde" style="display:none"><p></p></div>
											<form id="form-signup_v1" name="form-signup_v1" method="POST" >
												<div class="row">
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-empid">Employee Code</label>
														<div class="form-control-wrapper">
															<span ><b ng-bind="tempEmpData.empTrivialId"></b></span>
														</div>
													</div>
													<div class="form-group col-md-6">
														<label class="form-label" for="signup_v1-empPass">Employee Login Password</label>
														<div class="form-control-wrapper">
															<input id="empPass" class="form-control" ng-model="tempEmpData.empPass" name="empPass" type="text" />
														</div>
													</div>
												</div>
												<div class ="row">
													<div class="form-group col-md-6">
														<label class="form-label" for="userType">Employee User Type</label>
														<div class="form-control-wrapper">
															<select id="userType"
																   class="form-control" name="userType" ng-model="tempEmpData.userType">
																<option value="">--- Please select Employee Type ---</option>
																<option ng-repeat="empType in employeeTypes"  value="{{empType.id}}" > {{empType.name | ucwords}}</option>
															</select>
														</div>
													</div>
													<div class="form-group col-md-6">
														<label class="form-label" for="userStatus">Employee Status</label>
														<div class="form-control-wrapper">
															<select id="userStatus"
																   class="form-control" name="userStatus" ng-model="tempEmpData.userStatus">
																<option value="">--- Please select Employee Status ---</option>
																<option ng-repeat="empStatus in employeeStatus"  value="{{empStatus.id}}" > {{empStatus.value }}</option>
															</select>
														</div>
													</div>
												</div>
												<div class="form-group col-md-6">
													<input type="hidden" ng-model="tempEmpData.primary">
													<button type="button" ng-click="updateAccountInfo('save')" class="btn signup-accinfo-btn">Update Info</button>
												</div>
											</form>
										</div>
									</div><!--.row-->
		                        </div>
		                    </div>
		                </article><!--.profile-info-item-->
					</div><!--.tab-pane-->
				</div><!--.tab-content-->
			</section><!--.tabs-section-->
            <section class="box-typical">
               
            </section><!--.box-typical-->

        </div><!--.row-->   
    </div><!--.container-fluid-->
</div><!--.page-content-->

 