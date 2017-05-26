<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <section class="box-typical">
                <header class="box-typical-header-sm"><br/> </header>
                <article class="profile-info-item">

                    <div class="text-block text-block-typical">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-sm-3">
                                <?php //admin/jobseekerlist ?>
                                    <article class="statistic-box red">
                                        <div><a href="<?php echo base_url('admin/employee_list')?>" style="color:#FFF;">
                                            <div class="number"><?php echo $employeeCount; ?></i></div></a>
                                            <div class="caption"><div>Employee</div></div> 

                                        </div>
                                    </article>
                                </div><!--.col-->
                                <div class="col-sm-3" >
                                    <article class="statistic-box purple">
                                        <div><a href="<?php echo base_url('admin/emp_leave'); ?>" style="color:#FFF;">
                                            <div class="number" ><?php echo $pendingLeaveCount; ?></i></div></a>
                                            <div class="caption"><div>Pending Leaves</div></div> 

                                        </div>
                                    </article>
                                </div><!--.col-->
                                <div class="col-sm-3">
                                    <article class="statistic-box yellow">
                                        <div><a href="<?php echo base_url(); ?>" style="color:#FFF;">
                                            <div class="number"><i class="fa fa-calendar"></i></div></a>
                                            <div class="caption"><div>Attandance</div></div> 

                                        </div>
                                    </article>
                                </div><!--.col-->
                                <div class="col-sm-3">
                                    <article class="statistic-box green">
                                        <div><a href="<?php echo base_url(); ?>" style="color:#FFF;">
                                            <div class="number"><i class="fa fa-file-archive-o"></i></div></a>
                                            <div class="caption"><div>Manage Project</div></div> 
                                        </div>
                                    </article>
                                </div><!--.col-->
                            </div><!--.row-->
                        </div>
                    </div>
                </article><!--.profile-info-item-->
            </section><!--.box-typical-->
        </div><!--.row-->   
    </div><!--.container-fluid-->
</div><!--.page-content-->
        
        
 