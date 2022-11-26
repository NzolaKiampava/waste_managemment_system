  <!-- Left side column. contains the logo and sidebar -->
<?php
  $image = 'uploads/user.jpg';
  if (file_exists($user_data->image)) //looking for if exist some file int the collumn image
  {
      $image = $user_data->image;
  }
?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=ROOT.$image?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$user_data->name?></p>
          <a href="<?=ROOT?>admin/profile"><i class="fa fa-circle text-success"></i> <?=$user_data->rank?></a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <!--
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
          -->
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGAÇÃO PRINCIPAL</li>
        <li class="<?= $page_title == "Admin" ? "active treeview" : "#"?>">
          <a href="<?=ROOT?>admin">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?= $page_title == "Usuarios" ? "active treeview" : "#"?>">
          <a href="<?=ROOT?>admin/users">
            <i class="fa fa-group"></i> <span>Usuários</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"><?=is_array($users)?count($users):'0'?></span>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li class="<?= $page_title == "Profile" ? "active treeview" : ""?>">
          <a href="<?=ROOT?>admin/profile">
            <i class="fa fa-gear"></i> <span>Perfil</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>