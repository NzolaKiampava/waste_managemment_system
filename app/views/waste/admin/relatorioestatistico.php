<?php $this->view("admin/header", $data);?>
    <?php $this->view("admin/sidebar", $data);?>

    <?php
      $month = date('m');
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Relatorio Estatistico
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=ROOT?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Relatorios</a></li>
        <li class="active">Relatorio Estatistico</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Nota:</h4>
        As informações do relatório apresentam o histórico do estado dos contentores que vai até a data actual (<?=date('M/Y')?>).
      </div>
    </div>
<?php
    $date = date('d/m/Y', time())
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
        <h3><b>Histórico de Contentores Cheios</b></h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Pronvicia</th>
                <th>Municipios</th>
                <th>TOTAL</th>
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
                          $f = $DB->read("SELECT * FROM history_trashbucket inner join trash_buckets where trash_buckets.province = '$hf->province' and trash_buckets.municipy = '$hf->municipy' and history_trashbucket.status = 'full' and MONTH(history_trashbucket.status_date) <= '$month'");  
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

                          $e = $DB->read("SELECT * FROM history_trashbucket inner join trash_buckets where trash_buckets.province = '$he->province' and trash_buckets.municipy = '$he->municipy' and history_trashbucket.status = 'empty' and MONTH(history_trashbucket.status_date) <= '$month'");  
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
          <img width="50" src="<?=ASSETS.THEME?>assets/logo/logo.png" alt="Logo">
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

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?=ROOT?>admin/imprimirelatorioestatistico" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->view("admin/footer", $data);?>
