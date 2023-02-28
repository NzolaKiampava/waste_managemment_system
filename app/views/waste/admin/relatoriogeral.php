<?php $this->view("admin/header", $data);?>
    <?php $this->view("admin/sidebar", $data);?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Relatorio Geral
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=ROOT?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
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
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> SmartWaste.
            <small class="pull-right">Data: <?=$date?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Emitido Por
          <address>
            <strong><?=$user_data->name?></strong> (<?=$user_data->rank?>)<br>
            57M8+469, Luanda Rangel KM7 CTT Parque do saber,<br>
            Luanda, Angola<br>
            Phone: (+244) 924 598 849<br>
            Email: <?=$user_data->email?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Informações do emissor</b><br>
          <br>
          <b>URL ID:</b> <?=$user_data->url_address?><br>
          <b>Conta criado em :</b> <?= date('d/m/Y', strtotime($user_data->date))?><br>
          <b>Tipo de Conta:</b> <?=$user_data->rank?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
                <th>ID Contentor</th>
                <th>Nome de Referência dos Contentores</th>
                <th>Estado do Contentor</th>
            </tr>
            </thead>
            <tbody>
                <?php if(is_array($count_trash)):?>
                    <?php foreach($count_trash as $count_trash):?>
                        <tr>
                            <td><?=$count_trash->id?></td>
                            <td><?=$count_trash->name?></td>
                            <td>
                            <span class="
                                <?php if($count_trash->status=="empty"):?>
                                label bg-green
                                <?php else:?>
                                label bg-red
                                <?php endif;?>"><?=($count_trash->status == "empty")?"Vazio":"Cheio"?>
                            </span>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Informações do Sistema:</p>
          <img width="50" src="<?=ASSETS.THEME?>assets/logo/logo.jpg" alt="Logo">
          <img width="50" src="<?=ASSETS.THEME?>assets/logo/logo.png" alt="Logo">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          SmartWaste é um projecto que visa melhorar a nossa sociedade. Sistema de gerenciamentro de resíduos sólidos habilitado para IOT indica o nível de lixeiras em qualquer tempo. Otimiza a rota de coleta de resíduos e, finalmente, reduz consumo de combustível.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Estado de Hoje <?=$date?></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total de Usuários:</th>
                <td><?=is_array($users)?count($users):'0'?></td>
              </tr>
              <tr>
                <th style="width:50%">Grupo de Colecta:</th>
                <td><?=is_array($groups)?count($groups):'0'?></td>
              </tr>
              <tr>
                <th>Total de Contentores</th>
                <td><?=is_array($contentores)?count($contentores):'0'?></td>
              </tr>
              <tr>
                <th>Contentores Vazios:</th>
                <td><?=is_array($count_trash_full)?count($count_trash_full):'0'?></td>
              </tr>
              <tr>
                <th>Contentores Cheios:</th>
                <td><?=is_array($count_trash_empty)?count($count_trash_empty):'0'?></td>
              </tr>
              
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?=ROOT?>admin/imprimirelatorio" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Lista de Usuários
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Imprimir Lista de usuários
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->view("admin/footer", $data);?>
