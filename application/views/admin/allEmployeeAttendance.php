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
        <section class="card">
			<div class="card-block">
				<div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
            	<form class="form-inline">
					<div class="form-group">
					<div class='input-group date attendancemonthYear' >
					    <input type='text' id="monthYear" name="monthYear" type="text" value="<?php echo date("m/Y")?>" class="form-control" />
					    <span class="input-group-addon">
					        <span class="glyphicon glyphicon-calendar">
					        </span>
					    </span>
					</div>
					</div>

					<button type="button" class="btn btn-default getmonthlyattandance">GET MONTHLY ATTANDANCE</button>
				</form><br>
				<table id="adminAttandanceDatable" class="display table table-striped table-bordered" width="100%" cellspacing="0">
			        <thead>
			            <tr>
			                <th>EmpCode</th>
							<th>Name</th>
							<th>In Time</th>
							<th>Out Time</th>
							<th>Total Working</th>
							<th>Status <!-- Present,Absent,Late,half day,Extra Day --></th>
							<th>Remarks</th>
			               
			            </tr>
			        </thead>
			 
			        <tfoot>
			            <tr>
							<th>EmpCode</th>
							<th>Name</th>
							<th>In Time</th>
							<th>Out Time</th>
							<th>Total Working</th>
							<th>Status <!-- Present,Absent,Late,half day,Extra Day --></th>
							<th>Remarks</th>
			                
			            </tr>
			        </tfoot>
		    	</table>

			</div>
		</section> 
		   
    </div><!--.container-fluid-->
</div><!--.page-content-->
        
    
 