<!--<div class="col-lg-3 col-lg-pull-6 col-md-6 col-sm-6">-->
  <div class="col-lg-3 col-lg-pull-9 col-md-6 col-sm-6">
					<section class="box-typical">
						<div class="profile-card">
							<div class="profile-card-photo">
							 	<?php if(!$this->session->all_userdata()['profilePic']) {?>
								<img src="<?php echo base_url()?>assets/admin/img/avatar-2-128.png" alt=""/>
								<?php } else{ ?>
                                                                <img src="<?php echo $this->session->all_userdata()['profilePic']?>" style="width:100px; height: 100px;" alt="">
								<?php }?>   
							</div>
							<div class="profile-card-name"><?php echo ucwords($this->session->all_userdata()['fname'])?> <?php echo ucwords($this->session->all_userdata()['lname'])?></div>
							<div class="profile-card-status"><?php echo $this->session->all_userdata()['email']?></div>
							<div class="profile-card-location"><?php echo $this->session->all_userdata()['phone']?></div>
                                                        <a href="<?php echo base_url() ?>user/profile_view">	<progress class="progress" value="<?php echo $profiledetails; ?>" max="100">10%</progress></a>
                                                        <p class="user-card-row-location">Profile Complete Status <b>(<a href="<?php echo base_url() ?>user/profile"><?php echo $profiledetails; ?>%</a>)</b></p>
						</div><!--.profile-card-->

						<div class="profile-statistic tbl">
							<div class="tbl-row">
								<div class="tbl-cell">
									<b><i class="fa fa-rupee"></i> <?php echo ($total_balance)?$total_balance:0; ?></b>
                                                                        <a href="<?php echo base_url(); ?>user/payu_TransactionHistory">Balance </a>
								</div>
								<div class="tbl-cell">
									<b><?php echo ($totalsendemail)?$totalsendemail:0; ?></b>
                                                                        <a href="<?php echo base_url(); ?>user/userDatasetlistData">Total Email Send </a>
								</div>
							</div>
						</div>

					</section><!--.box-typical-->
                                           <?php /* ?>
						<section class="box-typical">
						<header class="box-typical-header-sm">Profile download</header>
						<div class="friends-list stripped">
							<article class="friends-list-item">
								<div class="user-card-row">
									<div class="tbl-row">
										<div class="tbl-cell tbl-cell-photo">
											<a href="#">
												<img src="<?php echo base_url()?>assets/admin/img/photo-64-2.jpg" alt="">
											</a>
										</div>
										<div class="tbl-cell">
											<p class="user-card-row-name status-online"><a href="#">Dan Cederholm</a></p>
											<p class="user-card-row-status">Co-founder of <a href="#">Company</a></p>
										</div>
										<div class="tbl-cell tbl-cell-action">
											<a href="#" class="plus-link-circle"><span>&plus;</span></a>
										</div>
									</div>
								</div>
							</article>
							<article class="friends-list-item">
								<div class="user-card-row">
									<div class="tbl-row">
										<div class="tbl-cell tbl-cell-photo">
											<a href="#">
												<img src="<?php echo base_url()?>assets/admin/img/photo-64-1.jpg" alt="">
											</a>
										</div>
										<div class="tbl-cell">
											<p class="user-card-row-name"><a href="#">Oykun Yilmaz</a></p>
											<p class="user-card-row-status">Co-founder of <a href="#">Company</a></p>
										</div>
										<div class="tbl-cell tbl-cell-action">
											<a href="#" class="plus-link-circle"><span>&plus;</span></a>
										</div>
									</div>
								</div>
							</article>
							<article class="friends-list-item">
								<div class="user-card-row">
									<div class="tbl-row">
										<div class="tbl-cell tbl-cell-photo">
											<a href="#">
												<img src="<?php echo base_url()?>assets/admin/img/photo-64-3.jpg" alt="">
											</a>
										</div>
										<div class="tbl-cell">
											<p class="user-card-row-name"><a href="#">Bill S Kenney</a></p>
											<p class="user-card-row-status">Co-founder of <a href="#">Company</a></p>
										</div>
										<div class="tbl-cell tbl-cell-action">
											<a href="#" class="plus-link-circle"><span>&plus;</span></a>
										</div>
									</div>
								</div>
							</article>
							<article class="friends-list-item">
								<div class="user-card-row">
									<div class="tbl-row">
										<div class="tbl-cell tbl-cell-photo">
											<a href="#">
												<img src="<?php echo base_url()?>assets/admin/img/photo-64-4.jpg" alt="">
											</a>
										</div>
										<div class="tbl-cell">
											<p class="user-card-row-name"><a href="#">Maggy Smith</a></p>
											<p class="user-card-row-status">Co-founder of <a href="#">Company</a></p>
										</div>
										<div class="tbl-cell tbl-cell-action">
											<a href="#" class="plus-link-circle"><span>&plus;</span></a>
										</div>
									</div>
								</div>
							</article>
							<article class="friends-list-item">
								<div class="user-card-row">
									<div class="tbl-row">
										<div class="tbl-cell tbl-cell-photo">
											<a href="#">
												<img src="<?php echo base_url()?>assets/admin/img/photo-64-2.jpg" alt="">
											</a>
										</div>
										<div class="tbl-cell">
											<p class="user-card-row-name"><a href="#">Susan Andrews</a></p>
											<p class="user-card-row-status">Co-founder of <a href="#">Company</a></p>
										</div>
										<div class="tbl-cell tbl-cell-action">
											<a href="#" class="plus-link-circle"><span>&plus;</span></a>
										</div>
									</div>
								</div>
							</article>
						</div>

						<div class="see-all">
							<a href="#">See All (300)</a>
						</div>

					</section><!--.box-typical-->  <?php */ ?>
				</div><!--.col- -->