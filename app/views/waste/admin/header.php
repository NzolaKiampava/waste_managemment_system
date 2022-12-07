<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=WEBSITE_TITLE?> | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="apple-touch-icon" sizes="180x180" href="<?=ASSETS . THEME?>/assets/img/favicons_io/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=ASSETS . THEME?>/assets/img/favicons_io/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?=ASSETS . THEME?>/assets/img/favicons_io/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?=ASSETS . THEME?>/assets/img/favicons_io/favicon.ico">
  <link rel="manifest" href="<?=ASSETS . THEME?>/assets/img/favicons_io//site.webmanifest">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<?php
   $image = 'uploads/user.jpg';
   if (file_exists($user_data->image)) //looking for if exist some file int the collumn image
   {
        $image = $user_data->image;
   }
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>WASTE</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Smart</b>WASTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=ASSETS.THEME?>admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=ASSETS.THEME?>admin/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=ASSETS.THEME?>admin/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=ASSETS.THEME?>admin/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=ASSETS.THEME?>admin/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">2</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tens 2 notificações</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> <?=is_array($users)?count($users):'0'?> usuarios cadastrados
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-trash text-red"></i> <?=is_array($count_trash)?count($count_trash):'0'?> Baldes de Lixo
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tens 4 actividades</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                       Total de Usuários
                        <small class="pull-right"><?=is_array($users)?count($users):'0'?>%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: <?=is_array($users)?count($users):'0'?>%" role="progressbar"
                             aria-valuenow="<?=is_array($users)?count($users):'0'?>" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only"><?=is_array($users)?count($users):'0'?>% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Contentor Vazios
                        <small class="pull-right"><?=is_array($count_trash_empty)?count($count_trash_empty):'0'?>%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: <?=is_array($count_trash_empty)?count($count_trash_empty):'0'?>%" role="progressbar"
                             aria-valuenow="<?=is_array($count_trash_empty)?count($count_trash_empty):'0'?>" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only"><?=is_array($count_trash_empty)?count($count_trash_empty):'0'?>% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Contentor Cheios
                        <small class="pull-right"><?=is_array($count_trash_full)?count($count_trash_full):'0'?>%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: <?=is_array($count_trash_full)?count($count_trash_full):'0'?>%" role="progressbar"
                             aria-valuenow="<?=is_array($count_trash_full)?count($count_trash_full):'0'?>" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only"><?=is_array($count_trash_full)?count($count_trash_full):'0'?>% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Total de Baldes
                        <small class="pull-right"><?=is_array($count_trash)?count($count_trash):'0'?>%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: <?=is_array($count_trash)?count($count_trash):'0'?>%" role="progressbar"
                             aria-valuenow="<?=is_array($count_trash)?count($count_trash):'0'?>" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only"><?=is_array($count_trash)?count($count_trash):'0'?>% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#"></a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=ROOT.$image?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$user_data->name?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=ROOT.$image?>" class="img-circle" alt="User Image">

                <p>
                  <?=$user_data->name?> - <?=$user_data->rank?>
                  <small><?=$user_data->email?></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=ROOT?>admin/profile" class="btn btn-default btn-flat"><i class="fa fa fa-gear"></i> Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="<?=ROOT?>logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
