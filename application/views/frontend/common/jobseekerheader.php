<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title><?php echo $page_title ?> : <?php echo $page_name ?></title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="icon" href="<?php echo base_url()?>/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/fonts/style.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/main-responsive.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/print.css" type="text/css" media="print"/>

		<!-- start: CSS REQUIRED FOR USER LIST ONLY 	-->
		<?php if(count($pageCSS) > 0){ 
			foreach ($pageCSS as $css) { ?>			
			<link rel="stylesheet" href="<?php echo $css ?>">		
		<?php } } ?>
		<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->		
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>