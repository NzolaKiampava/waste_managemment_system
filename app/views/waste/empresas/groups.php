<?php $this->view("admin/header", $data);?>
    <?php $this->view("admin/sidebar", $data);?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Grupos de Colecta
            <small>Todos os grupos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=ROOT?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Grupos de colecta</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            
            <div class="box-header with-border">
            <h3 class="box-title">Grupos</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
            </div>
              
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-success pull-left" data-toggle="modal" data-target="#myModal"><i class="fa fa-recycle"></i>&nbsp; Adicionar </button>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Nome do Grupo</th>
                    <th>Criado Por</th>
                    <th>Data de Criação</th>
                    <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($groups)):?> 
                            <?php foreach($groups as $group):?>
                                <?php
                                    $DB = Database::newInstance();  
                                    $id = $group->created_by;
                                    $search = $DB->read("select * from users where id = '$id'");
                                ?>
                            <tr>
                                <td><img src="<?=ASSETS . THEME?>/assets/logo/logo.jpg" class="img-circle" height='30px' width='30px'></td>
                                <td><?=$group->id?></td>
                                <td><?=$group->group_name?></td>
                                <td><?=$search[0]->name?></td>
                                <td><?=date('M d, Y', strtotime($group->created_at))?></td>
                                <td>
                                    <button class='btn btn-success btn-sm edit btn-flat' data-id="<?=$group->id?>"><i class='fa fa-edit'></i> Edit</button>
                                    <button class='btn btn-danger btn-sm delete btn-flat' data-id="<?=$group->id?>"><i class='fa fa-trash'></i> Delete</button>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include 'includes/groups_modal.php'; ?>
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
      url: '<?=ROOT?>admin/groups_row',
      data: {id:id},
      dataType: 'json',
      success: function(response){
        //console.log(response);
        $('.userid').val(response[0].id);
        $('#edit_group').val(response[0].group_name);
        $('.groupname').html(response[0].group_name);
      }
    });
  }
</script>