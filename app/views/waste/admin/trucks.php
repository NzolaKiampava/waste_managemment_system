<?php $this->view("admin/header", $data);?>
    <?php $this->view("admin/sidebar", $data);?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Caminhões de colecta
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=ROOT?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Caminhões</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
            
            <div class="box-header with-border">
            <h3 class="box-title">Caminhões</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
            </div>
              
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-success pull-left" data-toggle="modal" data-target="#myModal"><i class="fa fa-truck"></i>&nbsp; Adicionar </button>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Matricula</th>
                    <th>Grupo de Colecta</th>
                    <th>Rota 1</th>
                    <th>Rota 2</th>
                    <th>Rota 3</th>
                    <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($trucks)):?> 
                      <?php foreach($trucks as $truck):?>
                        <?php
                            $DB = Database::newInstance();  
                            $id = $truck->created_by;
                            $search = $DB->read("select * from users where id = '$id'");
                            $group_id = $truck->group_id;
                            $search_group = $DB->read("select * from colector_group where id = '$group_id'");
                            $truck1 = $truck->address_id_1;
                            $truck2 = $truck->address_id_2;
                            $truck3 = $truck->address_id_3;
                            $rota1 = $DB->read("select * from garbage_address where id = '$truck1'");
                            $rota2 = $DB->read("select * from garbage_address where id = '$truck2'");
                            $rota3 = $DB->read("select * from garbage_address where id = '$truck3'");
                        ?>
                        <tr>
                            <td><img src="<?=ASSETS . THEME?>/assets/logo/car.jpg" class="img-circle" height='30px' width='30px'></td>
                            <td><?=$truck->name?></td>
                            <td><?=$truck->registration?></td>
                            <td><?=is_array($search_group)?$search_group[0]->group_name:''?></td>
                            <td><?=$rota1[0]->address?></td>
                            <td><?=$rota2[0]->address?></td>
                            <td><?=$rota3[0]->address?></td>
                            <td>
                                <button class='btn btn-success btn-sm edit btn-flat' data-id="<?=$truck->id?>"><i class='fa fa-edit'></i> Edit</button>
                                <button class='btn btn-danger btn-sm delete btn-flat' data-id="<?=$truck->id?>"><i class='fa fa-trash'></i> Delete</button>
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
    <?php include 'includes/truck_modal.php'; ?>
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
      url: '<?=ROOT?>admin/truck_row',
      data: {id:id},
      dataType: 'json',
      success: function(response){
        //console.log(response);
        $('.userid').val(response[0].id);
        $('#edit_name').val(response[0].name);
        $('#edit_registration').val(response[0].registration);
        $('#edit_group').val(response[0].group_id).html(response[0].group_id);
        $('#address_id_1').val(response[0].address_id_1).html(response[0].address_id_1);
        $('#address_id_2').val(response[0].address_id_2).html(response[0].address_id_2);
        $('#address_id_3').val(response[0].address_id_3).html(response[0].address_id_3);
        $('.delete_name').html(response[0].name);
      }
    });
  }
</script>