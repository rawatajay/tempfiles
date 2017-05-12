<div class="page-content">
    <div class="container-fluid">
        <div class="row">


 <script>
    var hash = '<?php echo $hash ?>';
    
  
    function submitPayuForm() {
      
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>



        <div class="text-block text-block-typical sendApplybtn">


                <a href="<?php echo base_url()  ?>user/profile_view" > <span class="col-lg-1 col-lg-push-11  btn btn-rounded btn-inline btn-success pull-right"><i class="fa fa-mail-reply" aria-hidden="true"></i> Go back  </span></a>

         </div>
            <div class="col-lg-9 col-lg-push-3 col-md-12">
                
                <section class="box-typical">
                    <header class="box-typical-header-sm">User Payment</header>
                    <article class="profile-info-item">

                        <div class="text-block text-block-typical">
                            <!--						<div class="col-xl-12">-->
                            <div class="row m-t-lg">
                                <div class="col-md-12">
                                    <div id="message"><?php echo $this->session->flashdata('msg'); ?></div>
                                    

                                     
                                    <form class="formvalidate" onload="submitPayuForm()"  method="POST" name="payuForm" 
                                          action="<?php echo $action; ?>">
                                      <input type="hidden" name="key" value="<?php echo PAYU_MERCHANT; ?>" />
                                      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                                      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                                      

                                        <input type="hidden" name="surl" value="<?php echo base_url().'user/payu_success'; ?>" />
                                        <input type="hidden" name="furl" value="<?php echo base_url().'user/payu_failure'?>" />
                                        <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                                        <input type="hidden" name="lastname" id="lastname" value="" />
                                        <input type="hidden" name="firstname" id="firstname" value="<?php echo $this->session->all_userdata()['fname']; ?>" />
                                        <input type="hidden" name="email" id="email" value="<?php echo $this->session->all_userdata()['email']; ?>" />
                                        <input type="hidden" name="phone" id="phone" value="<?php echo $this->session->all_userdata()['phone']; ?>" />
                                        <input type="hidden" name="productinfo" value="<?php echo "this is the process"; ?>" />
                                        <input type="hidden" name="curl" value="" />
                                        <input type="hidden" name="address1" value="" />
                                        <input type="hidden" name="address2" value="" />
                                        <input type="hidden" name="city" value="" />
                                        <input type="hidden" name="state" value="" />
                                        <input type="hidden" name="country" value="" />
                                        <input type="hidden" name="zipcode" value="" />
                                        <input type="hidden" name="udf1" value="" />
                                        <input type="hidden" name="udf2" value="" />
                                        <input type="hidden" name="udf3" value="" />
                                        <input type="hidden" name="udf4" value="" />
                                        <input type="hidden" name="udf5" value="" />
                                        <input type="hidden" name="pg" value="" />

                                  
                                        <div class="form-group">
                                            <label class="form-label" for="amount"> Amount</label>
                                            <div class="form-control-wrapper">
                                                
                                                <input class="form-control" name="amount"  class="form-control" value="<?php echo $amount ?>" />
                                               
                                            </div>
                                        </div>
                                     <div class="form-group"> 
                                         <?php if(!$hash) { ?>
                                            <button type="submit" class="btn btn-success">Pay Now</button>
                                               <?php } ?>
                                        </div>
                                    </form>
                                </div>					
                            </div><!--.row-->
                            <!--	            				                 </div>-->
                        </div>
                    </article><!--.profile-info-item-->
                </section><!--.box-typical-->

            </div>

          
	  <?php  include_once("common/jobseekerSidebar.php") ?>



        </div><!--.row-->
    </div><!--.container-fluid-->
</div><!--.page-content-->






















