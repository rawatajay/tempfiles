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
        <div class="row">
            <section class="box-typical">
                <header class="box-typical-header-sm"><br/> </header>
                <article class="profile-info-item">

                    <div class="text-block text-block-typical">
                        <div class="col-xl-12">
                    		<div class="row m-t-lg">								
								<div class="col-md-6">
								 	<div class="alert alert-danger alert-no-border" style="display:none"><p></p></div>
								 	
            						<div class="alert alert-success alert-no-borde" style="display:none"><p></p></div>
									<form id="form-signup_v1" name="form-signup_v1" method="POST" ng-controller="empAddController">
										<div class="form-group">
											<label class="form-label" for="signup_v1-empname">Employee Name</label>
											<div class="form-control-wrapper">
												<input id="empname" class="form-control" ng-model="tempEmpData.empname" name="empname" type="text" />
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="signup_v1-empfathername">Employee Father Name</label>
											<div class="form-control-wrapper">
												<input id="empfathername" ng-model="tempEmpData.empfathername" class="form-control" name="empfathername" type="text" />
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="signup_v1-email">Email</label>
											<div class="form-control-wrapper">
												<input id="email" ng-model="tempEmpData.email" class="form-control" name="email" type="text" />
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="signup_v1-gender">Gender</label>
											<div class="form-control-wrapper">
												<select class="form-control" ng-model="tempEmpData.gender" name="gender" id="gender">
												    <option value="1">Male</option>
												    <option value="2">Female</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="signup_v1-contact">Contact</label>
											<div class="form-control-wrapper">
												<input id="contact" ng-model="tempEmpData.contact" class="form-control" name="contact" type="text" />
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="signup_v1-address">Address</label>
											<div class="form-control-wrapper">
												<textarea id="address" ng-model="tempEmpData.address" class="form-control" name="address"> </textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="signup_v1-dob">Date Of Birth</label>
											<div class="form-control-wrapper">
												<input id="dob" ng-model="tempEmpData.dob" class="form-control" name="dob" type="text" />
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" ng-model="doj" for="signup_v1-doj">Date Of Joining</label>
											<div class="form-control-wrapper">
												<input id="doj" ng-model="tempEmpData.doj" class="form-control" name="doj" type="text" />
											</div>
										</div>
										<div class="form-group">
											<button type="button" ng-click="saveEmployee()" class="btn">Sign up!</button>
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
        
        
 