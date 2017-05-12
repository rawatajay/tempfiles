<!-- start: CSS REQUIRED FOR THIS PAGE ONLY  -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/frontend/plugins/bootstrap-social-buttons/social-buttons-3.css">
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY  -->

<section class="wrapper " >
	<div class="container">

		<div class="row">
		
			<div class="col-md-10 col-md-offset-1 ">
				<!-- BEGIN FORM-->
				
				<div class="stepform">		
					 <div class="serachform">&nbsp;</div>
					<div class="panel-body ">
						<form action="#" role="form" class="smart-wizard form-horizontal" id="form">
							<div id="wizard" class="swMain">
								<ul>
									<li>
										<a href="#step-1">
											<div class="stepNumber">
												1
											</div>
											<!-- <span class="stepDesc"> Step 1
												<br />
												<small>Step 1 description</small> </span> -->
										</a>
									</li>
									<li>
										<a href="#step-2">
											<div class="stepNumber">
												2
											</div>
											<!-- <span class="stepDesc"> Step 2
												<br />
												<small>Step 2 description</small> </span> -->
										</a>
									</li>
									<li>
										<a href="#step-3">
											<div class="stepNumber">
												3
											</div>
											<!-- <span class="stepDesc"> Step 3
												<br />
												<small>Step 3 description</small> </span> -->
										</a>
									</li>
									<li>
										<a href="#step-4">
											<div class="stepNumber">
												4
											</div>
											<!-- <span class="stepDesc"> Step 4
												<br />
												<small>Step 4 description</small> </span> -->
										</a>
									</li>
								</ul>
								<!-- <div class="progress progress-striped active progress-sm">
									<div aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress-bar progress-bar-success step-bar">
										<span class="sr-only"> 0% Complete (success)</span>
									</div>
								</div>  -->

								<div id="step-1" >
									<div class="col-md-8">
										<div class="form-group">
											<label class="col-sm-5 control-label">
												What Are you Looking For?  <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<select  class="form-control search-select search-selectbox" id="dropdown" name="dropdown">
													<option value="">What Are you Looking For?</option>
													<option value="Category 1">Full Time</option>
													<option value="Category 2">Part Time</option>
													<option value="Category 3">Freelance</option>
													<option value="Category 4">Internship</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-5 control-label">
												Where are you Looking For? <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												 <select multiple="multiple" class="search-select search-selectbox" id="dropdown" name="dropdown">
													<option value="">Where are you Looking For?</option>
													<option value="India">Anywhere in India</option>
													<optgroup label="Particular cities">
													    <option value="Lucknow">Lucknow</option>
													    <option value="Delhi">Delhi</option>
													    <option value="Nagpur">Nagpur</option>
													    <option value="Pune">Pune</option>
													    <option value="Mumbai">Mumbai</option>
													    <option value="Bangalore">Bangalore</option>
													    <option value="Kerala">Kerala</option>
													 </optgroup>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-5 control-label">
												Monthly Salary? <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												 <select  id="form-field-select-4 search-selectbox" class="form-control search-select search-selectbox">
													<option value="">Monthly Salary?</option>
													<option value="10000">10000 INR</option>
													<option value="10000_20000">10000 INR - 20000 INR</option>
													<option value="20000+">20000 INR and above</option>										
												</select>
											</div>
										</div>
										<hr>
										
									</div>
									<div class="col-md-4">

									<img src="<?php echo base_url()?>assets/frontend/images/image14.png" alt="" class="animate-if-visible img-responsive pull-left " data-animation-options='{"animation":"fadeInRightBig", "duration":"800"}'>
									
									</div>	
									<div class="col-md-12">
									<div class="form-group">
											<div class="col-sm-2 col-sm-offset-10">
												<a  class="next-step" >Next</a>									
											</div>											
										</div>
										</div>
									<!-- <div style="color: black" class="caption lft slide_title slide_item_left animate-if-visible img-responsive pull-left circle-img" data-animation-options='{"animation":"fadeInRight", "duration":"1000"}'>Looking for job ?	</div> -->
								</div>
								<div id="step-2">
									<div class="col-md-8">
									<div class="col-md-10">
										<div class="form-group ">
											<button class="btn btn-facebook btn-block">
												<i class="fa fa-facebook"></i>
												| Sign Up with Facebook
											</button>											
										</div>
									</div>
										<hr>
										<div class="form-group ">
											<label class="col-sm-3 col-sm-3 control-label">
												First Name <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
											<input type="text" placeholder="First Name" class="form-control" id="firstname" name="firstname">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Last Name <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
											<input type="text" placeholder="Last Name" class="form-control" id="lastname" name="lastname">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Email <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
											<input type="text" placeholder="Email" class="form-control" id="email" name="email">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Password <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
											<input type="text" placeholder="Password" class="form-control" id="password" name="password">
											</div>
										</div>		
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Notify By <span class="symbol required"></span>
											</label>
											<div class="col-sm-7" style="top: 13px;">
											<div class="right">
											<input type="checkbox" id="1" class="checkbox" />
					    					<label for="1">Email</label>
					    					<input type="checkbox" id="2" class="checkbox" />
					    					<label for="2">SMS</label>
					    					<input type="checkbox" id="3" class="checkbox" />
					    					<label for="3">Call</label>
					    					</div>
					    					</div>
										</div>										
										
									</div>

									<div class="col-md-4 ">
										<img style="height: 210px;" src="<?php echo base_url()?>assets/frontend/images/signup-step.png" alt="" class="animate-if-visible img-responsive pull-left " data-animation-options='{"animation":"shake", "duration":"800"}'>

										
									</div>
									<div class="col-md-12">
											<!-- <div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-light-grey back-step btn-block">
													<i class="fa fa-circle-arrow-left"></i> Back
												</button>
											</div> -->
											<div class="form-group">
												<div class="col-sm-offset-10 col-sm-2" >
													<a  class="next-step" >Next</a>								
												</div>											
											</div>
									</div>
								</div>
								<div id="step-3">
									<div class="col-md-4 img-top" >
										<img src="<?php echo base_url()?>assets/frontend/images/step-4.png" alt="" class="img-responsive pull-left " >
									</div>
									<div class="col-md-8">	
										<table class="table table-bordered">
										  <thead class="thead-inverse">
										    <tr>
										    	<th>Academic</th>
										    	<th>College/Board/University</th>
										    	<th>Degree/Diploma</th>				      
										     	<th>Total Percentage (%)</th>
										    </tr>
										  </thead>
										  <tbody>
										    <tr>
										    	<td><b>High School</b></td>      
										      	<td><input type="text" class="form-control" /></td>
										      	<td><input type="text" class="form-control" /></td>
										      	<td><input type="text" class="form-control" /></td>				 
										    </tr>
										    <tr>
										    	<td><b>Intermediate</b></td>      
										      	<td><input type="text" class="form-control" /></td>
										      	<td><input type="text" class="form-control" /></td>
										      	<td><input type="text" class="form-control" /></td>				 
										    </tr>
										    <tr>
										    	<td><b>Graduation</b></td>      
										      	<td><input type="text" class="form-control" /></td>
										      	<td><input type="text" class="form-control" /></td>
										      	<td><input type="text" class="form-control" /></td>				 
										    </tr>
										    <tr>
										    	<td><b>Post Graduation</b></td>      
										      	<td><input type="text" class="form-control" /></td>
										      	<td><input type="text" class="form-control" /></td>
										      	<td><input type="text" class="form-control" /></td>				 
										    </tr>
										    <tr>
										    	<td><b>Other Certification</b></td>      
										      	<td><input type="text" class="form-control" /></td>
										      	<td><input type="text" class="form-control" /></td>
										      	<td><input type="text" class="form-control" /></td>				 
										    </tr>									    
										  </tbody>
										</table>
										<div class="form-group">
											<div class="form-group">
												<div class="col-sm-2 col-sm-offset-9" style="margin-top: 5%;" >
													<a  class="next-step" >Next</a>								
												</div>											
											</div>
										</div>
									</div>									
								</div>
								<div id="step-4">	
									<div class="col-md-8" >
										<div class="form-group">
											<label class="col-md-offset-1 col-md-7 control-label left-align">
												Are you able to Face to Face Interview ? <span class="symbol required"></span>
											</label>
											<div class="col-md-3 " style="top: 13px;">
											<div class="right">
											<input type="radio" id="f1" name="f2f" class="checkbox" />
					    					<label for="f1">Yes</label>
					    					<input type="radio" id="f2" name="f2f" class="checkbox" />
					    					<label for="f2">No</label>
					    					</div>
					    					</div>
										</div>
										<div class="form-group">
											<label class="col-md-offset-1 col-md-7 control-label left-align">
												Has Other Offers<span class="symbol required"></span>
											</label>
											<div class="col-md-3" style="top: 13px;">
											<div class="right">
											<input type="radio" id="oo1" name="oo" class="checkbox" />
					    					<label for="oo1">Yes</label>
					    					<input type="radio" id="oo2" name="oo" class="checkbox" />
					    					<label for="oo2">No</label>
					    					</div>
					    					</div>
										</div>	
										<div class="form-group">
											<label class="col-md-offset-1 col-md-7 control-label left-align">
												Is open for bond ? <span class="symbol required"></span>
											</label>
											<div class="col-md-3" style="top: 13px;">
											<div class="right">
											<input type="radio" id="b1" name="ob" class="checkbox" />
					    					<label for="b1">Yes</label>
					    					<input type="radio" id="b2" name="ob" class="checkbox" />
					    					<label for="b2">No</label>
					    					</div>
					    					</div>
										</div>
										<div class="form-group">
											<label class="col-md-offset-1 col-md-7 control-label left-align">
					    						Upload Resume 
											</label>
											<div class="col-md-offset-9">
											<label class="btn btn-blue btn-file">
					    						Upload <i class="fa fa-upload"></i> <input type="file" style="display: none;">
											</label>
											</div>
										</div>										
									</div>
									<div class="col-md-4 " >
										<img style="height: 210px;" src="<?php echo base_url()?>assets/frontend/images/step5.png" alt="" class=" img-responsive pull-left " data-animation-options='{"animation":"shake", "duration":"800"}'>
									</div>
									<div class="col-md-12">											
											<div class="form-group">
												<div class="col-md-offset-10 col-md-2" style="margin-top: 4%;" >
													<a  class="finish-step" >Finish</a>								
												</div>											
											</div>
									</div>

								</div> 
							</div>
						</form>
					</div>
				</div>	
				<!-- END FORM-->
			</div>
			
			
		</div>
	</div>
</section>

<style type="text/css">
	.anchor{
		display: none !important;
	}
	.stepform{
		background-image: url('<?php echo base_url()?>assets/frontend/images/footer_step.png');
		background-size: 100% auto;
    	background-position: bottom; 
		background-repeat: no-repeat;
	}
</style>
