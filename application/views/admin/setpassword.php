<div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">
            <form class="sign-box " id="form-signin_v1" method="POST" action="<?php echo base_url('setpassword_process/'.$code);?>">
                
                 <div class="sign-avatar">
                    <img src="<?php echo base_url()?>assets/admin/img/login-box.png" alt="">                    
                </div> 
                <div id="message"><?php echo $this->session->flashdata('msg'); ?></div>  
                <header class="sign-title">Choose a new password</header>                
                <div class="form-group">
                    <label class="form-label" for="signup_v1-password">Password</label>
                    <div class="form-control-wrapper">
                        <input id="signup_v1-password"
                               class="form-control"
                               name="password"
                               placeholder="New Password" 
                               type="password" data-validation="[L>=6]"                               
                               data-validation-message="$ must be at least 6 characters">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="signup_v1-password-confirm">Confirm Password</label>
                    <div class="form-control-wrapper">
                        <input id="signup_v1-password-confirm"
                               class="form-control"
                               name="confirm_password"
                               placeholder="Confirm Password"
                               type="password" data-validation="[V==password]"
                               data-validation-message="$ does not match the password">
                    </div>
                </div> 
                <button type="submit" class="btn btn-rounded">Reset</button>               
                <p class="sign-note"><a href="<?php echo base_url('admin') ?>">Sign In</p>
            </form>
        </div>
    </div>
</div><!--.page-center-->