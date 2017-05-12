<div class="page-center">
    <div class="page-center-in">
        <div class="container-fluid">

            <form class="sign-box" id="form-signin_v1" action="<?php echo base_url('user/login');?>" name="form-signup_v1" method="POST">
                <div class="sign-avatar">
                    <img src="<?php echo base_url()?>assets/admin/img/login-box.png" alt="">                    
                </div>  
                <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 

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
                    <label class="form-label" for="signup_v1-password">Password</label>
                    <div class="form-control-wrapper">
                        <input id="signup_v1-password"
                               class="form-control"
                               placeholder="Enter Password"
                               name="password"
                               type="password" data-validation="NOTEMPTY">
                    </div>
                </div>                              
               
                <div class="form-group">
                    <button type="submit" class="btn btn-rounded btn-success sign-up">Sign in</button>
                    <a href="<?php echo base_url('forgot-password')?>">Forgotten account ?</a>
                     <hr>
                    <a href="<?php echo $login_url ?>"> 
                        <button type="button" class="btn btn-rounded btn-inline"><i class="fa fa-facebook"></i>  Sign in with Facebook</button>
                    </a>
                    <p class="sign-note">Already have an account? 
                        <a href="<?php echo base_url('signup/'.$code) ?>">Sign up</a> <br>
                        <a href="  <?php echo base_url('home') ?>">Back to home</a>
                    </p>
                </div>

            </form>
        </div>
    </div>
</div><!--.page-center-->