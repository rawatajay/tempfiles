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
									<form id="form-signup_v1" name="form-signup_v1" method="POST" ng-controller="empAddController">
										<div class="form-group">
											<label class="form-label" for="userID">Select Employee</label>
											<div class="form-control-wrapper">
												<select id="userID"
													   class="form-control" name="userID">
													<?php foreach ($users as $key => $val) {
															echo "<option value='".$val['userID']."'>".ucwords($val['empId'])." - ".ucwords($val['name'])."</option>";
														}?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="username">Employee User Name</label>
											<div class="form-control-wrapper">
												<label ><mark id="empId"> EMP_1</mark></label>
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="username">Employee User Type</label>
											<div class="form-control-wrapper">
												<select id="username"
													   class="form-control" name="username">
													<?php foreach ($userTypes as $key => $val) {
															echo "<option value='".$val['id']."'>".ucwords($val['name'])."</option>";
														}?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="password">Password</label>
											<div class="form-control-wrapper">
												<input id="password"
													   class="form-control" name="password" type="password" />
											</div>
										</div>
										<div class="form-group">
											<label class="form-label" for="repassword">Re-enter Password</label>
											<div class="form-control-wrapper">
												<input id="repassword"
													   class="form-control" name="repassword" type="password" />
											</div>
										</div>
										<div class="form-group">
											<button type="button" class="btn">Create account!</button>
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
        
        
 