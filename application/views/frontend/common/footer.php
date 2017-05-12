<script src="<?php echo base_url()?>assets/admin/js/lib/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/tether/tether.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/plugins.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/jquery-tag-editor/jquery.caret.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/jquery-tag-editor/jquery.tag-editor.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/select2/select2.full.min.js"></script>

<script src="<?php echo base_url()?>assets/admin/js/lib/summernote/summernote.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/datatables-net/datatables.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
<!--<script src="<?php // echo base_url()?>assets/admin/js/ajax-upload.js"></script>-->

    <?php if($page_slug!="sign_up"){ ?>
<script>
    
     var pagename = '<?php echo $page_name; ?>';
      var pageslug = '<?php echo $page_slug; ?>';
    
    </script>
                     <script   src="<?php echo base_url()?>assets/admin/js/image-picker.js"></script>
                     <script   src="<?php echo base_url()?>assets/admin/js/jobseekertask.js"></script>
                    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/lib/blockUI/jquery.blockUI.js"></script>

    <?php } ?>

       <?php if($page_slug=="preview_email"){ ?>             
       <script>    
        
    //    $('.summernote').summernote('disable');
            
       <?php } ?>         
      </script>               
	<script>
            
            
    jQuery("select#image-picker").imagepicker({
      hide_select:  true,
    
    });
            
    jQuery("select#mailID").imagepicker({
      
      hide_select:  true,
      
     
      selected: function(option){
        //Gets the values selected from the option that can be called using this.
        var values = this.val();
        //Triggers the alert box with the values selected. 
       
        
      
      var form_data =  $('#mailform').serialize();
      $.ajax({
        type:"POST" ,
        url:"<?php echo base_url(); ?>user/dataset/getpreviewmailData",
        data: form_data,
        success: function(data){
           $('.summernote').summernote('code', data);
        //  CKEDITOR.instances['messageData'].setData(data);
          }
            });
      
    }

    });
    
     if(pagename=='user_email'){ 
    
     $(window).load(function(){
         
       var form_data =  $('#mailform').serialize();
      $.ajax({
        type:"POST" ,
        url:"<?php echo base_url(); ?>user/dataset/getpreviewmailData",
        data: form_data,
        success: function(data){
        $('.summernote').summernote('code', data);
      
         //  CKEDITOR.instances['messageData'].setData(data);
            }
        });
          
      });
    }
         
     
      
            $(".checkAll").change(function () {
               
                $(".checkSingle").prop('checked', $(this).prop("checked"));
            });
            
                                 
  </script>   
  
<?php if($page_slug =="payment_page"){ ?>
  <script   src="<?php echo base_url()?>assets/admin/js/pay.js"></script>
<?php } ?>
<script src="<?php echo base_url()?>assets/admin/js/app.js"></script>
</body>
</html>
