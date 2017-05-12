<!-- start: MAIN CONTAINER -->
<div class="main-container">
	<?php include_once('common/sidebarMenu.php') ?>
	<!-- start: PAGE -->
	<div class="main-content">		
		<div class="container">
			<!-- start: PAGE HEADER -->
			<div class="row">
				<div class="col-sm-12">					
					<!-- start: PAGE TITLE & BREADCRUMB -->					
					<div class="page-header">
						<h1><?php echo $page_name ?> List
							<button type="button" class="demo btn btn-info" style="float:right" data-toggle="modal" href="#responsive">
								Add <?php echo $page_name ?>
							</button>
						</h1>
						
					</div>

					<!-- end: PAGE TITLE & BREADCRUMB -->
				</div>
			</div>
			<!-- end: PAGE HEADER -->
			<!-- start: PAGE CONTENT -->
			<div class="row">
				<div class="col-md-12">
				<!-- start: DYNAMIC TABLE PANEL -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-external-link-square"></i>
							<?php echo $page_name ?>							
						</div>
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
								<thead>
									<tr>
										<th>S.No</th>
										<th class="hidden-xs">Salary From</th>
										<th class="hidden-xs">Salary To</th>
										<th> Action </th>										
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td class="hidden-xs">50000</td>
										<td class="hidden-xs">100000</td>													
										<td class="center">
											<div class="visible-md visible-lg hidden-sm hidden-xs">
												<a data-toggle="modal" href="#editresponsive" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
												
												<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
											</div>
											<div class="visible-xs visible-sm hidden-md hidden-lg">
												<div class="btn-group">
													<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
														<i class="fa fa-cog"></i> <span class="caret"></span>
													</a>
													<ul role="menu" class="dropdown-menu pull-right">
														<li role="presentation">
															<a role="menuitem" tabindex="-1" href="#">
																<i class="fa fa-edit"></i> Edit
															</a>
														</li>
														
														<li role="presentation">
															<a role="menuitem" tabindex="-1" href="#">
																<i class="fa fa-times"></i> Remove
															</a>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>2</td>
										<td class="hidden-xs">50000</td>
										<td class="hidden-xs">100000</td>													
										<td class="center">
											<div class="visible-md visible-lg hidden-sm hidden-xs">
												<a data-toggle="modal" href="#editresponsive" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
												
												<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
											</div>
											<div class="visible-xs visible-sm hidden-md hidden-lg">
												<div class="btn-group">
													<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
														<i class="fa fa-cog"></i> <span class="caret"></span>
													</a>
													<ul role="menu" class="dropdown-menu pull-right">
														<li role="presentation">
															<a role="menuitem" tabindex="-1" href="#">
																<i class="fa fa-edit"></i> Edit
															</a>
														</li>
														
														<li role="presentation">
															<a role="menuitem" tabindex="-1" href="#">
																<i class="fa fa-times"></i> Remove
															</a>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>3</td>
										<td class="hidden-xs">50000</td>
										<td class="hidden-xs">100000</td>													
										<td class="center">
											<div class="visible-md visible-lg hidden-sm hidden-xs">
												<a data-toggle="modal" href="#editresponsive" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
												
												<a href="#" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
											</div>
											<div class="visible-xs visible-sm hidden-md hidden-lg">
												<div class="btn-group">
													<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
														<i class="fa fa-cog"></i> <span class="caret"></span>
													</a>
													<ul role="menu" class="dropdown-menu pull-right">
														<li role="presentation">
															<a role="menuitem" tabindex="-1" href="#">
																<i class="fa fa-edit"></i> Edit
															</a>
														</li>
														
														<li role="presentation">
															<a role="menuitem" tabindex="-1" href="#">
																<i class="fa fa-times"></i> Remove
															</a>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>											
								</tbody>
							</table>
						</div>
					</div>
				<!-- end: DYNAMIC TABLE PANEL -->
				</div>
			</div>
			
											
			<!-- end: PAGE CONTENT-->
		</div>
	</div>
	<!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<!-- start: FOOTER -->
<div class="footer clearfix">
	<div class="footer-inner">
		<?php echo COPYRIGHT;?>
	</div>
	<div class="footer-items">
		<span class="go-top"><i class="clip-chevron-up"></i></span>
	</div>
</div>
<!-- end: FOOTER -->
<!-- end: FOOTER -->
<div id="responsive" class="modal fade" tabindex="-1" data-width="500" style="display: none;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			&times;
		</button>
		<h4 class="modal-title">Add <?php echo $page_name?></h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">						
				<form action="#" role="form" id="salaryrangelist">
					<div class="row">
						<div class="col-md-12">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
							</div>
							<div class="successHandler alert alert-success no-display">
								<i class="fa fa-ok"></i> Your form validation is successful!
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">
									Salary From <span class="symbol required"></span>
								</label>
								<input type="text" placeholder="Enter Salary From" class="form-control" id="salaryfrom" name="salaryfrom">
							</div>
							<div class="form-group">
								<label class="control-label">
									Salary To <span class="symbol required"></span>
								</label>
								<input type="text" placeholder="Enter Salary To" class="form-control" id="salaryto" name="salaryto">
							</div>									
						</div>								
					</div>
					<div class="row">
						<div class="col-md-12">
							<div>
								<span class="symbol required"></span>Required Fields
								<hr>
							</div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-4">
							<button class="btn btn-info btn-block" type="submit">
								Add <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</div>
				</form>								
			</div>
		</div>
	</div>			
</div>

<div id="editresponsive" class="modal fade" tabindex="-1" data-width="500" style="display: none;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			&times;
		</button>
		<h4 class="modal-title">Edit <?php echo $page_name?></h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">						
				<form action="#" role="form" id="salaryrangelist">
					<div class="row">
						<div class="col-md-12">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
							</div>
							<div class="successHandler alert alert-success no-display">
								<i class="fa fa-ok"></i> Your form validation is successful!
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">
									Salary From <span class="symbol required"></span>
								</label>
								<input type="text" placeholder="Enter Salary From" class="form-control" id="salaryfrom" name="salaryfrom">
							</div>
							<div class="form-group">
								<label class="control-label">
									Salary To <span class="symbol required"></span>
								</label>
								<input type="text" placeholder="Enter Salary To" class="form-control" id="salaryto" name="salaryto">
							</div>									
						</div>								
					</div>
					<div class="row">
						<div class="col-md-12">
							<div>
								<span class="symbol required"></span>Required Fields
								<hr>
							</div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-md-4">
							<button class="btn btn-info btn-block" type="submit">
								Update <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</div>
				</form>								
			</div>
		</div>
	</div>		
</div>