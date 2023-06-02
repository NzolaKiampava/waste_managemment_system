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
            <i class="fa fa-globe"></i> SmartWaste.
            <small class="pull-right">Data: <?=$date?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>


      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        <h3><b>Histórico de Contentores <?=$status?></b></h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Pronvicia</th>
                <th>Municipios</th>
                <th>TOTAL de Contentores <?=$status?></th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $DB = Database::newInstance();
              $existingValues = [];

              if(is_array($history_buckets)):
                  foreach($history_buckets as $hf):
                      // Check if the current value already exists in the table
                      if (!in_array([$hf->province, $hf->municipy], $existingValues)) {
                          $existingValues[] = [$hf->province, $hf->municipy];

                          $f = $DB->read("SELECT * FROM history_trashbucket where trashbucket_id = '$hf->trashbucket_id' and status = '$status_c' and (status_date >= '$date1' and status_date <= '$date2')");  
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

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Logos</p>
          <img width="50" src="<?=ASSETS.THEME?>assets/logo/logo.jpg" alt="Logo">
          <img width="50" src="<?=ASSETS.THEME?>assets/logo/logo.png" alt="Logo">
        </div>
        <div class="col-xs-6">
          <p class="lead">Processado por sistema SmartWaste</p>
          
        </div>
      </div>
      <!-- /.row -->


    </section>
  <!-- /.content -->
</div> 
</body>
</html>
