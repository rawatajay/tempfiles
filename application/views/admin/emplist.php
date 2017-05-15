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
            <section class="box-typical" ng-controller="empModifyController">
                <header class="box-typical-header-sm"><br/> </header>
                <article class="profile-info-item">
                    <div class="text-block text-block-typical">
                        
                        <div class="panel-body  col-xl-12" style="display:none" id="editEmpForm">
			                <div class="alert alert-danger alert-no-border" style="display:none"><p></p></div>
						 	
    						<div class="alert alert-success alert-no-border" style="display:none"><p></p></div>
							<form id="form-signup_v1" name="form-signup_v1" method="POST" >
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
									<label class="form-label" for="signup_v1-gender">Gender</label>
									<div class="form-control-wrapper">
										 <select class="form-control" ng-model="tempEmpData.gender" name="gender" id="gender">
										    <option value="">--- Select an option ---</option>
              								<option ng-selected= "{{value.id == tempEmpData.gender}}" ng-repeat="value in genders"  value="{{value.id}}">{{value.value}}     
              		</option>
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
									<input type="hidden" ng-model="tempEmpData.primary" />
									<button type="button" ng-click="updateEmpData()" class="btn btn-primary">Update</button>
									<button type="button" onclick="$('#editEmpForm').slideUp();" class="btn  btn-warning">Close</button>
									
								</div>
							</form>
            			</div>
            			<div class="col-xl-12">
            			<div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
                    	<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%" >
							<thead>
								<tr>
									<th>Empid</th>
									<th>Name</th>
									<th>DOJ</th>
									<th>Address</th>
									<th>DOB</th>
									<th>Email</th>
									<th>Contact</th>
									<th>Gender</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Empid</th>
									<th>Name</th>
									<th>DOJ</th>
									<th>Address</th>
									<th>DOB</th>
									<th>Email</th>
									<th>Contact</th>
									<th>Gender</th>
									<th>Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php foreach($users as $val) { ?>
								<tr>
									<td><?php echo $val['empId']?></td>
									<td><?php echo ucwords($val['name'])?></td>
									<td><?php echo $val['dateOfJoining']?></td>
									<td><?php echo $val['address']?></td>
									<td><?php echo $val['dateOfBirth']?></td>
									<td><?php echo $val['email']?></td>
									<td><?php echo $val['contact']?></td>
									<td><?php echo ucwords($val['gender'])?></td>
									<td>
										<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
											<button type="button" class="btn btn-primary-outline" ng-click="editEmp('<?php echo encrypt_decrypt('encrypt',$val['userID'])?>')"><i class="fa fa-edit"></i></button>
											<button type="button" class="btn btn-danger-outline"><i class="fa fa-remove"></i></button>
											<?php if(!$val['isAccountCreated']){?>
											<button type="button" class="btn btn-secondary-outline" onclick="window.location.href='<?php echo base_url('admin/create_account'); ?>'"><i class="fa fa-lock"></i></button>
											<?php } ?>
										</div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
                        </div>
                    </div>
                </article><!--.profile-info-item-->
            </section><!--.box-typical-->
        </div><!--.row-->   
    </div><!--.container-fluid-->
</div><!--.page-content-->
        
        
 