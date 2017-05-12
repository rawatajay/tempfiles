<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo $page_title ?> : <?php echo $page_name ?></title>

	<link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link rel="icon" href="<?php echo base_url()?>favicon.ico" type="image/x-icon">

	
     <link rel="stylesheet" type="text/css" href="http://rvera.github.io/image-picker/image-picker/image-picker.css">
          <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/lib/bootstrap-sweetalert/sweetalert.css"/>
       <link rel="stylesheet" href="<?php  echo base_url()?>assets/admin/css/lib/summernote/summernote.css"/>
        <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/lib/jquery-tag-editor/jquery.tag-editor.css"/>    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/main.css">
<!--    <link rel="stylesheet" href="<?php // echo base_url()?>assets/admin/ckeditor/contents.css"/>-->
</head>
<body class="horizontal-navigation">	
   <script> var baseurl = "<?php echo base_url(); ?>";</script> 
    
<style>
    .profile_header{  background: #00A8FF; color:#FFF;}
    
    #country-list{float:left;list-style:none;margin:0;padding:0;width:190px;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#country-list{    position: fixed;
    z-index: 111;
    }
    
    .pading-three{ padding: 15px;}
    .img_border{ border: 5px;}
    .img_width{ width:40px; height: 40px;}
    
      .step-width{ width: 150px !important; }
</style>