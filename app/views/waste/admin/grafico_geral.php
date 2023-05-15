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
        <section class="col-lg-7 connectedSortable">

          <!-- Map box -->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-bar-chart"></i> Estatistica dos contentores cheios | Provincia</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
                <div>
                  <canvas id="myChart"></canvas>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>
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
        labels: ['Usuarios', 'Baldes de Lixo', 'Baldes Vazio', 'Baldes Cheio', 'Grupos', 'Carros de Recolha'],
        datasets: [{
          label: '# Total',
          data: [<?=is_array($users)?count($users):'0'?>, <?=is_array($count_trash)?count($count_trash):'0'?>,<?=is_array($count_trash_empty)?count($count_trash_empty):'0'?>, <?=is_array($count_trash_full)?count($count_trash_full):'0'?>, <?=is_array($groups)?count($groups):'0'?>, <?=is_array($count_car)?count($count_car):'0'?>],
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