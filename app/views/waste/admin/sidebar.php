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
        <li class="<?= $page_title == "Groups" ? "active treeview" : "#"?>">
          <a href="<?=ROOT?>admin/groups">
            <i class="fa  fa-recycle"></i> <span>Grupos de Colecta</span>
          </a>
        </li>
        
        <li class="<?= $page_title == "Trash" ? "active treeview" : "#"?>">
          <a href="<?=ROOT?>admin/trash">
            <i class="fa  fa-trash"></i> <span>Baldes de Lixo</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow" title="Total"><?=is_array($count_trash)?count($count_trash):'0'?></small>
              <small class="label pull-right bg-green" title="Vazio"><?=is_array($count_trash_empty)?count($count_trash_empty):'0'?></small>
              <small class="label pull-right bg-red" title="Cheio"><?=is_array($count_trash_full)?count($count_trash_full):'0'?></small>
            </span>
          </a>
        </li>
        <li class="<?= $page_title == "Truck" ? "active treeview" : "#"?>">
          <a href="<?=ROOT?>admin/trucks">
            <i class="fa  fa-truck"></i> <span>Carros de Colecta</span>
          </a>
        </li>
        <li class="<?= $page_title == "Address" ? "active treeview" : "#"?>">
          <a href="<?=ROOT?>admin/address">
            <i class="fa  fa-map-marker"></i> <span>Endereços</span>
          </a>
        </li>
        <li class="<?= $page_title == "Messages" ? "active treeview" : "#"?>">
          <a href="<?=ROOT?>admin/messages">
            <i class="fa fa-envelope"></i> <span>Mensagens</span>
          </a>
        </li>
        
        <li class="<?= $page_title == "Geolocalizacao" ? "active treeview" : "#"?>">
          <a href="<?=ROOT?>admin/geolocalizacao">
            <i class="fa fa-map"></i> <span>Geolocalizacao</span>
          </a>
        </li>

        <li class="treeview <?=$page_title=="RelatorioGeral"?"active":""?> menu-open">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Relatorios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?=$page_title=="RelatorioGeral"?"active":""?>"><a href="<?=ROOT?>admin/relatoriogeral"><i class="fa fa-circle-o"></i> Relatorio Geral</a></li>
          </ul>
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
