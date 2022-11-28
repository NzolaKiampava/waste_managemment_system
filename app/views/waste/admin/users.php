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
                  <th>Foto</th>
                  <th>Email</th>
                  <th>Nome</th>
                  <th>Estado</th>
                  <th>Data de Criação</th>
                  <th>Login</th>
                  <th>Logout</th>
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
                        <td><i class="<?=$user->online=='1'?'fa fa-circle text-success':''?>"></i> <?=($user->login_at==$user->logout_at)?"":date('d/m/y, H:i', strtotime($user->login_at))?></td>
                        <td><?=($user->login_at==$user->logout_at)?"":date('d/m/y, H:i', strtotime($user->logout_at))?></td>
                        <!--<td><?=($user->login_at==$user->logout_at || $user->login_at>$user->logout_at)?"":date('d/m/y, H:i', strtotime($user->logout_at))?></td>-->
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

<script>
  $(function(){

    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#edit').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });

    $(document).on('click', '.delete', function(e){
      e.preventDefault();
      $('#delete').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });

    $(document).on('click', '.photo', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      getRow(id);
    });

  });

  function getRow(id){
    $.ajax({
      type: 'POST',
      url: '<?=ROOT?>admin/users_row',
      data: {id:id},
      dataType: 'json',
      success: function(response){
        //console.log(response);
        $('.userid').val(response[0].id);
        $('#edit_email').val(response[0].email);
        $('#edit_name').val(response[0].name);
        $('#rankselected').val(response[0].rank).html(response[0].rank);
        $('.fullname').html(response[0].name);
      }
    });
  }
</script>
