<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo $page_title ?> : <?php echo $page_name ?></title>
	<link rel="icon" href="<?php echo base_url()?>favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/lib/font-awesome/font-awesome.min.css">
     <link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/main.css">
    <?php
		if(isset($pageCSS)):
			foreach($pageCSS as $CSS){
				echo '<link rel="stylesheet" href="'.base_url().'assets'.$CSS.'" >';
			}
		endif;
  	?>
</head>
<body class="with-side-menu">	