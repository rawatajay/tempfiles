<!DOCTYPE html>
<html>
<head lang="ru">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo $page_title ?> : <?php echo $page_name ?></title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">	
	<link rel="icon" href="<?php echo base_url()?>/favicon.ico" type="image/x-icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        
	<link rel="stylesheet" href="<?php echo base_url()?>assets/frontend/css/green.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/lib/font-awesome/font-awesome.min.css">
 <script src="<?php echo base_url()?>assets/frontend/js/main.js"></script>
<!--  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/jquery.bxslider.min.js"></script>  
    
  
 

</head>


<style>
.bx-wrapper .testimonials-thumbnail{ margin: 0px 0px 15px; }
.bx-wrapper .testimonials-title{ text-align: center;  margin: 25px 15px 3px; font-size: 24px; line-height: 1; }
.bx-wrapper .testimonials-carousel-thumbnail{ max-width: 35%; float: left; margin-right: 20px; }
.bx-wrapper .testimonials-carousel-thumbnail img{ display: block;   margin-right: 20px;width: 100px;}
.bx-wrapper .testimonials-carousel-context{ overflow: hidden; }
.bx-wrapper .testimonials-name{ font-size: 18px; margin-bottom: 15px; color:#000000; font-weight:400;}
.bx-wrapper span{ font-size: 11px; margin-left:10px; color:#aaa; font-family: Georgia, Arial, Helvetica, sans-serif; font-style:italic; }
.bx-wrapper {position: relative;margin: 30px auto;padding: 0;width:100%;*zoom: 1;}
.bx-wrapper .slide {padding:0;margin:0;display: block;}
.bx-wrapper .bx-viewport {padding:10px;margin-left:0;z-index:1;width:100%;}
.bx-wrapper .bx-pager,
.bx-wrapper .bx-controls-auto {position: absolute;display:none;bottom: -30px;width: 100%;}
.bx-wrapper .bx-loading {min-height: 50px;background: url(images/bx_loader.gif) center center no-repeat #fff;height: 100%;width: 100%;position: absolute;top: 0;left: 0;z-index: 2000;}
.bx-wrapper .bx-pager {text-align: center;font-size: .85em;font-weight: bold;color: #666;padding-top: 20px;}
.bx-wrapper .bx-pager .bx-pager-item,
.bx-wrapper .bx-controls-auto .bx-controls-auto-item {display: inline-block;*zoom: 1;*display: inline;}
.bx-wrapper .bx-pager.bx-default-pager a {background: #666;text-indent: -9999px;display: block;width: 10px;height: 10px;margin: 0 5px;outline: 0;-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;}
.bx-wrapper .bx-pager.bx-default-pager a:hover,
.bx-wrapper .bx-pager.bx-default-pager a.active {background: #000;}
/*
.bx-wrapper .bx-next {position: absolute;top: 0;right: 0;width: 30px;border-left:1px solid #ddd;height: 30px;cursor: pointer;background: #ED3131 url(images/caousel-next.png) no-repeat 0 0 ;}
.bx-wrapper .bx-prev {position: absolute;top: 0px;right: 30px;border-right:1px solid #ddd;width: 30px;height: 30px;cursor: pointer;background: #ED3131 url(images/caousel-prev.png) no-repeat 0 0 ;}
.bx-wrapper .bx-controls-direction a {position: absolute;top: 0;margin-top: 0;margin-right: 0px;outline: 0;width: 30px;height: 30px;text-indent: -9999px;z-index: 9999;}
*/
</style>

<body>

	<header class="site-header-container" id="section-1">
		<div class="site-header">
			<div class="site-header-collapsed">
				<div class="site-header-collapsed-in">
					<div class="container">
						<div class="site-logo">Job<span>Hunter</span></div>
						<div class="site-header-right">
							<nav class="site-menu" id="page-nav">
								<ul>
									<li><a href="#section-1"><span>Main</span></a></li>
									<li><a href="#section-2"><span>About Us</span></a></li>
									<li><a href="#section-3"><span>Recruitments</span></a></li>	
								       <li><a href="#section-4"><span>Testimonials</span></a></li>
									<li><a onclick ="document.location.href = '<?php echo base_url('blog') ?>';" href="javascript:;"><span>Blog</span></a></li>									
									<?php  if(!empty($this->session->all_userdata()['userId']) && $this->session->all_userdata()['userType'] != '1'){?>									
									<li><a onclick ="document.location.href = '<?php echo base_url('user/logout'); ?>';" href="javascript:;"><span>Logout</span></a></li>	
									<?php }else {?>
									<li><a onclick ="document.location.href = '<?php echo base_url('signup/'.$code); ?>';" href="javascript:;"><span>Sign Up</span></a></li>
									<li><a onclick ="document.location.href = '<?php echo base_url('signin') ?>';" href="javascript:;"><span>Login</span></a></li>	
									<?php } ?>
								</ul>
							</nav>
							<?php  if(!empty($this->session->all_userdata()['userId']) && $this->session->all_userdata()['userType'] != '1'){?>	
							<a href="<?php echo base_url('myaccount'); ?>" class="btn btn-sm btn-fill">Hi,  <?php echo $this->session->all_userdata()['fname'] ?></a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="site-header-clone">
				<div class="container">
					<div class="site-logo">Start<span>UI</span></div>
					<button type="button" class="burger">
						<span></span>
						<span></span>
						<span></span>
					</button>
				</div>
			</div>
		</div>
	</header>

	<section class="section-promo">
		<div class="container">
			<div class="section-promo-txt">
				<h1>Easiest way to find your dream job</h1>
				<p>1000+ companies are waiting for job seeker.</p>
				<div class="btns-group">
					<a href="<?php echo base_url('signup/'.$code); ?>" class="btn btn-inverse">Register</a>
					<a href="<?php echo base_url('signin') ?>" class="btn btn-fill">Login</a>
				</div>
			</div>
			<div class="section-promo-pic">
				<img src="<?php echo base_url()?>assets/frontend/content/site.jpg" alt="">
			</div>
		</div>
	</section>
	
	<section class="section" >
		<div class="container">
			<header class="title-section">
				<a href="<?php echo base_url('signup/'.$code); ?>" class="btn btn-fill"><span class="hidden-sm-down">Get Started</span></a>	
								
			</header>			
		</div>
	</section>

	<section class="section"  id="section-2">
		<div class="container">
			<header class="title-section">
				<h3>About Us</h3>
			</header>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<article class="icon-txt-item">
						<i class="font-icon font-icon-rocket"></i>
						<h4>Why Us?</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
					</article>
				</div>
				<div class="col-lg-3 col-sm-6">
					<article class="icon-txt-item">
						<i class="font-icon font-icon-equalizer"></i>
						<h4>What We do?</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
					</article>
				</div>
				<div class="clearfix hidden-lg-up"></div>
				<div class="col-lg-3 col-sm-6">
					<article class="icon-txt-item">
						<i class="font-icon font-icon-pencil"></i>
						<h4>Benifites</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
					</article>
				</div>
				<div class="col-lg-3 col-sm-6">
					<article class="icon-txt-item">
						<i class="font-icon font-icon-devices"></i>
						<h4>Security</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
					</article>
				</div>
			</div>
		</div>
	</section>
	
	
	<section class="section"  id="section-3">
		<div class="container">
			<header class="title-section">
				<h3>Recruitments</h3>
				<div class="sub">Hiring in more than 500+ top companies.</div>
			</header>
			<div class="row">
				<div class="col-lg-4">
					<article class="price-block">
						<header class="price-block-title">Pune</header>
						<div class="price-block-amount">
							
							<div class="caption">
								
								<div class="caption-txt">200+ vacany .Net Companies</div>
							</div>
						</div>
						<div class="price-block-inner">
							
							<ul class="price-block-list">
								<li><p>Web Packets</p></li>
								<li><p>Edrubic</p></li>
								<li><p>United Health Group</p></li>
								<li><p>Berger Paints India Limited</p></li>
								<li><p>Carmeet Technologies Pvt. Ltd.</p></li>	
							</ul>
						</div>
						<div class="price-block-btn">
							<a href="#" class="btn btn-block btn-fill">Get started</a>
						</div>
					</article>
				</div><div class="col-lg-4">
					<article class="price-block">
						<header class="price-block-title">Bangalore</header>
						<div class="price-block-amount">
							
							<div class="caption">
								
								<div class="caption-txt">200+ vacany .Net Companies</div>
							</div>
						</div>
						<div class="price-block-inner">
							
							<ul class="price-block-list">
								<li><p>Web Packets</p></li>
								<li><p>Edrubic</p></li>
								<li><p>United Health Group</p></li>
								<li><p>Berger Paints India Limited</p></li>
								<li><p>Carmeet Technologies Pvt. Ltd.</p></li>	
							</ul>
						</div>
						<div class="price-block-btn">
							<a href="#" class="btn btn-block btn-fill">Get started</a>
						</div>
					</article>
				</div>
				<div class="col-lg-4">
					<article class="price-block">
						<header class="price-block-title">New Delhi</header>
						<div class="price-block-amount">
							
							<div class="caption">
								
								<div class="caption-txt">200+ vacany .Net Companies</div>
							</div>
						</div>
						<div class="price-block-inner">
							
							<ul class="price-block-list">
								<li><p>Web Packets</p></li>
								<li><p>Edrubic</p></li>
								<li><p>United Health Group</p></li>
								<li><p>Berger Paints India Limited</p></li>
								<li><p>Carmeet Technologies Pvt. Ltd.</p></li>	
							</ul>
						</div>
						<div class="price-block-btn">
							<a href="#" class="btn btn-block btn-fill">Get started</a>
						</div>
					</article>
				</div>
				
			</div>
		</div>
	</section>
          <section id="section-4">
                 <header class="title-section">
				<h3>Testimonials</h3>
				
			</header>
	<section class="section-fill">
		<div class="container">
                    
                   
			<div class="tbl txt-btn-block">
				<div class="tbl-row">
                                    
                    <div class="testimonials-slider">
                        
                          <?php  
                          
                             if(!empty($test_list)){ 
                              
                                 foreach ($test_list as $key => $tes_data) {
                                     
                              ?>
                
                      <div class="slide">
							
				<div class="testimonials-carousel-context">
                                    <div class="testimonials-name"><?php echo ucfirst($tes_data['userName']) ; ?> </div>
                                <div class="testimonials-carousel-content"><p>" <?php echo $tes_data['testmonialDescription']; ?> "</p></div>
                              </div>
                        </div>
                        <?php
                               }
                            }   
                        ?>
                      
                </div>
			</div>
			</div>
		</div>
	</section>
       </section>
	<footer class="site-footer">
		<section class="footer-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<header class="footer-title">About us</header>
						<p>Beta business plan growth hacking fruit ecosystem hypotheses investor ramen. MVP equity research & development early adopters burn rate backing funding.</p>
					</div>
	
					<div class="col-lg-3">
						<header class="footer-title">Contact Us</header>
						<div class="row">
							<div >
								<p> 1234 Street Name, City Name, United States</p>
								<p>(123) 456-7890</p>	
								<p>mail@example.com</p>
							</div>
							
						</div>
					</div>
	
					<div class="col-lg-5">
						<header class="footer-title">Subscribe to newsletter</header>
						<form class="form-subscribe">
							<input type="text" placeholder="E-mail address"/>
							<button type="button">Subscribe</button>
						</form>
						<p>We promise that we will never share your e-mail address</p>
					</div>
				</div>
			</div>
		</section>
	
		<section class="footer-bottom">
			<div class="container">
				<div class="copy"><?php echo COPYRIGHT?></div>
				<div class="social">
					<a href="#" title="facebook"><i class="font-icon font-icon-fb"></i></a>
					<a href="#" title="vkontakte"><i class="font-icon font-icon-vk"></i></a>
					<a href="#" title="odnoklassniki"><i class="font-icon font-icon-ok"></i></a>
					<a href="#" title="twitter"><i class="font-icon font-icon-tw"></i></a>
					<a href="#" title="google plus"><i class="font-icon font-icon-gp"></i></a>
					<a href="#" title="linkedin"><i class="font-icon font-icon-in"></i></a>
					<a href="#" title="instagram"><i class="font-icon font-icon-inst"></i></a>
				</div>
			</div>
		</section>
	</footer>

    
</body>
<script>
     $('.testimonials-slider').bxSlider({
			slideWidth: 800,
			minSlides: 1,
			maxSlides: 1,
			slideMargin: 32,
			auto: true,
			autoControls: true
		  });
</script>