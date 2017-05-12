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
                    	<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
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
											<button type="button" class="btn btn-primary-outline"><i class="fa fa-edit"></i></button>
											<button type="button" class="btn btn-danger-outline"><i class="fa fa-remove"></i></button>
											<?php if(!$val['isAccountCreated']){?>
											<button type="button" class="btn btn-secondary-outline"><i class="fa fa-lock"></i></button>
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
        
        
 