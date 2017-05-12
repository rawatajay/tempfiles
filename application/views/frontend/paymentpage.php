<?php /* ?>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
         

          <div class="col-lg-9 col-lg-push-3 col-md-12" >
                
                <section class="box-typical">
                    <header class="box-typical-header-sm">User Payment</header>
                    <article class="profile-info-item">

                        <div class="text-block text-block-typical">
                            <!--						<div class="col-xl-12">-->
                            <div class="row m-t-lg">
                                <div class="col-md-12" >
                                    <div id="message"><?php echo $this->session->flashdata('msg'); ?></div>
                                    
                                   
                                     
                                    <form  id="payForm"  action="<?php echo $action; ?>"  method="POST" name="payuForm">
                                      <input type="hidden" name="key" value="<?php echo PAYU_MERCHANT; ?>" />
                                      <input type="hidden" name="hash" id="hash" value="<?php echo $hash ?>"/>
                                      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                                      

                                        <input type="hidden" name="surl" value="<?php echo base_url().'user/payu_PaymentSuccess'; ?>" />
                                        <input type="hidden" name="furl" value="<?php echo base_url().'user/payu_Paymentfailure'?>" />
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
                                                 <div class="row">
                                                    <div class="col-lg-12">
                                                      <input class="form-control" name="amount" id="amount"  class="form-control" value="<?php echo ($amount)?$amount:''; ?>" />
                                                    </div>
                                                 </div>
                                                 
                                             </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="form-control-wrapper">
                                                
                                              <div class="row">  
                                                <div class="col-lg-3 col-lg-6">
                                                  <section class="widget widget-simple-sm-fill">
                                                        <div class="widget-simple-sm-icon">
                                                            + <i class="fa fa-rupee"></i> <a href="#"onclick="pay_process('100');" style="color:#FFF;" > <span  > 100</span></a>
                                                        </div>
                                                        
                                                </section>
                                                </div>
                                                
                                                <div class="col-lg-3 col-lg-6">
							<section class="widget widget-simple-sm-fill red">
								<div class="widget-simple-sm-icon">
                                                                    + <i class="fa fa-rupee"></i> <a href="#"onclick="pay_process('200');" style="color:#FFF;" > <span    > 200</span></a>
								</div>
								
							</section>
						</div>
                                                
                                                <div class="col-lg-3 col-lg-6">
							<section class="widget widget-simple-sm-fill green">
								<div class="widget-simple-sm-icon">
							         + <i class="fa fa-rupee"></i> <a href="#" onclick="pay_process('300');"  style="color:#FFF;"> 300</a>
								</div>
								
							</section><!--.widget-simple-sm-fill-->
						</div>
						<div class="col-lg-3 col-lg-6">
							<section class="widget widget-simple-sm-fill orange">
								<div class="widget-simple-sm-icon">
                                                                    + <i class="fa fa-rupee"></i><a href="#"onclick="pay_process('500');"  style="color:#FFF;"> <span  > 500</span></a>
								</div>
							
							</section><!--.widget-simple-sm-fill-->
						</div>
                                             </div>
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
</div><!--.page-content-->       <?php */ ?>



<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-lg-push-3 col-md-12">
                 <div id="message"><?php echo $this->session->flashdata('msg'); ?></div>
                <section id="blockui-element-container-default" class="card">
                    <header class="card-header">
                       User Recharge Page
                    </header>
                    <div class="card-block display-table" style="min-height: 300px">
                         <p class="text-vertical-middle text-center">
                                    <form  id="payForm"  action="<?php echo $action; ?>"  method="POST" name="payuForm">
                                      <input type="hidden" name="key" value="<?php echo PAYU_MERCHANT; ?>" />
                                      <input type="hidden" name="hash" id="hash" value="<?php echo $hash ?>"/>
                                      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                                      

                                        <input type="hidden" name="surl" value="<?php echo base_url().'user/payu_PaymentSuccess'; ?>" />
                                        <input type="hidden" name="furl" value="<?php echo base_url().'user/payu_Paymentfailure'?>" />
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
                                                 <div class="row">
                                                    <div class="col-lg-12">
                                                        
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-rupee"></i></div>
								<input type="text" class="form-control"  name="amount" id="amount"  placeholder="Amount" value="<?php echo ($amount)?$amount:''; ?>" />
								<div class="input-group-addon">.00</div>
							</div>
                                                       
                                                    </div>
                                                 </div>
                                                 
                                             </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="form-control-wrapper">
                                                
                                              <div class="row">  
                                                <div class="col-lg-3 col-lg-6">
                                                  <section class="widget widget-simple-sm-fill">
                                                        <div class="widget-simple-sm-icon">
                                                            + <i class="fa fa-rupee"></i> <a href="#"onclick="pay_process('100');" style="color:#FFF;" > <span  > 100</span></a>
                                                        </div>
                                                        
                                                </section>
                                                </div>
                                                
                                                <div class="col-lg-3 col-lg-6">
							<section class="widget widget-simple-sm-fill red">
								<div class="widget-simple-sm-icon">
                                                                    + <i class="fa fa-rupee"></i> <a href="#"onclick="pay_process('200');" style="color:#FFF;" > <span    > 200</span></a>
								</div>
								
							</section>
						</div>
                                                
                                                <div class="col-lg-3 col-lg-6">
							<section class="widget widget-simple-sm-fill green">
								<div class="widget-simple-sm-icon">
							         + <i class="fa fa-rupee"></i> <a href="#" onclick="pay_process('300');"  style="color:#FFF;"> 300</a>
								</div>
								
							</section><!--.widget-simple-sm-fill-->
						</div>
						<div class="col-lg-3 col-lg-6">
							<section class="widget widget-simple-sm-fill orange">
								<div class="widget-simple-sm-icon">
                                                                    + <i class="fa fa-rupee"></i><a href="#"onclick="pay_process('500');"  style="color:#FFF;"> <span  > 500</span></a>
								</div>
							
							</section><!--.widget-simple-sm-fill-->
						</div>
                                             </div>
                                            </div>     
                                        </div>
                                     <div class="form-group"> 
                                           <?php if(!$hash) { ?>
                                         <a id="blockui-block-element-default" class="btn btn-success">Pay Now</a>
                                                 
<!--                                            <button type="submit" class="btn btn-success " >Pay Now</button>-->
                                           <?php } ?>
                                        </div>
                                    </form>
                        
<!--                        <p class="text-vertical-middle text-center">
                            To view default blockui in action
                            <a id="blockui-block-element-default">click here</a>
                        </p>-->
                    </div>
                </section>
            </div>




        </div><!--.row-->
    </div><!--.container-fluid-->
</div><!--.page-content-->















