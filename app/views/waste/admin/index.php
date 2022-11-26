<?php $this->view("admin/header", $data);?>

<?php $this->view("admin/sidebar", $data);?>


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
              <h3>44</h3>

              <p>Total de Baldes Lixo</p>
            </div>
            <div class="icon">
              <i class="fa fa-recycle"></i>
            </div>
            <a href="#" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>13<!--<sup style="font-size: 20px">%</sup>--></h3>

              <p>Baldes de Lixo vazios</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>31</h3>

              <p>Baldes de Lixo cheios</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
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
              <li class="pull-left header"><i class="fa fa-bar-chart"></i> Estatistica</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
                <div>
                  <canvas id="myChart"></canvas>
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
              <h3 class="box-title">Endereços de Baldes Lixo</h3>
            </div>
            <div class="box-body">
            <ul class="todo-list">
                  <li>
                  <!-- drag handle -->
                  <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <!-- checkbox -->
                  
                  <!-- todo text -->
                  <span class="text">Design a nice theme</span>
                  <!-- Emphasis label -->
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                  </div>
                  </li>
                  <li>
                      <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                      </span>
                  
                  <span class="text">Make the theme responsive</span>
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  <div class="tools">
                  </div>
                  </li>
                  <li>
                      <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                      </span>
                  
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                  <div class="tools">
                  </div>
                  </li>
                  <li>
                      <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                      </span>
                  
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                  <div class="tools">
                  </div>
                  </li>
                  <li>
                      <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                      </span>
                  
                  <span class="text">Check your messages and notifications</span>
                  <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                  <div class="tools">
                  </div>
                  </li>
                  <li>
                      <span class="handle">
                          <i class="fa fa-ellipsis-v"></i>
                          <i class="fa fa-ellipsis-v"></i>
                      </span>
                  
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                  <div class="tools">
                  </div>
                  </li>
                </ul>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->view("admin/footer", $data);?>
  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Usuarios', 'Baldes de Lixo', 'Baldes Vazio', 'Baldes Cheio', 'Purple', 'Orange'],
        datasets: [{
          label: '# Total',
          data: [<?=is_array($users)?count($users):'0'?>, 19, 3, 5, 2, 3],
          borderWidth: 1,
          backgroundColor: ['#00c0ef', '#f39c12', '#00a65a', '#CB4335', '#884EA0', '#D35400'],
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