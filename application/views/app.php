<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $tabTitle . ' | ' . APP_NAME ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url('bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('bower_components/select2/dist/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('bower_components/select2-bootstrap-theme/dist/select2-bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css') ?>">
  <link rel="stylesheet" href="<?= base_url('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/skin-green-light.min.css') ?>">


<!-- jQuery 2.2.0 -->
<script src="<?= base_url('bower_components/jquery/dist/jquery.min.js')?>" type="text/javascript"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-green-light sidebar-mini fixed">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?= APP_NAME ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?= APP_NAME ?></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?= base_url('assets/img/display-photo-placeholder.png') ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?= user('fullname') ?: user('login_username') ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?= base_url('assets/img/display-photo-placeholder.png') ?>" class="img-circle" alt="User Image">

                <p>
                 <?= user('fullname') ?: user('login_username') ?>
                  <small><?= user('organization') ?: '<em class="text-danger">Unassigned</em>' ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= site_url('logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
                <div>
                  <a href="<?= site_url('profile') ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('sidebar')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $contentTitle ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <?= $content ?>
      <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>USCERT &copy; 2016
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<script src="<?= base_url('bower_components/moment/min/moment.min.js')?>"></script>
<script src="<?= base_url('bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js')?>"></script>
<script type="text/javascript" src="<?= base_url('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')?>"></script>
<script type="text/javascript" src="<?= base_url('bower_components/select2/dist/js/select2.min.js')?>"></script>
<script src="<?= base_url('assets/js/app.min.js')?>"></script>
<script src="<?= base_url('assets/js/common.js')?>"></script>
<script src="<?= base_url('assets/js/attendance.js')?>"></script>
</body>
</html>
