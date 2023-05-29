<?php $this->view("empresas/header", $data);?>

<?php $this->view("empresas/sidebar", $data);?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Painel de controlo</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=is_array($users)?count($users):'0'?></h3>

              <p>Total de Usuários</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?=ROOT?>admin/users" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=is_array($count_trash)?count($count_trash):'0'?></h3>

              <p>Total de Contentores</p>
            </div>
            <div class="icon">
              <i class="fa fa-recycle"></i>
            </div>
            <a href="<?=ROOT?>admin/trash" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=is_array($count_trash_empty)?count($count_trash_empty):'0'?><!--<sup style="font-size: 20px">%</sup>--></h3>

              <p>Contentores vazios</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?=ROOT?>admin/trash" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=is_array($count_trash_full)?count($count_trash_full):'0'?></h3>

              <p>Contentores cheios</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?=ROOT?>admin/trash" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-bar-chart"></i> Contentores cheios | Luanda</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
                <div>
                  <canvas id="myChart2"></canvas>
                </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Últimos Usuários cadastrados</h3>

                <div class="box-tools pull-right">
                  <span class="label label-danger"><?=is_array($users)?count($users):'0'?> Usuários total</span>
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
              <?php if(is_array($limit_users)):?>
                  <?php foreach($limit_users as $limit_user):?>
                  <?php
                      if (file_exists($limit_user->image))
                          $image = $limit_user->image;
                      else
                      $image = 'uploads/user.jpg';
                  ?>
                  <li>
                      <img src="<?=ROOT.$image?>" width="128" height="128" alt="User Image">
                      <a class="users-list-name" href="#"><?=$limit_user->name?></a>
                      <span class="users-list-date"><?=date('M d, Y', strtotime($limit_user->date))?></span>
                  </li>
                  <?php endforeach;?>
              <?php endif;?>
              </ul>
                <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="<?=ROOT?>admin/users" class="uppercase">View All Users</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box (chat box) -->
          
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid ">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">Endereços de Contentores de Lixo</h3>
            </div>
            <div class="box-body">
            <ul class="todo-list">
              <?php if(is_array($count_address)):?>
                <?php foreach($count_address as $address):?>
                <li>
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>
                
                <span class="text"><?=$address->address?></span>
                <?php
                  $DB = Database::newInstance();
                  $find = $DB->read("SELECT * from trash_buckets where address_id = '$address->id' and id_empresa = '$id_empresa'");
                ?>
                <small class="label label-warning"><i class="fa fa-map-marker"></i> &nbsp;<?=is_array($find)?count($find):'0'?></small>
                <div class="tools">
                </div>
                </li>
                <?php endforeach;?>
              <?php endif;?>
            </ul>
            </div>
            <!-- /.box-body-->
          </div>
          <div class="box box-solid ">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">Acessar Apartir do Telefone</h3>
            </div>
            <div class="box-body">
            <ul class="todo-list">
            <img src="<?=ASSETS.THEME?>smartwastweb.png" alt="QRCode">
            </ul>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- Custom tabs (Charts with tabs)-->
          
          <!-- /.nav-tabs-custom -->
          <!-- /.box -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->view("empresas/footer", $data);?>


<script>
    const ct = document.getElementById('myChart');

    new Chart(ct, {
      type: 'bar',
      data: {
        labels: ['Belas', 'Cacuaco', 'Cazenga', 'Icolo e Bengo', 'Luanda', 'Quissama','Viana','Total'],
        datasets: [{
          label: '# Total',
          data: [<?=is_array($belas)?count($belas):'0'?>, <?=is_array($cacuaco)?count($cacuaco):'0'?>,<?=is_array($cazenga)?count($cazenga):'0'?>, <?=is_array($icolo)?count($icolo):'0'?>, <?=is_array($luandam)?count($luandam):'0'?>, <?=is_array($quissama)?count($quissama):'0'?>, <?=is_array($viana)?count($viana):'0'?>, <?=is_array($luanda)?count($luanda):'0'?>],
          borderWidth: 1,
          backgroundColor: ['#C71339', '#CB0319', '#CB4119', '#CB4335', '#CB1335', '#aB4335', '#CB4339', '#ec2424'],
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        legend: {
          display: false
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem) {
              return tooltipItem.yLabel;
            }
          }
        }
      }
    });
  </script>
