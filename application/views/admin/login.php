<div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box" id="form-signin_v1" action="<?php echo base_url('login');?>" name="form-signup_v1" method="POST">
                    <div class="sign-avatar">
                         <img src="<?php echo base_url()?>assets/admin/img/login-box.png" alt=""> 
                    </div>
                    <header class="sign-title">Sign In</header>
                    <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
                    <div class="form-group">
                       <input  id="signup_v1-email"
                                placeholder="Enter Email"
                                class="form-control"
                                name="email"
                                type="text"
                                value=""
                                data-validation="[EMAIL]">
                    </div>
                    <div class="form-group">
                       <input id="signup_v1-password"
                               class="form-control"
                               placeholder="Enter Password"
                               name="password"
                               type="password" data-validation="NOTEMPTY">
                    </div>
                    <div class="form-group">
                       <select id="signup_v1-usertype"
                               class="form-control"
                               name="usertype" data-validation="NOTEMPTY">
                               <?php foreach ($userTypes as $key => $val) {
                                  echo "<option value='".$val['id']."'>".ucwords($val['name'])."</option>";
                               }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="float-left reset">
                            <a href="<?php echo base_url('forgot-password')?>">Reset Password</a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-rounded sign-up">Sign in</button>
                </form>
            </div>
        </div>
    </div>