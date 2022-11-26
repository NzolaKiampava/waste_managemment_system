<?php $this->view("admin/header", $data);?>

<?php $this->view("admin/sidebar", $data);?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tabela de Usuários
        <small>lista de usuários</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=ROOT?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users list</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de todos os Usuários</h3>
            </div>
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Adicionar</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Photo</th>
                  <th>Email</th>
                  <th>Nome</th>
                  <th>Estado</th>
                  <th>Data de Criação</th>
                  <?php if($user_data->rank=="Administrador"):?>
                    <th>Ações</th>
                  <?php endif;?>
                </tr>
                </thead>
                <tbody>
                  <?php if(is_array($users)): ?>
                    <?php foreach($users as $user): ?>
                      <?php
                        if (file_exists($user->image))
                            $image = $user->image;
                        else
                          $image = 'uploads/user.jpg';
                      ?>
                      <tr>
                        <td>
                        <img src="<?=ROOT.$image?>" class="img-circle" height='30px' width='30px'>
                        <?php if($user_data->rank=="Administrador"):?>
                          <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id="<?=$user->id?>"><i class='fa fa-edit'></i></a></span>
                        <?php endif;?>
                        </td>
                        <td><?=$user->email?></td>
                        <td><?=$user->name?></td>
                        <td><span class="<?=($user->rank=="Administrador")?"label bg-green":"label bg-primary"?>"><?=$user->rank?></span></td>
                        <td><?=date('M d, Y', strtotime($user->date))?></td>
                        <?php if($user_data->rank=="Administrador"):?>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id="<?=$user->id?>"><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id="<?=$user->id?>"><i class='fa fa-trash'></i> Delete</button>
                          </td>
                        <?php endif;?>
                      </tr>
                    <?php endforeach;?>
                  <?php endif;?>
                  
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'includes/users_modal.php'; ?>

  <?php $this->view("admin/footer", $data);?>