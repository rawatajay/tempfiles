<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <header class="section-header">
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <h2><?php echo $page_name; ?>
                                    </h2>
                            </div>
                        </div>
                    </div>
                </header>
                <section class="card">
                  
                    <div class="card-block">     


                        <?php if (!empty($history_Data)) { ?>
                            <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>         
                                        <th>S.No</th>
                                        <th>User</th>
                                        <th>Transaction Date</th>
                                      
                                        <th >Transaction Type</th>	                                                       
                                        <th >Amount</th>
                                        <th >Balance</th>
                                         <th >Remarks</th>
                                        <th >Status</th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>

                                        <th>S.No</th>
                                        <th>User</th>
                                        <th>Transaction Date</th>
                                      
                                        <th >Transaction Type</th>	                                                       
                                        <th >Amount</th>
                                        <th >Balance</th>
                                          <th >Remarks</th>
                                        <th >Status</th> 

                                    </tr>
                                </tfoot>
                                <tbody>	
                                    <?php   
                                    
                                    foreach ($history_Data as $key=> $data) { ?> 				
                                        <tr>
                                            <td><?php echo $key+1;  ?></td>
                                              <td><?php echo $data['firstName'];  ?></td>
                                            
                                            <td ><?php echo ($data['rechargeTime'])?date('j-F-Y H:i:s',strtotime($data['rechargeTime'])):date('j-F-Y H:i:s',strtotime($data['orderTime'])); ?></td>
                                         
                                            <td ><?php echo ($data['transactionType']=='1')?'Credit':'Debit'; ?></td>                 
                                            <td ><?php echo $data['amount']; ?></td>	
                                            <td ><?php echo $data['balance']; ?></td>   
                                              <td ><?php echo $data['remarks']; ?></td>   
                                            <?php $status =  ($data['rechargeStatus'])?$data['rechargeStatus']:$data['orderStatus']; ?>
                                            
                                            <td ><?php  if($status==1){echo '<span class="label label-pill label-success">Completed</span>';}else if($status==2) {echo '<span class="label label-pill label-warning">Pending</span>';}else{echo '<span class="label label-pill label-danger">Failed</span>';} ?></td>	

                                        </tr>
        <?php 
    } ?>
                                </tbody>
                            </table>
<?php } else { ?>
                            <div class="add-customers-screen tbl" style="height: 240px;">
                                <div class="add-customers-screen-in">
                                    <div class="add-customers-screen-user">
                                        <i class="font-icon font-icon-user"></i>
                                    </div>
                                    <h2>Your <?php echo $page_name; ?> list is empty</h2>						
                                </div>
                            </div>
<?php } ?>

                    </div>
                </section>
            </div>        
<?php include_once("common/jobseekerSidebar.php") ?>



        </div>
    </div><!--.container-fluid-->
</div><!--.page-content-->



