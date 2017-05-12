<div class="page-content">
    <div class="container-fluid">
        <header class="section-header">
            <div class="tbl">
                <div class="tbl-row">
                   
                        <div class="tbl">
                            <div class="tbl-row">
                                <div class="tbl-cell">
                                    <h2><?php echo $page_name ?>
                                        <a href="<?php echo base_url() ?>admin/addQuestion" ><button style="float: right"  type="button" class="btn btn-rounded btn-inline">Add <?php echo $page_name ?></button></a>
                                    </h2>							
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </header>
        <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
        <section class="card card-inversed">
            <div class="card-block">   
                <table id="datalist" class="display table table-bordered jhtable" cellspacing="0" width="100%">
                    <thead>
                        <tr>         
                            <th>S.No</th>
                            <th>Question</th>

                            <th >Answer</th>
                            <th >Status</th>
                            <th >CreatedAt</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                             <th>S.No</th>
                            <th>Question</th>

                            <th >Answer</th>
                            <th >Status</th>
                            <th >CreatedAt</th>
                            <th >Action</th>
                        </tr>
                    </tfoot>
                    <tbody>	
                        <?php foreach ($questionlist as $key => $data) { ?> 				
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td ><?php echo $data['questionText']; ?></td>
                                <td ><?php echo  $data['answerText']; ?></td>

                                <?php if ($data['status'] == 1) { ?>
                                    <td>	<span class="label label-pill label-success">Active</span></td>
                                <?php } else if ($data['status'] == 0) { ?>
                                    <td>	<span class="label label-pill label-warning">Inactive</span></td>
                                <?php } ?>
                               
                                    <td ><?php echo date('d-m-Y',strtotime($data['createdAt'])); ?></td>

                                <td> 
                                            <span style="float: left;"> 
                                                        <a class="btn btn-inline btn-sm" href="<?php echo base_url() . "admin/editQuestion/" . $data['questionID'] ?>" ><i class="glyphicon glyphicon-pencil"></i> </a></span>
                                                <span style="float: left;">          
                                                    <a onclick="myDeleteQuestion('<?php echo  $data['questionID']; ?>');"  href="#deletequestion" class="btn btn-danger btn-sm "><icon class=" glyphicon glyphicon-trash"></icon> </a></span>

                                </td>							
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div><!--.container-fluid-->
</div><!--.page-content-->



                               

<div  id="deletequestion" class="modal fade bd-example-modal-ls"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
   <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <form action="<?php echo base_url(); ?>admin/deleteQuestion" method="post">
                   <div class="modal-header">
                           <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                                   <i class="font-icon-close-2"></i>
                           </button>
                           <h4 class="modal-title" id="myModalLabel">Delete Question </h4>
                   </div>
                   <div class="modal-body">
                       
                        <p>
                   Do you want to Delete this question from the  list  ? 
                </p>  
                        <input type="hidden" name="questionID" id="questionID" value="">
                   </div>
                   <div class="modal-footer">
                        <button aria-hidden="true" data-dismiss="modal" class="btn btn-default">
                    Close
                </button>
               
                <button type="submit" name="delete" class="btn btn-default">
                    Delete
                </button> 
                   </div>
                 </form> 
           </div>
   </div>
</div><!--.modal-->

	



                     <script type="text/javascript">
                    function myDeleteQuestion(ID) 
                    {      
                         document.getElementById("questionID").value=ID;
                         $('#deletequestion').modal('show', {backdrop: 'static'});
                    }
                    </script>