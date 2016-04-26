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
              <a href="" class="navbar-brand"><b>i</b>Service</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a  href="#" class="dropdown-toggle" data-toggle="dropdown">失物招领 <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">失物招领</a></li>
                    <li><a href="#">寻物启事</a></li>
                    <li><a href="#">发布</a></li>
                    <li><a href="#">个人中心</a></li>
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

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h3>404 Error Page</h3>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="error-page">
			<h2 class="headline text-yellow">404</h2>
			<div class="error-content">
				<h3>
					<i class="fa fa-warning text-yellow"></i> Oops! Page not found.
				</h3>
				<p>
					We could not find the page you were looking for. Meanwhile, you may
					<a href="<?php echo site_url(); ?>">return to dashboard</a>
				</p>
			</div>
			<!-- /.error-content -->
		</div>
		<!-- /.error-page -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 0.0.1
          </div>
          <strong>Copyright &copy; 2015-2016 <a href="">iService</a>.</strong> All rights reserved.
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->


    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>    <!-- SlimScroll -->
    <script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js'); ?>"></script>
        <!-- FastClick -->
    <script src="<?php echo base_url('assets/js/fastclick.min.js'); ?>"></script>
        <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/js/app.min.js'); ?>"></script>

  </body>
</html>
      
