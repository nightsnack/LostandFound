<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="<?php echo asset_url(); ?>css/jquery.mobile-1.4.5.min.css">
<link href="<?php echo asset_url(); ?>css/bootstrap.min.css"
	rel="stylesheet">
<script src="<?php echo asset_url(); ?>js/jquery-2.2.0.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.mobile-1.4.5.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo asset_url(); ?>css/style.css">
</head>
<body>
	<div data-role="page" id="pageone">
		<div data-role="navbar">
			<ul>
				<li><a href="<?php echo site_url('Home'); ?>" data-icon="home">爱服务失物招领中心</a></li>
				<li><a href="#pagetwo" data-icon="search">搜索物品</a></li>
			</ul>
		</div>