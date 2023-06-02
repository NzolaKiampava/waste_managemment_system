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
      <form method="POST">
        <div class="input-group date">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          
            <input type="date" class="form-control pull-right" name="date1" required><input type="date" class="form-control pull-right" name="date2">
            
        </div>
        <label for="status">Status</label>
        <select name="status" id="status">
          <option value="empty">Vazio</option>
          <option value="middle">Meio</option>
          <option value="full">Cheio</option>
        </select>&nbsp;&nbsp;
        <button type="submit" class="btn btn-default" name="imprimirstatus" required><i class="fa fa-print"></i> IMPRIMIR</button>
      </form>
      
      <!-- this row will not appear when printing -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->view("empresas/footer", $data);?>
