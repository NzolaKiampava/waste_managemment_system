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
    $date = date('d/m/Y', time())
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
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Emitido Por
          <address>
            <strong><?=$user_data->empresa?></strong> (Empresa)<br>
            
            Email: <?=$user_data->email?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
        </div>
        <!-- /.col -->
       
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
          <img width="50" src="<?=ROOT.$user_data->logo?>" alt="Logo">

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
                <th style="width:50%">Grupos de Colecta:</th>
                <td><?=is_array($groups)?count($groups):'0'?></td>
              </tr>
              <tr>
                <th>Total de Contentores</th>
                <td><?=is_array($contentores)?count($contentores):'0'?></td>
              </tr>
              <tr>
                <th>Contentores Cheios:</th>
                <td><?=is_array($count_trash_full)?count($count_trash_full):'0'?></td>
              </tr>
              <tr>
                <th>Contentores Vazios:</th>
                <td><?=is_array($count_trash_empty)?count($count_trash_empty):'0'?></td>
              </tr>
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
