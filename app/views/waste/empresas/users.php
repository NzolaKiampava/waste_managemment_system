<?php $this->view("empresas/header", $data);?>

<?php $this->view("empresas/sidebar", $data);?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tabela de Funcionarios
        <small>lista de Funcionarios</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=ROOT?>empresas"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users list</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de todos os Funcionarios</h3>
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
                  <th>Ações</th>
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
                       
                        </td>
                        <td><?=$user->email?></td>
                        <td><?=$user->name?></td>
                        <td>
                          <span class="label bg-primary"><?=$user->rank?>
                          </span>
                        </td>
                        <td><?=date('M d, Y', strtotime($user->date))?></td>
                        <td>
                          <button class='btn btn-success btn-sm edit btn-flat' data-id="<?=$user->id?>"><i class='fa fa-edit'></i> Edit</button>
                          <button class='btn btn-danger btn-sm delete btn-flat' data-id="<?=$user->id?>"><i class='fa fa-trash'></i> Delete</button>
                        </td>
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

  <?php $this->view("empresas/footer", $data);?>

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
      url: '<?=ROOT?>empresas/users_row',
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
