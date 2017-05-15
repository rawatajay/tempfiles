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
            <section class="box-typical">
                <header class="box-typical-header-sm"><br/> </header>
                <article class="profile-info-item">
                    <div class="text-block text-block-typical">
                        <div class="col-xl-12">
                    		<div class="row m-t-lg">								
								<div class="col-md-6">
									<div class="alert alert-danger alert-no-border" style="display:none"><p></p></div>
								 	
            						<div class="alert alert-success" style="display:none"><p></p></div>
									<form id="form-signup_v1" name="form-signup_v1" method="POST" ng-controller="empAccountController" ng-init="getRecords()">
										<div class="form-group">
											<label class="form-label" for="userID">Select Employee</label>
											<div class="form-control-wrapper">
												<select id="userID" ng-model="tempEmpData.userID"
													   class="form-control" ucwords name="userID"  ng-change="getEmpID()">
													<option value="">--- Please select Employee ---</option>
													<option ng-repeat="emp in employees"  value="{{emp.userID}}" > {{emp.name | ucwords}} - {{emp.empId }}</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="username">Employee User Name</label>
											<div class="form-control-wrapper">
												<mark ng-bind="tempEmpData.empId"> </mark>
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="userType">Employee User Type</label>
											<div class="form-control-wrapper">
												<select id="userType"
													   class="form-control" name="userType" ng-model="tempEmpData.userType">
													<option value="">--- Please select Employee Type ---</option>
													<option ng-repeat="empType in employeeTypes"  value="{{empType.id}}" > {{empType.name | ucwords}}</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="password">Password</label>
											<div class="form-control-wrapper">
												<input id="password"
													   class="form-control" name="password" type="password"  ng-model="tempEmpData.password" />
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="repassword">Re-enter Password</label>
											<div class="form-control-wrapper">
												<input id="repassword"
													   class="form-control" name="repassword" type="password" ng-model="tempEmpData.repassword" />
											</div>
										</div>
										<div class="form-group">
											<button type="button" ng-click="createAccount()" class="btn">Create account!</button>
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
        
        
 