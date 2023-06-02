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
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=ASSETS.THEME?>admin/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <?php
    $date = date('d/m/Y', time());
    $month = date('m');
?>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img width="90" src="<?=ROOT.$user_data->logo?>" alt="Logo">
            <small class="pull-right">Data: <?=$date?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>


      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        <h3><b>Histórico de Contentores Cheios</b></h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Pronvicia</th>
                <th>Municipios</th>
                <th>TOTAL de Contentores Cheios</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $DB = Database::newInstance();
              $existingValues = [];

              if(is_array($history_buckets_full)):
                  foreach($history_buckets_full as $hf):
                      // Check if the current value already exists in the table
                      if (!in_array([$hf->province, $hf->municipy], $existingValues)) {
                          $existingValues[] = [$hf->province, $hf->municipy];

                          $f = $DB->read("SELECT * FROM history_trashbucket where trashbucket_id = '$hf->trashbucket_id' and status = 'full' and (status_date >= '$date1' and status_date <= '$date2')");  
                          ?>
                          <tr>
                              <td><?=$hf->province?></td>
                              <td><?=$hf->municipy?></td>
                              <td><?=count($f)?></td>
                          </tr>
                          <?php
                      }
                  endforeach;
              endif;
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        <h3><b>Histórico de Contentores Vazios</b></h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Pronvicia</th>
                <th>Municipios</th>
                <th>TOTAL de Contentores Vazios</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $DB = Database::newInstance();
              $existingValues = [];

              if(is_array($history_buckets_empty)):
                  foreach($history_buckets_empty as $he):
                      // Check if the current value already exists in the table
                      if (!in_array([$he->province, $he->municipy], $existingValues)) {
                          $existingValues[] = [$he->province, $he->municipy];

                          $e = $DB->read("SELECT * FROM history_trashbucket where trashbucket_id = '$he->trashbucket_id' and status = 'empty' and (status_date >= '$date1' and status_date <= '$date2')");  
                          ?>
                          <tr>
                              <td><?=$he->province?></td>
                              <td><?=$he->municipy?></td>
                              <td><?=count($e)?></td>
                          </tr>
                          <?php
                      }
                  endforeach;
              endif;
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>

      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        <h3><b>Tabela de Meses Cheios</b></h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Meses</th>
                <th>Provincias</th>
                <th>Municipios</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $existingCombinations = [];

              if(is_array($months_history)):
                  foreach($months_history as $mh):
                      $combination = $mh->status_date . '_' . $mh->province . '_' . $mh->municipy;
                      // Check if the current combination already exists
                      if (!in_array($combination, $existingCombinations)) {
                          $existingCombinations[] = $combination;
                          ?>
                          <tr>
                              <td><?=date('d, M/Y (h:i a)', strtotime($mh->status_date))?></td>
                              <td><?=$mh->province?></td>
                              <td><?=$mh->municipy?></td>
                              <td>
                                  <?php 
                                      if($mh->status == 'full') $status = "Cheio";
                                      else if($mh->status == 'empty') $status = "Vazio";
                                      else $status = "Meio";
                                  ?>
                                  <?=$status?>
                              </td>
                          </tr>
                          <?php
                      }
                  endforeach;
              endif;
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Logos</p>
          <img width="50" src="<?=ASSETS.THEME?>assets/logo/logo.jpg" alt="Logo">
          <img width="50" src="<?=ROOT.$user_data->logo?>" alt="Logo">
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Meses e Total | <i>contentores cheios</i></p>

          <div class="table-responsive">
            <table class="table">
              <?php 
                $existingCombinations = [];

                if(is_array($months_history)):
                  foreach($months_history as $mh):
                    $combination = date('M/Y', strtotime($mh->status_date)) . '_' . count($months_history);
                      // Check if the current combination already exists
                      if (!in_array($combination, $existingCombinations)) {
                          $existingCombinations[] = $combination;
                          ?>
                          <tr>
                            <th><?=date('M/Y', strtotime($mh->status_date))?></th>
                            <td><?=count($months_history)?></td>
                          </tr>
                          <?php
                      }
                  endforeach;
                endif;
              ?>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
  <!-- /.content -->
</div> 
</body>
</html>
