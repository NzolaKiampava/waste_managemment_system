<?php $this->view("empresas/header", $data);?>
    <?php $this->view("empresas/sidebar", $data);?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Relatorio Geral
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=ROOT?>empresas"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Relatorios</a></li>
        <li class="active">Relatorio Geral</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        Esta página foi aprimorada para impressão. Clique no botão de impressão na parte inferior do relatório para testar.
      </div>
    </div>
<?php
    $date = date('d/m/Y', time())
?>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->

      
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <form method="POST">
            <button class="btn btn-default" name="print"><i class="fa fa-print"></i>Print</button>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->view("empresas/footer", $data);?>
