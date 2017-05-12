 <div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">
            <form class="sign-box" id="form-signin_v1" action="<?php echo base_url('user/signup');?>" name="form-signup_v1" method="POST">
                <div class="sign-avatar">
                    <img src="<?php echo base_url()?>assets/admin/img/login-box.png" alt="">                    
                </div>  
                <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
                <div class="form-group">
                    <label class="form-label" for="signup_v1-firstname">First Name</label>
                    <div class="form-control-wrapper">
                        <input id="signup_v1-firstname"
                               class="form-control"
                               value="<?php echo $firstname?>"
                               placeholder="Enter First Name" 
                               name="firstname"
                               type="text" data-validation="[L>=2, L<=18, MIXED]"
                               data-validation-message="$ must be between 2 and 18 characters. No special characters allowed."
                               data-validation-regex="/^((?!admin).)*$/i"
                               data-validation-regex-message="The word &quot;Admin&quot; is not allowed in the $">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="signup_v1-lastname">Last Name</label>
                    <div class="form-control-wrapper">
                        <input id="signup_v1-lastname"
                               class="form-control"
                               value="<?php echo $last_name?>"
                               placeholder="Enter Last Name " 
                               name="lastname"
                               type="text" data-validation="[L>=2, L<=18, MIXED]"
                               data-validation-message="$ must be between 2 and 18 characters. No special characters allowed."
                               data-validation-regex="/^((?!admin).)*$/i"
                               data-validation-regex-message="The word &quot;Admin&quot; is not allowed in the $">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="signup_v1-email">Email</label>
                    <div class="form-control-wrapper">
                        <input  id="signup_v1-email"
                                placeholder="Enter Email"
                                class="form-control"
                                name="email"
                                type="text"
                                value="<?php echo $email?>"
                                data-validation="[EMAIL]">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="signup_v1-phone">Phone</label>
                    <div class="form-control-wrapper">
                        <input  id="signup_v1-phone"
                                placeholder="Enter Phone"
                                class="form-control"
                                name="phone"
                                type="text"
                                value="<?php echo $phone?>"
                                data-validation="[L>=6, L<=15, INTEGER]">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="signup_v1-password">Password</label>
                    <div class="form-control-wrapper">
                        <input id="signup_v1-password"
                               class="form-control"
                               name="password"
                               type="password" data-validation="[L>=6]"                               
                               data-validation-message="$ must be at least 6 characters">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="signup_v1-password-confirm">Confirm Password</label>
                    <div class="form-control-wrapper">
                        <input id="signup_v1-password-confirm"
                               class="form-control"
                               name="password_again"
                               type="password" data-validation="[V==password]"
                               data-validation-message="$ does not match the password">
                    </div>
                </div>               
                <?php 
                    if(!empty($facebookid)){?>
                    <input type="hidden" value="<?php echo $facebookid ?>" name="fid">
                    <input type="hidden" value="<?php echo $profile_pic ?>" name="fpic">
                <?php } ?>  
                <div class="form-group">
                    <button type="submit" class="btn btn-rounded btn-success sign-up">Sign up</button>
                    <p class="sign-note">Already have an account? 
                        <a href="<?php echo base_url('signin') ?>">Sign in</a> <br>
                        <a href="  <?php echo base_url('home') ?>">Back to home</a>
                    </p>
                </div>

            </form>
        </div>
    </div>
</div><!--.page-center-->
