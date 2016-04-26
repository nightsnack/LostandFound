<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="<?php echo base_url('assets/css/bootstrap/css/bootstrap.min.css'); ?>">
<link href="<?php echo base_url('assets/css/font-awesome/css/font-awesome.min.css'); ?>"
	rel="stylesheet">
<link rel="stylesheet"
	href="<?php echo base_url('assets/css/AdminLTE/css/AdminLTE.css'); ?>">
<link rel="stylesheet"
	href="<?php echo base_url('assets/css/AdminLTE/css/skins/_all-skins.min.css'); ?>">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('assets/js/jQuery-2.1.4.min.js'); ?>"></script>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-red layout-top-nav">
    <div class="wrapper">

           <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="<?php echo base_url()?>" class="navbar-brand"><b>i</b>Service</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a  href="#" class="dropdown-toggle" data-toggle="dropdown">失物招领 <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo site_url("Home/FindSquare") ?>">招领启事</a></li>
                    <li><a href="<?php echo site_url("Home/LoseSquare") ?>">寻物启事</a></li>
                    <li><a href="<?php echo site_url("Home/InsertFind") ?>">发布招领启事</a></li>
                    <li><a href="<?php echo site_url("Home/InsertLose") ?>">发布寻物启事</a></li>
                    <li><a href="<?php echo site_url("Person/myFind") ?>">我的招领启事</a></li>
                    <li><a href="<?php echo site_url("Person/myLose") ?>">我的寻物启事</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a  href="#" class="dropdown-toggle" data-toggle="dropdown">通知公告 <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
<!--                    <li class="active"><a href="#">教务处</a></li>-->
                    <li><a href="#">学工处</a></li>
                    <li><a href="#">总务处</a></li>
                    <li><a href="#">保卫处</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>