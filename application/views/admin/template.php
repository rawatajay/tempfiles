         <div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h2><?php echo $page_name?>
								 <a href="<?php echo base_url()?>admin/addtemplate" ><button style="float: right"  type="button" class="btn btn-rounded btn-inline">Add <?php echo $page_name?></button></a>
							</h2>							
						</div>
					</div>
				</div>
					</div>
				</div>
			</header>
                    <section class="card card-inversed">
                        <div class="card-block">   
                        <table id="datalist" class="display table table-bordered jhtable" cellspacing="0" width="100%">
						<thead>
							<tr>         
                                    <th>S.No</th>
                                    <th>Template Name</th>
                                  
	                            <th >Status</th>
	                            <th >Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>S.No</th>
									<th >Template Name</th>
									
									<th >Status</th>
									<th >Action</th>
							</tr>
						</tfoot>
						<tbody>	
						<?php $ctr=1; foreach($templatelist as $data) {      ?> 				
							<tr>
                                <td><?php echo $ctr; ?></td>
                                <td ><?php echo $data['name']; ?></td>
                               
                               
                                <?php if($data['status'] == 1) {?>
                                        <td>	<span class="label label-pill label-success">Active</span></td>
                                        <?php }else if($data['status'] == 0){?>
                                        <td>	<span class="label label-pill label-warning">Inactive</span></td>
                                        <?php }?>
                                                 <td><a href="<?php echo base_url() ."admin/editTemplate/". $data['id']?>" >
                                                   <button class="btn btn-inline btn-primary  glyphicon glyphicon-pencil"> </button></a>
                                                  <button class="btn btn-inline btn-primary glyphicon glyphicon-eye-open " onclick="getmailpreview('<?php echo$data['id']?>');"></button>  
			                 	</td>							
						</tr>
						<?php $ctr++;}?>
						</tbody>
					</table>
                        </div>
                    </section>
		</div><!--.container-fluid-->
</div><!--.page-content-->

<style type="text/css">
.modal-body{
  height: 500px;
  overflow-y: auto;
}
</style>

                                

<div class="modal fade bd-example-modal-lg"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
   <div class="modal-dialog modal-lg">
           <div class="modal-content">
                   <div class="modal-header">
                           <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                                   <i class="font-icon-close-2"></i>
                           </button>
                           <h4 class="modal-title" id="myModalLabel">Mail Template</h4>
                   </div>
                   <div class="modal-body pre-mail">
                         <?php echo "Select your mail template"; ?>
                   </div>
                   <div class="modal-footer">
                        
                   </div>
           </div>
   </div>
</div><!--.modal-->

		