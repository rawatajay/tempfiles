<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2><?php echo $page_name?></h2>							
						</div>
					</div>
				</div>
			</header>
			<section >
				
            	<div id="formError" style="display: none" class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert">
            		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<span id="errMsg"></span>
				</div>
				
               
			</section>
			<section class="card">
				<div class="card-block">
					<div class="row m-t-lg">
						<div class="col-md-6">
						 <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
							<form  method="POST" action="<?php echo base_url() ?>admin/importdatasetcsv" enctype="multipart/form-data">
								<div class="form-group">
									<label class="form-label" for="signup_v1-username">Select csv File</label>
									<div class="form-control-wrapper">
			                     		<input type="file" name="datasetcsvimport">			                        	
									</div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn">Upload</button>
								</div>
							</form>
						</div>
					
					</div><!--.row-->
				</div>
			</section>
			
		</div><!--.container-fluid-->
</div><!--.page-content-->



