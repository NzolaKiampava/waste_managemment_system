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
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid ">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">Contentores cheios</h3>
            </div>
            <div class="box-body">
            <ul class="todo-list">
                <div>
                  <canvas id="myChart"></canvas>
                </div>
            </ul>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid ">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">Contentores Vazios</h3>
            </div>
            <div class="box-body">
            <ul class="todo-list">
                <div>
                  <canvas id="myChart2"></canvas>
                </div>
            </ul>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid ">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">Contentores cheios ! Luanda</h3>
            </div>
            <div class="box-body">
            <ul class="todo-list">
                <div>
                  <canvas id="myChart3"></canvas>
                </div>
            </ul>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid ">
            <div class="box-header">
              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">Contentores Vazios ! Luanda</h3>
            </div>
            <div class="box-body">
            <ul class="todo-list">
                <div>
                  <canvas id="myChart4"></canvas>
                </div>
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
        labels: ['Luanda', 'Uíge', 'Huambo', 'Benguela', 'Zaire', 'Namibe','Moxico','Cabinda','Malanje','Lunda-Norte','Lunda-Sul','Cunene','Huila','Kwanza-Norte','Kwanza-Sul','Bie','Bengo','Cuando-Cubango','Total'],
        datasets: [{
          label: '# Total',
          data: [<?=is_array($luanda)?count($luanda):'0'?>, <?=is_array($uige)?count($uige):'0'?>,<?=is_array($huambo)?count($huambo):'0'?>, <?=is_array($benguela)?count($benguela):'0'?>, <?=is_array($zaire)?count($zaire):'0'?>, <?=is_array($namibe)?count($namibe):'0'?>, <?=is_array($moxico)?count($moxico):'0'?>, <?=is_array($cabinda)?count($cabinda):'0'?>, <?=is_array($malanje)?count($malanje):'0'?>, <?=is_array($lunda_norte)?count($lunda_norte):'0'?>, <?=is_array($lunda_sul)?count($lunda_sul):'0'?>, <?=is_array($cunene)?count($cunene):'0'?>, <?=is_array($huila)?count($huila):'0'?>, <?=is_array($kwanza_norte)?count($kwanza_norte):'0'?>, <?=is_array($kwanza_sul)?count($kwanza_sul):'0'?>, <?=is_array($bie)?count($bie):'0'?>, <?=is_array($bengo)?count($bengo):'0'?>, <?=is_array($cuando_cubango)?count($cuando_cubango):'0'?>, <?=is_array($count_trash_full)?count($count_trash_full):'0'?>],
          borderWidth: 1,
          backgroundColor: ['#C71339', '#CB0319', '#CB4119', '#CB4335', '#CB1335', '#aB4335', '#CB4339', '#CB4324', '#CB1335', '#CB4125', '#CB4325', '#C24335', '#Cf4335', '#CB4322', '#DD4335', '#CB4135', '#CB3315', '#DD4335', '#ec2424'],
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

    const ctx2 = document.getElementById('myChart2');
    new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: ['Luanda', 'Uíge', 'Huambo', 'Benguela', 'Zaire', 'Namibe','Moxico','Cabinda','Malanje','Lunda-Norte','Lunda-Sul','Cunene','Huila','Kwanza-Norte','Kwanza-Sul','Bie','Bengo','Cuando-Cubango','Total'],
        datasets: [{
          label: '# Total',
          data: [<?=is_array($luanda_empty)?count($luanda_empty):'0'?>, <?=is_array($uige_empty)?count($uige_empty):'0'?>,<?=is_array($huambo_empty)?count($huambo_empty):'0'?>, <?=is_array($benguela_empty)?count($benguela_empty):'0'?>, <?=is_array($zaire_empty)?count($zaire_empty):'0'?>, <?=is_array($namibe_empty)?count($namibe_empty):'0'?>, <?=is_array($moxico_empty)?count($moxico_empty):'0'?>, <?=is_array($cabinda_empty)?count($cabinda_empty):'0'?>, <?=is_array($malanje_empty)?count($malanje_empty):'0'?>, <?=is_array($lunda_norte_empty)?count($lunda_norte_empty):'0'?>, <?=is_array($lunda_sul_empty)?count($lunda_sul_empty):'0'?>, <?=is_array($cunene_empty)?count($cunene_empty):'0'?>, <?=is_array($huila_empty)?count($huila_empty):'0'?>, <?=is_array($kwanza_norte_empty)?count($kwanza_norte_empty):'0'?>, <?=is_array($kwanza_sul_empty)?count($kwanza_sul_empty):'0'?>, <?=is_array($bie_empty)?count($bie_empty):'0'?>, <?=is_array($bengo_empty)?count($bengo_empty):'0'?>, <?=is_array($cuando_cubango_empty)?count($cuando_cubango_empty):'0'?>, <?=is_array($count_trash_full)?count($count_trash_full):'0'?>],
          borderWidth: 1,
          backgroundColor: ['#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#124315'],
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


<script>
    const ct3 = document.getElementById('myChart3');

    new Chart(ct3, {
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

<script>
    const ct4 = document.getElementById('myChart4');

    new Chart(ct4, {
      type: 'bar',
      data: {
        labels: ['Belas', 'Cacuaco', 'Cazenga', 'Icolo e Bengo', 'Luanda', 'Quissama','Viana','Total'],
        datasets: [{
          label: '# Total',
          data: [<?=is_array($belas_v)?count($belas_v):'0'?>, <?=is_array($cacuaco_v)?count($cacuaco_v):'0'?>,<?=is_array($cazenga_v)?count($cazenga_v):'0'?>, <?=is_array($icolo_v)?count($icolo_v):'0'?>, <?=is_array($luandam_v)?count($luandam_v):'0'?>, <?=is_array($quissama_v)?count($quissama_v):'0'?>, <?=is_array($viana_v)?count($viana_v):'0'?>, <?=is_array($luanda_v)?count($luanda_v):'0'?>],
          borderWidth: 1,
          backgroundColor: ['#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a', '#00a65a'],
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