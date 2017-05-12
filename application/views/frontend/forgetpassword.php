<div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">
            <form class="sign-box " id="form-signin_v1" method="POST" action="<?php echo base_url('user/forgotpassword');?>">
                
                 <div class="sign-avatar">
                    <img src="<?php echo base_url()?>assets/admin/img/login-box.png" alt="">                    
                </div>  
                <header class="sign-title">Reset Password</header>
                <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
                <div class="form-group">
                    <div class="form-group">                    
                    <div class="form-control-wrapper">
                        <input  id="signup_v1-email"
                                placeholder="Enter Email"
                                class="form-control"
                                name="email"
                                type="text"
                                value=""
                                data-validation="[EMAIL]">
                    </div>
                </div>   
                </div>
                <button type="submit" class="btn btn-rounded">Reset</button>               
                <p class="sign-note"><a href="<?php echo base_url() ?>">Sign In</p>
            </form>
        </div>
    </div>
</div><!--.page-center-->