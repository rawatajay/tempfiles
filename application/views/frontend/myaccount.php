	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-9 col-lg-push-3 col-md-12">
                                    <section class="box-typical">
                                        <header class="box-typical-header-sm"><?php //echo $page_name; ?> My Statistics</header>
                                        <article class="profile-info-item">

                                            <div class="text-block text-block-typical">
                                                <div class="col-xl-12">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <article class="statistic-box red">
                                                                <div>
                                                                    <div class="number"><?php echo ($openedemail)?($openedemail):0; ?></div>
                                                                    <div class="caption"><div>Total profile viewed</div></div>

                                                                </div>
                                                            </article>
                                                        </div><!--.col-->
                                                        <div class="col-sm-4">
                                                            <article class="statistic-box purple">
                                                                <div>
                                                                    <div class="number"><?php echo ($profiledownload)?($profiledownload):0; ?></div>
                                                                    <div class="caption"><div>Total profile downloads</div></div>

                                                                </div>
                                                            </article>
                                                        </div><!--.col-->
                                                     
                                                        <div class="col-sm-4">
                                                            <article class="statistic-box green">
                                                                <div>
                                                                    <div class="number"><?php echo ($totalsendemail)?($totalsendemail):0; ?></div>
                                                                    <div class="caption"><div>Total emails send </div></div>

                                                                </div>
                                                            </article>
                                                        </div><!--.col-->
                                                    </div><!--.row-->
                                                </div>
                                            </div>
                                        </article><!--.profile-info-item-->
                                    </section><!--.box-typical-->

					<section class="box-typical">
						<header class="box-typical-header-sm"></header>
						<article class="profile-info-item">
							<header class="profile-info-item-header">
								<i class="font-icon font-icon-notebook-bird"></i>
								Latest Dataset
							</header>
							 <div class="row card-user-grid">

                        <?php
                        if (!empty($datasetlist)) {
                            foreach ($datasetlist as $data){
                                ?>  
                                <div class="col-sm-6 col-md-4 col-xl-3">
                                    
                                  
                                       
                                    
                                  
                                    <article class="card-user box-typical  " style="height: 240px;">
                                          <div class="card-user-status">
                                            <?php
                                            echo $data['stateName'];
                                            echo '<br/>';
                                            $cities = $this->common->_getCityName($data['city']);
                                            echo rtrim($cities, ', ');
                                            ?>
                                        </div>
                                            
                                        <div class="card-user-photo">
                                            
                                                <img src="<?php echo base_url() ?>assets/admin/img/townhouse.jpg" alt=""> 
                                        </div>
                                        <div class="card-user-name"><?php echo $data['title']; ?></div>
                                         <div class="card-user-name">Company: <?php echo $data['comp_count']; ?></div>
                                       
                                         <div class="card-user-name"> <i class="fa fa-rupee"></i> <?php  echo ($data['price'])?$data['price']:'0 ' ; ?></div>
                                   
                                         
                                    </article><!--.card-user--> 
                                  
                                </div>   
                           <?php }
                            } else {
                                ?> 

                              <section class="box-typical">
                                <div class="add-customers-screen tbl" style="height: 240px;">
                                    <div class="add-customers-screen-in">
                                        <div class="add-customers-screen-user">
                                            <i class="font-icon font-icon-user"></i>
                                        </div>
                                        <h2>Your <?php echo $page_name; ?> list is empty</h2>						
                                    </div>
                                </div>
                             </section>
                        <?php } ?>
                    </div><!--.card-user-grid-->					
						</article><!--.profile-info-item-->
					</section><!--.box-typical-->
				
				</div><!--.col- -->

				<?php include_once("common/jobseekerSidebar.php") ?>
				<?php //include_once("common/jobseekerLeftSidebar.php") ?>
			
			</div><!--.row-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->