<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="http://oss.aifuwu.org/admin-LTE-assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://oss.aifuwu.org/admin-LTE-assets/dist/css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet"
	href="<?php echo base_url('assets/css/AdminLTE/css/AdminLTE.css'); ?>">
<link rel="stylesheet" href="http://oss.aifuwu.org/admin-LTE-assets/dist/css/skins/skin-red.min.css">
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- jQuery 2.1.4 -->
    <script src="http://oss.aifuwu.org/admin-LTE-assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
     
      <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(["setDomains", ["*.wechat.aifuwu.org"]]);
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//piwik.aifuwu.org/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', 27]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <noscript><p><img src="//piwik.aifuwu.org/piwik.php?idsite=27" style="border:0;" alt="" /></p></noscript>
    <!-- End Piwik Code -->
  
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-red fixed layout-top-nav">
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
                    <li><a href="http://wechat.aifuwu.org/notification/notification/notification_list/njupt">校级通知</a></li>
                    <li><a href="http://wechat.aifuwu.org/notification/notification/notification_list/jwc">教务处</a></li>
                    <li><a href="http://wechat.aifuwu.org/notification/notification/notification_list/xsc">学工处</a></li>
                    <li><a href="http://wechat.aifuwu.org/notification/notification/notification_list/bwc">保卫处</a></li>
                    <li><a href="http://wechat.aifuwu.org/notification/notification/notification_list/hqc">后勤处</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a  href="#" class="dropdown-toggle" data-toggle="dropdown">招聘信息 <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="http://wechat.aifuwu.org/recruit/recruit/notification_list/job_campus">招聘公告</a></li>
                    <li><a href="http://wechat.aifuwu.org/recruit/recruit/notification_list/teachin">招聘宣讲会</a></li>
                  </ul>
                </li>

                <li><a href="http://wechat.aifuwu.org/confession_wall/">表白墙</a></li>
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
					<i class="fa fa-warning text-yellow"></i> 找不到找不到找不到！
				</h3>
				<p>
					啊我萌找不到那个页面了= = 。
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
            <b>Version</b> 1.1.0
          </div>
          <strong>Copyright &copy; 2015-2016 <a href="http://nightsnack.3-123.club">iService·夜宵</a>.</strong> All rights reserved.
       </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="http://oss.aifuwu.org/admin-LTE-assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="http://oss.aifuwu.org/admin-LTE-assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="http://oss.aifuwu.org/admin-LTE-assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="http://oss.aifuwu.org/admin-LTE-assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="http://oss.aifuwu.org/admin-LTE-assets/dist/js/app.min.js"></script>

  </body>
</html>
      
